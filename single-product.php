<?php
/* single-product.php — Individual product page, Leshavin Pharmacy */
get_header();
global $product;
while (have_posts()): the_post();

  $wa       = leshavin_wa();
  $name     = $product->get_name();
  $price_c  = (float) $product->get_price();
  $price_r  = (float) $product->get_regular_price();
  $sale     = $product->is_on_sale();
  $img      = get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_single');
  $gallery_ids = $product->get_gallery_image_ids();
  $cats     = get_the_terms(get_the_ID(), 'product_cat');
  $cat_n    = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
  $cat_link = ($cats && !is_wp_error($cats)) ? get_term_link($cats[0]) : '';
  $sku      = $product->get_sku();
  $stock    = $product->get_stock_status();
  $is_rx    = leshavin_needs_prescription(get_the_ID());
  $is_simple = $product->is_type('simple');
  $avg_rating = $product->get_average_rating();
  $review_count = $product->get_review_count();

  $price_text = 'KSh ' . number_format($price_c, 2);
  $wa_msg = urlencode("Hello " . get_bloginfo('name') . "!\n\nI'd like to order:\n{$name}\nPrice: {$price_text}\n" . get_permalink() . "\n\nPlease confirm availability. Thank you!");

  $title_short = mb_strlen($name) > 30 ? mb_substr($name, 0, 30) . '…' : $name;
?>
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

/* BREADCRUMB */
.lp-pd-crumb{padding:18px 0;font-family:var(--lp-font-head);font-size:.76rem;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:var(--lp-text-light);display:flex;align-items:center;gap:6px;flex-wrap:wrap;}
.lp-pd-crumb a{color:var(--lp-text-light);text-decoration:none;}
.lp-pd-crumb a:hover{color:var(--lp-blue);}
.lp-pd-crumb span.sep{opacity:.5;}
.lp-pd-crumb span.current{color:var(--lp-blue-dark);}

/* MAIN LAYOUT */
.lp-pd-layout{display:grid;grid-template-columns:1fr 1fr 300px;gap:32px;padding-bottom:48px;align-items:start;}

