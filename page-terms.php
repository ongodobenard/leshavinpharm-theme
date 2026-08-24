<?php
/**
 * Template Name: Terms & Conditions
 * Leshavin Pharmacy - page-terms.php
 */
get_header();

$tc_wa       = leshavin_phone();
$tc_phone    = leshavin_phone_display();
$tc_email    = leshavin_email();
$tc_hero_bg  = get_template_directory_uri() . '/assets/js/images/terms.png';
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --tc-navy:#0e2358;
  --tc-blue:#1c75bc;
  --tc-blue-dark:#125a94;
  --tc-green:#8dc63f;
  --tc-green-dark:#6ea82e;
  --tc-green-pale:#f2f9e9;
  --tc-text:#1c2b3a;
  --tc-text-light:#6b7c8f;
  --tc-border:#e4e9ef;
  --tc-bg-soft:#f7f9fb;
  --tc-font-head:'Oswald',Arial Narrow,sans-serif;
  --tc-font-body:'Inter',sans-serif;
  --tc-px:40px;
}
.tc-page{font-family:var(--tc-font-body);color:var(--tc-text);overflow-x:hidden;}
.tc-wrap{max-width:1280px;margin:0 auto;padding:0 var(--tc-px);}

.tc-sec-title{
  font-family:var(--tc-font-head);font-weight:700;text-transform:uppercase;
  color:var(--tc-navy);line-height:1.2;font-size:clamp(1.3rem,2.6vw,1.7rem);margin:0 0 6px;
}

/* ============================================================
   HERO - full-bleed background image with overlaid copy
   ============================================================ */
.tc-hero{
  position:relative;
  padding:60px 0 64px;
  overflow:hidden;
  background-image:url('<?php echo esc_url( $tc_hero_bg ); ?>');
  background-size:cover;
  background-position:center right;
  background-repeat:no-repeat;
}
.tc-hero::before{
  content:'';
  position:absolute;inset:0;
  background:linear-gradient(90deg,
    #ffffff 0%,
    rgba(255,255,255,.94) 26%,
    rgba(255,255,255,.62) 46%,
    rgba(255,255,255,.08) 66%,
    rgba(255,255,255,0) 78%
  );
  z-index:1;
}
.tc-hero .tc-wrap{position:relative;z-index:2;}

.tc-hero-media-box{position:relative;}

.tc-hero-text{max-width:600px;width:100%;position:relative;}
.tc-hero-title{
  font-family:var(--tc-font-head);font-weight:700;text-transform:uppercase;
  color:var(--tc-navy);font-size:clamp(1.9rem,4.4vw,3.1rem);line-height:1.12;margin:0 0 10px;
  overflow-wrap:break-word;word-break:break-word;max-width:100%;
}
.tc-hero-kicker{
  font-family:var(--tc-font-head);font-weight:600;text-transform:uppercase;
  color:var(--tc-green-dark);font-size:clamp(1rem,1.8vw,1.25rem);margin:0 0 16px;
}
.tc-hero-desc{font-size:.95rem;line-height:1.75;color:var(--tc-text-light);max-width:480px;overflow-wrap:break-word;}

/* decorative badge, echoing the mockup */
.tc-hero-badge{
  position:absolute;
  top:10px;right:-6px;
  width:96px;height:96px;
  border-radius:50%;
  background:rgba(255,255,255,.9);
  border:1.5px solid var(--tc-border);
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 14px 30px rgba(14,35,88,.10);
  z-index:3;
}
.tc-hero-badge svg{width:38px;height:38px;color:var(--tc-navy);}

