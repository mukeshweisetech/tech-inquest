<?php
/**
 * Featured blog post template.
 *
 * @param array $args Arguments passed from main loop.
 */

$term_name = $args['term_name'] ?? '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-12' ); ?>>
	<div class="sub-blog-dt-img">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large', [ 'class' => 'img-fluid' ] ); ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="sub-news-list-title">
		<span><?php echo esc_html( $term_name ); ?> • <?php echo esc_html( strtoupper( get_the_time( 'F d' ) ) ); ?></span>
		<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="post-excerpt">
			<p><?php the_excerpt(); ?></p>
		</div>
	</div>
</article>
