<?php get_header(); ?>

<main>

  <!-- Fields for the Hero Section + Hero Boxes -->
  <?php
  $hero_title = carbon_get_post_meta(get_the_ID(), 'hero_title');
  $hero_description = carbon_get_post_meta(get_the_ID(), 'hero_description');
  ?>

  <!-- HERO SECTION -->
  <section class="estatein-hero">

    <!-- BADGE in the middle -->
    <a href="<?php echo esc_url(home_url('/properties')); ?>" class="hero-badge">
      <img
        class="rotating-hero-circle"
        src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-circle-middle.svg"
        alt=""
      />
      <img
        class="static-arrow-hero"
        src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-arrow-middle.svg"
        alt=""
      />
    </a>

    <!-- Hero -->
    <div class="container">
      <div class="row align-items-center">

        <!-- Mobile Hero Image since the design is different -->
        <div class="col-12 d-block d-md-none">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('full', [
              'class' => 'img-fluid hero-image-mobile',
              'alt'   => get_the_title()
            ]); ?>
          <?php endif; ?>

          <a href="<?php echo esc_url(home_url('/properties')); ?>">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-badge-mobile.svg"
              alt=""
              class="img-fluid hero-badge-mobile"
            />
          </a>
        </div>

        <!-- Hero TEXT -->
        <div class="col-md-6">
          <div class="estatein-hero-content">

            <h1><?php echo esc_html($hero_title); ?></h1>

            <p><?php echo esc_html($hero_description); ?></p>

            <?php $buttons = carbon_get_post_meta(get_the_ID(), 'hero_buttons'); ?>

            <!-- Hero Buttons -->
            <div class="estatein-hero-buttons">

              <?php if (!empty($buttons)): ?>
                <?php foreach ($buttons as $btn): ?>

                  <?php
                    $class = ($btn['style'] === 'brand') ? 'btn-brand' : 'btn-outline';
                  ?>

                  <a href="<?php echo esc_url($btn['link']); ?>" class="<?php echo $class; ?>">
                    <?php echo esc_html($btn['text']); ?>
                  </a>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

            <!-- Hero Stats -->
            <?php $stats = carbon_get_post_meta(get_the_ID(), 'hero_stats'); ?>

            <div class="estatein-hero-stats row">

              <?php if (!empty($stats)): ?>
                <?php foreach ($stats as $index => $stat): ?>

                  <?php
                    // păstrăm layout-ul original
                    $col_class = ($index == 2) 
                      ? 'col-12 col-xl-4 g-3 mt-xl-0'
                      : 'col-6 col-xl-4 g-3 mt-0';
                  ?>

                  <div class="<?php echo $col_class; ?>">
                    <div class="stat-box">
                      <h3><?php echo esc_html($stat['number']); ?></h3>
                      <span><?php echo esc_html($stat['text']); ?></span>
                    </div>
                  </div>

                <?php endforeach; ?>
              <?php endif; ?>

            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- IMAGE DESKTOP -->
    <div class="estatein-hero-image">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', [
          'class' => 'img-fluid',
          'alt'   => get_the_title()
        ]); ?>
      <?php endif; ?>
    </div>

  </section>

  

  <!-- HERO BOXES -->
  <section class="hero-boxes-wrapper">
    <div class="container-fluid g-0">
      <div class="hero-boxes-inner">
        <div class="row">
          <?php $hero_boxes = carbon_get_post_meta(get_the_ID(), 'hero_boxes'); ?>
          <?php if (!empty($hero_boxes)): ?>
            <?php foreach ($hero_boxes as $index => $box): ?>

              <?php
                $mt_class = ($index >= 2) ? 'mt-lg-0' : 'mt-0';
              ?>

              <div class="col-6 col-lg-3 g-3 <?php echo $mt_class; ?>">
                <a href="<?php echo esc_url($box['link']); ?>" class="hero-box">

                  <?php if (!empty($box['icon'])): ?>
                    <img
                      src="<?php echo esc_url(wp_get_attachment_url($box['icon'])); ?>"
                      class="icon-main"
                      alt=""
                    />
                  <?php endif; ?>

                  <img
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-hero-boxes.svg"
                    class="icon-arrow"
                    alt=""
                  />

                  <p><?php echo esc_html($box['text']); ?></p>

                </a>
              </div>

            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </section>


  <!-- FEATURED PROPERTIES  CPT -->
  <section class="section-top-spacing">
    <div class="container">

      <!-- Bring all the necesarry fields -->
      <?php
      $featured_title = carbon_get_post_meta(get_the_ID(), 'featured_title');
      $featured_desc  = carbon_get_post_meta(get_the_ID(), 'featured_description');
      $featured_btn_text = carbon_get_post_meta(get_the_ID(), 'featured_btn_text');
      $featured_btn_link = carbon_get_post_meta(get_the_ID(), 'featured_btn_link');
      ?>

      <!-- Section Header Template -->
      <div class="section-header row align-items-end gy-4">

        <!-- LEFT -->
        <div class="col-12 col-lg-8">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/section-stars.svg"
            class="section-header-stars"
            alt=""
          />

          <h2 class="section-header-title">
            <?php echo esc_html($featured_title); ?>
          </h2>

          <p class="section-header-desc">
            <?php echo esc_html($featured_desc); ?>
          </p>
        </div>

        <!-- RIGHT -->
        <div class="col-12 col-lg-4 text-lg-end d-none d-md-block">

          <?php if ($featured_btn_text && $featured_btn_link): ?>
            <a href="<?php echo esc_url($featured_btn_link); ?>" class="btn-outline-gray">
              <?php echo esc_html($featured_btn_text); ?>
            </a>
          <?php endif; ?>

        </div>

      </div>

      <!-- SWIPER -->
      <div class="swiper propertySwiper">
        <div class="swiper-wrapper">

          <!-- GET ALL PROPERTIES IN SLIDER -->
          <?php
          $args = [
              'post_type' => 'property',
              'posts_per_page' => 6, // sau 4 dacă vrei
          ];

          $query = new WP_Query($args);
          ?>

          <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>

              <?php
              $price = carbon_get_post_meta(get_the_ID(), 'property_price');
              $short_desc = carbon_get_post_meta(get_the_ID(), 'property_short_desc');
              $bedrooms = carbon_get_post_meta(get_the_ID(), 'property_bedrooms');
              $bathrooms = carbon_get_post_meta(get_the_ID(), 'property_bathrooms');
              $type = carbon_get_post_meta(get_the_ID(), 'property_type');
              ?>

              <!-- CARD -->
              <div class="swiper-slide">
                <div class="property-card">

                  <!-- IMAGE -->
                  <?php if (has_post_thumbnail()): ?>
                    <?php the_post_thumbnail('medium', ['class' => 'property-img']); ?>
                  <?php endif; ?>

                  <!-- TITLE + DESC -->
                  <div>
                    <h3><?php the_title(); ?></h3>

                    <p>
                      <?php echo esc_html(wp_trim_words($short_desc, 15)); ?>
                      <a href="<?php the_permalink(); ?>">Read More</a>
                    </p>
                  </div>

                  <!-- CATEGORY -->
                  <div class="property-card-category">

                    <?php if ($bedrooms): ?>
                      <a href="#">
                        <img
                          src="<?php echo get_template_directory_uri(); ?>/assets/images/bed-icon.svg"
                          alt=""
                        />
                        <?php echo esc_html($bedrooms); ?>-Bedroom
                      </a>
                    <?php endif; ?>

                    <?php if ($bathrooms): ?>
                      <a href="#">
                        <img
                          src="<?php echo get_template_directory_uri(); ?>/assets/images/bath-icon.svg"
                          alt=""
                        />
                        <?php echo esc_html($bathrooms); ?>-Bathroom
                      </a>
                    <?php endif; ?>

                    <?php if ($type): ?>
                      <a href="#">
                        <img
                          src="<?php echo get_template_directory_uri(); ?>/assets/images/block-icon.svg"
                          alt=""
                        />
                        <?php echo esc_html(ucfirst($type)); ?>
                      </a>
                    <?php endif; ?>

                  </div>

                  <!-- PRICE + BUTTON -->
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <small class="property-card-price-small d-block">Price</small>
                      <span class="property-card-price">
                        $<?php echo esc_html($price); ?>
                      </span>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="btn btn-brand">
                      View Property Details
                    </a>
                  </div>

                </div>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          <?php endif; ?>
        
        </div>
      </div>

      <!-- Swiper footer with count -->
      <div
        class="slider-footer d-flex justify-content-between align-items-center"
      >
        <!-- COUNTER -->
        <div class="slider-counter d-none d-md-block">
          <span class="currentSlide">01</span> of
          <span class="totalSlides">06</span>
        </div>

        
        <?php if ($featured_btn_text && $featured_btn_link): ?>
          <a href="<?php echo esc_url($featured_btn_link); ?>" class="btn-outline-gray d-block d-md-none">
            <?php echo esc_html($featured_btn_text); ?>
          </a>
        <?php endif; ?>

        <!-- NAVIGATION -->
        <div class="slider-general-nav d-flex gap-2">
          <button class="nav-btn prev-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-left.svg"
              alt="Swiper Arrow Left"
            />
          </button>
          <div
            class="slider-counter slider-counter-mobile d-flex d-md-none"
          >
            <span class="currentSlide">01</span> of
            <span class="totalSlides">06</span>
          </div>

          <!-- Button for mobile since the design is different -->
          <button class="nav-btn next-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-right.svg"
              alt="Swiper Arrow Right"
            />
          </button>
        </div>
      </div>
    </div>
  </section>

   <!-- Testimonials -->
  <section class="section-top-spacing">
    <div class="container">
      <?php
      $testimonials_title = carbon_get_post_meta(get_the_ID(), 'testimonials_title');
      $testimonials_desc  = carbon_get_post_meta(get_the_ID(), 'testimonials_description');
      $testimonials_btn_text = carbon_get_post_meta(get_the_ID(), 'testimonials_btn_text');
      $testimonials_btn_link = carbon_get_post_meta(get_the_ID(), 'testimonials_btn_link');
      ?>

      <!-- Section Header Template -->
      <div class="section-header row align-items-end gy-4">

        <!-- LEFT -->
        <div class="col-12 col-lg-8">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/section-stars.svg"
            class="section-header-stars"
            alt=""
          />

          <h2 class="section-header-title">
            <?php echo esc_html($testimonials_title); ?>
          </h2>

          <p class="section-header-desc">
            <?php echo esc_html($testimonials_desc); ?>
          </p>
        </div>

        <!-- RIGHT -->
        <div class="col-12 col-lg-4 text-lg-end d-none d-md-block">

          <?php if ($testimonials_btn_text && $testimonials_btn_link): ?>
            <a href="<?php echo esc_url($testimonials_btn_link); ?>" class="btn-outline-gray">
              <?php echo esc_html($testimonials_btn_text); ?>
            </a>
          <?php endif; ?>

        </div>

      </div>
      

      <!-- SWIPER -->
      <div class="swiper testimonialSwiper">
        <div class="swiper-wrapper">
          <!-- CARD -->
          <?php
          $args = [
              'post_type' => 'testimonial',
              'posts_per_page' => 6,
          ];

          $query = new WP_Query($args);
          ?>

          <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()): $query->the_post(); ?>

              <?php
              $rating = carbon_get_post_meta(get_the_ID(), 'testimonial_rating');
              $name = carbon_get_post_meta(get_the_ID(), 'testimonial_name');
              $location = carbon_get_post_meta(get_the_ID(), 'testimonial_location');
              ?>

              <div class="swiper-slide">
                <div class="testimonial-card">

                  <!-- RATING -->
                  <div class="review-rating">
                    <?php for ($i = 0; $i < $rating; $i++): ?>
                      <img
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/review-star.svg"
                        alt="Star"
                        class="img-fluid"
                      />
                    <?php endfor; ?>
                  </div>

                  <!-- CONTENT -->
                  <div class="testimonial-content">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_content(); ?></p>
                  </div>

                  <!-- PERSON -->
                  <div class="testimonial-person">

                    <?php if (has_post_thumbnail()): ?>
                      <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid']); ?>
                    <?php endif; ?>

                    <div>
                      <p><?php echo esc_html($name); ?></p>
                      <span><?php echo esc_html($location); ?></span>
                    </div>

                  </div>

                </div>
              </div>

            <?php endwhile; wp_reset_postdata(); ?>
          <?php endif; ?>
          
        </div>
      </div>

      <!-- FOOTER  with count-->
      <div class="slider-footer d-flex justify-content-between align-items-center">

        <!-- COUNTER -->
        <div class="slider-counter d-none d-md-block">
          <span class="currentSlide">01</span> of
          <span class="totalSlides">06</span>
        </div>

       
        <?php if ($featured_btn_text && $featured_btn_link): ?>
          <a href="<?php echo esc_url($testimonials_btn_link); ?>" class="btn-outline-gray d-block d-md-none">
            <?php echo esc_html($testimonials_btn_text); ?>
          </a>
        <?php endif; ?>

        <!-- NAVIGATION -->
        <div class="slider-general-nav d-flex gap-2">
          <button class="nav-btn prev-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-left.svg"
              alt="Swiper Arrow Left"
            />
          </button>
          <div
            class="slider-counter slider-counter-mobile d-flex d-md-none"
          >
            <span class="currentSlide">01</span> of
            <span class="totalSlides">06</span>
          </div>

          <!-- Button for mobile since design is different -->
          <button class="nav-btn next-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-right.svg"
              alt="Swiper Arrow Right"
            />
          </button>
        </div>
      </div>

    </div>
  </section>

   <!-- FAQ -->
  <section class="section-top-spacing">
    <div class="container">
      
      <?php
      $faq_title = carbon_get_post_meta(get_the_ID(), 'faq_title');
      $faq_desc  = carbon_get_post_meta(get_the_ID(), 'faq_description');
      $faq_btn_text = carbon_get_post_meta(get_the_ID(), 'faq_btn_text');
      $faq_btn_link = carbon_get_post_meta(get_the_ID(), 'faq_btn_link');
      ?>

      <!-- Section Header Template -->
      <div class="section-header row align-items-end gy-4">

        <!-- LEFT -->
        <div class="col-12 col-lg-8">
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/section-stars.svg"
            class="section-header-stars"
            alt=""
          />

          <h2 class="section-header-title">
            <?php echo esc_html($faq_title); ?>
          </h2>

          <p class="section-header-desc">
            <?php echo esc_html($faq_desc); ?>
          </p>
        </div>

        <!-- RIGHT -->
        <div class="col-12 col-lg-4 text-lg-end d-none d-md-block">

          <?php if ($faq_btn_text && $faq_btn_link): ?>
            <a href="<?php echo esc_url($faq_btn_link); ?>" class="btn-outline-gray">
              <?php echo esc_html($faq_btn_text); ?>
            </a>
          <?php endif; ?>

        </div>

      </div>

      <!-- SWIPER -->
      <div class="swiper faqSwiper">
        <?php $faqs = carbon_get_post_meta(get_the_ID(), 'faq_items'); ?>

        <?php if (!empty($faqs)): ?>

          <div class="swiper-wrapper">

            <?php foreach ($faqs as $faq): ?>

              <div class="swiper-slide">
                <div class="faq-card">

                  <h3>
                    <?php echo esc_html($faq['question']); ?>
                  </h3>

                  <p>
                    <?php echo esc_html($faq['answer']); ?>
                  </p>

                </div>
              </div>

            <?php endforeach; ?>

          </div>

        <?php endif; ?>
      </div>

      <!-- FOOTER with count-->
      <div
        class="slider-footer d-flex justify-content-between align-items-center"
      >
        <!-- COUNTER -->
        <div class="slider-counter d-none d-md-block">
          <span class="currentSlide">01</span> of
          <span class="totalSlides">06</span>
        </div>

      
        <?php if ($faq_btn_text && $faq_btn_link): ?>
          <a href="<?php echo esc_url($faq_btn_link); ?>" class="btn-outline-gray d-block d-md-none">
            <?php echo esc_html($faq_btn_text); ?> 
          </a>
        <?php endif; ?>

        <!-- NAVIGATION -->
        <div class="slider-general-nav d-flex gap-2">
          <button class="nav-btn prev-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-left.svg"
              alt="Swiper Arrow Left"
            />
          </button>
          <div
            class="slider-counter slider-counter-mobile d-flex d-md-none"
          >
            <span class="currentSlide">01</span> of
            <span class="totalSlides">06</span>
          </div>

          <!-- Button for mobile since design is different -->
          <button class="nav-btn next-btn">
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/images/swiper-arrow-right.svg"
              alt="Swiper Arrow Right"
            />
          </button>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>