/* Trust strip under hero */
.tc-trust{
  margin-top:34px;background:#fff;border:1.5px solid var(--tc-border);border-radius:14px;
  padding:26px var(--tc-px);display:grid;grid-template-columns:repeat(4,1fr);gap:26px;
  box-shadow:0 10px 28px rgba(14,35,88,.06);
}
.tc-trust-item{display:flex;align-items:center;gap:12px;}
.tc-trust-icon{
  width:42px;height:42px;border-radius:10px;background:var(--tc-bg-soft);border:1.5px solid var(--tc-border);
  display:flex;align-items:center;justify-content:center;color:var(--tc-blue-dark);flex-shrink:0;
}
.tc-trust-icon svg{width:19px;height:19px;}
.tc-trust-title{font-family:var(--tc-font-head);font-weight:600;font-size:.84rem;color:var(--tc-text);text-transform:uppercase;letter-spacing:.01em;}
.tc-trust-sub{font-size:.76rem;color:var(--tc-text-light);}

/* ============================================================
   GENERAL TERMS (intro)
   ============================================================ */
.tc-intro{padding:56px 0 10px;background:#fff;}
.tc-intro-head{display:flex;align-items:flex-start;gap:14px;margin-bottom:14px;}
.tc-num{
  width:30px;height:30px;border-radius:8px;background:var(--tc-navy);color:#fff;
  font-family:var(--tc-font-head);font-weight:700;font-size:.84rem;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;margin-top:2px;
}
.tc-intro-head h2{font-family:var(--tc-font-head);font-weight:700;text-transform:uppercase;color:var(--tc-navy);font-size:1.15rem;margin:4px 0 0;}
.tc-intro p{font-size:.88rem;line-height:1.8;color:var(--tc-text-light);margin:0;max-width:900px;}

/* ============================================================
   TERMS GRID (sections 2-7) - numbering only, no icons
   ============================================================ */
.tc-terms{padding:34px 0 20px;background:#fff;}
.tc-terms-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px 40px;}
.tc-term{
  display:flex;gap:14px;padding:20px 0;border-bottom:1px solid var(--tc-border);
}
.tc-terms-grid .tc-term:nth-last-child(-n+1),
.tc-terms-grid .tc-term:nth-last-child(2){border-bottom:none;}
.tc-term-title{font-family:var(--tc-font-head);font-weight:700;font-size:.9rem;color:var(--tc-navy);text-transform:none;margin-bottom:6px;}
.tc-term-desc{font-size:.82rem;line-height:1.7;color:var(--tc-text-light);}

/* ============================================================
   IMPORTANT NOTE
   ============================================================ */
.tc-note-wrap{padding:20px 0 40px;background:#fff;}
.tc-note{
  display:flex;gap:14px;align-items:flex-start;
  background:var(--tc-bg-soft);border:1.5px solid var(--tc-border);border-radius:12px;
  padding:20px 22px;
}
.tc-note-icon{
  width:38px;height:38px;border-radius:50%;background:var(--tc-blue-dark);color:#fff;flex-shrink:0;
  display:flex;align-items:center;justify-content:center;
}
.tc-note-icon svg{width:17px;height:17px;}
.tc-note-title{font-family:var(--tc-font-head);font-weight:700;font-size:.88rem;color:var(--tc-text);margin-bottom:4px;text-transform:uppercase;}
.tc-note-desc{font-size:.82rem;line-height:1.7;color:var(--tc-text-light);}

/* ============================================================
   CTA STRIP
   ============================================================ */
.tc-cta-wrap{padding:0 0 60px;background:#fff;}
.tc-cta{
  background:var(--tc-navy);border-radius:14px;
  padding:26px 32px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;
}
.tc-cta-left{display:flex;align-items:center;gap:16px;}
.tc-cta-icon{
  width:48px;height:48px;border-radius:12px;background:rgba(255,255,255,.12);
  display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;
}
.tc-cta-icon svg{width:22px;height:22px;}
.tc-cta-title{font-family:var(--tc-font-head);font-weight:700;color:#fff;font-size:1.02rem;text-transform:uppercase;margin-bottom:3px;}
.tc-cta-sub{font-size:.8rem;color:rgba(255,255,255,.7);max-width:480px;}
.tc-btn{
  display:inline-flex;align-items:center;gap:8px;padding:12px 22px;border-radius:6px;
  font-family:var(--tc-font-head);font-weight:600;font-size:.8rem;text-transform:uppercase;letter-spacing:.03em;
  text-decoration:none;white-space:nowrap;transition:background .18s,transform .18s,border-color .18s;
  background:transparent;color:var(--tc-green);border:1.5px solid var(--tc-green);
}
.tc-btn:hover{background:var(--tc-green);color:#fff;transform:translateY(-2px);}
.tc-btn svg{width:14px;height:14px;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:900px){
  :root{--tc-px:16px;}
}
@media(max-width:1000px){
  .tc-hero{padding:44px 0 40px;}
  .tc-hero::before{
    background:linear-gradient(180deg,
      #ffffff 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.5) 72%,
      rgba(255,255,255,.15) 100%
    );
  }
  .tc-hero-text{max-width:100%;}
  .tc-hero-badge{display:none;}
  .tc-trust{grid-template-columns:1fr 1fr;}
  .tc-terms-grid{grid-template-columns:1fr;gap:0;}
  .tc-terms-grid .tc-term{border-bottom:1px solid var(--tc-border);}
  .tc-terms-grid .tc-term:last-child{border-bottom:none;}
}
@media(max-width:640px){
  .tc-hero{
    padding:28px 0 24px;
    background-image:none;
  }
  .tc-hero::before{display:none;}
  .tc-hero-media-box{
    border-radius:14px;overflow:hidden;position:relative;
    border:1px solid var(--tc-border);
    box-shadow:0 14px 32px rgba(14,35,88,.12);
    background-image:url('<?php echo esc_url( $tc_hero_bg ); ?>');
    background-size:cover;
    background-position:65% center;
    background-repeat:no-repeat;
    min-height:260px;
    display:flex;
    align-items:center;
    padding:20px;
  }
  .tc-hero-media-box::before{
    content:'';
    position:absolute;inset:0;
    background:linear-gradient(90deg,
      rgba(255,255,255,.97) 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.4) 68%,
      rgba(255,255,255,0) 88%
    );
  }
  .tc-hero-media-box .tc-hero-text{position:relative;z-index:1;max-width:100%;}
  .tc-hero-desc{font-size:.86rem;}
  .tc-trust{margin-top:22px;grid-template-columns:1fr;padding:20px;gap:18px;}
  .tc-intro,.tc-terms{padding:30px 0 6px;}
  .tc-cta{flex-direction:column;align-items:flex-start;padding:22px;}
  .tc-cta .tc-btn{width:100%;justify-content:center;}
}
</style>

<div class="tc-page">

  <!-- HERO -->
  <section class="tc-hero">
    <div class="tc-wrap">

      <div class="tc-hero-media-box">
        <div class="tc-hero-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l8 3v6c0 5.5-3.5 9.7-8 11-4.5-1.3-8-5.5-8-11V5l8-3z"/><polyline points="9 12 11 14 15 10"/></svg>
        </div>
        <div class="tc-hero-text">
          <h1 class="tc-hero-title">Terms &amp; Conditions</h1>
          <div class="tc-hero-kicker">Clear Terms. Trusted Service.</div>
          <p class="tc-hero-desc">These Terms &amp; Conditions govern your use of Leshavin Pharmacy website and services. By using our website, you agree to comply with and be bound by the following terms.</p>
        </div>
      </div>

      <div class="tc-trust">
        <div class="tc-trust-item">
          <div class="tc-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="15" y2="17"/></svg></div>
          <div><div class="tc-trust-title">Transparent</div><div class="tc-trust-sub">Clear and fair terms for everyone.</div></div>
        </div>
        <div class="tc-trust-item">
          <div class="tc-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l8 3v6c0 5.5-3.5 9.7-8 11-4.5-1.3-8-5.5-8-11V5l8-3z"/></svg></div>
          <div><div class="tc-trust-title">Secure</div><div class="tc-trust-sub">Your data and privacy are protected.</div></div>
        </div>
        <div class="tc-trust-item">
          <div class="tc-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0116 0v1"/></svg></div>
          <div><div class="tc-trust-title">Reliable</div><div class="tc-trust-sub">We are committed to quality service.</div></div>
        </div>
        <div class="tc-trust-item">
          <div class="tc-trust-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8a4 4 0 00-8 0v3H8l-4 4 4 4h2v-2"/><path d="M6 16a4 4 0 008 0v-3h2l4-4-4-4h-2v2"/></svg></div>
          <div><div class="tc-trust-title">Fair Use</div><div class="tc-trust-sub">Use our website responsibly.</div></div>
        </div>
      </div>

    </div>
  </section>

  <!-- 1. GENERAL TERMS -->
  <section class="tc-intro">
    <div class="tc-wrap">
      <div class="tc-intro-head">
        <div class="tc-num">1</div>
        <h2>General Terms</h2>
      </div>
      <p>By accessing and using the Leshavin Pharmacy website, you agree to be bound by these Terms &amp; Conditions and any other policies or notices displayed on this site from time to time.</p>
    </div>
  </section>

  <!-- 2-7. TERMS GRID (numbering only) -->
  <section class="tc-terms">
    <div class="tc-wrap tc-terms-grid">

      <div class="tc-term">
        <div class="tc-num">2</div>
        <div>
          <div class="tc-term-title">Use of Our Website</div>
          <div class="tc-term-desc">You agree to use our website for lawful purposes only. You must not use our website in any way that may damage, disable, or impair the site or interfere with any other party's use.</div>
        </div>
      </div>

      <div class="tc-term">
        <div class="tc-num">3</div>
        <div>
          <div class="tc-term-title">Orders &amp; Acceptance</div>
          <div class="tc-term-desc">All orders are subject to acceptance and availability. We reserve the right to refuse or cancel any order at our sole discretion.</div>
        </div>
      </div>

      <div class="tc-term">
        <div class="tc-num">4</div>
        <div>
          <div class="tc-term-title">Pricing &amp; Payment</div>
          <div class="tc-term-desc">All prices are in Kenyan Shillings (Ksh) and are inclusive of applicable taxes unless stated otherwise. We reserve the right to update prices at any time without prior notice.</div>
        </div>
      </div>

      <div class="tc-term">
        <div class="tc-num">5</div>
        <div>
          <div class="tc-term-title">Delivery</div>
          <div class="tc-term-desc">We aim to deliver orders within the estimated time. Delivery times may vary based on your location and product availability.</div>
        </div>
      </div>

      <div class="tc-term">
        <div class="tc-num">6</div>
        <div>
          <div class="tc-term-title">Returns &amp; Refunds</div>
          <div class="tc-term-desc">Please refer to our <a href="<?php echo esc_url( home_url('/return-policy') ); ?>" style="color:var(--tc-blue-dark);font-weight:700;text-decoration:none;">Return Policy</a> for details on returns, exchanges, and refunds.</div>
        </div>
      </div>

      <div class="tc-term">
        <div class="tc-num">7</div>
        <div>
          <div class="tc-term-title">Intellectual Property</div>
          <div class="tc-term-desc">All content on this website, including text, graphics, logos, and images, is the property of Leshavin Pharmacy and is protected by copyright laws.</div>
        </div>
      </div>

    </div>
  </section>

  <!-- IMPORTANT NOTE -->
  <section class="tc-note-wrap">
    <div class="tc-wrap">
      <div class="tc-note">
        <div class="tc-note-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg></div>
        <div>
          <div class="tc-note-title">Important Note</div>
          <div class="tc-note-desc">We reserve the right to update or modify these Terms &amp; Conditions at any time without prior notice. Changes will be effective immediately upon posting on this page. Please review this page regularly.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <div class="tc-cta-wrap">
    <div class="tc-wrap">
      <div class="tc-cta">
        <div class="tc-cta-left">
          <div class="tc-cta-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><polyline points="9 15 11 17 15 12.5"/></svg></div>
          <div>
            <div class="tc-cta-title">By Using Our Website</div>
            <div class="tc-cta-sub">You acknowledge that you have read, understood, and agree to be bound by these Terms &amp; Conditions.</div>
          </div>
        </div>
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="tc-btn">
          Continue Shopping
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>