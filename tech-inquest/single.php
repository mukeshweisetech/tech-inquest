<?php
/**
 * The Template for displaying all single posts
 */

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();

    // Author Info
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

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <!-- Header Section -->

	<?php   get_template_part('template-parts/single/post-header'); ?>

    <!-- Blog Content Section -->
    <section class="header-blog-details-mt-mb">
        <div class="container">
            <div class="row">
                <!-- Main Blog Content -->
                <div class="col-lg-8">
                    <div class="row">
					<?php   get_template_part('template-parts/single/single-content'); ?>
					
                        <!-- Related Posts -->
                        <div class="col-lg-12">
                            <div class="sub-america-four-blog sub-blog-dt-pt-pb">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-8">
                                        <div class="sub-america-title">
                                            <h5>More in This Topic</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="sub-america-btn">
                                            <?php 
                                            $categories = get_the_category();
                                            if (!empty($categories)) :
                                                $cat = $categories[0]; ?>
                                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                                                    More <i class="fa-solid fa-angle-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php
                                    if (!empty($categories)) {
                                        $relatedPosts = getPostsByACFtaxField($cat, 'post', 4);
                                        if ($relatedPosts && $relatedPosts->have_posts()) : ?>
                                            <div class="row">
                                            <?php while ($relatedPosts->have_posts()) : $relatedPosts->the_post(); ?>
											<?php   get_template_part('template-parts/single/related-posts'); ?>

                                            <?php endwhile; ?>
                                            </div>
                                            <?php wp_reset_postdata(); ?>
                                        <?php endif;
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <!-- Author Section -->
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
                        <!-- Author End -->
                    </div>
                </div>

                <!-- Sidebar -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </section>
</article>

<?php
    endwhile;
endif;

get_footer();
?>
