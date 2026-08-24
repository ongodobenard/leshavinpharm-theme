<?php
/**
 * Template Name: Delivery, Payment & Returns Policy
 * Leshavin Pharmacy - page-return-policy.php
 */
get_header();

$rp_wa    = leshavin_phone();
$rp_phone = leshavin_phone_display();
$rp_email = leshavin_email();
$rp_hero_bg = get_template_directory_uri() . '/assets/js/images/return-hero.png';
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --rp-navy:#0e2358;
  --rp-blue:#1c75bc;
  --rp-blue-dark:#125a94;
  --rp-green:#8dc63f;
  --rp-green-dark:#6ea82e;
  --rp-red:#c0392b;
  --rp-text:#1c2b3a;
  --rp-text-light:#6b7c8f;
  --rp-border:#e4e9ef;
  --rp-bg-soft:#f7f9fb;
  --rp-font-head:'Oswald',Arial Narrow,sans-serif;
  --rp-font-body:'Inter',sans-serif;
  --rp-px:40px;
}
.rp-page{font-family:var(--rp-font-body);color:var(--rp-text);overflow-x:hidden;}
.rp-wrap{max-width:1280px;margin:0 auto;padding:0 var(--rp-px);}

.rp-eyebrow{
  display:inline-flex;align-items:center;gap:10px;
  font-family:var(--rp-font-head);font-size:.74rem;font-weight:600;
  letter-spacing:.14em;text-transform:uppercase;color:var(--rp-green-dark);
  margin-bottom:12px;
}
.rp-eyebrow::before{content:'';width:26px;height:2px;background:var(--rp-green);flex-shrink:0;}

.rp-sec-title{
  font-family:var(--rp-font-head);font-weight:700;text-transform:uppercase;
  color:var(--rp-navy);line-height:1.2;font-size:clamp(1.3rem,2.6vw,1.7rem);margin:0 0 6px;
}

/* ============================================================
   HERO - full-bleed background image with overlaid copy
   ============================================================ */
