<?php
/**
 * Leshavin Pharmacy — functions.php
 */

// ─── THEME SETUP ──────────────────────────────
function leshavin_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('html5', ['search-form','comment-form','gallery','caption','style','script']);
    add_theme_support('custom-logo', ['width'=>46,'height'=>46,'flex-square'=>true]);
    register_nav_menus(['primary' => 'Primary Menu']);
}
add_action('after_setup_theme', 'leshavin_setup');

// ─── DISABLE NATIVE WOOCOMMERCE ORDER EMAILS ──────────────────
// leshavin_send_order_handler() sends our own fully-branded admin +
// customer emails (see below). Without disabling these, WooCommerce's
// built-in "New order" (to admin) and "Order processing" / "On hold"
// (to customer) emails ALSO fire automatically whenever we call
// wc_create_order() + update_status('processing') — this is exactly
// what was causing two separate notifications to land for the same
// order (one native WooCommerce email, one from our custom handler).
add_filter( 'woocommerce_email_enabled_new_order',                 '__return_false' );
add_filter( 'woocommerce_email_enabled_customer_processing_order', '__return_false' );
add_filter( 'woocommerce_email_enabled_customer_on_hold_order',    '__return_false' );
add_filter( 'woocommerce_email_enabled_admin_failed_order',        '__return_false' );

