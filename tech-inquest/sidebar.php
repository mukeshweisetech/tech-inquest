<div class="col-lg-4">
    <div class="sub-latest-news-ads">
        <img src="<?php echo TECH_INQUEST_URI; ?>/images/01-ads.jpg" alt="" />
    </div>
    <div class="sub-latest-news-title">
        <h2>Latest News</h2>
    </div>

    <?php
    $args = array(
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => 'date',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="sub-latest-news-box d-flex mb-3">
                <div class="sub-latest-news-img me-3">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('thumbnail', ['class' => 'img-fluid']);
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/img/placeholder.jpg" alt="No image" />';
                        } ?>
                    </a>
                </div>
                <div class="sub-latest-news-content">
                    <span>
                        <?php 
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo esc_html($categories[0]->name); 
                            }
                        ?> • 
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                    </span>
                    <h6>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words(get_the_title(), 15, '...'); ?>
                        </a>
                    </h6>
                </div>
            </div>
    <?php endwhile; wp_reset_postdata(); else : ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <div class="sub-explore-category-right mt-5">
        <h3>Category</h3>
        <ul class="list-unstyled">
            <?php
            $categories = get_categories(['orderby' => 'name', 'order' => 'ASC']);
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $post_count = $category->count;
                    ?>
                    <li>
                        <a href="<?php echo get_category_link($category->term_id); ?>">
                            <?php echo esc_html($category->name); ?> 
                            <span>(<?php echo $post_count; ?>)</span>
                        </a>
                    </li>
                <?php }
            } else {
                echo '<li>No categories found</li>';
            }
            ?>
        </ul>
    </div>
</div>
