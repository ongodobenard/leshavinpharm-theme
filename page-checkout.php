<?php
/**
 * Template Name: Checkout
 * Leshavin Pharmacy - page-checkout.php
 *
 * UPDATED: Checkout no longer requires selecting a WooCommerce payment
 * method. The store takes payment on delivery (Cash / M-Pesa), so
 * "Place Order" and "Order Via WhatsApp" both work with zero payment
 * gateways selected — native WC checkout processing (which was
 * throwing "Invalid payment method.") is bypassed entirely in favour
 * of a custom AJAX order-creation flow (leshavin_send_order).
 *
 * FIX 1: added the missing wp_ajax_leshavin_send_order handler in
 * functions.php (was previously unregistered, causing every "Place
 * Order" click to fail with a 400 and fall into the generic error
 * message).
 *
 * FIX 2: the page felt slow to reset after an order because the
 * browser was waiting on wp_mail() (email sending) to finish before
 * the AJAX response came back. functions.php now flushes the JSON
 * response to the browser first and sends email afterwards, and this
 * page triggers a WooCommerce cart-fragment refresh immediately on
 * success, then does a full page reload shortly after so the cart,
 * header cart icon, and form are all guaranteed to be back to a clean
 * state — every time, for both "Place Order" and "Order Via WhatsApp".
 */

/* Show product thumbnails in the order summary (WC's default review table
   is text-only) and relabel "Shipping" as "Delivery Fee" to match the mockup. */
add_filter( 'woocommerce_cart_item_name', function( $name, $cart_item, $cart_item_key ) {
	if ( ! is_checkout() ) return $name;
	$img = $cart_item['data']->get_image( 'thumbnail', array( 'class' => 'ck-item-thumb' ) );
	return '<span class="ck-item-row"><span class="ck-item-img">' . $img . '</span><span class="ck-item-text">' . $name . '</span></span>';
}, 10, 3 );

add_filter( 'gettext', function( $translated, $text, $domain ) {
	if ( $domain === 'woocommerce' && $text === 'Shipping' && is_checkout() ) return 'Delivery Fee';
	return $translated;
}, 10, 3 );

/* We never render woocommerce_checkout_payment() on this page at all
   (see below), but keep this removed as a safety net in case anything
   else still hooks woocommerce_checkout_order_review at priority 20. */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

/* Attempt to unhook WooCommerce's own default breadcrumb wherever a theme
   might call it via the standard hook. Harmless no-op if the theme's
   duplicate bar isn't actually this — the CSS/JS kill-switch below is
   the real fix for theme-injected page-header/breadcrumb bars. */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

get_header();

// FIX: leshavin_phone() returns a DISPLAY-formatted number ("+254 792
// 331 941") which breaks wa.me links (they need digits only). Use
// leshavin_wa() instead, which returns the clean digit string.
$ck_wa         = leshavin_wa();
$ck_order_nonce = wp_create_nonce( 'leshavin_order_nonce' );
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

/* Prevent the whole document from ever scrolling/cropping sideways. */
html, body { overflow-x: hidden; max-width: 100%; }

:root{
  --ck-navy:#0e2358;
  --ck-blue:#1c75bc;
  --ck-blue-dark:#125a94;
  --ck-green:#8dc63f;
  --ck-green-dark:#6ea82e;
  --ck-red:#c0392b;
  --ck-text:#1c2b3a;
  --ck-text-light:#6b7c8f;
  --ck-border:#e7ebf1;
  --ck-bg-soft:#f8f9fc;
  --ck-page-bg:#f6f7fb;
  --ck-font-head:'Oswald',Arial Narrow,sans-serif;
  --ck-font-body:'Inter',sans-serif;
  --ck-px:56px;
}
.ck-page{font-family:var(--ck-font-body);color:var(--ck-text);background:var(--ck-page-bg);overflow-x:hidden;width:100%;max-width:100vw;}
.ck-wrap{max-width:1280px;margin:0 auto;padding:0 var(--ck-px);width:100%;box-sizing:border-box;}

