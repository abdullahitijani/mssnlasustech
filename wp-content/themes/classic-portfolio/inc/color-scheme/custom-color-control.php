<?php

  $classic_portfolio_first_color = get_theme_mod('classic_portfolio_first_color');
  $classic_portfolio_color_scheme_css = '';

/*------------------ Global Color -----------*/

$classic_portfolio_color_scheme_css .='.header, .woocommerce button.button.alt, .page-template-template-home-page .main-nav .current_page_item a, .slider-img-color, .postsec-list .search-form input.search-submit, span.page-numbers.current, .nav-links .page-numbers:hover, input.search-submit, .page-links a, .page-links span, .tagcloud a:hover, .copywrap, .breadcrumb a, nav.woocommerce-MyAccount-navigation ul li, .woocommerce a.button, a.wc-block-components-checkout-return-to-cart-button, button.wc-block-components-checkout-place-order-button, #commentform input#submit, .wc-block-components-totals-coupon__button.contained, #sidebar .wp-block-search__inside-wrapper .wp-block-search__button {';
    $classic_portfolio_color_scheme_css .='background-color: '.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='.postsec-list .wp-block-button__link, .site-main .wp-block-button__link, .tags a ,.serach_inner, #button, .page-template-template-home-page .header .contact-us a, #slider-cat .sliderbtn a, #service_section .abt-btn .contact-us.btn1 a, #service_section .abt-btn .contact-us.btn2 a:hover, #sidebar input.search-submit, #footer input.search-submit, form.woocommerce-product-search button, .widget_calendar caption, .widget_calendar #today, #footer input.search-submit, span.onsale {';
  $classic_portfolio_color_scheme_css .='background: '.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .= '.posted_in a, .added_to_cart, blockquote a, .postsec-list .wp-block-button.is-style-outline a, .page-template-template-home-page .search-box i:hover, .page-template-template-home-page h1.site-title a:hover, .page-template-template-home-page .header .contact-us a i, .main-nav ul ul a:hover, #slider-cat .text-content h1 a:hover, #slider-cat .text-content p.slider-smalltitle, #slider-cat .sliderbtn a i, #slider-cat .text-content .slider-text, #service_section .abt-btn .contact-us.btn1 a i, #service_section .abt-btn .contact-us.btn2 a:hover i, .listarticle h2 a:hover, #sidebar ul li::before, #sidebar .widget a:active, #footer h6, .ftr-4-box h5, .edit-link a, .wc-block-components-button__text, .woocommerce-MyAccount-content a, .wp-block-quote a, .wc-block-cart__submit-container a, .logged-in-as a, .nav-links a, .comment-meta a, .reply a {';
$classic_portfolio_color_scheme_css .= 'color: ' . esc_attr($classic_portfolio_first_color) . ' !important;';
$classic_portfolio_color_scheme_css .= '}';

$classic_portfolio_color_scheme_css .='.site-main .wp-block-button.is-style-outline a, .postsec-list .wp-block-button.is-style-outline a, .widget .tagcloud a:hover {';
  $classic_portfolio_color_scheme_css .='border: 1px solid'.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='.main-nav ul.sub-menu li a:focus, .main-nav ul ul a:focus, .serach_inner input[type="submit"]:focus, .postsec-list .search-form input.search-submit, #sidebar input[type="text"], #sidebar input[type="search"], #footer input[type="search"] {';
  $classic_portfolio_color_scheme_css .='border: 2px solid'.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='.main-nav li ul {';
  $classic_portfolio_color_scheme_css .='border-top: 3px solid'.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='#sidebar .widget{';
  $classic_portfolio_color_scheme_css .='border-bottom: 3px solid'.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='.tagcloud a:hover {';
  $classic_portfolio_color_scheme_css .='border-color: '.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='.wp-block-quote:not(.is-large):not(.is-style-large), blockquote {';
  $classic_portfolio_color_scheme_css .='border-left: 5px solid'.esc_attr($classic_portfolio_first_color).'!important;';
$classic_portfolio_color_scheme_css .='}';