// ─── ENQUEUE ──────────────────────────────────
function leshavin_enqueue() {
    wp_enqueue_style('google-fonts',
        'https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap',
        [], null);
    wp_enqueue_style('leshavin-style', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_script('leshavin-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [], '1.0.0', true);
    wp_localize_script('leshavin-main', 'leshavinData', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('leshavin_nonce'),
        'waNumber' => leshavin_wa(),
        // FIX: wc_get_page_id() is a WooCommerce function that isn't always
        // guaranteed to be loaded yet when this hook fires (e.g. WooCommerce
        // briefly unavailable, plugin update in progress, etc). Calling it
        // unguarded caused a fatal error on every single page load. Now it
        // falls back to a plain /shop URL instead of crashing the site.
        'shopUrl'  => function_exists('wc_get_page_id')
            ? get_permalink( wc_get_page_id('shop') )
            : home_url('/shop'),
    ]);
}
add_action('wp_enqueue_scripts', 'leshavin_enqueue');

// ─── WC WRAPPERS ──────────────────────────────
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_before_main_content', function() { echo '<div class="wc-outer">'; }, 10);
add_action('woocommerce_after_main_content',  function() { echo '</div>'; }, 10);

// ─── HELPERS ──────────────────────────────────
if ( ! function_exists('leshavin_wa') ) {
    function leshavin_wa()      { return get_option('leshavin_wa',      '254792331941'); }
}
if ( ! function_exists('leshavin_phone') ) {
    function leshavin_phone()   { return get_option('leshavin_phone',   '+254 792 331 941'); }
}
if ( ! function_exists('leshavin_address') ) {
    function leshavin_address() { return get_option('leshavin_address', 'Moi Drive, Plot No. Umoja A18, Nairobi, Kenya'); }
}
if ( ! function_exists('leshavin_tagline') ) {
    function leshavin_tagline() { return get_option('leshavin_tagline', 'Reliable Care At Your Doorstep'); }
}
if ( ! function_exists('leshavin_email') ) {
    function leshavin_email()   { return get_option('leshavin_email',   'info@leshavinpharmacy.com'); }
}
// NOTE: page-prescription.php and page-contact.php call leshavin_phone_display()
// and leshavin_location() unconditionally. Neither existed anywhere in this
// file before, which would have caused a fatal "Call to undefined function"
// on both of those pages. Added here as thin wrappers around the existing
// leshavin_phone() / leshavin_address() helpers so those templates load.
if ( ! function_exists('leshavin_phone_display') ) {
    function leshavin_phone_display() { return leshavin_phone(); }
}
if ( ! function_exists('leshavin_location') ) {
    function leshavin_location() { return leshavin_address(); }
}

// ─── SMALL SVG ICON HELPERS (no emoji, ever) ──
if ( ! function_exists('leshavin_pill_svg') ) {
    function leshavin_pill_svg() {
        return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M10.5 3.5a6 6 0 018 8l-8.5 8.5a6 6 0 01-8-8l8.5-8.5z"/><line x1="9" y1="15" x2="15" y2="9"/></svg>';
    }
}
if ( ! function_exists('leshavin_cart_svg') ) {
    function leshavin_cart_svg() {
        return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 001.97 1.61h9.72a2 2 0 001.97-1.67L23 6H6"/></svg>';
    }
}
if ( ! function_exists('leshavin_rx_svg') ) {
    function leshavin_rx_svg() {
        return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>';
    }
}
if ( ! function_exists('leshavin_wa_svg') ) {
    function leshavin_wa_svg() {
        return '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
    }
}

// ─── NORMALIZE PHONE NUMBERS FOR wa.me LINKS ──────────────────
// wa.me requires the full international number with country code and
// no leading 0 (e.g. 254796038686), but customers type their number in
// local format (0796038686) on every form. Passing that raw string
// straight into a wa.me link is exactly what caused "Couldn't look up
// phone number ... missing a country code or has the wrong one." on
// the "WhatsApp Customer" buttons in the admin notification emails.
// Normalizes any of: 0796038686 / 796038686 / 254796038686 /
// +254 796 038 686 into the clean 254-prefixed digit string wa.me needs.
if ( ! function_exists('leshavin_wa_digits') ) {
    function leshavin_wa_digits( $phone ) {
        $digits = preg_replace( '/[^0-9]/', '', (string) $phone );

        if ( $digits === '' ) return '';

        // Already has the country code (254XXXXXXXXX = 12 digits).
        if ( strlen( $digits ) === 12 && substr( $digits, 0, 3 ) === '254' ) {
            return $digits;
        }

        // Local format with leading 0 (0796038686 = 10 digits).
        if ( strlen( $digits ) === 10 && $digits[0] === '0' ) {
            return '254' . substr( $digits, 1 );
        }

        // Bare 9-digit number with no leading 0 (796038686).
        if ( strlen( $digits ) === 9 ) {
            return '254' . $digits;
        }

        // Fallback: return whatever we got, digits-only.
        return $digits;
    }
}

// ─── WHATSAPP ORDER BUTTON ON PRODUCT ─────────
// Label switches based on prescription status: restricted products keep
// the pharmacist-enquiry framing, everything else reads as a direct order.
function leshavin_wa_button() {
    global $product;
    if ( ! $product ) return;
    $wa    = leshavin_wa();
    $name  = $product->get_name();
    $price = strip_tags( $product->get_price_html() );
    $url   = get_permalink();
    $is_rx = leshavin_needs_prescription( $product->get_id() );
    $label = $is_rx ? 'Ask a Pharmacist on WhatsApp' : 'Buy via WhatsApp';
    $msg   = urlencode("Hello " . get_bloginfo('name') . "!\n\nI'd like to order:\n{$name}\nPrice: KSh {$price}\n{$url}\n\nPlease confirm availability. Thank you!");
    echo '<a href="https://wa.me/' . esc_attr($wa) . '?text=' . $msg . '" class="wc-wa-btn" target="_blank" rel="noopener">
        ' . leshavin_wa_svg() . '
        ' . esc_html( $label ) . '
    </a>';
}
add_action('woocommerce_single_product_summary', 'leshavin_wa_button', 35);

// ─── CASH ON DELIVERY ONLY ────────────────────
add_filter('woocommerce_payment_gateways', function($gateways) {
    foreach ($gateways as $k => $v) {
        if ($k !== 'cod') unset($gateways[$k]);
    }
    return $gateways;
});

// ─── PRESCRIPTION CATEGORY LOGIC (shared across theme) ──
// Canonical definition. functions.php always loads before any
// template file (archive-product.php, page-shop.php, front-page.php,
// etc.), so this is the ONLY copy of this function that actually
// executes — any copy inside a template wrapped in function_exists()
// is dead code once this one has already run. Keep the slug list
// here in sync with the real product_cat slugs on the site.
// Confirmed live slugs:
//   - prescription-only-medicine
//   - diabetic-weight-management   (was previously mismatched as
//                                    "weight-management" — that slug
//                                    does not exist on the live site,
//                                    which is why Libre devices were
//                                    slipping through as Add to Cart)
//   - prescription
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

// ─── AJAX: FILTER PRODUCTS BY CATEGORY ───────
function leshavin_filter_products() {
    $cat  = sanitize_text_field($_POST['cat'] ?? '');
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    if ($cat) {
        $args['tax_query'] = [[
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cat,
        ]];
    }
    $q = new WP_Query($args);
    ob_start();
    if ($q->have_posts()) {
        while ($q->have_posts()) {
            $q->the_post();
            global $product;
            $sale     = $product->is_on_sale();
            $is_new   = (time() - strtotime($product->get_date_created())) < (30 * DAY_IN_SECONDS);
            $img      = get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_thumbnail');
            $price_r  = $product->get_regular_price();
            $price_c  = $product->get_price();
            $cats     = get_the_terms(get_the_ID(), 'product_cat');
            $cat_n    = ($cats && !is_wp_error($cats)) ? $cats[0]->name : '';
            $cat_link = ($cats && !is_wp_error($cats)) ? get_term_link($cats[0]) : '#';
            $is_rx    = leshavin_needs_prescription(get_the_ID());
            $brands   = get_the_terms(get_the_ID(), 'product_brand');
            if (!$brands || is_wp_error($brands)) $brands = get_the_terms(get_the_ID(), 'pa_brand');
            $brand_n  = ($brands && !is_wp_error($brands)) ? $brands[0]->name : '';
            $wa_msg   = urlencode("Hello! I'd like to order: " . get_the_title() . " — KSh {$price_c}. Link: " . get_permalink());
            $wa       = leshavin_wa();
            $add_url  = $product->is_type('simple') ? '?add-to-cart=' . get_the_ID() : get_permalink();
            ?>
            <div class="p-card reveal">
                <a href="<?php the_permalink(); ?>" class="p-img-link">
                    <div class="p-img">
                        <?php if ($img): ?>
                            <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                        <?php else: ?>
                            <span style="opacity:.3;color:var(--blue-dark,#125a94);"><?php echo leshavin_pill_svg(); ?></span>
                        <?php endif; ?>
                        <?php if ($sale): ?><div class="p-badge-sale">SALE</div>
                        <?php elseif ($is_new): ?><div class="p-badge-new">NEW</div><?php endif; ?>
                    </div>
                </a>
                <div class="p-body">
                    <div class="p-card-meta">
                        <?php if ($cat_n): ?><a href="<?php echo esc_url($cat_link); ?>" class="p-card-cat"><?php echo esc_html($cat_n); ?></a><?php endif; ?>
                        <?php if ($brand_n): ?><span class="p-card-brand"><?php echo esc_html($brand_n); ?></span><?php endif; ?>
                    </div>
                    <div class="p-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    <div class="p-price-wrap">
                        <?php if ($sale && $price_r): ?><div class="p-price-old">KSh <?php echo number_format($price_r,2); ?></div><?php endif; ?>
                        <div class="p-price-cur">KSh <?php echo number_format($price_c,2); ?></div>
                    </div>
                    <div class="p-btns">
                        <?php if ($is_rx): ?>
                            <a href="<?php echo esc_url( home_url('/submit-prescription') ); ?>" class="p-btn-cart">
                                <span class="p-btn-ico"><?php echo leshavin_rx_svg(); ?></span>Submit Prescription
                            </a>
                        <?php else: ?>
                            <a href="<?php echo esc_url($add_url); ?>" class="p-btn-cart" <?php if ($product->is_type('simple')): ?>data-product_id="<?php echo get_the_ID(); ?>" rel="nofollow"<?php endif; ?>>
                                <span class="p-btn-ico"><?php echo leshavin_cart_svg(); ?></span>Add to Cart
                            </a>
                        <?php endif; ?>
                        <a href="https://wa.me/<?php echo esc_attr($wa); ?>?text=<?php echo $wa_msg; ?>" class="p-btn-wa" target="_blank" rel="noopener">
                            <span class="p-btn-ico"><?php echo leshavin_wa_svg(); ?></span><?php echo $is_rx ? 'Ask a Pharmacist' : 'Buy via WhatsApp'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    } else {
        echo '<p style="grid-column:1/-1;text-align:center;color:var(--text-light);padding:40px;">No products found in this category.</p>';
    }
    $html = ob_get_clean();
    wp_send_json_success($html);
}
add_action('wp_ajax_leshavin_filter_products',        'leshavin_filter_products');
add_action('wp_ajax_nopriv_leshavin_filter_products', 'leshavin_filter_products');

// ─── ADMIN CONTACT ENQUIRY EMAIL (HTML, branded) ──────────────
// Same navy / green / blue palette as the order + logo emails.
if ( ! function_exists( 'leshavin_build_admin_contact_email_html' ) ) {
    function leshavin_build_admin_contact_email_html( $name, $email, $phone, $dept, $msg ) {
        $tagline   = leshavin_tagline();
        $site_url  = home_url( '/' );
        $wa_digits = leshavin_wa_digits( $phone );

        ob_start();
        ?>
<div style="font-family:Arial,Helvetica,sans-serif;background:#f6f7fb;padding:24px;">
  <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e7ebf1;">

    <div style="background:#0e2358;padding:26px 28px;text-align:center;border-top:4px solid #8dc63f;">
      <div style="color:#ffffff;font-size:20px;font-weight:700;">Leshavin Pharmacy</div>
      <div style="color:#a9b6d1;font-size:13px;margin-top:4px;"><?php echo esc_html( $tagline ); ?></div>
    </div>

    <div style="padding:28px;">
      <div style="display:inline-block;background:#f8f9fc;border:1px solid #e7ebf1;border-radius:20px;padding:6px 16px;color:#0e2358;font-weight:700;font-size:12px;margin-bottom:16px;">
        Website Contact Form<?php echo $dept ? ' &nbsp;|&nbsp; ' . esc_html( $dept ) : ''; ?>
      </div>

      <h2 style="color:#0e2358;font-size:18px;margin:0 0 18px;">New Contact Enquiry</h2>

      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-radius:10px;padding:16px 18px;margin-bottom:20px;">
        <table style="width:100%;border-collapse:collapse;">
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;width:110px;">Name</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;font-weight:700;"><?php echo esc_html( $name ); ?></td></tr>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Phone</td><td style="padding:4px 0;font-size:13px;"><a href="tel:<?php echo esc_attr( $phone ); ?>" style="color:#1c75bc;font-weight:700;text-decoration:none;"><?php echo esc_html( $phone ); ?></a></td></tr>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Email</td><td style="padding:4px 0;font-size:13px;"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $email ); ?></a></td></tr>
          <?php if ( $dept ) : ?>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Subject</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;font-weight:700;"><?php echo esc_html( $dept ); ?></td></tr>
          <?php endif; ?>
        </table>
      </div>

      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-left:4px solid #1c75bc;border-radius:8px;padding:14px 16px;margin-bottom:22px;">
        <div style="color:#0e2358;font-weight:700;font-size:12px;text-transform:uppercase;margin-bottom:6px;">Message</div>
        <div style="color:#1c2b3a;font-size:13.5px;line-height:1.7;white-space:pre-wrap;"><?php echo esc_html( $msg ); ?></div>
      </div>

      <div style="text-align:center;">
        <?php if ( $wa_digits ) : ?>
        <a href="https://wa.me/<?php echo esc_attr( $wa_digits ); ?>" style="display:inline-block;background:#25d366;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">WhatsApp Customer</a>
        <?php endif; ?>
        <a href="mailto:<?php echo esc_attr( $email ); ?>" style="display:inline-block;background:#0e2358;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">Reply by Email</a>
      </div>
    </div>

    <div style="background:#f8f9fc;padding:18px 28px;text-align:center;border-top:1px solid #e7ebf1;">
      <div style="color:#6b7c8f;font-size:12px;line-height:1.6;">
        Automated notification from the Leshavin Pharmacy website contact form<br>
        <a href="<?php echo esc_url( $site_url ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $site_url ); ?></a>
      </div>
    </div>

  </div>
</div>
        <?php
        return ob_get_clean();
    }
}

// ─── AJAX: CONTACT FORM ───────────────────────
function leshavin_contact_handler() {
    check_ajax_referer('leshavin_nonce', 'nonce');
    $name  = sanitize_text_field($_POST['contact_name']  ?? '');
    $email = sanitize_email($_POST['contact_email']      ?? '');
    $phone = sanitize_text_field($_POST['contact_phone'] ?? '');
    // FIX: the form field is named "contact_subject" (see the <select
    // name="contact_subject"> in page-contact.php) — reading "contact_dept"
    // here always returned an empty string, so the subject/department was
    // silently missing from every enquiry email even though sending itself
    // never errored.
    $dept  = sanitize_text_field($_POST['contact_subject'] ?? '');
    $msg   = sanitize_textarea_field($_POST['contact_msg'] ?? '');

    // Sent to both the general pharmacy inbox and the owner's personal
    // email, branded to match the logo/order email colors (was plain
    // text, single recipient, before).
    $to      = array_values( array_unique( array_filter( [
        leshavin_email(),
        'ongodojames1@gmail.com',
    ] ) ) );
    $subject = "New Enquiry from {$name}" . ( $dept ? " : {$dept}" : '' );
    $body    = leshavin_build_admin_contact_email_html( $name, $email, $phone, $dept, $msg );
    $headers = [ 'Content-Type: text/html; charset=UTF-8', "Reply-To: {$name} <{$email}>" ];

    $sent = wp_mail($to, $subject, $body, $headers);
    wp_send_json($sent ? ['success' => true] : ['success' => false]);
}
add_action('wp_ajax_leshavin_contact',        'leshavin_contact_handler');
add_action('wp_ajax_nopriv_leshavin_contact', 'leshavin_contact_handler');

// ─── ADMIN PRESCRIPTION SUBMISSION EMAIL (HTML, branded) ──────────────
// Same navy / green / blue palette as the order + contact + logo emails.
if ( ! function_exists( 'leshavin_build_admin_prescription_email_html' ) ) {
    function leshavin_build_admin_prescription_email_html( $name, $phone, $notes, $file_name ) {
        $tagline   = leshavin_tagline();
        $site_url  = home_url( '/' );
        $wa_digits = leshavin_wa_digits( $phone );

        ob_start();
        ?>
<div style="font-family:Arial,Helvetica,sans-serif;background:#f6f7fb;padding:24px;">
  <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e7ebf1;">

    <div style="background:#0e2358;padding:26px 28px;text-align:center;border-top:4px solid #8dc63f;">
      <div style="color:#ffffff;font-size:20px;font-weight:700;">Leshavin Pharmacy</div>
      <div style="color:#a9b6d1;font-size:13px;margin-top:4px;"><?php echo esc_html( $tagline ); ?></div>
    </div>

    <div style="padding:28px;">
      <div style="display:inline-block;background:#f8f9fc;border:1px solid #e7ebf1;border-radius:20px;padding:6px 16px;color:#0e2358;font-weight:700;font-size:12px;margin-bottom:16px;">
        Prescription Submission
      </div>

      <h2 style="color:#0e2358;font-size:18px;margin:0 0 18px;">New Prescription Received</h2>

      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-radius:10px;padding:16px 18px;margin-bottom:20px;">
        <table style="width:100%;border-collapse:collapse;">
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;width:110px;">Name</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;font-weight:700;"><?php echo esc_html( $name ); ?></td></tr>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Phone</td><td style="padding:4px 0;font-size:13px;"><a href="tel:<?php echo esc_attr( $phone ); ?>" style="color:#1c75bc;font-weight:700;text-decoration:none;"><?php echo esc_html( $phone ); ?></a></td></tr>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">File</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;font-weight:700;"><?php echo esc_html( $file_name ); ?> (attached)</td></tr>
        </table>
      </div>

      <?php if ( $notes ) : ?>
      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-left:4px solid #8dc63f;border-radius:8px;padding:14px 16px;margin-bottom:22px;">
        <div style="color:#0e2358;font-weight:700;font-size:12px;text-transform:uppercase;margin-bottom:6px;">Additional Notes</div>
        <div style="color:#1c2b3a;font-size:13.5px;line-height:1.7;white-space:pre-wrap;"><?php echo esc_html( $notes ); ?></div>
      </div>
      <?php endif; ?>

      <div style="background:#fff9ec;border:1px solid #f0dfa8;border-radius:8px;padding:12px 16px;margin-bottom:22px;">
        <div style="color:#8a6300;font-size:12.5px;line-height:1.6;">The prescription file is attached to this email — open it to verify before confirming the order.</div>
      </div>

      <div style="text-align:center;">
        <?php if ( $wa_digits ) : ?>
        <a href="https://wa.me/<?php echo esc_attr( $wa_digits ); ?>" style="display:inline-block;background:#25d366;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">WhatsApp Customer</a>
        <?php endif; ?>
      </div>
    </div>

    <div style="background:#f8f9fc;padding:18px 28px;text-align:center;border-top:1px solid #e7ebf1;">
      <div style="color:#6b7c8f;font-size:12px;line-height:1.6;">
        Automated notification from the Leshavin Pharmacy website prescription form<br>
        <a href="<?php echo esc_url( $site_url ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $site_url ); ?></a>
      </div>
    </div>

  </div>
</div>
        <?php
        return ob_get_clean();
    }
}

// ─── AJAX: SUBMIT PRESCRIPTION ────────────────
// This is the handler page-prescription.php's form was missing — the
// form posts action=leshavin_submit_prescription, but until now there
// was no wp_ajax_/wp_ajax_nopriv_ hook registered for that action, so
// admin-ajax.php returned the bare string "0" instead of JSON. The
// front-end JS then failed JSON.parse("0") and fell into its generic
// "Server error" toast. Registering the matching handler below fixes it.
function leshavin_submit_prescription_handler() {
    // Matches wp_nonce_field('leshavin_rx_nonce', 'rx_nonce') in the template.
    check_ajax_referer('leshavin_rx_nonce', 'rx_nonce');

    $name  = sanitize_text_field($_POST['rx_name']  ?? '');
    $phone = sanitize_text_field($_POST['rx_phone'] ?? '');
    $notes = sanitize_textarea_field($_POST['rx_notes'] ?? '');

    if (empty($name) || empty($phone)) {
        wp_send_json_error(['msg' => 'Please fill in your name and phone number.']);
    }

    if (empty($_FILES['rx_file']) || ($_FILES['rx_file']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        wp_send_json_error(['msg' => 'Please attach your prescription file.']);
    }

    $file = $_FILES['rx_file'];

    // Validate file type against what the dropzone advertises (JPG, PNG, PDF, DOC, DOCX).
    $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
    $ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );
    if ( ! in_array( $ext, $allowed_ext, true ) ) {
        wp_send_json_error(['msg' => 'Unsupported file type. Please upload a JPG, PNG, PDF, DOC or DOCX file.']);
    }

    // Validate file size against the 5MB limit shown in the UI.
    $max_bytes = 5 * 1024 * 1024;
    if ( $file['size'] > $max_bytes ) {
        wp_send_json_error(['msg' => 'File is too large. Maximum size is 5MB.']);
    }

    require_once ABSPATH . 'wp-admin/includes/file.php';

    // overrides: skip the default "form submitted from this page" referer
    // check (already covered by check_ajax_referer above) and let our
    // extension whitelist above be the source of truth.
    $upload_overrides = [ 'test_form' => false ];
    $uploaded = wp_handle_upload( $file, $upload_overrides );

    if ( isset( $uploaded['error'] ) ) {
        wp_send_json_error(['msg' => 'Upload failed. Please try again or contact us via WhatsApp.']);
    }

    // Sent to both the general pharmacy inbox and the owner's personal
    // email, branded to match the logo/order/contact email colors (was
    // plain text, single recipient, before).
    $to      = array_values( array_unique( array_filter( [
        leshavin_email(),
        'ongodojames1@gmail.com',
    ] ) ) );
    $subject = "New Prescription Submission from {$name}";
    $body    = leshavin_build_admin_prescription_email_html( $name, $phone, $notes, basename( $uploaded['file'] ) );
    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $attachments = [ $uploaded['file'] ];

    $sent = wp_mail( $to, $subject, $body, $headers, $attachments );

    if ( $sent ) {
        wp_send_json_success(['msg' => 'Prescription received.']);
    } else {
        wp_send_json_error(['msg' => 'Could not send your prescription. Please try again or contact us via WhatsApp.']);
    }
}
add_action('wp_ajax_leshavin_submit_prescription',        'leshavin_submit_prescription_handler');
add_action('wp_ajax_nopriv_leshavin_submit_prescription', 'leshavin_submit_prescription_handler');

// ─── ORDER CONFIRMATION EMAIL (HTML, own content) ──────────
// Built specifically for Leshavin Pharmacy. Simple layout, no borrowed
// wording or branding from any other pharmacy site, and no em dashes.
// Only used for website "Place Order" orders — see the via-check in
// leshavin_send_order_handler() below.
if ( ! function_exists( 'leshavin_build_order_email_html' ) ) {
    function leshavin_build_order_email_html( $order, $first_name ) {
        $tagline  = leshavin_tagline();
        $phone    = leshavin_phone();
        $wa       = leshavin_wa();
        $to_email = leshavin_email();
        $site_url = home_url( '/' );
        $tel_href = preg_replace( '/\s+/', '', $phone );

        $rows = '';
        foreach ( $order->get_items() as $item ) {
            $rows .= '<tr>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#1c2b3a;font-size:14px;">' . esc_html( $item->get_name() ) . '</td>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#6b7c8f;font-size:14px;text-align:center;">' . esc_html( $item->get_quantity() ) . '</td>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#125a94;font-weight:700;font-size:14px;text-align:right;">KSh ' . number_format( (float) $order->get_line_total( $item, false, false ), 2 ) . '</td>'
                . '</tr>';
        }

        $shipping_total = (float) $order->get_shipping_total();
        if ( $shipping_total > 0 ) {
            $rows .= '<tr>'
                . '<td colspan="2" style="padding:10px 0;color:#6b7c8f;font-size:14px;">Delivery Fee</td>'
                . '<td style="padding:10px 0;color:#1c2b3a;font-weight:600;font-size:14px;text-align:right;">KSh ' . number_format( $shipping_total, 2 ) . '</td>'
                . '</tr>';
        }

        $total = number_format( (float) $order->get_total(), 2 );

        ob_start();
        ?>
<div style="font-family:Arial,Helvetica,sans-serif;background:#f6f7fb;padding:24px;">
  <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e7ebf1;">

    <div style="background:#0e2358;padding:26px 28px;text-align:center;">
      <div style="color:#ffffff;font-size:20px;font-weight:700;">Leshavin Pharmacy</div>
      <div style="color:#a9b6d1;font-size:13px;margin-top:4px;"><?php echo esc_html( $tagline ); ?></div>
    </div>

    <div style="padding:28px;">
      <h2 style="color:#0e2358;font-size:18px;margin:0 0 10px;">Order Confirmed</h2>
      <p style="color:#6b7c8f;font-size:14px;line-height:1.6;margin:0 0 18px;">
        Thank you, <strong><?php echo esc_html( $first_name ); ?></strong>. We have received your order and will contact you shortly to confirm delivery.
      </p>

      <div style="display:inline-block;background:#f8f9fc;border:1px solid #e7ebf1;border-radius:20px;padding:6px 16px;color:#0e2358;font-weight:700;font-size:13px;margin-bottom:20px;">
        Order #<?php echo esc_html( $order->get_id() ); ?>
      </div>

      <table style="width:100%;border-collapse:collapse;margin-bottom:18px;">
        <thead>
          <tr>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;">Product</td>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;text-align:center;">Qty</td>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;text-align:right;">Total</td>
          </tr>
        </thead>
        <tbody>
          <?php echo $rows; ?>
        </tbody>
      </table>

      <table style="width:100%;border-collapse:collapse;margin-bottom:22px;">
        <tr>
          <td style="color:#0e2358;font-weight:700;font-size:15px;">Order Total</td>
          <td style="color:#6ea82e;font-weight:700;font-size:18px;text-align:right;">KSh <?php echo esc_html( $total ); ?></td>
        </tr>
      </table>

      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-left:4px solid #8dc63f;border-radius:8px;padding:14px 16px;margin-bottom:22px;">
        <div style="color:#0e2358;font-weight:700;font-size:13px;margin-bottom:4px;">Payment</div>
        <div style="color:#6b7c8f;font-size:13px;line-height:1.6;">Pay by Cash or M-Pesa when your order is delivered.</div>
      </div>

      <div style="margin-bottom:22px;">
        <div style="color:#0e2358;font-weight:700;font-size:14px;margin-bottom:10px;">What happens next</div>
        <div style="color:#6b7c8f;font-size:13px;line-height:1.8;">
          1. Our pharmacist checks your order and confirms availability.<br>
          2. We call or WhatsApp you on <?php echo esc_html( $phone ); ?> to confirm your delivery details.<br>
          3. Your order is delivered to your address.
        </div>
      </div>

      <div style="text-align:center;">
        <a href="https://wa.me/<?php echo esc_attr( $wa ); ?>" style="display:inline-block;background:#25d366;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">Chat on WhatsApp</a>
        <a href="tel:<?php echo esc_attr( $tel_href ); ?>" style="display:inline-block;background:#0e2358;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">Call Us</a>
      </div>
    </div>

    <div style="background:#f8f9fc;padding:18px 28px;text-align:center;border-top:1px solid #e7ebf1;">
      <div style="color:#6b7c8f;font-size:12px;line-height:1.6;">
        Leshavin Pharmacy. <?php echo esc_html( $tagline ); ?><br>
        <?php echo esc_html( $phone ); ?> | <?php echo esc_html( $to_email ); ?><br>
        <a href="<?php echo esc_url( $site_url ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $site_url ); ?></a>
      </div>
      <div style="color:#9aa8b8;font-size:11px;margin-top:10px;">This is an automated order confirmation. Please do not reply to this email.</div>
    </div>

  </div>
</div>
        <?php
        return ob_get_clean();
    }
}

// ─── ADMIN / OWNER ORDER NOTIFICATION EMAIL (HTML, branded) ──────────
// Same navy / green / blue palette as the customer confirmation and
// the logo, but framed as an internal "New Order Received" alert with
// full customer contact + delivery details up top, since that's what
// the pharmacy team needs to act on the order.
if ( ! function_exists( 'leshavin_build_admin_order_email_html' ) ) {
    function leshavin_build_admin_order_email_html( $order, $first_name, $last_name, $phone, $email, $address, $city, $state_label, $postcode, $notes, $via ) {
        $tagline  = leshavin_tagline();
        $site_url = home_url( '/' );
        $via_label = ( $via === 'whatsapp' ) ? 'WhatsApp Order Button' : 'Website Checkout';

        $rows = '';
        foreach ( $order->get_items() as $item ) {
            $rows .= '<tr>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#1c2b3a;font-size:14px;">' . esc_html( $item->get_name() ) . '</td>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#6b7c8f;font-size:14px;text-align:center;">' . esc_html( $item->get_quantity() ) . '</td>'
                . '<td style="padding:10px 0;border-bottom:1px solid #e7ebf1;color:#125a94;font-weight:700;font-size:14px;text-align:right;">KSh ' . number_format( (float) $order->get_line_total( $item, false, false ), 2 ) . '</td>'
                . '</tr>';
        }

        $shipping_total = (float) $order->get_shipping_total();
        if ( $shipping_total > 0 ) {
            $rows .= '<tr>'
                . '<td colspan="2" style="padding:10px 0;color:#6b7c8f;font-size:14px;">Delivery Fee</td>'
                . '<td style="padding:10px 0;color:#1c2b3a;font-weight:600;font-size:14px;text-align:right;">KSh ' . number_format( $shipping_total, 2 ) . '</td>'
                . '</tr>';
        }

        $total     = number_format( (float) $order->get_total(), 2 );
        $full_name = trim( $first_name . ' ' . $last_name );
        $wa_digits = leshavin_wa_digits( $phone );

        ob_start();
        ?>
<div style="font-family:Arial,Helvetica,sans-serif;background:#f6f7fb;padding:24px;">
  <div style="max-width:560px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e7ebf1;">

    <div style="background:#0e2358;padding:26px 28px;text-align:center;border-top:4px solid #8dc63f;">
      <div style="color:#ffffff;font-size:20px;font-weight:700;">Leshavin Pharmacy</div>
      <div style="color:#a9b6d1;font-size:13px;margin-top:4px;"><?php echo esc_html( $tagline ); ?></div>
    </div>

    <div style="padding:28px;">
      <div style="display:inline-block;background:#f8f9fc;border:1px solid #e7ebf1;border-radius:20px;padding:6px 16px;color:#0e2358;font-weight:700;font-size:12px;margin-bottom:16px;">
        <?php echo esc_html( $via_label ); ?> &nbsp;|&nbsp; Order #<?php echo esc_html( $order->get_id() ); ?>
      </div>

      <h2 style="color:#0e2358;font-size:18px;margin:0 0 18px;">New Order Received</h2>

      <div style="background:#f8f9fc;border:1px solid #e7ebf1;border-radius:10px;padding:16px 18px;margin-bottom:20px;">
        <div style="color:#0e2358;font-weight:700;font-size:13px;margin-bottom:10px;text-transform:uppercase;letter-spacing:.03em;">Customer Details</div>
        <table style="width:100%;border-collapse:collapse;">
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;width:110px;">Name</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;font-weight:700;"><?php echo esc_html( $full_name ); ?></td></tr>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Phone</td><td style="padding:4px 0;font-size:13px;"><a href="tel:<?php echo esc_attr( $phone ); ?>" style="color:#1c75bc;font-weight:700;text-decoration:none;"><?php echo esc_html( $phone ); ?></a></td></tr>
          <?php if ( $email ) : ?>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;">Email</td><td style="padding:4px 0;font-size:13px;"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $email ); ?></a></td></tr>
          <?php endif; ?>
          <tr><td style="padding:4px 0;color:#6b7c8f;font-size:13px;vertical-align:top;">Address</td><td style="padding:4px 0;color:#1c2b3a;font-size:13px;"><?php echo esc_html( trim( $address . ', ' . $city . ', ' . $state_label . ( $postcode ? ' ' . $postcode : '' ) ) ); ?></td></tr>
        </table>
      </div>

      <table style="width:100%;border-collapse:collapse;margin-bottom:18px;">
        <thead>
          <tr>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;">Product</td>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;text-align:center;">Qty</td>
            <td style="font-size:12px;color:#6b7c8f;text-transform:uppercase;padding-bottom:8px;border-bottom:2px solid #e7ebf1;text-align:right;">Total</td>
          </tr>
        </thead>
        <tbody>
          <?php echo $rows; ?>
        </tbody>
      </table>

      <table style="width:100%;border-collapse:collapse;margin-bottom:22px;">
        <tr>
          <td style="color:#0e2358;font-weight:700;font-size:15px;">Order Total</td>
          <td style="color:#6ea82e;font-weight:700;font-size:18px;text-align:right;">KSh <?php echo esc_html( $total ); ?></td>
        </tr>
      </table>

      <?php if ( $notes ) : ?>
      <div style="background:#fff9ec;border:1px solid #f0dfa8;border-left:4px solid #f5a623;border-radius:8px;padding:12px 16px;margin-bottom:22px;">
        <div style="color:#8a6300;font-weight:700;font-size:12px;text-transform:uppercase;margin-bottom:4px;">Customer Notes</div>
        <div style="color:#6b7c8f;font-size:13px;line-height:1.6;"><?php echo esc_html( $notes ); ?></div>
      </div>
      <?php endif; ?>

      <div style="text-align:center;">
        <?php if ( $wa_digits ) : ?>
        <a href="https://wa.me/<?php echo esc_attr( $wa_digits ); ?>" style="display:inline-block;background:#25d366;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">WhatsApp Customer</a>
        <?php endif; ?>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=wc-orders&action=edit&id=' . $order->get_id() ) ); ?>" style="display:inline-block;background:#0e2358;color:#ffffff;text-decoration:none;font-weight:700;font-size:14px;padding:12px 22px;border-radius:8px;margin:0 6px 10px;">View Order in WooCommerce</a>
      </div>
    </div>

    <div style="background:#f8f9fc;padding:18px 28px;text-align:center;border-top:1px solid #e7ebf1;">
      <div style="color:#6b7c8f;font-size:12px;line-height:1.6;">
        Automated order notification from Leshavin Pharmacy<br>
        <a href="<?php echo esc_url( $site_url ); ?>" style="color:#1c75bc;text-decoration:none;"><?php echo esc_html( $site_url ); ?></a>
      </div>
    </div>

  </div>
</div>
        <?php
        return ob_get_clean();
    }
}

// ─── AJAX: SEND ORDER (CHECKOUT) ───────────────
// FIX: page-checkout.php's JS posts action=leshavin_send_order for both
// "Place Order" and "Order Via WhatsApp", but until now there was no
// wp_ajax_/wp_ajax_nopriv_ hook registered for that action. admin-ajax.php
// therefore had nothing to route the request to and returned a bare "0"
// with a 400 status, which the checkout JS could not parse as JSON —
// every "Place Order" click fell into the generic error message.
//
// This handler creates a real WooCommerce order (pay on delivery, no
// gateway needed) and empties the cart, for BOTH the website and
// WhatsApp flows. It then flushes the JSON response back to the browser
// immediately (before sending any email), so the checkout page can reset
// to its normal state right away instead of waiting on wp_mail(), which
// is often the slow part of the request.
//
// Emails:
//   - The pharmacy inbox (leshavin_email()) always gets a short plain
//     text notification, whichever button was used, so no order is missed.
//   - The customer only gets the full HTML confirmation email when they
//     used "Place Order". WhatsApp orders are confirmed in the chat
//     itself, so no confirmation email is sent for that path.
function leshavin_send_order_handler() {
    check_ajax_referer( 'leshavin_order_nonce', 'leshavin_order_nonce' );

    if ( ! function_exists('WC') || ! WC()->cart || WC()->cart->is_empty() ) {
        wp_send_json_error(['msg' => 'Your cart is empty.']);
    }

    $first    = sanitize_text_field( $_POST['billing_first_name'] ?? '' );
    $last     = sanitize_text_field( $_POST['billing_last_name']  ?? '' );
    $phone    = sanitize_text_field( $_POST['billing_phone']      ?? '' );
    $email    = sanitize_email( $_POST['billing_email']           ?? '' );
    $state    = sanitize_text_field( $_POST['billing_state']      ?? '' );
    $address  = sanitize_textarea_field( $_POST['billing_address_1'] ?? '' );
    $city     = sanitize_text_field( $_POST['billing_city']       ?? '' );
    $postcode = sanitize_text_field( $_POST['billing_postcode']   ?? '' );
    $notes    = sanitize_textarea_field( $_POST['order_comments'] ?? '' );
    $via      = sanitize_text_field( $_POST['order_via']          ?? 'website' );

    if ( empty($first) || empty($phone) || empty($state) || empty($address) || empty($city) ) {
        wp_send_json_error(['msg' => 'Please fill in all required fields.']);
    }

    $order = wc_create_order();

    foreach ( WC()->cart->get_cart() as $item ) {
        $order->add_product( $item['data'], $item['quantity'] );
    }

    $order->set_address( [
        'first_name' => $first,
        'last_name'  => $last,
        'phone'      => $phone,
        'email'      => $email,
        'state'      => $state,
        'address_1'  => $address,
        'city'       => $city,
        'postcode'   => $postcode,
        'country'    => 'KE',
    ], 'billing' );

    if ( $notes ) {
        $order->set_customer_note( $notes );
    }

    $order->set_payment_method( 'cod' );
    $order->set_payment_method_title( 'Cash / M-Pesa on Delivery' );
    $order->calculate_totals();
    $order->update_status( 'processing', sprintf( 'Order placed via %s checkout.', $via ) );
    $order->save();

    $order_id = $order->get_id();

    // Empty the cart on the server for every order, regardless of which
    // button was used to place it.
    WC()->cart->empty_cart();

    // Send the JSON response to the browser right away so the page can
    // start resetting immediately, instead of waiting for email sending
    // (which can be slow) to finish first.
    $response = [ 'success' => true, 'data' => [ 'order_id' => $order_id ] ];
    if ( ! headers_sent() ) {
        header( 'Content-Type: application/json; charset=UTF-8' );
    }
    echo wp_json_encode( $response );
    if ( function_exists( 'fastcgi_finish_request' ) ) {
        fastcgi_finish_request();
    } else {
        if ( ob_get_level() > 0 ) { ob_end_flush(); }
        flush();
    }

    // ── Pharmacy / owner notification: always sent, whichever button was used ──
    // Sent to both the general pharmacy inbox and the owner's personal
    // email, fully branded to match the logo/customer email colors.
    $ck_states   = function_exists('WC') ? WC()->countries->get_states('KE') : [];
    $state_label = ( $state && isset( $ck_states[ $state ] ) ) ? $ck_states[ $state ] : $state;

    $admin_to      = array_values( array_unique( array_filter( [
        leshavin_email(),
        'ongodojames1@gmail.com',
    ] ) ) );
    $admin_subject = sprintf( 'New Order #%d - %s %s | Leshavin Pharmacy', $order_id, $first, $last );
    $admin_body    = leshavin_build_admin_order_email_html( $order, $first, $last, $phone, $email, $address, $city, $state_label, $postcode, $notes, $via );
    wp_mail( $admin_to, $admin_subject, $admin_body, [ 'Content-Type: text/html; charset=UTF-8' ] );

    // ── Customer confirmation: only for website "Place Order" orders ──
    if ( $via !== 'whatsapp' && $email ) {
        $customer_subject = sprintf( 'Order Confirmation - Leshavin Pharmacy #%d', $order_id );
        $customer_body    = leshavin_build_order_email_html( $order, $first );
        wp_mail( $email, $customer_subject, $customer_body, [ 'Content-Type: text/html; charset=UTF-8' ] );
    }

    exit;
}
add_action('wp_ajax_leshavin_send_order',        'leshavin_send_order_handler');
add_action('wp_ajax_nopriv_leshavin_send_order', 'leshavin_send_order_handler');

// ─────────────────────────────────────────────
// SUPPRESS ALL WOOCOMMERCE DEFAULT NOTICES
// We use our own custom toast (#leshavin-toast in front-page.php) for
// add-to-cart feedback, so WooCommerce's built-in notices (add-to-cart
// success, "removed. Undo?", stock messages, etc.) should never render
// anywhere on the site.
// ─────────────────────────────────────────────

// 1. Block the specific "X has been added to your cart" message text
// WooCommerce builds for add-to-cart (covers single + AJAX add-to-cart).
add_filter('wc_add_to_cart_message_html', '__return_false');

// 2. Block every notice added via wc_add_notice(), regardless of type
// (success/error/notice) or wording — covers add-to-cart, removed,
// undo, and any future WooCommerce core/plugin notice text.
add_filter('woocommerce_add_notice', '__return_empty_string');

// 3. Belt-and-braces: strip any notices already queued in the session
// right before they'd be rendered, in case something bypasses #1/#2.
add_filter('woocommerce_get_notices', function( $notices ) {
    return [];
});

// 4. Clear notices after cart-changing actions so nothing lingers
// across requests (add to cart, remove from cart, quantity update).
add_action('woocommerce_add_to_cart', function() {
    if ( function_exists( 'wc_clear_notices' ) ) wc_clear_notices();
}, 999);
add_action('woocommerce_cart_item_removed', function() {
    if ( function_exists( 'wc_clear_notices' ) ) wc_clear_notices();
}, 999);
add_action('woocommerce_after_cart_item_quantity_update', function() {
    if ( function_exists( 'wc_clear_notices' ) ) wc_clear_notices();
}, 999);

// ─── ADMIN SETTINGS PAGE ──────────────────────
add_action('admin_menu', function() {
    add_menu_page('Pharmacy Settings', 'Pharmacy Settings', 'manage_options',
        'leshavin-settings', 'leshavin_settings_page', 'dashicons-heart', 60);
});
function leshavin_settings_page() {
    if (isset($_POST['leshavin_save'])) {
        foreach (['leshavin_wa','leshavin_phone','leshavin_address','leshavin_tagline','leshavin_email',
                  'leshavin_facebook','leshavin_instagram','leshavin_twitter'] as $k) {
            update_option($k, sanitize_text_field($_POST[$k] ?? ''));
        }
        echo '<div style="background:#eef7e0;color:#6ea82e;padding:12px 16px;border-radius:6px;margin-bottom:16px;">Settings saved.</div>';
    }
    $f = [
        'leshavin_wa'        => ['WhatsApp Number (no + or spaces)', '254792331941'],
        'leshavin_phone'     => ['Phone (display)', '+254 792 331 941'],
        'leshavin_address'   => ['Address', 'Moi Drive, Plot No. Umoja A18, Nairobi, Kenya'],
        'leshavin_tagline'   => ['Logo Tagline', 'Reliable Care At Your Doorstep'],
        'leshavin_email'     => ['Contact Email', 'info@leshavinpharmacy.com'],
        'leshavin_facebook'  => ['Facebook URL', '#'],
        'leshavin_instagram' => ['Instagram URL', '#'],
        'leshavin_twitter'   => ['Twitter / X URL', '#'],
    ];
    echo '<div class="wrap"><h1>Leshavin Pharmacy Settings</h1><form method="post" style="max-width:600px;margin-top:20px;"><table class="form-table">';
    foreach ($f as $key => [$label, $default]) {
        $val = get_option($key, $default);
        echo "<tr><th>{$label}</th><td><input type='text' name='{$key}' value='" . esc_attr($val) . "' class='regular-text'></td></tr>";
    }
    echo '</table>';
    submit_button('Save Settings', 'primary', 'leshavin_save');
    echo '</form></div>';
}

// ─── SCHEMA MARKUP ────────────────────────────
add_action('wp_head', function() {
    if (is_front_page()) {
        echo '<script type="application/ld+json">' . json_encode([
            '@context'  => 'https://schema.org', '@type' => 'Pharmacy',
            'name'      => get_bloginfo('name'),
            'url'       => home_url('/'),
            'telephone' => leshavin_phone(),
            'email'     => leshavin_email(),
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => 'Moi Drive, Plot No. Umoja A18',
                'addressLocality' => 'Nairobi',
                'addressCountry'  => 'KE',
            ],
        ]) . '</script>';
    }
    if (is_singular('product')) {
        // NOTE: don't rely on global $product here — wp_head() fires
        // before the theme's main loop runs the_post(), which is what
        // WooCommerce hooks into to populate the global. Fetch the
        // product directly instead, and verify its type before use.
        $product = wc_get_product( get_the_ID() );
        if ( ! $product instanceof WC_Product ) return;
        echo '<script type="application/ld+json">' . json_encode([
            '@context' => 'https://schema.org', '@type' => 'Product',
            'name'     => $product->get_name(),
            'image'    => wp_get_attachment_url($product->get_image_id()),
            'offers'   => [
                '@type'         => 'Offer',
                'price'         => $product->get_price(),
                'priceCurrency' => 'KES',
                'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ],
        ]) . '</script>';
    }
});

// ─── MISC ─────────────────────────────────────
add_filter('excerpt_length', fn() => 18, 999);
add_filter('excerpt_more', fn() => '…');
