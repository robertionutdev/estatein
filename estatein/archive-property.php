<?php get_header(); ?>


<!-- JUST FOR DEMO -->
<main class="properties-archive py-5">

  <div class="container">

    <!-- HEADER -->
    <div class="mb-5 text-center">
      <h1>All Properties</h1>
      <p>Browse all available properties.</p>
    </div>

    <div class="row">

      <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <?php
        $price = carbon_get_post_meta(get_the_ID(), 'property_price');
        $short_desc = carbon_get_post_meta(get_the_ID(), 'property_short_desc');
        $bedrooms = carbon_get_post_meta(get_the_ID(), 'property_bedrooms');
        $bathrooms = carbon_get_post_meta(get_the_ID(), 'property_bathrooms');
        $type = carbon_get_post_meta(get_the_ID(), 'property_type');
        ?>

        <div class="col-md-6 col-lg-4 mb-4">

          <div class="property-card h-100">

            <!-- IMAGE -->
            <?php if (has_post_thumbnail()): ?>
              <?php the_post_thumbnail('medium', ['class' => 'property-img']); ?>
            <?php endif; ?>

            <!-- CONTENT -->
            
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

              <!-- PRICE -->
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

      <?php endwhile; ?>

    </div>

    <!-- PAGINATION -->
    <div class="mt-5 text-center">
      <?php the_posts_pagination(); ?>
    </div>

    <?php else: ?>

      <p>No properties found.</p>

    <?php endif; ?>

  </div>

</main>

<?php get_footer(); ?>