<?php
$author_id     = get_the_author_meta('ID');
$author_name   = get_the_author();
?>

<header class="header-title-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="sub-inner-banner-title">
                    <span><?php the_category(', '); ?></span>
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class="sub-user-date-box">
                    <div class="sub-user">
                        <img src="<?php echo esc_url(get_avatar_url($author_id, ['size' => 100])); ?>" alt="<?php echo esc_attr($author_name); ?>" class="author-avatar"/>
                        <span>By: <strong><a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo esc_html($author_name); ?></a></strong></span>
                    </div>
                </div>
                <div class="sub-time-date">
                    <p><time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time> | <?php echo esc_html(get_the_time('H:i')); ?></p>
                </div>
            </div>
        </div>
    </div>
</header>
