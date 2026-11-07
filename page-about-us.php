<?php
/**
 * Template Name: About Us
 * Leshavin Pharmacy - about-us.php
 */
get_header();

$ab_wa       = leshavin_phone();
$ab_phone    = leshavin_phone_display();
$ab_email    = leshavin_email();
$ab_location = leshavin_location();

/* Only verified detail we have - do not add names, dates, or extra
   license numbers that haven't been confirmed. Update via option if needed. */
$ab_ppb_license = get_option( 'leshavin_ppb_license', 'PPB/L/9875' );

$ab_shop_url = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop/' );
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --ab-navy:#0e2358;
  --ab-blue:#1c75bc;
  --ab-blue-dark:#125a94;
  --ab-green:#8dc63f;
  --ab-green-dark:#6ea82e;
  --ab-text:#1c2b3a;
  --ab-text-light:#6b7c8f;
  --ab-border:#e4e9ef;
  --ab-bg-soft:#f7f9fb;
  --ab-font-head:'Oswald',Arial Narrow,sans-serif;
  --ab-font-body:'Inter',sans-serif;
  --ab-px:40px;
}
.ab-page{font-family:var(--ab-font-body);color:var(--ab-text);overflow-x:hidden;}
.ab-wrap{max-width:1280px;margin:0 auto;padding:0 var(--ab-px);}

/* Shared section label - flat, no pill background */
.ab-eyebrow{
  display:flex;align-items:center;gap:10px;
  font-family:var(--ab-font-head);font-size:.74rem;font-weight:600;
  letter-spacing:.14em;text-transform:uppercase;color:var(--ab-green-dark);
  margin-bottom:14px;
}
.ab-eyebrow::before{content:'';width:26px;height:2px;background:var(--ab-green);flex-shrink:0;}

.ab-sec-title{
  font-family:var(--ab-font-head);font-weight:700;text-transform:uppercase;
  letter-spacing:.01em;color:var(--ab-blue-dark);line-height:1.22;
  font-size:clamp(1.5rem,3vw,2rem);margin:0 0 14px;
}
.ab-sec-title span{color:var(--ab-green-dark);}

/* ============================================================
   HERO - single section, no slider
   ============================================================ */
.ab-hero{background:var(--ab-bg-soft);padding:56px 0 64px;}
.ab-hero-inner{
  display:grid;grid-template-columns:1.05fr .95fr;gap:52px;align-items:center;
}
.ab-hero-title{
  font-family:var(--ab-font-head);font-weight:700;text-transform:uppercase;
  color:var(--ab-navy);font-size:clamp(2rem,4.2vw,3.1rem);line-height:1.14;margin:0 0 16px;
}
.ab-hero-title span{display:block;color:var(--ab-green-dark);}
.ab-hero-desc{font-size:.98rem;line-height:1.75;color:var(--ab-text-light);max-width:520px;margin-bottom:30px;}

