<?php
/**
 * Leshavin Pharmacy — header.php
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#125a94">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<?php
if ( ! function_exists('leshavin_phone') ) {
  function leshavin_phone() { return '254792331941'; }
}
if ( ! function_exists('leshavin_phone_display') ) {
  function leshavin_phone_display() { return '+254 792 331941'; }
}
if ( ! function_exists('leshavin_email') ) {
  function leshavin_email() { return 'info@leshavinpharmacy.com'; }
}
if ( ! function_exists('leshavin_location') ) {
  function leshavin_location() { return 'Moi Drive, Plot No. Umoja A18, Nairobi, Kenya'; }
}
if ( ! function_exists('leshavin_hours') ) {
  function leshavin_hours() { return 'Mon - Sat: 8:00 AM - 10:00 PM | Closed: Sunday & Public Holidays'; }
}

/** Detects whatever brand taxonomy the store is using, if any. Returns the taxonomy slug or false. */
if ( ! function_exists('leshavin_brand_taxonomy') ) {
  function leshavin_brand_taxonomy() {
    $candidates = [ 'product_brand', 'pwb-brand', 'pa_brand', 'yith_product_brand' ];
    foreach ( $candidates as $tax ) {
      if ( taxonomy_exists( $tax ) ) return $tax;
    }
    return false;
  }
}
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

/* Prevent the whole document from ever scrolling/cropping sideways —
   important on mobile where the nav drawer sits at a fixed width. */
html, body { overflow-x: clip; max-width: 100%; }

:root{
  --lph-navy:#0e2358;
  --lph-blue:#1c75bc;
  --lph-blue-dark:#125a94;
  --lph-blue-pale:#eaf3fb;
  --lph-green:#8dc63f;
  --lph-green-dark:#6ea82e;
  --lph-green-pale:#f2f9e9;
  --lph-text:#1c2b3a;
  --lph-text-light:#6b7c8f;
  --lph-border:#e4e9ef;
  --lph-font-head:'Oswald',Arial Narrow,sans-serif;
  --lph-font-body:'Inter',sans-serif;
  --lph-px:40px;
}
body{font-family:var(--lph-font-body);}

/* ============================================================
   TOP BAR (auto-hides on scroll — see JS at bottom)
   ============================================================ */
