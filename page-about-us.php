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
.ab-hero-desc{font-size:.98rem;line-height:1.75;color:var(--ab-text-light);max-width:480px;margin-bottom:30px;}

.ab-hero-trust{display:flex;flex-direction:column;gap:16px;}
.ab-trust-item{display:flex;align-items:center;gap:14px;}
.ab-trust-icon{
  width:42px;height:42px;border-radius:10px;flex-shrink:0;
  background:#fff;border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-blue-dark);
}
.ab-trust-icon svg{width:19px;height:19px;}
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
.ab-stat-num{font-family:var(--ab-font-head);font-size:1.7rem;font-weight:700;color:var(--ab-navy);font-variant-numeric:tabular-nums;}
.ab-stat-label{font-size:.8rem;color:var(--ab-text-light);margin-top:4px;}

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
   Icons removed - numeral badges only, per updated content pass.
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
.ab-value-num{
  width:40px;height:40px;border-radius:10px;background:var(--ab-bg-soft);border:1.5px solid var(--ab-border);
  display:flex;align-items:center;justify-content:center;color:var(--ab-navy);margin-bottom:18px;
  font-family:var(--ab-font-head);font-weight:700;font-size:1.05rem;
}
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
.ab-why-title{font-family:var(--ab-font-head);font-size:.88rem;font-weight:700;color:var(--ab-navy);text-transform:uppercase;margin-bottom:4px;}
.ab-why-desc{font-size:.8rem;color:var(--ab-text-light);line-height:1.65;}

/* ============================================================
   CTA STRIP
   ============================================================ */
.ab-cta-wrap{padding:0 0 60px;background:#fff;}
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

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1000px){
  :root{--ab-px:28px;}
  .ab-hero-inner{grid-template-columns:1fr;gap:38px;}
  .ab-hero-media{order:-1;}
  .ab-hero-media-frame img{height:280px;}
  .ab-story-inner{grid-template-columns:1fr;gap:32px;}
  .ab-license-inner{grid-template-columns:1fr;gap:28px;}
  .ab-values-grid{grid-template-columns:1fr;}
  .ab-why-inner{grid-template-columns:1fr;gap:30px;}
}
@media(max-width:640px){
  :root{--ab-px:18px;}
  .ab-hero{padding:36px 0 44px;}
  .ab-hero-media-shape{display:none;}
  .ab-hero-media-frame img{height:220px;}
  .ab-hero-desc{font-size:.88rem;}
  .ab-story,.ab-values,.ab-why,.ab-license{padding:40px 0;}
  .ab-stats-grid{grid-template-columns:1fr 1fr;gap:10px;}
  .ab-stat-card{padding:18px 14px;}
  .ab-stat-num{font-size:1.35rem;}
  .ab-license-card{padding:22px 20px;}
  .ab-license-num span{font-size:1.25rem;}
  .ab-why-grid{grid-template-columns:1fr;}
  .ab-cta{flex-direction:column;align-items:flex-start;padding:22px;}
  .ab-cta-btn{width:100%;justify-content:center;}
}
@media(max-width:420px){
  .ab-stats-grid{grid-template-columns:1fr;}
}
</style>

