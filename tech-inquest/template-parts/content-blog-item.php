<?php
/**
 * Blog item (non-featured) template.
 *
 * @param array $args Arguments passed from main loop.
 */

$term_name = $args['term_name'] ?? '';
?>

<div class="col-lg-12">
	<div class="sub-news-list-box">
		<div class="row">
			<div class="col-lg-4">
				<div class="sub-news-img-list">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'uniform-thumbnail', [ 'class' => 'img-fluid w-100' ] ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="sub-news-list-content">
					<span><?php echo esc_html( $term_name ); ?> • <?php echo esc_html( strtoupper( get_the_time( 'F d' ) ) ); ?></span>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30, '...' ) ); ?></p>
					<span class="sub-news-list-date">
						<?php esc_html_e( 'By', 'textdomain' ); ?> <?php the_author(); ?> |
						<?php echo esc_html( human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ) . ' ago'; ?>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
