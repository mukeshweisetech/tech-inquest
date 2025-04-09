<?php
/**
 * 
 * Archive Template File
 * 
 */

get_header(); 

?>

<?php  if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>


<!-- Blog Details -->
<main id="main" class="site-main">
	<section class="header-blog-details-mt-mb">
		<div class="container">
			<div class="row">
				<!-- Main Content -->
				<div class="col-lg-8">
					<div class="row">
						<?php if ( have_posts() ) : ?>

							<?php 
								$first_post = true; 
								$term       = get_queried_object(); 
								$term_name  = isset( $term->name ) ? esc_html( strtoupper( $term->name ) ) : '';
							?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php
									// Pass required args
									$args = [
										'term_name'  => $term_name,
										'first_post' => $first_post
									];

									if ( $first_post ) {
										get_template_part( 'template-parts/content', 'blog-featured', $args );
										$first_post = false;
									} else {
										get_template_part( 'template-parts/content', 'blog-item', $args );
									}
								?>

							<?php endwhile; ?>

							<!-- Pagination -->
							<div class="sub-catge-pagination sub-catge-pg-mb">
								<nav aria-label="Page navigation">
									<?php
										$big = 999999999;
										$pagination = paginate_links([
											'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
											'format'    => '?paged=%#%',
											'current'   => max( 1, get_query_var( 'paged' ) ),
											'total'     => $wp_query->max_num_pages,
											'prev_text' => '«',
											'next_text' => '»',
											'type'      => 'array',
										]);

										if ( ! empty( $pagination ) ) :
									?>
									<ul class="pagination">
										<?php foreach ( $pagination as $page ) : ?>
											<li class="page-item <?php echo strpos( $page, 'current' ) !== false ? 'active' : ''; ?>">
												<?php echo str_replace( 'page-numbers', 'page-link', $page ); ?>
											</li>
										<?php endforeach; ?>
									</ul>
									<?php endif; ?>
								</nav>
							</div>

						<?php else : ?>
							<p><?php esc_html_e( 'No posts found.', 'textdomain' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<!-- Main Content End -->

				<!-- Sidebar -->
				<?php get_sidebar(); ?>
				<!-- Sidebar End -->
			</div>
		</div>
	</section>
</main>
<!-- Blog Details End -->

<?php

get_footer(); 
?>