/* Trust row: 3 items side by side (desktop and mobile) */
.ab-hero-trust{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
.ab-trust-item{display:flex;flex-direction:column;align-items:flex-start;gap:10px;}
.ab-trust-icon{
  width:42px;height:42px;border-radius:10px;flex-shrink:0;
  background:#fff;border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);
}
.ab-trust-icon svg{width:19px;height:19px;}
.ab-trust-icon i{font-size:16px;line-height:1}
.ab-trust-title{font-family:var(--ab-font-head);font-weight:600;font-size:.86rem;color:var(--ab-text);text-transform:uppercase;letter-spacing:.01em;}
.ab-trust-sub{font-size:.78rem;color:var(--ab-text-light);}

.ab-hero-media{position:relative;}
.ab-hero-media-shape{
  position:absolute;left:-18px;bottom:-18px;width:62%;height:120px;
  background:var(--ab-green);border-radius:16px;z-index:0;
}
.ab-hero-media-frame{
  position:relative;z-index:1;border-radius:16px;overflow:hidden;
  border:1px solid var(--ab-border);box-shadow:0 20px 46px rgba(14,35,88,.14);
}
.ab-hero-media-frame img{width:100%;height:340px;object-fit:cover;display:block;}
.ab-hero-caption{
  position:relative;z-index:1;margin-top:18px;padding-left:4px;
  font-family:var(--ab-font-head);font-style:italic;font-weight:600;
  font-size:1.15rem;color:var(--ab-navy);line-height:1.35;
}
.ab-hero-caption::before{content:'';display:block;width:34px;height:3px;background:var(--ab-green);margin-bottom:10px;}

/* ============================================================
   OUR STORY + STATS
   ============================================================ */
.ab-story{padding:60px 0;background:#fff;}
.ab-story-inner{display:grid;grid-template-columns:1fr 1.1fr;gap:48px;align-items:start;}
.ab-story-text p{font-size:.92rem;line-height:1.8;color:var(--ab-text-light);margin:0 0 14px;}
.ab-story-text p:last-child{margin-bottom:0;}

/* Stats grid: 2 per row at all sizes (desktop and mobile) */
.ab-stats-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.ab-stat-card{
  background:var(--ab-bg-soft);border:1.5px solid var(--ab-border);border-radius:12px;
  padding:24px 20px;text-align:left;
}
.ab-stat-icon{
  width:40px;height:40px;border-radius:10px;background:#fff;border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);margin-bottom:14px;
}
.ab-stat-icon svg{width:18px;height:18px;}
.ab-stat-icon i{font-size:15px;line-height:1}
.ab-stat-num{font-family:var(--ab-font-head);font-size:1.7rem;font-weight:700;color:var(--ab-navy);font-variant-numeric:tabular-nums;}
.ab-stat-label{font-size:.8rem;color:var(--ab-text-light);margin-top:4px;}

/* ============================================================
   WHAT WE OFFER - icon cards (medicines, baby, vitamins, care)
   ============================================================ */
.ab-offer{padding:60px 0;background:var(--ab-bg-soft);}
.ab-offer-head{text-align:center;max-width:720px;margin:0 auto 34px;}
.ab-offer-head .ab-eyebrow{justify-content:center;}
.ab-offer-head .ab-eyebrow::before{display:none;}
.ab-offer-head p{font-size:.92rem;line-height:1.75;color:var(--ab-text-light);margin:0;}
.ab-offer-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
.ab-offer-card{
  background:#fff;border:1.5px solid var(--ab-border);
  border-radius:12px;padding:26px 24px;
}
.ab-offer-icon{
  width:48px;height:48px;border-radius:12px;background:var(--ab-bg-soft);border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);margin-bottom:16px;
}
.ab-offer-icon svg{width:23px;height:23px;}
.ab-offer-icon i{font-size:20px;line-height:1}
.ab-offer-title{font-family:var(--ab-font-head);font-size:1rem;font-weight:700;color:var(--ab-navy);text-transform:uppercase;margin-bottom:8px;}
.ab-offer-desc{font-size:.84rem;color:var(--ab-text-light);line-height:1.7;}

/* ============================================================
   LICENSED & COMPLIANT - verified license number only (aboutusbg1.png)
   ============================================================ */
.ab-license{
  position:relative;background:var(--ab-navy);
  padding:56px 0;color:#fff;overflow:hidden;
}
.ab-license-bg{
  position:absolute;inset:0;
  background-image:url('<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/aboutusbg1.png' ); ?>');
  background-size:cover;background-position:center;opacity:.42;
}
.ab-license-overlay{
  position:absolute;inset:0;
  background:linear-gradient(100deg, rgba(14,35,88,.88) 0%, rgba(14,35,88,.72) 50%, rgba(14,35,88,.55) 100%);
}
.ab-license-inner{
  position:relative;z-index:2;
  display:grid;grid-template-columns:1.2fr .8fr;gap:40px;align-items:center;
}
.ab-license-head .ab-eyebrow{color:var(--ab-green);}
.ab-license-head .ab-eyebrow::before{background:var(--ab-green);}
.ab-license-head h2{font-family:var(--ab-font-head);font-weight:700;text-transform:uppercase;color:#fff;font-size:clamp(1.4rem,2.8vw,1.9rem);margin:0 0 10px;}
.ab-license-head p{font-size:.9rem;color:rgba(255,255,255,.75);line-height:1.7;margin:0;}

.ab-license-card{
  background:rgba(255,255,255,.96);border-radius:12px;padding:26px 30px;
  box-shadow:0 18px 40px rgba(0,0,0,.22);
}
.ab-license-card-label{
  font-family:var(--ab-font-head);font-size:.72rem;font-weight:600;
  letter-spacing:.1em;text-transform:uppercase;color:var(--ab-text-light);margin-bottom:14px;
}
.ab-license-num{
  border-top:2px dotted var(--ab-blue);border-bottom:2px dotted var(--ab-blue);
  padding:14px 0;text-align:center;
}
.ab-license-num span{
  font-family:var(--ab-font-head);font-weight:700;font-size:1.5rem;color:var(--ab-navy);letter-spacing:.02em;
}
.ab-license-card-sub{font-size:.76rem;color:var(--ab-text-light);text-align:center;margin-top:12px;}

/* ============================================================
   MISSION / VISION / VALUES
   Classic icons: target (mission), eye (vision), heart (values).
   ============================================================ */
.ab-values{padding:60px 0;background:var(--ab-bg-soft);}
.ab-values-head{text-align:center;margin-bottom:34px;}
.ab-values-head .ab-eyebrow{justify-content:center;}
.ab-values-head .ab-eyebrow::before{display:none;}
.ab-values-head h2{text-align:center;}
.ab-values-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
.ab-value-card{
  background:#fff;border:1.5px solid var(--ab-border);border-radius:12px;
  padding:30px 26px;
}
.ab-value-icon{
  width:46px;height:46px;border-radius:12px;background:var(--ab-bg-soft);border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);margin-bottom:18px;
}
.ab-value-icon svg{width:22px;height:22px;}
.ab-value-icon i{font-size:19px;line-height:1}
.ab-value-title{font-family:var(--ab-font-head);font-size:1rem;font-weight:700;color:var(--ab-navy);text-transform:uppercase;margin-bottom:8px;}
.ab-value-desc{font-size:.85rem;color:var(--ab-text-light);line-height:1.7;}

/* ============================================================
   WHY CHOOSE US
   ============================================================ */
.ab-why{padding:60px 0;background:#fff;}
.ab-why-inner{display:grid;grid-template-columns:.9fr 1.1fr;gap:52px;align-items:center;}
.ab-why-text p{font-size:.92rem;color:var(--ab-text-light);line-height:1.8;margin:0;}
.ab-why-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px 24px;}
.ab-why-item{display:flex;gap:14px;align-items:flex-start;}
.ab-why-icon{
  width:40px;height:40px;border-radius:10px;background:var(--ab-bg-soft);border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);flex-shrink:0;
}
.ab-why-icon svg{width:18px;height:18px;}
.ab-why-icon i{font-size:15px;line-height:1}
.ab-why-title{font-family:var(--ab-font-head);font-size:.88rem;font-weight:700;color:var(--ab-navy);text-transform:uppercase;margin-bottom:4px;}
.ab-why-desc{font-size:.8rem;color:var(--ab-text-light);line-height:1.65;}

