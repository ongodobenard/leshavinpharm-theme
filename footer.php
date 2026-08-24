<?php
/**
 * Leshavin Pharmacy — footer.php
 */
$lph_wa    = leshavin_phone();
$lph_phone = leshavin_phone_display();
$lph_addr  = function_exists('leshavin_location') ? leshavin_location() : 'Nairobi, Kenya';
$lph_map_src = 'https://www.google.com/maps?q=' . rawurlencode( $lph_addr ) . '&output=embed';
$lph_map_link = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $lph_addr );
?>

<style>
/* ============================================================
   FOOTER — variables (matches the Leshavin header palette)
   ============================================================ */
:root{
  --ft-navy:#0e2358;
  --ft-blue:#1c75bc;
  --ft-blue-dark:#125a94;
  --ft-green:#8dc63f;
  --ft-green-dark:#6ea82e;
  --ft-line:rgba(255,255,255,.10);
  --ft-text:rgba(255,255,255,.62);
  --ft-text-dim:rgba(255,255,255,.38);
  --ft-font-head:'Oswald',sans-serif;
  --ft-font-body:'Inter',sans-serif;
  --ft-px:48px;
}

/* ============================================================
   FOOTER SHELL
   ============================================================ */
.site-footer{
  background:var(--ft-navy);
  font-family:var(--ft-font-body);
  border-top:3px solid var(--ft-green);
}
.foot-inner{max-width:1280px;margin:0 auto;padding:56px var(--ft-px) 40px;}

/* ============================================================
   TOP GRID
   ============================================================ */
.foot-grid{
  display:grid;
  grid-template-columns:1.5fr 1fr 1fr 1.2fr;
  gap:40px;
}
.foot-col{min-width:0;}

/* Brand block */
.foot-logo{display:inline-flex;align-items:center;gap:10px;flex-wrap:wrap;text-decoration:none;margin-bottom:16px;}
.foot-logo img{height:44px;width:auto;object-fit:contain;display:block;flex-shrink:0;}
.foot-logo-tag{font-family:var(--ft-font-head);font-size:.68rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--ft-text-dim);}

.foot-desc{
  font-size:.87rem;line-height:1.7;color:var(--ft-text);
  margin:0 0 20px;max-width:340px;
}

.foot-socs{display:flex;align-items:center;gap:16px;}
.foot-soc{
  display:flex;align-items:center;justify-content:center;
  color:rgba(255,255,255,.55);
  transition:color .2s,transform .2s;
  text-decoration:none;
}
.foot-soc svg{width:18px;height:18px;display:block;}
.foot-soc:hover{color:var(--ft-green);transform:translateY(-2px);}

/* Headings */
.foot-h{
  font-family:var(--ft-font-head);font-size:.92rem;font-weight:700;color:#fff;
  text-transform:uppercase;letter-spacing:.05em;margin:0 0 20px;
  position:relative;padding-bottom:10px;
}
.foot-h::after{
  content:'';position:absolute;left:0;bottom:0;width:28px;height:2px;background:var(--ft-green);
}

/* Link lists */
.foot-links{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:11px;}
.foot-links a{
  color:var(--ft-text);text-decoration:none;font-size:.87rem;
  transition:color .18s,padding-left .18s;display:inline-block;
}
.foot-links a:hover{color:var(--ft-green);padding-left:4px;}

/* Mobile-only "Terms & Conditions" entry inside Quick Links.
   Hidden on desktop/tablet — only shown in the sub-600px block below. */
.foot-links-mobile-terms{display:none;}

/* Contact list */
.foot-contact{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:16px;}
.foot-contact li{display:flex;align-items:flex-start;gap:11px;font-size:.85rem;color:var(--ft-text);line-height:1.5;}
.foot-contact svg{width:16px;height:16px;flex-shrink:0;margin-top:2px;color:var(--ft-green);}
.foot-contact a{color:inherit;text-decoration:none;transition:color .18s;}
.foot-contact a:hover{color:var(--ft-green);}

/* ============================================================
   FOOTER MINI MAP (Contact Us column)
   ============================================================ */
