<?php
get_header();

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$author_id = get_queried_object_id();

$socialUrls  = [
	'facebook'  => 'fa-facebook-f',
	'twitter'   => 'fa-twitter',
	'linkedin'  => 'fa-linkedin-in',
	'instagram' => 'fa-instagram',
];
?>

<section class="header-blog-details-mt-mb">
	<div id="loading-overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					
					<?php get_template_part('template-parts/author/author-info', null, [
						'author_id'   => $author_id,
						'socialUrls'  => $socialUrls,
					]); ?>

					<?php get_template_part('template-parts/author/top-stories', null, [
						'author_id' => $author_id,
					]); ?>

					<?php get_template_part('template-parts/author/author-posts', null, [
						'author_id' => $author_id,
					]); ?>

					<?php get_template_part('template-parts/author/author-categories', null, [
						'author_id' => $author_id,
						'cat_slugs' => ['political', 'tech', 'sports', 'fashion'],
					]); ?>
					
				</div>
			</div>

			<!-- Sidebar -->
			<?php get_sidebar(); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
