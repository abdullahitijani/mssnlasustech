<?php
/**
 * @package Classic Portfolio
 */
?>

<?php
    $classic_portfolio_post_date = get_the_date();
    
    $classic_portfolio_author_name = get_the_author();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    
    <?php 
    $classic_portfolio_designation = get_post_meta($post->ID, 'classic_portfolio_designation', true);
    
    if ($classic_portfolio_designation) : ?>
        <p class="serv-content"><?php echo esc_html($classic_portfolio_designation); ?></p>
    <?php endif; ?>
    <div class="social-icon text-start">
        <?php
        $classic_portfolio_facebook_link = get_post_meta($post->ID, 'classic_portfolio_facebook_link', true);
        $classic_portfolio_twitter_link = get_post_meta($post->ID, 'classic_portfolio_twitter_link', true);
        $classic_portfolio_telegram_link = get_post_meta($post->ID, 'classic_portfolio_telegram_link', true);

        if ($classic_portfolio_facebook_link || $classic_portfolio_twitter_link || $classic_portfolio_telegram_link) :
        ?>
            <div class="meta-fields text-start">
                <?php if ($classic_portfolio_facebook_link) : ?>
                    <a href="<?php echo esc_url($classic_portfolio_facebook_link); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                <?php endif; ?>

                <?php if ($classic_portfolio_twitter_link) : ?>
                    <a href="<?php echo esc_url($classic_portfolio_twitter_link); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                <?php endif; ?>

                <?php if ($classic_portfolio_telegram_link) : ?>
                    <a href="<?php echo esc_url($classic_portfolio_telegram_link); ?>" target="_blank"><i class="fab fa-telegram"></i></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if (has_post_thumbnail() ){ ?>
        <div class="post-thumb">
           <?php the_post_thumbnail(); ?>
        </div>
    <?php } ?>

    <?php if ('post' == get_post_type()) : ?>
        <div class="postmeta">
            <div class="post-date">
                <i class="fas fa-calendar-alt"></i> &nbsp;<?php echo esc_html($classic_portfolio_post_date); ?>
            </div>
            <div class="post-comment">&nbsp; &nbsp;
                <i class="fa fa-comment"></i> &nbsp; <?php comments_number(); ?>
            </div>
            <div class="post-author">&nbsp; &nbsp;
                <i class="fas fa-user"></i> &nbsp; <?php echo esc_html($classic_portfolio_author_name); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'classic-portfolio' ),
                'after'  => '</div>',
            ) );
        ?>
        <div class="tags"><?php the_tags(); ?></div>
    </div>
    <footer class="entry-meta">
        <?php edit_post_link( __( 'Edit', 'classic-portfolio' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>