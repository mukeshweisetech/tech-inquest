<?php
$author_id = $args['author_id'];
$catSlugfArray = $args['cat_slugs'];

$categories = get_terms([
	'taxonomy'   => 'category',
	'hide_empty' => false,
	'slug'       => $catSlugfArray,
]);

if (!empty($categories)) :
?>
<div class="col-md-12 col-lg-12">
	<div class="sub-category-mt-mb">
		<div class="row">
			<?php foreach ($categories as $category) :
				$category_posts = getPostsByACFtaxField($category, 'post', 3, $author_id);
			?>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="sub-category-title">
						<h5>
							<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
								<?php echo esc_html($category->name); ?>
								<span><i class="fa-solid fa-angle-right"></i></span>
							</a>
						</h5>
					</div>

					<?php if ($category_posts->have_posts()) : ?>
						<?php $category_posts->the_post(); ?>
						<div class="sub-four-blog-one-content">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid  w-100']); ?>
							</a>
							<span><?php echo esc_html($category->name); ?> • <?php echo get_the_date('F j, Y'); ?></span>
							<h5>
								<a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), 8, '...')); ?></a>
							</h5>
							<span class="sub-hours-name">By <?php the_author(); ?> | <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
						</div>
						<div class="sub-category-list">
							<ul>
								<?php while ($category_posts->have_posts()) : $category_posts->the_post(); ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
