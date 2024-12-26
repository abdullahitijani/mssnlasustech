<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Classic Portfolio
 */

get_header(); ?>

<div id="content" >

<?php
$classic_portfolio_slider = get_theme_mod('classic_portfolio_slider', false);
$classic_portfolio_banner_pageboxes = get_theme_mod('classic_portfolio_banner_pageboxes', false);

if ($classic_portfolio_slider && $classic_portfolio_banner_pageboxes) { ?>
    <div id="slider-cat" class="pb-md-5">
        <div class="container">
            <?php
            $classic_portfolio_querymed = new WP_Query(array(
                'page_id' => esc_attr($classic_portfolio_banner_pageboxes)
            ));

            while ($classic_portfolio_querymed->have_posts()) : $classic_portfolio_querymed->the_post(); ?>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 align-self-center mb-md-0 mb-2">
                        <div class="text-content sliderbox">
                            <?php if (get_theme_mod('classic_portfolio_banner_small_title') != '') { ?>
                                <p class="slider-smalltitle text-uppercase"><?php echo esc_html(get_theme_mod('classic_portfolio_banner_small_title', 'classic-portfolio')); ?></p>
                            <?php } ?>
                            <h1 class="my-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php
                            $classic_portfolio_trimexcerpt = get_the_excerpt();
                            $classic_portfolio_shortexcerpt = wp_trim_words($classic_portfolio_trimexcerpt, 38);
                            echo '<p class="slider-content">' . esc_html($classic_portfolio_shortexcerpt) . '</p>';
                            ?>
                            <div class="sliderbtn mt-3">
                                <?php
                                $classic_portfolio_button_text = get_theme_mod('classic_portfolio_button_text', 'Contact Us');
                                $classic_portfolio_button_link_banner = get_theme_mod('classic_portfolio_button_link_banner', get_permalink());
                                if ($classic_portfolio_button_text || !empty($classic_portfolio_button_link_banner)) { ?>
                                    <?php if ($classic_portfolio_button_text != '') { ?>
                                        <div class="slide-btn">
                                            <a href="<?php echo esc_url($classic_portfolio_button_link_banner); ?>" class="button redmor">
                                                <i class="fas fa-chevron-right"></i>
                                                <?php echo esc_html($classic_portfolio_button_text); ?>
                                                <span class="screen-reader-text"><?php echo esc_html($classic_portfolio_button_text); ?></span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12 align-self-center slider-img-col position-relative">
                        <div class="imagebox">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('full');
                            } else { ?>
                                <div class="slider-img-color"></div>
                            <?php } ?>
                        </div>

                        <?php 
                        $classic_portfolio_customer_review = get_theme_mod('classic_portfolio_customer_review', '');
                        $classic_portfolio_total_customer_review = get_theme_mod('classic_portfolio_total_customer_review', '');
                        $classic_portfolio_selected_category = get_theme_mod('classic_portfolio_about_catData', 'select');

                        if (!empty($classic_portfolio_customer_review) || !empty($classic_portfolio_total_customer_review) || $classic_portfolio_selected_category != 'select') : ?>
                        <div class="rating-col">
                            <div class="rating-box my-3">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-4 align-self-center ps-4">
                                        <div class="customzer-rating">
                                            <span class="customer-review"><?php echo esc_html($classic_portfolio_customer_review); ?></span>
                                        </div>
                                        <div class="customzer-rating">
                                            <span class="total-customer-review"><?php echo esc_html($classic_portfolio_total_customer_review); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-8 align-self-center">
                                        <?php if ($classic_portfolio_selected_category != 'select') : ?>
                                        <div class="abt-cat">
                                            <div class="owl-carousel m-0">
                                                <?php
                                                $abtpage_query = new WP_Query(array(
                                                    'category_name' => esc_attr($classic_portfolio_selected_category),
                                                    'posts_per_page' => -1,
                                                ));
                                                if ($abtpage_query->have_posts()) :
                                                    while ($abtpage_query->have_posts()) : $abtpage_query->the_post(); ?>
                                                        <div class="abt-imagebox">
                                                            <?php if (has_post_thumbnail()) { ?>
                                                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" />
                                                            <?php } else { ?>
                                                                <div class="abt-img-color"></div>
                                                            <?php } ?>
                                                        </div>
                                                    <?php endwhile;
                                                    wp_reset_postdata();
                                                else : ?>
                                                    <p><?php esc_html_e('No posts found in this category.', 'classic-portfolio'); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12 align-self-center slider-img-col position-relative">
                        <div class="sliderbox-sec">
                            <?php if (get_theme_mod('classic_portfolio_total_no_satisfied_customer') != '') { ?>
                                <div class="customer-counter my-lg-5 my-4">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-4 align-self-center counter-icon">
                                            <i class="fas fa-smile"></i>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-8 align-self-center">
                                            <div class="customer-no"><?php echo esc_html(get_theme_mod('classic_portfolio_total_no_satisfied_customer', '')); ?></div>
                                            <div class="centers-text"><?php esc_html_e('Satisfied Customer', 'classic-portfolio'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (get_theme_mod('classic_portfolio_total_no_award_win') != '') { ?>
                                <div class="customer-counter my-lg-5 my-4">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-4 align-self-center counter-icon">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-8 align-self-center">
                                            <div class="customer-no"><?php echo esc_html(get_theme_mod('classic_portfolio_total_no_award_win', '')); ?></div>
                                            <div class="centers-text"><?php esc_html_e('Award Win', 'classic-portfolio'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (get_theme_mod('classic_portfolio_total_no_successfull_projects') != '') { ?>
                                <div class="customer-counter my-lg-5 my-4">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-4 align-self-center counter-icon">
                                            <i class="far fa-edit"></i>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-8 align-self-center">
                                            <div class="customer-no"><?php echo esc_html(get_theme_mod('classic_portfolio_total_no_successfull_projects', '')); ?></div>
                                            <div class="centers-text"><?php esc_html_e('Successful Project', 'classic-portfolio'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (get_theme_mod('classic_portfolio_total_year_experience') != '') { ?>
                                <div class="customer-counter my-lg-5 my-4">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-4 align-self-center counter-icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="col-lg-9 col-md-8 col-8 align-self-center">
                                            <div class="customer-no"><?php echo esc_html(get_theme_mod('classic_portfolio_total_year_experience', '')); ?></div>
                                            <div class="centers-text"><?php esc_html_e('Year Of Experience', 'classic-portfolio'); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>

<?php
$classic_portfolio_hidepageboxes = get_theme_mod('classic_portfolio_disabled_pgboxes', false);
$classic_portfolio_num_courses = get_theme_mod('classic_portfolio_num_courses', 8);

if ($classic_portfolio_hidepageboxes) {
?>
    <section id="service_section" class="my-5 text-center">
        <div class="container">
            <div class="blog_bx mx-lg-5 px-lg-5 text-center mb-md-4">
                <?php if (get_theme_mod('classic_portfolio_headingtext1') != "") { ?>
                    <h2 class="subhed mb-3 text-capitalize"><?php echo esc_html(get_theme_mod('classic_portfolio_headingtext1', 'classic-portfolio')); ?></h2>
                <?php } ?>
                <?php if (get_theme_mod('classic_portfolio_headingtext_para') != "") { ?>
                    <p class="mb-3 text-capitalize experience-detail"><?php echo esc_html(get_theme_mod('classic_portfolio_headingtext_para', 'classic-portfolio')); ?></p>
                <?php } ?>
                <div class="abt-btn my-4">
                  <?php if ( get_theme_mod('classic_portfolio_education_btn_text', 'My Education') != "" && get_theme_mod('classic_portfolio_education_btn_url') != "") { ?> 
                    <span class="contact-us btn1 text-center me-md-3">
                      <a href="<?php echo esc_url(get_theme_mod ('classic_portfolio_education_btn_url','')); ?>" class="mb-2"><i class="me-2 fas fa-graduation-cap"></i><?php echo esc_html(get_theme_mod ('classic_portfolio_education_btn_text','My Education','classic-portfolio')); ?></a>
                    </span>
                  <?php }?>
                  <?php if ( get_theme_mod('classic_portfolio_experience_btn_text','My Experience') != "" && get_theme_mod('classic_portfolio_experience_btn_url') != "") { ?> 
                    <span class="contact-us btn2 text-center">
                      <a href="<?php echo esc_url(get_theme_mod ('classic_portfolio_experience_btn_url','')); ?>"> <i class="me-2 fas fa-star"></i><?php echo esc_html(get_theme_mod ('classic_portfolio_experience_btn_text','My Experience','classic-portfolio')); ?></a>
                    </span>
                  <?php }?>
                </div>
            </div>

            <div class="row">
                <?php for ($classic_portfolio_i = 1; $classic_portfolio_i <= $classic_portfolio_num_courses; $classic_portfolio_i++) { 
                    $classic_portfolio_course_year = get_theme_mod('classic_portfolio_course_year' . $classic_portfolio_i, '');
                    $classic_portfolio_course_name = get_theme_mod('classic_portfolio_course_name' . $classic_portfolio_i, '');
                    $classic_portfolio_university_name = get_theme_mod('classic_portfolio_university_name' . $classic_portfolio_i, '');
                
                    $classic_portfolio_has_details = !empty($classic_portfolio_course_year) || !empty($classic_portfolio_course_name) || !empty($classic_portfolio_university_name);
                ?>
                    <div class="col-lg-3 col-md-3 mb-4 mb-md-0 course-border<?php echo $classic_portfolio_has_details ? ' class-with-border class-course-' . esc_attr($classic_portfolio_i) : ''; ?>">
                        <div class="main-courses-box p-4 text-md-start text-center">
                            <p class="exper-year mb-2"><?php echo esc_html($classic_portfolio_course_year); ?></p>
                            <h3 class="course-name"><?php echo esc_html($classic_portfolio_course_name); ?></h3>
                            <p class="university-name"><?php echo esc_html($classic_portfolio_university_name); ?></p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
<?php } ?>

</div>
<?php get_footer(); ?>