.foot-map-wrap{margin-top:16px;}
.foot-map{
  position:relative;
  width:100%;
  height:130px;
  border-radius:10px;
  overflow:hidden;
  border:1.5px solid rgba(255,255,255,.14);
  background:#0a1c46;
}
.foot-map iframe{
  width:100%;height:100%;border:0;display:block;
  filter:grayscale(.15) contrast(1.02);
}
/* transparent overlay so the iframe itself isn't directly interactive/scroll-jacking inside footer */
.foot-map-overlay{
  position:absolute;inset:0;background:transparent;cursor:pointer;
}
.foot-map-link{
  display:inline-flex;align-items:center;gap:6px;
  margin-top:10px;
  font-family:var(--ft-font-head);font-size:.76rem;font-weight:600;
  letter-spacing:.04em;text-transform:uppercase;
  color:var(--ft-green);text-decoration:none;
  transition:color .18s,gap .18s;
}
.foot-map-link svg{width:13px;height:13px;flex-shrink:0;}
.foot-map-link:hover{color:#fff;gap:9px;}

/* ============================================================
   BOTTOM BAR — copyright left, credit centered, Terms & Conditions right
   ============================================================ */
.foot-bottom{border-top:1px solid var(--ft-line);}
.foot-bottom-inner{
  max-width:1280px;margin:0 auto;padding:18px var(--ft-px);
  display:grid;
  grid-template-columns:1fr auto 1fr;
  align-items:center;
  gap:14px;
}
.foot-copy{font-size:.78rem;color:var(--ft-text-dim);justify-self:start;}
.foot-credit{font-size:.78rem;color:var(--ft-text-dim);justify-self:center;text-align:center;white-space:nowrap;}
.foot-credit a{color:var(--ft-text);text-decoration:none;font-weight:700;transition:color .18s;}
.foot-credit a:hover{color:var(--ft-green);}
.foot-legal{justify-self:end;}
.foot-legal a{font-size:.78rem;color:var(--ft-text);text-decoration:none;transition:color .18s;}
.foot-legal a:hover{color:var(--ft-green);}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media(max-width:960px){
  :root{--ft-px:28px;}
  .foot-grid{grid-template-columns:1fr 1fr;row-gap:36px;}
  .foot-col.foot-brand{grid-column:1 / -1;}
  .foot-desc{max-width:none;}
}
@media(max-width:600px){
  :root{--ft-px:20px;}

  /* Minimised top/bottom margin around the main footer content */
  .foot-inner{padding:10px var(--ft-px) 4px;}
  .foot-grid{grid-template-columns:1fr;row-gap:12px;}
  .foot-logo{flex-direction:column;align-items:flex-start;gap:4px;margin-bottom:6px;}
  .foot-desc{margin-bottom:8px;}
  .foot-h{margin-bottom:8px;padding-bottom:6px;}
  .foot-contact{gap:10px;}
  .foot-links{gap:8px;}
  .foot-map{height:110px;}
  .foot-map-wrap{margin-top:12px;}

  /* Show Terms & Conditions inside Quick Links on mobile only */
  .foot-links-mobile-terms{display:block;}

  /* Hide the standalone Terms & Conditions column in the bottom bar on mobile */
  .foot-legal{display:none;}

  .foot-bottom-inner{
    grid-template-columns:1fr;
    justify-items:center;
    text-align:center;
    gap:2px;
    padding:6px var(--ft-px);
  }
  .foot-copy,.foot-credit{justify-self:center;}

  /* Smaller copyright + credit text on mobile */
  .foot-copy{font-size:.68rem;}
  .foot-credit{font-size:.68rem;white-space:normal;}

  /* Minimal bottom margin — just enough to clear the fixed WhatsApp button */
  .foot-bottom{padding-bottom:36px;}
}

/* ============================================================
   FLOATING WHATSAPP BUTTON — single action, bottom right
   ============================================================ */
.fab-whatsapp{
  position:fixed;right:22px;bottom:22px;z-index:900;
  width:56px;height:56px;border-radius:50%;
  background:#25D366;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 6px 20px rgba(0,0,0,.28);
  text-decoration:none;color:#fff;
  transition:transform .2s,box-shadow .2s;
}
.fab-whatsapp:hover{transform:translateY(-3px);box-shadow:0 10px 26px rgba(0,0,0,.34);}
.fab-whatsapp svg{width:26px;height:26px;}
.fab-tip{
  position:absolute;right:calc(100% + 12px);top:50%;transform:translateY(-50%) translateX(6px);
  background:var(--ft-navy);color:#fff;font-family:var(--ft-font-body);
  font-size:.78rem;font-weight:600;white-space:nowrap;
  padding:7px 13px;border-radius:6px;
  opacity:0;visibility:hidden;pointer-events:none;
  transition:opacity .2s,transform .2s,visibility .2s;
}
.fab-tip::after{
  content:'';position:absolute;left:100%;top:50%;transform:translateY(-50%);
  border:5px solid transparent;border-left-color:var(--ft-navy);
}
.fab-whatsapp:hover .fab-tip{opacity:1;visibility:visible;transform:translateY(-50%) translateX(0);}
@media(max-width:600px){
  .fab-whatsapp{width:52px;height:52px;right:16px;bottom:16px;}
  .fab-whatsapp svg{width:24px;height:24px;}
  .fab-tip{display:none;}
}
</style>

<!-- ==================== FOOTER ==================== -->
<footer class="site-footer">
  <div class="foot-inner">
    <div class="foot-grid">

      <!-- Brand -->
      <div class="foot-col foot-brand">
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="foot-logo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/js/images/logo2.png' ); ?>" alt="Leshavin Pharmacy">
          <span class="foot-logo-tag">Reliable Care At Your Doorstep</span>
        </a>
        <p class="foot-desc">Leshavin Pharmacy brings genuine, quality-assured medicines and everyday health essentials straight to your door: fast, dependable and trusted by families across Nairobi and beyond.</p>
        <div class="foot-socs">
          <a href="<?php echo esc_url( get_option('leshavin_facebook','#') ); ?>" class="foot-soc" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
          </a>
          <a href="<?php echo esc_url( get_option('leshavin_instagram','#') ); ?>" class="foot-soc" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
          </a>
          <a href="https://wa.me/<?php echo esc_attr( $lph_wa ); ?>" class="foot-soc" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="foot-col">
        <div class="foot-h">Quick Links</div>
        <ul class="foot-links">
          <li><a href="<?php echo esc_url( home_url('/') ); ?>">Home</a></li>
          <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>">Shop</a></li>
          <li><a href="<?php echo esc_url( home_url('/about-us') ); ?>">About Us</a></li>
          <li><a href="<?php echo esc_url( home_url('/contact') ); ?>">Contact</a></li>
          <li><a href="<?php echo esc_url( home_url('/prescription') ); ?>">Submit Prescription</a></li>
          <li><a href="<?php echo esc_url( home_url('/return-policy') ); ?>">Return Policy</a></li>
          <!-- Mobile-only: Terms & Conditions moves here below 600px, hidden on desktop/tablet -->
          <li class="foot-links-mobile-terms"><a href="<?php echo esc_url( home_url('/terms') ); ?>">Terms &amp; Conditions</a></li>
        </ul>
      </div>

      <!-- Categories -->
      <div class="foot-col">
        <div class="foot-h">Categories</div>
        <ul class="foot-links">
          <?php
          $lph_foot_cats = get_terms([ 'taxonomy'=>'product_cat','hide_empty'=>true,'parent'=>0,'number'=>6 ]);
          if ( $lph_foot_cats && ! is_wp_error( $lph_foot_cats ) && count( $lph_foot_cats ) ) :
            foreach ( $lph_foot_cats as $lph_fc ) :
          ?>
            <li><a href="<?php echo esc_url( get_term_link( $lph_fc ) ); ?>"><?php echo esc_html( $lph_fc->name ); ?></a></li>
          <?php
            endforeach;
          else :
            foreach ( ['Prescription Meds','Supplements','Baby Care','Skincare','Equipment','Dental Care'] as $lph_fn ) :
          ?>
            <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>"><?php echo esc_html( $lph_fn ); ?></a></li>
          <?php
            endforeach;
          endif;
          ?>
        </ul>
      </div>

      <!-- Contact Us -->
      <div class="foot-col">
        <div class="foot-h">Contact Us</div>
        <ul class="foot-contact">
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.67A2 2 0 012 1h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
            <a href="tel:+<?php echo esc_attr( $lph_wa ); ?>"><?php echo esc_html( $lph_phone ); ?></a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            <a href="mailto:<?php echo esc_attr( leshavin_email() ); ?>"><?php echo esc_html( leshavin_email() ); ?></a>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            <span><?php echo esc_html( $lph_addr ); ?></span>
          </li>
          <li>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span><?php echo esc_html( leshavin_hours() ); ?></span>
          </li>
        </ul>

        <!-- MINI MAP (matches reference screenshot: thumbnail map + "View Map" link) -->
        <div class="foot-map-wrap">
          <div class="foot-map">
            <iframe
              src="<?php echo esc_url( $lph_map_src ); ?>"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              title="Leshavin Pharmacy Location — mini map"
              tabindex="-1">
            </iframe>
            <a href="<?php echo esc_url( $lph_map_link ); ?>" class="foot-map-overlay" target="_blank" rel="noopener noreferrer" aria-label="Open full map"></a>
          </div>
          <a href="<?php echo esc_url( $lph_map_link ); ?>" class="foot-map-link" target="_blank" rel="noopener noreferrer">
            View Map
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
          </a>
        </div>
      </div>

    </div>
  </div>

  <!-- Bottom bar: copyright (left) — credit (centered) — Terms & Conditions (right, desktop only) -->
  <div class="foot-bottom">
    <div class="foot-bottom-inner">
      <div class="foot-copy">&copy; <?php echo esc_html( date('Y') ); ?> Leshavin Pharmacy. All rights reserved.</div>

      <div class="foot-credit">
        Designed and Developed By <a href="https://devnovatech.co.ke/" target="_blank" rel="noopener noreferrer">DevNovaTech Software Developers</a>
      </div>

      <nav class="foot-legal" aria-label="Legal">
        <a href="<?php echo esc_url( home_url('/terms') ); ?>">Terms &amp; Conditions</a>
      </nav>
    </div>
  </div>
</footer>

<!-- ==================== FLOATING WHATSAPP BUTTON (single) ==================== -->
<a href="https://wa.me/<?php echo esc_attr( $lph_wa ); ?>?text=<?php echo urlencode( 'Hello Leshavin Pharmacy! I would like to place an order.' ); ?>"
   class="fab-whatsapp" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
  <span class="fab-tip">Chat on WhatsApp</span>
  <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

<?php wp_footer(); ?>
</body>
</html>