/* ============================================================
   LOCAL NAIROBI BAND
   ============================================================ */
.ab-local{padding:56px 0;background:var(--ab-bg-soft);}
.ab-local-inner{
  display:grid;grid-template-columns:1.15fr .85fr;gap:44px;align-items:center;
}
.ab-local-text p{font-size:.92rem;line-height:1.8;color:var(--ab-text-light);margin:0 0 14px;}
.ab-local-text p:last-child{margin-bottom:0;}
.ab-local-links{display:flex;flex-direction:column;gap:12px;}
.ab-local-link{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  background:#fff;border:1.5px solid var(--ab-border);border-radius:12px;padding:16px 20px;
  font-family:var(--ab-font-head);font-weight:600;font-size:.9rem;color:var(--ab-navy);
  text-transform:uppercase;letter-spacing:.02em;text-decoration:none;
  transition:border-color .18s,transform .18s,background .18s;
}
.ab-local-link:hover{border-color:var(--ab-green);background:#f2f9e9;transform:translateX(3px);}
.ab-local-link span{display:flex;align-items:center;gap:12px;}
.ab-local-link svg{width:20px;height:20px;color:var(--ab-blue-dark);flex-shrink:0;}
.ab-local-link i{font-size:17px;line-height:1}
.ab-local-link .ab-arrow{width:16px;height:16px;color:var(--ab-green-dark);}

/* ============================================================
   CTA STRIP
   ============================================================ */
.ab-cta-wrap{padding:0 0 60px;background:#fff;}
.ab-local + .ab-cta-wrap{padding-top:50px;}
.ab-cta{
  background:var(--ab-blue-dark);border-radius:14px;
  padding:26px 32px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;
}
.ab-cta-left{display:flex;align-items:center;gap:16px;}
.ab-cta-icon{
  width:48px;height:48px;border-radius:12px;background:rgba(255,255,255,.12);
  display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;
}
.ab-cta-icon svg{width:22px;height:22px;}
.ab-cta-icon i{font-size:19px;line-height:1}
.ab-cta-title{font-family:var(--ab-font-head);font-weight:700;color:#fff;font-size:1.05rem;text-transform:uppercase;margin-bottom:3px;}
.ab-cta-sub{font-size:.82rem;color:rgba(255,255,255,.7);}
.ab-cta-btn{
  display:inline-flex;align-items:center;gap:8px;background:var(--ab-green-dark);color:#fff;
  padding:13px 26px;border-radius:6px;font-family:var(--ab-font-head);font-weight:600;font-size:.82rem;
  text-transform:uppercase;letter-spacing:.03em;text-decoration:none;white-space:nowrap;
  transition:background .18s,transform .18s;flex-shrink:0;
}
.ab-cta-btn:hover{background:#5b8e26;transform:translateY(-2px);}
.ab-cta-btn svg{width:14px;height:14px;}
.ab-cta-btn i{font-size:12px;line-height:1}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1000px){
  :root{--ab-px:28px;}
  .ab-hero-inner{grid-template-columns:1fr;gap:38px;}
  .ab-hero-media{order:-1;}
  .ab-hero-media-frame img{height:280px;}
  .ab-story-inner{grid-template-columns:1fr;gap:32px;}
  .ab-offer-grid{grid-template-columns:repeat(2,1fr);}
  .ab-license-inner{grid-template-columns:1fr;gap:28px;}
  .ab-values-grid{grid-template-columns:1fr;}
  .ab-why-inner{grid-template-columns:1fr;gap:30px;}
  .ab-local-inner{grid-template-columns:1fr;gap:28px;}
}
@media(max-width:640px){
  :root{--ab-px:18px;}
  .ab-hero{padding:36px 0 44px;}
  .ab-hero-media-shape{display:none;}
  .ab-hero-media-frame img{height:220px;}
  .ab-hero-desc{font-size:.88rem;}
  .ab-story,.ab-values,.ab-why,.ab-license,.ab-offer,.ab-local{padding:40px 0;}

  /* Trust row: keep 3 per row on mobile, shrink to fit */
  .ab-hero-trust{gap:10px;}
  .ab-trust-icon{width:34px;height:34px;border-radius:8px;}
  .ab-trust-icon svg{width:15px;height:15px;}
.ab-trust-icon i{font-size:13px;line-height:1}
  .ab-trust-title{font-size:.72rem;}
  .ab-trust-sub{font-size:.66rem;line-height:1.3;}

  /* Stats grid: keep 2 per row on mobile */
  .ab-stats-grid{grid-template-columns:1fr 1fr;gap:10px;}
  .ab-stat-card{padding:18px 14px;}
  .ab-stat-num{font-size:1.35rem;}

  .ab-offer-grid{grid-template-columns:1fr;}
  .ab-license-card{padding:22px 20px;}
  .ab-license-num span{font-size:1.25rem;}
  .ab-why-grid{grid-template-columns:1fr;}
  .ab-cta{flex-direction:column;align-items:flex-start;padding:22px;}
  .ab-cta-btn{width:100%;justify-content:center;}
}
@media(max-width:420px){
  .ab-trust-icon{width:30px;height:30px;}
  .ab-trust-icon svg{width:13px;height:13px;}
.ab-trust-icon i{font-size:11px;line-height:1}
  .ab-trust-title{font-size:.64rem;letter-spacing:0;}
  .ab-trust-sub{font-size:.58rem;}
  .ab-hero-trust{gap:8px;}

  .ab-stat-card{padding:14px 10px;}
  .ab-stat-num{font-size:1.15rem;}
  .ab-stat-label{font-size:.72rem;}
  .ab-stat-icon{width:34px;height:34px;margin-bottom:10px;}
}
i.fa-solid,i.fa-regular,i.fa-brands{display:inline-flex;align-items:center;justify-content:center;line-height:1;flex-shrink:0}
</style>

<div class="ab-page">

  <!-- HERO (single, no slider) -->
  <section class="ab-hero">
    <div class="ab-wrap ab-hero-inner">
      <div class="ab-hero-text">
        <div class="ab-eyebrow">About Leshavin Pharmacy</div>
        <h1 class="ab-hero-title">Trusted Pharmacy in Nairobi<span>Caring for You, Every Step of the Way</span></h1>
        <p class="ab-hero-desc">Leshavin Pharmacy is a licensed and affordable online pharmacy in Nairobi offering medicines, baby products, vitamins, personal care and healthcare essentials. Our trusted, professional pharmacy team puts your health and wellbeing at the heart of everything we do.</p>

        <div class="ab-hero-trust">
          <div class="ab-trust-item">
            <!-- shield with check -->
            <div class="ab-trust-icon"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></div>
            <div><div class="ab-trust-title">Trusted</div><div class="ab-trust-sub">Trusted pharmacy in Nairobi</div></div>
          </div>
          <div class="ab-trust-item">
            <!-- heart -->
            <div class="ab-trust-icon"><i class="fa-regular fa-heart" aria-hidden="true"></i></div>
            <div><div class="ab-trust-title">Professional</div><div class="ab-trust-sub">Expert pharmacist advice</div></div>
          </div>
          <div class="ab-trust-item">
            <!-- delivery truck -->
            <div class="ab-trust-icon"><i class="fa-solid fa-truck" aria-hidden="true"></i></div>
            <div><div class="ab-trust-title">Affordable</div><div class="ab-trust-sub">Delivered to your doorstep</div></div>
          </div>
        </div>
      </div>

      <div class="ab-hero-media">
        <div class="ab-hero-media-shape"></div>
        <div class="ab-hero-media-frame">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/aboutusbg.png' ); ?>" alt="Leshavin Pharmacy, a trusted online pharmacy in Nairobi, with shelves of genuine medicines and healthcare products">
        </div>
        <div class="ab-hero-caption">Better Health,<br>A Stronger Tomorrow</div>
      </div>
    </div>
  </section>

  <!-- OUR STORY + STATS -->
  <section class="ab-story">
    <div class="ab-wrap ab-story-inner">
      <div class="ab-story-text">
        <div class="ab-eyebrow">Our Story</div>
        <h2 class="ab-sec-title">How Leshavin Pharmacy <span>Began in Nairobi</span></h2>
        <p>Leshavin Pharmacy was founded with a simple mission: to make quality healthcare accessible, affordable and convenient for every Kenyan. We believe good health is the foundation of a better life, and we're here to support you and your family on that journey.</p>
        <p>From everyday wellness to specialised care, we provide genuine medicines, professional guidance and fast delivery right to your doorstep, all backed by a licensed pharmacy team.</p>
        <p>As a Nairobi pharmacy, we are proud to serve local families with trusted, affordable and professional care, whether you shop online or speak to our team for advice.</p>
      </div>

      <div class="ab-stats-grid">
        <div class="ab-stat-card">
          <!-- package / box -->
          <div class="ab-stat-icon"><i class="fa-solid fa-box" aria-hidden="true"></i></div>
          <div class="ab-stat-num" data-target="5" data-suffix=",000+">0</div>
          <div class="ab-stat-label">Products Available</div>
        </div>
        <div class="ab-stat-card">
          <!-- group of people -->
          <div class="ab-stat-icon"><i class="fa-solid fa-users" aria-hidden="true"></i></div>
          <div class="ab-stat-num" data-target="20" data-suffix=",000+">0</div>
          <div class="ab-stat-label">Happy Customers </div>
        </div>
        <div class="ab-stat-card">
          <!-- clock -->
          <div class="ab-stat-icon"><i class="fa-regular fa-clock" aria-hidden="true"></i></div>
          <div class="ab-stat-num" data-target="24" data-suffix="/7">0/7</div>
          <div class="ab-stat-label">Delivery Across Kenya</div>
        </div>
        <div class="ab-stat-card">
          <!-- award badge -->
          <div class="ab-stat-icon"><i class="fa-solid fa-award" aria-hidden="true"></i></div>
          <div class="ab-stat-num" data-target="100" data-suffix="%">0%</div>
          <div class="ab-stat-label">Genuine Products</div>
        </div>
      </div>
    </div>
  </section>

  <!-- WHAT WE OFFER -->
  <section class="ab-offer">
    <div class="ab-wrap">
      <div class="ab-offer-head">
        <div class="ab-eyebrow">What We Offer</div>
        <h2 class="ab-sec-title">Affordable Medicines &amp; <span>Healthcare Essentials in Nairobi</span></h2>
        <p>Everything your family needs from a trusted online pharmacy in Nairobi, all in one place and at fair prices.</p>
      </div>
      <div class="ab-offer-grid">
        <div class="ab-offer-card">
          <!-- pill / capsule -->
          <div class="ab-offer-icon"><i class="fa-solid fa-pills" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Medicines &amp; Prescriptions</div>
          <div class="ab-offer-desc">Genuine, affordable prescription and over-the-counter medicines in Nairobi, checked by our registered pharmacists. Upload your prescription online and we take care of the rest.</div>
        </div>
        <div class="ab-offer-card">
          <!-- smiling face for baby care -->
          <div class="ab-offer-icon"><i class="fa-solid fa-face-smile" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Baby Products</div>
          <div class="ab-offer-desc">Trusted baby products for Nairobi parents, chosen with safety and quality in mind and priced fairly for every family.</div>
        </div>
        <div class="ab-offer-card">
          <!-- sun for vitamins -->
          <div class="ab-offer-icon"><i class="fa-solid fa-sun" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Vitamins &amp; Supplements</div>
          <div class="ab-offer-desc">Quality vitamins and supplements to support everyday wellness, with professional guidance from our pharmacy team.</div>
        </div>
        <div class="ab-offer-card">
          <!-- droplet for skin / personal care -->
          <div class="ab-offer-icon"><i class="fa-solid fa-droplet" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Personal &amp; Skin Care</div>
          <div class="ab-offer-desc">Personal care and dermatologist recommended skin care products, including CeraVe, at affordable prices in Nairobi.</div>
        </div>
        <div class="ab-offer-card">
          <!-- heartbeat for healthcare essentials -->
          <div class="ab-offer-icon"><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Healthcare Essentials</div>
          <div class="ab-offer-desc">Everyday healthcare essentials for your home and family, all from one trusted, professional Nairobi pharmacy.</div>
        </div>
        <div class="ab-offer-card">
          <!-- delivery truck -->
          <div class="ab-offer-icon"><i class="fa-solid fa-truck" aria-hidden="true"></i></div>
          <div class="ab-offer-title">Online Ordering &amp; Delivery</div>
          <div class="ab-offer-desc">Order online in minutes and get delivery in Nairobi and across Kenya. Pay securely with M-Pesa or card.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- LICENSED & COMPLIANT - verified license number only -->
  <section class="ab-license">
    <div class="ab-license-bg"></div>
    <div class="ab-license-overlay"></div>
    <div class="ab-wrap ab-license-inner">
      <div class="ab-license-head">
        <div class="ab-eyebrow">Licensed &amp; Compliant</div>
        <h2>Licensed Nairobi Pharmacy, Regulated By The Pharmacy and Poisons Board</h2>
        <p>Leshavin Pharmacy is a licensed pharmaceutical retailer, regulated by the Pharmacy and Poisons Board (PPB) of Kenya, ensuring every product we sell meets national safety and quality standards.</p>
      </div>
      <div class="ab-license-card">
        <div class="ab-license-card-label">PPB License Number</div>
        <div class="ab-license-num"><span><?php echo esc_html( $ab_ppb_license ); ?></span></div>
        <div class="ab-license-card-sub">Pharmacy and Poisons Board of Kenya</div>
      </div>
    </div>
  </section>

  <!-- MISSION / VISION / VALUES -->
  <section class="ab-values">
    <div class="ab-wrap">
      <div class="ab-values-head">
        <div class="ab-eyebrow">What Drives Us</div>
        <h2 class="ab-sec-title">Our Mission, Vision &amp; <span>Values</span></h2>
      </div>
      <div class="ab-values-grid">
        <div class="ab-value-card">
          <!-- target -->
          <div class="ab-value-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></div>
          <div class="ab-value-title">Our Mission</div>
          <div class="ab-value-desc">To put genuine, affordable medicine within easy reach of every household we serve in Nairobi and across Kenya, with each order checked by a registered pharmacist before it leaves our shelves.</div>
        </div>
        <div class="ab-value-card">
          <!-- eye -->
          <div class="ab-value-icon"><i class="fa-solid fa-eye" aria-hidden="true"></i></div>
          <div class="ab-value-title">Our Vision</div>
          <div class="ab-value-desc">To be the trusted, professional pharmacy Nairobi families turn to first, known for consistent stock, straightforward pricing and delivery that arrives when we say it will.</div>
        </div>
        <div class="ab-value-card">
          <!-- heart -->
          <div class="ab-value-icon"><i class="fa-regular fa-heart" aria-hidden="true"></i></div>
          <div class="ab-value-title">Our Values</div>
          <div class="ab-value-desc">Professional accuracy in every order we dispense, honesty in how we price and communicate, and accountability to the people who trust us with their health.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section class="ab-why">
    <div class="ab-wrap ab-why-inner">
      <div class="ab-why-text">
        <div class="ab-eyebrow">Our Promise</div>
        <h2 class="ab-sec-title">Why Choose <span>Leshavin, Your Trusted Nairobi Pharmacy?</span></h2>
        <p>Every order is handled with the same professional care and attention to detail, from sourcing to delivery, so you can order from an affordable, trusted pharmacy in Nairobi with complete confidence.</p>
      </div>
      <div class="ab-why-grid">
        <div class="ab-why-item">
          <!-- check circle -->
          <div class="ab-why-icon"><i class="fa-solid fa-circle-check" aria-hidden="true"></i></div>
          <div><div class="ab-why-title">Genuine, Affordable Products</div><div class="ab-why-desc">We source only authentic medicines and healthcare products from trusted, licensed suppliers, at fair prices.</div></div>
        </div>
        <div class="ab-why-item">
          <!-- truck -->
          <div class="ab-why-icon"><i class="fa-solid fa-truck" aria-hidden="true"></i></div>
          <div><div class="ab-why-title">Fast Delivery in Nairobi</div><div class="ab-why-desc">We deliver your orders safely and on time in Nairobi and anywhere in Kenya.</div></div>
        </div>
        <div class="ab-why-item">
          <!-- user with check -->
          <div class="ab-why-icon"><i class="fa-solid fa-user-check" aria-hidden="true"></i></div>
          <div><div class="ab-why-title">Professional Advice</div><div class="ab-why-desc">Our registered pharmacists are always ready to offer professional, friendly guidance.</div></div>
        </div>
        <div class="ab-why-item">
          <!-- padlock -->
          <div class="ab-why-icon"><i class="fa-solid fa-lock" aria-hidden="true"></i></div>
          <div><div class="ab-why-title">Secure Payments</div><div class="ab-why-desc">Shop with confidence using our secure M-Pesa and card payment options.</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- LOCAL NAIROBI BAND -->
  <section class="ab-local">
    <div class="ab-wrap ab-local-inner">
      <div class="ab-local-text">
        <div class="ab-eyebrow">Your Local Pharmacy</div>
        <h2 class="ab-sec-title">Affordable, Trusted Pharmacy Care <span>in Nairobi</span></h2>
        <p>Looking for a trusted pharmacy in Nairobi? Leshavin Pharmacy brings professional pharmacist advice, genuine medicines and affordable prices together in one convenient online pharmacy. Whether you need prescription medicines, baby products, vitamins or personal care, our Nairobi pharmacy team is ready to help.</p>
        <p>Order online from anywhere in Nairobi and across Kenya, upload your prescription in minutes, or contact our team for friendly, professional advice. Quality, honesty and care guide every order we send out.</p>
      </div>
      <div class="ab-local-links">
        <a class="ab-local-link" href="<?php echo esc_url( $ab_shop_url ); ?>">
          <span>
            <!-- shopping cart -->
            <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
            Shop Online Pharmacy
          </span>
          <i class="fa-solid fa-arrow-right ab-arrow" aria-hidden="true"></i>
        </a>
        <a class="ab-local-link" href="<?php echo esc_url( home_url( '/submit-prescription' ) ); ?>">
          <span>
            <!-- document / prescription -->
            <i class="fa-solid fa-file-prescription" aria-hidden="true"></i>
            Submit Prescription
          </span>
          <i class="fa-solid fa-arrow-right ab-arrow" aria-hidden="true"></i>
        </a>
        <a class="ab-local-link" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">
          <span>
            <!-- telephone -->
            <i class="fa-solid fa-phone" aria-hidden="true"></i>
            Contact Our Pharmacists
          </span>
          <i class="fa-solid fa-arrow-right ab-arrow" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- CTA STRIP -->
  <div class="ab-cta-wrap">
    <div class="ab-wrap">
      <div class="ab-cta">
        <div class="ab-cta-left">
          <!-- chat bubble -->
          <div class="ab-cta-icon"><i class="fa-solid fa-comment" aria-hidden="true"></i></div>
          <div>
            <div class="ab-cta-title">We're Here for You in Nairobi</div>
            <div class="ab-cta-sub">Have questions or need professional advice? Our friendly pharmacy team is always ready to assist you.</div>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="ab-cta-btn">
          Contact Us
          <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>

</div>

<script>
(function(){
  function animateCounter(el) {
    var target = parseInt(el.getAttribute('data-target'), 10);
    var suffix = el.getAttribute('data-suffix') || '';
    var duration = 1400, start = null;
    function step(ts) {
      if (!start) start = ts;
      var progress = Math.min((ts - start) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target) + suffix;
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target + suffix;
    }
    requestAnimationFrame(step);
  }
  var counters = document.querySelectorAll('.ab-stat-num');
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function(entries){
      entries.forEach(function(e){ if (e.isIntersecting) { animateCounter(e.target); obs.unobserve(e.target); } });
    }, { threshold: 0.3 });
    counters.forEach(function(c){ obs.observe(c); });
  } else {
    counters.forEach(animateCounter);
  }
})();
</script>

<?php get_footer(); ?>
<?php echo '<!-- deploy-test 20261107-024453 -->'; ?>