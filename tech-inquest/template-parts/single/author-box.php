<?php
$author_id     = get_the_author_meta('ID');
$author_name   = get_the_author();
$author_bio    = get_the_author_meta('description');
$author_avatar = get_avatar_url($author_id, ['size' => 300]);
$socialUrls = [
    'facebook'  => 'fa-facebook-f',
    'twitter'   => 'fa-twitter',
    'linkedin'  => 'fa-linkedin-in',
    'instagram' => 'fa-instagram'
];
?>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="sub-author-title">
                <h5>Author</h5>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="sub-author-img sub-author-img-two">
                <img src="<?php echo esc_url($author_avatar); ?>" class="author-avatar" alt="<?php echo esc_attr($author_name); ?>" />
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-8">
            <div class="sub-author-content">
                <h4><?php echo esc_html($author_name); ?></h4>
                <p><?php echo esc_html($author_bio ?: 'No bio available.'); ?></p>
            </div>
            <div class="sub-author-share-icon">
                <span>Follow <?php echo esc_html($author_name); ?></span>
                <ul>
                    <?php
                    foreach ($socialUrls as $platform => $icon) {
                        $socialUrl = get_field("user_{$platform}", "user_{$author_id}");
                        if ($socialUrl) {
                            echo '<li><a href="' . esc_url($socialUrl) . '" target="_blank" rel="noopener noreferrer"><i class="fa-brands ' . esc_attr($icon) . '"></i></a></li>';
                        }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