.lph-topbar{
  background:var(--lph-navy);
  color:rgba(255,255,255,.85);
  font-size:.76rem;
  padding:8px var(--lph-px);
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:18px;
  flex-wrap:wrap;
  max-height:140px;
  opacity:1;
  overflow:hidden;
  transition:max-height .35s ease, opacity .28s ease, padding .35s ease;
}
.lph-topbar.lph-topbar-hidden{
  max-height:0;
  opacity:0;
  padding-top:0;
  padding-bottom:0;
}
.lph-topbar-info{display:flex;align-items:center;gap:22px;flex-wrap:wrap;}
.lph-topbar-item{display:flex;align-items:center;gap:7px;white-space:nowrap;}
.lph-topbar-item svg{width:13px;height:13px;flex-shrink:0;color:var(--lph-green);}
.lph-topbar-item a{color:inherit;text-decoration:none;}
.lph-topbar-item a:hover{color:#fff;}
.lph-topbar-phone-only{display:none;}
.lph-topbar-socials{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.lph-tsoc{
  display:flex;align-items:center;justify-content:center;
  width:24px;height:24px;border-radius:50%;
  background:rgba(255,255,255,.12);color:#fff;
  transition:background .2s,transform .2s;flex-shrink:0;
}
.lph-tsoc:hover{background:var(--lph-green-dark);transform:translateY(-1px);}
.lph-tsoc svg{width:11px;height:11px;}

/* ============================================================
   STICKY WRAP — holds main header + desktop navbar.
   Default: normal document flow (position:relative).
   JS adds `.lph-fixed` once you scroll past the topbar,
   switching it to position:fixed so it always stays pinned
   to the top — this does NOT depend on any ancestor being
   free of overflow/transform the way CSS `position:sticky`
   does, so it survives whatever wrapper markup the theme
   or page builder injects around header.php.
   ============================================================ */
.lph-sticky-wrap{
  position:relative;
  z-index:500;
  background:#fff;
  width:100%;
  transition:box-shadow .25s ease;
}
.lph-sticky-wrap.lph-fixed{
  position:fixed;
  top:0;
  left:0;
  right:0;
  box-shadow:0 6px 20px rgba(14,35,88,.16);
}
/* Placeholder that reserves the header's height in normal flow
   while the real header is position:fixed, so page content
   below doesn't jump upward. Height is set/cleared via JS. */
.lph-sticky-placeholder{
  display:block;
  width:100%;
  height:0;
}

/* ============================================================
   MAIN HEADER
   ============================================================ */
.lph-header{
  background:#fff;
  display:flex;
  align-items:center;
  gap:24px;
  padding:16px var(--lph-px);
  flex-wrap:wrap;
  border-bottom:1px solid var(--lph-border);
}

.lph-logo{display:flex;flex-direction:column;align-items:flex-start;gap:2px;text-decoration:none;flex-shrink:0;min-width:0;}

/* Logo sizing — covers both the manual <img class="lph-logo-img"> fallback
   AND WordPress's own the_custom_logo() markup (.custom-logo-link / .custom-logo),
   which is NOT covered by .lph-logo-img alone. Without this second block, any
   logo set via Customizer > Site Identity renders at its native uploaded size. */
.lph-logo-img,
.custom-logo-link img,
.custom-logo{
  height:52px !important;
  width:auto !important;
  max-width:220px !important;
  object-fit:contain !important;
  display:block !important;
  flex-shrink:0 !important;
}
.custom-logo-link{
  display:flex !important;
  align-items:center !important;
  flex-shrink:0 !important;
  text-decoration:none !important;
}

/* The logo image already contains the "Leshavin Pharmacy" wordmark, so lph-logo-text
   now carries only the slogan, stacked underneath (desktop only — hidden on mobile, see 900px query). */
.lph-logo-text{display:flex;flex-direction:column;justify-content:center;line-height:1.15;min-width:0;}
.lph-logo-sub{font-family:var(--lph-font-head);font-size:.68rem;font-weight:600;letter-spacing:.14em;text-transform:uppercase;color:var(--lph-text-light);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-left:2px;}

.lph-search{flex:1;max-width:560px;margin:0 auto;min-width:0;}
.lph-search form{display:flex;border-radius:6px;overflow:hidden;border:1.5px solid var(--lph-border);}
.lph-search form:focus-within{border-color:var(--lph-blue);}
.lph-search input[type="search"]{flex:1;border:none;outline:none;padding:11px 16px;font-size:.86rem;color:var(--lph-text);min-width:0;font-family:var(--lph-font-body);}
.lph-search input[type="search"]::placeholder{color:#a7b2bf;}
.lph-search button{background:var(--lph-blue-dark);color:#fff;border:none;padding:0 20px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s;flex-shrink:0;}
.lph-search button:hover{background:var(--lph-navy);}
.lph-search button svg{width:16px;height:16px;}

.lph-header-actions{display:flex;align-items:center;gap:22px;flex-shrink:0;margin-left:auto;}

.lph-call{display:flex;align-items:center;gap:10px;text-decoration:none;color:var(--lph-text);white-space:nowrap;}
.lph-call-icon{width:38px;height:38px;border-radius:50%;background:var(--lph-blue-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.lph-call-icon svg{width:17px;height:17px;color:var(--lph-blue-dark);}
.lph-call-text{display:flex;flex-direction:column;line-height:1.2;}
.lph-call-label{font-size:.68rem;color:var(--lph-text-light);}
.lph-call-num{font-family:var(--lph-font-head);font-size:.92rem;font-weight:600;color:var(--lph-blue-dark);}

/* ============================================================
   CART + HOVER DROPDOWN (desktop only)
   ============================================================ */
.lph-cart-wrap{position:relative;flex-shrink:0;}
.lph-cart{display:flex;align-items:center;gap:10px;text-decoration:none;color:var(--lph-text);white-space:nowrap;position:relative;}
.lph-cart-icon-wrap{width:38px;height:38px;border-radius:50%;background:var(--lph-green-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;}
.lph-cart-icon-wrap svg{width:17px;height:17px;color:var(--lph-green-dark);}
.lph-cart-badge{position:absolute;top:-4px;right:-4px;background:var(--lph-green-dark);color:#fff;font-size:.62rem;font-weight:700;min-width:16px;height:16px;border-radius:50%;display:flex;align-items:center;justify-content:center;padding:0 3px;border:2px solid #fff;}
.lph-cart-text{display:flex;flex-direction:column;line-height:1.2;}
.lph-cart-label{font-size:.68rem;color:var(--lph-text-light);}
.lph-cart-total{font-family:var(--lph-font-head);font-size:.92rem;font-weight:600;color:var(--lph-blue-dark);}

.lph-cart-dropdown{
  position:absolute;top:100%;right:0;width:340px;
  background:#fff;border-radius:12px;
  box-shadow:0 18px 40px rgba(14,35,88,.18);
  border:1px solid var(--lph-border);border-top:3px solid var(--lph-green);
  opacity:0;visibility:hidden;transform:translateY(8px);
  transition:opacity .18s ease,transform .18s ease,visibility .18s;
  z-index:70;padding-top:10px;
}
.lph-cart-wrap:hover .lph-cart-dropdown{opacity:1;visibility:visible;transform:translateY(0);}
.lph-cart-dropdown-inner{padding:14px;}
.lph-cart-dropdown-head{
  font-family:var(--lph-font-head);font-weight:700;font-size:.82rem;text-transform:uppercase;
  letter-spacing:.03em;color:var(--lph-blue-dark);padding-bottom:10px;margin-bottom:10px;
  border-bottom:1.5px solid var(--lph-border);
}
.lph-cart-items{max-height:280px;overflow-y:auto;display:flex;flex-direction:column;gap:10px;margin-bottom:12px;}
.lph-cart-item{display:flex;align-items:center;gap:10px;}
.lph-cart-item-img{
  width:46px;height:46px;border-radius:8px;border:1.5px solid var(--lph-border);
  background:var(--lph-blue-pale);display:flex;align-items:center;justify-content:center;
  overflow:hidden;flex-shrink:0;
}
.lph-cart-item-img img{width:100%;height:100%;object-fit:contain;}
.lph-cart-item-info{flex:1;min-width:0;}
.lph-cart-item-name{font-size:.8rem;font-weight:600;color:var(--lph-text);line-height:1.3;
  display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.lph-cart-item-meta{font-size:.72rem;color:var(--lph-text-light);margin-top:2px;}
.lph-cart-item-price{font-family:var(--lph-font-head);font-size:.82rem;font-weight:600;color:var(--lph-blue-dark);white-space:nowrap;flex-shrink:0;}

.lph-cart-empty{padding:18px 4px;text-align:center;font-size:.82rem;color:var(--lph-text-light);}
.lph-cart-empty svg{width:30px;height:30px;color:var(--lph-border);margin-bottom:8px;}

.lph-cart-subtotal-row{
  display:flex;align-items:center;justify-content:space-between;
  padding-top:10px;margin-top:2px;border-top:1.5px solid var(--lph-border);
  font-family:var(--lph-font-head);font-size:.86rem;font-weight:700;color:var(--lph-navy);
}
.lph-cart-subtotal-row span:last-child{color:var(--lph-green-dark);font-size:1rem;}

/* Buttons sit side by side, not stacked */
.lph-cart-dropdown-btns{display:flex;flex-direction:row;gap:8px;margin-top:12px;}
.lph-cart-btn-view,.lph-cart-btn-checkout{
  display:flex;align-items:center;justify-content:center;gap:7px;
  flex:1 1 0;min-width:0;
  padding:11px 12px;border-radius:7px;font-family:var(--lph-font-head);
  font-weight:600;font-size:.8rem;text-transform:uppercase;letter-spacing:.02em;
  text-decoration:none;transition:background .2s,transform .15s;
  white-space:nowrap;
}
.lph-cart-btn-view{background:var(--lph-blue-pale);color:var(--lph-blue-dark);}
.lph-cart-btn-view:hover{background:#dbe9f6;}
.lph-cart-btn-checkout{background:var(--lph-green-dark);color:#fff;}
.lph-cart-btn-checkout:hover{background:#5b8e26;transform:translateY(-1px);}

/* Empty-state has only one button, so let it take the full width */
.lph-cart-dropdown-btns.lph-cart-dropdown-btns-single .lph-cart-btn-view{flex:1 1 100%;}

.lph-hamburger{
  display:none;background:var(--lph-blue-pale);border:none;cursor:pointer;
  flex-direction:column;gap:5px;padding:10px;border-radius:6px;flex-shrink:0;transition:background .2s;
}
.lph-hamburger:hover{background:#dbe9f6;}
.lph-hamburger span{display:block;width:20px;height:2px;background:var(--lph-blue-dark);border-radius:2px;}

/* ============================================================
   DESKTOP NAVBAR
   ============================================================ */
.lph-navbar{background:var(--lph-blue-dark);position:relative;z-index:60;}
.lph-navbar-list{display:flex;align-items:stretch;list-style:none;margin:0;padding:0 var(--lph-px);flex-wrap:wrap;}
.lph-navbar-list > li{position:relative;display:flex;}
.lph-navbar-list > li > a{
  display:flex;align-items:center;gap:6px;
  padding:14px 18px;font-size:.82rem;font-weight:600;
  font-family:var(--lph-font-head);text-transform:uppercase;letter-spacing:.03em;
  color:rgba(255,255,255,.9);white-space:nowrap;text-decoration:none;
  border-bottom:3px solid transparent;
  transition:background .2s,color .15s,border-color .2s;
}
.lph-navbar-list > li > a:hover,
.lph-navbar-list > li > a.active,
.lph-navbar-list > li.lph-drop:hover > a{
  background:rgba(0,0,0,.16);color:var(--lph-green);border-bottom-color:var(--lph-green);
}
.lph-navbar-list > li > a svg{width:11px;height:11px;flex-shrink:0;transition:transform .2s;}
.lph-navbar-list > li.lph-drop:hover > a svg{transform:rotate(180deg);}

.lph-nav-spacer{flex:1;}

.lph-nav-contact > a{
  background:var(--lph-green-dark) !important;color:#fff !important;
  border-radius:50px !important;border-bottom:none !important;
  margin:8px 0 8px 8px !important;padding:8px 22px !important;
  font-weight:700 !important;transition:background .2s,transform .15s !important;
}
.lph-nav-contact > a:hover{background:#5b8e26 !important;color:#fff !important;transform:translateY(-1px);}

/* Dropdown panel */
.lph-dropdown{
  position:absolute;top:100%;left:0;min-width:230px;
  background:#fff;border-radius:0 0 8px 8px;
  box-shadow:0 16px 34px rgba(14,35,88,.18);
  border:1px solid var(--lph-border);border-top:3px solid var(--lph-green);
  opacity:0;visibility:hidden;transform:translateY(8px);
  transition:opacity .18s ease,transform .18s ease,visibility .18s;
  padding:8px 0;max-height:70vh;overflow-y:auto;
}
.lph-drop:hover .lph-dropdown{opacity:1;visibility:visible;transform:translateY(0);}
.lph-dropdown a{
  display:block;padding:10px 20px;font-size:.82rem;font-weight:500;
  color:var(--lph-text);text-decoration:none;font-family:var(--lph-font-body);
  transition:background .15s,color .15s,padding-left .15s;
}
.lph-dropdown a:hover{background:var(--lph-green-pale);color:var(--lph-green-dark);padding-left:26px;}
.lph-dropdown-empty{padding:12px 20px;font-size:.8rem;color:var(--lph-text-light);}

/* ============================================================
   MOBILE NAV DRAWER
   Fully responsive: width scales with viewport (vw) instead of a
   fixed px value, capped with max-width so it stays a reasonable
   size on tablets. Slides in/out with transform (translateX)
   rather than animating "left", which is more reliable across
   different screen widths and avoids the drawer overshooting or
   misaligning on small phones.
   ============================================================ */
.lph-mnav-overlay{display:none;position:fixed;inset:0;background:rgba(10,20,45,.5);z-index:998;backdrop-filter:blur(2px);}
.lph-mnav-overlay.open{display:block;}
.lph-mnav{
  position:fixed;top:0;left:0;
  width:82vw;max-width:300px;min-width:0;
  height:100%;height:100dvh;
  background:#fff;z-index:999;
  transform:translateX(-100%);
  transition:transform .3s ease;
  overflow-y:auto;-webkit-overflow-scrolling:touch;
  box-shadow:4px 0 24px rgba(0,0,0,.18);
  box-sizing:border-box;
}
.lph-mnav.open{transform:translateX(0);}
.lph-mnav-head{
  background:var(--lph-blue-dark);padding:16px 18px;
  display:flex;align-items:center;justify-content:space-between;gap:10px;
}
.lph-mnav-brand{display:flex;align-items:center;gap:9px;text-decoration:none;min-width:0;}
.lph-mnav-brand img{height:34px !important;width:auto !important;max-width:160px !important;object-fit:contain !important;display:block !important;}
.lph-mnav-close{background:rgba(255,255,255,.15);border:none;color:#fff;font-size:16px;cursor:pointer;width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;transition:background .2s;flex-shrink:0;}
.lph-mnav-close:hover{background:rgba(255,255,255,.3);}

.lph-mnav a.lph-mnav-link{
  display:block;padding:13px 22px;font-size:.85rem;font-weight:600;
  font-family:var(--lph-font-head);text-transform:uppercase;letter-spacing:.02em;
  color:var(--lph-text);border-bottom:1px solid #f0f0f0;text-decoration:none;
  transition:background .15s,color .15s,padding-left .2s;
  word-break:break-word;
}
.lph-mnav a.lph-mnav-link:hover{background:var(--lph-green-pale);color:var(--lph-green-dark);padding-left:30px;}
.lph-mnav a.lph-mnav-link.active{background:var(--lph-green-pale);color:var(--lph-green-dark);border-left:4px solid var(--lph-green);padding-left:18px;}

.lph-mnav details{border-bottom:1px solid #f0f0f0;}
.lph-mnav summary{
  display:flex;align-items:center;justify-content:space-between;gap:8px;
  padding:13px 22px;font-size:.85rem;font-weight:600;
  font-family:var(--lph-font-head);text-transform:uppercase;letter-spacing:.02em;
  color:var(--lph-text);cursor:pointer;list-style:none;
}
.lph-mnav summary::-webkit-details-marker{display:none;}
.lph-mnav summary svg{width:11px;height:11px;transition:transform .2s;flex-shrink:0;color:var(--lph-text-light);}
.lph-mnav details[open] summary svg{transform:rotate(180deg);}
.lph-mnav details[open] summary{background:var(--lph-green-pale);color:var(--lph-green-dark);}
.lph-mnav-sub{padding:4px 0 8px;background:#fafbfc;}
.lph-mnav-sub a{
  display:block;padding:9px 22px 9px 34px;font-size:.8rem;font-weight:500;
  color:var(--lph-text-light);text-decoration:none;font-family:var(--lph-font-body);
  transition:color .15s,padding-left .15s;
  word-break:break-word;
}
.lph-mnav-sub a:hover{color:var(--lph-green-dark);padding-left:38px;}
.lph-mnav-sub-empty{padding:9px 22px 9px 34px;font-size:.78rem;color:var(--lph-text-light);}

.lph-mnav-contact{
  margin:16px 22px;display:flex;align-items:center;justify-content:center;gap:7px;
  background:var(--lph-green-dark);color:#fff !important;border-radius:50px;
  padding:11px 22px !important;font-size:.85rem;font-weight:700;
  border-bottom:none !important;transition:background .2s !important;
}
.lph-mnav-contact:hover{background:#5b8e26 !important;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1100px){
  .lph-call-text,.lph-cart-text{display:none;}
}

/* ---- Tablet / mobile: topbar becomes a compact single-row
       scroll strip instead of disappearing, navbar hidden in
       favour of the drawer, header becomes a Family-Drugmart
       style grid (hamburger | logo | actions, search full row) ---- */
@media(max-width:900px){
  :root{--lph-px:16px;}

  .lph-navbar{display:none;}
  .lph-hamburger{display:flex;}

  /* Topbar — compact, horizontally scrollable, stays visible until scroll */
  .lph-topbar{
    padding:7px 14px;
    gap:10px;
    flex-wrap:nowrap;
  }
  /* Topbar — on mobile show a phone number only (email/location/hours get too cramped) */
  .lph-topbar-item:not(.lph-topbar-phone-only){display:none;}
  .lph-topbar-phone-only{display:flex;}
  .lph-topbar-info{
    flex-wrap:nowrap;
    gap:16px;
    flex:1;
    min-width:0;
  }
  .lph-topbar-item{font-size:.72rem;}
  .lph-topbar-socials{flex-shrink:0;}

  /* Header grid: hamburger | logo | actions  //  search (full width) */
  .lph-header{
    display:grid;
    grid-template-columns:auto 1fr auto;
    grid-template-rows:auto auto;
    align-items:center;
    gap:0;
    padding:0;
  }
  .lph-hamburger{
    grid-column:1;grid-row:1;
    margin:0;border-radius:0;
    align-self:stretch;min-height:56px;
    background:var(--lph-blue-pale);
    border-right:1px solid var(--lph-border);
    justify-content:center;
  }
  .lph-hamburger:hover{background:#dbe9f6;}

  .lph-logo{
    grid-column:2;grid-row:1;
    padding:8px 10px;
    min-width:0;overflow:hidden;
  }
  .lph-logo-img,
  .custom-logo-link img,
  .custom-logo{height:38px !important;max-width:160px !important;}
  .lph-logo-sub{display:none;}

  .lph-header-actions{
    grid-column:3;grid-row:1;
    margin-left:0;gap:2px;
    padding:0 6px;
    align-self:stretch;align-items:center;
    border-left:1px solid var(--lph-border);
  }
  .lph-call-icon,.lph-cart-icon-wrap{width:34px;height:34px;}

  /* Cart hover dropdown is desktop-only behaviour; on touch devices the
     link just navigates straight to the cart page as before. */
  .lph-cart-dropdown{display:none;}

  .lph-search{
    grid-column:1 / -1;grid-row:2;
    max-width:100%;margin:0;
    padding:8px 14px;
    background:#f7f9fb;
    border-top:1px solid var(--lph-border);
  }
}

/* ---- Small phones: drawer takes a bit more of the viewport
       width since 82vw of a very narrow screen still leaves it
       feeling cramped ---- */
@media(max-width:420px){
  .lph-mnav{width:86vw;max-width:320px;}
}

@media(max-width:480px){
  .lph-call{display:none;}
  .lph-header-actions{gap:0;}
}
</style>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$lph_shop_url    = function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id('shop') ) : home_url('/shop');
$lph_categories  = get_terms([ 'taxonomy'=>'product_cat','hide_empty'=>true,'parent'=>0,'number'=>14 ]);
$lph_brand_tax   = leshavin_brand_taxonomy();
$lph_brands      = $lph_brand_tax ? get_terms([ 'taxonomy'=>$lph_brand_tax,'hide_empty'=>true,'number'=>14 ]) : false;
$lph_has_brands  = $lph_brands && ! is_wp_error( $lph_brands ) && count( $lph_brands ) > 0;
?>

<!-- ==================== MOBILE NAV DRAWER ==================== -->
<div class="lph-mnav-overlay" id="lphMnavOverlay"></div>
<nav class="lph-mnav" id="lphMnav" aria-label="Mobile navigation">
  <div class="lph-mnav-head">
    <a href="<?php echo esc_url( home_url('/') ); ?>" class="lph-mnav-brand" aria-label="Leshavin Pharmacy, go to homepage">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/logo2.png' ); ?>" alt="Leshavin Pharmacy">
    </a>
    <button class="lph-mnav-close" id="lphMnavClose" aria-label="Close menu">&#x2715;</button>
  </div>

  <a href="<?php echo esc_url( home_url('/') ); ?>" class="lph-mnav-link<?php echo is_front_page() ? ' active' : ''; ?>">Home</a>

  <details>
    <summary>
      Shop
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
    </summary>
    <div class="lph-mnav-sub">
      <?php if ( $lph_categories && ! is_wp_error( $lph_categories ) && count( $lph_categories ) ) : ?>
        <?php foreach ( $lph_categories as $lph_cat ) : ?>
          <a href="<?php echo esc_url( get_term_link( $lph_cat ) ); ?>"><?php echo esc_html( $lph_cat->name ); ?></a>
        <?php endforeach; ?>
      <?php else : ?>
        <div class="lph-mnav-sub-empty">No categories yet</div>
      <?php endif; ?>
    </div>
  </details>

  <?php if ( $lph_has_brands ) : ?>
  <details>
    <summary>
      Brands
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"/></svg>
    </summary>
    <div class="lph-mnav-sub">
      <?php foreach ( $lph_brands as $lph_brand ) : ?>
        <a href="<?php echo esc_url( get_term_link( $lph_brand, $lph_brand_tax ) ); ?>"><?php echo esc_html( $lph_brand->name ); ?></a>
      <?php endforeach; ?>
    </div>
  </details>
  <?php endif; ?>

  <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="lph-mnav-link<?php echo is_page('submit-prescription') ? ' active' : ''; ?>">Submit submit-prescription</a>
  <a href="<?php echo esc_url( home_url('/about-us') ); ?>" class="lph-mnav-link<?php echo is_page('about-us') ? ' active' : ''; ?>">About Us</a>
  <a href="<?php echo esc_url( home_url('/return-policy') ); ?>" class="lph-mnav-link<?php echo is_page('return-policy') ? ' active' : ''; ?>">Return Policy</a>

  <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="lph-mnav-contact">Contact Us</a>
</nav>

<!-- ==================== TOP BAR (hides on scroll) ==================== -->
<div class="lph-topbar" id="lphTopbar">
  <div class="lph-topbar-info">
    <span class="lph-topbar-item lph-topbar-phone-only">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
      <a href="tel:+<?php echo esc_attr( leshavin_phone() ); ?>"><?php echo esc_html( leshavin_phone_display() ); ?></a>
    </span>
    <span class="lph-topbar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      <a href="mailto:<?php echo esc_attr( leshavin_email() ); ?>"><?php echo esc_html( leshavin_email() ); ?></a>
    </span>
    <span class="lph-topbar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <?php echo esc_html( leshavin_location() ); ?>
    </span>
    <span class="lph-topbar-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <?php echo esc_html( leshavin_hours() ); ?>
    </span>
  </div>
  <div class="lph-topbar-socials">
    <a href="<?php echo esc_url( get_option('leshavin_facebook','#') ); ?>" target="_blank" rel="noopener noreferrer" class="lph-tsoc" aria-label="Facebook">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
    </a>
    <a href="<?php echo esc_url( get_option('leshavin_instagram','#') ); ?>" target="_blank" rel="noopener noreferrer" class="lph-tsoc" aria-label="Instagram">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/></svg>
    </a>
    <a href="https://wa.me/<?php echo esc_attr( leshavin_phone() ); ?>" target="_blank" rel="noopener noreferrer" class="lph-tsoc" aria-label="WhatsApp">
      <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
  </div>
</div>

<!-- ==================== STICKY WRAP: MAIN HEADER + DESKTOP NAVBAR ==================== -->
<div class="lph-sticky-wrap" id="lphStickyWrap">

  <!-- ==================== MAIN HEADER ==================== -->
  <div class="lph-header">

    <button class="lph-hamburger" id="lphHamburgerBtn" aria-label="Open menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <a href="<?php echo esc_url( home_url('/') ); ?>" class="lph-logo" aria-label="Leshavin Pharmacy, go to homepage">
      <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/logo2.png' ); ?>" alt="Leshavin Pharmacy Logo" class="lph-logo-img" loading="eager" decoding="async">
        <div class="lph-logo-text">
          <span class="lph-logo-sub">Reliable Care At Your Doorstep</span>
        </div>
      <?php endif; ?>
    </a>

    <div class="lph-search">
      <form role="search" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
        <input class="lph-search-input" type="search" name="s" placeholder="Search for medicines, health products..." value="<?php echo get_search_query(); ?>">
        <input type="hidden" name="post_type" value="product">
        <button type="submit" aria-label="Search">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </button>
      </form>
    </div>

    <div class="lph-header-actions">
      <a href="https://wa.me/<?php echo esc_attr( leshavin_phone() ); ?>" target="_blank" rel="noopener noreferrer" class="lph-call">
        <span class="lph-call-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
        </span>
        <span class="lph-call-text">
          <span class="lph-call-label">Call / WhatsApp</span>
          <span class="lph-call-num"><?php echo esc_html( leshavin_phone_display() ); ?></span>
        </span>
      </a>

      <?php if ( function_exists('WC') && WC()->cart ) :
        $lph_cart_count = WC()->cart->get_cart_contents_count();
        $lph_cart_total = WC()->cart->get_cart_total();
        $lph_cart_url   = wc_get_cart_url();
        $lph_checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout');
        $lph_cart_items = WC()->cart->get_cart();
      ?>
      <div class="lph-cart-wrap">
        <a href="<?php echo esc_url( $lph_cart_url ); ?>" class="lph-cart" aria-label="View cart">
          <span class="lph-cart-icon-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 00 1.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
            <?php if ( $lph_cart_count > 0 ) : ?>
              <span class="lph-cart-badge"><?php echo intval( $lph_cart_count ); ?></span>
            <?php endif; ?>
          </span>
          <span class="lph-cart-text">
            <span class="lph-cart-label">My Cart</span>
            <span class="lph-cart-total"><?php echo $lph_cart_total; ?></span>
          </span>
        </a>

        <!-- Hover dropdown — desktop only (hidden on ≤900px, see media query) -->
        <div class="lph-cart-dropdown">
          <div class="lph-cart-dropdown-inner">
            <div class="lph-cart-dropdown-head">Shopping Cart (<?php echo intval( $lph_cart_count ); ?>)</div>

            <?php if ( ! empty( $lph_cart_items ) ) : ?>
              <div class="lph-cart-items">
                <?php foreach ( $lph_cart_items as $lph_ci_key => $lph_ci ) :
                  $lph_ci_product = $lph_ci['data'];
                  if ( ! $lph_ci_product ) continue;
                  $lph_ci_img   = $lph_ci_product->get_image_id() ? wp_get_attachment_image_url( $lph_ci_product->get_image_id(), 'thumbnail' ) : '';
                  $lph_ci_name  = $lph_ci_product->get_name();
                  $lph_ci_qty   = $lph_ci['quantity'];
                  $lph_ci_price = WC()->cart->get_product_subtotal( $lph_ci_product, $lph_ci_qty );
                ?>
                <div class="lph-cart-item">
                  <div class="lph-cart-item-img">
                    <?php if ( $lph_ci_img ) : ?>
                      <img src="<?php echo esc_url( $lph_ci_img ); ?>" alt="<?php echo esc_attr( $lph_ci_name ); ?>">
                    <?php else : ?>
                      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color:var(--lph-blue-dark);opacity:.4;"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/></svg>
                    <?php endif; ?>
                  </div>
                  <div class="lph-cart-item-info">
                    <div class="lph-cart-item-name"><?php echo esc_html( $lph_ci_name ); ?></div>
                    <div class="lph-cart-item-meta">Qty: <?php echo intval( $lph_ci_qty ); ?></div>
                  </div>
                  <div class="lph-cart-item-price"><?php echo $lph_ci_price; ?></div>
                </div>
                <?php endforeach; ?>
              </div>

              <div class="lph-cart-subtotal-row">
                <span>Subtotal</span>
                <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
              </div>

              <div class="lph-cart-dropdown-btns">
                <a href="<?php echo esc_url( $lph_cart_url ); ?>" class="lph-cart-btn-view">View Cart</a>
                <a href="<?php echo esc_url( $lph_checkout_url ); ?>" class="lph-cart-btn-checkout">Checkout</a>
              </div>

            <?php else : ?>
              <div class="lph-cart-empty">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>
                <div>Your cart is empty.</div>
              </div>
              <div class="lph-cart-dropdown-btns lph-cart-dropdown-btns-single">
                <a href="<?php echo esc_url( $lph_shop_url ); ?>" class="lph-cart-btn-view">Browse Products</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- ==================== DESKTOP NAVBAR ==================== -->
  <nav class="lph-navbar" aria-label="Primary navigation">
    <ul class="lph-navbar-list">
      <li><a href="<?php echo esc_url( home_url('/') ); ?>"<?php echo is_front_page() ? ' class="active"' : ''; ?>>Home</a></li>

      <li class="lph-drop">
        <a href="<?php echo esc_url( $lph_shop_url ); ?>">
          Shop
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="lph-dropdown">
          <?php if ( $lph_categories && ! is_wp_error( $lph_categories ) && count( $lph_categories ) ) : ?>
            <?php foreach ( $lph_categories as $lph_cat ) : ?>
              <a href="<?php echo esc_url( get_term_link( $lph_cat ) ); ?>"><?php echo esc_html( $lph_cat->name ); ?></a>
            <?php endforeach; ?>
          <?php else : ?>
            <div class="lph-dropdown-empty">No categories yet</div>
          <?php endif; ?>
        </div>
      </li>

      <?php if ( $lph_has_brands ) : ?>
      <li class="lph-drop">
        <a href="#" onclick="return false;">
          Brands
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M6 9l6 6 6-6"/></svg>
        </a>
        <div class="lph-dropdown">
          <?php foreach ( $lph_brands as $lph_brand ) : ?>
            <a href="<?php echo esc_url( get_term_link( $lph_brand, $lph_brand_tax ) ); ?>"><?php echo esc_html( $lph_brand->name ); ?></a>
          <?php endforeach; ?>
        </div>
      </li>
      <?php endif; ?>

      <li><a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>"<?php echo is_page('submit-prescription') ? ' class="active"' : ''; ?>>Submit submit-prescription</a></li>
      <li><a href="<?php echo esc_url( home_url('/about-us') ); ?>"<?php echo is_page('about-us') ? ' class="active"' : ''; ?>>About Us</a></li>
      <li><a href="<?php echo esc_url( home_url('/return-policy') ); ?>"<?php echo is_page('return-policy') ? ' class="active"' : ''; ?>>Return Policy</a></li>

      <li class="lph-nav-spacer" aria-hidden="true"></li>

      <li class="lph-nav-contact">
        <a href="<?php echo esc_url( home_url('/contact') ); ?>"<?php echo is_page('contact') ? ' class="active"' : ''; ?>>Contact Us</a>
      </li>
    </ul>
  </nav>

</div><!-- /.lph-sticky-wrap -->

<!-- Placeholder that keeps the page from jumping once the header
     above goes position:fixed — its height is set in JS below. -->
<div class="lph-sticky-placeholder" id="lphStickyPlaceholder"></div>

<script>
(function(){
  var btn = document.getElementById('lphHamburgerBtn');
  var nav = document.getElementById('lphMnav');
  var ovl = document.getElementById('lphMnavOverlay');
  var cls = document.getElementById('lphMnavClose');

  function openNav(){
    nav.classList.add('open');
    ovl.classList.add('open');
    btn.setAttribute('aria-expanded','true');
    document.body.style.overflow = 'hidden';
  }
  function closeNav(){
    nav.classList.remove('open');
    ovl.classList.remove('open');
    btn.setAttribute('aria-expanded','false');
    document.body.style.overflow = '';
  }
  if(btn) btn.addEventListener('click', openNav);
  if(cls) cls.addEventListener('click', closeNav);
  if(ovl) ovl.addEventListener('click', closeNav);

  /* ── Topbar auto-hide + header fixed-on-scroll (mobile & desktop) ──
     Instead of relying on CSS position:sticky (which breaks the
     moment ANY ancestor has overflow/transform/filter/contain set —
     extremely common in WordPress themes and page builders), the
     header is switched to position:fixed via JS once the user has
     scrolled past the topbar. A placeholder div reserves its height
     in the normal document flow so nothing jumps. */
  var topbar      = document.getElementById('lphTopbar');
  var stickyWrap  = document.getElementById('lphStickyWrap');
  var placeholder = document.getElementById('lphStickyPlaceholder');

  function onScroll(){
    var scrolled = window.scrollY > 30;

    if (topbar) topbar.classList.toggle('lph-topbar-hidden', scrolled);

    if (stickyWrap && placeholder) {
      if (scrolled) {
        if (!stickyWrap.classList.contains('lph-fixed')) {
          // Lock in the header's current height BEFORE going fixed,
          // so the placeholder can hold that exact amount of space.
          placeholder.style.height = stickyWrap.offsetHeight + 'px';
          stickyWrap.classList.add('lph-fixed');
        }
      } else {
        stickyWrap.classList.remove('lph-fixed');
        placeholder.style.height = '0px';
      }
    }
  }

  // Recalculate on resize too (e.g. rotating a tablet/phone, or the
  // hamburger/search layout reflowing at the 900px breakpoint) so the
  // placeholder height stays accurate.
  function onResize(){
    if (stickyWrap && stickyWrap.classList.contains('lph-fixed') && placeholder) {
      stickyWrap.classList.remove('lph-fixed');
      placeholder.style.height = '0px';
      // Force a reflow read of the natural height, then re-apply.
      var naturalHeight = stickyWrap.offsetHeight;
      stickyWrap.classList.add('lph-fixed');
      placeholder.style.height = naturalHeight + 'px';
    }
  }

  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onResize);
  onScroll();
})();
</script>

<?php if ( ! is_front_page() ) : ?>
<div class="site-breadcrumb" style="padding:12px 40px;font-size:13px;color:var(--lph-text-light);display:flex;gap:6px;align-items:center;flex-wrap:wrap;">
  <a href="<?php echo esc_url( home_url('/') ); ?>" style="color:var(--lph-blue-dark);text-decoration:none;">Home</a>
  <?php if ( is_shop() ) : ?>
    <span>&#8250;</span><span>Shop</span>
  <?php elseif ( is_singular('product') ) : ?>
    <span>&#8250;</span>
    <?php if ( function_exists('wc_get_page_id') ) : ?><a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" style="color:var(--lph-blue-dark);text-decoration:none;">Shop</a><?php endif; ?>
    <span>&#8250;</span><span><?php the_title(); ?></span>
  <?php elseif ( is_product_category() ) : ?>
    <span>&#8250;</span>
    <?php if ( function_exists('wc_get_page_id') ) : ?><a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" style="color:var(--lph-blue-dark);text-decoration:none;">Shop</a><?php endif; ?>
    <span>&#8250;</span><span><?php single_cat_title(); ?></span>
  <?php elseif ( is_page() ) : ?>
    <span>&#8250;</span><span><?php the_title(); ?></span>
  <?php endif; ?>
</div>
<?php endif; ?>