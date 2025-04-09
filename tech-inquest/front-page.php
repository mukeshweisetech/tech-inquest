<?php
/*
    Template Name: Front Page
*/

get_header();

if (!defined('ABSPATH')) {
    exit; 
}

// Hero Section Data
$headerMainPost = get_posts(array(
    'numberposts' => 1,
    'post_status' => 'publish'
));

if (!empty($headerMainPost)) {
    $mainPost = $headerMainPost[0];
    $heroData = array(
        'title' => esc_html($mainPost->post_title),
        'time_diff' => human_time_diff(strtotime($mainPost->post_date), current_time('timestamp')),
        'thumbnail' => get_the_post_thumbnail_url($mainPost->ID, 'full'),
        'tags' => get_the_terms($mainPost->ID, 'post_tag')
    );
    $heroData['tag_list'] = !empty($heroData['tags']) ? implode(', ', wp_list_pluck($heroData['tags'], 'name')) : 'No tags';
}

// Side Posts Data
$headerArgs = array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'offset' => 1,
    'orderby' => 'date',
    'order' => 'DESC',
);
$headerPosts = get_posts($headerArgs);

// ACF Fields
$acfFields = array(
    'top_stories' => get_field('top_stories_category', get_the_ID()),
    'trending' => get_field('trending_category', get_the_ID()),
    'blog_grid' => get_field('4_blog_grid', get_the_ID()),
    'special_coverage' => get_field('taxonomy_post_slider', get_the_ID()),
    'usa_location' => get_field('location_tag_usa', get_the_ID()),
    'video_carousel' => get_field('video_carousel_posts', get_the_ID()),
    'washington_location' => get_field('location_tag_washington', get_the_ID()),
    'picture_stories' => get_field('picture_stories_carousel', get_the_ID()),
    'four_column_cats' => get_field('4_colum_category', get_the_ID())
);
?>

<!-- Header Slider -->
<section class="header-banner-bg" style="background-image: url('<?php echo esc_url($heroData['thumbnail']); ?>')">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6">
                <div class="header-title">
                    <h1><?php echo $heroData['title']; ?></h1>
                </div>
                <div class="header-time-view-content">
                    <div class="header-country">
                        <p><?php echo $heroData['tag_list']; ?></p>
                    </div>
                    <div class="header-hours">
                        <p><i class="fa-regular fa-clock"></i> <?php echo $heroData['time_diff']; ?> Ago</p>
                    </div>
					<div class="header-views"></div>
                </div>
            </div>
            
            <div class="col-lg-1 d-md-none"></div>
            
            <div class="col-12 col-md-12 col-lg-5">
                <div class="row">
                    <?php if (!empty($headerPosts)) : ?>
                        <?php foreach ($headerPosts as $post) : setup_postdata($post); ?>
                            <?php $tags = get_the_tags(); ?>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="sub-header-blog-box">
                                    <span><?php echo !empty($tags) ? esc_html($tags[0]->name) : ''; ?></span>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail(get_the_id(), 'sub-stories-blog-main'); ?>
                                    </a>
                                    <h6><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></a></h6>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Header Slider End -->

