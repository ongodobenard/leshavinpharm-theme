<?php
/**
 * Template Name: Submit Prescription
 * Leshavin Pharmacy - page-prescription.php
 */
get_header();

$rxp_wa      = leshavin_phone();
$rxp_phone   = leshavin_phone_display();
$rxp_email   = leshavin_email();
$rxp_hero_bg = get_template_directory_uri() . '/assets/js/images/prescriptionbg.png';
?>

<style>
*, *::before, *::after { box-sizing: border-box; }

:root{
  --rxp-navy:#0e2358;
  --rxp-blue:#1c75bc;
  --rxp-blue-dark:#125a94;
  --rxp-green:#8dc63f;
  --rxp-green-dark:#6ea82e;
  --rxp-green-pale:#f2f9e9;
  --rxp-red:#c0392b;
  --rxp-text:#1c2b3a;
  --rxp-text-light:#6b7c8f;
  --rxp-border:#e4e9ef;
  --rxp-bg-soft:#f7f9fb;
  --rxp-font-head:'Oswald',Arial Narrow,sans-serif;
  --rxp-font-body:'Inter',sans-serif;
  --rxp-px:40px;
}
.rxp-page{font-family:var(--rxp-font-body);color:var(--rxp-text);overflow-x:hidden;}
.rxp-wrap{max-width:1280px;margin:0 auto;padding:0 var(--rxp-px);}

.rxp-eyebrow{
  display:inline-flex;align-items:center;gap:10px;
  font-family:var(--rxp-font-head);font-size:.74rem;font-weight:600;
  letter-spacing:.14em;text-transform:uppercase;color:var(--rxp-green-dark);
  margin-bottom:12px;
}
.rxp-eyebrow::before{content:'';width:26px;height:2px;background:var(--rxp-green);flex-shrink:0;}

/* ============================================================
   HERO - full-bleed background image with overlaid copy
   ============================================================ */
