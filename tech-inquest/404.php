<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">

      <header class="mb-4">
        <h1 class="display-4"><?php _e( 'Not Found', 'THEME_TEXT_DOMAIN' ); ?></h1>
      </header>

      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="h4 mb-3"><?php _e( 'This is somewhat embarrassing, isn’t it?', 'THEME_TEXT_DOMAIN' ); ?></h2>
          <p class="mb-4"><?php _e( 'It looks like nothing was found at this location.', 'THEME_TEXT_DOMAIN' ); ?></p>
            <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                <?php _e( 'Go to Homepage', 'THEME_TEXT_DOMAIN' ); ?>
            </a>
        </div>
      </div>

    </div>
  </div>
</div>


<?php get_footer(); ?>