<!-- Main Content Section -->
<section class="header-blog-main-mt-mb">
    <div class="container">
        <div class="row">
            <!-- Left Content Column -->
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <!-- Top Stories Section -->
                    <?php if ($acfFields['top_stories'] && is_object($acfFields['top_stories'])) : ?>
                        <div class="col-lg-7">
                            <div class="sub-latest-news-title">
                                <h2><?php echo esc_html($acfFields['top_stories']->name); ?></h2>
                            </div>
                            <div class="row">
                                <?php 
                                $topStoriesPosts = getPostsByACFtaxField($acfFields['top_stories'], 'post', 2);
                                if ($topStoriesPosts->have_posts()) : 
                                    while ($topStoriesPosts->have_posts()) : $topStoriesPosts->the_post(); 
                                        $tags = get_the_tags();
                                ?>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="sub-stories-blog-main">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('sub-stories-blog-main', ['class' => 'img-fluid w-100']); ?>
                                            </a>
                                            <span>
                                                <?php echo !empty($tags) ? esc_html($tags[0]->name) : ''; ?> • 
                                                <?php echo get_the_date('F j, Y'); ?>
                                            </span>
                                            <h5 class="limited-title">
                                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></a>
                                            </h5>
                                            <span class="sub-hours-name">
                                                By <?php the_author(); ?> | 
                                                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                            </span>
                                            <p><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?></p>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End Top Stories Section -->

                    <!-- Trending Section -->
                    <?php if ($acfFields['trending'] && is_object($acfFields['trending'])) : ?>
                        <div class="col-lg-5">
                            <div class="sub-latest-news-title">
                                <h2><?php echo esc_html($acfFields['trending']->name); ?></h2>
                            </div>
                            <ul class="sub-trending-list-blog">
                                <?php 
                                $trendingPosts = getPostsByACFtaxField($acfFields['trending'], 'post', 5);
                                if ($trendingPosts->have_posts()) : 
                                    $counter = 1;
                                    while ($trendingPosts->have_posts()) : $trendingPosts->the_post(); 
                                ?>
                                    <li>
                                        <div class="sub-trending-box-main sub-trending-box-main-pt">
                                            <div class="sub-trending-number">
                                                <span><?php echo $counter; ?></span>
                                            </div>
                                            <div class="sub-trending-img">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('sub-stories-blog-main', ['class' => 'img-fluid w-100']); ?>
                                                </a>
                                            </div>
                                            <div class="sub-trending-content">
                                                <h6>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                                    </li>
                                <?php $counter++; endwhile; wp_reset_postdata(); endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <!-- End Trending Section -->

                    <!-- 4 Blog Grid Section -->
                    <?php if ($acfFields['blog_grid'] && is_object($acfFields['blog_grid'])) : ?>
                        <div class="col-lg-12">
                            <div class="sub-four-blog-one-main">
                                <div class="row">
                                    <?php 
                                    $blogGridPosts = getPostsByACFtaxField($acfFields['blog_grid'], 'post', 4);
                                    if ($blogGridPosts->have_posts()) : 
                                        while ($blogGridPosts->have_posts()) : $blogGridPosts->the_post(); 
                                            $tags = get_the_tags();
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="sub-four-blog-one-content">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100']); ?>
                                                </a>
                                                <span>
												<?php echo esc_html(wp_trim_words($tags[0]->name, 1, '...')); ?> •
                                                    <?php echo get_the_date('F j, Y'); ?>
                                                </span>
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
                                                    </a>
                                                </h5>
                                                <span class="sub-hours-name">
                                                    By <?php the_author(); ?> | 
                                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End 4 Blog Grid Section -->

                    <!-- Special Coverage Carousel -->
                    <?php if ($acfFields['special_coverage'] && is_object($acfFields['special_coverage'])) : ?>
                        <div class="col-lg-12">
                            <div class="sub-special-cover-slider">
                                <div id="specialCoverageCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php 
                                        $slider_posts = getPostsByACFtaxField($acfFields['special_coverage']);
                                        if ($slider_posts->have_posts()) : 
                                            $active = 'active';
                                            while ($slider_posts->have_posts()) : $slider_posts->the_post(); 
                                                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'sub-aerospace-slider');
                                        ?>
                                            <div class="carousel-item <?php echo $active; ?>">
                                                <?php the_post_thumbnail('sub-aerospace-slider', ['class' => 'img-fluid d-block w-100']); ?>
                                                <div class="carousel-caption">
                                                    <span><?php echo esc_html($acfFields['special_coverage']->name); ?></span>
                                                    <h5><?php the_title(); ?></h5>
                                                    <div class="header-special-cov-slider-content">
                                                        <div class="header-hours">
                                                            <p>
                                                                <i class="fa-regular fa-clock"></i> 
                                                                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $active = ''; ?>
                                        <?php endwhile; wp_reset_postdata(); endif; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#specialCoverageCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#specialCoverageCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End Special Coverage Carousel -->

                    <!-- USA Location Section -->
                    <?php if ($acfFields['usa_location'] && is_object($acfFields['usa_location'])) : ?>
                        <div class="col-lg-12">
                            <div class="sub-america-four-blog">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="sub-america-title">
                                            <h5><?php echo esc_html($acfFields['usa_location']->name); ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="sub-america-btn">
                                            <a href="<?php echo esc_url(get_term_link($acfFields['usa_location']->term_id, $acfFields['usa_location']->taxonomy)); ?>">
                                                More <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    $usaPosts = getPostsByACFtaxField($acfFields['usa_location'], 'post', 4);
                                    if ($usaPosts->have_posts()) : 
                                        while ($usaPosts->have_posts()) : $usaPosts->the_post(); 
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="sub-four-blog-one-content">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100']); ?>
                                                </a>
                                                <span>
                                                    <?php echo esc_html(wp_trim_words($acfFields['usa_location']->name, 1, '...')); ?> • 
                                                    <?php echo get_the_date('F j, Y'); ?>
                                                </span>
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
                                                    </a>
                                                </h5>
                                                <span class="sub-hours-name">
                                                    By <?php the_author(); ?> | 
                                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End USA Location Section -->

                    <!-- Video Carousel Section -->
                    <?php if ($acfFields['video_carousel'] && is_object($acfFields['video_carousel'])) : ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="sub-aerospace-slider">
                                    <div id="videoCarousel" data-bs-interval="false" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php 
                                            $videoPosts = getPostsByACFtaxField($acfFields['video_carousel']);
                                            if ($videoPosts->have_posts()) : 
                                                $active = 'active';
                                                while ($videoPosts->have_posts()) : $videoPosts->the_post(); 
                                                    $image_url = get_the_post_thumbnail_url(get_the_ID(), 'sub-aerospace-slider');
                                                    $carouselVideoUrl = get_field('post_video', get_the_ID());
                                                    $post_id = get_the_ID();
                                                    $modal_id = 'videoModal_' . $post_id;
                                                    $iframe_id = 'videoIframe_' . $post_id;
                                            ?>
                                                <div class="carousel-item <?php echo $active; ?>">
                                                    <?php the_post_thumbnail('sub-aerospace-slider', ['class' => 'img-fluid d-block w-100']); ?>
                                                    <div class="carousel-caption">
                                                        <div>
                                                        <a href="#" 
                                                        class="videoLink" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#videoModal" 
                                                        data-video-url="<?php echo esc_url($carouselVideoUrl); ?>" 
                                                        data-video-title="<?php the_title_attribute(); ?>">
                                                        <i class="fa-regular fa-circle-play"></i>
                                                        </a>

                                                        </div>
                                                        <div>
                                                            <h5><?php echo esc_html(wp_trim_words(get_the_title(), 10, '...')); ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $active = ''; ?>
                                            <?php endwhile; wp_reset_postdata(); endif; ?>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    <?php endif; ?>
                    <!-- End Video Carousel Section -->

                    <!-- Washington Location Section -->
                    <?php if ($acfFields['washington_location'] && is_object($acfFields['washington_location'])) : ?>
                        <div class="col-lg-12">
                            <div class="sub-america-four-blog">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-lg-8">
                                        <div class="sub-america-title">
                                            <h5><?php echo esc_html($acfFields['washington_location']->name); ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-4">
                                        <div class="sub-america-btn">
                                            <a href="<?php echo esc_url(get_term_link($acfFields['washington_location']->term_id, $acfFields['washington_location']->taxonomy)); ?>">
                                                More <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    $washingtonPosts = getPostsByACFtaxField($acfFields['washington_location'], 'post', 5);
                                    if ($washingtonPosts->have_posts()) : 
                                        while ($washingtonPosts->have_posts()) : $washingtonPosts->the_post(); 
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-3">
                                            <div class="sub-four-blog-one-content">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100']); ?>
                                                </a>
                                                <span>
                                                    <?php echo esc_html(wp_trim_words($acfFields['washington_location']->name, 1, '...')); ?> • 
                                                    <?php echo get_the_date('F j, Y'); ?>
                                                </span>
                                                <h5>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo wp_trim_words(get_the_title(), 10, '...'); ?>
                                                    </a>
                                                </h5>
                                                <span class="sub-hours-name">
                                                    By <?php the_author(); ?> | 
                                                    <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endwhile; wp_reset_postdata(); endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End Washington Location Section -->

                    <!-- Picture Stories Carousel -->
                    <?php if ($acfFields['picture_stories'] && is_object($acfFields['picture_stories'])) : ?>
                        <div class="col-lg-12">
                            <div class="sub-pct-stories-black-bg">
                                <h4><?php echo esc_html($acfFields['picture_stories']->name); ?></h4>
                                <div id="pictureStoriesCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php 
                                        $picStoryPosts = getPostsByACFtaxField($acfFields['picture_stories']);
                                        if ($picStoryPosts->have_posts()) : 
                                            $active = 'active';
                                            while ($picStoryPosts->have_posts()) : $picStoryPosts->the_post(); 
                                        ?>
                                            <div class="carousel-item <?php echo $active; ?>">
                                                <div class="carousel-imgs">
                                                    <?php the_post_thumbnail('sub-aerospace-slider', ['class' => 'img-fluid d-block w-100']); ?>
                                                </div>
                                                <div class="carousel-caption">
                                                    <h5>
                                                        <?php 
                                                        $title = get_the_title();
                                                        $words = explode(' ', $title);
                                                        if (count($words) > 3) {
                                                            echo esc_html(implode(' ', array_slice($words, 0, 3))) . '<br>' . esc_html(implode(' ', array_slice($words, 3)));
                                                        } else {
                                                            echo esc_html($title);
                                                        }
                                                        ?>
                                                    </h5>
                                                </div>
                                            </div>
                                            <?php $active = ''; ?>
                                        <?php endwhile; wp_reset_postdata(); endif; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#pictureStoriesCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#pictureStoriesCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- End Picture Stories Carousel -->

                    <!-- 4 Column Categories -->
                    <?php if (!empty($acfFields['four_column_cats']) && is_array($acfFields['four_column_cats'])) : ?>
                        <div class="col-md-12 col-lg-12">
                            <div class="sub-category-mt-mb">
                                <div class="row">
                                    <?php foreach ($acfFields['four_column_cats'] as $category) : 
                                        $category_posts = getPostsByACFtaxField($category, 'post', 3);
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
                                                        <?php the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100']); ?>
                                                    </a>
                                                    <span>
                                                        <?php echo esc_html($category->name); ?> • 
                                                        <?php echo get_the_date('F j, Y'); ?>
                                                    </span>
                                                    <h5>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php echo wp_trim_words(get_the_title(), 8, '...'); ?>
                                                        </a>
                                                    </h5>
                                                    <span class="sub-hours-name">
                                                        By <?php the_author(); ?> | 
                                                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                                                    </span>
                                                </div>

                                                <div class="sub-category-list">
                                                    <ul>
                                                        <?php while ($category_posts->have_posts()) : $category_posts->the_post(); ?>
                                                            <li>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </li>
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
                    <!-- End 4 Column Categories -->
                </div>
            </div>
            <!-- End Left Content Column -->

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
            <!-- End Sidebar -->
        </div>
    </div>
</section>
<!-- End Main Content Section -->

<?php get_footer(); ?>