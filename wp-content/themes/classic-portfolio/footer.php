<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Classic Portfolio
 */
?>
<div id="footer">
  <?php 
    $classic_portfolio_footer_widget_enabled = get_theme_mod('classic_portfolio_footer_widget', true);
    
    if ($classic_portfolio_footer_widget_enabled !== false && $classic_portfolio_footer_widget_enabled !== '') { ?>

    <?php 
        $classic_portfolio_widget_areas = get_theme_mod('classic_portfolio_footer_widget_areas', '4');
        if ($classic_portfolio_widget_areas == '3') {
            $classic_portfolio_cols = 'col-lg-4 col-md-6';
        } elseif ($classic_portfolio_widget_areas == '4') {
            $classic_portfolio_cols = 'col-lg-3 col-md-6';
        } elseif ($classic_portfolio_widget_areas == '2') {
            $classic_portfolio_cols = 'col-lg-6 col-md-6';
        } else {
            $classic_portfolio_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($classic_portfolio_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'classic-portfolio'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'classic-portfolio'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($classic_portfolio_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'classic-portfolio'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'classic-portfolio'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($classic_portfolio_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'classic-portfolio'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'classic-portfolio'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($classic_portfolio_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'classic-portfolio'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'classic-portfolio'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
    <div class="clear"></div>
  <div class="copywrap text-center">
    <div class="container">
      <p>
        <a href="<?php 
          $classic_portfolio_copyright_link = get_theme_mod('classic_portfolio_copyright_link', '');
          if (empty($classic_portfolio_copyright_link)) {
              echo esc_url('https://www.theclassictemplates.com/products/free-portfolio-wordpress-theme');
          } else {
              echo esc_url($classic_portfolio_copyright_link);
          } ?>" target="_blank">
          <?php echo esc_html(get_theme_mod('classic_portfolio_copyright_line', __('Classic Portfolio WordPress Theme', 'classic-portfolio'))); ?>
        </a> 
        <?php echo esc_html('By Classic Templates', 'classic-portfolio'); ?>
      </p>
    </div>
  </div>
</div>

<?php if(get_theme_mod('classic_portfolio_scroll_hide',true)){ ?>
 <a id="button"><?php esc_html_e('TOP', 'classic-portfolio'); ?></a>
<?php } ?>
  
<?php wp_footer(); ?>
</body>
</html>



 
