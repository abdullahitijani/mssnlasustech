<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Classic Portfolio
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('classic_portfolio_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'classic-portfolio' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'classic_portfolio_box_layout', false) != "" ) { echo 'class="boxlayout"'; } ?>>

<div class="mainhead">
  <div class="header py-3">
    <div class="container">
      <div class="row m-0">
        <div class="col-lg-3 col-md-4 align-self-center px-md-0">
          <div class="logo text-center text-md-start">
            <?php classic_portfolio_the_custom_logo(); ?>
            <div class="site-branding-text">
              <?php if (get_theme_mod('classic_portfolio_title_enable', true)) { ?>
                <?php if (is_front_page() && is_home()) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>
              <?php } ?>
              <?php $classic_portfolio_description = get_bloginfo('description', 'display');
              if ($classic_portfolio_description || is_customize_preview()) : ?>
                <?php if (get_theme_mod('classic_portfolio_tagline_enable', false)) { ?>
                  <span class="site-description"><?php echo esc_html($classic_portfolio_description); ?></span>
                <?php } ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-4 col-4 align-self-center">
          <div class="toggle-nav text-center">
            <?php if (has_nav_menu('primary')) { ?>
              <button role="tab"><?php esc_html_e('Menu', 'classic-portfolio'); ?></button>
            <?php } ?>
          </div>
          <div id="mySidenav" class="nav sidenav px-lg-5">
            <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Top Menu', 'classic-portfolio'); ?>">
              <ul class="mobile_nav">
                <?php wp_nav_menu(array(
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu',
                  'items_wrap' => '%3$s',
                  'fallback_cb' => 'wp_page_menu',
                )); ?>
              </ul>
              <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE', 'classic-portfolio'); ?></a>
            </nav>
          </div>
        </div>
        <div class="col-lg-2 col-md-4 col-8 align-self-center">
          <?php if ( get_theme_mod('classic_portfolio_header_btn_text') != "" && get_theme_mod('classic_portfolio_header_btn_url') != "") { ?> 
            <div class="contact-us text-md-end text-center">
              <a href="<?php echo esc_url(get_theme_mod ('classic_portfolio_header_btn_url','')); ?>"><i class="fas fa-chevron-right me-2 head-icon"></i><?php echo esc_html(get_theme_mod ('classic_portfolio_header_btn_text','Download CV','classic-portfolio')); ?></a>
            </div>
          <?php }?>
        </div>
      </div>
      </div>
    </div>
  </div>