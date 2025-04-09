<?php 

function tech_inquest_theme_setup() {
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_image_size('uniform-thumbnail', 300, 200, true);

    add_image_size('top-stories-thumb', 360, 203, true);

    add_image_size('sub-stories-blog-main', 300, 200, true);

    add_image_size('sub-three-blog-one-content', 360, 270, true);

    add_image_size('sub-four-blog-one-content', 240, 160, true);

    add_image_size('sub-aerospace-slider', 855, 430, true);




    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'tech-inquest' ),
        'footer'  => __( 'Footer Menu', 'tech-inquest' ),
    ));

    add_theme_support('site-logo', array(
        'width' => 250, 
        'height' => 100, 
        'flex-width' => true,
        'flex-height' => true,
    ));


}

add_action('after_setup_theme', 'tech_inquest_theme_setup');

function create_contact_form_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'contact_form_submissions';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20),
            message TEXT NOT NULL,
            submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
   
    
}
add_action('after_switch_theme', 'create_contact_form_table');

function tech_inquest_widgets_init() {
    register_sidebar([
        'name'          => __('Main Sidebar', 'your-theme'),
        'id'            => 'main-sidebar',
        'before_widget' => '<div class="widget mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title mb-3">',
        'after_title'   => '</h5>',
    ]);
}
add_action('widgets_init', 'tech_inquest_widgets_init');



define('TECH_INQUEST_URI', get_stylesheet_directory_uri());
define('THEME_TEXT_DOMAIN', 'tech-inquest');

function tech_inquest_theme_enqueue_scripts() {
    // Enqueue CSS files
    wp_enqueue_style( 'tech-inquest-style', TECH_INQUEST_URI . '/css/style.css', false, time(), 'all' ); 
    wp_enqueue_style( 'tech-inquest-animate', TECH_INQUEST_URI . '/css/animate.css', false, time(), 'all' );
    wp_enqueue_style( 'animated-up-down', TECH_INQUEST_URI . '/css/animated-up-down.css', false, time(), 'all' );
    wp_enqueue_style( 'owl-carouse-css', TECH_INQUEST_URI . '/css/owl.carousel.min.css', false, time(), 'all' );
    wp_enqueue_style( 'owl-theme-default', TECH_INQUEST_URI . '/css/owl.theme.default.min.css', false, time(), 'all' );
    wp_enqueue_style( 'responsive-css', TECH_INQUEST_URI . '/css/responsive.css', false, time(), 'all' );
    wp_enqueue_style( 'header-menu-css', TECH_INQUEST_URI . '/css/header-menu.css', false, time(), 'all' );
    wp_enqueue_style('bootstrap-css',  TECH_INQUEST_URI . '/css/bootstrap.min.css', false, time(), 'all');

    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap', [], null );


    // Enqueue JS files
    wp_enqueue_script('jquery');  
    wp_enqueue_script('bootstrap-js', TECH_INQUEST_URI . '/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl-carousel-js', TECH_INQUEST_URI . '/js/owl.carousel.min.js', array('jquery'), null, true);
    wp_enqueue_script('popper-js', TECH_INQUEST_URI . '/js/popper.min.js', array('jquery'), null, true);
    wp_enqueue_script('slick-js', TECH_INQUEST_URI . '/js/slick.js', array('jquery'), null, true);
    wp_enqueue_script('wow-js', TECH_INQUEST_URI . '/js/wow.js', array('jquery'));
    wp_enqueue_script('header-menu-script', TECH_INQUEST_URI . '/js/header-menu.js', array('jquery'), time(), true);
    wp_enqueue_script('custom-script', TECH_INQUEST_URI . '/js/custom-script.js', array('jquery'), time(), true);

    wp_localize_script( 'custom-script', 'my_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


}

add_action('wp_enqueue_scripts', 'tech_inquest_theme_enqueue_scripts');

function tech_inquest_customize_register($wp_customize) {

    //All our sections, settings, and controls will be added here

    $wp_customize->add_section('site_logo_section', array(
        'title'       => __('Site Logo', 'tech-inquest'),
        'priority'    => 30,
        'description' => __('Upload a Header and Footer logo.', 'tech-inquest'),
    ));
    
    /* Header Logo */
    $wp_customize->add_setting('site_header_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'site_header_logo_control',
        array(
            'label'       => __('Header Logo', 'tech-inquest'),
            'section'     => 'site_logo_section',
            'settings'    => 'site_header_logo',
            'width'       => 250,
            'height'      => 100,
            'flex_width'  => true,
            'flex_height' => true,
        )
    ));
    
    /* Footer Logo */
    $wp_customize->add_setting('site_footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'site_footer_logo_control',
        array(
            'label'       => __('Footer Logo', 'tech-inquest'),
            'section'     => 'site_logo_section',
            'settings'    => 'site_footer_logo',
            'width'       => 250,
            'height'      => 100,
            'flex_width'  => true,
            'flex_height' => true,
        )
    ));
    
    

        $wp_customize->add_section('custom_social_section', array(
        'title'    => __('Social Media Links', 'tech-inquest'),
        'priority' => 30,
        ));

    // Social Media Links (Repeat this for different platforms)
    $social_platforms = array('Facebook', 'Twitter', 'Instagram', 'LinkedIn');

    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting('social_' . strtolower($platform), array(
            'default'   => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . strtolower($platform), array(
            'label'    => $platform . ' URL',
            'section'  => 'custom_social_section',
            'type'     => 'url',
        ));
    }

    $colors = array(
        'primary_blue'        => '#2D70FF',
        'primary_black'       => '#2C2C2C',
        'primary_title'       => '#000000',
        'primary_black_a_tag' => '#1E1E1E',
        'primary_white'       => '#ffffff',
        'primary_footer_bg'   => '#0E0E0E',
        'primary_border'      => '#cccccc',
        'primary_span'        => '#515151',
        'primary_hours'       => '#606060',
        'primary_blog'        => '#9E9E9E',
        'primary_header'      => '#EEF6FF',
        'primary_shadow'      => '#cccccc',
    );

    foreach ( $colors as $slug => $default ) {
        $wp_customize->add_setting( $slug, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $slug, array(
            'label'    => ucwords(str_replace('_', ' ', $slug)),
            'section'  => 'colors',
            'settings' => $slug,
        ) ) );
    }
}
add_action('customize_register', 'tech_inquest_customize_register');


