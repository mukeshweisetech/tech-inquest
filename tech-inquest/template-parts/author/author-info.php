<?php
$author_id = $args['author_id'];
$socialUrls = $args['socialUrls'];
?>

<div class="col-lg-12">
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6">
			<div class="sub-author-content">
				<h4><?php echo get_the_author_meta('display_name', $author_id); ?></h4>
				<p><?php echo get_the_author_meta('description', $author_id); ?></p>
			</div>
			<div class="sub-author-share-icon">
				<span>Follow <?php echo get_the_author_meta('display_name', $author_id); ?></span>
				<ul>
					<?php foreach ($socialUrls as $platform => $icon) :
						$socialUrl = get_field("user_{$platform}", "user_{$author_id}");
						if ($socialUrl): ?>
							<li><a href="<?php echo esc_url($socialUrl); ?>" target="_blank"><i class="fa-brands <?php echo esc_attr($icon); ?>"></i></a></li>
						<?php endif;
					endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-6">
			<div class="sub-author-img">
				<img src="<?php echo esc_url(get_avatar_url($author_id, ['size' => 300])); ?>" class="author-avatar" alt="<?php echo esc_attr(get_the_author_meta('display_name', $author_id)); ?>" />
			</div>
		</div>
	</div>
</div>
