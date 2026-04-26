<!doctype html>
<html <?php language_attributes(); ?> >
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png" type="image/x-icon" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- HEADER -->
<header class="estatein-header">

  <!-- Bring all the necesarry fields -->
  <?php
  $topbar_text = carbon_get_theme_option('topbar_text');
  $topbar_link_text = carbon_get_theme_option('topbar_link_text');
  $topbar_link_url = carbon_get_theme_option('topbar_link_url');
  $topbar_visible = carbon_get_theme_option('topbar_visible');

  ?>
  <!-- Top bar -->
  <?php if ($topbar_visible): ?>
  <div class="estatein-topbar">
      <?php echo esc_html($topbar_text); ?>

      <a href="<?php echo esc_url($topbar_link_url); ?>">
        <?php echo esc_html($topbar_link_text); ?>
      </a>

      <span class="estatein-close">
        <img
          class="img-fluid"
          src="<?php echo get_template_directory_uri(); ?>/assets/images/close-icon-top-bar.svg"
          alt="Close Button"
        />
      </span>
  </div>
  <?php endif; ?>

  <!-- Navbar -->
  <div class="container">
    <div class="estatein-navbar d-flex align-items-center justify-content-between">

      <!-- Logo -->
      <div class="estatein-logo d-flex align-items-center">
        <a href="<?php echo home_url(); ?>">
          <img
            class="img-fluid"
            width="160"
            src="<?php echo get_template_directory_uri(); ?>/assets/images/Estatein_Logo.svg"
            alt="Logo"
          />
        </a>
      </div>

      <!-- Primary Menu -->
      <nav class="estatein-menu d-none d-lg-flex">
        <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s',
            'fallback_cb' => false
          ]);
        ?>
      </nav>
      
      <?php
        $contact_text = carbon_get_theme_option('header_contact_text');
        $contact_link = carbon_get_theme_option('header_contact_link');
      ?>
      <!-- Contact Button -->
      <div class="d-none d-lg-block">
        <a href="<?php echo esc_url($contact_link ?: home_url('/contact')); ?>" class="estatein-btn">
          <?php echo esc_html($contact_text ?: 'Contact Us'); ?>
        </a>
      </div>

      <!-- Mobile Toggle -->
      <div class="estatein-toggle d-lg-none">
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/images/menu-hamburger-icon.svg"
          alt="Menu Icon"
          class="img-fluid"
        />
      </div>

    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="estatein-mobile-menu">
    <?php
          wp_nav_menu([
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s',
            'fallback_cb' => false
          ]);
        ?>
    <a href="<?php echo esc_url($contact_link ?: home_url('/contact')); ?>" class="estatein-btn w-100"><?php echo esc_html($contact_text ?: 'Contact Us'); ?></a>
  </div>

</header>