class Custom_Walker_Nav extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= "\n<ul class=\"nav-dropdown\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        $output .= '<li class="' . esc_attr($class_names) . '">';

        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $title = apply_filters('the_title', $item->title, $item->ID);


        $output .= '<a' . $attributes . '>' . $title  . '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= "</ul>\n";
    }
}

// Track post views
function trackPostView($post_id) {
    if (!is_single()) return;
    if (empty($post_id)) {
        $post_id = get_the_ID();
    }
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}
// add_action('wp_head', 'trackPostView');

function getTopStories($number = 5) {
    $args = array(
        'posts_per_page' => $number,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
    );
    $top_posts = new WP_Query($args);
    if ($top_posts->have_posts()) :
        echo '<ul>';
        while ($top_posts->have_posts()) : $top_posts->the_post();
            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
        endwhile;
        echo '</ul>';
    endif;
    wp_reset_postdata();
}


function getPostsByACFtaxField($acf_object, $post_type = 'post', $posts_per_page = 3, $author_id= null) {
    if (!$acf_object || !is_object($acf_object)) {
        return null; 
    }

    $term_id = $acf_object->term_id;
    $taxonomy = $acf_object->taxonomy;

    $args = array(
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'tax_query'      => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        ),
    );

    if (!empty($author_id)) {
        $args['author'] = $author_id;
    }

    return new WP_Query($args); 
}




function getPostsBycatAjax($paged = 1, $author_id = null, $catslug = '') {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3, 
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged
    );

    if (!empty($catslug)) {
        $args['category_name'] = $catslug;
    }

    if (!empty($author_id)) {
        $args['author'] = $author_id;
    }

    $topStoriesQuery = new WP_Query($args);

    ob_start();

    if ($topStoriesQuery->have_posts()) :
        while ($topStoriesQuery->have_posts()) : $topStoriesQuery->the_post(); ?>
        <div class="col-12 col-md-6 col-lg-4">
        <div class="sub-stories-blog-main">
            <a href="<?php echo get_permalink(); ?>">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('sub-four-blog-one-content', ['class' => 'img-fluid w-100', 'alt' => get_the_title()]);
                } else {
                    echo '<img src="' . TECH_INQUEST_URI . '/images/thumbnail-default.png" class="img-fluid" alt="Default Image">';
                }
                ?>
            </a>
            <span class="story-date-category">
                <?php 
                $categories = get_the_category(); 
                $category = get_category_by_slug($catslug);
                if ($category) {
                    echo esc_html($category->name) . ' • ';
                }
                echo get_the_date('F j, Y'); 
                ?>
            </span>
            <h5>
                <a href="<?php the_permalink(); ?>" class="story-title"><?php echo wp_trim_words(get_the_title(), 9, '...'); ?></a>
            </h5>
            <span class="sub-hours-name">
                By <strong><?php the_author(); ?></strong> | 
                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
            </span>
            <p class="story-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 50, '...'); ?></p>
        </div>
    </div>     <?php   endwhile;
    else :
        echo '<p class="no-top-stories">No top stories found.</p>';
    endif;

    wp_reset_postdata();

    return [
        'content' => ob_get_clean(),
        'max_pages' => $topStoriesQuery->max_num_pages,
    ];
}


