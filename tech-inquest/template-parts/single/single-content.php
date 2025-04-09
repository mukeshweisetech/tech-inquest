<div class="col-lg-12">
<?php if (has_post_thumbnail()) : ?>
    <figure class="post-thumbnail">
        <?php the_post_thumbnail('large', ['alt' => esc_attr(get_the_title())]); ?>
    </figure>
<?php endif; ?>

<div class="sub-blog-dt-content">
    <?php the_content(); ?>
</div>

<!-- Static Ads images -->
<div class="sub-blog-dt-img">
    <img src="<?php echo esc_url(TECH_INQUEST_URI . '/images/black-friday.jpg'); ?>" alt="Black Friday" />
</div>
<div class="sub-blog-dt-img">
    <img src="<?php echo esc_url(TECH_INQUEST_URI . '/images/luxurious-reality.jpg'); ?>" alt="Luxurious Reality" />
</div>

<!-- Tags -->
<?php 
$tags = get_the_tags();
if ($tags) : ?>
    <p><strong>Tags: 
        <?php 
        $tag_links = array_map(function ($tag) {
            return '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
        }, $tags);
        echo implode(', ', $tag_links);
        ?>
    </strong></p>
<?php endif; ?>
</div>
