<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
get_header();

$content_position = ( $cloud_clarity_options['blog_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';

?>

<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">

	    <?php if (have_posts()) : ?>

		  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

			<?php while (have_posts()) : the_post(); ?>
			    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<div class="post-top">
				    <div class="post-date">
					<span class="day"><?php the_time('d') ?></span>
					<span class="month"><?php the_time('M') ?></span>
					<span class="year"><?php the_time('Y') ?></span>
				    </div>
				    <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cloud_clarity' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				</div>
				<div class="entry">
<?php				    $post_image_url = get_post_meta($post->ID, 'postImage', true); // Grab the preview image from the custom field 'postImage', if set.
				    if ( $post_image_url ) : ?>
				    <div class="postImageHolder pngfix">
					<div class="postImage">
					    <span class="post-hover-image pngfix"> </span>
					    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="hover-opacity" src="<?php echo get_bloginfo("template_directory"); ?>/scripts/timthumb.php?src=<?php echo $post_image_url; ?>&amp;w=590&amp;h=190&amp;zc=1&amp;q=80" alt="<?php the_title_attribute(); ?>" /></a>
					</div>
				    </div>
<?php				    endif; ?>
<?php				    //the_content('Read the rest of this entry &raquo;'); ?>
<?php				    the_excerpt(); ?>
<?php				    if ( $cloud_clarity_options['blog_button_text'] ) : ?>
					<div class="clear"></div>
					    <a class="pngfix small-dark-button align-btn-left" href="<?php the_permalink(); ?>" title=""><span class="pngfix"><?php echo $cloud_clarity_options['blog_button_text']; ?></span></a>
					<div class="clear"></div>
<?php				    endif; ?>
				    <div class="postmetadata"><?php the_tags(__('Tags: ', 'cloud_clarity'), ', ', '<br />'); ?> <?php esc_html_e('Posted in ', 'cloud_clarity'); ?><?php the_category(', '); ?> | <?php edit_post_link(__('Edit', 'cloud_clarity'), '', ' | '); ?>  <?php comments_popup_link( __( 'Leave a comment', 'cloud_clarity' ), __( '1 Comment', 'cloud_clarity' ), __( '% Comments', 'cloud_clarity' ) ); ?></div>
				</div>
			    </div>
			<?php endwhile; ?>

			<div class="clear"></div>
<?php			//Pagination
			include('scripts/pagination/wp-pagenavi.php');
			if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
?>
	    <?php else :
		if ( is_category() ) { // If this is a category archive
			printf(__("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", 'cloud_clarity'), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			_e("<h2>Sorry, but there aren't any posts with this date.</h2>", 'cloud_clarity');
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", 'cloud_clarity'), $userdata->display_name);
		} else {
			_e("<h2 class='center'>No posts found.</h2>", 'cloud_clarity');
		}
		get_search_form();
	    endif;
?>
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->

<?php	if( sidebar_exist('BlogSidebar') ) { get_sidebar('BlogSidebar'); } ?>

</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();



