<?php get_header(); ?>



<!-- JUST FOR THE DEMO -->
<main class="property-single py-5">

  <div class="container">

    <?php if (have_posts()): while (have_posts()): the_post(); ?>

      <?php
      //Carbon Fields Data
      $price = carbon_get_post_meta(get_the_ID(), 'property_price');
      $short_desc = carbon_get_post_meta(get_the_ID(), 'property_short_desc');

      $bedrooms = carbon_get_post_meta(get_the_ID(), 'property_bedrooms');
      $bathrooms = carbon_get_post_meta(get_the_ID(), 'property_bathrooms');
      $area = carbon_get_post_meta(get_the_ID(), 'property_area');
      $year = carbon_get_post_meta(get_the_ID(), 'property_build_year');

      $type = carbon_get_post_meta(get_the_ID(), 'property_type');
      $location = carbon_get_post_meta(get_the_ID(), 'property_location');

      $gallery = carbon_get_post_meta(get_the_ID(), 'property_gallery');
      $features = carbon_get_post_meta(get_the_ID(), 'property_features');
      ?>

      <!--HEADER -->
      <div class="property-header mb-4">

        <?php if (has_post_thumbnail()): ?>
          <div class="mb-3">
            <?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
          </div>
        <?php endif; ?>

        <h1><?php the_title(); ?></h1>

        <?php if ($price): ?>
          <p class="property-price fs-4 fw-bold">
            $<?php echo esc_html($price); ?>
          </p>
        <?php endif; ?>

      </div>

      <!-- SHORT DESCRIPTION -->
      <?php if ($short_desc): ?>
        <p class="property-short-desc mb-4">
          <?php echo esc_html($short_desc); ?>
        </p>
      <?php endif; ?>

      <!-- LONG DESCRIPTION -->
      <div class="property-content mb-5">
        <?php the_content(); ?>
      </div>

      <!-- DETAILS -->
      <div class="property-details mb-5">

        <h3>Property Details</h3>

        <ul class="list-unstyled">
          <?php if ($bedrooms): ?>
            <li><strong>Bedrooms:</strong> <?php echo esc_html($bedrooms); ?></li>
          <?php endif; ?>

          <?php if ($bathrooms): ?>
            <li><strong>Bathrooms:</strong> <?php echo esc_html($bathrooms); ?></li>
          <?php endif; ?>

          <?php if ($area): ?>
            <li><strong>Area:</strong> <?php echo esc_html($area); ?> sq ft</li>
          <?php endif; ?>

          <?php if ($type): ?>
            <li><strong>Type:</strong> <?php echo esc_html($type); ?></li>
          <?php endif; ?>

          <?php if ($location): ?>
            <li><strong>Location:</strong> <?php echo esc_html($location); ?></li>
          <?php endif; ?>

          <?php if ($year): ?>
            <li><strong>Build Year:</strong> <?php echo esc_html($year); ?></li>
          <?php endif; ?>
        </ul>

      </div>

      <!-- GALLERY -->
      <?php if (!empty($gallery)): ?>
        <div class="property-gallery mb-5">

          <h3>Gallery</h3>

          <div class="row">
            <?php foreach ($gallery as $image_id): ?>
              <div class="col-md-4 mb-3">
                <img
                  src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>"
                  class="img-fluid"
                  alt=""
                />
              </div>
            <?php endforeach; ?>
          </div>

        </div>
      <?php endif; ?>

      <!-- FEATURES -->
      <?php if (!empty($features)): ?>
        <div class="property-features mb-5">

          <h3>Key Features</h3>

          <ul>
            <?php foreach ($features as $feature): ?>
              <li><?php echo esc_html($feature['text']); ?></li>
            <?php endforeach; ?>
          </ul>

        </div>
      <?php endif; ?>

    <?php endwhile; endif; ?>

  </div>

</main>

<?php get_footer(); ?>