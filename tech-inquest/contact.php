<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>

<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


$herobBanner = get_field('hero_banner') ?? '';
$heroSectionText = get_field('hero_section_tittle') ?? '';
$address = get_field('address') ?? '';
$email = get_field('email') ?? '';
$phoneNumber = get_field('phone_number') ?? '';
$supportText = get_field('support_text') ?? '';
$feedbackText = get_field('suggetions_text') ?? '';
?>


<!-- Header Slider -->
<section class="header-title-banner header-contact-bg" style="background-image: url('<?php echo esc_url($herobBanner['url'] ?? ''); ?>');">
	<div class="container">
		<div class="row">

			<div class="col-12 col-md-12 col-lg-6">
				<div class="sub-inner-banner-title">
					<h1><?php echo esc_html($heroSectionText);?></h1>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- Header Slider End -->

<!-- Contact Details -->
<section class="header-blog-details-mt-mb">
	<div class="container">
		<div class="row">

			<!-- Contact Info Left -->
			<div class="col-lg-6">
				<div class="sub-contact-info">
					<h4>Contact Us</h4>
					<div class="sub-contact-box">
						<div class="sub-contact-icon">
							<i class="fa-solid fa-location-dot"></i>
						</div>
						<div class="sub-contact-text">
							<p><?php echo esc_html($address);?></p>
						</div>
					</div>
					<div class="sub-contact-box">
						<div class="sub-contact-icon">
							<i class="fa-solid fa-envelope"></i>
						</div>
						<div class="sub-contact-text">
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
						</div>
					</div>
					<div class="sub-contact-box">
						<div class="sub-contact-icon">
							<i class="fa-solid fa-phone"></i>
						</div>
						<div class="sub-contact-text">
                        <a href="tel:<?php echo esc_attr($phoneNumber); ?>"><?php echo esc_html($phoneNumber); ?></a>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-md-6 col-lg-6">
						<div class="sub-contact-cut-supt">
							<h4>Customer Support</h4>
							<p><?php echo esc_html($supportText);?></p>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6">
						<div class="sub-contact-cut-supt">
							<h4>Feedback and Suggetions</h4>
							<p><?php echo esc_html($feedbackText);?></p>
						</div>
					</div>
				</div>

			</div>
			<!-- Contact Info Left End -->

			<!-- Contact Form Right -->
			<div class="col-lg-6">
				<div class="sub-contact-form">
					<h3>Get in Touch</h3>
					<p>You can reach us anytime</p>
                    <form id="contactUsForm">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name *"/>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name *" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail *" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Mobile Number" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea id="message" name="message" class="form-control" rows="3" placeholder="Your Message"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-lg-12">
                                <div id="contactMessage" class="mt-3"></div>
                            </div>
                        </div>
                    </form>

				</div>
			</div>
			<!-- Contact Form Right End -->

		</div>
	</div>
</section>
<!-- Contact Details End -->

<?php get_footer(); ?>
