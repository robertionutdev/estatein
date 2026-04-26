<!-- Calling all the necesarry fields -->
<?php
$cta_title = carbon_get_theme_option('footer_cta_title');
$cta_desc = carbon_get_theme_option('footer_cta_desc');
$cta_btn_text = carbon_get_theme_option('footer_cta_btn_text');
$cta_btn_link = carbon_get_theme_option('footer_cta_btn_link');

$logo = carbon_get_theme_option('footer_logo');

$facebook = carbon_get_theme_option('facebook_link');
$linkedin = carbon_get_theme_option('linkedin_link');
$twitter = carbon_get_theme_option('twitter_link');
$youtube = carbon_get_theme_option('youtube_link');

$terms = carbon_get_theme_option('terms_link');
?>

<!-- FOOTER CTA -->
<section class="footer-cta-spacing">
  <div class="container">
    <div class="section-header row align-items-center gy-4 mb-0">

      <div class="col-12 col-lg-9">
        <h2 class="section-header-title">
          <?php echo esc_html($cta_title); ?>
        </h2>

        <p class="section-header-desc">
          <?php echo esc_html($cta_desc); ?>
        </p>
      </div>

      <div class="col-12 col-lg-3 text-lg-end">
        <a href="<?php echo esc_url($cta_btn_link); ?>" class="btn-brand">
          <?php echo esc_html($cta_btn_text); ?>
        </a>
      </div>

    </div>
  </div>
</section>


<footer>
  <div class="footer">
    <div class="container">
      <div class="row align-items-start">

        <!-- Logo -->
        <div class="col-lg-4">
          <img
            src="<?php echo esc_url(wp_get_attachment_url($logo)); ?>"
            alt="Estatein Logo"
            class="footer-logo"
          />

          <!-- Contact form 7 field -->
          <div class="newsletter">
            <?php echo do_shortcode('[contact-form-7 id="b998763" title="Contact Footer"]'); ?>
          </div>
        </div>

        <!-- Columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- HOME -->
            <div class="col-md-2 col-6 footer-col">
              <div class="col-wrap-border">
                <h6>Home</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_home',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>
            </div>

            <!-- ABOUT -->
            <div class="col-md-2 col-6 footer-col">
              <div class="col-wrap-border">
                <h6>About Us</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_about',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>
            </div>

            <!-- PROPERTIES -->
            <div class="col-md-2 col-6 footer-col">
              <div class="col-wrap-border">
                <h6>Properties</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_properties',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>

              <!-- MOBILE CONTACT -->
              <div class="col-wrap-border d-block d-md-none">
                <h6>Contact Us</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_contact',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>
            </div>

            <!-- SERVICES -->
            <div class="col-md-3 col-6 footer-col">
              <div class="col-wrap-border">
                <h6>Services</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_services',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>
            </div>

            <!-- CONTACT DESKTOP -->
            <div class="col-md-3 col-6 footer-col d-none d-md-block">
              <div class="col-wrap-border">
                <h6>Contact Us</h6>
                <ul>
                  <?php wp_nav_menu([
                    'theme_location' => 'footer_contact',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'fallback_cb' => false
                  ]); ?>
                </ul>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Footer bottom bar -->
  <div class="footer-bottom-bar">
    <div class="container">
      <div class="row">
        <div class="col-12">

          <div class="footer-bottom d-flex align-items-center flex-wrap">

            <!-- Footer copy with year automatically changing -->
            <div class="footer-copy order-2 order-sm-1">
              © <?php echo date('Y'); ?> Estatein. All Rights Reserved.
              <a href="<?php echo esc_url($terms); ?>">Terms & Conditions</a>
            </div>

            <!-- Social Icons -->
            <div class="social-icons order-1 order-sm-2">
              <a target="_blank" href="<?php echo esc_url($facebook); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-icon.svg" alt="Facebook Page">
              </a>
              <a target="_blank" href="<?php echo esc_url($linkedin); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin-icon.svg" alt="Linkedin Page">
              </a>
              <a target="_blank" href="<?php echo esc_url($twitter); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-icon.svg" alt="Twitter Page">
              </a>
              <a target="_blank" href="<?php echo esc_url($youtube); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-icon.svg" alt="Youtube Page">
              </a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>