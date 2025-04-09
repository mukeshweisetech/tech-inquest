<?php
$author_id = $args['author_id'];
$storiesResult = getPostsAjaxAuthor(1, $author_id);
$total_pages = $storiesResult['max_pages'];
?>

<div class="col-lg-12">
	<div class="sub-america-four-blog">
		<div id="authorAllPosts" data-author="<?php echo esc_attr($author_id); ?>">
			<div class="col-lg-12">
				<div class="sub-america-title">
					<h5>Stories by <?php echo get_the_author_meta('display_name', $author_id); ?></h5>
				</div>
			</div>
			<div class="row" id="all-post-list">
				<?php echo $storiesResult['content']; ?>
			</div>
		</div>

		<?php if ($total_pages > 1): ?>
			<div id="allPostsPag" class="sub-catge-pagination">
				<nav aria-label="Page navigation">
					<ul class="pagination allpagination">
						<?php echo buildPagination(1, $total_pages); ?>
					</ul>
				</nav>
			</div>
		<?php endif; ?>
	</div>
</div>
