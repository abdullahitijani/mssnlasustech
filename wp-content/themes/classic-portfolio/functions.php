<?php
/**
 * Classic Portfolio functions and definitions
 *
 * @package Classic Portfolio
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'classic_portfolio_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function classic_portfolio_setup() {
	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 680;
	load_theme_textdomain( 'classic-portfolio', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "responsive-embeds" );
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'classic-portfolio' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );
}
endif; // classic_portfolio_setup
add_action( 'after_setup_theme', 'classic_portfolio_setup' );

function classic_portfolio_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function classic_portfolio_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'classic-portfolio' ),
		'description'   => __( 'Appears on blog page sidebar', 'classic-portfolio' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'classic-portfolio' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'classic-portfolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'classic-portfolio' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'classic-portfolio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	$classic_portfolio_widget_areas = get_theme_mod('classic_portfolio_footer_widget_areas', '4');
	for ($classic_portfolio_i=1; $classic_portfolio_i<=$classic_portfolio_widget_areas; $classic_portfolio_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'classic-portfolio' ) . $classic_portfolio_i,
			'id'            => 'footer-' . $classic_portfolio_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'classic-portfolio'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'classic-portfolio'),
		'id'            => 'woocommerce_sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'classic-portfolio'),
        'description'   => __('Sidebar for single product pages', 'classic-portfolio'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action( 'widgets_init', 'classic_portfolio_widgets_init' );


// Change number of products per row to 3
add_filter('loop_shop_columns', 'classic_portfolio_loop_columns');
if (!function_exists('classic_portfolio_loop_columns')) {
    function classic_portfolio_loop_columns() {
        $colm = get_theme_mod('classic_portfolio_products_per_row', 3); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function classic_portfolio_products_per_page($cols) {
    $cols = get_theme_mod('classic_portfolio_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'classic_portfolio_products_per_page', 9);

function classic_portfolio_scripts() {

	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style('classic-portfolio-style', get_stylesheet_uri(), array() );
		wp_style_add_data('classic-portfolio-style', 'rtl', 'replace');

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'classic-portfolio-style',$classic_portfolio_color_scheme_css );
	
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'classic-portfolio-default', esc_url(get_template_directory_uri())."/css/default.css" );
	
	wp_enqueue_style( 'classic-portfolio-style', get_stylesheet_uri() );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'classic-portfolio-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	wp_enqueue_style( 'classic-portfolio-block-style', esc_url( get_template_directory_uri() ).'/css/blocks.css' );	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
	$classic_portfolio_headings_font = esc_html(get_theme_mod('classic_portfolio_headings_fonts'));
	// 	Body
	$classic_portfolio_body_font = esc_html(get_theme_mod('classic_portfolio_body_fonts'));

	if ($classic_portfolio_headings_font) {
	    wp_enqueue_style('classic-portfolio-headings-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_portfolio_headings_font));
	} else {
	    wp_enqueue_style('Unbounded-heading', 'https://fonts.googleapis.com/css?family=Unbounded:wght@200..900');
	}

	if ($classic_portfolio_body_font) {
	    wp_enqueue_style('classic-portfolio-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_portfolio_body_font));
	} else {
	    wp_enqueue_style('inter-body', 'https://fonts.googleapis.com/css?family=Inter:wght@100..900');
	}

}
add_action( 'wp_enqueue_scripts', 'classic_portfolio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Sanitization Callbacks.
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';

/**
 * Webfont-Loader.
 */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * select .
 */
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

// Footer Link
define('CLASSIC_PORTFOLIO_FOOTER_LINK',__('https://www.theclassictemplates.com/products/free-portfolio-wordpress-theme','classic-portfolio'));
if ( ! defined( 'CLASSIC_PORTFOLIO_PRO_NAME' ) ) {
	define( 'CLASSIC_PORTFOLIO_PRO_NAME', __( 'About Classic Portfolio', 'classic-portfolio' ));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_PREMIUM_PAGE' ) ) {
define('CLASSIC_PORTFOLIO_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/portfolio-wordpress-theme','classic-portfolio'));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_THEME_PAGE' ) ) {
define('CLASSIC_PORTFOLIO_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','classic-portfolio'));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_SUPPORT' ) ) {
define('CLASSIC_PORTFOLIO_SUPPORT',__('https://wordpress.org/support/theme/classic-portfolio/','classic-portfolio'));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_REVIEW' ) ) {
define('CLASSIC_PORTFOLIO_REVIEW',__('https://wordpress.org/support/theme/classic-portfolio/reviews/#new-post','classic-portfolio'));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_PRO_DEMO' ) ) {
define('CLASSIC_PORTFOLIO_PRO_DEMO',__('https://live.theclassictemplates.com/classic-portfolio-pro/','classic-portfolio'));
}
if ( ! defined( 'CLASSIC_PORTFOLIO_THEME_DOCUMENTATION' ) ) {
define('CLASSIC_PORTFOLIO_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/classic-portfolio-free/','classic-portfolio'));
}

/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));
    
// logo
if ( ! function_exists( 'classic_portfolio_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function classic_portfolio_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