/* Restyle default WC notices instead of hiding them. */
.woocommerce-notices-wrapper{margin:0 0 18px;}
.woocommerce-message,.woocommerce-info,.woocommerce-error{
  list-style:none;background:#fff;border:1.5px solid var(--ck-border);
  border-left:4px solid var(--ck-blue);border-radius:10px;padding:12px 16px;
  font-size:.82rem;color:var(--ck-text);margin:0 0 14px;
}
.woocommerce-message{border-left-color:var(--ck-green-dark);}
.woocommerce-error{background:#fbeceb;border-color:#e8b6b0;border-left-color:var(--ck-red);color:var(--ck-red);}
ul.woocommerce-error li{list-style:none;}

/* ============================================================
   KILL DUPLICATE THEME PAGE-HEADER / BREADCRUMB BAR
   ============================================================ */
.woocommerce-breadcrumb,
.ast-breadcrumbs,
.ast-archive-description,
nav.breadcrumbs,
.breadcrumbs,
.breadcrumb-trail,
.kadence-breadcrumbs,
.page-header .breadcrumbs,
.page-header-breadcrumb,
.entry-header .breadcrumbs,
.site-breadcrumb,
.et_pb_breadcrumbs,
[class*="page-title-bar"],
[class*="pageheader"],
[class*="page-header"]:not(.ck-page *),
[id*="breadcrumb"]:not(.ck-page *),
[class*="breadcrumb"]:not(.ck-breadcrumb):not(.ck-page *){
  display:none !important;
}

/* ============================================================
   HEAD
   ============================================================ */
.ck-headrow{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;
  padding-top:34px;padding-bottom:26px;box-sizing:border-box;
}
.ck-title{
  font-family:var(--ck-font-head);font-weight:700;color:var(--ck-navy);
  font-size:clamp(1.3rem,2.6vw,1.9rem);margin:0;
}
.ck-breadcrumb{display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--ck-text-light);flex-wrap:wrap;}
.ck-breadcrumb a{color:var(--ck-blue-dark);text-decoration:none;font-weight:600;}
.ck-breadcrumb a:hover{color:var(--ck-green-dark);}
.ck-breadcrumb svg{width:12px;height:12px;color:var(--ck-text-light);flex-shrink:0;}
.ck-breadcrumb span.current{color:var(--ck-navy);font-weight:700;}

/* ============================================================
   LAYOUT
   ============================================================ */