function getPostsAjaxAuthor($paged = 1, $author_id = null) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 8, 
        'orderby'        => 'date',
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'paged'          => $paged
    );


    if (!empty($author_id)) {
        $args['author'] = $author_id;
    }

    $topStoriesQuery = new WP_Query($args);

    ob_start();

    if ($topStoriesQuery->have_posts()) :
        while ($topStoriesQuery->have_posts()) : $topStoriesQuery->the_post(); ?>
            <div class="col-12 col-md-6 col-lg-3">
            <div class="sub-four-blog-one-content sub-satam-mb">
            <a href="<?php echo get_permalink(); ?>">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('sub-three-blog-one-content', ['class' => 'img-fluid w-100', 'alt' => get_the_title()]);
                } else {
                    echo '<img src="' . TECH_INQUEST_URI . '/images/thumbnail-default.png" class="img-fluid" alt="Default Image">';
                }
                ?>
            </a>
            <span class="story-date-category">
                <?php 
                $categories = get_the_category()[0]; 
                if ($categories) {
                    echo esc_html($categories->name) . ' • ';
                }
                echo get_the_date('F j, Y'); 
                ?>
            </span>
            <h5>
                <a href="<?php the_permalink(); ?>" class="story-title"><?php echo wp_trim_words(get_the_title(), 9, '...'); ?></a>
            </h5>
            <span class="sub-hours-name">
                By <strong><?php the_author(); ?></strong> | 
                <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
            </span>
        </div>
    </div>     <?php   endwhile;
    else :
        echo '<p class="no-top-stories">No top stories found.</p>';
    endif;

    wp_reset_postdata();

    return [
        'content' => ob_get_clean(),
        'max_pages' => $topStoriesQuery->max_num_pages,
    ];
}


function loadPostpagAjax() {
    $paged     = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $author_id = isset($_POST['author_id']) ? intval($_POST['author_id']) : null;
    $catslug   = isset($_POST['catslug']) ? sanitize_text_field($_POST['catslug']) : '';

    if(!empty($catslug)){
        $result = getPostsBycatAjax($paged, $author_id, $catslug);
    } else {
        $result = getPostsAjaxAuthor($paged, $author_id);

    }


    $pagination_html = buildPagination($paged, $result['max_pages']);

    wp_send_json([
        'content'    => trim($result['content']),
        'paged'      => $paged,
        'max_pages'  => $result['max_pages'],
        'pagination' => $pagination_html,
    ]);
}
add_action('wp_ajax_loadPostpagAjax', 'loadPostpagAjax');
add_action('wp_ajax_nopriv_loadPostpagAjax', 'loadPostpagAjax');



function buildPagination($current_page, $max_pages) {
    if ($max_pages <= 1) return '';

    $html = '';

    // Previous button
    $html .= '<li class="page-item prev-page ' . ($current_page == 1 ? 'disabled' : '') . '">';
    $html .= '<a class="page-link" href="#" data-page="prev">«</a></li>';

    $pages = [];

    // Always include first page
    if ($current_page > 3) {
        $pages[] = 1;
        if ($current_page > 4) {
            $pages[] = 'dots';
        }
    }

    // Add pages around current
    for ($i = max(1, $current_page - 1); $i <= min($max_pages, $current_page + 1); $i++) {
        $pages[] = $i;
    }

    // Add last page
    if ($current_page < $max_pages - 2) {
        if ($current_page < $max_pages - 3) {
            $pages[] = 'dots';
        }
        $pages[] = $max_pages;
    }

    // Clean up duplicates and order pages
    $pages = array_values(array_unique($pages));

    foreach ($pages as $page) {
        if ($page === 'dots') {
            $html .= '<li class="page-item disabled"><span class="page-link">…</span></li>';
        } else {
            $active = ($page == $current_page) ? 'active' : '';
            $html .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" data-page="' . $page . '">' . $page . '</a></li>';
        }
    }

    // Next button
    $html .= '<li class="page-item next-page ' . ($current_page >= $max_pages ? 'disabled' : '') . '">';
    $html .= '<a class="page-link" href="#" data-page="next">»</a></li>';

    return $html;
}




