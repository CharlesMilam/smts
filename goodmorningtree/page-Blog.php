<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
/**
 * Template Name: Blog page
 */


get_header();

global $more; $more = 0; // Enable 'more tag' for this page
global $post; $page_id = $post->ID;  // get the page id outside the loop
$content_position = ( $cloud_clarity_options['blog_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';

$exclude_portfolio_from_blog = $cloud_clarity_options['exclude_portfolio_from_blog'];

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //adhere to paging rules

if ( $exclude_portfolio_from_blog == 'yes' ) {
    // get the portfolio categories to be excluded from the Blog section
    $portfolio_categories = $cloud_clarity_options['portfolio_categories'];
    $portfolio_cats_array = explode(',', $portfolio_categories);
    function add_minus_prefix( $var ) {
	return( '-' . $var);
    }
    $portfolio_cats_array_with_minus = array_map( "add_minus_prefix", $portfolio_cats_array );
    $portfolio_cats_with_minus = implode(',', $portfolio_cats_array_with_minus);
    $query_string = "cat=$portfolio_cats_with_minus&paged=$paged";
} else {
    $query_string = "paged=$paged";
}

query_posts( $query_string );

?>
<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">
<?php	    if (have_posts()) :
		while (have_posts()) : the_post(); ?>
		    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="post-top">
			    <div class="post-date">
				<span class="day"><?php the_time('d') ?></span>
				<span class="month"><?php the_time('M') ?></span>
				<span class="year"><?php the_time('Y') ?></span>
			    </div>
			    <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			</div>
			<div class="entry">
<?php			    $post_image_url = get_post_meta($post->ID, 'postImage', true); // Grab the preview image from the custom field 'postImage', if set.
			    if ( $post_image_url ) : ?>
			    <div class="postImageHolder pngfix">
				<div class="postImage">
				    <span class="post-hover-image pngfix"> </span>
				    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="hover-opacity" src="<?php echo get_bloginfo("template_directory"); ?>/scripts/timthumb.php?src=<?php echo $post_image_url; ?>&amp;w=590&amp;h=190&amp;zc=1&amp;q=80" alt="<?php the_title_attribute(); ?>" /></a>
				</div>
			    </div>
<?php			    endif; ?>
<?php			    //the_content('Read the rest of this entry &raquo;'); ?>
<?php			    the_excerpt(); ?>
<?php			    if ( $cloud_clarity_options['blog_button_text'] ) : ?>
				<div class="clear"></div>
				    <a class="pngfix small-dark-button align-btn-left" href="<?php the_permalink(); ?>" title=""><span class="pngfix"><?php echo $cloud_clarity_options['blog_button_text']; ?></span></a>
				<div class="clear"></div>
<?php			    endif; ?>
			    <div class="postmetadata"><?php the_tags(__('Tags: ', 'cloud_clarity'), ', ', '<br />'); ?> <?php esc_html_e('Posted in ', 'cloud_clarity'); ?><?php the_category(', '); ?> | <?php edit_post_link(__('Edit', 'cloud_clarity'), '', ' | '); ?>  <?php comments_popup_link( __( 'Leave a comment', 'cloud_clarity' ), __( '1 Comment', 'cloud_clarity' ), __( '% Comments', 'cloud_clarity' ) ); ?></div>
			</div>
		    </div>
<?php		endwhile; ?>

		<div class="clear"></div>
<?php		//Pagination
		include('scripts/pagination/wp-pagenavi.php');
		if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

<?php	    else : ?>
		<h2 class="center"><?php esc_html_e('Not Found', 'cloud_clarity'); ?></h2>
		<p class="center"><?php esc_html_e("Sorry, but you are looking for something that isn't here.", 'cloud_clarity'); ?></p>
<?php		get_search_form();
	    endif;
	    //Reset Query
	    wp_reset_query(); ?>

	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->

<?php	if( sidebar_exist('BlogSidebar') ) { get_sidebar('BlogSidebar'); } ?>

</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();


