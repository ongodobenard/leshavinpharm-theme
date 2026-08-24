<?php
/**
 * Template Name: Contact
 * Leshavin Pharmacy - page-contact.php
 */
get_header();

$lc_wa       = leshavin_phone();
$lc_phone    = leshavin_phone_display();
$lc_email    = leshavin_email();
$lc_addr     = function_exists('leshavin_location') ? leshavin_location() : 'Nairobi, Kenya';
$lc_hero_bg  = get_template_directory_uri() . '/assets/js/images/contactbg.png';
$lc_map_src  = 'https://www.google.com/maps?q=' . rawurlencode( $lc_addr ) . '&output=embed';
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --lc-navy:#0e2358;
  --lc-blue:#1c75bc;
  --lc-blue-dark:#125a94;
  --lc-green:#8dc63f;
  --lc-green-dark:#6ea82e;
  --lc-text:#1c2b3a;
  --lc-text-light:#6b7c8f;
  --lc-border:#e4e9ef;
  --lc-bg-soft:#f7f9fb;
  --lc-hero-bg:#eaf0fb;
  --lc-font-head:'Oswald',Arial Narrow,sans-serif;
  --lc-font-body:'Inter',sans-serif;
  --lc-px:40px;
}
.lc-page{font-family:var(--lc-font-body);color:var(--lc-text);overflow-x:hidden;}
.lc-wrap{max-width:1280px;margin:0 auto;padding:0 var(--lc-px);}

/* ============================================================
   HERO
   ============================================================ */
.lc-hero{
  position:relative;
  background:var(--lc-hero-bg);
  padding:64px 0 170px;
  overflow:hidden;
}
.lc-hero-inner{
  display:grid;
  grid-template-columns:1fr 1fr;
  align-items:center;
  gap:30px;
  position:relative;
  z-index:2;
}
.lc-hero-title{
  font-family:var(--lc-font-head);font-weight:700;text-transform:uppercase;
  color:var(--lc-navy);font-size:clamp(2rem,4.6vw,3.1rem);line-height:1.1;margin:0 0 14px;
}
.lc-title-accent{
  display:flex;align-items:center;gap:6px;margin-bottom:20px;
}
.lc-title-accent::before{content:'';width:46px;height:5px;border-radius:4px;background:var(--lc-green);}
.lc-title-accent::after{content:'';width:5px;height:5px;border-radius:50%;background:var(--lc-green);}
.lc-hero-desc{font-size:.98rem;line-height:1.8;color:var(--lc-text-light);max-width:480px;}

.lc-hero-media{
  position:relative;
  border-radius:20px;
  overflow:hidden;
  min-height:300px;
  background-image:url('<?php echo esc_url( $lc_hero_bg ); ?>');
  background-size:cover;
  background-position:center;
  display:flex;
  align-items:center;
  justify-content:center;
}
.lc-hero-media::before{
  content:'';
  position:absolute;inset:0;
  background:rgba(255,255,255,.35);
}
.lc-hero-badge{
  position:relative;z-index:2;
  width:120px;height:120px;
  border-radius:50%;
  background:rgba(255,255,255,.9);
  border:2px solid var(--lc-blue);
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 16px 34px rgba(14,35,88,.14);
}
.lc-hero-badge svg{width:52px;height:52px;color:var(--lc-blue);}

/* decorative soft wave at hero base */
.lc-hero-wave{
  position:absolute;left:0;right:0;bottom:0;height:90px;z-index:1;
  background:#fff;
  border-radius:100% 100% 0 0/70px 70px 0 0;
  opacity:.6;
}

/* ============================================================
   INFO + FORM SECTION (form card overlaps hero)
   ============================================================ */
.lc-body{
  position:relative;
  background:#fff;
  padding-bottom:56px;
}
.lc-body-grid{
  display:grid;
  grid-template-columns:1fr 1.15fr;
  gap:28px;
  align-items:start;
  margin-top:-120px;
  position:relative;
  z-index:3;
}

