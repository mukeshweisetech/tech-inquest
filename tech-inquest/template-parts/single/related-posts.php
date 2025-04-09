<div class="col-12 col-md-6 col-lg-3">
    <div class="sub-four-blog-one-content">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100']); ?>
        </a>
        <span><?php echo esc_html(get_the_category()[0]->name); ?> • <?php echo esc_html(get_the_date('F j, Y')); ?></span>
        <h5>
            <a href="<?php the_permalink(); ?>">
                <?php echo esc_html(wp_trim_words(get_the_title(), 10, '...')); ?>
            </a>
        </h5>
        <span class="sub-hours-name">
            By <?php echo esc_html(get_the_author()); ?> | <?php echo esc_html(human_time_diff(get_the_time('U'), current_time('timestamp'))) . ' ago'; ?>
        </span>
    </div>
</div>