$classic_portfolio_color_scheme_css .='
@media screen and (max-width:1000px) {
  .toggle-nav button {';
    $classic_portfolio_color_scheme_css .='background-color: '.esc_attr($classic_portfolio_first_color).' !important;';
$classic_portfolio_color_scheme_css .='} }';  

$classic_portfolio_color_scheme_css .='
@media screen and (max-width: 767px) {
  .toggle-nav button {';
    $classic_portfolio_color_scheme_css .='background-color: '.esc_attr($classic_portfolio_first_color).' !important;';
$classic_portfolio_color_scheme_css .='} }';  

$classic_portfolio_color_scheme_css .='
@media screen and (min-width: 768px) and (max-width: 999px) {
  .toggle-nav button {';
    $classic_portfolio_color_scheme_css .='background: '.esc_attr($classic_portfolio_first_color).' !important;';
$classic_portfolio_color_scheme_css .='} }';  

//---------------------------------Logo-Max-height--------- 
  $classic_portfolio_logo_width = get_theme_mod('classic_portfolio_logo_width');

  if($classic_portfolio_logo_width != false){

    $classic_portfolio_color_scheme_css .='.logo .custom-logo-link img{';

      $classic_portfolio_color_scheme_css .='width: '.esc_html($classic_portfolio_logo_width).'px;';

    $classic_portfolio_color_scheme_css .='}';
  }

// by default header
$classic_portfolio_slider = get_theme_mod('classic_portfolio_slider');

if($classic_portfolio_slider != true){

$classic_portfolio_color_scheme_css .='.page-template-template-home-page .header{';

  $classic_portfolio_color_scheme_css .='position: static; background-color: #111111;';

$classic_portfolio_color_scheme_css .='}';
}

 /*--------------------------- Scroll to top positions -------------------*/

 $classic_portfolio_scroll_position = get_theme_mod( 'classic_portfolio_scroll_position','Right');
 if($classic_portfolio_scroll_position == 'Right'){
     $classic_portfolio_color_scheme_css .='#button{';
         $classic_portfolio_color_scheme_css .='right: 20px;';
     $classic_portfolio_color_scheme_css .='}';
 }else if($classic_portfolio_scroll_position == 'Left'){
     $classic_portfolio_color_scheme_css .='#button{';
         $classic_portfolio_color_scheme_css .='left: 20px;';
     $classic_portfolio_color_scheme_css .='}';
 }else if($classic_portfolio_scroll_position == 'Center'){
     $classic_portfolio_color_scheme_css .='#button{';
         $classic_portfolio_color_scheme_css .='right: 50%;left: 50%;';
     $classic_portfolio_color_scheme_css .='}';
 }

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$classic_portfolio_blog_post_page_image_box_shadow = get_theme_mod('classic_portfolio_blog_post_page_image_box_shadow',0);
if($classic_portfolio_blog_post_page_image_box_shadow != false){
    $classic_portfolio_color_scheme_css .='.post-thumb img{';
        $classic_portfolio_color_scheme_css .='box-shadow: '.esc_attr($classic_portfolio_blog_post_page_image_box_shadow).'px '.esc_attr($classic_portfolio_blog_post_page_image_box_shadow).'px '.esc_attr($classic_portfolio_blog_post_page_image_box_shadow).'px #cccccc;';
    $classic_portfolio_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Sale Position -------------------*/    

$classic_portfolio_product_sale_position = get_theme_mod( 'classic_portfolio_product_sale_position','Left');
if($classic_portfolio_product_sale_position == 'Right'){
    $classic_portfolio_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
        $classic_portfolio_color_scheme_css .='left:auto !important; right:.5em !important;';
    $classic_portfolio_color_scheme_css .='}';
}else if($classic_portfolio_product_sale_position == 'Left'){
    $classic_portfolio_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
        $classic_portfolio_color_scheme_css .='right:auto !important; left:.5em !important;';
    $classic_portfolio_color_scheme_css .='}';
}   

/*--------------------------- Woocommerce Shop page pagination -------------------*/

$classic_portfolio_wooproducts_nav = get_theme_mod('classic_portfolio_wooproducts_nav', 'Yes');
if($classic_portfolio_wooproducts_nav == 'No'){
  $classic_portfolio_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $classic_portfolio_color_scheme_css .='display: none;';
  $classic_portfolio_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Related Product -------------------*/

$classic_portfolio_related_product_enable = get_theme_mod('classic_portfolio_related_product_enable',true);
if($classic_portfolio_related_product_enable == false){
  $classic_portfolio_color_scheme_css .='.related.products{';
    $classic_portfolio_color_scheme_css .='display: none;';
  $classic_portfolio_color_scheme_css .='}';
}    

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$classic_portfolio_woo_product_img_border_radius = get_theme_mod('classic_portfolio_woo_product_img_border_radius');
  if($classic_portfolio_woo_product_img_border_radius != false){
    $classic_portfolio_color_scheme_css .='.woocommerce ul.products li.product a img{';
    $classic_portfolio_color_scheme_css .='border-radius: '.esc_attr($classic_portfolio_woo_product_img_border_radius).'px;';
    $classic_portfolio_color_scheme_css .='}';
}