/* info cards 2x2 */
.lc-info-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:16px;
  margin-top:120px;
}
.lc-info-card{
  background:#fff;
  border:1.5px solid var(--lc-border);
  border-radius:14px;
  padding:20px;
  box-shadow:0 10px 26px rgba(14,35,88,.06);
  display:flex;
  gap:12px;
  align-items:flex-start;
}
.lc-info-icon{
  width:42px;height:42px;border-radius:12px;background:var(--lc-bg-soft);border:1.5px solid var(--lc-border);
  display:flex;align-items:center;justify-content:center;color:var(--lc-blue-dark);flex-shrink:0;
}
.lc-info-icon svg{width:19px;height:19px;}
.lc-info-label{font-size:.78rem;color:var(--lc-text-light);margin-bottom:3px;}
.lc-info-value{font-family:var(--lc-font-head);font-weight:700;font-size:.94rem;color:var(--lc-navy);line-height:1.4;word-break:break-word;}
.lc-info-sub{font-size:.78rem;color:var(--lc-text-light);margin-top:3px;line-height:1.5;}
.lc-info-value a{color:var(--lc-navy);text-decoration:none;}
.lc-info-value a:hover{color:var(--lc-green-dark);}

/* form card */
.lc-form-card{
  background:#fff;
  border-radius:16px;
  padding:32px;
  box-shadow:0 20px 48px rgba(14,35,88,.16);
  border:1.5px solid var(--lc-border);
}
.lc-form-title{
  font-family:var(--lc-font-head);font-weight:700;text-transform:uppercase;color:var(--lc-navy);
  font-size:1.2rem;margin:0 0 20px;
}
.lc-form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
.lc-fg{position:relative;margin-bottom:14px;min-width:0;}
.lc-fg input,.lc-fg select,.lc-fg textarea{
  width:100%;padding:13px 15px;border:1.5px solid var(--lc-border);border-radius:8px;
  font-size:.88rem;font-family:var(--lc-font-body);color:var(--lc-text);outline:none;
  transition:border-color .2s,box-shadow .2s;background:#fff;
}
.lc-fg input:focus,.lc-fg select:focus,.lc-fg textarea:focus{
  border-color:var(--lc-blue);box-shadow:0 0 0 3px rgba(28,117,188,.10);
}
.lc-fg.invalid input,.lc-fg.invalid select,.lc-fg.invalid textarea{
  border-color:#c0392b !important;box-shadow:0 0 0 3px rgba(192,57,43,.10) !important;
}
.lc-fg .lc-err{font-size:.72rem;color:#c0392b;font-weight:600;margin-top:5px;display:none;}
.lc-fg.invalid .lc-err{display:block;}
.lc-fg.valid input,.lc-fg.valid select,.lc-fg.valid textarea{border-color:var(--lc-green-dark) !important;}
.lc-fg textarea{min-height:120px;resize:vertical;}

.lc-submit-btn{
  width:100%;padding:14px;background:var(--lc-green-dark);color:#fff;border:none;border-radius:8px;
  font-family:var(--lc-font-head);font-weight:600;font-size:.92rem;text-transform:uppercase;letter-spacing:.03em;
  cursor:pointer;transition:background .2s,transform .15s;
  display:flex;align-items:center;justify-content:center;gap:8px;
}
.lc-submit-btn:hover{background:#5b8e26;transform:translateY(-1px);}
.lc-submit-btn:disabled{opacity:.65;cursor:default;transform:none;}
.lc-submit-btn svg{width:16px;height:16px;}

.lc-toast{
  display:flex;gap:9px;align-items:flex-start;border-radius:10px;font-size:.82rem;font-weight:600;
  line-height:1.6;border:1.5px solid transparent;opacity:0;max-height:0;overflow:hidden;padding:0 16px;
  pointer-events:none;transition:opacity .3s ease,max-height .4s ease,padding .4s ease,margin-top .4s ease;
}
.lc-toast.show{opacity:1;max-height:220px;padding:14px 16px;margin-top:14px;pointer-events:auto;}
.lc-toast svg{flex-shrink:0;margin-top:1px;}
.lc-toast-success{background:#f2f9e9;color:#4c7a1f;border-color:var(--lc-green);}
.lc-toast-error{background:#fbeceb;color:#8f2c22;border-color:#e8b6b0;}

/* ============================================================
   MAP
   ============================================================ */
.lc-map-section{background:var(--lc-bg-soft);padding:50px 0 60px;}
.lc-map-head{margin-bottom:20px;}
.lc-map-frame{
  border-radius:16px;overflow:hidden;border:1.5px solid var(--lc-border);
  box-shadow:0 14px 32px rgba(14,35,88,.08);height:380px;
}
.lc-map-frame iframe{width:100%;height:100%;border:0;display:block;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:1050px){
  .lc-body-grid{grid-template-columns:1fr;margin-top:-90px;}
  .lc-info-grid{margin-top:0;}
  .lc-form-card{order:-1;margin-top:90px;}
}
@media(max-width:900px){
  :root{--lc-px:16px;}
}
@media(max-width:860px){
  .lc-hero-inner{grid-template-columns:1fr;text-align:center;}
  .lc-hero-desc{margin:0 auto;}
  .lc-title-accent{justify-content:center;}
  .lc-hero-media{min-height:220px;}
}
@media(max-width:640px){
  .lc-hero{padding:40px 0 130px;}
  .lc-hero-title{font-size:2rem;}
  .lc-form-card{padding:22px;}
  .lc-form-row{grid-template-columns:1fr;}
  .lc-info-grid{grid-template-columns:1fr;}
  .lc-body-grid{margin-top:-100px;}
  .lc-form-card{margin-top:100px;}
  .lc-map-frame{height:280px;}
}
</style>

<div class="lc-page">

  <!-- HERO -->
  <section class="lc-hero">
    <div class="lc-wrap lc-hero-inner">
      <div>
        <h1 class="lc-hero-title">Contact Us</h1>
        <div class="lc-title-accent"></div>
        <p class="lc-hero-desc">We're here to help! Reach out to us for any questions, support or feedback. Our team will get back to you as soon as possible.</p>
      </div>
      <div class="lc-hero-media">
        <div class="lc-hero-badge">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l8 3v6c0 5.5-3.5 9.7-8 11-4.5-1.3-8-5.5-8-11V5l8-3z"/><line x1="12" y1="8" x2="12" y2="14"/><line x1="9" y1="11" x2="15" y2="11"/></svg>
        </div>
      </div>
    </div>
    <div class="lc-hero-wave"></div>
  </section>

  <!-- INFO + FORM -->
  <section class="lc-body">
    <div class="lc-wrap lc-body-grid">

      <!-- INFO CARDS -->
      <div class="lc-info-grid">
        <div class="lc-info-card">
          <div class="lc-info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg></div>
          <div>
            <div class="lc-info-label">Phone / WhatsApp</div>
            <div class="lc-info-value"><a href="tel:+<?php echo esc_attr( $lc_wa ); ?>"><?php echo esc_html( $lc_phone ); ?></a></div>
            <div class="lc-info-sub">Mon - Sat: 8:00 AM - 8:00 PM</div>
          </div>
        </div>

        <div class="lc-info-card">
          <div class="lc-info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
          <div>
            <div class="lc-info-label">Email Us</div>
            <div class="lc-info-value"><a href="mailto:<?php echo esc_attr( $lc_email ); ?>"><?php echo esc_html( $lc_email ); ?></a></div>
            <div class="lc-info-sub">We reply within 24 hours</div>
          </div>
        </div>

        <div class="lc-info-card">
          <div class="lc-info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div>
            <div class="lc-info-label">Our Location</div>
            <div class="lc-info-value"><?php echo esc_html( $lc_addr ); ?></div>
            <div class="lc-info-sub">We serve all across Kenya</div>
          </div>
        </div>

        <div class="lc-info-card">
          <div class="lc-info-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div>
          <div>
            <div class="lc-info-label">Business Hours</div>
            <div class="lc-info-value">Mon - Sat: 8:00 AM - 8:00 PM</div>
            <div class="lc-info-sub">Sunday: 9:00 AM - 5:00 PM</div>
          </div>
        </div>
      </div>

      <!-- FORM -->
      <div class="lc-form-card">
        <div class="lc-form-title">Send Us a Message</div>
        <form data-lcform="contact" method="post" novalidate>
          <?php wp_nonce_field( 'leshavin_nonce', 'nonce' ); ?>
          <input type="hidden" name="action" value="leshavin_contact">

          <div class="lc-form-row">
            <div class="lc-fg" id="lc-fg-name">
              <input type="text" id="lc_name" name="contact_name" placeholder="Your Name">
              <div class="lc-err">Please enter your name</div>
            </div>
            <div class="lc-fg" id="lc-fg-email">
              <input type="email" id="lc_email" name="contact_email" placeholder="Your Email">
              <div class="lc-err">Please enter a valid email</div>
            </div>
          </div>

          <div class="lc-form-row">
            <div class="lc-fg" id="lc-fg-phone">
              <input type="tel" id="lc_phone" name="contact_phone" placeholder="Phone Number">
              <div class="lc-err">Please enter your phone number</div>
            </div>
            <div class="lc-fg" id="lc-fg-subject">
              <select id="lc_subject" name="contact_subject">
                <option value="">Select Subject</option>
                <option value="Order Enquiry">Order Enquiry</option>
                <option value="Prescription">Prescription</option>
                <option value="Delivery">Delivery</option>
                <option value="Feedback">Feedback</option>
                <option value="Other">Other</option>
              </select>
              <div class="lc-err">Please select a subject</div>
            </div>
          </div>

          <div class="lc-fg" id="lc-fg-msg">
            <textarea id="lc_msg" name="contact_msg" placeholder="Your Message"></textarea>
            <div class="lc-err">Please enter your message (min 5 characters)</div>
          </div>

          <button type="button" class="lc-submit-btn" id="lcSubmitBtn">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
            Send Message
          </button>

          <div class="lc-toast lc-toast-success" id="lcSuccess" role="alert" aria-live="polite">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            <span>Thanks for reaching out to Leshavin Pharmacy! Our team will get back to you shortly. For urgent matters, WhatsApp us on <a href="https://wa.me/<?php echo esc_attr( $lc_wa ); ?>" style="color:inherit;text-decoration:underline;font-weight:800;" target="_blank" rel="noopener"><?php echo esc_html( $lc_phone ); ?></a>.</span>
          </div>

          <div class="lc-toast lc-toast-error" id="lcError" role="alert" aria-live="polite">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12" y2="16"/></svg>
            <span id="lcErrorText"></span>
          </div>
        </form>
      </div>

    </div>
  </section>

  <!-- MAP -->
  <section class="lc-map-section">
    <div class="lc-wrap">
      <div class="lc-map-head">
        <h2 class="lc-form-title" style="margin-bottom:4px;">Find Us Here</h2>
        <p style="font-size:.85rem;color:var(--lc-text-light);margin:0;">Serving customers across Kenya with fast, reliable delivery.</p>
      </div>
      <div class="lc-map-frame">
        <iframe
          src="<?php echo esc_url( $lc_map_src ); ?>"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Leshavin Pharmacy Location">
        </iframe>
      </div>
    </div>
  </section>

</div>

<script>
window.addEventListener('load', function () {

  var form = document.querySelector('[data-lcform="contact"]');
  if (!form) return;

  var fresh = form.cloneNode(true);
  form.parentNode.replaceChild(fresh, form);
  form = fresh;

  var successEl = document.getElementById('lcSuccess');
  var errorEl   = document.getElementById('lcError');
  var errorText = document.getElementById('lcErrorText');
  var btn       = document.getElementById('lcSubmitBtn');
  var btnLabel  = 'Send Message';
  var toastTimer = null, isSending = false;

  var fields = [
    { id:'lc-fg-name',    input:'lc_name',    check:function(v){ return v.trim().length >= 2; } },
    { id:'lc-fg-email',   input:'lc_email',   check:function(v){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()); } },
    { id:'lc-fg-phone',   input:'lc_phone',   check:function(v){ return v.trim().replace(/\s/g,'').length >= 9; } },
    { id:'lc-fg-subject', input:'lc_subject', check:function(v){ return v !== ''; } },
    { id:'lc-fg-msg',     input:'lc_msg',     check:function(v){ return v.trim().length >= 5; } }
  ];

  function showToast(el, ms) {
    clearTimeout(toastTimer);
    successEl.classList.remove('show');
    errorEl.classList.remove('show');
    el.classList.add('show');
    toastTimer = setTimeout(function(){ el.classList.remove('show'); }, ms || 6000);
  }
  function setLoading(state) {
    isSending = state;
    btn.disabled = state;
    btn.lastChild.textContent = state ? ' Sending…' : ' ' + btnLabel;
  }
  function validateField(f, el, fg) {
    var pass = f.check(el.value);
    fg.classList.toggle('valid', pass);
    fg.classList.toggle('invalid', !pass);
    return pass;
  }
  function validateAll() {
    var ok = true;
    fields.forEach(function(f){
      var el = document.getElementById(f.input), fg = document.getElementById(f.id);
      if (el && fg && !validateField(f, el, fg)) ok = false;
    });
    return ok;
  }
  function resetForm() {
    setLoading(false);
    form.reset();
    fields.forEach(function(f){
      var fg = document.getElementById(f.id);
      if (fg) fg.classList.remove('valid', 'invalid');
    });
  }

  fields.forEach(function(f){
    var el = document.getElementById(f.input), fg = document.getElementById(f.id);
    if (!el || !fg) return;
    el.addEventListener('blur',   function(){ if (!isSending) validateField(f, el, fg); });
    el.addEventListener('input',  function(){ if (!isSending && fg.classList.contains('invalid')) validateField(f, el, fg); });
    el.addEventListener('change', function(){ if (!isSending && fg.classList.contains('invalid')) validateField(f, el, fg); });
  });

  btn.addEventListener('click', function () {
    if (isSending) return;
    if (!validateAll()) {
      var first = form.querySelector('.lc-fg.invalid');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }
    setLoading(true);
    var formData = new FormData(form);
    fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', { method: 'POST', body: formData })
      .then(function(r){ return r.text(); })
      .then(function(raw){
        var clean = raw.trim();
        var s = clean.indexOf('{');
        if (s > 0) clean = clean.substring(s);
        var data;
        try { data = JSON.parse(clean); }
        catch (e) {
          setLoading(false);
          errorText.textContent = 'Server error. Please contact us via WhatsApp on <?php echo esc_js( $lc_phone ); ?>.';
          showToast(errorEl, 8000);
          return;
        }
        if (data.success) {
          resetForm();
          showToast(successEl, 7000);
        } else {
          setLoading(false);
          errorText.textContent = (data.data && data.data.msg) ? data.data.msg : 'Message delivery failed. Please contact us via WhatsApp on <?php echo esc_js( $lc_phone ); ?>.';
          showToast(errorEl, 7000);
        }
      })
      .catch(function(){
        setLoading(false);
        errorText.textContent = 'Network error. Please check your connection and try again.';
        showToast(errorEl, 7000);
      });
  });

});
</script>

<?php get_footer(); ?>