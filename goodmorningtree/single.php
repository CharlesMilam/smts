<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */

global $cloud_clarity_options;

// construct an array of portfolio categories
$portfolio_categories_array = explode( ',', $cloud_clarity_options['portfolio_categories'] );

if ( $portfolio_categories_array != "" && post_is_in_category_or_descendants( $portfolio_categories_array ) ) :
    // Test if this Post is assigned to the Portfolio category or any descendant and switch the single's template accordingly
    include 'single-Portfolio.php';
else : // Continue with normal Loop (Blog category)

    get_header();

    $content_position = ( $cloud_clarity_options['blog_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
?>
    <div id="content-container" class="container_24">
	<div id="main-content" class="<?php echo $content_position; ?>">
	    <div class="main-content-padding">
<?php		if (have_posts()) :
		    while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			    <div class="post-top">
				<div class="post-date">
				    <span class="day"><?php the_time('d') ?></span>
				    <span class="month"><?php the_time('M') ?></span>
				    <span class="year"><?php the_time('Y') ?></span>
				</div>
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			    </div>
			    <div class="entry">
<?php				the_content(__('<p class="serif">Read the rest of this entry &raquo;</p>', 'cloud_clarity'));
				wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<div class="postmetadata"><?php the_tags(__('Tags: ', 'cloud_clarity'), ', ', '<br />'); ?> <?php esc_html_e('Posted in ', 'cloud_clarity'); ?><?php the_category(', '); ?> | <?php edit_post_link(__('Edit', 'cloud_clarity'), '', ' | '); ?>  <?php comments_popup_link( __( 'Leave a comment', 'cloud_clarity' ), __( '1 Comment', 'cloud_clarity' ), __( '% Comments', 'cloud_clarity' ) ); ?></div>
			    </div>
			</div>
<?php			comments_template();
		    endwhile; else: ?>
			<p><?php esc_html_e("Sorry, no posts matched your criteria.", 'cloud_clarity'); ?></p>
<?php		endif; ?>
	    </div><!-- end main-content-padding -->
	</div><!-- end main-content -->
<?php
	    if( sidebar_exist('BlogSidebar') ) { get_sidebar('BlogSidebar'); }
?>
    </div><!-- end content-container -->
<?php
endif; // end normal Loop ?>

<div class="clear"></div>

<?php

get_footer(); 


