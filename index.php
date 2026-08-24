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
.lp-btn-navy,.lp-btn-outline{display:inline-flex;align-items:center;gap:8px;padding:13px 26px;border-radius:6px;font-weight:600;font-size:.85rem;text-decoration:none;font-family:var(--lp-font-head);text-transform:uppercase;letter-spacing:.04em;border:2px solid transparent;transition:opacity .15s,transform .15s;}
.lp-btn-navy{background:var(--lp-blue);color:#fff;}
.lp-btn-navy:hover{opacity:.9;transform:translateY(-1px);}
.lp-btn-outline{border-color:var(--lp-green);color:var(--lp-green-dark);background:#fff;}
.lp-btn-outline:hover{background:var(--lp-green-pale);}

.lp-sec-tag{
  display:inline-block;
  font-family:var(--lp-font-head);
  font-size:.72rem;
  font-weight:600;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:var(--lp-green-dark);
  background:#fff;
  border:1.5px solid var(--lp-border);
  padding:6px 16px;
  border-radius:50px;
  margin-bottom:14px;
}
.lp-sec-title{font-family:var(--lp-font-head);font-size:1.9rem;font-weight:700;text-transform:uppercase;letter-spacing:.02em;color:var(--lp-blue-dark);line-height:1.2;margin:0 0 10px;}
.lp-sec-title span{color:var(--lp-green-dark);}
.lp-sec-hdr{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:14px;margin-bottom:24px;}
.lp-sec-hdr .lp-sec-title{margin:0;}
.lp-viewall{font-family:var(--lp-font-head);font-size:.8rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:var(--lp-green-dark);text-decoration:none;white-space:nowrap;}

/* HERO — height matched to About Us page's hero media frame (340px desktop /
   280px tablet / 220px mobile), instead of the previous viewport-height slider */
.lp-hero2{
  position:relative;
  margin:24px 40px 36px;
  height:340px;
  min-height:340px;
  overflow:hidden;
  background:var(--lp-blue-dark);
  border-radius:20px;
  box-shadow:0 18px 40px rgba(18,90,148,.18);
}
.lp-hero2-slide{position:absolute;inset:0;opacity:0;transition:opacity .8s ease;}
.lp-hero2-slide.active{opacity:1;}
.lp-hero2-slide img{width:100%;height:100%;object-fit:cover;object-position:var(--lp-obj-pos,center);display:block;}
/* Overlay opacity reduced so the background image (e.g. product/bag imagery)
   reads more clearly, while keeping enough contrast for the text on top */
.lp-hero2-overlay{position:absolute;inset:0;background:linear-gradient(100deg, rgba(18,90,148,.68) 0%, rgba(18,90,148,.52) 24%, rgba(18,90,148,.26) 44%, rgba(18,90,148,.05) 60%, rgba(18,90,148,0) 74%);}
.lp-hero2-content{position:absolute;top:0;left:0;height:100%;display:flex;flex-direction:column;justify-content:center;padding:0 56px;max-width:540px;z-index:3;box-sizing:border-box;}
.lp-hero2-label{font-family:var(--lp-font-head);color:#d5efb2;font-weight:600;font-size:.75rem;letter-spacing:.16em;text-transform:uppercase;margin-bottom:16px;}
.lp-hero2-content h1{font-family:var(--lp-font-head);text-transform:uppercase;letter-spacing:.01em;color:#fff;font-size:clamp(1.5rem,3.2vw,2.4rem);font-weight:700;margin:0 0 16px;line-height:1.2;text-shadow:0 2px 14px rgba(0,0,0,.25);}
.lp-hero2-sub{color:rgba(255,255,255,.88);font-size:.94rem;line-height:1.6;max-width:390px;margin-bottom:28px;}
.lp-hero2-btns{display:flex;gap:14px;flex-wrap:wrap;}
.lp-hero2-btn-white{display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--lp-blue-dark);padding:13px 28px;border-radius:50px;font-family:var(--lp-font-head);font-weight:600;font-size:.85rem;text-transform:uppercase;letter-spacing:.03em;text-decoration:none;white-space:nowrap;}
.lp-hero2-btn-ghost{display:inline-flex;align-items:center;gap:8px;background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.65);padding:12px 26px;border-radius:50px;font-family:var(--lp-font-head);font-weight:600;font-size:.85rem;text-transform:uppercase;letter-spacing:.03em;text-decoration:none;white-space:nowrap;}
.lp-hero2-nav{position:absolute;top:50%;transform:translateY(-50%);width:42px;height:42px;border-radius:50%;border:none;background:rgba(255,255,255,.25);color:#fff;font-size:20px;cursor:pointer;z-index:4;display:flex;align-items:center;justify-content:center;}
.lp-hero2-nav:hover{background:rgba(255,255,255,.4);}
.lp-hero2-prev{left:16px;}.lp-hero2-next{right:16px;}
.lp-hero2-dots{position:absolute;bottom:20px;left:50%;transform:translateX(-50%);display:flex;gap:8px;z-index:4;}
.lp-hero2-dot{width:8px;height:8px;border-radius:50%;border:none;background:rgba(255,255,255,.45);cursor:pointer;padding:0;transition:width .25s,background .25s;}
.lp-hero2-dot.active{background:#fff;width:24px;border-radius:4px;}

/* FEATURE STRIP */
.lp-strip{background:var(--lp-blue-dark);padding:26px 0;width:100%;}
.lp-strip-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;justify-items:center;align-items:center;}
.lp-strip-item{display:flex;align-items:center;gap:12px;color:#fff;justify-content:flex-start;min-width:0;}
.lp-strip-item svg{width:30px;height:30px;flex-shrink:0;color:var(--lp-green);}
.lp-strip-title{font-family:var(--lp-font-head);font-weight:600;font-size:.85rem;text-transform:uppercase;letter-spacing:.02em;overflow-wrap:break-word;}
.lp-strip-sub{font-size:.75rem;color:rgba(255,255,255,.65);overflow-wrap:break-word;}

/* POPULAR CATEGORIES */
.lp-popcat{padding:48px 0;}
.lp-popcat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.lp-popcat-card{border-radius:10px;padding:20px;display:flex;align-items:center;gap:16px;text-decoration:none;transition:transform .15s;border:1.5px solid var(--lp-border);background:#fff;}
.lp-popcat-card:hover{transform:translateY(-3px);}
.lp-popcat-img{width:66px;height:66px;border-radius:8px;overflow:hidden;background:#f7f9fb;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.lp-popcat-img img{width:100%;height:100%;object-fit:contain;padding:6px;}
.lp-popcat-img svg{width:26px;height:26px;color:var(--lp-blue);}
.lp-popcat-name{font-family:var(--lp-font-head);font-weight:600;text-transform:uppercase;letter-spacing:.01em;color:var(--lp-blue-dark);font-size:.86rem;margin-bottom:3px;overflow-wrap:break-word;}
.lp-popcat-count{font-size:.78rem;color:var(--lp-text-light);}

/* PRODUCT GRIDS - 4 per row */
.lp-prod-sec{padding:8px 0 48px;}
.lp-prod-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.lp-p-card{background:#fff;border:1.5px solid var(--lp-border);border-radius:8px;overflow:hidden;display:flex;flex-direction:column;position:relative;}
.lp-p-num{position:absolute;top:10px;left:10px;width:24px;height:24px;border-radius:50%;background:var(--lp-blue-dark);color:#fff;font-family:var(--lp-font-head);font-size:.72rem;font-weight:600;display:flex;align-items:center;justify-content:center;z-index:2;}
.lp-p-sale{position:absolute;top:10px;left:10px;background:var(--lp-green-dark);color:#fff;font-family:var(--lp-font-head);font-size:.6rem;font-weight:600;letter-spacing:.03em;padding:3px 9px;border-radius:50px;z-index:2;}
.lp-p-wish{position:absolute;top:10px;right:10px;width:28px;height:28px;border-radius:50%;background:#fff;border:none;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(0,0,0,.1);cursor:pointer;z-index:2;}
.lp-p-wish svg{width:14px;height:14px;color:var(--lp-blue-dark);}
.lp-p-img{height:190px;background:#f7f9fb;display:flex;align-items:center;justify-content:center;padding:18px;box-sizing:border-box;}
.lp-p-img img{width:100%;height:100%;object-fit:contain;}
.lp-p-body{padding:14px 16px 16px;display:flex;flex-direction:column;flex:1;}
.lp-p-cat{font-family:var(--lp-font-head);font-size:.66rem;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--lp-blue);margin-bottom:5px;}
.lp-p-name{font-size:.9rem;font-weight:700;color:var(--lp-text);line-height:1.3;margin-bottom:8px;min-height:2.3em;}
.lp-p-name a{color:inherit;text-decoration:none;transition:color .15s;}
.lp-p-name a:hover{color:var(--lp-name-hover);text-decoration:underline;}

.lp-p-foot{margin-top:auto;display:flex;flex-direction:column;gap:10px;}
.lp-p-price-row{display:flex;align-items:center;}
.lp-p-price-wrap{display:flex;align-items:center;gap:8px;flex-wrap:wrap;min-width:0;}
.lp-p-price-old{font-size:.76rem;text-decoration:line-through;color:var(--lp-text-light);}
.lp-p-price{font-size:.98rem;font-weight:800;color:var(--lp-blue-dark);white-space:nowrap;}

.lp-p-btn-stack{display:flex;flex-direction:column;gap:8px;}
.lp-p-btn-cart,.lp-p-btn-rx,.lp-p-btn-wa{display:flex;align-items:center;justify-content:center;gap:7px;text-align:center;font-family:var(--lp-font-head);font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.03em;padding:10px;border-radius:5px;text-decoration:none;border:none;cursor:pointer;width:100%;box-sizing:border-box;}
.lp-p-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-p-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-p-btn-rx{background:var(--lp-red);color:#fff;}
.lp-p-btn-rx:hover{background:var(--lp-red-dark);}
.lp-p-btn-wa{background:var(--lp-wa);color:#fff;}
.lp-p-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-p-btn-cart svg,.lp-p-btn-rx svg,.lp-p-btn-wa svg{width:13px;height:13px;flex-shrink:0;}
.lp-p-btn-cart.lp-atc-loading{opacity:.65;pointer-events:none;}

/* DISCOUNTED PRODUCTS */
.lp-disc-sec{padding:8px 0 48px;}
.lp-disc-wrap{display:flex;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 14px 44px rgba(18,90,148,.10);border:1.5px solid var(--lp-border);}

.lp-disc-left{
  flex:0 0 32%;
  position:relative;
  background:var(--lp-blue-dark);
  min-height:100%;
  overflow:hidden;
}
.lp-disc-left img{
  width:100%;
  height:100%;
  object-fit:cover;
  object-position:center 20%;
  display:block;
  min-height:440px;
  position:relative;
  z-index:1;
}
.lp-disc-left::before{
  content:"";
  position:absolute;
  top:0; left:0; right:0;
  height:14%;
  background:linear-gradient(180deg, var(--lp-blue-dark) 0%, rgba(18,90,148,0) 100%);
  z-index:2;
  pointer-events:none;
}
.lp-disc-left::after{
  content:"";
  position:absolute;
  bottom:0; left:0; right:0;
  height:10%;
  background:linear-gradient(0deg, var(--lp-blue-dark) 0%, rgba(18,90,148,0) 100%);
  z-index:2;
  pointer-events:none;
}

.lp-disc-right{flex:1;padding:30px 32px;min-width:0;box-sizing:border-box;}
.lp-disc-hdr{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;gap:12px;flex-wrap:wrap;}
.lp-disc-title{font-family:var(--lp-font-head);font-size:1.4rem;font-weight:700;text-transform:uppercase;letter-spacing:.01em;color:var(--lp-blue-dark);margin:0;}
.lp-disc-arrows{display:flex;gap:8px;}
.lp-disc-arrow{width:36px;height:36px;border-radius:50%;border:1.5px solid var(--lp-border);background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--lp-blue-dark);}
.lp-disc-arrow:hover{background:var(--lp-green-pale);border-color:var(--lp-green);}

.lp-disc-track{
  display:flex;
  gap:16px;
  overflow-x:auto;
  scroll-snap-type:x mandatory;
  scroll-behavior:smooth;
  -ms-overflow-style:none;
  scrollbar-width:none;
}
.lp-disc-track::-webkit-scrollbar{display:none;}

.lp-disc-card{
  flex:0 0 calc((100% - 32px) / 3);
  scroll-snap-align:start;
  border:1.5px solid var(--lp-border);
  border-radius:10px;
  padding:14px;
  position:relative;
  background:#fff;
  box-sizing:border-box;
  display:flex;
  flex-direction:column;
}
.lp-disc-badge{position:absolute;top:10px;left:10px;background:var(--lp-green-dark);color:#fff;font-family:var(--lp-font-head);font-size:.6rem;font-weight:600;letter-spacing:.03em;padding:3px 9px;border-radius:50px;}
.lp-disc-wish{position:absolute;top:10px;right:10px;width:26px;height:26px;border-radius:50%;background:#f7f9fb;border:none;display:flex;align-items:center;justify-content:center;}
.lp-disc-wish svg{width:13px;height:13px;color:var(--lp-blue-dark);}
.lp-disc-img{height:150px;display:flex;align-items:center;justify-content:center;margin:12px 0 10px;overflow:hidden;}
.lp-disc-img img{max-width:100%;max-height:100%;width:auto;height:auto;object-fit:contain;}
.lp-disc-cat{font-family:var(--lp-font-head);font-size:.62rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--lp-blue);margin-bottom:4px;}
.lp-disc-name{font-size:.86rem;font-weight:700;color:var(--lp-text);line-height:1.3;margin-bottom:8px;min-height:2.2em;}
.lp-disc-name a{transition:color .15s;}
.lp-disc-name a:hover{color:var(--lp-name-hover);text-decoration:underline;}
.lp-disc-price{font-weight:800;color:var(--lp-blue-dark);font-size:.92rem;white-space:nowrap;margin-bottom:10px;}
.lp-disc-btn-stack{display:flex;flex-direction:column;gap:7px;margin-top:auto;}
.lp-disc-btn-cart,.lp-disc-btn-rx,.lp-disc-btn-wa{display:flex;align-items:center;justify-content:center;gap:6px;font-family:var(--lp-font-head);font-size:.64rem;font-weight:600;text-transform:uppercase;letter-spacing:.02em;padding:9px;border-radius:5px;text-decoration:none;border:none;cursor:pointer;width:100%;box-sizing:border-box;}
.lp-disc-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-disc-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-disc-btn-rx{background:var(--lp-red);color:#fff;}
.lp-disc-btn-rx:hover{background:var(--lp-red-dark);}
.lp-disc-btn-wa{background:var(--lp-wa);color:#fff;}
.lp-disc-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-disc-btn-cart svg,.lp-disc-btn-rx svg,.lp-disc-btn-wa svg{width:12px;height:12px;flex-shrink:0;}
.lp-disc-btn-cart.lp-atc-loading{opacity:.65;pointer-events:none;}

/* TRENDING PRODUCTS */
.lp-trend-sec{padding:8px 0 48px;}
.lp-trend-wrap{display:grid;grid-template-columns:2fr 1fr;gap:20px;align-items:stretch;}
.lp-trend-left{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;}
.lp-trend-card{display:flex;flex-direction:column;background:#fff;border:1.5px solid var(--lp-border);border-radius:8px;padding:10px;box-sizing:border-box;overflow:visible;height:100%;min-width:0;}
.lp-trend-img{height:64px;display:flex;align-items:center;justify-content:center;background:#f7f9fb;border-radius:6px;padding:6px;margin-bottom:8px;box-sizing:border-box;}
.lp-trend-img img{max-width:100%;max-height:100%;object-fit:contain;}
.lp-trend-cat{font-family:var(--lp-font-head);font-size:.56rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;color:var(--lp-blue);margin-bottom:4px;overflow-wrap:break-word;}
.lp-trend-name{display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:.76rem;font-weight:700;color:var(--lp-text);line-height:1.3;margin-bottom:5px;overflow-wrap:break-word;transition:color .15s;}
.lp-trend-name:hover{color:var(--lp-name-hover);text-decoration:underline;}
.lp-trend-price{font-size:.8rem;font-weight:800;color:var(--lp-blue-dark);margin-bottom:8px;}
.lp-trend-btn-stack{display:flex;flex-direction:column;gap:6px;margin-top:auto;}
.lp-trend-btn-cart,.lp-trend-btn-rx,.lp-trend-btn-wa{display:flex;align-items:center;justify-content:center;gap:5px;font-family:var(--lp-font-head);font-size:.56rem;font-weight:600;text-transform:uppercase;letter-spacing:.01em;padding:7px 4px;border-radius:5px;text-decoration:none;border:none;cursor:pointer;width:100%;box-sizing:border-box;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.lp-trend-btn-cart{background:var(--lp-blue);color:#fff;}
.lp-trend-btn-cart:hover{background:var(--lp-blue-dark);}
.lp-trend-btn-rx{background:var(--lp-red);color:#fff;}
.lp-trend-btn-rx:hover{background:var(--lp-red-dark);}
.lp-trend-btn-wa{background:var(--lp-wa);color:#fff;}
.lp-trend-btn-wa:hover{background:var(--lp-wa-dark);}
.lp-trend-btn-cart svg,.lp-trend-btn-rx svg,.lp-trend-btn-wa svg{width:10px;height:10px;flex-shrink:0;}
.lp-trend-btn-cart.lp-atc-loading{opacity:.65;pointer-events:none;}

.lp-trend-banner{
  border-radius:12px;
  height:100%;
  min-height:280px;
  position:relative;
  overflow:hidden;
  color:#fff;
  display:flex;
  flex-direction:column;
  justify-content:flex-end;
  padding:26px;
  box-sizing:border-box;
  background-image:linear-gradient(180deg, rgba(18,90,148,.15) 0%, rgba(18,90,148,.35) 55%, rgba(18,90,148,.88) 100%), var(--lp-trend-banner-img);
  background-size:cover;
  background-position:center;
}
.lp-trend-banner-label{font-family:var(--lp-font-head);font-size:.7rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;opacity:.9;margin-bottom:6px;position:relative;z-index:2;}
.lp-trend-banner-title{font-family:var(--lp-font-head);text-transform:uppercase;font-size:1.4rem;font-weight:700;margin:0 0 8px;position:relative;z-index:2;}
.lp-trend-banner-price{font-size:.95rem;font-weight:700;position:relative;z-index:2;}

/* STATS BAR */
.lp-stats{background:#f7f9fb;padding:40px 0;width:100%;}
.lp-stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:24px;justify-items:center;align-items:center;}
.lp-stat-item{display:flex;align-items:center;gap:14px;justify-content:center;}
.lp-stat-item svg{width:38px;height:38px;color:var(--lp-green-dark);flex-shrink:0;}
.lp-stat-num{font-family:var(--lp-font-head);font-size:1.4rem;font-weight:700;color:var(--lp-blue-dark);line-height:1.1;white-space:nowrap;}
.lp-stat-label{font-size:.8rem;color:var(--lp-text-light);white-space:nowrap;}

/* TESTIMONIALS */
.lp-test{padding:52px 0;}
.lp-test-hdr{text-align:center;margin-bottom:34px;}
.lp-test-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:26px;}
.lp-test-card{text-align:center;padding:0 10px;}
.lp-test-stars{color:#f5a623;font-size:.9rem;margin-bottom:14px;}
.lp-test-text{color:var(--lp-text-light);font-size:.92rem;line-height:1.65;margin-bottom:20px;}
.lp-test-avatar{width:56px;height:56px;border-radius:50%;object-fit:cover;margin:0 auto 12px;display:block;border:3px solid var(--lp-green-pale);}
.lp-test-author{font-family:var(--lp-font-head);font-weight:600;text-transform:uppercase;letter-spacing:.01em;color:var(--lp-blue-dark);font-size:.86rem;}
.lp-test-role{font-size:.76rem;color:var(--lp-text-light);}

/* NEWSLETTER */
.lp-news{
  background:var(--lp-blue-dark);
  border-radius:16px;
  margin:0 40px 56px;
  padding:34px 40px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:24px;
  flex-wrap:wrap;
  box-sizing:border-box;
  max-width:calc(100% - 80px);
}
.lp-news-title{color:#fff;font-family:var(--lp-font-head);font-weight:700;text-transform:uppercase;letter-spacing:.01em;font-size:1.05rem;margin-bottom:4px;}
.lp-news-sub{color:rgba(255,255,255,.65);font-size:.82rem;}
.lp-news-form{display:flex;flex-wrap:wrap;gap:10px;flex:1 1 340px;max-width:420px;min-width:0;}
.lp-news-form input{flex:1 1 180px;min-width:0;border:none;border-radius:6px;padding:12px 16px;font-size:.85rem;box-sizing:border-box;}
.lp-news-form button{background:var(--lp-green-dark);color:#fff;border:none;border-radius:6px;padding:12px 22px;font-family:var(--lp-font-head);font-weight:600;font-size:.82rem;text-transform:uppercase;letter-spacing:.03em;cursor:pointer;flex-shrink:0;}

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
  .lp-prod-grid{grid-template-columns:repeat(2,1fr);}
  .lp-popcat-grid{grid-template-columns:repeat(2,1fr);}
  .lp-disc-wrap{flex-direction:column;}
  .lp-disc-left img{min-height:220px;}
  .lp-disc-card{flex:0 0 calc((100% - 16px) / 2);}
  .lp-trend-wrap{grid-template-columns:1fr;}
  .lp-trend-left{height:auto;grid-template-columns:repeat(4,1fr);}
  .lp-trend-banner{height:auto;min-height:180px;}
  .lp-stats-grid{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:900px){
  .lp-wrap{padding:0 20px;}
  .lp-hero2{margin:14px 16px 24px;height:280px;min-height:280px;border-radius:16px;}
  .lp-hero2-content{padding:0 22px;max-width:100%;}
  .lp-hero2-overlay{background:linear-gradient(180deg, rgba(18,90,148,.32) 0%, rgba(18,90,148,.62) 65%);}
  .lp-strip{display:none;}
  .lp-test-grid{grid-template-columns:1fr;}
  .lp-trend-left{grid-template-columns:repeat(2,1fr);}
  .lp-disc-card{flex:0 0 100%;}
  .lp-disc-right{padding:24px 20px;}
  .lp-popcat{padding:32px 0;}
  .lp-popcat-card{padding:14px;gap:12px;}
  .lp-popcat-img{width:54px;height:54px;}

  .lp-news{margin:0 16px 40px;padding:26px 22px;flex-direction:column;align-items:stretch;max-width:calc(100% - 32px);}
  .lp-news-form{max-width:100%;flex:1 1 100%;}
}
@media(max-width:640px){
  .lp-hero2{height:220px;min-height:220px;}
  .lp-popcat-grid{grid-template-columns:1fr;}
  .lp-popcat-card{padding:12px;gap:10px;}
  .lp-popcat-img{width:48px;height:48px;}
  .lp-popcat-name{font-size:.78rem;}
  .lp-popcat-count{font-size:.72rem;}
  .lp-prod-grid{grid-template-columns:repeat(2,1fr);}
  .lp-stats-grid{grid-template-columns:1fr;}
  .lp-trend-left{grid-template-columns:repeat(2,1fr);}

  .lp-hero2-nav{top:auto;bottom:16px;transform:none;width:32px;height:32px;font-size:16px;}
  .lp-hero2-prev{left:16px;}
  .lp-hero2-next{right:16px;}
  .lp-hero2-dots{bottom:26px;}
  .lp-hero2-content{padding:0 20px;justify-content:flex-start;padding-top:24px;}
  .lp-hero2-btns{margin-bottom:20px;}

  .lp-hero2-label{font-size:.68rem;letter-spacing:.14em;margin-bottom:10px;}
  .lp-hero2-content h1{font-size:clamp(1.2rem,5.4vw,1.5rem);margin-bottom:8px;}
  .lp-hero2-sub{font-size:.8rem;margin-bottom:14px;}
  .lp-hero2-btn-white,.lp-hero2-btn-ghost{font-size:.72rem;padding:9px 18px;}

  .lp-sec-title{font-size:1.35rem;}
  .lp-sec-tag{font-size:.66rem;padding:5px 13px;}
  .lp-viewall{font-size:.72rem;}

  .lp-strip-title{font-size:.78rem;}
  .lp-strip-sub{font-size:.7rem;}

  .lp-p-cat{font-size:.6rem;}
  .lp-p-name{font-size:.85rem;}
  .lp-p-price{font-size:.9rem;}
  .lp-p-price-old{font-size:.7rem;}
  .lp-p-btn-cart,.lp-p-btn-rx,.lp-p-btn-wa{font-size:.66rem;padding:9px;}

  .lp-stat-num{font-size:1.25rem;}
  .lp-stat-label{font-size:.74rem;}

  .lp-disc-title{font-size:1.2rem;}
  .lp-disc-cat{font-size:.58rem;}
  .lp-disc-name{font-size:.8rem;}
  .lp-disc-price{font-size:.86rem;}
  .lp-disc-btn-cart,.lp-disc-btn-rx,.lp-disc-btn-wa{font-size:.6rem;padding:8px;}

  .lp-trend-cat{font-size:.56rem;}
  .lp-trend-name{font-size:.8rem;}
  .lp-trend-price{font-size:.82rem;}
  .lp-trend-btn-cart,.lp-trend-btn-rx,.lp-trend-btn-wa{font-size:.6rem;padding:8px;}
  .lp-trend-banner-title{font-size:1.2rem;}

  .lp-news-title{font-size:.95rem;}
  .lp-news-sub{font-size:.78rem;}
  .lp-news{margin:0 14px 32px;padding:22px 18px;max-width:calc(100% - 28px);}
}
@media(max-width:480px){
  .lp-prod-grid{grid-template-columns:1fr;}
  .lp-hero2{height:200px;min-height:200px;margin:12px 12px 20px;}
  .lp-hero2-btn-white,.lp-hero2-btn-ghost{padding:8px 16px;font-size:.68rem;}
  .lp-disc-card{padding:12px;}
  .lp-trend-left{grid-template-columns:repeat(2,1fr);gap:10px;}
  .lp-trend-card{padding:8px;}
  .lp-trend-img{height:56px;}
  .lp-news-form{flex-direction:column;}
  .lp-news-form input,.lp-news-form button{width:100%;flex:1 1 100%;}
  .lp-news{margin:0 10px 28px;padding:20px 16px;max-width:calc(100% - 20px);border-radius:12px;}
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
if ( ! function_exists('leshavin_email') ) {
  function leshavin_email() { return 'info@leshavinpharmacy.com'; }
}
if ( ! function_exists('leshavin_location') ) {
  function leshavin_location() { return 'Nairobi, Kenya'; }
}

/**
 * True only for products in these exact WooCommerce product categories
 * (matched by slug). This local copy is a safety net only —
 * functions.php's canonical version always loads first and is the one
 * that actually runs. Keep this list identical to functions.php:
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

/** Primary product category name, pulled live from the WooCommerce product_cat taxonomy. */
if ( ! function_exists('leshavin_primary_cat_name') ) {
  function leshavin_primary_cat_name( $product_id ) {
    $terms = get_the_terms( $product_id, 'product_cat' );
    if ( $terms && ! is_wp_error( $terms ) && ! empty( $terms ) ) {
      return esc_html( $terms[0]->name );
    }
    return '';
  }
}

/** Newest product photo in a category, falling back to the category thumbnail. */
if ( ! function_exists('leshavin_cat_image') ) {
  function leshavin_cat_image( $term ) {
    $p = new WP_Query([
      'post_type'      => 'product',
      'posts_per_page' => 1,
      'orderby'        => 'date',
      'order'          => 'DESC',
      'fields'         => 'ids',
      'tax_query'      => [[
        'taxonomy' => 'product_cat',
        'field'    => 'term_id',
        'terms'    => $term->term_id,
      ]],
    ]);
    if ( $p->have_posts() ) {
      $img = get_the_post_thumbnail_url( $p->posts[0], 'medium' );
      if ( $img ) return $img;
    }
    $thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
    return $thumb_id ? wp_get_attachment_url( $thumb_id ) : '';
  }
}

/** Builds a WhatsApp enquiry link for a given product. */
if ( ! function_exists('leshavin_whatsapp_url') ) {
  function leshavin_whatsapp_url( $title = '', $url = '', $price_text = '' ) {
    $phone = leshavin_phone();
    $msg = 'Hi! I would like to enquire about: ' . $title;
    if ( $price_text ) $msg .= ' - ' . $price_text;
    if ( $url ) $msg .= ' ' . $url;
    return 'https://wa.me/' . $phone . '?text=' . rawurlencode( $msg );
  }
}

/** Small reusable icons */
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

/**
 * Render a 4-per-row product grid.
 * $badge: 'none' | 'rank' | 'sale'
 * Every card shows the category (from WooCommerce product_cat, live), the
 * product name, and two action buttons:
 * normal products get "Add to Cart" + "Buy via WhatsApp",
 * products in the allowed Rx categories get
 * "Submit Prescription" + "Ask a Pharmacist".
 * Simple, in-stock products add to cart via a normal WooCommerce
 * "?add-to-cart=ID" link (real page reload -> header cart count updates),
 * but JS saves/restores scroll position around the reload and shows a
 * toast, so the page appears to stay put instead of jumping to the top.
 */
if ( ! function_exists('leshavin_product_grid') ) {
  function leshavin_product_grid( $q, $badge = 'none' ) {
    $i = 0;
    if ( $q->have_posts() ) :
      while ( $q->have_posts() ) : $q->the_post();
        global $product;
        $i++;
        $img = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' );
        $on_sale = $product->is_on_sale();
        $reg = $product->get_regular_price();
        $cur = $product->get_price();
        $is_rx = leshavin_needs_prescription( get_the_ID() );
        $cat_name = leshavin_primary_cat_name( get_the_ID() );
        $price_text = 'KSh ' . number_format( (float) $cur, 2 );
        $wa_url = leshavin_whatsapp_url( get_the_title(), get_permalink(), $price_text );
        $title_short = mb_strlen( get_the_title() ) > 30 ? mb_substr( get_the_title(), 0, 30 ) . '…' : get_the_title();
        ?>
        <div class="lp-p-card">
          <?php if ( $badge === 'rank' ) : ?>
            <div class="lp-p-num"><?php echo $i; ?></div>
          <?php elseif ( $badge === 'sale' && $on_sale && $reg ) : ?>
            <div class="lp-p-sale">-<?php echo round( ( ( $reg - $cur ) / $reg ) * 100 ); ?>% OFF</div>
          <?php endif; ?>
          <button class="lp-p-wish" aria-label="Wishlist" onclick="event.preventDefault();">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
          </button>
          <a href="<?php the_permalink(); ?>" class="lp-p-img">
            <?php if ( $img ) : ?>
              <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
            <?php else: ?>
              <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:.3"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/></svg>
            <?php endif; ?>
          </a>
          <div class="lp-p-body">
            <?php if ( $cat_name ) : ?><div class="lp-p-cat"><?php echo $cat_name; ?></div><?php endif; ?>
            <div class="lp-p-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <div class="lp-p-foot">
              <div class="lp-p-price-row">
                <div class="lp-p-price-wrap">
                  <?php if ( $on_sale && $reg ) : ?><div class="lp-p-price-old">KSh <?php echo number_format( (float) $reg, 2 ); ?></div><?php endif; ?>
                  <div class="lp-p-price">KSh <?php echo number_format( (float) $cur, 2 ); ?></div>
                </div>
              </div>
              <div class="lp-p-btn-stack">
                <?php if ( $is_rx ) : ?>
                  <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="lp-p-btn-rx">
                    <?php echo leshavin_rx_svg(); ?>
                    Submit Prescription
                  </a>
                <?php elseif ( $product->is_type('simple') ) : ?>
                  <button type="button"
                     class="lp-p-btn-cart leshavin-atc-btn"
                     data-pid="<?php the_ID(); ?>"
                     data-name="<?php echo esc_attr( $title_short ); ?>">
                    <?php echo leshavin_cart_svg(); ?>
                    <span class="lp-atc-txt">Add to Cart</span>
                  </button>
                <?php else : ?>
                  <a href="<?php the_permalink(); ?>" class="lp-p-btn-cart">
                    <?php echo leshavin_cart_svg(); ?>
                    Add to Cart
                  </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( $wa_url ); ?>" class="lp-p-btn-wa" target="_blank" rel="noopener noreferrer">
                  <?php echo leshavin_wa_svg(); ?>
                  <?php echo $is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p style="grid-column:1/-1;text-align:center;color:var(--lp-text-light);">No products yet. Add some in WooCommerce, under Products.</p>';
    endif;
  }
}
?>

<!-- HERO -->
<?php
$lp_hero_slides = [
  [ 'img' => 'homebg.png',  'label' => 'Welcome To Leshavin', 'h1a' => 'Your Health,',      'h1b' => 'Our Priority.',   'sub' => 'Quality medicines and healthcare products delivered fast and reliably across Kenya.', 'pos' => 'center 25%' ],
  [ 'img' => 'cerave.png',  'label' => 'Skincare',            'h1a' => 'Certified CeraVe',   'h1b' => 'Skincare Range.', 'sub' => 'Dermatologist recommended skincare, now in stock and ready to ship.', 'pos' => 'center top' ],
  [ 'img' => 'wegovy.png',  'label' => 'In Stock',            'h1a' => 'Wegovy Now',         'h1b' => 'Available.',      'sub' => 'Speak to our pharmacist about weight management support today.', 'pos' => 'center' ],
];
?>
<section class="lp-hero2" id="lpHero2">
  <?php foreach ( $lp_hero_slides as $i => $s ) : ?>
  <div class="lp-hero2-slide <?php echo $i === 0 ? 'active' : ''; ?>" data-i="<?php echo $i; ?>">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/' . $s['img'] ); ?>" alt="<?php echo esc_attr( $s['h1a'] . ' ' . $s['h1b'] ); ?>" style="--lp-obj-pos:<?php echo esc_attr( $s['pos'] ); ?>;">
    <div class="lp-hero2-overlay"></div>
    <div class="lp-hero2-content">
      <div class="lp-hero2-label"><?php echo esc_html( $s['label'] ); ?></div>
      <h1><?php echo esc_html( $s['h1a'] ); ?><br><?php echo esc_html( $s['h1b'] ); ?></h1>
      <p class="lp-hero2-sub"><?php echo esc_html( $s['sub'] ); ?></p>
      <div class="lp-hero2-btns">
        <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="lp-hero2-btn-white">
          Shop Now
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
        <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="lp-hero2-btn-ghost">Upload Prescription</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <button class="lp-hero2-nav lp-hero2-prev" id="lpHero2Prev" aria-label="Previous">&#8249;</button>
  <button class="lp-hero2-nav lp-hero2-next" id="lpHero2Next" aria-label="Next">&#8250;</button>
  <div class="lp-hero2-dots">
    <?php foreach ( $lp_hero_slides as $i => $s ) : ?>
      <button class="lp-hero2-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-s="<?php echo $i; ?>"></button>
    <?php endforeach; ?>
  </div>
</section>

<script>
(function(){
  var slides = document.querySelectorAll('#lpHero2 .lp-hero2-slide');
  var dots   = document.querySelectorAll('#lpHero2 .lp-hero2-dot');
  var cur = 0, timer;
  function go(i){
    slides[cur].classList.remove('active');
    dots[cur].classList.remove('active');
    cur = (i + slides.length) % slides.length;
    slides[cur].classList.add('active');
    dots[cur].classList.add('active');
  }
  function start(){ timer = setInterval(function(){ go(cur+1); }, 5000); }
  function reset(){ clearInterval(timer); start(); }
  document.getElementById('lpHero2Next').addEventListener('click', function(){ go(cur+1); reset(); });
  document.getElementById('lpHero2Prev').addEventListener('click', function(){ go(cur-1); reset(); });
  dots.forEach(function(d,i){ d.addEventListener('click', function(){ go(i); reset(); }); });
  start();
})();
</script>

<!-- FEATURE STRIP -->
<section class="lp-strip">
  <div class="lp-wrap lp-strip-grid">
    <div class="lp-strip-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <div><div class="lp-strip-title">Same Day Delivery</div><div class="lp-strip-sub">In selected areas</div></div>
    </div>
    <div class="lp-strip-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 010 20 15.3 15.3 0 010-20z"/></svg>
      <div><div class="lp-strip-title">Nationwide Delivery</div><div class="lp-strip-sub">Across Kenya</div></div>
    </div>
    <div class="lp-strip-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
      <div><div class="lp-strip-title">Secure Payments</div><div class="lp-strip-sub">M-Pesa &amp; Cards</div></div>
    </div>
    <div class="lp-strip-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <div><div class="lp-strip-title">24/7 Support</div><div class="lp-strip-sub">We're here to help</div></div>
    </div>
  </div>
</section>

<!-- POPULAR CATEGORIES -->
<?php
$lp_categories = get_terms(['taxonomy'=>'product_cat','hide_empty'=>true,'parent'=>0,'number'=>8]);
$lp_pastels    = ['#eaf3fb','#f2f9e9','#f3f2ef','#eaf3fb','#f2f9e9','#faf1ee','#eaf3fb','#f2f9e9'];
$lp_fallback   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="9" r="7"/><circle cx="15" cy="15" r="7"/></svg>';
?>
<section class="lp-popcat">
  <div class="lp-wrap">
    <div class="lp-sec-hdr">
      <div>
        <div class="lp-sec-tag">Browse</div>
        <h2 class="lp-sec-title">Popular <span>Categories</span></h2>
      </div>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="lp-viewall">View all categories &rarr;</a>
    </div>
    <div class="lp-popcat-grid">
      <?php if ( $lp_categories && ! is_wp_error( $lp_categories ) ) :
        foreach ( $lp_categories as $ci => $lp_cat ) :
          $lp_img = leshavin_cat_image( $lp_cat );
          $bg = $lp_pastels[ $ci % count( $lp_pastels ) ];
      ?>
      <a href="<?php echo esc_url( get_term_link( $lp_cat ) ); ?>" class="lp-popcat-card">
        <div class="lp-popcat-img">
          <?php if ( $lp_img ) : ?>
            <img src="<?php echo esc_url( $lp_img ); ?>" alt="<?php echo esc_attr( $lp_cat->name ); ?>">
          <?php else : ?>
            <?php echo $lp_fallback; ?>
          <?php endif; ?>
        </div>
        <div>
          <div class="lp-popcat-name"><?php echo esc_html( $lp_cat->name ); ?></div>
          <div class="lp-popcat-count"><?php echo intval( $lp_cat->count ); ?> Products</div>
        </div>
      </a>
      <?php endforeach;
      else: ?>
        <p style="grid-column:1/-1;text-align:center;color:var(--lp-text-light);">Add product categories in WooCommerce to show them here.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- POPULAR PRODUCTS -->
<section class="lp-prod-sec">
  <div class="lp-wrap">
    <div class="lp-sec-hdr">
      <div>
        <div class="lp-sec-tag">Trending</div>
        <h2 class="lp-sec-title">Popular <span>Products</span></h2>
      </div>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="lp-viewall">View all products &rarr;</a>
    </div>
    <div class="lp-prod-grid">
      <?php
      $lp_popular = new WP_Query([ 'post_type'=>'product','posts_per_page'=>4,'orderby'=>'date','order'=>'DESC' ]);
      leshavin_product_grid( $lp_popular, 'none' );
      ?>
    </div>
  </div>
</section>

<!-- DISCOUNTED PRODUCTS -->
<?php
$lp_sale_ids = wc_get_product_ids_on_sale();
?>
<section class="lp-disc-sec">
  <div class="lp-wrap">
    <div class="lp-disc-wrap">
      <div class="lp-disc-left">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/discountbg.png' ); ?>" alt="Ask our pharmacist">
      </div>
      <div class="lp-disc-right">
        <div class="lp-disc-hdr">
          <h2 class="lp-disc-title">Discounted Products</h2>
          <div class="lp-disc-arrows">
            <button class="lp-disc-arrow" id="lpDiscPrev" aria-label="Previous">&#8249;</button>
            <button class="lp-disc-arrow" id="lpDiscNext" aria-label="Next">&#8250;</button>
          </div>
        </div>
        <div class="lp-disc-track" id="lpDiscTrack">
          <?php
          if ( ! empty( $lp_sale_ids ) ) :
            $lp_disc = new WP_Query([ 'post_type'=>'product','posts_per_page'=>9,'post__in'=>$lp_sale_ids,'orderby'=>'date','order'=>'DESC' ]);
            if ( $lp_disc->have_posts() ) :
              while ( $lp_disc->have_posts() ) : $lp_disc->the_post();
                global $product;
                $img = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' );
                $reg = $product->get_regular_price();
                $cur = $product->get_price();
                $cat_name = leshavin_primary_cat_name( get_the_ID() );
                $is_rx = leshavin_needs_prescription( get_the_ID() );
                $price_text = 'KSh ' . number_format( (float) $cur, 2 );
                $wa_url = leshavin_whatsapp_url( get_the_title(), get_permalink(), $price_text );
                $title_short = mb_strlen( get_the_title() ) > 30 ? mb_substr( get_the_title(), 0, 30 ) . '…' : get_the_title();
                ?>
                <div class="lp-disc-card">
                  <div class="lp-disc-badge">-<?php echo $reg ? round( ( ( $reg - $cur ) / $reg ) * 100 ) : ''; ?>% OFF</div>
                  <button class="lp-disc-wish" aria-label="Wishlist" onclick="event.preventDefault();">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                  </button>
                  <a href="<?php the_permalink(); ?>" class="lp-disc-img">
                    <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"><?php endif; ?>
                  </a>
                  <?php if ( $cat_name ) : ?><div class="lp-disc-cat"><?php echo $cat_name; ?></div><?php endif; ?>
                  <div class="lp-disc-name"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></div>
                  <div class="lp-disc-price">KSh <?php echo number_format( (float) $cur, 2 ); ?></div>
                  <div class="lp-disc-btn-stack">
                    <?php if ( $is_rx ) : ?>
                      <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="lp-disc-btn-rx">
                        <?php echo leshavin_rx_svg(); ?> Submit Prescription
                      </a>
                    <?php elseif ( $product->is_type('simple') ) : ?>
                      <button type="button"
                         class="lp-disc-btn-cart leshavin-atc-btn"
                         data-pid="<?php the_ID(); ?>"
                         data-name="<?php echo esc_attr( $title_short ); ?>">
                        <?php echo leshavin_cart_svg(); ?> <span class="lp-atc-txt">Add to Cart</span>
                      </button>
                    <?php else : ?>
                      <a href="<?php the_permalink(); ?>" class="lp-disc-btn-cart">
                        <?php echo leshavin_cart_svg(); ?> Add to Cart
                      </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $wa_url ); ?>" class="lp-disc-btn-wa" target="_blank" rel="noopener noreferrer">
                      <?php echo leshavin_wa_svg(); ?> <?php echo $is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
                    </a>
                  </div>
                </div>
                <?php
              endwhile;
              wp_reset_postdata();
            endif;
          else :
            echo '<p style="color:var(--lp-text-light);">No discounted products right now. Set a sale price in WooCommerce to feature it here.</p>';
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
(function(){
  var track = document.getElementById('lpDiscTrack');
  if(!track || !track.children.length) return;
  var timer;

  function next(){
    var max = track.scrollWidth - track.clientWidth;
    if (track.scrollLeft >= max - 4) { track.scrollTo({ left: 0, behavior: 'smooth' }); }
    else { track.scrollBy({ left: track.clientWidth, behavior: 'smooth' }); }
  }
  function prev(){
    if (track.scrollLeft <= 4) {
      var max = track.scrollWidth - track.clientWidth;
      track.scrollTo({ left: max, behavior: 'smooth' });
    } else { track.scrollBy({ left: -track.clientWidth, behavior: 'smooth' }); }
  }
  function reset(){ clearInterval(timer); timer = setInterval(next, 4000); }

  document.getElementById('lpDiscNext').addEventListener('click', function(){ next(); reset(); });
  document.getElementById('lpDiscPrev').addEventListener('click', function(){ prev(); reset(); });
  track.addEventListener('mouseenter', function(){ clearInterval(timer); });
  track.addEventListener('mouseleave', reset);

  reset();
})();
</script>

<!-- BEST SELLING ITEMS -->
<section class="lp-prod-sec">
  <div class="lp-wrap">
    <div class="lp-sec-hdr">
      <div>
        <div class="lp-sec-tag">Top Rated</div>
        <h2 class="lp-sec-title">Best Selling <span>Items</span></h2>
      </div>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="lp-viewall">View all best sellers &rarr;</a>
    </div>
    <div class="lp-prod-grid">
      <?php
      $lp_best = new WP_Query([ 'post_type'=>'product','posts_per_page'=>4,'meta_key'=>'total_sales','orderby'=>'meta_value_num','order'=>'DESC' ]);
      leshavin_product_grid( $lp_best, 'rank' );
      ?>
    </div>
  </div>
</section>

<!-- TRENDING PRODUCTS -->
<section class="lp-trend-sec">
  <div class="lp-wrap">
    <div class="lp-sec-hdr">
      <div>
        <div class="lp-sec-tag">Right Now</div>
        <h2 class="lp-sec-title">Trending <span>Products</span></h2>
      </div>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="lp-viewall">View all &rarr;</a>
    </div>
    <div class="lp-trend-wrap">
      <div class="lp-trend-left">
        <?php
        $lp_trend = new WP_Query([ 'post_type'=>'product','posts_per_page'=>4,'orderby'=>'popularity','order'=>'DESC' ]);
        if ( $lp_trend->have_posts() ) :
          while ( $lp_trend->have_posts() ) : $lp_trend->the_post();
            global $product;
            $img = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
            $is_rx = leshavin_needs_prescription( get_the_ID() );
            $cat_name = leshavin_primary_cat_name( get_the_ID() );
            $price_text = 'KSh ' . number_format( (float) $product->get_price(), 2 );
            $wa_url = leshavin_whatsapp_url( get_the_title(), get_permalink(), $price_text );
            $title_short = mb_strlen( get_the_title() ) > 30 ? mb_substr( get_the_title(), 0, 30 ) . '…' : get_the_title();
            ?>
            <div class="lp-trend-card">
              <a href="<?php the_permalink(); ?>" class="lp-trend-img">
                <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"><?php endif; ?>
              </a>
              <?php if ( $cat_name ) : ?><div class="lp-trend-cat"><?php echo $cat_name; ?></div><?php endif; ?>
              <a href="<?php the_permalink(); ?>" class="lp-trend-name" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
              <div class="lp-trend-price">KSh <?php echo number_format( (float) $product->get_price(), 2 ); ?></div>
              <div class="lp-trend-btn-stack">
                <?php if ( $is_rx ) : ?>
                  <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="lp-trend-btn-rx">
                    <?php echo leshavin_rx_svg(); ?> Submit Prescription
                  </a>
                <?php elseif ( $product->is_type('simple') ) : ?>
                  <button type="button"
                     class="lp-trend-btn-cart leshavin-atc-btn"
                     data-pid="<?php the_ID(); ?>"
                     data-name="<?php echo esc_attr( $title_short ); ?>">
                    <?php echo leshavin_cart_svg(); ?> <span class="lp-atc-txt">Add to Cart</span>
                  </button>
                <?php else : ?>
                  <a href="<?php the_permalink(); ?>" class="lp-trend-btn-cart">
                    <?php echo leshavin_cart_svg(); ?> Add to Cart
                  </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( $wa_url ); ?>" class="lp-trend-btn-wa" target="_blank" rel="noopener noreferrer">
                  <?php echo leshavin_wa_svg(); ?> <?php echo $is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
                </a>
              </div>
            </div>
            <?php
          endwhile;
          wp_reset_postdata();
        else:
          echo '<p style="grid-column:1/-1;color:var(--lp-text-light);">No products yet.</p>';
        endif;
        ?>
      </div>
      <div class="lp-trend-banner" style="--lp-trend-banner-img:url('<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/jamieson.png' ); ?>')">
        <div class="lp-trend-banner-label">Medicines</div>
        <div class="lp-trend-banner-title">Leshavin<br>Deals</div>
        <div class="lp-trend-banner-price">Trusted brands, honest prices</div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BAR -->
<section class="lp-stats">
  <div class="lp-wrap lp-stats-grid">
    <div class="lp-stat-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
      <div><div class="lp-stat-num">50,000+</div><div class="lp-stat-label">Families Served</div></div>
    </div>
    <div class="lp-stat-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <div><div class="lp-stat-num">150,000+</div><div class="lp-stat-label">Orders Delivered</div></div>
    </div>
    <div class="lp-stat-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
      <div><div class="lp-stat-num">500+</div><div class="lp-stat-label">Locations Served</div></div>
    </div>
    <div class="lp-stat-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <div><div class="lp-stat-num">10,000+</div><div class="lp-stat-label">Medicines Available</div></div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="lp-test">
  <div class="lp-wrap">
    <div class="lp-test-hdr">
      <div class="lp-sec-tag">Testimonials</div>
      <h2 class="lp-sec-title">What Our <span>Customers Say</span></h2>
    </div>
    <?php
    $lp_testimonials = [
      [ 'img' => 'josephine.png',    'name' => 'Josephine Wanjiru', 'role' => 'Nairobi', 'text' => 'Leshavin Pharmacy is my go to. Genuine products, fast delivery and excellent customer service.' ],
      [ 'img' => 'patric.png',       'name' => 'Patrick Otieno',    'role' => 'Kisumu',  'text' => 'I love how easy it is to upload prescriptions and get my medicines delivered at home. Highly recommended.' ],
      [ 'img' => 'danielmitchell.png','name' => 'Daniel Mitchell',  'role' => 'Mombasa', 'text' => 'Great prices and a wide range of products. Their support team is always ready to help.' ],
    ];
    ?>
    <div class="lp-test-grid">
      <?php foreach ( $lp_testimonials as $t ) : ?>
      <div class="lp-test-card">
        <div class="lp-test-stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
        <p class="lp-test-text"><?php echo esc_html( $t['text'] ); ?></p>
        <img class="lp-test-avatar" src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/' . $t['img'] ); ?>" alt="<?php echo esc_attr( $t['name'] ); ?>">
        <div class="lp-test-author"><?php echo esc_html( $t['name'] ); ?></div>
        <div class="lp-test-role"><?php echo esc_html( $t['role'] ); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<div class="lp-news">
  <div>
    <div class="lp-news-title">Sign up for News &amp; Offers</div>
    <div class="lp-news-sub">Get the latest health tips and updates straight to your inbox.</div>
  </div>
  <form class="lp-news-form" method="post" action="">
    <input type="email" name="newsletter_email" placeholder="Enter your email address" required>
    <button type="submit">Subscribe</button>
  </form>
</div>

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