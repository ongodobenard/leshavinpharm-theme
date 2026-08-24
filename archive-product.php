<?php get_header(); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --lp-blue:#1c75bc;
  --lp-blue-dark:#125a94;
  --lp-blue-pale:#eaf3fb;
  --lp-green:#8dc63f;
  --lp-green-dark:#6ea82e;
  --lp-green-pale:#f2f9e9;
  --lp-red:#e0433b;
  --lp-red-dark:#c53a33;
  --lp-wa:#25d366;
  --lp-wa-dark:#1ebe5a;
  --lp-name-hover:#8dc63f;
  --lp-text:#1c2b3a;
  --lp-text-light:#6b7c8f;
  --lp-border:#e4e9ef;
  --lp-font-head:'Oswald',Arial Narrow,sans-serif;
  --lp-font-body:'Inter',sans-serif;
}
body{font-family:var(--lp-font-body);overflow-x:hidden;}
.lp-wrap{width:100%;max-width:1280px;margin:0 auto;padding:0 40px;box-sizing:border-box;}

/* SHOP HERO */
.lp-shop-hero{
  position:relative;
  margin:24px 40px 0;
  height:280px;
  border-radius:20px;
  overflow:hidden;
  background:var(--lp-blue-dark);
  display:flex;
  align-items:center;
}
.lp-shop-hero img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;}
.lp-shop-hero-overlay{position:absolute;inset:0;background:linear-gradient(100deg, rgba(18,90,148,.94) 0%, rgba(18,90,148,.8) 30%, rgba(18,90,148,.45) 55%, rgba(18,90,148,.12) 78%, rgba(18,90,148,0) 100%);}
.lp-shop-hero-content{position:relative;z-index:2;padding:0 56px;max-width:560px;}
.lp-shop-breadcrumb{font-family:var(--lp-font-head);font-size:.74rem;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:rgba(255,255,255,.75);margin-bottom:10px;}
.lp-shop-breadcrumb a{color:rgba(255,255,255,.75);text-decoration:none;}
.lp-shop-breadcrumb a:hover{color:#fff;}
.lp-shop-hero-content h1{font-family:var(--lp-font-head);text-transform:uppercase;letter-spacing:.01em;color:#fff;font-size:clamp(1.9rem,3.6vw,2.6rem);font-weight:700;margin:0 0 10px;line-height:1.15;}
.lp-shop-hero-sub{color:rgba(255,255,255,.85);font-size:.92rem;line-height:1.6;max-width:400px;}

/* TOOLBAR */
.lp-shop-toolbar{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:14px;
  padding:22px 0;border-bottom:1.5px solid var(--lp-border);margin-bottom:28px;
}
.lp-shop-filters{display:flex;gap:12px;flex-wrap:wrap;}
.lp-shop-select{
  appearance:none;-webkit-appearance:none;
  border:1.5px solid var(--lp-border);border-radius:8px;background:#fff;
  padding:10px 36px 10px 14px;font-family:var(--lp-font-body);font-size:.82rem;font-weight:600;color:var(--lp-text);
  cursor:pointer;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%236b7c8f' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat:no-repeat;background-position:right 12px center;
}
.lp-shop-select:hover{border-color:var(--lp-green);}
.lp-shop-select:focus{outline:none;border-color:var(--lp-blue);}
.lp-shop-meta{display:flex;align-items:center;gap:16px;flex-wrap:wrap;}
.lp-shop-count{font-size:.82rem;color:var(--lp-text-light);white-space:nowrap;}
.lp-shop-view-toggle{display:flex;gap:6px;}
.lp-shop-view-btn{width:36px;height:36px;border-radius:8px;border:1.5px solid var(--lp-border);background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--lp-text-light);}
.lp-shop-view-btn.active{background:var(--lp-blue-dark);border-color:var(--lp-blue-dark);color:#fff;}
.lp-shop-view-btn svg{width:16px;height:16px;}

/* MAIN (no sidebar — full width) */
.lp-shop-main{padding-bottom:56px;}

/* PRODUCT GRID — 4 per row */
.lp-shop-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.lp-shop-grid.list-view{grid-template-columns:1fr;}
.lp-shop-card{background:#fff;border:1.5px solid var(--lp-border);border-radius:10px;overflow:hidden;display:flex;flex-direction:column;position:relative;transition:box-shadow .2s,transform .2s;}
.lp-shop-card:hover{box-shadow:0 12px 30px rgba(18,90,148,.1);transform:translateY(-2px);}
.list-view .lp-shop-card{flex-direction:row;}
.list-view .lp-shop-img{width:220px;flex-shrink:0;height:auto;}
.lp-shop-badge-sale{position:absolute;top:10px;left:10px;background:var(--lp-green-dark);color:#fff;font-family:var(--lp-font-head);font-size:.6rem;font-weight:600;letter-spacing:.03em;padding:3px 9px;border-radius:50px;z-index:2;}
.lp-shop-badge-new{position:absolute;top:10px;left:10px;background:var(--lp-blue);color:#fff;font-family:var(--lp-font-head);font-size:.6rem;font-weight:600;letter-spacing:.03em;padding:3px 9px;border-radius:50px;z-index:2;}
.lp-shop-wish{position:absolute;top:10px;right:10px;width:28px;height:28px;border-radius:50%;background:#fff;border:none;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,.1);cursor:pointer;z-index:2;}
.lp-shop-wish svg{width:14px;height:14px;color:var(--lp-blue-dark);}
.lp-shop-img{height:190px;background:#f7f9fb;display:flex;align-items:center;justify-content:center;padding:18px;box-sizing:border-box;}
.lp-shop-img img{width:100%;height:100%;object-fit:contain;}
.lp-shop-body{padding:16px;display:flex;flex-direction:column;flex:1;}
.lp-shop-cat{font-family:var(--lp-font-head);font-size:.66rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--lp-blue);margin-bottom:5px;}
.lp-shop-name{font-size:.92rem;font-weight:700;color:var(--lp-text);line-height:1.35;margin-bottom:6px;}
.lp-shop-name a{color:inherit;text-decoration:none;transition:color .15s;}
.lp-shop-name a:hover{color:var(--lp-name-hover);text-decoration:underline;}
.lp-shop-desc{font-size:.78rem;color:var(--lp-text-light);line-height:1.55;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.lp-shop-footer{margin-top:auto;display:flex;flex-direction:column;gap:10px;}
.lp-shop-price-row{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
.lp-shop-price-old{font-size:.76rem;text-decoration:line-through;color:var(--lp-text-light);}
.lp-shop-price-cur{font-size:1rem;font-weight:800;color:var(--lp-blue-dark);}
.lp-shop-btn-stack{display:flex;flex-direction:column;gap:8px;}
.lp-shop-btn-cart,.lp-shop-btn-rx,.lp-shop-btn-wa{display:flex;align-items:center;justify-content:center;gap:7px;font-family:var(--lp-font-head);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.03em;padding:10px;border-radius:5px;text-decoration:none;border:none;cursor:pointer;width:100%;box-sizing:border-box;}
.lp-shop-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-shop-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-shop-btn-cart.lp-atc-loading{opacity:.65;pointer-events:none;}
.lp-shop-btn-rx{background:var(--lp-red);color:#fff;}
.lp-shop-btn-rx:hover{background:var(--lp-red-dark);}
.lp-shop-btn-wa{background:var(--lp-wa);color:#fff;}
.lp-shop-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-shop-btn-cart svg,.lp-shop-btn-rx svg,.lp-shop-btn-wa svg{width:13px;height:13px;flex-shrink:0;}

/* PAGINATION: Prev / numbers with ellipsis / Next */
.lp-shop-pagination{display:flex;justify-content:center;align-items:center;gap:8px;margin-top:36px;flex-wrap:wrap;}
.lp-shop-page-btn{min-width:38px;height:38px;padding:0 12px;border-radius:8px;border:1.5px solid var(--lp-border);background:#fff;display:inline-flex;align-items:center;justify-content:center;font-family:var(--lp-font-head);font-size:.82rem;font-weight:600;color:var(--lp-text);text-decoration:none;}
.lp-shop-page-btn:hover{border-color:var(--lp-green);color:var(--lp-green-dark);}
.lp-shop-page-btn.active{background:var(--lp-blue-dark);border-color:var(--lp-blue-dark);color:#fff;}
.lp-shop-page-btn.dots{border-color:transparent;background:transparent;cursor:default;color:var(--lp-text-light);}
.lp-shop-page-btn.dots:hover{border-color:transparent;color:var(--lp-text-light);}
.lp-shop-page-btn.prev,.lp-shop-page-btn.next{padding:0 16px;}

/* EMPTY STATE */
.lp-shop-empty{text-align:center;padding:64px 20px;}
.lp-shop-empty-icon{width:52px;height:52px;margin:0 auto 18px;color:var(--lp-text-light);}
.lp-shop-empty h3{font-family:var(--lp-font-head);text-transform:uppercase;color:var(--lp-blue-dark);font-size:1.1rem;margin:0 0 8px;}
.lp-shop-empty p{color:var(--lp-text-light);font-size:.86rem;}
.lp-shop-empty a{color:var(--lp-green-dark);font-weight:700;text-decoration:none;}

/* ADD-TO-CART TOAST */
#leshavin-toast {
    position:fixed; bottom:24px; right:24px; z-index:999999;
    min-width:280px; max-width:340px;
    background:var(--lp-blue-dark); color:#fff; border-radius:12px;
    padding:14px 16px; box-shadow:0 12px 40px rgba(0,0,0,.28);
    display:flex; align-items:flex-start; gap:12px;
    font-family:var(--lp-font-body); opacity:0;
    transform:translateY(20px) scale(0.95);
    transition:opacity .35s cubic-bezier(.34,1.56,.64,1), transform .35s cubic-bezier(.34,1.56,.64,1);
    pointer-events:none;
}
#leshavin-toast.lp-toast-show { opacity:1; transform:translateY(0) scale(1); pointer-events:all; }
.lp-toast-icon-wrap { width:36px; height:36px; border-radius:50%; background:var(--lp-green-dark); display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; }
.lp-toast-body { flex:1; min-width:0; }
.lp-toast-title { font-family:var(--lp-font-head); font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.08em; color:var(--lp-green); margin-bottom:3px; }
.lp-toast-name { font-size:.85rem; font-weight:700; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:10px; }
.lp-toast-actions { display:flex; gap:8px; }
.lp-toast-btn-cart { display:inline-flex; align-items:center; gap:5px; background:var(--lp-blue); color:#fff; padding:6px 12px; border-radius:6px; font-family:var(--lp-font-head); font-size:.66rem; font-weight:700; text-transform:uppercase; letter-spacing:.03em; text-decoration:none; transition:background .2s; white-space:nowrap; }
.lp-toast-btn-cart:hover { background:var(--lp-blue-dark); color:#fff; }
.lp-toast-btn-close { display:inline-flex; align-items:center; background:rgba(255,255,255,.1); color:rgba(255,255,255,.7); padding:6px 10px; border-radius:6px; border:none; cursor:pointer; font-family:var(--lp-font-head); font-size:.66rem; font-weight:700; text-transform:uppercase; letter-spacing:.03em; transition:background .2s; }
.lp-toast-btn-close:hover { background:rgba(255,255,255,.2); color:#fff; }
.lp-toast-progress { position:absolute; bottom:0; left:0; right:0; height:4px; background:rgba(255,255,255,.15); border-radius:0 0 12px 12px; overflow:hidden; }
.lp-toast-progress-bar { height:100%; width:100%; background:var(--lp-green-dark); transform-origin:left; animation:none; }
#leshavin-toast.lp-toast-show .lp-toast-progress-bar { animation:lpCountdown 5s linear forwards; }
@keyframes lpCountdown { from { transform:scaleX(1); } to { transform:scaleX(0); } }
@media(max-width:600px) { #leshavin-toast { bottom:16px; right:12px; left:12px; min-width:unset; max-width:unset; } }

/* RESPONSIVE */
@media(max-width:1100px){
  .lp-shop-grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
  .lp-wrap{padding:0 20px;}
  .lp-shop-hero{margin:14px 16px 0;height:200px;border-radius:16px;}
  .lp-shop-hero-content{padding:0 24px;}
  .lp-shop-hero-overlay{background:linear-gradient(180deg, rgba(18,90,148,.55) 0%, rgba(18,90,148,.92) 75%);}
  .lp-shop-grid{grid-template-columns:repeat(2,1fr);}
  .list-view .lp-shop-card{flex-direction:column;}
  .list-view .lp-shop-img{width:100%;height:190px;}
}
@media(max-width:640px){
  .lp-shop-toolbar{flex-direction:column;align-items:flex-start;}
  .lp-shop-meta{width:100%;justify-content:space-between;}
  .lp-shop-hero{height:180px;margin:12px 12px 0;}
  .lp-shop-hero-content{padding:0 20px;}
}
@media(max-width:480px){
  .lp-shop-grid{grid-template-columns:1fr;}
}
</style>

<!-- ADD-TO-CART TOAST -->
<div id="leshavin-toast" role="alert" aria-live="assertive">
  <div class="lp-toast-icon-wrap">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div class="lp-toast-body">
    <div class="lp-toast-title">&#10003; Added to Cart</div>
    <div class="lp-toast-name" id="lp-toast-name"></div>
    <div class="lp-toast-actions">
      <a href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#' ); ?>" class="lp-toast-btn-cart">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
        View Cart
      </a>
      <button class="lp-toast-btn-close" id="lp-toast-close" type="button">Dismiss</button>
    </div>
  </div>
  <div class="lp-toast-progress"><div class="lp-toast-progress-bar" id="lp-toast-bar"></div></div>
</div>

<?php
if ( ! function_exists('leshavin_phone') ) {
  function leshavin_phone() { return '254792331941'; }
}

/**
 * True only for products in these exact WooCommerce product category
 * slugs (as confirmed on the live store). This local copy exists only
 * as a safety net if functions.php's canonical version somehow fails
 * to load — functions.php's version is the one that actually runs.
 * Keep this list identical to the one in functions.php:
 *   - prescription-only-medicine
 *   - diabetic-weight-management
 *   - weight-management
 *   - prescription
 */
if ( ! function_exists('leshavin_needs_prescription') ) {
  function leshavin_needs_prescription( $product_id ) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( ! $terms || is_wp_error( $terms ) ) return false;
    $allowed_slugs = [
      'prescription-only-medicine',
      'diabetic-weight-management',
      'weight-management',
      'prescription',
    ];
    foreach ( $terms as $term ) {
      if ( in_array( $term->slug, $allowed_slugs, true ) ) {
        return true;
      }
    }
    return false;
  }
}

if ( ! function_exists('leshavin_primary_cat_name') ) {
  function leshavin_primary_cat_name( $product_id ) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) {
      return esc_html( $terms[0]->name );
    }
    return '';
  }
}

if ( ! function_exists('leshavin_whatsapp_url') ) {
  function leshavin_whatsapp_url( $title = '', $url = '', $price_text = '' ) {
    $phone = leshavin_phone();
    $msg = 'Hi! I would like to enquire about: ' . $title;
    if ( $price_text ) $msg .= ' - ' . $price_text;
    if ( $url ) $msg .= ' ' . $url;
    return 'https://wa.me/' . $phone . '?text=' . rawurlencode( $msg );
  }
}

if ( ! function_exists('leshavin_cart_svg') ) {
  function leshavin_cart_svg() {
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>';
  }
}
if ( ! function_exists('leshavin_rx_svg') ) {
  function leshavin_rx_svg() {
    return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
  }
}
if ( ! function_exists('leshavin_wa_svg') ) {
  function leshavin_wa_svg() {
    return '<svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
  }
}

$lp_is_new_days = 30;

$lp_shop_cats = get_terms([ 'taxonomy'=>'product_cat','hide_empty'=>true,'parent'=>0 ]);

/* Custom, theme-styled sort control — does NOT use woocommerce_catalog_ordering().
   WooCommerce still reads $_GET['orderby'] natively on the shop archive. */
$lp_orderby_options = [
  'menu_order' => 'Default sorting',
  'date'       => 'Newest first',
  'price'      => 'Price: Low to High',
  'price-desc' => 'Price: High to Low',
  'popularity' => 'Most Popular',
  'rating'     => 'Top Rated',
];
$lp_current_orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';
?>

<!-- SHOP HERO -->
<section class="lp-shop-hero">
  <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/shopbg.png' ); ?>" alt="Leshavin Pharmacy shop">
  <div class="lp-shop-hero-overlay"></div>
  <div class="lp-shop-hero-content">
    <div class="lp-shop-breadcrumb"><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a> &nbsp;/&nbsp; Shop</div>
    <h1>Shop Our Products</h1>
    <p class="lp-shop-hero-sub">Genuine medicines, wellness essentials and everyday health products, sourced and dispensed with care.</p>
  </div>
</section>

<div class="lp-wrap">

  <!-- TOOLBAR -->
  <div class="lp-shop-toolbar">
    <div class="lp-shop-filters">
      <select class="lp-shop-select" onchange="if(this.value)window.location.href=this.value;">
        <option value="">All Categories</option>
        <?php if ( $lp_shop_cats && ! is_wp_error( $lp_shop_cats ) ) : foreach ( $lp_shop_cats as $lp_c ) : ?>
          <option value="<?php echo esc_url( get_term_link( $lp_c ) ); ?>" <?php selected( is_tax('product_cat', $lp_c->slug) ); ?>><?php echo esc_html( $lp_c->name ); ?></option>
        <?php endforeach; endif; ?>
      </select>

      <select class="lp-shop-select" id="lpSortSelect" onchange="
        var u = new URL(window.location.href);
        u.searchParams.set('orderby', this.value);
        u.searchParams.delete('paged');
        window.location.href = u.toString();
      ">
        <?php foreach ( $lp_orderby_options as $lp_val => $lp_label ) : ?>
          <option value="<?php echo esc_attr( $lp_val ); ?>" <?php selected( $lp_current_orderby, $lp_val ); ?>><?php echo esc_html( $lp_label ); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="lp-shop-meta">
      <div class="lp-shop-count">
        <?php
        if ( function_exists('woocommerce_result_count') ) {
          woocommerce_result_count();
        } else {
          echo 'Browse our full range';
        }
        ?>
      </div>
      <div class="lp-shop-view-toggle">
        <button type="button" class="lp-shop-view-btn active" id="lpGridViewBtn" aria-label="Grid view">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
        </button>
        <button type="button" class="lp-shop-view-btn" id="lpListViewBtn" aria-label="List view">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
        </button>
      </div>
    </div>
  </div>

  <!-- MAIN PRODUCT AREA (full width, no sidebar) -->
  <div class="lp-shop-main">

    <?php
    /* Prevent duplicate notifications: our own custom toast (#leshavin-toast)
       already tells the user their item was added, via the ?lp_added_name=
       param set by the JS below. So on that specific redirect, strip only
       the WooCommerce "X has been added to your cart" SUCCESS notice out of
       the session before it gets printed by woocommerce_output_all_notices()
       just below. Genuine error/warning notices (out of stock, sold
       individually, etc.) are left completely untouched so they still show. */
    if ( isset( $_GET['lp_added_name'] ) && function_exists('WC') && WC()->session ) {
        $lp_wc_notices = WC()->session->get( 'wc_notices', [] );
        if ( isset( $lp_wc_notices['success'] ) ) {
            unset( $lp_wc_notices['success'] );
            WC()->session->set( 'wc_notices', $lp_wc_notices );
        }
    }
    ?>

    <?php if ( function_exists('woocommerce_output_all_notices') ) : woocommerce_output_all_notices(); endif; ?>

    <?php if ( have_posts() ) : ?>

      <div class="lp-shop-grid" id="lpShopGrid">
        <?php while ( have_posts() ) : the_post();
          global $product;
          if ( ! $product ) continue;

          $img       = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' );
          $on_sale   = $product->is_on_sale();
          $reg       = $product->get_regular_price();
          $cur       = $product->get_price();
          $is_rx     = leshavin_needs_prescription( get_the_ID() );
          $cat_name  = leshavin_primary_cat_name( get_the_ID() );
          $created   = $product->get_date_created();
          $is_new    = $created && ( time() - $created->getTimestamp() ) < ( $lp_is_new_days * DAY_IN_SECONDS );
          $price_text = 'KSh ' . number_format( (float) $cur, 2 );
          $wa_url    = leshavin_whatsapp_url( get_the_title(), get_permalink(), $price_text );
          $title_short = mb_strlen( get_the_title() ) > 30 ? mb_substr( get_the_title(), 0, 30 ) . '…' : get_the_title();
          ?>
          <div class="lp-shop-card">
            <div class="lp-shop-img">
              <?php if ( $img ) : ?>
                <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
              <?php else : ?>
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/></svg>
              <?php endif; ?>
              <button class="lp-shop-wish" aria-label="Wishlist" onclick="event.preventDefault();">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
              </button>
              <?php if ( $on_sale && $reg ) : ?>
                <div class="lp-shop-badge-sale">-<?php echo round( ( ( $reg - $cur ) / $reg ) * 100 ); ?>% OFF</div>
              <?php elseif ( $is_new ) : ?>
                <div class="lp-shop-badge-new">NEW</div>
              <?php endif; ?>
            </div>
            <div class="lp-shop-body">
              <?php if ( $cat_name ) : ?><div class="lp-shop-cat"><?php echo $cat_name; ?></div><?php endif; ?>
              <div class="lp-shop-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
              <div class="lp-shop-desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14 ) ); ?></div>
              <div class="lp-shop-footer">
                <div class="lp-shop-price-row">
                  <?php if ( $on_sale && $reg ) : ?><div class="lp-shop-price-old">KSh <?php echo number_format( (float) $reg, 2 ); ?></div><?php endif; ?>
                  <div class="lp-shop-price-cur">KSh <?php echo number_format( (float) $cur, 2 ); ?></div>
                </div>
                <div class="lp-shop-btn-stack">
                  <?php if ( $is_rx ) : ?>
                    <a href="<?php echo esc_url( home_url('/prescription') ); ?>" class="lp-shop-btn-rx">
                      <?php echo leshavin_rx_svg(); ?> Submit Prescription
                    </a>
                  <?php elseif ( $product->is_type('simple') ) : ?>
                    <button type="button"
                       class="lp-shop-btn-cart leshavin-atc-btn"
                       data-pid="<?php the_ID(); ?>"
                       data-name="<?php echo esc_attr( $title_short ); ?>">
                      <?php echo leshavin_cart_svg(); ?> <span class="lp-atc-txt">Add to Cart</span>
                    </button>
                  <?php else : ?>
                    <a href="<?php the_permalink(); ?>" class="lp-shop-btn-cart">
                      <?php echo leshavin_cart_svg(); ?> Add to Cart
                    </a>
                  <?php endif; ?>
                  <a href="<?php echo esc_url( $wa_url ); ?>" class="lp-shop-btn-wa" target="_blank" rel="noopener noreferrer">
                    <?php echo leshavin_wa_svg(); ?> <?php echo $is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- PAGINATION: Prev / 1 2 3 … / Next -->
      <?php
      global $wp_query;
      $lp_total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
      $lp_curr  = max( 1, get_query_var('paged') );
      if ( $lp_total > 1 ) :
        $lp_links = paginate_links([
          'base'      => esc_url_raw( add_query_arg( 'paged', '%#%' ) ),
          'format'    => '',
          'current'   => $lp_curr,
          'total'     => $lp_total,
          'mid_size'  => 1,
          'end_size'  => 1,
          'prev_text' => '&#8249; Prev',
          'next_text' => 'Next &#8250;',
          'type'      => 'array',
        ]);
        if ( $lp_links ) :
        ?>
        <div class="lp-shop-pagination">
          <?php foreach ( $lp_links as $lp_link ) :
            $lp_link = str_replace( 'page-numbers', 'lp-shop-page-btn', $lp_link );
            $lp_link = str_replace( 'lp-shop-page-btn current', 'lp-shop-page-btn active', $lp_link );
            $lp_link = str_replace( 'lp-shop-page-btn prev', 'lp-shop-page-btn prev lp-shop-page-btn', $lp_link );
            echo $lp_link;
          endforeach; ?>
        </div>
        <?php endif; ?>
      <?php endif; ?>

    <?php else : ?>

      <div class="lp-shop-empty">
        <svg class="lp-shop-empty-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <h3>No Products Found</h3>
        <p>Try a different category, or <a href="<?php echo esc_url( 'https://wa.me/' . leshavin_phone() ); ?>" target="_blank" rel="noopener noreferrer">ask us directly on WhatsApp</a>.</p>
      </div>

    <?php endif; ?>
  </div>
</div>

<script>
(function(){
  var grid = document.getElementById('lpShopGrid');
  var gridBtn = document.getElementById('lpGridViewBtn');
  var listBtn = document.getElementById('lpListViewBtn');
  if(!grid || !gridBtn || !listBtn) return;
  gridBtn.addEventListener('click', function(){
    grid.classList.remove('list-view');
    gridBtn.classList.add('active');
    listBtn.classList.remove('active');
  });
  listBtn.addEventListener('click', function(){
    grid.classList.add('list-view');
    listBtn.classList.add('active');
    gridBtn.classList.remove('active');
  });
})();
</script>

<!-- ADD-TO-CART: real page reload (updates header cart count) but the
     page is held static via saved/restored scroll position, and a toast
     confirms the action instead of the user seeing a jump. -->
<script>
(function () {
  'use strict';

  var toast       = document.getElementById('leshavin-toast');
  var toastNameEl = document.getElementById('lp-toast-name');
  var toastBar    = document.getElementById('lp-toast-bar');
  var closeBtn    = document.getElementById('lp-toast-close');
  var hideTimer   = null;

  function showToast(name) {
    if (!toast) return;
    if (toastNameEl) toastNameEl.textContent = name || '';
    if (toastBar) { toastBar.style.animation = 'none'; void toastBar.offsetWidth; toastBar.style.animation = ''; }
    toast.classList.add('lp-toast-show');
    if (hideTimer) clearTimeout(hideTimer);
    hideTimer = setTimeout(function () { toast.classList.remove('lp-toast-show'); }, 5000);
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      toast.classList.remove('lp-toast-show');
      if (hideTimer) clearTimeout(hideTimer);
    });
  }

  var params      = new URLSearchParams(window.location.search);
  var toastName   = params.get('lp_added_name');
  var savedScroll = sessionStorage.getItem('lp_scroll_pos');

  if (toastName) {
    // Jump back to the saved position immediately, then again after
    // full load (images/fonts can shift layout height), before the
    // user has a chance to see the page at the top.
    if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
    window.addEventListener('load', function () {
      if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
      sessionStorage.removeItem('lp_scroll_pos');
    });
    document.addEventListener('DOMContentLoaded', function () {
      if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
      showToast(decodeURIComponent(toastName));
    });
    // Clean the URL so refreshing doesn't re-trigger the toast or re-add the item.
    var cleanUrl = new URL(window.location.href);
    cleanUrl.searchParams.delete('lp_added_name');
    cleanUrl.searchParams.delete('added-to-cart');
    cleanUrl.searchParams.delete('add-to-cart');
    window.history.replaceState(null, '', cleanUrl.toString());
  }

  document.querySelectorAll('.leshavin-atc-btn').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      var pid  = btn.getAttribute('data-pid');
      var name = btn.getAttribute('data-name');

      var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
      sessionStorage.setItem('lp_scroll_pos', scrollY);

      btn.classList.add('lp-atc-loading');
      var txtEl = btn.querySelector('.lp-atc-txt');
      if (txtEl) txtEl.textContent = 'Adding…';

      var url = new URL(window.location.href);
      url.searchParams.set('add-to-cart', pid);
      url.searchParams.set('quantity', '1');
      url.searchParams.set('lp_added_name', encodeURIComponent(name));
      window.location.href = url.toString();
    });
  });

})();
</script>

<?php get_footer(); ?>