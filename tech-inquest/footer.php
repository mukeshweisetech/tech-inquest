<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="sub-footer-about">
				<?php 
				$themelogo = get_theme_mod('site_footer_logo'); 
				$logo_url = $themelogo ? esc_url($themelogo) : esc_url(TECH_INQUEST_URI . '/images/logo_placeholder.png');
				?>
			    <a class="footer-logo" href="<?php echo esc_url(home_url()); ?>">
                <img src="<?php echo $logo_url; ?>" alt="Site Logo" />
                </a>
				</div>
				<div class="sub-footer-social-icon">
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
				<div class="sub-footer-menu">
				<?php
					wp_nav_menu(array(
						'theme_location' => 'footer',
						'menu_class'     => 'nav-menu mx-auto',
						'container'      => false, 
					));
				?>
				</div>
			</div>

		</div>
	</div>
</footer>

<section class="main-copyright-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p>Copyright © <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?> . All right reserved.</p>
			</div>
		</div>
	</div>
</section>
<!-- Footer End -->

<!-- Video Modal -->
<div class="modal fade videoModal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="videoModalLabel"></h5>
				<button type="button" class="btn-close iframClosebtn" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="ratio ratio-16x9">
					<iframe id="videoIframe" src="" title="Video" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>

<a href="javascript:" id="return-to-top"><i class="fa-solid fa-angle-up"></i></a>

<script>
    //At the document ready event
	jQuery(function(){
	  new WOW().init(); 
	});

	//also at the window load event
	jQuery(window).on('load', function(){
		new WOW().init(); 
	});
</script>
<script>
	// ===== Scroll to Top ==== 
	jQuery(window).scroll(function() {
	    if (jQuery(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	        jQuery('#return-to-top').fadeIn(200);    // Fade in the arrow
	    } else {
	        jQuery('#return-to-top').fadeOut(200);   // Else fade out the arrow
	    }
	});
	jQuery('#return-to-top').click(function() {      // When arrow is clicked
	    jQuery('body,html').animate({
	        scrollTop : 0                       // Scroll to top of body
	    }, 500);
	});
</script>
<script>
	// Tab Hover JS
	jQuery(document).ready(function ($) {
		jQuery('#pills-tab[data-mouse="hover"] a').hover(function(){
			jQuery(this).tab('show');
	  });
	  jQuery('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
	    var target = $(e.relatedTarget).attr('href');
	    jQuery(target).removeClass('active');
	  })
	});
</script>

<script>
	const navbar = document.getElementById('navbar');
	window.addEventListener('scroll', () => {
	    if (window.scrollY > 50) { // Adjust this value based on when you want the color to change
	        navbar.classList.add('scrolled');
	    } else {
	        navbar.classList.remove('scrolled');
	    }
	});
</script>
<?php wp_footer(); ?>
	</body>
</html>