<div class="ab-page">

  <!-- HERO (single, no slider) -->
  <section class="ab-hero">
    <div class="ab-wrap ab-hero-inner">
      <div class="ab-hero-text">
        <div class="ab-eyebrow">About Us</div>
        <h1 class="ab-hero-title">Caring for You,<span>Every Step of the Way</span></h1>
        <p class="ab-hero-desc">At Leshavin Pharmacy, we're committed to providing high-quality medicines and healthcare products with trusted advice and exceptional service. Your health and wellbeing are at the heart of everything we do.</p>

        <div class="ab-hero-trust">
          <div class="ab-trust-item">
            <div class="ab-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
            <div><div class="ab-trust-title">Trusted</div><div class="ab-trust-sub">Quality you can trust</div></div>
          </div>
          <div class="ab-trust-item">
            <div class="ab-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
            <div><div class="ab-trust-title">Customer Focused</div><div class="ab-trust-sub">Your health first</div></div>
          </div>
          <div class="ab-trust-item">
            <div class="ab-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
            <div><div class="ab-trust-title">Convenient</div><div class="ab-trust-sub">Care at your doorstep</div></div>
          </div>
        </div>
      </div>

      <div class="ab-hero-media">
        <div class="ab-hero-media-shape"></div>
        <div class="ab-hero-media-frame">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/aboutusbg.png' ); ?>" alt="Leshavin Pharmacy shelves">
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
        <h2 class="ab-sec-title">How Leshavin <span>Began</span></h2>
        <p>Leshavin Pharmacy was founded with a simple mission: to make quality healthcare accessible, affordable and convenient for every Kenyan. We believe good health is the foundation of a better life, and we're here to support you and your family on that journey.</p>
        <p>From everyday wellness to specialised care, we provide genuine medicines, expert guidance and fast delivery right to your doorstep, all backed by a licensed pharmacy team.</p>
      </div>

      <div class="ab-stats-grid">
        <div class="ab-stat-card">
          <div class="ab-stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
          <div class="ab-stat-num" data-target="5" data-suffix=",000+">0</div>
          <div class="ab-stat-label">Products Available</div>
        </div>
        <div class="ab-stat-card">
          <div class="ab-stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></div>
          <div class="ab-stat-num" data-target="20" data-suffix=",000+">0</div>
          <div class="ab-stat-label">Happy Customers BEN</div>
        </div>
        <div class="ab-stat-card">
          <div class="ab-stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
          <div class="ab-stat-num" data-target="24" data-suffix="/7">0/7</div>
          <div class="ab-stat-label">Delivery Across Kenya</div>
        </div>
        <div class="ab-stat-card">
          <div class="ab-stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div>
          <div class="ab-stat-num" data-target="100" data-suffix="%">0%</div>
          <div class="ab-stat-label">Genuine Products</div>
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
        <h2>Regulated By The Pharmacy and Poisons Board</h2>
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
          <div class="ab-value-num">01</div>
          <div class="ab-value-title">Our Mission</div>
          <div class="ab-value-desc">To put genuine, correctly dispensed medicine within easy reach of every household we serve, with each order checked by a registered pharmacist before it leaves our shelves.</div>
        </div>
        <div class="ab-value-card">
          <div class="ab-value-num">02</div>
          <div class="ab-value-title">Our Vision</div>
          <div class="ab-value-desc">To be the pharmacy Kenyan families turn to first, known for consistent stock, straightforward pricing and delivery that arrives when we say it will.</div>
        </div>
        <div class="ab-value-card">
          <div class="ab-value-num">03</div>
          <div class="ab-value-title">Our Values</div>
          <div class="ab-value-desc">Accuracy in every order we dispense, honesty in how we price and communicate, and accountability to the people who trust us with their health.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- WHY CHOOSE US -->
  <section class="ab-why">
    <div class="ab-wrap ab-why-inner">
      <div class="ab-why-text">
        <div class="ab-eyebrow">Our Promise</div>
        <h2 class="ab-sec-title">Why Choose <span>Leshavin Pharmacy?</span></h2>
        <p>Every order is handled with the same care and attention to detail, from sourcing to delivery, so you can order with complete confidence.</p>
      </div>
      <div class="ab-why-grid">
        <div class="ab-why-item">
          <div class="ab-why-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
          <div><div class="ab-why-title">Genuine Products</div><div class="ab-why-desc">We source only authentic medicines and healthcare products from trusted, licensed suppliers.</div></div>
        </div>
        <div class="ab-why-item">
          <div class="ab-why-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
          <div><div class="ab-why-title">Fast &amp; Reliable Delivery</div><div class="ab-why-desc">We deliver your orders safely and on time, anywhere in Kenya.</div></div>
        </div>
        <div class="ab-why-item">
          <div class="ab-why-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div>
          <div><div class="ab-why-title">Expert Advice</div><div class="ab-why-desc">Our registered pharmacists are always ready to offer professional guidance.</div></div>
        </div>
        <div class="ab-why-item">
          <div class="ab-why-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg></div>
          <div><div class="ab-why-title">Secure Payments</div><div class="ab-why-desc">Shop with confidence using our secure M-Pesa and card payment options.</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA STRIP -->
  <div class="ab-cta-wrap">
    <div class="ab-wrap">
      <div class="ab-cta">
        <div class="ab-cta-left">
          <div class="ab-cta-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg></div>
          <div>
            <div class="ab-cta-title">We're Here for You</div>
            <div class="ab-cta-sub">Have questions or need help? Our friendly team is always ready to assist you.</div>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="ab-cta-btn">
          Contact Us
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
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