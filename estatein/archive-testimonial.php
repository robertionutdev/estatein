<?php get_header(); ?>

<!-- JUST FOR DEMO -->
<main class="testimonials-archive py-5">

  <div class="container">

    <!-- HEADER -->
    <div class="mb-5 text-center">
      <h1><?php post_type_archive_title(); ?></h1>
      <p>See what our clients say about us.</p>
    </div>

    <div class="row">

      <?php if (have_posts()): while (have_posts()): the_post(); ?>

        <?php
        $rating = carbon_get_post_meta(get_the_ID(), 'testimonial_rating');
        $name = carbon_get_post_meta(get_the_ID(), 'testimonial_name');
        $location = carbon_get_post_meta(get_the_ID(), 'testimonial_location');
        ?>

        <div class="col-md-6 col-lg-4 mb-4">

          <div class="testimonial-card">

            <!-- RATING -->
            <div class="review-rating">
              <?php for ($i = 0; $i < $rating; $i++): ?>
                <img
                  src="<?php echo get_template_directory_uri(); ?>/assets/images/review-star.svg"
                  alt=""
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
                <?php the_post_thumbnail('thumbnail', ['class' => 'img-fluid rounded-circle']); ?>
              <?php endif; ?>

              <div>
                <p >
                  <?php echo esc_html($name ?: get_the_title()); ?>
                </p>
                <span><?php echo esc_html($location); ?></span>
              </div>

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

      <p>No testimonials found.</p>

    <?php endif; ?>

  </div>

</main>

<?php get_footer(); ?>