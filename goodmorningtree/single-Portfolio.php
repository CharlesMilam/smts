<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */

    get_header();

    $content_position = ( $cloud_clarity_options['portfolio_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
?>
    <div id="content-container" class="container_24">
	<div id="main-content" class="<?php echo $content_position; ?>">
	    <div class="main-content-padding">
<?php	    if (have_posts()) :
		while (have_posts()) : the_post(); ?>
		    <div <?php post_class() ?> id="post-<?php the_ID();?>">
			<div class="post-top">
<?php			    if( $cloud_clarity_options['show_portfolio_post_date'] == 'yes' ) : ?>
				<div class="post-date">
				    <span class="day"><?php the_time('d') ?></span>
				    <span class="month"><?php the_time('M') ?></span>
				    <span class="year"><?php the_time('Y') ?></span>
				</div>
<?php			    endif; ?>
			    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			</div>
			<div class="entry">
<?php			    the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'cloud_clarity'));
			    wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
<?php			    if( $cloud_clarity_options['show_portfolio_postmetadata'] == 'yes' ) : ?>
				<div class="postmetadata"><?php the_tags(__('Tags: ', 'cloud_clarity'), ', ', '<br />'); ?> <?php esc_html_e('Posted in ', 'cloud_clarity'); ?><?php the_category(', '); ?> | <?php edit_post_link(__('Edit', 'cloud_clarity'), '', ' | '); ?>  <?php comments_popup_link( __( 'Leave a comment', 'cloud_clarity' ), __( '1 Comment', 'cloud_clarity' ), __( '% Comments', 'cloud_clarity' ) ); ?></div>
<?php			    endif; ?>
			</div>
		    </div>

<?php		    if( $cloud_clarity_options['show_portfolio_comments'] == 'yes' ) {
			comments_template();
		    }
		    
		endwhile; else: ?>
		    <p><?php esc_html_e("Sorry, no posts matched your criteria.", 'cloud_clarity'); ?></p>
<?php	    endif; ?>

	    </div><!-- end main-content-padding -->
	</div><!-- end main-content -->
<?php
	    if( sidebar_exist('PortfolioSidebar') ) { get_sidebar('PortfolioSidebar'); }
?>
    </div><!-- end content-container -->