.rp-hero{
  position:relative;
  padding:70px 0 64px;
  overflow:hidden;
  background-image:url('<?php echo esc_url( $rp_hero_bg ); ?>');
  background-size:cover;
  background-position:center right;
  background-repeat:no-repeat;
}
.rp-hero::before{
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
.rp-hero .rp-wrap{position:relative;z-index:2;}

.rp-hero-media-box{position:relative;}

.rp-hero-text{max-width:560px;width:100%;}
.rp-hero-title{
  font-family:var(--rp-font-head);font-weight:700;text-transform:uppercase;
  color:var(--rp-navy);font-size:clamp(1.6rem,4vw,2.9rem);line-height:1.15;margin:0 0 12px;
  overflow-wrap:break-word;word-break:break-word;max-width:100%;
}
.rp-hero-title span{display:block;color:var(--rp-green-dark);}
.rp-hero-desc{font-size:.95rem;line-height:1.75;color:var(--rp-text-light);max-width:480px;overflow-wrap:break-word;}

/* Trust strip under hero - text only, no icon boxes */
.rp-trust{
  margin-top:34px;background:#fff;border:1.5px solid var(--rp-border);border-radius:14px;
  padding:26px var(--rp-px);display:grid;grid-template-columns:repeat(4,1fr);gap:26px;
  box-shadow:0 10px 28px rgba(14,35,88,.06);
}
.rp-trust-item{border-left:3px solid var(--rp-green);padding-left:14px;}
.rp-trust-title{font-family:var(--rp-font-head);font-weight:600;font-size:.84rem;color:var(--rp-text);text-transform:uppercase;letter-spacing:.01em;margin-bottom:2px;}
.rp-trust-sub{font-size:.76rem;color:var(--rp-text-light);}

/* ============================================================
   CONDITIONS / NON-RETURNABLE
   ============================================================ */
.rp-conditions{padding:56px 0;background:#fff;}
.rp-cond-grid{display:grid;grid-template-columns:1fr 1fr;gap:34px;}

.rp-list{list-style:none;margin:0;padding:0;}
.rp-list li{display:flex;gap:12px;margin-bottom:18px;}
.rp-list li:last-child{margin-bottom:0;}
/* Plain bold numeral marker - no circle, no icon */
.rp-list-num{
  flex-shrink:0;width:20px;
  font-family:var(--rp-font-head);font-weight:700;font-size:.82rem;
  padding-top:1px;
}
.rp-list.yes .rp-list-num{color:var(--rp-green-dark);}
.rp-list.no .rp-list-num{color:var(--rp-red);}
.rp-list-title{font-size:.88rem;font-weight:700;color:var(--rp-text);margin-bottom:3px;}
.rp-list-sub{font-size:.8rem;color:var(--rp-text-light);line-height:1.5;}

.rp-note{
  margin-top:22px;background:var(--rp-bg-soft);border:1.5px solid var(--rp-border);border-left:4px solid var(--rp-green);
  border-radius:8px;padding:16px 18px;font-size:.82rem;color:var(--rp-text-light);line-height:1.7;
}
.rp-note strong{color:var(--rp-text);}

/* Help box - no icon */
.rp-help{
  margin-top:22px;background:var(--rp-blue-dark);border-radius:12px;padding:22px 24px;color:#fff;
}
.rp-help-title{font-family:var(--rp-font-head);font-weight:700;font-size:.92rem;text-transform:uppercase;margin-bottom:4px;}
.rp-help-desc{font-size:.8rem;color:rgba(255,255,255,.72);line-height:1.6;margin-bottom:10px;}
.rp-help-line{display:flex;flex-wrap:wrap;gap:14px;font-size:.8rem;}
.rp-help-line a{color:#fff;text-decoration:underline;text-underline-offset:2px;}
.rp-help-line a:hover{color:var(--rp-green);}

/* ============================================================
   DELIVERY & PAYMENT (card grid) - numeral markers, no icon boxes
   ============================================================ */
.rp-delivery{padding:56px 0;background:var(--rp-bg-soft);}
.rp-delivery-head{margin-bottom:28px;}
.rp-card-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px;}
.rp-card{
  background:#fff;border:1.5px solid var(--rp-border);border-radius:12px;padding:22px;
  transition:box-shadow .18s,border-color .18s;
}
.rp-card:hover{border-color:var(--rp-green);box-shadow:0 10px 24px rgba(14,35,88,.07);}
.rp-card-title{
  display:flex;align-items:baseline;gap:10px;
  font-family:var(--rp-font-head);font-weight:700;font-size:.9rem;color:var(--rp-navy);
  text-transform:uppercase;margin-bottom:12px;
}
.rp-card-num{
  font-family:var(--rp-font-head);font-weight:700;font-size:.82rem;color:var(--rp-green-dark);flex-shrink:0;
}
.rp-card ul{margin:0;padding:0;list-style:none;}
.rp-card li{font-size:.82rem;line-height:1.65;color:var(--rp-text-light);padding-left:16px;position:relative;margin-bottom:8px;}
.rp-card li:last-child{margin-bottom:0;}
.rp-card li::before{content:'';position:absolute;left:0;top:8px;width:5px;height:5px;border-radius:50%;background:var(--rp-green);}
.rp-card strong{color:var(--rp-text);}

/* ============================================================
   HOW TO RETURN - steps (numerals only, unchanged style)
   ============================================================ */
.rp-steps{padding:56px 0;background:#fff;}
.rp-steps-head{margin-bottom:28px;}
.rp-steps-row{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.rp-step{background:#fff;border:1.5px solid var(--rp-border);border-radius:12px;padding:22px;position:relative;}
.rp-step-num{
  font-family:var(--rp-font-head);font-weight:700;font-size:.9rem;color:var(--rp-navy);
  margin-bottom:12px;
}
.rp-step-title{font-family:var(--rp-font-head);font-weight:700;font-size:.86rem;color:var(--rp-text);text-transform:uppercase;margin-bottom:6px;}
.rp-step-desc{font-size:.8rem;color:var(--rp-text-light);line-height:1.6;}

/* ============================================================
   CTA STRIP - no icon box
   ============================================================ */
.rp-cta-wrap{padding:0 0 60px;background:#fff;}
.rp-cta{
  background:var(--rp-blue-dark);border-radius:14px;
  padding:26px 32px;display:flex;align-items:center;justify-content:space-between;gap:24px;flex-wrap:wrap;
}
.rp-cta-title{font-family:var(--rp-font-head);font-weight:700;color:#fff;font-size:1.02rem;text-transform:uppercase;margin-bottom:3px;}
.rp-cta-sub{font-size:.8rem;color:rgba(255,255,255,.7);max-width:420px;}
.rp-cta-btns{display:flex;gap:10px;flex-wrap:wrap;}
.rp-btn{
  display:inline-flex;align-items:center;gap:8px;padding:12px 22px;border-radius:6px;
  font-family:var(--rp-font-head);font-weight:600;font-size:.8rem;text-transform:uppercase;letter-spacing:.03em;
  text-decoration:none;white-space:nowrap;transition:background .18s,transform .18s,border-color .18s;
}
.rp-btn-solid{background:var(--rp-green-dark);color:#fff;}
.rp-btn-solid:hover{background:#5b8e26;transform:translateY(-2px);}
.rp-btn-ghost{background:transparent;color:#fff;border:1.5px solid rgba(255,255,255,.35);}
.rp-btn-ghost:hover{border-color:var(--rp-green);color:var(--rp-green);transform:translateY(-2px);}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:900px){
  :root{--rp-px:16px;}
}
@media(max-width:1000px){
  .rp-hero{padding:52px 0 46px;}
  .rp-hero::before{
    background:linear-gradient(180deg,
      #ffffff 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.5) 72%,
      rgba(255,255,255,.15) 100%
    );
  }
  .rp-hero-text{max-width:100%;}
  .rp-trust{grid-template-columns:1fr 1fr;}
  .rp-cond-grid{grid-template-columns:1fr;gap:30px;}
  .rp-card-grid{grid-template-columns:1fr;}
  .rp-steps-row{grid-template-columns:1fr 1fr;}
}
@media(max-width:640px){
  .rp-hero{
    padding:32px 0 28px;
    background-image:none;
  }
  .rp-hero::before{display:none;}
  .rp-hero-media-box{
    border-radius:14px;overflow:hidden;position:relative;
    border:1px solid var(--rp-border);
    box-shadow:0 14px 32px rgba(14,35,88,.12);
    background-image:url('<?php echo esc_url( $rp_hero_bg ); ?>');
    background-size:cover;
    background-position:65% center;
    background-repeat:no-repeat;
    min-height:280px;
    display:flex;
    align-items:center;
    padding:22px;
  }
  .rp-hero-media-box::before{
    content:'';
    position:absolute;inset:0;
    background:linear-gradient(90deg,
      rgba(255,255,255,.97) 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.4) 68%,
      rgba(255,255,255,0) 88%
    );
  }
  .rp-hero-media-box .rp-hero-text{position:relative;z-index:1;max-width:100%;}
  .rp-trust{margin-top:22px;}
  .rp-hero-desc{font-size:.86rem;}
  .rp-trust{grid-template-columns:1fr;padding:20px;gap:18px;}
  .rp-conditions,.rp-delivery,.rp-steps{padding:38px 0;}
  .rp-steps-row{grid-template-columns:1fr;}
  .rp-cta{flex-direction:column;align-items:flex-start;padding:22px;}
  .rp-cta-btns{width:100%;flex-direction:column;}
  .rp-btn{width:100%;justify-content:center;}
}
</style>

<div class="rp-page">

  <!-- HERO -->
  <section class="rp-hero">
    <div class="rp-wrap">
      <div class="rp-hero-media-box">
        <div class="rp-hero-text">
          <div class="rp-eyebrow">Return Policy</div>
          <h1 class="rp-hero-title">Your Satisfaction,<span>Our Priority</span></h1>
          <p class="rp-hero-desc">At Leshavin Pharmacy, we're committed to making sure you're happy with every order. If something isn't right, our team is here to make it right, quickly and fairly.</p>
        </div>
      </div>

      <div class="rp-trust">
        <div class="rp-trust-item">
          <div class="rp-trust-title">Easy Returns</div>
          <div class="rp-trust-sub">Simple, hassle-free process</div>
        </div>
        <div class="rp-trust-item">
          <div class="rp-trust-title">Quality Assured</div>
          <div class="rp-trust-sub">Safe, genuine products</div>
        </div>
        <div class="rp-trust-item">
          <div class="rp-trust-title">Timely Support</div>
          <div class="rp-trust-sub">Always ready to assist</div>
        </div>
        <div class="rp-trust-item">
          <div class="rp-trust-title">Customer First</div>
          <div class="rp-trust-sub">Your satisfaction matters</div>
        </div>
      </div>
    </div>
  </section>

  <!-- RETURN CONDITIONS / NON-RETURNABLE -->
  <section class="rp-conditions">
    <div class="rp-wrap rp-cond-grid">

      <div>
        <h2 class="rp-sec-title">When We'll Accept a Return</h2>
        <p style="font-size:.86rem;color:var(--rp-text-light);margin:0 0 18px;">A return will typically go through if it meets these points:</p>
        <ul class="rp-list yes">
          <li>
            <div class="rp-list-num">1</div>
            <div><div class="rp-list-title">Something went wrong on our end</div><div class="rp-list-sub">Wrong item, damaged item, or a fault you noticed on opening it. Flag it within 48 hours of it reaching you.</div></div>
          </li>
          <li>
            <div class="rp-list-num">2</div>
            <div><div class="rp-list-title">The item hasn't been opened or used</div><div class="rp-list-sub">Packaging, seals and labels need to be exactly as they arrived.</div></div>
          </li>
          <li>
            <div class="rp-list-num">3</div>
            <div><div class="rp-list-title">You can point us to the order</div><div class="rp-list-sub">An order number, receipt or WhatsApp confirmation is enough.</div></div>
          </li>
          <li>
            <div class="rp-list-num">4</div>
            <div><div class="rp-list-title">You get in touch within 7 working days</div><div class="rp-list-sub">Delivery date counts as day one.</div></div>
          </li>
        </ul>

        <div class="rp-note"><strong>Worth noting:</strong> medicines, toiletries and similar items that touch the body directly can only be returned if they're faulty or if we sent the wrong one, not simply because a seal was broken.</div>
      </div>

      <div>
        <h2 class="rp-sec-title">What Can't Be Returned</h2>
        <p style="font-size:.86rem;color:var(--rp-text-light);margin:0 0 18px;">A few categories fall outside our return process:</p>
        <ul class="rp-list no">
          <li>
            <div class="rp-list-num">1</div>
            <div><div class="rp-list-title">Items that needed refrigeration</div><div class="rp-list-sub">Once cold-chain products leave storage, we can no longer vouch for their condition.</div></div>
          </li>
          <li>
            <div class="rp-list-num">2</div>
            <div><div class="rp-list-title">Products that have been opened or handled</div><div class="rp-list-sub">A broken seal or missing label takes it out of scope.</div></div>
          </li>
          <li>
            <div class="rp-list-num">3</div>
            <div><div class="rp-list-title">A change of mind after checkout</div><div class="rp-list-sub">Worth a second look at your order before you confirm it.</div></div>
          </li>
          <li>
            <div class="rp-list-num">4</div>
            <div><div class="rp-list-title">Requests raised after the 7-day mark</div><div class="rp-list-sub">Unless you'd already flagged the issue with us before then.</div></div>
          </li>
        </ul>

        <div class="rp-help">
          <div class="rp-help-title">Not Sure Where You Stand?</div>
          <div class="rp-help-desc">Message our team with your order details and we'll tell you straight away whether a return applies.</div>
          <div class="rp-help-line">
            <a href="tel:+<?php echo esc_attr( $rp_wa ); ?>"><?php echo esc_html( $rp_phone ); ?></a>
            <a href="mailto:<?php echo esc_attr( $rp_email ); ?>"><?php echo esc_html( $rp_email ); ?></a>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- DELIVERY & PAYMENT -->
  <section class="rp-delivery">
    <div class="rp-wrap">
      <div class="rp-delivery-head">
        <div class="rp-eyebrow">Delivery &amp; Payment</div>
        <h2 class="rp-sec-title">How Delivery &amp; Payment Work</h2>
      </div>

      <div class="rp-card-grid">
        <div class="rp-card">
          <div class="rp-card-title"><span class="rp-card-num">1</span>Paying for Your Order</div>
          <ul>
            <li>Pay-on-delivery works for addresses within Nairobi and nearby areas</li>
            <li>Orders further out are settled before dispatch</li>
            <li>We take M-Pesa, bank transfer, cash on delivery, or Visa card</li>
            <li>Credit terms only apply where we've agreed to them in writing beforehand</li>
          </ul>
        </div>

        <div class="rp-card">
          <div class="rp-card-title"><span class="rp-card-num">2</span>When Your Order Arrives</div>
          <ul>
            <li>Expect a rough delivery window shared with you ahead of dispatch</li>
            <li>Have your payment and someone available to receive the parcel at that time</li>
            <li>Riders will call or message shortly before they arrive</li>
          </ul>
        </div>

        <div class="rp-card">
          <div class="rp-card-title"><span class="rp-card-num">3</span>How Long a Rider Waits</div>
          <ul>
            <li>Around <strong>15 minutes</strong> is the standard wait once a rider is at your location</li>
            <li>This can extend to <strong>20 minutes</strong> if you're close by and responding on WhatsApp</li>
          </ul>
        </div>

        <div class="rp-card">
          <div class="rp-card-title"><span class="rp-card-num">4</span>Missed the Delivery?</div>
          <ul>
            <li>The rider carries on to their next stop and your parcel is queued for another attempt</li>
            <li>A modest re-delivery fee may apply on the next attempt</li>
            <li>Message us to pick a better time slot for the retry</li>
          </ul>
        </div>
      </div>

      <div class="rp-note" style="margin-top:20px;">
        <strong>Getting your money back:</strong> once a returned item lands back with us, our team looks it over before signing off on the refund. Approved amounts go back through whichever method you paid with, usually landing within <strong>3 working days</strong>.<br><br>
        <strong>Repeated missed deliveries:</strong> if an order can't be completed more than once because nobody was reachable or payment wasn't sorted, future orders on that account may need to be paid for upfront instead of on delivery.
      </div>
    </div>
  </section>

  <!-- HOW TO RETURN -->
  <section class="rp-steps">
    <div class="rp-wrap">
      <div class="rp-steps-head">
        <div class="rp-eyebrow">Simple Process</div>
        <h2 class="rp-sec-title">How to Return an Item</h2>
      </div>
      <div class="rp-steps-row">
        <div class="rp-step">
          <div class="rp-step-num">01</div>
          <div class="rp-step-title">Contact Us</div>
          <div class="rp-step-desc">Reach out to our support team within 48 hours of delivery.</div>
        </div>
        <div class="rp-step">
          <div class="rp-step-num">02</div>
          <div class="rp-step-title">Provide Details</div>
          <div class="rp-step-desc">Share your order ID, reason for return, and product details.</div>
        </div>
        <div class="rp-step">
          <div class="rp-step-num">03</div>
          <div class="rp-step-title">Return the Item</div>
          <div class="rp-step-desc">Follow the instructions provided to return the item to us.</div>
        </div>
        <div class="rp-step">
          <div class="rp-step-num">04</div>
          <div class="rp-step-title">Refund / Replacement</div>
          <div class="rp-step-desc">Once approved, we'll process your refund or replacement.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <div class="rp-cta-wrap">
    <div class="rp-wrap">
      <div class="rp-cta">
        <div>
          <div class="rp-cta-title">We're Here to Make It Right</div>
          <div class="rp-cta-sub">Your trust means everything to us. We're committed to quality products and excellent service every time.</div>
        </div>
        <div class="rp-cta-btns">
          <a href="https://wa.me/<?php echo esc_attr( $rp_wa ); ?>?text=<?php echo urlencode('Hello Leshavin Pharmacy! I have a question about the Return Policy.'); ?>" class="rp-btn rp-btn-solid" target="_blank" rel="noopener noreferrer">
            WhatsApp Us
          </a>
          <a href="<?php echo esc_url( home_url('/terms') ); ?>" class="rp-btn rp-btn-ghost">Terms &amp; Conditions</a>
          <a href="<?php echo esc_url( home_url('/contact') ); ?>" class="rp-btn rp-btn-ghost">Contact Us</a>
        </div>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>