/* GALLERY */
.lp-pd-gallery{position:sticky;top:16px;}
.lp-pd-main-img{background:#fff;border:1.5px solid var(--lp-border);border-radius:14px;height:420px;display:flex;align-items:center;justify-content:center;padding:24px;box-sizing:border-box;position:relative;overflow:hidden;}
.lp-pd-main-img img{max-width:100%;max-height:100%;object-fit:contain;}
.lp-pd-zoom-btn{position:absolute;top:14px;right:14px;width:38px;height:38px;border-radius:50%;background:#fff;border:1.5px solid var(--lp-border);display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--lp-blue-dark);}
.lp-pd-zoom-btn svg{width:16px;height:16px;}
.lp-pd-thumbs{display:flex;align-items:center;gap:8px;margin-top:14px;}
.lp-pd-thumb-nav{width:30px;height:30px;border-radius:50%;border:1.5px solid var(--lp-border);background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--lp-text-light);flex-shrink:0;}
.lp-pd-thumb-nav:hover{border-color:var(--lp-green);color:var(--lp-green-dark);}
.lp-pd-thumb-track{display:flex;gap:8px;overflow-x:auto;scrollbar-width:none;}
.lp-pd-thumb-track::-webkit-scrollbar{display:none;}
.lp-pd-thumb{width:64px;height:64px;flex-shrink:0;border-radius:8px;border:2px solid var(--lp-border);background:#fff;padding:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;}
.lp-pd-thumb.active{border-color:var(--lp-blue);}
.lp-pd-thumb img{max-width:100%;max-height:100%;object-fit:contain;}

/* INFO COLUMN */
.lp-pd-badge{display:inline-block;background:var(--lp-green-dark);color:#fff;font-family:var(--lp-font-head);font-size:.66rem;font-weight:600;letter-spacing:.03em;padding:4px 12px;border-radius:50px;margin-bottom:12px;}
.lp-pd-cat{font-family:var(--lp-font-head);font-size:.76rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--lp-blue);text-decoration:none;display:inline-block;margin-bottom:8px;}
.lp-pd-cat:hover{color:var(--lp-blue-dark);}
.lp-pd-title{font-family:var(--lp-font-head);font-size:1.6rem;font-weight:700;color:var(--lp-text);line-height:1.25;margin:0 0 10px;}
.lp-pd-rating{display:flex;align-items:center;gap:8px;margin-bottom:16px;}
.lp-pd-stars{color:#f5a623;font-size:.9rem;letter-spacing:1px;}
.lp-pd-rating-count{font-size:.8rem;color:var(--lp-text-light);}

.lp-pd-price-row{display:flex;align-items:baseline;gap:12px;margin-bottom:18px;flex-wrap:wrap;}
.lp-pd-price-cur{font-family:var(--lp-font-head);font-size:1.9rem;font-weight:700;color:var(--lp-blue-dark);}
.lp-pd-price-old{font-size:1rem;text-decoration:line-through;color:var(--lp-text-light);}

.lp-pd-stock{display:inline-flex;align-items:center;gap:6px;font-size:.82rem;font-weight:700;margin-bottom:18px;}
.lp-pd-stock svg{width:16px;height:16px;flex-shrink:0;}
.lp-pd-stock.in{color:var(--lp-green-dark);}
.lp-pd-stock.out{color:var(--lp-red);}

.lp-pd-desc{font-size:.9rem;color:var(--lp-text-light);line-height:1.7;margin-bottom:20px;}
.lp-pd-desc p{margin:0 0 12px;}
.lp-pd-desc p:last-child{margin-bottom:0;}

.lp-pd-trust-row{display:flex;gap:18px;flex-wrap:wrap;padding:18px 0;border-top:1.5px solid var(--lp-border);border-bottom:1.5px solid var(--lp-border);margin-bottom:22px;}
.lp-pd-trust-item{display:flex;align-items:center;gap:9px;}
.lp-pd-trust-item svg{width:24px;height:24px;color:var(--lp-green-dark);flex-shrink:0;}
.lp-pd-trust-title{font-family:var(--lp-font-head);font-weight:600;font-size:.74rem;text-transform:uppercase;color:var(--lp-blue-dark);}
.lp-pd-trust-sub{font-size:.7rem;color:var(--lp-text-light);}

.lp-pd-meta{margin-bottom:22px;}
.lp-pd-meta-row{display:flex;gap:8px;font-size:.84rem;padding:5px 0;}
.lp-pd-meta-label{color:var(--lp-text-light);font-weight:600;min-width:80px;}
.lp-pd-meta-val{color:var(--lp-text);font-weight:700;}

/* QUANTITY + ACTIONS */
.lp-pd-qty-row{display:flex;align-items:center;gap:16px;margin-bottom:16px;flex-wrap:wrap;}
.lp-pd-qty-label{font-family:var(--lp-font-head);font-weight:600;font-size:.82rem;text-transform:uppercase;color:var(--lp-text);}
.lp-pd-qty-stepper{display:flex;align-items:center;border:1.5px solid var(--lp-border);border-radius:8px;overflow:hidden;}
.lp-pd-qty-btn{width:38px;height:40px;background:#f7f9fb;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--lp-blue-dark);font-size:1.1rem;font-weight:700;}
.lp-pd-qty-btn:hover{background:var(--lp-green-pale);color:var(--lp-green-dark);}
.lp-pd-qty-input{width:48px;height:40px;border:none;border-left:1.5px solid var(--lp-border);border-right:1.5px solid var(--lp-border);text-align:center;font-family:var(--lp-font-head);font-weight:700;font-size:.95rem;color:var(--lp-text);}
.lp-pd-qty-input:focus{outline:none;}

.lp-pd-action-row{display:flex;gap:12px;margin-bottom:12px;flex-wrap:wrap;}
.lp-pd-btn-cart,.lp-pd-btn-rx{flex:1;min-width:200px;display:flex;align-items:center;justify-content:center;gap:9px;font-family:var(--lp-font-head);font-weight:600;font-size:.84rem;text-transform:uppercase;letter-spacing:.03em;padding:14px 18px;border-radius:8px;text-decoration:none;border:none;cursor:pointer;}
.lp-pd-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-pd-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-pd-btn-cart.lp-pd-atc-loading{opacity:.65;pointer-events:none;}
.lp-pd-btn-rx{background:var(--lp-red);color:#fff;}
.lp-pd-btn-rx:hover{background:var(--lp-red-dark);}
.lp-pd-btn-cart svg,.lp-pd-btn-rx svg{width:16px;height:16px;flex-shrink:0;}
.lp-pd-wish-btn{width:48px;height:48px;border-radius:8px;border:1.5px solid var(--lp-border);background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--lp-blue-dark);flex-shrink:0;}
.lp-pd-wish-btn:hover{border-color:var(--lp-red);color:var(--lp-red);}
.lp-pd-wish-btn svg{width:18px;height:18px;}

.lp-pd-btn-wa{display:flex;align-items:center;justify-content:center;gap:9px;width:100%;background:var(--lp-wa);color:#fff;font-family:var(--lp-font-head);font-weight:600;font-size:.84rem;text-transform:uppercase;letter-spacing:.03em;padding:14px;border-radius:8px;text-decoration:none;margin-bottom:8px;}
.lp-pd-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-pd-btn-wa svg{width:16px;height:16px;flex-shrink:0;}

/* SIDEBAR */
.lp-pd-sidebar-widget{border:1.5px solid var(--lp-border);border-radius:12px;padding:20px;background:#fff;margin-bottom:16px;}
.lp-pd-sidebar-title{font-family:var(--lp-font-head);font-weight:700;text-transform:uppercase;letter-spacing:.03em;font-size:.82rem;color:var(--lp-blue-dark);margin-bottom:6px;}
.lp-pd-sidebar-sub{font-size:.76rem;color:var(--lp-text-light);margin-bottom:14px;}

.lp-pd-share-row{display:flex;gap:10px;margin-top:10px;}
.lp-pd-share-btn{width:38px;height:38px;border-radius:50%;background:#f7f9fb;border:1.5px solid var(--lp-border);display:flex;align-items:center;justify-content:center;color:var(--lp-blue-dark);text-decoration:none;}
.lp-pd-share-btn:hover{background:var(--lp-blue-pale);border-color:var(--lp-blue);}
.lp-pd-share-btn svg{width:15px;height:15px;}

/* TABS (custom-styled, wraps WooCommerce default tabs output) */
.lp-pd-tabs-wrap{margin-top:12px;padding-bottom:56px;}
.woocommerce-tabs{border:1.5px solid var(--lp-border);border-radius:14px;overflow:hidden;background:#fff;}
.woocommerce-tabs ul.tabs{display:flex;flex-wrap:wrap;list-style:none;margin:0;padding:0;border-bottom:1.5px solid var(--lp-border);background:#f7f9fb;}
.woocommerce-tabs ul.tabs li{margin:0;}
.woocommerce-tabs ul.tabs li a{display:block;padding:16px 24px;font-family:var(--lp-font-head);font-weight:600;font-size:.82rem;text-transform:uppercase;letter-spacing:.02em;color:var(--lp-text-light);text-decoration:none;border-bottom:3px solid transparent;}
.woocommerce-tabs ul.tabs li.active a{color:var(--lp-blue-dark);border-bottom-color:var(--lp-blue);background:#fff;}
.woocommerce-tabs .panel{padding:28px;font-size:.88rem;color:var(--lp-text-light);line-height:1.75;}
.woocommerce-tabs .panel h2{font-family:var(--lp-font-head);color:var(--lp-blue-dark);font-size:1.05rem;text-transform:uppercase;margin-top:0;}
.woocommerce-tabs table.shop_attributes{width:100%;border-collapse:collapse;}
.woocommerce-tabs table.shop_attributes th,.woocommerce-tabs table.shop_attributes td{padding:10px 14px;border:1px solid var(--lp-border);font-size:.84rem;}
.woocommerce-tabs table.shop_attributes th{background:#f7f9fb;font-family:var(--lp-font-head);font-weight:600;text-align:left;color:var(--lp-text);width:220px;}
#reviews .comment-form input[type=text],#reviews .comment-form input[type=email],#reviews .comment-form textarea{border:1.5px solid var(--lp-border);border-radius:8px;padding:10px 14px;font-family:var(--lp-font-body);width:100%;box-sizing:border-box;}
#reviews .comment-form p.form-submit input{background:var(--lp-blue);color:#fff;border:none;padding:12px 26px;border-radius:8px;font-family:var(--lp-font-head);font-weight:600;text-transform:uppercase;font-size:.8rem;letter-spacing:.03em;cursor:pointer;}
#reviews .comment-form p.form-submit input:hover{background:var(--lp-blue-dark);}
#reviews .star-rating{color:#f5a623;}
#reviews .commentlist{list-style:none;padding:0;margin:0;}
#reviews .commentlist li{border-bottom:1px solid var(--lp-border);padding:16px 0;}

/* RELATED PRODUCTS */
.lp-pd-related{padding-bottom:56px;}
.lp-pd-related-title{font-family:var(--lp-font-head);font-size:1.5rem;font-weight:700;text-transform:uppercase;color:var(--lp-blue-dark);margin-bottom:22px;}
.lp-pd-related-title span{color:var(--lp-green-dark);}
.lp-pd-related-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.lp-pd-r-card{background:#fff;border:1.5px solid var(--lp-border);border-radius:10px;overflow:hidden;display:flex;flex-direction:column;transition:box-shadow .2s,transform .2s;}
.lp-pd-r-card:hover{box-shadow:0 12px 30px rgba(18,90,148,.1);transform:translateY(-2px);}
.lp-pd-r-img{height:170px;background:#f7f9fb;display:flex;align-items:center;justify-content:center;padding:16px;}
.lp-pd-r-img img{max-width:100%;max-height:100%;object-fit:contain;}
.lp-pd-r-body{padding:14px 16px 16px;display:flex;flex-direction:column;flex:1;}
.lp-pd-r-cat{font-family:var(--lp-font-head);font-size:.62rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--lp-blue);margin-bottom:5px;}
.lp-pd-r-name{font-size:.86rem;font-weight:700;color:var(--lp-text);line-height:1.3;margin-bottom:8px;min-height:2.2em;}
.lp-pd-r-name a{color:inherit;text-decoration:none;}
.lp-pd-r-name a:hover{color:var(--lp-name-hover);text-decoration:underline;}
.lp-pd-r-price{font-family:var(--lp-font-head);font-weight:800;color:var(--lp-blue-dark);font-size:.94rem;margin-bottom:10px;margin-top:auto;}
.lp-pd-r-btn-stack{display:flex;flex-direction:column;gap:7px;}
.lp-pd-r-btn-cart,.lp-pd-r-btn-rx,.lp-pd-r-btn-wa{display:flex;align-items:center;justify-content:center;gap:6px;font-family:var(--lp-font-head);font-size:.64rem;font-weight:600;text-transform:uppercase;letter-spacing:.02em;padding:9px;border-radius:5px;text-decoration:none;border:none;cursor:pointer;}
.lp-pd-r-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-pd-r-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-pd-r-btn-rx{background:var(--lp-red);color:#fff;}
.lp-pd-r-btn-rx:hover{background:var(--lp-red-dark);}
.lp-pd-r-btn-wa{background:var(--lp-wa);color:#fff;}
.lp-pd-r-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-pd-r-btn-cart svg,.lp-pd-r-btn-rx svg,.lp-pd-r-btn-wa svg{width:12px;height:12px;flex-shrink:0;}

/* ADD-TO-CART TOAST */
#leshavin-pd-toast {
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
#leshavin-pd-toast.lp-toast-show { opacity:1; transform:translateY(0) scale(1); pointer-events:all; }
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
#leshavin-pd-toast.lp-toast-show .lp-toast-progress-bar { animation:lpPdCountdown 5s linear forwards; }
@keyframes lpPdCountdown { from { transform:scaleX(1); } to { transform:scaleX(0); } }
@media(max-width:600px) { #leshavin-pd-toast { bottom:16px; right:12px; left:12px; min-width:unset; max-width:unset; } }

/* RESPONSIVE */
@media(max-width:1100px){
  .lp-pd-layout{grid-template-columns:1fr 1fr;}
  .lp-pd-sidebar{grid-column:1/-1;display:grid;grid-template-columns:1fr;gap:16px;}
  .lp-pd-related-grid{grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
  .lp-wrap{padding:0 20px;}
  .lp-pd-layout{grid-template-columns:1fr;}
  .lp-pd-gallery{position:static;}
  .lp-pd-related-grid{grid-template-columns:repeat(2,1fr);}
  .lp-pd-main-img{height:320px;}
}
@media(max-width:640px){
  .lp-pd-action-row{flex-direction:column;}
  .lp-pd-btn-cart,.lp-pd-btn-rx{min-width:100%;}
  .lp-pd-related-grid{grid-template-columns:1fr;}
  .lp-pd-title{font-size:1.3rem;}
  .lp-pd-price-cur{font-size:1.5rem;}
}
</style>

<!-- ADD-TO-CART TOAST (product page) -->
<div id="leshavin-pd-toast" role="alert" aria-live="assertive">
  <div class="lp-toast-icon-wrap">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
  </div>
  <div class="lp-toast-body">
    <div class="lp-toast-title">&#10003; Added to Cart</div>
    <div class="lp-toast-name" id="lp-pd-toast-name"></div>
    <div class="lp-toast-actions">
      <a href="<?php echo esc_url( function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#' ); ?>" class="lp-toast-btn-cart">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
        View Cart
      </a>
      <button class="lp-toast-btn-close" id="lp-pd-toast-close" type="button">Dismiss</button>
    </div>
  </div>
  <div class="lp-toast-progress"><div class="lp-toast-progress-bar" id="lp-pd-toast-bar"></div></div>
</div>

<?php
/* Prevent duplicate notifications: our own custom toast above already
   tells the user their item was added, via the ?lp_added_name= param
   set by the JS below. So on that specific redirect, strip only the
   WooCommerce "X has been added to your cart" SUCCESS notice out of
   the session before anything might print it. Genuine error/warning
   notices (out of stock, sold individually, etc.) are left untouched. */
if ( isset( $_GET['lp_added_name'] ) && function_exists('WC') && WC()->session ) {
    $lp_pd_wc_notices = WC()->session->get( 'wc_notices', [] );
    if ( isset( $lp_pd_wc_notices['success'] ) ) {
        unset( $lp_pd_wc_notices['success'] );
        WC()->session->set( 'wc_notices', $lp_pd_wc_notices );
    }
}
?>

<div class="lp-wrap">

  <!-- BREADCRUMB -->
  <div class="lp-pd-crumb">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
    <span class="sep">/</span>
    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Shop</a>
    <?php if ($cat_n && $cat_link): ?>
      <span class="sep">/</span>
      <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_n); ?></a>
    <?php endif; ?>
    <span class="sep">/</span>
    <span class="current"><?php the_title(); ?></span>
  </div>

  <div class="lp-pd-layout">

    <!-- GALLERY -->
    <div class="lp-pd-gallery">
      <div class="lp-pd-main-img" id="lpPdMainImg">
        <?php if ($img): ?>
          <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" id="lpPdMainImgTag">
        <?php else: ?>
          <svg width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="var(--lp-blue-dark)" stroke-width="1.4" style="opacity:.25"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/><line x1="9" y1="15" x2="15" y2="9"/></svg>
        <?php endif; ?>
        <button class="lp-pd-zoom-btn" aria-label="Zoom" type="button">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
        </button>
      </div>

      <?php if ($img || $gallery_ids): ?>
      <div class="lp-pd-thumbs">
        <button class="lp-pd-thumb-nav" type="button" onclick="document.getElementById('lpPdThumbTrack').scrollBy({left:-80,behavior:'smooth'})" aria-label="Previous">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <div class="lp-pd-thumb-track" id="lpPdThumbTrack">
          <?php if ($img): ?>
            <button class="lp-pd-thumb active" type="button" data-src="<?php echo esc_url($img); ?>">
              <img src="<?php echo esc_url($img); ?>" alt="">
            </button>
          <?php endif; ?>
          <?php foreach ($gallery_ids as $gid):
            $gsrc = wp_get_attachment_image_url($gid, 'woocommerce_thumbnail');
            $gfull = wp_get_attachment_image_url($gid, 'woocommerce_single');
            if (!$gsrc) continue;
          ?>
            <button class="lp-pd-thumb" type="button" data-src="<?php echo esc_url($gfull ?: $gsrc); ?>">
              <img src="<?php echo esc_url($gsrc); ?>" alt="">
            </button>
          <?php endforeach; ?>
        </div>
        <button class="lp-pd-thumb-nav" type="button" onclick="document.getElementById('lpPdThumbTrack').scrollBy({left:80,behavior:'smooth'})" aria-label="Next">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
      </div>
      <?php endif; ?>
    </div>

    <!-- INFO -->
    <div class="lp-pd-info">
      <?php if ($is_rx): ?>
        <div class="lp-pd-badge">Prescription Only Medicine</div>
      <?php endif; ?>
      <?php if ($cat_n): ?>
        <a href="<?php echo esc_url($cat_link); ?>" class="lp-pd-cat"><?php echo esc_html($cat_n); ?></a>
      <?php endif; ?>
      <h1 class="lp-pd-title"><?php the_title(); ?></h1>

      <?php if ($review_count > 0): ?>
      <div class="lp-pd-rating">
        <span class="lp-pd-stars"><?php
          $full = round($avg_rating);
          for ($i=1;$i<=5;$i++) echo $i <= $full ? '&#9733;' : '&#9734;';
        ?></span>
        <span class="lp-pd-rating-count">(<?php echo intval($review_count); ?> customer review<?php echo $review_count == 1 ? '' : 's'; ?>)</span>
      </div>
      <?php endif; ?>

      <div class="lp-pd-price-row">
        <div class="lp-pd-price-cur" id="lpPdPriceCur"><?php echo $price_text; ?></div>
        <?php if ($sale && $price_r): ?>
          <div class="lp-pd-price-old" id="lpPdPriceOld">KSh <?php echo number_format($price_r, 2); ?></div>
        <?php endif; ?>
      </div>

      <div class="lp-pd-stock <?php echo $stock === 'instock' ? 'in' : 'out'; ?>">
        <?php if ($stock === 'instock'): ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><polyline points="20 6 9 17 4 12"/></svg> In Stock
        <?php else: ?>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Out of Stock
        <?php endif; ?>
      </div>

      <?php
      $raw_desc = $product->get_short_description() ?: $product->get_description();
      if ($raw_desc):
      ?>
        <div class="lp-pd-desc"><?php echo wpautop(wp_kses_post(wp_trim_words($raw_desc, 34))); ?></div>
      <?php endif; ?>

      <!-- TRUST STRIP -->
      <div class="lp-pd-trust-row">
        <div class="lp-pd-trust-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
          <div><div class="lp-pd-trust-title">Fast Delivery</div><div class="lp-pd-trust-sub">Across Kenya</div></div>
        </div>
        <div class="lp-pd-trust-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <div><div class="lp-pd-trust-title">Genuine Products</div><div class="lp-pd-trust-sub">100% Authentic</div></div>
        </div>
        <div class="lp-pd-trust-item">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
          <div><div class="lp-pd-trust-title">Secure Payments</div><div class="lp-pd-trust-sub">Multiple Options</div></div>
        </div>
      </div>

      <!-- META -->
      <div class="lp-pd-meta">
        <?php if ($sku): ?>
          <div class="lp-pd-meta-row"><span class="lp-pd-meta-label">SKU:</span><span class="lp-pd-meta-val"><?php echo esc_html($sku); ?></span></div>
        <?php endif; ?>
        <?php if ($cat_n): ?>
          <div class="lp-pd-meta-row"><span class="lp-pd-meta-label">Category:</span><span class="lp-pd-meta-val"><?php echo esc_html($cat_n); ?></span></div>
        <?php endif; ?>
      </div>

      <!-- QUANTITY -->
      <div class="lp-pd-qty-row">
        <span class="lp-pd-qty-label">Quantity</span>
        <div class="lp-pd-qty-stepper">
          <button type="button" class="lp-pd-qty-btn" id="lpPdQtyMinus" aria-label="Decrease quantity">&#8722;</button>
          <input type="text" class="lp-pd-qty-input" id="lpPdQtyInput" value="1" inputmode="numeric">
          <button type="button" class="lp-pd-qty-btn" id="lpPdQtyPlus" aria-label="Increase quantity">+</button>
        </div>
      </div>

      <!-- ACTIONS -->
      <div class="lp-pd-action-row">
        <?php if ($is_rx): ?>
          <a href="<?php echo esc_url(home_url('/prescription')); ?>" class="lp-pd-btn-rx">
            <?php echo leshavin_rx_svg(); ?> Submit Prescription
          </a>
        <?php elseif ($is_simple): ?>
          <button type="button"
             class="lp-pd-btn-cart"
             id="lpPdAddToCartLink"
             data-base="<?php echo esc_url(add_query_arg(['add-to-cart' => get_the_ID()], get_permalink())); ?>"
             data-product_id="<?php the_ID(); ?>"
             data-name="<?php echo esc_attr($title_short); ?>">
            <?php echo leshavin_cart_svg(); ?> <span class="lp-pd-atc-txt">Add to Cart</span>
          </button>
        <?php else: ?>
          <div style="flex:1;min-width:200px;">
            <?php woocommerce_template_single_add_to_cart(); ?>
          </div>
        <?php endif; ?>
        <button type="button" class="lp-pd-wish-btn" aria-label="Add to wishlist">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
        </button>
      </div>

      <a href="https://wa.me/<?php echo esc_attr($wa); ?>?text=<?php echo $wa_msg; ?>" class="lp-pd-btn-wa" target="_blank" rel="noopener noreferrer" id="lpPdWaBtn">
        <?php echo leshavin_wa_svg(); ?> <?php echo $is_rx ? 'Ask a Pharmacist on WhatsApp' : 'Buy via WhatsApp'; ?>
      </a>
    </div>

    <!-- SIDEBAR -->
    <div class="lp-pd-sidebar">
      <div class="lp-pd-sidebar-widget">
        <div class="lp-pd-sidebar-title">Share This Product</div>
        <div class="lp-pd-sidebar-sub">Let someone else know about this</div>
        <div class="lp-pd-share-row">
          <a class="lp-pd-share-btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" aria-label="Share on Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 10-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0022 12z"/></svg>
          </a>
          <a class="lp-pd-share-btn" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode($name); ?>" target="_blank" rel="noopener" aria-label="Share on Twitter">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 4.9c-.8.4-1.7.6-2.6.8a4.6 4.6 0 002-2.5c-.9.5-1.8.9-2.9 1.1a4.5 4.5 0 00-7.7 4.1 12.9 12.9 0 01-9.3-4.7 4.5 4.5 0 001.4 6 4.4 4.4 0 01-2-.6v.1a4.5 4.5 0 003.6 4.4 4.5 4.5 0 01-2 .1 4.5 4.5 0 004.2 3.1A9.1 9.1 0 012 19.5a12.9 12.9 0 006.9 2c8.3 0 12.9-6.9 12.9-12.9v-.6c.9-.6 1.6-1.4 2.2-2.1z"/></svg>
          </a>
          <a class="lp-pd-share-btn" href="https://wa.me/?text=<?php echo urlencode($name . ' ' . get_permalink()); ?>" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
            <?php echo leshavin_wa_svg(); ?>
          </a>
          <a class="lp-pd-share-btn" href="mailto:?subject=<?php echo urlencode($name); ?>&body=<?php echo urlencode(get_permalink()); ?>" aria-label="Share via Email">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 6l10 7 10-7"/></svg>
          </a>
        </div>
      </div>
    </div>

  </div>

  <!-- TABS -->
  <div class="lp-pd-tabs-wrap">
    <?php woocommerce_output_product_data_tabs(); ?>
  </div>

  <!-- RELATED PRODUCTS -->
  <?php
  $related = wc_get_related_products(get_the_ID(), 4);
  if ($related):
  ?>
  <div class="lp-pd-related">
    <h3 class="lp-pd-related-title">Related <span>Products</span></h3>
    <div class="lp-pd-related-grid">
      <?php foreach ($related as $rid):
        $rp = wc_get_product($rid);
        if (!$rp) continue;
        $rimg = get_the_post_thumbnail_url($rid, 'woocommerce_thumbnail');
        $rcats = get_the_terms($rid, 'product_cat');
        $rcat = ($rcats && !is_wp_error($rcats)) ? $rcats[0]->name : '';
        $r_is_rx = leshavin_needs_prescription($rid);
        $r_price_text = 'KSh ' . number_format((float) $rp->get_price(), 2);
        $rwa = urlencode("Hi! I would like to enquire about: " . $rp->get_name() . ' - ' . $r_price_text . ' ' . get_permalink($rid));
        $r_title_short = mb_strlen($rp->get_name()) > 30 ? mb_substr($rp->get_name(), 0, 30) . '…' : $rp->get_name();
      ?>
      <div class="lp-pd-r-card">
        <a href="<?php echo esc_url(get_permalink($rid)); ?>" class="lp-pd-r-img">
          <?php if ($rimg): ?>
            <img src="<?php echo esc_url($rimg); ?>" alt="<?php echo esc_attr($rp->get_name()); ?>" loading="lazy">
          <?php else: ?>
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/></svg>
          <?php endif; ?>
        </a>
        <div class="lp-pd-r-body">
          <?php if ($rcat): ?><div class="lp-pd-r-cat"><?php echo esc_html($rcat); ?></div><?php endif; ?>
          <div class="lp-pd-r-name"><a href="<?php echo esc_url(get_permalink($rid)); ?>"><?php echo esc_html($rp->get_name()); ?></a></div>
          <div class="lp-pd-r-price"><?php echo $r_price_text; ?></div>
          <div class="lp-pd-r-btn-stack">
            <?php if ($r_is_rx): ?>
              <a href="<?php echo esc_url(home_url('/submit-prescription')); ?>" class="lp-pd-r-btn-rx">
                <?php echo leshavin_rx_svg(); ?> Submit Prescription
              </a>
            <?php elseif ($rp->is_type('simple')): ?>
              <button type="button"
                 class="lp-pd-r-btn-cart leshavin-pd-related-atc-btn"
                 data-pid="<?php echo esc_attr($rid); ?>"
                 data-name="<?php echo esc_attr($r_title_short); ?>">
                <?php echo leshavin_cart_svg(); ?> Add to Cart
              </button>
            <?php else: ?>
              <a href="<?php echo esc_url(get_permalink($rid)); ?>" class="lp-pd-r-btn-cart">
                <?php echo leshavin_cart_svg(); ?> Add to Cart
              </a>
            <?php endif; ?>
            <a href="https://wa.me/<?php echo esc_attr($wa); ?>?text=<?php echo $rwa; ?>" class="lp-pd-r-btn-wa" target="_blank" rel="noopener noreferrer">
              <?php echo leshavin_wa_svg(); ?> <?php echo $r_is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

</div>

<script>
(function(){
  var unitPrice   = <?php echo json_encode($price_c); ?>;
  var regPrice    = <?php echo json_encode($sale ? $price_r : 0); ?>;
  var productName = <?php echo json_encode($name); ?>;
  var productUrl  = <?php echo json_encode(get_permalink()); ?>;

  var qtyInput   = document.getElementById('lpPdQtyInput');
  var minusBtn   = document.getElementById('lpPdQtyMinus');
  var plusBtn    = document.getElementById('lpPdQtyPlus');
  var priceCurEl = document.getElementById('lpPdPriceCur');
  var priceOldEl = document.getElementById('lpPdPriceOld');
  var addBtn     = document.getElementById('lpPdAddToCartLink');
  var waBtn      = document.getElementById('lpPdWaBtn');

  function formatKsh(n){
    return 'KSh ' + n.toLocaleString('en-KE', {minimumFractionDigits:2, maximumFractionDigits:2});
  }

  function render(){
    var qty = parseInt(qtyInput.value, 10);
    if (!qty || qty < 1) qty = 1;
    qtyInput.value = qty;

    if (priceCurEl) priceCurEl.textContent = formatKsh(unitPrice * qty);
    if (priceOldEl && regPrice) priceOldEl.textContent = formatKsh(regPrice * qty);

    if (waBtn) {
      var totalText = 'KSh ' + (unitPrice * qty).toFixed(2);
      var msg = "Hello! I'd like to order:\n" + productName + " (Qty: " + qty + ")\nTotal: " + totalText + "\n" + productUrl + "\n\nPlease confirm availability. Thank you!";
      waBtn.setAttribute('href', 'https://wa.me/<?php echo esc_js($wa); ?>?text=' + encodeURIComponent(msg));
    }
  }

  if (minusBtn) minusBtn.addEventListener('click', function(){
    qtyInput.value = Math.max(1, (parseInt(qtyInput.value,10) || 1) - 1);
    render();
  });
  if (plusBtn) plusBtn.addEventListener('click', function(){
    qtyInput.value = (parseInt(qtyInput.value,10) || 1) + 1;
    render();
  });
  if (qtyInput) qtyInput.addEventListener('input', function(){
    this.value = this.value.replace(/[^0-9]/g, '');
    render();
  });
  if (qtyInput) qtyInput.addEventListener('blur', render);

  render();

  // GALLERY THUMBNAIL SWAP
  var mainImgTag = document.getElementById('lpPdMainImgTag');
  document.querySelectorAll('.lp-pd-thumb').forEach(function(btn){
    btn.addEventListener('click', function(){
      document.querySelectorAll('.lp-pd-thumb').forEach(function(b){ b.classList.remove('active'); });
      this.classList.add('active');
      var src = this.getAttribute('data-src');
      if (mainImgTag && src) mainImgTag.setAttribute('src', src);
    });
  });

  /* ---------------------------------------------------------------
     ADD-TO-CART TOAST (main product button)
     Real page reload (updates header cart count) but the page is
     held static via saved/restored scroll position, and a toast
     confirms the action instead of the user seeing a jump.
  --------------------------------------------------------------- */
  var toast       = document.getElementById('leshavin-pd-toast');
  var toastNameEl = document.getElementById('lp-pd-toast-name');
  var toastBar    = document.getElementById('lp-pd-toast-bar');
  var closeBtn    = document.getElementById('lp-pd-toast-close');
  var hideTimer   = null;

  function showToast(label) {
    if (!toast) return;
    if (toastNameEl) toastNameEl.textContent = label || '';
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
  var toastLabel  = params.get('lp_added_name');
  var savedScroll = sessionStorage.getItem('lp_pd_scroll_pos');

  if (toastLabel) {
    if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
    window.addEventListener('load', function () {
      if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
      sessionStorage.removeItem('lp_pd_scroll_pos');
    });
    document.addEventListener('DOMContentLoaded', function () {
      if (savedScroll !== null) window.scrollTo(0, parseInt(savedScroll, 10));
      showToast(decodeURIComponent(toastLabel));
    });
    // Clean the URL so refreshing doesn't re-trigger the toast or re-add the item.
    var cleanUrl = new URL(window.location.href);
    cleanUrl.searchParams.delete('lp_added_name');
    cleanUrl.searchParams.delete('added-to-cart');
    cleanUrl.searchParams.delete('add-to-cart');
    cleanUrl.searchParams.delete('quantity');
    window.history.replaceState(null, '', cleanUrl.toString());
  }

  // Main "Add to Cart" button on this product page
  if (addBtn) {
    addBtn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      var qty  = parseInt(qtyInput ? qtyInput.value : 1, 10) || 1;
      var name = addBtn.getAttribute('data-name');
      var base = addBtn.getAttribute('data-base');

      var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
      sessionStorage.setItem('lp_pd_scroll_pos', scrollY);

      addBtn.classList.add('lp-pd-atc-loading');
      var txtEl = addBtn.querySelector('.lp-pd-atc-txt');
      if (txtEl) txtEl.textContent = 'Adding…';

      var url = new URL(base, window.location.href);
      url.searchParams.set('quantity', qty);
      url.searchParams.set('lp_added_name', encodeURIComponent(name));
      window.location.href = url.toString();
    });
  }

  // "Add to Cart" buttons inside the Related Products grid
  document.querySelectorAll('.leshavin-pd-related-atc-btn').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      var pid  = btn.getAttribute('data-pid');
      var name = btn.getAttribute('data-name');

      var scrollY = window.pageYOffset || document.documentElement.scrollTop || 0;
      sessionStorage.setItem('lp_pd_scroll_pos', scrollY);

      var txtEl = btn.querySelector('span');
      btn.style.opacity = '0.65';
      btn.style.pointerEvents = 'none';

      var url = new URL(window.location.href);
      url.searchParams.set('add-to-cart', pid);
      url.searchParams.set('quantity', '1');
      url.searchParams.set('lp_added_name', encodeURIComponent(name));
      window.location.href = url.toString();
    });
  });
})();
</script>

<?php endwhile; get_footer(); ?>