.ck-layout{display:grid;grid-template-columns:1fr 360px;gap:24px;align-items:start;padding-bottom:56px;width:100%;}
.ck-card{background:#fff;border:1.5px solid var(--ck-border);border-radius:16px;box-shadow:0 8px 26px rgba(14,35,88,.05);overflow:hidden;min-width:0;}

/* ============================================================
   FORM PANEL
   ============================================================ */
.ck-form-card{padding:32px 34px;min-width:0;}
.ck-panel-head{display:flex;align-items:flex-start;gap:12px;margin-bottom:26px;}
.ck-panel-head-icon{
  width:36px;height:36px;border-radius:50%;flex-shrink:0;background:var(--ck-bg-soft);
  border:1.5px solid var(--ck-border);display:flex;align-items:center;justify-content:center;color:var(--ck-navy);
  margin-top:1px;
}
.ck-panel-head-icon svg{width:16px;height:16px;}
.ck-panel-head h2{font-family:var(--ck-font-head);font-weight:700;color:var(--ck-navy);font-size:1.15rem;margin:0 0 4px;}
.ck-panel-head p{font-size:.84rem;color:var(--ck-text-light);margin:0;}

.ck-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px 20px;margin-bottom:20px;}
.ck-fg{display:flex;flex-direction:column;gap:7px;min-width:0;}
.ck-fg-full{grid-column:1 / -1;}
.ck-fg label{font-size:.82rem;font-weight:700;color:var(--ck-text);}
.ck-fg label .req{color:var(--ck-red);}
.ck-fg label .opt{color:var(--ck-text-light);font-weight:500;}
.ck-fg input,.ck-fg select,.ck-fg textarea{
  width:100%;max-width:100%;padding:12px 14px;border:1.5px solid var(--ck-border);border-radius:9px;
  font-family:var(--ck-font-body);font-size:.86rem;color:var(--ck-text);background:var(--ck-bg-soft);outline:none;
  transition:border-color .2s,box-shadow .2s,background .2s;-webkit-appearance:none;appearance:none;
}
.ck-fg select{
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='7'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236b7c8f' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:right 14px center;padding-right:32px;
}
.ck-fg input:focus,.ck-fg select:focus,.ck-fg textarea:focus{border-color:var(--ck-blue);background:#fff;box-shadow:0 0 0 3px rgba(28,117,188,.10);}
.ck-fg input.ck-error,.ck-fg select.ck-error,.ck-fg textarea.ck-error{border-color:var(--ck-red);box-shadow:0 0 0 3px rgba(192,57,43,.08);}
.ck-fg input::placeholder,.ck-fg textarea::placeholder{color:#9aa8b8;}
.ck-hint{font-size:.72rem;color:var(--ck-text-light);}

.ck-check{display:flex;align-items:center;gap:10px;font-size:.84rem;color:var(--ck-text);margin-bottom:26px;cursor:pointer;}
.ck-check input{width:18px;height:18px;accent-color:var(--ck-green-dark);flex-shrink:0;cursor:pointer;}

/* Feedback message: plain colored text only — no icon, no background,
   no border, no pill shape. Sits directly above the buttons. */
.ck-val-msg{
  display:none;
  background:none;border:none;padding:0;margin:0 0 14px;
  font-size:.82rem;font-weight:600;color:var(--ck-red);word-break:break-word;
}
.ck-val-msg.show{display:block;}

.ck-success-msg{
  display:none;
  background:var(--ck-bg-soft);border:1.5px solid var(--ck-border);border-left:4px solid var(--ck-green);
  border-radius:10px;padding:14px 16px;margin:0 0 14px;font-size:.84rem;color:var(--ck-text);line-height:1.6;
}
.ck-success-msg.show{display:block;}
.ck-success-msg strong{color:var(--ck-green-dark);}

/* Final action row */
.ck-final-btn-row{
  display:flex;flex-wrap:wrap;gap:14px;align-items:stretch;justify-content:flex-start;width:100%;
}
.ck-place-btn{
  display:flex;align-items:center;justify-content:center;gap:8px;flex:1 1 220px;max-width:280px;min-width:0;
  background:var(--ck-navy);color:#fff;border:none;cursor:pointer;
  padding:16px 20px;border-radius:9px;font-family:var(--ck-font-head);font-weight:600;font-size:.9rem;
  letter-spacing:.02em;transition:background .2s,transform .2s;white-space:nowrap;
  box-shadow:0 10px 22px rgba(14,35,88,.18);
}
.ck-place-btn:hover{background:var(--ck-blue-dark);transform:translateY(-1px);}
.ck-place-btn:disabled{opacity:.65;cursor:not-allowed;transform:none;}

.ck-wa-btn{
  display:flex;align-items:center;justify-content:center;gap:9px;flex:1 1 240px;max-width:320px;min-width:0;
  background:#25d366;color:#fff;text-decoration:none;border:none;cursor:pointer;
  padding:16px 18px;border-radius:9px;font-family:var(--ck-font-head);font-weight:700;font-size:.9rem;
  transition:background .2s,transform .2s;box-shadow:0 10px 22px rgba(37,211,102,.22);white-space:nowrap;
}
.ck-wa-btn:hover{background:#1ebe5a;transform:translateY(-1px);color:#fff;}
.ck-wa-btn svg{width:17px;height:17px;flex-shrink:0;}

/* ============================================================
   SIDEBAR
   ============================================================ */
.ck-sidebar{position:sticky;top:20px;display:flex;flex-direction:column;gap:16px;min-width:0;}
.ck-summary-head{display:flex;align-items:center;gap:9px;font-family:var(--ck-font-head);font-weight:700;color:var(--ck-navy);font-size:1rem;padding:22px 24px;border-bottom:1.5px solid var(--ck-border);}
.ck-summary-head svg{width:17px;height:17px;color:var(--ck-navy);flex-shrink:0;}

.ck-order-table-wrap{width:100%;max-width:100%;overflow-x:auto;-webkit-overflow-scrolling:touch;}

.ck-sidebar table.woocommerce-checkout-review-order-table{width:100%;max-width:100%;table-layout:fixed;border-collapse:collapse;margin:0;}
.ck-sidebar table.woocommerce-checkout-review-order-table thead{display:none;}
.ck-sidebar table.woocommerce-checkout-review-order-table td,
.ck-sidebar table.woocommerce-checkout-review-order-table th{
  border:none;border-bottom:1px solid var(--ck-border);padding:15px 24px;font-size:.84rem;vertical-align:middle;
  word-break:break-word;overflow-wrap:break-word;white-space:normal;
}
.ck-sidebar .product-name{color:var(--ck-text);font-weight:600;word-break:break-word;}
.ck-sidebar .product-name .product-quantity{color:var(--ck-text-light);font-weight:500;display:block;font-size:.76rem;margin-top:2px;}
.ck-sidebar .product-total{white-space:nowrap;}
.ck-sidebar .product-total .amount{color:var(--ck-blue-dark)!important;font-weight:700!important;white-space:nowrap;}
.ck-item-row{display:flex;align-items:center;gap:12px;min-width:0;}
.ck-item-img{flex-shrink:0;width:44px;height:44px;border-radius:9px;border:1.5px solid var(--ck-border);background:var(--ck-bg-soft);display:flex;align-items:center;justify-content:center;overflow:hidden;}
.ck-item-thumb{width:100%!important;height:100%!important;object-fit:contain!important;}
.ck-item-text{flex:1;min-width:0;word-break:break-word;overflow-wrap:anywhere;}

.ck-sidebar tfoot th,.ck-sidebar tfoot td{color:var(--ck-text-light);font-weight:600;font-size:.84rem;}
.ck-sidebar tfoot .amount{color:var(--ck-text)!important;font-weight:700!important;}
.ck-sidebar tfoot tr.order-total th{font-family:var(--ck-font-head);font-weight:700;color:var(--ck-navy);font-size:1rem;border-bottom:none!important;padding-top:18px;}
.ck-sidebar tfoot tr.order-total .amount{font-family:var(--ck-font-head)!important;font-size:1.35rem!important;font-weight:700!important;color:var(--ck-green-dark)!important;}
.ck-sidebar tfoot tr:last-child th,.ck-sidebar tfoot tr:last-child td{border-bottom:none!important;}

/* Secure note: plain text, no pill/rounded background, no border. */
.ck-secure-note{
  display:flex;align-items:center;gap:9px;background:none;border:none;
  color:var(--ck-green-dark);padding:0 24px 22px;font-size:.8rem;font-weight:600;margin:0;
  flex-wrap:wrap;word-break:break-word;
}
.ck-secure-note svg{width:16px;height:16px;flex-shrink:0;}

/* Fades the form out once the order has been placed. */
.ck-form-faded .ck-card{opacity:.3;pointer-events:none;transition:opacity .4s;}
.ck-form-faded #ckActionsCard{opacity:1;pointer-events:auto;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1000px){
  :root{--ck-px:28px;}
  .ck-layout{grid-template-columns:1fr;}
  .ck-sidebar{position:static;}
}
@media(max-width:640px){
  :root{--ck-px:20px;}
  .ck-headrow{padding-top:22px;padding-bottom:18px;}
  .ck-title{font-size:1.25rem;}
  .ck-form-card{padding:22px 18px;}
  .ck-grid{grid-template-columns:1fr;}
  .ck-final-btn-row{flex-direction:column;align-items:stretch;}
  .ck-place-btn,.ck-wa-btn{flex:1 1 auto;max-width:100%;}
  .ck-sidebar table.woocommerce-checkout-review-order-table td,
  .ck-sidebar table.woocommerce-checkout-review-order-table th{padding:13px 16px;}
  .ck-secure-note{padding:0 16px 20px;}
}
</style>

<div class="ck-page">

  <div class="ck-wrap ck-headrow">
    <h1 class="ck-title">Checkout</h1>
    <nav class="ck-breadcrumb">
      <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg>
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">Cart</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="current">Checkout</span>
    </nav>
  </div>

  <?php if ( function_exists('WC') && WC()->cart && ! WC()->cart->is_empty() ) : ?>

  <div class="ck-wrap">
    <div class="ck-layout" id="ckLayout">

      <div class="ck-card ck-form-card" id="ckFormCard">
        <form id="ckForm" novalidate>

          <?php wp_nonce_field( 'leshavin_order_nonce', 'leshavin_order_nonce' ); ?>
          <input type="hidden" name="billing_first_name" id="billing_first_name" value="">
          <input type="hidden" name="billing_last_name" id="billing_last_name" value="">

          <div class="ck-panel-head">
            <div class="ck-panel-head-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <div>
              <h2>Shipping Information</h2>
              <p>Enter your details to get your order delivered</p>
            </div>
          </div>

          <div class="ck-grid">
            <div class="ck-fg" data-field="ck_full_name">
              <label>Full Name <span class="req">*</span></label>
              <input type="text" id="ck_full_name" placeholder="Enter your full name" autocomplete="name">
            </div>
            <div class="ck-fg" data-field="billing_phone">
              <label>Phone Number <span class="req">*</span></label>
              <input type="tel" name="billing_phone" id="billing_phone" placeholder="Enter your phone number" autocomplete="tel">
            </div>
            <div class="ck-fg" data-field="billing_email">
              <label>Email Address</label>
              <input type="email" name="billing_email" id="billing_email" placeholder="Enter your email address" autocomplete="email">
            </div>
            <div class="ck-fg" data-field="billing_state">
              <label>County <span class="req">*</span></label>
              <?php
              $ck_states = function_exists('WC') ? WC()->countries->get_states('KE') : [];
              if ( $ck_states ) : ?>
              <select name="billing_state" id="billing_state">
                <option value="">Select your county&hellip;</option>
                <?php foreach ( $ck_states as $ck_code => $ck_name ) : ?>
                  <option value="<?php echo esc_attr( $ck_code ); ?>"><?php echo esc_html( $ck_name ); ?></option>
                <?php endforeach; ?>
              </select>
              <?php else : ?>
              <input type="text" name="billing_state" id="billing_state" placeholder="County">
              <?php endif; ?>
            </div>
            <div class="ck-fg ck-fg-full" data-field="billing_address_1">
              <label>Delivery Address <span class="req">*</span></label>
              <textarea name="billing_address_1" id="billing_address_1" rows="2" placeholder="Enter your delivery address"></textarea>
              <div class="ck-hint">e.g. House/Apartment, Street, Area</div>
            </div>
            <div class="ck-fg" data-field="billing_city">
              <label>Town / City <span class="req">*</span></label>
              <input type="text" name="billing_city" id="billing_city" placeholder="Enter your town or city" autocomplete="address-level2">
            </div>
            <div class="ck-fg" data-field="billing_postcode">
              <label>Postal Code <span class="opt">(Optional)</span></label>
              <input type="text" name="billing_postcode" id="billing_postcode" placeholder="Enter postal code" autocomplete="postal-code">
            </div>
            <div class="ck-fg ck-fg-full" data-field="ck_order_notes">
              <label>Additional Notes <span class="opt">(Optional)</span></label>
              <textarea name="order_comments" id="ck_order_notes" rows="3" placeholder="e.g. Delivery instructions, preferred delivery time, or anything else we should know"></textarea>
              <div class="ck-hint">This is shared with our team along with your order.</div>
            </div>
          </div>

          <label class="ck-check">
            <input type="checkbox" id="ckSaveInfo" checked>
            <span>Save this information for faster checkout next time</span>
          </label>

          <!-- Feedback appears here, plain colored text (no icon), right above the buttons. -->
          <div class="ck-val-msg" id="ckValMsg"></div>
          <div class="ck-success-msg" id="ckSuccessMsg"></div>

          <div class="ck-final-btn-row" id="ckActionsCard">
            <button type="button" class="ck-place-btn" id="ckPlaceOrderBtn">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
              Place Order
            </button>
            <a href="#" id="ckWaBtn" class="ck-wa-btn">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              Order Via WhatsApp
            </a>
          </div>

        </form>
      </div>

      <!-- SIDEBAR -->
      <div class="ck-sidebar">
        <div class="ck-card">
          <div class="ck-summary-head">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
            Order Summary
          </div>
          <div class="ck-order-table-wrap" id="ckOrderTableWrap">
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
          </div>
          <div class="ck-secure-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Your personal data is secure and encrypted
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php else : ?>

  <div class="ck-wrap" style="padding-bottom:60px;">
    <div class="ck-card" style="padding:60px 20px;text-align:center;">
      <p style="font-size:.92rem;color:var(--ck-text-light);margin-bottom:18px;">Your cart is empty, so there's nothing to check out yet.</p>
      <a href="<?php echo esc_url( function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id('shop') ) : home_url('/shop') ); ?>" class="ck-btn-primary" style="display:inline-flex;width:auto;padding:13px 28px;background:var(--ck-navy);color:#fff;text-decoration:none;border-radius:9px;font-family:var(--ck-font-head);font-weight:600;">Browse Products</a>
    </div>
  </div>

  <?php endif; ?>

</div>

<script>
(function(){
  var waPhone   = '<?php echo esc_js( $ck_wa ); ?>';
  var AJAX_URL  = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';

  /* ── Universal, theme-agnostic safety net: hide ANY leftover
     breadcrumb/page-header element the theme injects above our
     content, regardless of what class name it uses, as long as it
     isn't part of our own .ck-page markup. ── */
  function killDuplicateBreadcrumbs(){
    var pattern = /breadcrumb|page-?title-?bar|page-?header/i;
    document.querySelectorAll('body *').forEach(function(el){
      if (el.closest('.ck-page')) return;
      var cls = (el.className && typeof el.className === 'string') ? el.className : '';
      var id = el.id || '';
      if (pattern.test(cls) || pattern.test(id)){
        el.style.display = 'none';
      }
    });
  }

  function val(id){ var el = document.getElementById(id); return el ? el.value.trim() : ''; }

  function splitName(){
    var full = val('ck_full_name');
    var parts = full.split(/\s+/).filter(Boolean);
    var fEl = document.getElementById('billing_first_name');
    var lEl = document.getElementById('billing_last_name');
    if (fEl) fEl.value = parts.shift() || '';
    if (lEl) lEl.value = parts.join(' ') || parts[0] || '';
  }

  function showMsg(text){
    var msg = document.getElementById('ckValMsg');
    if (!msg) return;
    msg.textContent = text;
    msg.classList.add('show');
    msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
  function clearMsg(){
    var msg = document.getElementById('ckValMsg');
    if (msg) msg.classList.remove('show');
  }

  function validateFields(){
    var required = ['ck_full_name','billing_phone','billing_state','billing_address_1','billing_city'];
    var missing = false;
    required.forEach(function(id){
      var wrap = document.querySelector('[data-field="'+id+'"]');
      var el = document.getElementById(id);
      if (!el) return;
      if (wrap) wrap.querySelector('input,select,textarea').classList.remove('ck-error');
      if (!el.value.trim()){
        missing = true;
        el.classList.add('ck-error');
      }
    });
    if (missing){
      showMsg('Please fill in all required fields before continuing.');
    } else {
      clearMsg();
    }
    return !missing;
  }

  /* Reads every item row already rendered in the order-summary sidebar
     (name, quantity, line total) so BOTH the WhatsApp message and the
     server-side order use exactly what the customer sees on screen. */
  function collectCartLines(){
    var lines = [];
    document.querySelectorAll('.ck-sidebar .woocommerce-checkout-review-order-table tbody tr').forEach(function(row){
      var text = row.querySelector('.ck-item-text');
      var qty  = row.querySelector('.product-quantity');
      var total = row.querySelector('.product-total');
      if (text && total){
        lines.push({
          name: text.textContent.trim(),
          qty: qty ? qty.textContent.trim() : '',
          total: total.textContent.trim()
        });
      }
    });
    return lines;
  }

  function buildWaMessage(){
    var name = val('ck_full_name');
    var phone = val('billing_phone');
    var email = val('billing_email');
    var county = document.getElementById('billing_state');
    var countyText = county ? (county.options[county.selectedIndex] ? county.options[county.selectedIndex].text : '') : '';
    var address = val('billing_address_1');
    var city = val('billing_city');
    var postcode = val('billing_postcode');
    var notes = val('ck_order_notes');

    var lines = collectCartLines();
    var grand = document.querySelector('.ck-sidebar tfoot .order-total .amount');
    var grandText = grand ? grand.textContent.trim() : '';

    var msg = 'Hello Leshavin Pharmacy, I would like to place an order.\n\n';
    msg += 'Name: ' + name + '\nPhone: ' + phone + (email ? '\nEmail: ' + email : '') + '\n';
    msg += 'Delivery Address: ' + address + ', ' + city + ', ' + countyText + (postcode ? ' ' + postcode : '') + '\n\n';
    if (lines.length){
      msg += 'Order Items:\n';
      lines.forEach(function(l){ msg += '- ' + l.name + (l.qty ? ' (' + l.qty + ')' : '') + ': ' + l.total + '\n'; });
      msg += '\n';
    }
    if (grandText) msg += 'Total: ' + grandText + '\n\n';
    if (notes){ msg += 'Additional Notes: ' + notes + '\n\n'; }
    msg += 'Please confirm my order. Thank you.';
    return msg;
  }

  /* Sends the order to the server so it's saved as a real WooCommerce
     order — regardless of whether the customer used "Place Order" or
     "Order Via WhatsApp". No payment method is collected; the order
     is created "pay on delivery" server-side, and the cart is always
     emptied on the server as part of this call. */
  function sendOrderToServer(via, onDone){
    var form = document.getElementById('ckForm');
    var fd = new FormData(form);
    fd.append('action', 'leshavin_send_order');
    fd.append('order_via', via || 'website');
    fetch(AJAX_URL, { method: 'POST', body: fd })
      .then(function(r){ return r.json(); })
      .then(function(res){ if (onDone) onDone(res); })
      .catch(function(){ if (onDone) onDone(null); });
  }

  function showOrderSuccess(orderId){
    var successEl = document.getElementById('ckSuccessMsg');
    if (successEl){
      successEl.innerHTML = '<strong>Order placed' + (orderId ? ' #' + orderId : '') + '!</strong> Our pharmacist will confirm your order shortly. For urgent matters, WhatsApp us on <a href="https://wa.me/' + waPhone + '" target="_blank" style="color:inherit;font-weight:800;">' + waPhone + '</a>.';
      successEl.classList.add('show');
      successEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    clearMsg();

    var layout = document.getElementById('ckLayout');
    if (layout) layout.classList.add('ck-form-faded');

    var tbody = document.querySelector('.ck-sidebar .woocommerce-checkout-review-order-table tbody');
    if (tbody) tbody.innerHTML = '<tr><td colspan="2" style="padding:15px 24px;text-align:center;color:var(--ck-text-light);font-size:.82rem;">Cart cleared</td></tr>';
    var totCell = document.querySelector('.ck-sidebar tfoot .order-total .amount');
    if (totCell) totCell.textContent = 'KSh 0.00';

    var placeBtn = document.getElementById('ckPlaceOrderBtn');
    if (placeBtn){ placeBtn.disabled = true; placeBtn.innerHTML = 'Order Placed'; }

    // Immediately tell WooCommerce's own cart-fragments script (if loaded)
    // to refresh the header mini-cart, so the cart icon count/total in
    // the site header updates right away instead of staying stale.
    if (window.jQuery) {
      try { window.jQuery(document.body).trigger('wc_fragment_refresh'); } catch (e) {}
    }

    // Fully reload the page shortly after, so the cart, header, form,
    // and nonce are all guaranteed fresh for the next order — this is
    // the most reliable way to get the page fully back to its normal
    // active state, rather than trying to patch every bit of UI by hand.
    setTimeout(function(){
      window.location.reload();
    }, 1800);
  }

  function handlePlaceOrder(){
    splitName();
    if (!validateFields()) return;
    var btn = document.getElementById('ckPlaceOrderBtn');
    var original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = 'Placing Order&hellip;';
    sendOrderToServer('website', function(res){
      btn.disabled = false;
      btn.innerHTML = original;
      if (res && res.success){
        showOrderSuccess(res.data && res.data.order_id ? res.data.order_id : null);
      } else {
        var msg = (res && res.data && res.data.msg) ? res.data.msg : 'Something went wrong. Please try again or order via WhatsApp.';
        showMsg(msg);
      }
    });
  }

  function handleWaOrder(){
    splitName();
    if (!validateFields()) return;
    window.open('https://wa.me/' + waPhone + '?text=' + encodeURIComponent(buildWaMessage()), '_blank');
    // Save the order and empty the cart in the background too, so
    // WhatsApp orders also land in WooCommerce and the pharmacy inbox —
    // the customer isn't blocked waiting on this. No confirmation email
    // is sent for this path (see functions.php); the WhatsApp chat is
    // the customer's confirmation.
    sendOrderToServer('whatsapp', function(res){
      if (res && res.success){
        showOrderSuccess(res.data && res.data.order_id ? res.data.order_id : null);
      }
    });
  }

  document.addEventListener('DOMContentLoaded', function(){
    killDuplicateBreadcrumbs();

    var placeBtn = document.getElementById('ckPlaceOrderBtn');
    if (placeBtn) placeBtn.addEventListener('click', handlePlaceOrder);

    var waBtn = document.getElementById('ckWaBtn');
    if (waBtn) waBtn.addEventListener('click', function(e){
      e.preventDefault();
      handleWaOrder();
    });
  });

})();
</script>

<?php get_footer(); ?>