.rxp-hero{
  position:relative;
  padding:70px 0 64px;
  overflow:hidden;
  background-image:url('<?php echo esc_url( $rxp_hero_bg ); ?>');
  background-size:cover;
  background-position:center right;
  background-repeat:no-repeat;
}
.rxp-hero::before{
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
.rxp-hero .rxp-wrap{position:relative;z-index:2;}

.rxp-hero-media-box{position:relative;}
.rxp-hero-text{max-width:560px;width:100%;}
.rxp-hero-title{
  font-family:var(--rxp-font-head);font-weight:700;text-transform:uppercase;
  color:var(--rxp-navy);font-size:clamp(1.6rem,4vw,2.9rem);line-height:1.15;margin:0 0 12px;
  overflow-wrap:break-word;word-break:break-word;max-width:100%;
}
.rxp-hero-desc{font-size:.95rem;line-height:1.75;color:var(--rxp-text-light);max-width:480px;overflow-wrap:break-word;}

/* ============================================================
   UPLOAD + DETAILS
   ============================================================ */
.rxp-forms{padding:56px 0 0;background:#fff;}
.rxp-forms-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  align-items:start;
}
.rxp-card{
  background:#fff;
  border:1.5px solid var(--rxp-border);
  border-radius:16px;
  padding:28px;
  box-shadow:0 10px 26px rgba(14,35,88,.05);
}
.rxp-card-title{
  font-family:var(--rxp-font-head);font-weight:700;text-transform:uppercase;
  color:var(--rxp-navy);font-size:1.1rem;margin:0 0 18px;
}

/* Upload dropzone - no icon */
.rxp-dropzone{
  border:1.5px dashed #c7d2e8;
  border-radius:12px;
  padding:34px 20px;
  text-align:center;
  cursor:pointer;
  transition:border-color .2s,background .2s;
}
.rxp-dropzone.dragover,
.rxp-dropzone:hover{border-color:var(--rxp-blue);background:var(--rxp-bg-soft);}
.rxp-dropzone input[type="file"]{display:none;}
.rxp-drop-title{font-family:var(--rxp-font-head);font-weight:700;font-size:.95rem;color:var(--rxp-navy);margin-bottom:4px;}
.rxp-drop-sub{font-size:.8rem;color:var(--rxp-text-light);margin-bottom:14px;}
.rxp-choose-btn{
  display:inline-block;padding:10px 22px;background:var(--rxp-navy);color:#fff;border:none;border-radius:7px;
  font-family:var(--rxp-font-head);font-weight:600;font-size:.8rem;text-transform:uppercase;letter-spacing:.02em;
  cursor:pointer;transition:background .2s;
}
.rxp-choose-btn:hover{background:var(--rxp-blue-dark);}
.rxp-drop-hint{font-size:.72rem;color:var(--rxp-text-light);margin-top:14px;}
.rxp-filename{font-size:.78rem;color:var(--rxp-blue-dark);font-weight:700;margin-top:10px;word-break:break-word;}

.rxp-fg.invalid .rxp-dropzone{border-color:var(--rxp-red);}
.rxp-err{font-size:.72rem;color:var(--rxp-red);font-weight:600;margin-top:8px;display:none;}
.rxp-fg.invalid .rxp-err{display:block;}

.rxp-privacy{
  background:var(--rxp-bg-soft);border:1.5px solid var(--rxp-border);border-left:4px solid var(--rxp-green);
  border-radius:8px;padding:16px 18px;margin-top:18px;
}
.rxp-privacy-title{font-size:.82rem;font-weight:700;color:var(--rxp-text);margin-bottom:2px;}
.rxp-privacy-sub{font-size:.78rem;color:var(--rxp-text-light);line-height:1.6;}

/* Details form */
.rxp-fg{margin-bottom:16px;min-width:0;}
.rxp-fg label{display:block;font-size:.82rem;font-weight:700;color:var(--rxp-text);margin-bottom:6px;}
.rxp-fg .rxp-opt{font-weight:500;color:var(--rxp-text-light);}
.rxp-fg input,.rxp-fg textarea{
  width:100%;padding:12px 14px;border:1.5px solid var(--rxp-border);border-radius:8px;
  font-size:.86rem;font-family:var(--rxp-font-body);color:var(--rxp-text);outline:none;
  transition:border-color .2s,box-shadow .2s;background:#fff;
}
.rxp-fg input:focus,.rxp-fg textarea:focus{border-color:var(--rxp-blue);box-shadow:0 0 0 3px rgba(28,117,188,.10);}
.rxp-fg.invalid input,.rxp-fg.invalid textarea{border-color:var(--rxp-red) !important;box-shadow:0 0 0 3px rgba(192,57,43,.10) !important;}
.rxp-fg.valid input,.rxp-fg.valid textarea{border-color:var(--rxp-green-dark) !important;}
.rxp-fg textarea{min-height:100px;resize:vertical;}

.rxp-submit-btn{
  width:100%;padding:14px;background:var(--rxp-green-dark);color:#fff;border:none;border-radius:8px;
  font-family:var(--rxp-font-head);font-weight:600;font-size:.9rem;text-transform:uppercase;letter-spacing:.03em;
  cursor:pointer;transition:background .2s,transform .15s;margin-top:4px;
}
.rxp-submit-btn:hover{background:#5b8e26;transform:translateY(-1px);}
.rxp-submit-btn:disabled{opacity:.65;cursor:default;transform:none;}

.rxp-toast{
  border-radius:10px;font-size:.82rem;font-weight:600;
  line-height:1.6;border:1.5px solid transparent;opacity:0;max-height:0;overflow:hidden;padding:0 16px;
  pointer-events:none;transition:opacity .3s ease,max-height .4s ease,padding .4s ease,margin-top .4s ease;
}
.rxp-toast.show{opacity:1;max-height:220px;padding:14px 16px;margin-top:14px;pointer-events:auto;}
.rxp-toast-success{background:var(--rxp-green-pale);color:#4c7a1f;border-color:var(--rxp-green);}
.rxp-toast-error{background:#fbeceb;color:#8f2c22;border-color:#e8b6b0;}

/* ============================================================
   WHAT HAPPENS NEXT strip - numbering only, no icons
   ============================================================ */
.rxp-next{padding:36px 0 56px;}
.rxp-next-strip{
  background:var(--rxp-green-pale);
  border:1.5px solid #d9ecc0;
  border-radius:16px;
  padding:22px 28px;
  display:flex;
  align-items:center;
  gap:28px;
  flex-wrap:wrap;
}
.rxp-next-lead{flex:1 1 260px;min-width:0;}
.rxp-next-title{font-family:var(--rxp-font-head);font-weight:700;font-size:.94rem;color:var(--rxp-navy);margin-bottom:3px;}
.rxp-next-sub{font-size:.78rem;color:var(--rxp-text-light);line-height:1.5;}

.rxp-next-steps{display:flex;gap:26px;flex-wrap:wrap;flex:2 1 500px;}
.rxp-next-step{display:flex;align-items:flex-start;gap:10px;min-width:150px;}
.rxp-next-step-num{
  width:26px;height:26px;border-radius:7px;background:var(--rxp-navy);color:#fff;flex-shrink:0;
  font-family:var(--rxp-font-head);font-weight:700;font-size:.75rem;
  display:flex;align-items:center;justify-content:center;
}
.rxp-next-step-title{font-family:var(--rxp-font-head);font-weight:700;font-size:.82rem;color:var(--rxp-text);margin-bottom:2px;}
.rxp-next-step-sub{font-size:.74rem;color:var(--rxp-text-light);line-height:1.5;}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:900px){
  :root{--rxp-px:16px;}
}
@media(max-width:1000px){
  .rxp-hero{padding:52px 0 46px;}
  .rxp-hero::before{
    background:linear-gradient(180deg,
      #ffffff 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.5) 72%,
      rgba(255,255,255,.15) 100%
    );
  }
  .rxp-hero-text{max-width:100%;}
  .rxp-forms-grid{grid-template-columns:1fr;}

  /* FIX: in column flex-direction, flex-basis controls HEIGHT not width.
     .rxp-next-steps was still carrying its desktop "flex:2 1 500px" basis,
     which reserved ~500px of vertical space and caused the huge gap. */
  .rxp-next-strip{flex-direction:column;align-items:stretch;}
  .rxp-next-lead,
  .rxp-next-steps{flex:0 0 auto;width:100%;}
}
@media(max-width:640px){
  .rxp-hero{
    padding:32px 0 28px;
    background-image:none;
  }
  .rxp-hero::before{display:none;}
  .rxp-hero-media-box{
    border-radius:14px;overflow:hidden;position:relative;
    border:1px solid var(--rxp-border);
    box-shadow:0 14px 32px rgba(14,35,88,.12);
    background-image:url('<?php echo esc_url( $rxp_hero_bg ); ?>');
    background-size:cover;
    background-position:65% center;
    background-repeat:no-repeat;
    min-height:280px;
    display:flex;
    align-items:center;
    padding:22px;
  }
  .rxp-hero-media-box::before{
    content:'';
    position:absolute;inset:0;
    background:linear-gradient(90deg,
      rgba(255,255,255,.97) 0%,
      rgba(255,255,255,.9) 40%,
      rgba(255,255,255,.4) 68%,
      rgba(255,255,255,0) 88%
    );
  }
  .rxp-hero-media-box .rxp-hero-text{position:relative;z-index:1;max-width:100%;}
  .rxp-hero-desc{font-size:.86rem;}
  .rxp-forms{padding:32px 0 0;}
  .rxp-card{padding:20px;}
  .rxp-next-steps{gap:18px;}
  .rxp-next-step{min-width:130px;}
}
</style>

<div class="rxp-page">

  <!-- HERO -->
  <section class="rxp-hero">
    <div class="rxp-wrap">
      <div class="rxp-hero-media-box">
        <div class="rxp-hero-text">
          <div class="rxp-eyebrow">Submit Prescription</div>
          <h1 class="rxp-hero-title">Prescription Made Easy</h1>
          <p class="rxp-hero-desc">Upload your prescription and our pharmacists will review it. We'll get your medicines ready and delivered to your doorstep.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- UPLOAD + DETAILS -->
  <section class="rxp-forms">
    <div class="rxp-wrap">

      <form id="rxpForm" enctype="multipart/form-data" novalidate>
        <?php wp_nonce_field( 'leshavin_rx_nonce', 'rx_nonce' ); ?>
        <input type="hidden" name="action" value="leshavin_submit_prescription">

        <div class="rxp-forms-grid">

          <!-- UPLOAD CARD -->
          <div class="rxp-card">
            <div class="rxp-card-title">Upload Prescription</div>

            <div class="rxp-fg" id="rxp-fg-file">
              <div class="rxp-dropzone" id="rxpDropzone">
                <div class="rxp-drop-title">Upload Prescription</div>
                <div class="rxp-drop-sub">Drag and drop your file here or</div>
                <span class="rxp-choose-btn">Choose File</span>
                <input type="file" id="rxp_file" name="rx_file" accept="image/*,.pdf,.doc,.docx">
                <div class="rxp-drop-hint">JPG, PNG, PDF up to 5MB</div>
                <div class="rxp-filename" id="rxpFileName"></div>
              </div>
              <div class="rxp-err">Please attach your prescription file.</div>
            </div>

            <!-- id added: this is the anchor point the JS moves rxp-fg-file back before, on desktop -->
            <div class="rxp-privacy" id="rxpPrivacyBox">
              <div class="rxp-privacy-title">Your prescription is safe with us.</div>
              <div class="rxp-privacy-sub">We respect your privacy and keep your information confidential.</div>
            </div>
          </div>

          <!-- DETAILS CARD -->
          <div class="rxp-card">
            <div class="rxp-card-title">Prescription Details</div>

            <div class="rxp-fg" id="rxp-fg-name">
              <label for="rxp_name">Your Full Name</label>
              <input type="text" id="rxp_name" name="rx_name" placeholder="Enter your full name">
              <div class="rxp-err">Please enter your full name.</div>
            </div>

            <div class="rxp-fg" id="rxp-fg-phone">
              <label for="rxp_phone">Phone Number</label>
              <input type="tel" id="rxp_phone" name="rx_phone" placeholder="Enter your phone number">
              <div class="rxp-err">Please enter your phone number.</div>
            </div>

            <!-- id added: this is the anchor point the JS moves rxp-fg-file after, on mobile -->
            <div class="rxp-fg" id="rxp-fg-notes">
              <label for="rxp_notes">Additional Notes <span class="rxp-opt">(Optional)</span></label>
              <textarea id="rxp_notes" name="rx_notes" placeholder="Add any additional information for the pharmacist..."></textarea>
            </div>

            <button type="button" class="rxp-submit-btn" id="rxpSubmitBtn">Submit Prescription</button>

            <div class="rxp-toast rxp-toast-success" id="rxpSuccess" role="alert" aria-live="polite">
              Your prescription was received! Our pharmacist will review it and reach out to confirm your order.
            </div>

            <div class="rxp-toast rxp-toast-error" id="rxpError" role="alert" aria-live="polite">
              <span id="rxpErrorText"></span>
            </div>
          </div>

        </div>
      </form>

    </div>
  </section>

  <!-- WHAT HAPPENS NEXT -->
  <section class="rxp-next">
    <div class="rxp-wrap">
      <div class="rxp-next-strip">

        <div class="rxp-next-lead">
          <div class="rxp-next-title">What happens next?</div>
          <div class="rxp-next-sub">Our pharmacist will review your prescription and contact you to confirm the order.</div>
        </div>

        <div class="rxp-next-steps">
          <div class="rxp-next-step">
            <div class="rxp-next-step-num">1</div>
            <div>
              <div class="rxp-next-step-title">Prescription Review</div>
              <div class="rxp-next-step-sub">Our pharmacist verifies your prescription.</div>
            </div>
          </div>
          <div class="rxp-next-step">
            <div class="rxp-next-step-num">2</div>
            <div>
              <div class="rxp-next-step-title">Order Confirmation</div>
              <div class="rxp-next-step-sub">We contact you to confirm the order.</div>
            </div>
          </div>
          <div class="rxp-next-step">
            <div class="rxp-next-step-num">3</div>
            <div>
              <div class="rxp-next-step-title">Secure Packaging</div>
              <div class="rxp-next-step-sub">Your medicines are packed with care.</div>
            </div>
          </div>
          <div class="rxp-next-step">
            <div class="rxp-next-step-num">4</div>
            <div>
              <div class="rxp-next-step-title">Fast Delivery</div>
              <div class="rxp-next-step-sub">Delivered safely to your doorstep.</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

</div>

<script>
window.addEventListener('load', function () {

  var form = document.getElementById('rxpForm');
  if (!form) return;

  var dropzone   = document.getElementById('rxpDropzone');
  var fileInput  = document.getElementById('rxp_file');
  var fileNameEl = document.getElementById('rxpFileName');
  var fgFile     = document.getElementById('rxp-fg-file');

  var btn        = document.getElementById('rxpSubmitBtn');
  var btnLabel   = 'Submit Prescription';
  var successEl  = document.getElementById('rxpSuccess');
  var errorEl    = document.getElementById('rxpError');
  var errorText  = document.getElementById('rxpErrorText');
  var toastTimer = null, isSending = false;

  /* ---- Reflow: on mobile, move the Upload field into the Details
     card right after Additional Notes (before Submit). On desktop,
     put it back in its original spot in the Upload card. ---- */
  var privacyBox = document.getElementById('rxpPrivacyBox');

  function placeUploadField() {
    var isMobile = window.matchMedia('(max-width: 640px)').matches;
    if (isMobile) {
      if (fgFile.nextSibling !== btn || fgFile.parentNode !== btn.parentNode) {
        btn.parentNode.insertBefore(fgFile, btn);
      }
    } else {
      if (fgFile.nextSibling !== privacyBox || fgFile.parentNode !== privacyBox.parentNode) {
        privacyBox.parentNode.insertBefore(fgFile, privacyBox);
      }
    }
  }
  placeUploadField();

  var mq = window.matchMedia('(max-width: 640px)');
  if (mq.addEventListener) {
    mq.addEventListener('change', placeUploadField);
  } else if (mq.addListener) {
    mq.addListener(placeUploadField); // older Safari fallback
  }
  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(placeUploadField, 150);
  });

  var fields = [
    { id:'rxp-fg-name',  input:'rxp_name',  check:function(v){ return v.trim().length >= 2; } },
    { id:'rxp-fg-phone', input:'rxp_phone', check:function(v){ return v.trim().replace(/\s/g,'').length >= 9; } }
  ];

  /* dropzone interactions */
  dropzone.addEventListener('click', function(){ fileInput.click(); });
  dropzone.addEventListener('dragover', function(e){ e.preventDefault(); dropzone.classList.add('dragover'); });
  dropzone.addEventListener('dragleave', function(){ dropzone.classList.remove('dragover'); });
  dropzone.addEventListener('drop', function(e){
    e.preventDefault();
    dropzone.classList.remove('dragover');
    if (e.dataTransfer.files && e.dataTransfer.files[0]) {
      fileInput.files = e.dataTransfer.files;
      fileInput.dispatchEvent(new Event('change'));
    }
  });
  fileInput.addEventListener('change', function(){
    if (this.files && this.files[0]) {
      fileNameEl.textContent = 'Selected: ' + this.files[0].name;
      fgFile.classList.remove('invalid');
    } else {
      fileNameEl.textContent = '';
    }
  });

  function showToast(el, ms) {
    clearTimeout(toastTimer);
    successEl.classList.remove('show');
    errorEl.classList.remove('show');
    el.classList.add('show');
    toastTimer = setTimeout(function(){ el.classList.remove('show'); }, ms || 7000);
  }
  function setLoading(state) {
    isSending = state;
    btn.disabled = state;
    btn.textContent = state ? 'Sending…' : btnLabel;
  }
  function validateField(f, el, fg) {
    var pass = f.check(el.value);
    fg.classList.toggle('valid', pass);
    fg.classList.toggle('invalid', !pass);
    return pass;
  }
  function validateAll() {
    var ok = true, firstInvalid = null;

    fields.forEach(function(f){
      var el = document.getElementById(f.input), fg = document.getElementById(f.id);
      if (el && fg && !validateField(f, el, fg)) { ok = false; if (!firstInvalid) firstInvalid = fg; }
    });

    if (!fileInput.files || !fileInput.files[0]) {
      fgFile.classList.add('invalid');
      ok = false;
      if (!firstInvalid) firstInvalid = fgFile;
    } else {
      fgFile.classList.remove('invalid');
    }

    if (!ok && firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return ok;
  }
  function resetForm() {
    setLoading(false);
    form.reset();
    fileNameEl.textContent = '';
    fields.forEach(function(f){
      var fg = document.getElementById(f.id);
      if (fg) fg.classList.remove('valid', 'invalid');
    });
    fgFile.classList.remove('invalid');
  }

  fields.forEach(function(f){
    var el = document.getElementById(f.input), fg = document.getElementById(f.id);
    if (!el || !fg) return;
    el.addEventListener('blur',  function(){ if (!isSending) validateField(f, el, fg); });
    el.addEventListener('input', function(){ if (!isSending && fg.classList.contains('invalid')) validateField(f, el, fg); });
  });

  btn.addEventListener('click', function () {
    if (isSending) return;
    if (!validateAll()) return;

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
          errorText.textContent = 'Server error. Please call us on <?php echo esc_js( $rxp_phone ); ?>.';
          showToast(errorEl, 8000);
          return;
        }
        if (data.success) {
          resetForm();
          showToast(successEl, 8000);
        } else {
          setLoading(false);
          errorText.textContent = (data.data && data.data.msg) ? data.data.msg : 'Failed to send. Please call us on <?php echo esc_js( $rxp_phone ); ?>.';
          showToast(errorEl, 8000);
        }
      })
      .catch(function(){
        setLoading(false);
        errorText.textContent = 'Network error. Please check your connection and try again.';
        showToast(errorEl, 8000);
      });
  });

});
</script>

<?php get_footer(); ?>