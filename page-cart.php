<?php
/**
 * Template Name: Cart
 * Leshavin Pharmacy - page-cart.php
 */

// Belt-and-braces: clear any WooCommerce notices (e.g. "X removed. Undo?")
// queued in the session before this page renders, since we use our own
// custom feedback and never want WooCommerce's default notices showing here.
if ( function_exists( 'wc_clear_notices' ) ) {
    wc_clear_notices();
}

get_header();
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

/* Local safety net: hide any WooCommerce default notice markup that might
   still render on this page (add-to-cart / removed / undo / stock notices),
   independent of the global suppression in functions.php. */
.woocommerce-message,
.woocommerce-error,
.woocommerce-info,
.woocommerce-notices-wrapper {
    display: none !important;
}

:root{
  --cp-navy:#0e2358;
  --cp-blue:#1c75bc;
  --cp-blue-dark:#125a94;
  --cp-green:#8dc63f;
  --cp-green-dark:#6ea82e;
  --cp-red:#c0392b;
  --cp-text:#1c2b3a;
  --cp-text-light:#6b7c8f;
  --cp-border:#e4e9ef;
  --cp-bg-soft:#f7f9fb;
  --cp-font-head:'Oswald',Arial Narrow,sans-serif;
  --cp-font-body:'Inter',sans-serif;
  --cp-px:40px;
}
.cp-page{font-family:var(--cp-font-body);color:var(--cp-text);background:#fff;overflow-x:hidden;}
.cp-wrap{max-width:1280px;margin:0 auto;padding:0 var(--cp-px);}

/* ============================================================
   PAGE HEAD
   Margin fix: matches the checkout page's headrow — more generous,
   balanced top/bottom padding so the title/breadcrumb row breathes
   evenly against the site header above it and the card below it.
   ============================================================ */
.cp-headrow{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;
  padding-top:38px;padding-bottom:34px;
}
.cp-title{
  font-family:var(--cp-font-head);font-weight:700;color:var(--cp-navy);
  font-size:clamp(1.3rem,2.6vw,1.9rem);margin:0;
}
.cp-breadcrumb{display:flex;align-items:center;gap:8px;font-size:.82rem;color:var(--cp-text-light);}
.cp-breadcrumb a{color:var(--cp-blue-dark);text-decoration:none;font-weight:600;}
.cp-breadcrumb a:hover{color:var(--cp-green-dark);}
.cp-breadcrumb svg{width:12px;height:12px;color:var(--cp-text-light);flex-shrink:0;}
.cp-breadcrumb span.current{color:var(--cp-navy);font-weight:700;}

/* ============================================================
   LAYOUT
   ============================================================ */
.cp-layout{display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start;padding-bottom:44px;}

.cp-card{
  background:#fff;border:1.5px solid var(--cp-border);border-radius:14px;
  box-shadow:0 6px 22px rgba(14,35,88,.05);overflow:hidden;
}

/* ============================================================
   DESKTOP TABLE
   ============================================================ */
.cp-table-wrap{overflow-x:auto;-webkit-overflow-scrolling:touch;}
table.cp-table{width:100%;border-collapse:collapse;min-width:560px;}
table.cp-table thead th{
  background:var(--cp-bg-soft);border-bottom:2px solid var(--cp-border);
  padding:16px 20px;text-align:left;font-family:var(--cp-font-head);font-weight:600;
  font-size:.74rem;letter-spacing:.06em;text-transform:uppercase;color:var(--cp-text-light);
  white-space:nowrap;
}
table.cp-table thead th.cp-col-action{text-align:center;width:70px;}
table.cp-table thead th.cp-col-qty{width:140px;}
table.cp-table tbody td{
  padding:18px 20px;border-bottom:1px solid var(--cp-border);vertical-align:middle;font-size:.86rem;
}
table.cp-table tbody tr:last-child td{border-bottom:none;}

.cp-prod-cell{display:flex;align-items:center;gap:14px;}
.cp-prod-thumb{
  width:56px;height:56px;flex-shrink:0;border-radius:10px;border:1.5px solid var(--cp-border);
  background:var(--cp-bg-soft);padding:4px;display:flex;align-items:center;justify-content:center;overflow:hidden;
}
.cp-prod-thumb img{width:100%;height:100%;object-fit:contain;display:block;}
.cp-prod-name{font-family:var(--cp-font-body);font-weight:700;font-size:.9rem;color:var(--cp-navy);text-decoration:none;line-height:1.4;display:block;}
.cp-prod-name:hover{color:var(--cp-blue-dark);}
.cp-prod-cat{font-size:.76rem;color:var(--cp-text-light);margin-top:2px;}

.cp-price .amount,
.cp-subtotal .amount{font-weight:800 !important;color:var(--cp-blue-dark) !important;font-size:.9rem !important;}

.cp-action-cell{text-align:center;}
.cp-remove-btn{
  display:inline-flex;align-items:center;justify-content:center;
  width:34px;height:34px;border-radius:9px;background:var(--cp-bg-soft);
  border:1.5px solid var(--cp-border);color:var(--cp-text-light);
  text-decoration:none;transition:background .18s,color .18s,border-color .18s;
}
.cp-remove-btn svg{width:15px;height:15px;}
.cp-remove-btn:hover{background:#fbeceb;color:var(--cp-red);border-color:#e8b6b0;}

/* Qty stepper */
.cp-qty-wrap{
  display:inline-flex;align-items:center;border:1.5px solid var(--cp-border);border-radius:9px;overflow:hidden;background:#fff;
}
.cp-qty-btn{
  width:32px;height:36px;border:none;background:var(--cp-bg-soft);color:var(--cp-blue-dark);
  font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;
  transition:background .18s,color .18s;flex-shrink:0;line-height:1;padding:0;
}
.cp-qty-btn:hover{background:var(--cp-blue-dark);color:#fff;}
.cp-qty-btn:disabled{opacity:.4;cursor:not-allowed;background:var(--cp-bg-soft) !important;color:var(--cp-border) !important;}
.cp-qty-wrap input.qty{
  width:44px !important;height:36px !important;border:none !important;border-left:1.5px solid var(--cp-border) !important;
  border-right:1.5px solid var(--cp-border) !important;text-align:center;font-family:var(--cp-font-body);
  font-size:.86rem;font-weight:700;color:var(--cp-text);background:#fff;padding:0 !important;outline:none !important;
  -moz-appearance:textfield;box-shadow:none !important;border-radius:0 !important;
}
.cp-qty-wrap input.qty::-webkit-outer-spin-button,
.cp-qty-wrap input.qty::-webkit-inner-spin-button{-webkit-appearance:none;margin:0;}

/* Continue shopping row */
.cp-continue-row{padding:18px 20px;border-top:2px solid var(--cp-border);background:var(--cp-bg-soft);}
.cp-continue{
  display:inline-flex;align-items:center;gap:8px;color:var(--cp-blue-dark);text-decoration:none;
  font-family:var(--cp-font-head);font-weight:600;font-size:.82rem;text-transform:uppercase;letter-spacing:.02em;
}
.cp-continue svg{width:14px;height:14px;}
.cp-continue:hover{color:var(--cp-green-dark);}

/* ============================================================
   MOBILE CARD LIST (hidden on desktop)
   ============================================================ */
.cp-mobile-list{display:none;}
.cp-mitem{display:flex;gap:12px;padding:16px 18px;border-bottom:1px solid var(--cp-border);position:relative;}
.cp-mitem:last-child{border-bottom:none;}
.cp-mitem .cp-prod-thumb{width:56px;height:56px;}
.cp-mitem-info{flex:1;min-width:0;padding-right:32px;}
.cp-mitem-name{font-family:var(--cp-font-body);font-weight:700;font-size:.86rem;color:var(--cp-navy);text-decoration:none;display:block;line-height:1.4;}
.cp-mitem-cat{font-size:.72rem;color:var(--cp-text-light);margin:2px 0 6px;}
.cp-mitem-price{font-size:.78rem;color:var(--cp-text-light);margin-bottom:10px;}
.cp-mitem-price .amount{color:var(--cp-blue-dark) !important;font-weight:800 !important;}
.cp-mitem-bottom{display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;}
.cp-mitem-subtotal{font-size:.82rem;font-weight:800;color:var(--cp-text);}
.cp-mitem-subtotal .amount{color:var(--cp-blue-dark) !important;}
.cp-mitem-remove{position:absolute;top:14px;right:16px;}

/* ============================================================
   EMPTY CART
   ============================================================ */
.cp-empty{text-align:center;padding:clamp(40px,8vw,72px) 20px;}
.cp-empty-icon{
  width:68px;height:68px;border-radius:50%;background:var(--cp-bg-soft);border:1.5px solid var(--cp-border);
  display:flex;align-items:center;justify-content:center;margin:0 auto 18px;color:var(--cp-blue-dark);
}
.cp-empty-icon svg{width:28px;height:28px;}
.cp-empty h3{font-family:var(--cp-font-head);font-weight:700;font-size:1.15rem;color:var(--cp-navy);text-transform:uppercase;margin:0 0 8px;}
.cp-empty p{font-size:.86rem;color:var(--cp-text-light);margin:0 0 22px;}
.cp-empty-btn{
  display:inline-flex;align-items:center;gap:8px;background:var(--cp-green-dark);color:#fff;
  padding:13px 28px;border-radius:6px;font-family:var(--cp-font-head);font-weight:600;font-size:.82rem;
  text-transform:uppercase;letter-spacing:.03em;text-decoration:none;transition:background .18s,transform .18s;
}
.cp-empty-btn:hover{background:#5b8e26;transform:translateY(-2px);}
.cp-empty-btn svg{width:14px;height:14px;}

/* ============================================================
   ORDER SUMMARY SIDEBAR
   ============================================================ */
.cp-sidebar{position:sticky;top:20px;}
.cp-summary-head{font-family:var(--cp-font-head);font-weight:700;color:var(--cp-navy);font-size:1.02rem;text-transform:uppercase;padding:20px 22px;border-bottom:2px solid var(--cp-border);}
.cp-summary-body{padding:18px 22px;}
.cp-summary-row{display:flex;align-items:center;justify-content:space-between;gap:10px;font-size:.86rem;padding:9px 0;}
.cp-summary-row span:first-child{color:var(--cp-text-light);}
.cp-summary-row span:last-child{color:var(--cp-text);font-weight:700;}
.cp-summary-row .amount{color:var(--cp-text) !important;font-weight:700 !important;}
.cp-summary-divider{height:1px;background:var(--cp-border);margin:8px 0;}
.cp-summary-total{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:10px 0 4px;}
.cp-summary-total span:first-child{font-family:var(--cp-font-head);font-weight:700;color:var(--cp-navy);font-size:.96rem;text-transform:uppercase;}
.cp-summary-total span:last-child,
.cp-summary-total .amount{font-family:var(--cp-font-head) !important;font-weight:700 !important;color:var(--cp-navy) !important;font-size:1.25rem !important;}

.cp-checkout-wrap{padding:0 22px 22px;}
.cp-checkout-btn{
  display:flex;align-items:center;justify-content:center;gap:9px;width:100%;
  background:var(--cp-green-dark);color:#fff;border:none;cursor:pointer;
  padding:15px 18px;border-radius:8px;font-family:var(--cp-font-head);font-weight:700;font-size:.9rem;
  text-transform:uppercase;letter-spacing:.02em;transition:background .2s,transform .2s;
  box-shadow:0 10px 24px rgba(110,168,46,.28);
}
.cp-checkout-btn:hover{background:#5b8e26;transform:translateY(-2px);}
.cp-checkout-btn svg{width:16px;height:16px;}
.cp-checkout-btn:disabled{opacity:.7;cursor:wait;transform:none;}
.cp-secure{display:flex;align-items:center;justify-content:center;gap:6px;font-size:.72rem;color:var(--cp-text-light);padding:0 22px 20px;}
.cp-secure svg{width:12px;height:12px;flex-shrink:0;}

/* ============================================================
   TRUST STRIP
   ============================================================ */
.cp-trust-wrap{padding-bottom:56px;}
.cp-trust{
  background:#fff;border:1.5px solid var(--cp-border);border-radius:14px;
  padding:26px var(--cp-px);display:grid;grid-template-columns:repeat(4,1fr);gap:26px;
  box-shadow:0 10px 28px rgba(14,35,88,.06);
}
.cp-trust-item{display:flex;align-items:center;gap:13px;}
.cp-trust-icon{
  width:44px;height:44px;border-radius:50%;flex-shrink:0;background:var(--cp-bg-soft);border:1.5px solid var(--cp-border);
  display:flex;align-items:center;justify-content:center;color:var(--cp-blue-dark);
}
.cp-trust-icon svg{width:19px;height:19px;}
.cp-trust-title{font-family:var(--cp-font-head);font-weight:600;font-size:.85rem;color:var(--cp-text);}
.cp-trust-sub{font-size:.78rem;color:var(--cp-text-light);line-height:1.5;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1000px){
  :root{--cp-px:28px;}
  .cp-layout{grid-template-columns:1fr;}
  .cp-sidebar{position:static;}
  .cp-trust{grid-template-columns:1fr 1fr;}
}
@media(max-width:640px){
  :root{--cp-px:18px;}
  /* Margin fix: mobile headrow gets checkout-matching, slightly more
     generous padding so the title/breadcrumb row isn't crowded
     against the search bar above or the card below. */
  .cp-headrow{padding-top:24px;padding-bottom:26px;}
  .cp-title{font-size:1.25rem;}
  table.cp-table.cp-desktop-only{display:none;}
  .cp-mobile-list{display:block;}
  .cp-trust{grid-template-columns:1fr;padding:20px;gap:18px;}
  .cp-summary-total span:last-child,
  .cp-summary-total .amount{font-size:1.1rem !important;}
}
</style>

<div class="cp-page">

  <div class="cp-wrap cp-headrow">
    <h1 class="cp-title">Your Cart</h1>
    <nav class="cp-breadcrumb">
      <a href="<?php echo esc_url( home_url('/') ); ?>">Home</a>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="9 18 15 12 9 6"/></svg>
      <span class="current">Cart</span>
    </nav>
  </div>

  <div class="cp-wrap">
    <div class="cp-layout">

      <!-- ITEMS -->
      <div class="cp-card">
        <?php if ( function_exists('WC') && WC()->cart && ! WC()->cart->is_empty() ) :
          $cp_cart_items = WC()->cart->get_cart();
        ?>

        <form id="cpCartForm" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
          <?php do_action('woocommerce_before_cart_contents'); ?>
          <?php wp_nonce_field('woocommerce-cart','woocommerce-cart-nonce'); ?>

          <!-- DESKTOP TABLE -->
          <div class="cp-table-wrap">
            <table class="cp-table cp-desktop-only">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th class="cp-col-qty">Quantity</th>
                  <th>Subtotal</th>
                  <th class="cp-col-action">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $cp_cart_items as $cp_key => $cp_item ) :
                  $cp_product = apply_filters( 'woocommerce_cart_item_product', $cp_item['data'], $cp_item, $cp_key );
                  $cp_pid     = apply_filters( 'woocommerce_cart_item_product_id', $cp_item['product_id'], $cp_item, $cp_key );
                  if ( ! $cp_product || ! $cp_product->exists() || $cp_item['quantity'] <= 0 ) continue;
                  if ( ! apply_filters( 'woocommerce_cart_item_visible', true, $cp_item, $cp_key ) ) continue;
                  $cp_permalink = apply_filters( 'woocommerce_cart_item_permalink', $cp_product->is_visible() ? $cp_product->get_permalink( $cp_item ) : '', $cp_item, $cp_key );
                  $cp_cat_terms = get_the_terms( $cp_pid, 'product_cat' );
                  $cp_cat_name  = ( $cp_cat_terms && ! is_wp_error( $cp_cat_terms ) && count( $cp_cat_terms ) ) ? $cp_cat_terms[0]->name : '';
                  $cp_min = $cp_product->is_sold_individually() ? 1 : 0;
                  $cp_max = $cp_product->is_sold_individually() ? 1 : $cp_product->get_max_purchase_quantity();
                ?>
                <tr data-key="<?php echo esc_attr( $cp_key ); ?>" data-price="<?php echo esc_attr( (float) $cp_product->get_price() ); ?>">
                  <td>
                    <div class="cp-prod-cell">
                      <div class="cp-prod-thumb">
                        <?php echo $cp_product->get_image( 'thumbnail' ); ?>
                      </div>
                      <div>
                        <?php if ( $cp_permalink ) : ?>
                          <a href="<?php echo esc_url( $cp_permalink ); ?>" class="cp-prod-name"><?php echo wp_kses_post( $cp_product->get_name() ); ?></a>
                        <?php else : ?>
                          <span class="cp-prod-name"><?php echo wp_kses_post( $cp_product->get_name() ); ?></span>
                        <?php endif; ?>
                        <?php if ( $cp_cat_name ) : ?><div class="cp-prod-cat"><?php echo esc_html( $cp_cat_name ); ?></div><?php endif; ?>
                      </div>
                    </div>
                  </td>
                  <td class="cp-price"><?php echo WC()->cart->get_product_price( $cp_product ); ?></td>
                  <td>
                    <?php echo woocommerce_quantity_input([
                      'input_name'  => "cart[{$cp_key}][qty]",
                      'input_value' => $cp_item['quantity'],
                      'max_value'   => $cp_max,
                      'min_value'   => $cp_min,
                    ], $cp_product, false ); ?>
                  </td>
                  <td class="cp-subtotal"><?php echo WC()->cart->get_product_subtotal( $cp_product, $cp_item['quantity'] ); ?></td>
                  <td class="cp-action-cell">
                    <a href="<?php echo esc_url( wc_get_cart_remove_url( $cp_key ) ); ?>" class="cp-remove-btn" aria-label="Remove this item" data-product_id="<?php echo esc_attr( $cp_pid ); ?>">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php do_action('woocommerce_after_cart_contents'); ?>

          <!-- MOBILE LIST -->
          <div class="cp-mobile-list">
            <?php foreach ( $cp_cart_items as $cp_key => $cp_item ) :
              $cp_product = apply_filters( 'woocommerce_cart_item_product', $cp_item['data'], $cp_item, $cp_key );
              $cp_pid     = apply_filters( 'woocommerce_cart_item_product_id', $cp_item['product_id'], $cp_item, $cp_key );
              if ( ! $cp_product || ! $cp_product->exists() || $cp_item['quantity'] <= 0 ) continue;
              $cp_permalink = apply_filters( 'woocommerce_cart_item_permalink', $cp_product->is_visible() ? $cp_product->get_permalink( $cp_item ) : '', $cp_item, $cp_key );
              $cp_cat_terms = get_the_terms( $cp_pid, 'product_cat' );
              $cp_cat_name  = ( $cp_cat_terms && ! is_wp_error( $cp_cat_terms ) && count( $cp_cat_terms ) ) ? $cp_cat_terms[0]->name : '';
              $cp_min = $cp_product->is_sold_individually() ? 1 : 0;
              $cp_max = $cp_product->is_sold_individually() ? 1 : $cp_product->get_max_purchase_quantity();
            ?>
            <div class="cp-mitem" data-key="<?php echo esc_attr( $cp_key ); ?>" data-price="<?php echo esc_attr( (float) $cp_product->get_price() ); ?>">
              <a href="<?php echo esc_url( wc_get_cart_remove_url( $cp_key ) ); ?>" class="cp-remove-btn cp-mitem-remove" aria-label="Remove this item" data-product_id="<?php echo esc_attr( $cp_pid ); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6m5 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
              </a>
              <div class="cp-prod-thumb"><?php echo $cp_product->get_image( 'thumbnail' ); ?></div>
              <div class="cp-mitem-info">
                <?php if ( $cp_permalink ) : ?>
                  <a href="<?php echo esc_url( $cp_permalink ); ?>" class="cp-mitem-name"><?php echo wp_kses_post( $cp_product->get_name() ); ?></a>
                <?php else : ?>
                  <span class="cp-mitem-name"><?php echo wp_kses_post( $cp_product->get_name() ); ?></span>
                <?php endif; ?>
                <?php if ( $cp_cat_name ) : ?><div class="cp-mitem-cat"><?php echo esc_html( $cp_cat_name ); ?></div><?php endif; ?>
                <div class="cp-mitem-price"><?php echo WC()->cart->get_product_price( $cp_product ); ?></div>
                <div class="cp-mitem-bottom">
                  <?php echo woocommerce_quantity_input([
                    'input_name'  => "cart[{$cp_key}][qty]",
                    'input_value' => $cp_item['quantity'],
                    'max_value'   => $cp_max,
                    'min_value'   => $cp_min,
                  ], $cp_product, false ); ?>
                  <div class="cp-mitem-subtotal"><?php echo WC()->cart->get_product_subtotal( $cp_product, $cp_item['quantity'] ); ?></div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="cp-continue-row">
            <a href="<?php echo esc_url( function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id('shop') ) : home_url('/shop') ); ?>" class="cp-continue">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
              Continue Shopping
            </a>
          </div>
        </form>

        <?php else : ?>

        <div class="cp-empty">
          <div class="cp-empty-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
          </div>
          <h3>Your Cart Is Empty</h3>
          <p>You haven't added anything to your cart yet.</p>
          <a href="<?php echo esc_url( function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id('shop') ) : home_url('/shop') ); ?>" class="cp-empty-btn">
            Start Shopping
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>

        <?php endif; ?>
      </div>

      <!-- ORDER SUMMARY -->
      <?php if ( function_exists('WC') && WC()->cart && ! WC()->cart->is_empty() ) : ?>
      <div class="cp-sidebar">
        <div class="cp-card">
          <div class="cp-summary-head">Order Summary</div>
          <div class="cp-summary-body">
            <div class="cp-summary-row">
              <span>Subtotal (<?php echo intval( WC()->cart->get_cart_contents_count() ); ?> item<?php echo WC()->cart->get_cart_contents_count() != 1 ? 's' : ''; ?>)</span>
              <span><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>
            <?php foreach ( WC()->cart->get_fees() as $cp_fee ) : ?>
            <div class="cp-summary-row">
              <span><?php echo esc_html( $cp_fee->name ); ?></span>
              <span><?php wc_cart_totals_fee_html( $cp_fee ); ?></span>
            </div>
            <?php endforeach; ?>
            <?php if ( WC()->cart->needs_shipping() ) : ?>
            <div class="cp-summary-row">
              <span>Delivery Fee</span>
              <span><?php WC()->cart->show_shipping() ? wc_cart_totals_shipping_html() : print( 'Calculated at checkout' ); ?></span>
            </div>
            <?php endif; ?>
            <?php foreach ( WC()->cart->get_coupons() as $cp_code => $cp_coupon ) : ?>
            <div class="cp-summary-row">
              <span><?php wc_cart_totals_coupon_label( $cp_coupon ); ?></span>
              <span><?php wc_cart_totals_coupon_html( $cp_coupon ); ?></span>
            </div>
            <?php endforeach; ?>
            <div class="cp-summary-divider"></div>
            <div class="cp-summary-total">
              <span>Total</span>
              <span><?php wc_cart_totals_order_total_html(); ?></span>
            </div>
          </div>
          <div class="cp-checkout-wrap">
            <button type="button" class="cp-checkout-btn" id="cpCheckoutBtn" data-checkout-url="<?php echo esc_url( wc_get_checkout_url() ); ?>">
              Proceed to Checkout
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
          <div class="cp-secure">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Secure Checkout
          </div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </div>

  <!-- TRUST STRIP -->
  <div class="cp-wrap cp-trust-wrap">
    <div class="cp-trust">
      <div class="cp-trust-item">
        <div class="cp-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
        <div><div class="cp-trust-title">100% Authentic Products</div><div class="cp-trust-sub">We guarantee genuine and high-quality products.</div></div>
      </div>
      <div class="cp-trust-item">
        <div class="cp-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
        <div><div class="cp-trust-title">Fast Delivery</div><div class="cp-trust-sub">Get your medicines delivered fast to your doorstep.</div></div>
      </div>
      <div class="cp-trust-item">
        <div class="cp-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/></svg></div>
        <div><div class="cp-trust-title">Expert Support</div><div class="cp-trust-sub">Our team is always here to assist you.</div></div>
      </div>
      <div class="cp-trust-item">
        <div class="cp-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
        <div><div class="cp-trust-title">Secure Shopping</div><div class="cp-trust-sub">Your data and payments are always protected.</div></div>
      </div>
    </div>
  </div>

</div>

<script>
(function(){

  function formatAmount(num){
    return num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  function writeAmount(el, amount){
    if (!el) return;
    var bdi = el.querySelector('bdi');
    if (!bdi) return;
    var symEl = bdi.querySelector('.woocommerce-Price-currencySymbol');
    var symHtml = symEl ? symEl.outerHTML : '<span class="woocommerce-Price-currencySymbol">KSh</span>';
    bdi.innerHTML = symHtml + formatAmount(amount);
  }

  function recalc(){
    var grand = 0;
    document.querySelectorAll('tr[data-key][data-price]').forEach(function(row){
      var price = parseFloat(row.getAttribute('data-price')) || 0;
      var input = row.querySelector('.quantity input.qty');
      var qty = input ? (parseFloat(input.value) || 0) : 0;
      var sub = price * qty;
      grand += sub;
      writeAmount(row.querySelector('.cp-subtotal'), sub);
    });
    document.querySelectorAll('.cp-mitem[data-key][data-price]').forEach(function(card){
      var price = parseFloat(card.getAttribute('data-price')) || 0;
      var input = card.querySelector('.quantity input.qty');
      var qty = input ? (parseFloat(input.value) || 0) : 0;
      var sub = price * qty;
      writeAmount(card.querySelector('.cp-mitem-subtotal'), sub);
    });
    writeAmount(document.querySelector('.cp-summary-row span:last-child'), grand);
    writeAmount(document.querySelector('.cp-summary-total span:last-child'), grand);
  }

  var syncTimer = null;
  var pendingSync = false;

  function syncToServer(){
    var form = document.getElementById('cpCartForm');
    if (!form) return;
    var data = new FormData(form);
    data.append('update_cart', 'Update cart');
    pendingSync = true;
    fetch(form.getAttribute('action'), { method:'POST', credentials:'same-origin', body:data })
      .catch(function(err){ console.warn('Cart sync failed:', err); })
      .finally(function(){ pendingSync = false; });
  }

  function queueSync(){
    clearTimeout(syncTimer);
    syncTimer = setTimeout(syncToServer, 700);
  }

  function syncPaired(source){
    document.querySelectorAll('.quantity input.qty[name="' + source.name + '"]').forEach(function(inp){
      if (inp !== source) inp.value = source.value;
    });
  }

  function buildStepper(input){
    if (input.closest('.cp-qty-wrap')) return;
    var min = parseFloat(input.getAttribute('min')) || 0;
    var max = parseFloat(input.getAttribute('max')) || 0;

    var wrap = document.createElement('div');
    wrap.className = 'cp-qty-wrap';

    var minus = document.createElement('button');
    minus.type = 'button'; minus.className = 'cp-qty-btn'; minus.innerHTML = '&#8722;';
    minus.setAttribute('aria-label','Decrease quantity');

    var plus = document.createElement('button');
    plus.type = 'button'; plus.className = 'cp-qty-btn'; plus.innerHTML = '&#43;';
    plus.setAttribute('aria-label','Increase quantity');

    input.parentNode.insertBefore(wrap, input);
    wrap.appendChild(minus);
    wrap.appendChild(input);
    wrap.appendChild(plus);

    function refresh(){
      var v = parseFloat(input.value) || 1;
      if (v < 1) { input.value = 1; v = 1; }
      minus.disabled = (v <= Math.max(min,1));
      plus.disabled  = (max > 0 && v >= max);
    }
    refresh();

    function onChange(){
      refresh();
      syncPaired(input);
      recalc();
      queueSync();
    }

    minus.addEventListener('click', function(){
      var v = parseFloat(input.value) || 1;
      if (v > Math.max(min,1)) { input.value = v - 1; onChange(); }
    });
    plus.addEventListener('click', function(){
      var v = parseFloat(input.value) || 1;
      if (!max || v < max) { input.value = v + 1; onChange(); }
    });
    input.addEventListener('input', function(){
      input.value = input.value.replace(/[^0-9]/g,'');
      onChange();
    });
    input.addEventListener('blur', function(){
      if (!input.value || parseInt(input.value,10) < 1) { input.value = 1; onChange(); }
    });
  }

  function bindRemove(){
    document.querySelectorAll('.cp-remove-btn').forEach(function(link){
      if (link.dataset.bound) return;
      link.dataset.bound = '1';
      link.addEventListener('click', function(e){
        e.preventDefault();
        var href = link.getAttribute('href');
        var row = link.closest('tr') || link.closest('.cp-mitem');
        if (row){
          row.style.transition = 'opacity .2s ease';
          row.style.opacity = '0';
        }
        link.style.pointerEvents = 'none';
        fetch(href, { method:'GET', credentials:'same-origin', headers:{'X-Requested-With':'XMLHttpRequest'} })
          .then(function(){ window.location.reload(); })
          .catch(function(){ window.location.href = href; });
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.quantity input.qty').forEach(buildStepper);
    bindRemove();
    recalc();

    // Extra safety net: strip any WooCommerce default notice elements that
    // might still be in the DOM after a remove/reload cycle.
    document.querySelectorAll(
      '.woocommerce-message, .woocommerce-error, .woocommerce-info, .woocommerce-notices-wrapper'
    ).forEach(function(el){ el.remove(); });

    var checkoutBtn = document.getElementById('cpCheckoutBtn');
    if (checkoutBtn){
      checkoutBtn.addEventListener('click', function(){
        var url = checkoutBtn.getAttribute('data-checkout-url');
        clearTimeout(syncTimer);
        if (!pendingSync){
          window.location.href = url;
          return;
        }
        checkoutBtn.disabled = true;
        checkoutBtn.textContent = 'One moment...';
        setTimeout(function(){ window.location.href = url; }, 500);
      });
    }
  });

})();
</script>

<?php get_footer(); ?>