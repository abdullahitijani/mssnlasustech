<?php
/**
 * Classic Portfolio Theme Customizer
 *
 * @package Classic Portfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function classic_portfolio_customize_register( $wp_customize ) {

	function classic_portfolio_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	wp_enqueue_style('classic-portfolio-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	//Logo
    $wp_customize->add_setting('classic_portfolio_logo_width', array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'classic_portfolio_sanitize_integer'
    ));
    $wp_customize->add_control(new Classic_Portfolio_Slider_Custom_Control($wp_customize, 'classic_portfolio_logo_width', array(
    	'label'          => __( 'Logo Width', 'classic-portfolio'),
        'section' => 'title_tagline',
        'settings' => 'classic_portfolio_logo_width',
        'input_attrs' => array(
            'step' => 1,
            'min' => 0,
            'max' => 100,
        ),
    )));

	// color site title
	$wp_customize->add_setting('classic_portfolio_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_sitetitle_color', array(
	   'settings' => 'classic_portfolio_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_portfolio_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_portfolio_title_enable', array(
	   'settings' => 'classic_portfolio_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','classic-portfolio'),
	   'type'      => 'checkbox'
	));

	// color site tagline
	$wp_customize->add_setting('classic_portfolio_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_sitetagline_color', array(
	   'settings' => 'classic_portfolio_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_portfolio_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_portfolio_tagline_enable', array(
	   'settings' => 'classic_portfolio_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','classic-portfolio'),
	   'type'      => 'checkbox'
	));

	// woocommerce section
	$wp_customize->add_section('classic_portfolio_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'classic-portfolio'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('classic_portfolio_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_portfolio_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_portfolio_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','classic-portfolio'),
		'section' => 'classic_portfolio_woocommerce_page_settings',
	));

    // shop page sidebar alignment
    $wp_customize->add_setting('classic_portfolio_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_portfolio_sanitize_choices',
	));
	$wp_customize->add_control('classic_portfolio_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'classic-portfolio'),
		'section'        => 'classic_portfolio_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-portfolio'),
			'Right Sidebar' => __('Right Sidebar', 'classic-portfolio'),
		),
	));	 

	$wp_customize->add_setting('classic_portfolio_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','classic-portfolio'),
		'choices' => array(
			 'Yes' => __('Yes','classic-portfolio'),
			 'No' => __('No','classic-portfolio'),
		 ),
		'section' => 'classic_portfolio_woocommerce_page_settings',
	));

	 $wp_customize->add_setting( 'classic_portfolio_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_portfolio_sanitize_checkbox'
    ) );
    $wp_customize->add_control('classic_portfolio_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','classic-portfolio'),
		'section' => 'classic_portfolio_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('classic_portfolio_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_portfolio_sanitize_choices',
	));
	$wp_customize->add_control('classic_portfolio_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'classic-portfolio'),
		'section'        => 'classic_portfolio_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-portfolio'),
			'Right Sidebar' => __('Right Sidebar', 'classic-portfolio'),
		),
	));

	$wp_customize->add_setting('classic_portfolio_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_portfolio_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_portfolio_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','classic-portfolio'),
		'section' => 'classic_portfolio_woocommerce_page_settings',
	));	

	$wp_customize->add_setting( 'classic_portfolio_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_portfolio_sanitize_integer'
    ) );
    $wp_customize->add_control(new Classic_Portfolio_Slider_Custom_Control( $wp_customize, 'classic_portfolio_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Woo Product Img Border Radius','classic-portfolio'),
		'section'=> 'classic_portfolio_woocommerce_page_settings',
		'settings'=>'classic_portfolio_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	
	// Add a setting for number of products per row
	$wp_customize->add_setting('classic_portfolio_products_per_row', array(
		'default'   => '3',
		'transport' => 'refresh',
		'sanitize_callback' => 'classic_portfolio_sanitize_integer'
	));
	$wp_customize->add_control('classic_portfolio_products_per_row', array(
		'label'    => __('Woo Products Per Row', 'classic-portfolio'),
		'section'  => 'classic_portfolio_woocommerce_page_settings',
		'settings' => 'classic_portfolio_products_per_row',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	// Add a setting for the number of products per page
	$wp_customize->add_setting('classic_portfolio_products_per_page', array(
		'default'   => '9',
		'transport' => 'refresh',
		'sanitize_callback' => 'classic_portfolio_sanitize_integer'
	));
	$wp_customize->add_control('classic_portfolio_products_per_page', array(
		'label'    => __('Woo Products Per Page', 'classic-portfolio'),
		'section'  => 'classic_portfolio_woocommerce_page_settings',
		'settings' => 'classic_portfolio_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('classic_portfolio_product_sale_position',array(
		'default' => 'Left',
		'sanitize_callback' => 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_product_sale_position',array(
		'type' => 'radio',
		'label' => __('Product Sale Position','classic-portfolio'),
		'section' => 'classic_portfolio_woocommerce_page_settings',
		'choices' => array(
			'Left' => __('Left','classic-portfolio'),
			'Right' => __('Right','classic-portfolio'),
		),
	) );    

	//Theme Options
	$wp_customize->add_panel( 'classic_portfolio_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'classic-portfolio' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('classic_portfolio_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','classic-portfolio'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','classic-portfolio'),
		'priority'	=> 1,
		'panel' => 'classic_portfolio_panel_area',
	));	

	$wp_customize->add_setting('classic_portfolio_preloader',array(
		'default' => false,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_portfolio_preloader', array(
	   'section'   => 'classic_portfolio_site_layoutsec',
	   'label'	=> __('Check to Show preloader','classic-portfolio'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting( 'classic_portfolio_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'classic_portfolio_sanitize_checkbox',
	));
	 $wp_customize->add_control('classic_portfolio_theme_page_breadcrumb',array(
       'section' => 'classic_portfolio_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','classic-portfolio' ),
	   'type' => 'checkbox'
    ));		

	$wp_customize->add_setting('classic_portfolio_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_portfolio_box_layout', array(
	   'section'   => 'classic_portfolio_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','classic-portfolio'),
	   'type'      => 'checkbox'
 	));

    // Add Settings and Controls for Page Layout
	$wp_customize->add_setting('classic_portfolio_sidebar_page_layout',array(
		'default' => 'right',
	 	'sanitize_callback' => 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'classic-portfolio'),
		'section' => 'classic_portfolio_site_layoutsec',
		'choices' => array(
			'full' => __('Full','classic-portfolio'),
			'left' => __('Left','classic-portfolio'),
			'right' => __('Right','classic-portfolio'),
	),
	));	 

	$wp_customize->add_setting( 'classic_portfolio_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_site_layoutsec'
	));
	  
	//Global Color
	$wp_customize->add_section('classic_portfolio_global_color', array(
		'title'    => __('Manage Global Color Section', 'classic-portfolio'),
		'panel'    => 'classic_portfolio_panel_area',
	));

	$wp_customize->add_setting('classic_portfolio_first_color', array(
		'default'           => '#cefe08',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'classic_portfolio_first_color', array(
		'label'    => __('Theme Color', 'classic-portfolio'),
		'section'  => 'classic_portfolio_global_color',
		'settings' => 'classic_portfolio_first_color',
	)));	

	$wp_customize->add_setting( 'classic_portfolio_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_global_color'
	)); 

 	// Header Section
	$wp_customize->add_section('classic_portfolio_header_section', array(
        'title' => __('Manage Header Section', 'classic-portfolio'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','classic-portfolio'),
        'priority' => null,
		'panel' => 'classic_portfolio_panel_area',
 	));	

	$wp_customize->add_setting('classic_portfolio_header_btn_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_header_btn_text', array(
	   'settings' => 'classic_portfolio_header_btn_text',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('Add Button Text', 'classic-portfolio'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_portfolio_header_btn_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_header_btn_url', array(
	   'settings' => 'classic_portfolio_header_btn_url',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('Add Button URL', 'classic-portfolio'),
	   'type'      => 'url'
	));

	// header menu
	$wp_customize->add_setting('classic_portfolio_menu_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_menu_color', array(
	   'settings' => 'classic_portfolio_menu_color',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('Menu Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	// header menu hover color
	$wp_customize->add_setting('classic_portfolio_menuhrv_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_menuhrv_color', array(
	   'settings' => 'classic_portfolio_menuhrv_color',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('Menu Hover Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	// header sub menu color
	$wp_customize->add_setting('classic_portfolio_submenu_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_submenu_color', array(
	   'settings' => 'classic_portfolio_submenu_color',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('SubMenu Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	// header sub menu hover color
	$wp_customize->add_setting('classic_portfolio_submenuhrv_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_submenuhrv_color', array(
	   'settings' => 'classic_portfolio_submenuhrv_color',
	   'section'   => 'classic_portfolio_header_section',
	   'label' => __('SubMenu Hover Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'classic_portfolio_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_header_section'
	));	

	// Banner Section
	$wp_customize->add_section('classic_portfolio_banner_section', array(
	    'title'       => __('Manage Banner Section', 'classic-portfolio'),
	    'priority'    => null,
	    'description' => __('<p class="sec-title">Manage Banner Section</p> Select Banner Page from the Dropdowns.', 'classic-portfolio'),
	    'panel'       => 'classic_portfolio_panel_area',
	));	

	// Enable/Disable Slider
	$wp_customize->add_setting('classic_portfolio_slider', array(
	    'default'           => false,
	    'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_slider', array(
	    'settings' => 'classic_portfolio_slider',
	    'section'  => 'classic_portfolio_banner_section',
	    'label'    => __('Check To Enable This Section', 'classic-portfolio'),
	    'type'     => 'checkbox',
	));

	// Small Title
	$wp_customize->add_setting('classic_portfolio_banner_small_title', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_banner_small_title', array(
	    'settings' => 'classic_portfolio_banner_small_title',
	    'section'  => 'classic_portfolio_banner_section',
	    'label'    => __('Add Banner Small Title', 'classic-portfolio'),
	    'type'     => 'text',
	));

	// Page Dropdown
	$wp_customize->add_setting('classic_portfolio_banner_pageboxes', array(
	    'default'           => '0',
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'classic_portfolio_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('classic_portfolio_banner_pageboxes', array(
	    'type'     => 'dropdown-pages',
	    'label'    => __('Select Page to display Banner', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	));

	// Button Text
	$wp_customize->add_setting('classic_portfolio_button_text', array(
	    'default'           => 'Contact Us',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_button_text', array(
	    'settings' => 'classic_portfolio_button_text',
	    'section'  => 'classic_portfolio_banner_section',
	    'label'    => __('Add Banner Button Text', 'classic-portfolio'),
	    'type'     => 'text',
	));

	// Button Link
	$wp_customize->add_setting('classic_portfolio_button_link_banner', array(
	    'default'           => '',
	    'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('classic_portfolio_button_link_banner', array(
	    'label'    => __('Add Banner Button Link', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'url',
	));

	// Customer Counters
	$wp_customize->add_setting('classic_portfolio_total_no_satisfied_customer', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_total_no_satisfied_customer', array(
	    'label'    => __('Add Total Number of Satisfied Customers', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_total_no_award_win', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_total_no_award_win', array(
	    'label'    => __('Add Total Number of Award Wins', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_total_no_successfull_projects', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_total_no_successfull_projects', array(
	    'label'    => __('Add Total Number of Successful Projects', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_total_year_experience', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_total_year_experience', array(
	    'label'    => __('Add Total Years of Experience', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	// Category Dropdown
	$categories = get_categories();
	$classic_portfolio_offer_cat = array('select' => 'Select');

	foreach ($categories as $category) {
	    $classic_portfolio_offer_cat[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('classic_portfolio_about_catData', array(
	    'default'           => 'select',
	    'sanitize_callback' => 'classic_portfolio_sanitize_choices',
	));
	$wp_customize->add_control('classic_portfolio_about_catData', array(
	    'type'     => 'select',
	    'choices'  => $classic_portfolio_offer_cat,
	    'label'    => __('Select a Category to Highlight Customer Photos', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	));

	// Customer Reviews
	$wp_customize->add_setting('classic_portfolio_customer_review', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_customer_review', array(
	    'label'    => __('Add Customer Reviews', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_total_customer_review', array(
	    'default'           => '',
	    'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('classic_portfolio_total_customer_review', array(
	    'label'    => __('Add Total Customer Reviews', 'classic-portfolio'),
	    'section'  => 'classic_portfolio_banner_section',
	    'type'     => 'text',
	));

	$wp_customize->add_setting( 'classic_portfolio_banner_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_banner_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_banner_section'
	));

	// Add service section to the customizer
	$wp_customize->add_section('classic_portfolio_below_banner_section', array(
	    'title'       => __('Manage My Experience Section', 'classic-portfolio'),
	    'description' => __('<p class="sec-title">Manage My Experience Section</p>', 'classic-portfolio'),
	    'priority'    => null,
	    'panel'       => 'classic_portfolio_panel_area',
	));

	// Add setting and control to enable or disable the section
	$wp_customize->add_setting('classic_portfolio_disabled_pgboxes', array(
	    'default'           => false,
	    'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_disabled_pgboxes', array(
	    'settings' => 'classic_portfolio_disabled_pgboxes',
	    'section'  => 'classic_portfolio_below_banner_section',
	    'label'    => __('Check To Enable This Section', 'classic-portfolio'),
	    'type'     => 'checkbox',
	));

	// Add settings and controls for the heading and subheading
	$wp_customize->add_setting('classic_portfolio_headingtext1', array(
	    'default'           => ' ',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_headingtext1', array(
	    'settings' => 'classic_portfolio_headingtext1',
	    'section'  => 'classic_portfolio_below_banner_section',
	    'label'    => __('Add Experience Title', 'classic-portfolio'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_headingtext_para', array(
	    'default'           => ' ',
	    'sanitize_callback' => 'sanitize_text_field',
	    'capability'        => 'edit_theme_options',
	));
	$wp_customize->add_control('classic_portfolio_headingtext_para', array(
	    'settings' => 'classic_portfolio_headingtext_para',
	    'section'  => 'classic_portfolio_below_banner_section',
	    'label'    => __('Add Experience Detail', 'classic-portfolio'),
	    'type'     => 'text',
	));

	$wp_customize->add_setting('classic_portfolio_education_btn_text',array(
		'default' => 'My Education',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_education_btn_text', array(
	   'settings' => 'classic_portfolio_education_btn_text',
	   'section'   => 'classic_portfolio_below_banner_section',
	   'label' => __('Add Button Text 1', 'classic-portfolio'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_portfolio_education_btn_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_education_btn_url', array(
	   'settings' => 'classic_portfolio_education_btn_url',
	   'section'   => 'classic_portfolio_below_banner_section',
	   'label' => __('Add Button URL 1', 'classic-portfolio'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_portfolio_experience_btn_text',array(
		'default' => 'My Experience',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_experience_btn_text', array(
	   'settings' => 'classic_portfolio_experience_btn_text',
	   'section'   => 'classic_portfolio_below_banner_section',
	   'label' => __('Add Button Text 2', 'classic-portfolio'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_portfolio_experience_btn_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_experience_btn_url', array(
	   'settings' => 'classic_portfolio_experience_btn_url',
	   'section'   => 'classic_portfolio_below_banner_section',
	   'label' => __('Add Button URL 2', 'classic-portfolio'),
	   'type'      => 'url'
	));

	// Number of Courses Setting
    $wp_customize->add_setting('classic_portfolio_num_courses', array(
        'default' => 8,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('classic_portfolio_num_courses', array(
        'label' => __('Number of Courses to add', 'classic-portfolio'),
        'section' => 'classic_portfolio_below_banner_section',
        'type' => 'number',
    ));

    $classic_portfolio_num_courses = get_theme_mod('classic_portfolio_num_courses', 8);

    for ($classic_portfolio_i = 1; $classic_portfolio_i <= $classic_portfolio_num_courses; $classic_portfolio_i++) {
        // Year of Course Setting
        $wp_customize->add_setting('classic_portfolio_course_year' . $classic_portfolio_i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('classic_portfolio_course_year' . $classic_portfolio_i, array(
            'label'    => __('Add Year of Course ', 'classic-portfolio') . $classic_portfolio_i,
            'section'  => 'classic_portfolio_below_banner_section',
            'settings' => 'classic_portfolio_course_year' . $classic_portfolio_i,
        ));

        // Course Name Setting
        $wp_customize->add_setting('classic_portfolio_course_name' . $classic_portfolio_i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('classic_portfolio_course_name' . $classic_portfolio_i, array(
            'label'    => __('Add Course Name ', 'classic-portfolio') . $classic_portfolio_i,
            'section'  => 'classic_portfolio_below_banner_section',
            'settings' => 'classic_portfolio_course_name' . $classic_portfolio_i,
        ));

        // University Name Setting
        $wp_customize->add_setting('classic_portfolio_university_name' . $classic_portfolio_i, array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('classic_portfolio_university_name' . $classic_portfolio_i, array(
            'label'    => __('Add University Name ', 'classic-portfolio') . $classic_portfolio_i,
            'section'  => 'classic_portfolio_below_banner_section',
            'settings' => 'classic_portfolio_university_name' . $classic_portfolio_i,
        ));
		$wp_customize->add_setting( 'classic_portfolio_experience_settings_upgraded_features',array(
			'sanitize_callback' => 'sanitize_text_field'
		));
		$wp_customize->add_control('classic_portfolio_experience_settings_upgraded_features', array(
			'type'=> 'hidden',
			'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
				<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
			'section' => 'classic_portfolio_below_banner_section'
		));	
    }	
	
	//Blog post
	$wp_customize->add_section('classic_portfolio_blog_post_settings',array(
        'title' => __('Manage Post Section', 'classic-portfolio'),
        'priority' => null,
        'panel' => 'classic_portfolio_panel_area'
    ) );	

	$wp_customize->add_setting('classic_portfolio_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_portfolio_metafields_date', array(
	    'settings' => 'classic_portfolio_metafields_date', 
	    'section'   => 'classic_portfolio_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'classic-portfolio'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_portfolio_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_portfolio_metafields_comments', array(
		'settings' => 'classic_portfolio_metafields_comments',
		'section'  => 'classic_portfolio_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'classic-portfolio'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('classic_portfolio_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_portfolio_metafields_author', array(
		'settings' => 'classic_portfolio_metafields_author',
		'section'  => 'classic_portfolio_blog_post_settings',
		'label'    => __('Check to Enable Author', 'classic-portfolio'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('classic_portfolio_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_portfolio_metafields_time', array(
		'settings' => 'classic_portfolio_metafields_time',
		'section'  => 'classic_portfolio_blog_post_settings',
		'label'    => __('Check to Enable Time', 'classic-portfolio'),
		'type'     => 'checkbox',
	));	

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('classic_portfolio_sidebar_post_layout',array(
       'default' => 'right',
       'sanitize_callback' => 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_sidebar_post_layout',array(
       'type' => 'radio',
       'label'     => __('Theme Post Sidebar Position', 'classic-portfolio'),
       'description'   => __('This option work for blog page, archive page and search page.', 'classic-portfolio'),
       'section' => 'classic_portfolio_blog_post_settings',
       'choices' => array(
           'full' => __('Full','classic-portfolio'),
           'left' => __('Left','classic-portfolio'),
           'right' => __('Right','classic-portfolio'),
           'three-column' => __('Three Columns','classic-portfolio'),
           'four-column' => __('Four Columns','classic-portfolio'),
           'grid' => __('Grid Layout','classic-portfolio')
     ),
	) );

	$wp_customize->add_setting('classic_portfolio_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','classic-portfolio'),
        'section' => 'classic_portfolio_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','classic-portfolio'),
            'Excerpt Content' => __('Excerpt Content','classic-portfolio'),
            'Full Content' => __('Full Content','classic-portfolio'),
        ),
	) );

	$wp_customize->add_setting('classic_portfolio_blog_post_thumb',array(
        'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('classic_portfolio_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'classic-portfolio'),
        'section'     => 'classic_portfolio_blog_post_settings',
    ));

    $wp_customize->add_setting( 'classic_portfolio_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_portfolio_sanitize_integer'
    ));
    $wp_customize->add_control(new Classic_Portfolio_Slider_Custom_Control( $wp_customize, 'classic_portfolio_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','classic-portfolio'),
		'section'=> 'classic_portfolio_blog_post_settings',
		'settings'=>'classic_portfolio_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'classic_portfolio_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('classic_portfolio_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'classic-portfolio'),
		'priority' => null,
		'panel' => 'classic_portfolio_panel_area'
	));

	$wp_customize->add_setting( 'classic_portfolio_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'classic_portfolio_sanitize_checkbox',
	));
	 $wp_customize->add_control('classic_portfolio_single_page_breadcrumb',array(
       'section' => 'classic_portfolio_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','classic-portfolio' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('classic_portfolio_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'classic_portfolio_sanitize_choices'
	));
	$wp_customize->add_control('classic_portfolio_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'classic-portfolio'),
     	'section' => 'classic_portfolio_single_post_settings',
     	'choices' => array(
			'full' => __('Full','classic-portfolio'),
			'left' => __('Left','classic-portfolio'),
			'right' => __('Right','classic-portfolio'),
    ),
	));

	$wp_customize->add_setting( 'classic_portfolio_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_single_post_settings'
	)); 

	// Footer Section
	$wp_customize->add_section('classic_portfolio_footer', array(
		'title'	=> __('Manage Footer Section','classic-portfolio'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','classic-portfolio'),
		'priority'	=> null,
		'panel' => 'classic_portfolio_panel_area',
	));	

	$wp_customize->add_setting('classic_portfolio_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_portfolio_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_portfolio_footer_widget', array(
	    'settings' => 'classic_portfolio_footer_widget', // Corrected setting name
	    'section'   => 'classic_portfolio_footer',
	    'label'     => __('Check to Enable Footer Widget', 'classic-portfolio'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_portfolio_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_portfolio_copyright_line', array(
	   'section' 	=> 'classic_portfolio_footer',
	   'label'	 	=> __('Copyright Line','classic-portfolio'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('classic_portfolio_copyright_link',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_portfolio_copyright_link', array(
	   'section' 	=> 'classic_portfolio_footer',
	   'label'	 	=> __('Copyright Link','classic-portfolio'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer coypright color
	$wp_customize->add_setting('classic_portfolio_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_footercoypright_color', array(
	   'settings' => 'classic_portfolio_footercoypright_color',
	   'section'   => 'classic_portfolio_footer',
	   'label' => __('Coypright Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	//  footer bg color
	$wp_customize->add_setting('classic_portfolio_footerbg_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_footerbg_color', array(
	   'settings' => 'classic_portfolio_footerbg_color',
	   'section'   => 'classic_portfolio_footer',
	   'label' => __('BG Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('classic_portfolio_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_footertitle_color', array(
	   'settings' => 'classic_portfolio_footertitle_color',
	   'section'   => 'classic_portfolio_footer',
	   'label' => __('Title Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('classic_portfolio_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_footerdescription_color', array(
	   'settings' => 'classic_portfolio_footerdescription_color',
	   'section'   => 'classic_portfolio_footer',
	   'label' => __('Description Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('classic_portfolio_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_portfolio_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_portfolio_footerlist_color', array(
	   'settings' => 'classic_portfolio_footerlist_color',
	   'section'   => 'classic_portfolio_footer',
	   'label' => __('List Color', 'classic-portfolio'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_portfolio_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'classic_portfolio_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'classic_portfolio_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'classic-portfolio' ),
        'section'        => 'classic_portfolio_footer',
        'settings'       => 'classic_portfolio_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('classic_portfolio_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'classic_portfolio_sanitize_choices'
    ));
    $wp_customize->add_control('classic_portfolio_scroll_position',array(
        'type' => 'radio',
        'section' => 'classic_portfolio_footer',
        'label'	 	=> __('Scroll To Top Positions','classic-portfolio'),
        'choices' => array(
            'Right' => __('Right','classic-portfolio'),
            'Left' => __('Left','classic-portfolio'),
            'Center' => __('Center','classic-portfolio')
        ),
    ));	

	$wp_customize->add_setting('classic_portfolio_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'classic_portfolio_sanitize_choices',
	));
	$wp_customize->add_control('classic_portfolio_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'classic_portfolio_footer',
		'label'       => __('Footer widget area', 'classic-portfolio'),
		'choices' => array(
		   '1'     => __('One', 'classic-portfolio'),
		   '2'     => __('Two', 'classic-portfolio'),
		   '3'     => __('Three', 'classic-portfolio'),
		   '4'     => __('Four', 'classic-portfolio')
		),
	));

	$wp_customize->add_setting( 'classic_portfolio_footer_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_portfolio_footer_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(CLASSIC_PORTFOLIO_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_portfolio_footer'
	));

    // Google Fonts
    $wp_customize->add_section( 'classic_portfolio_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'classic-portfolio' ),
		'priority'    => 24,
	) );
  
	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	  );
  
	$wp_customize->add_setting( 'classic_portfolio_headings_fonts', array(
		'sanitize_callback' => 'classic_portfolio_sanitize_fonts',
	));
	$wp_customize->add_control( 'classic_portfolio_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'classic-portfolio'),
		'section' => 'classic_portfolio_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'classic_portfolio_body_fonts', array(
		'sanitize_callback' => 'classic_portfolio_sanitize_fonts'
	));
	$wp_customize->add_control( 'classic_portfolio_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'classic-portfolio' ),
		'section' => 'classic_portfolio_google_fonts_section',
		'choices' => $font_choices
	));

}
add_action( 'customize_register', 'classic_portfolio_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function classic_portfolio_customize_preview_js() {
	wp_enqueue_script( 'classic_portfolio_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'classic_portfolio_customize_preview_js' );
