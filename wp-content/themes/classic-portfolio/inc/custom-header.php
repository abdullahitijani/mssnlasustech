<?php
/**
 * @package Classic Portfolio
 * Setup the WordPress core custom header feature.
 *
 * @uses classic_portfolio_header_style()
 */
function classic_portfolio_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'classic_portfolio_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 2500,
		'height'                 => 400,
		'wp-head-callback'       => 'classic_portfolio_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'classic_portfolio_custom_header_setup' );

if ( ! function_exists( 'classic_portfolio_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see classic_portfolio_custom_header_setup().
 */
function classic_portfolio_header_style() {
	$classic_portfolio_header_text_color = get_header_textcolor();

	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat !important;
			background-position: center top;
			background-size: cover !important;
		}

	<?php endif; ?>	

	h1.site-title a, p.site-title a{
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_sitetitle_color')); ?> !important;
	}

	.site-description{
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_sitetagline_color')); ?> !important;
	}

	.main-nav ul li a {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_menu_color')); ?> !important;
	}

	.main-nav a:hover{
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_menuhrv_color')); ?> !important;
	}

	.main-nav ul ul a{
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_submenu_color')); ?> !important;
	}

	.main-nav ul ul a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_submenuhrv_color')); ?> !important;
	}

	.copywrap p {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_footercoypright_color')); ?> !important;
	}
	#footer .ftr-4-box h5 {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_footertitle_color')); ?> !important;

	}
	#footer p {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_footerdescription_color')); ?>;
	}
	#footer ul li a {
		color: <?php echo esc_attr(get_theme_mod('classic_portfolio_footerlist_color')); ?>;

	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('classic_portfolio_footerbg_color')); ?>;
	}
	
	</style>
	<?php 
}
endif;