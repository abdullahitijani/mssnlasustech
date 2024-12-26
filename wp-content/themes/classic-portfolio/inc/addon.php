<?php
/*
 * @package Classic Portfolio
 */

function classic_portfolio_admin_enqueue_scripts() {
    wp_enqueue_style( 'classic-portfolio-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'classic_portfolio_admin_enqueue_scripts' );

add_action('after_switch_theme', 'classic_portfolio_options');

function classic_portfolio_options() {
    global $pagenow;
    if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        wp_redirect( admin_url( 'themes.php?page=classic-portfolio' ) );
        exit;
    }
}

function classic_portfolio_theme_info_menu_link() {

    $classic_portfolio_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'classic-portfolio' ), $classic_portfolio_theme->get( 'Name' ), $classic_portfolio_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'classic-portfolio' ),'edit_theme_options','classic-portfolio','classic_portfolio_theme_info_page'
    );
}
add_action( 'admin_menu', 'classic_portfolio_theme_info_menu_link' );

function classic_portfolio_theme_info_page() {

    $classic_portfolio_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'classic-portfolio' ), esc_html($classic_portfolio_theme->get( 'Name' )), esc_html($classic_portfolio_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'classic-portfolio' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'classic-portfolio' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( CLASSIC_PORTFOLIO_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'classic-portfolio' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'classic-portfolio' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'classic-portfolio' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'classic-portfolio' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'classic-portfolio' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'classic-portfolio' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'classic-portfolio' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'classic-portfolio' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'classic-portfolio' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'classic-portfolio' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'classic-portfolio' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'classic-portfolio' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'classic-portfolio' ),
        esc_html($classic_portfolio_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'classic-portfolio' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($classic_portfolio_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $classic_portfolio_theme->get_screenshot() ); ?>" alt=""/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'classic-portfolio' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'classic-portfolio' ),esc_html($classic_portfolio_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'classic-portfolio' ); ?></a>
                        <a href="<?php echo esc_url( CLASSIC_PORTFOLIO_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'classic-portfolio' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'classic-portfolio' ),
            esc_html($classic_portfolio_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'classic-portfolio' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( CLASSIC_PORTFOLIO_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'classic-portfolio' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'classic-portfolio' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}
?>
