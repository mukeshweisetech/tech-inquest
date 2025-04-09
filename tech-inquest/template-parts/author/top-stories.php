<?php
$author_id = $args['author_id'];
$storiesResult = getPostsBycatAjax(1, $author_id, 'top-stories');
$total_pages = $storiesResult['max_pages'];
?>

<div class="col-lg-12">
	<div class="sub-latest-news-title sub-inner-top-mt">
		<h2 class="section-title">Top Stories</h2>
	</div>
	<div id="top-stories-container" data-author="<?php echo esc_attr($author_id); ?>" data-catslug="top-stories">
		<div class="row" id="top-stories-list">
			<?php echo $storiesResult['content']; ?>
		</div>

		<?php if ($total_pages > 1): ?>
			<div id="topStroyPag" class="sub-catge-pagination">
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<?php echo buildPagination(1, $total_pages); ?>
					</ul>
				</nav>
			</div>
		<?php endif; ?>
	</div>
</div>