add_action('wp_ajax_submit_contact_form', 'handle_contact_form_submission');
add_action('wp_ajax_nopriv_submit_contact_form', 'handle_contact_form_submission');

function handle_contact_form_submission() {
    // Sanitize inputs
    $first_name = sanitize_text_field($_POST['first_name'] ?? '');
    $last_name = sanitize_text_field($_POST['last_name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($first_name) || empty($last_name) || empty($email) ) {
        wp_send_json_error('Please fill in all required fields.');
    }


    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    $inserted = $wpdb->insert($table_name, [
        'first_name'    => $first_name,
        'last_name'     => $last_name,
        'email'         => $email,
        'phone'         => $phone,
        'message'       => $message,
        'submitted_at'  => current_time('mysql')
    ]);

    if ($inserted) {
            // // 1. Email to Admin
            //     $admin_email = get_option('admin_email');
            //     $subject_admin = 'New Form Submission';
            //     $message_admin = "New message received:\n\n" .
            //                     "Name: {$first_name} {$last_name}\n" .
            //                     "Email: {$email}\n" .
            //                     "Phone: {$phone}\n" .
            //                     "Message:\n{$message}\n\n" .
            //                     "Submitted at: " . current_time('mysql');

            //     wp_mail($admin_email, $subject_admin, $message_admin);

            //     // 2. Confirmation Email to User
            //     $subject_user = 'Thank you for contacting us';
            //     $message_user = "Hi {$first_name},\n\n" .
            //                     "Thank you for reaching out. We’ve received your message and will get back to you soon.\n\n" .
            //                     "Here’s what you submitted:\n" .
            //                     "Name: {$first_name} {$last_name}\n" .
            //                     "Phone: {$phone}\n" .
            //                     "Message:\n{$message}\n\n" .
            //                     "Best regards,\n" .
            //                     get_bloginfo('name');

            //     wp_mail($email, $subject_user, $message_user);
        wp_send_json_success('Thank you! Your message has been received.');
    } else {
        wp_send_json_error('Something went wrong while submitting the form.');
    }

    wp_die(); 
}


add_action('admin_menu', 'contact_form_admin_page');

function contact_form_admin_page() {
    add_menu_page(
        'Contact Form Entries',         
        'Form Submissions',        
        'manage_options',               
        'contact-form-submissions',     
        'render_contact_form_admin_page',
        'dashicons-email',              
        25                             
    );
}

function render_contact_form_admin_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';

    $formData = $wpdb->get_results("SELECT * FROM $table_name ORDER BY submitted_at DESC");

    echo '<div class="wrap"><h1>Contact Form Submissions</h1>';

    if (empty($formData)) {
        echo '<p>No submissions found.</p>';
        echo '</div>';
        return;
    }

    $sn = 1;

    echo '<table class="widefat fixed striped">';
    echo '<thead><tr>
        <th>SN</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Date</th>
    </tr></thead><tbody>';

    foreach ($formData as $entry) {
        echo '<tr>';
        echo '<td>' . esc_html($sn) . '</td>';
        echo '<td>' . esc_html($entry->first_name) . '</td>';
        echo '<td>' . esc_html($entry->last_name) . '</td>';
        echo '<td><a href="mailto:' . esc_attr($entry->email) . '">' . esc_html($entry->email) . '</a></td>';
        echo '<td>' . esc_html($entry->phone) . '</td>';
        echo '<td>' . esc_html($entry->message) . '</td>';
        echo '<td>' . esc_html($entry->submitted_at) . '</td>';
        echo '</tr>';

        $sn++;
    }

    echo '</tbody></table>';
    echo '</div>';
}





function mytheme_customizer_output_css() {
    $defaults = array(
        'primary_blue'        => '#2D70FF',
        'primary_black'       => '#2C2C2C',
        'primary_title'       => '#000000',
        'primary_black_a_tag' => '#1E1E1E',
        'primary_white'       => '#ffffff',
        'primary_footer_bg'   => '#0E0E0E',
        'primary_border'      => '#cccccc',
        'primary_span'        => '#515151',
        'primary_hours'       => '#606060',
        'primary_blog'        => '#9E9E9E',
        'primary_header'      => '#EEF6FF',
        'primary_shadow'      => '#cccccc',
    );

    echo '<style>:root {';
    foreach ( $defaults as $var => $default ) {
        $val = get_theme_mod( $var, $default );
        echo "--" . str_replace('_', '-', $var) . ": {$val};";
    }
    echo '}</style>';
}
add_action( 'wp_head', 'mytheme_customizer_output_css' );
















?>