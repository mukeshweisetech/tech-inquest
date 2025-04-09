<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset=<?php bloginfo( 'charset' ); ?>>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php bloginfo( 'name' ); ?></title>
	
		<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Header Logo & Menu -->
<header class="header_area" id="navbar">
  <div class="main_header_area animated">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <nav id="navigation1" class="navigation">

            <div class="nav-header">
              <?php 
              $themelogo = get_theme_mod('site_header_logo'); 
              $logo_url = $themelogo ? esc_url($themelogo) : esc_url(TECH_INQUEST_URI . '/images/logo_placeholder.png');
              ?>
              <a class="nav-brand" href="<?php echo esc_url(home_url()); ?>">
                <img src="<?php echo $logo_url; ?>" alt="Site Logo" />
              </a>
              <div class="nav-toggle"></div>
            </div>

            <div class="nav-menus-wrapper">
              <?php
              wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu mx-auto',
                'container'      => false, 
                'walker'         => new Custom_Walker_Nav(),
              ));
              ?>
            </div>

            <div class="header-icon">
              <ul>
                <?php 
                $social_links = [
                  'social_facebook' => 'fa-facebook-f',
                  'social_twitter'  => 'fa-twitter',
                  'social_instagram' => 'fa-instagram',
                  'social_linkedin' => 'fa-linkedin-in'
                ];

                foreach ($social_links as $mod => $icon) {
                  $url = get_theme_mod($mod);
                  if ($url) {
                    echo '<li><a href="' . esc_url($url) . '" target="_blank"><i class="fa-brands ' . esc_attr($icon) . '"></i></a></li>';
                  }
                }
                ?>
              </ul>
            </div>

          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Header Logo & Menu End -->