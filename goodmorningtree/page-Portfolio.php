<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
/**
 * Template Name: Portfolio page
 */

get_header();

global $post; $page_id = $post->ID;  // get the page id outside the loop
$portfolio_cat_ID = $cloud_clarity_options['portfolio_cat_for_page_'.$page_id]; // Get the portfolio category specified by the user in the 'cloud_clarity Options' page
$current_categoryID = $_GET['cat'];
$categories =  get_categories( 'child_of='.$portfolio_cat_ID );
$query_string_prefix = ( get_option('permalink_structure') != '' ) ? '?' : '&amp;';
$portfolio_items_per_page = $cloud_clarity_options['portfolio_items_per_page_for_page_'.$page_id];
$portfolio_title_posistion = $cloud_clarity_options['portfolio_title_posistion'];

?>

<div id="content-container" class="container_24">
<?php
    // Check if a category has been assigned as Portfolio section
    if( $portfolio_cat_ID ) : ?>
    
      <div class="thumbsWrapper">
<?php	if ( $categories ) : ?>
	    <div id="categoryLinks" class="grid_22">
		<ul>
		    <li>Categories: &nbsp;&nbsp;&nbsp;</li>
<?php		    // Generate the link to "All" categories:
		    if ( $current_categoryID ) : ?>
			<li><a href="<?php echo the_permalink(); ?>"><?php esc_html_e('All', 'cloud_clarity'); ?></a></li>
<?php		    else : ?>
			<li><a href="<?php echo the_permalink(); ?>" class="current"><?php esc_html_e('All', 'cloud_clarity'); ?></a></li>
<?php		    endif;
		    // Generate the link to the rest of categories:
		    foreach( $categories as $category ) :
			if ( $current_categoryID == $category->cat_ID ) : ?>
			    <li><a href="<?php echo the_permalink().$query_string_prefix.'cat='.$category->cat_ID; ?>" class="current"><?php echo $category->cat_name; ?></a></li>
<?php			else : ?>
			    <li><a href="<?php echo the_permalink().$query_string_prefix.'cat='.$category->cat_ID; ?>"><?php echo $category->cat_name; ?></a></li>
<?php			endif; ?>
<?php		    endforeach; ?>
		</ul>
	    </div><!-- end categoryLinks -->
<?php	endif; ?>
<?php
	if ( !$current_categoryID )
	    $current_categoryID = $portfolio_cat_ID;

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //adhere to paging rules
	// Switch the focus to the chosen portfolio category and its subcategories
	query_posts( array(
		'cat' => $current_categoryID,
		'posts_per_page' => $portfolio_items_per_page,
		'paged' => $paged
	    )
	);
	$counter = 1;
	// loop
	if (have_posts()) :
	    while (have_posts()) : the_post(); ?>
	      <div class="portfolioItemWrapper">
<?php		   if( $portfolio_title_posistion == 'above' ): ?>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<?php		   endif; ?>
		   <div class="thumbHolder pngfix">
		    <div class="portfolioImgThumb">
<?php			$thumb_url = get_post_meta($post->ID, 'thumbURL', true);
			$large_image_url = get_post_meta($post->ID, 'largeImageURL', true); // Grab the preview image from the custom field 'largeImageURL', if set.
			$item_description = get_post_meta($post->ID, 'itemDescription', true);

			if ( !$large_image_url ) { // Check if an image is found in the post and assign it as the large preview image.
			    if ( function_exists('get_image_url') && findImage() ) {
				$large_image_url = get_image_url();
			    }
			}

			if( $thumb_url ) { // thumbnail is provided
			    if ( $large_image_url ) { // if preview image is available, go ahead an link it to the thumbnail.
				echo '<span class="portfolio-zoom-image pngfix"> </span>';
				echo '<a rel="prettyPhoto[portfolio]" href="'.$large_image_url.'"><img class="hover-opacity" src="'.$thumb_url.'" alt="'.get_the_title().'" /></a>';
			    } else { // if preview image is NOT available, generate a thumbnail without a link
				echo '<span class="portfolio-zoom-image pngfix"> </span>';
				echo '<img class="hover-opacity" src="'.$thumb_url.'" alt="'.esc_attr__('Preview image not available!.', 'cloud_clarity').'" />';
			    }
			} elseif ( $large_image_url ) { // auto generate thumbnails
			    echo '<span class="portfolio-zoom-image pngfix"> </span>';
			    echo '<a rel="prettyPhoto[portfolio]" href="'.$large_image_url.'"><img class="hover-opacity" src="'.get_bloginfo("template_directory").'/scripts/timthumb.php?src='.$large_image_url.'&amp;w=250&amp;h=157&amp;zc=1&amp;q=80" alt="'.get_the_title().'" /></a>';
			}
			/* Display default image
			else {
			    echo '<img src="'.get_bloginfo("template_directory").'/styles/common-images/thumbnail-default.jpg" alt="Default Image" width="250" height="157" />';
			} */
?>
		    </div><!-- end portfolioImgThumb -->
		   </div><!-- end thumbHolder -->

<?php		if ( $item_description ) : ?>
<?php		    if( $portfolio_title_posistion == 'below' ): ?>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
<?php		    endif; ?>
		    <div class="clear"></div>
<?php		    echo $item_description; ?> <a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php esc_html_e('Read more...', 'cloud_clarity'); ?></a>
<?php		endif; ?>

	      </div><!-- end portfolioItemWrapper -->
<?php	    if ( $counter++ == 3 ) {
		echo "<div class='clear'> </div>";
		$counter = 1;
	    }
?>
<?php	    endwhile; ?>

	    <div id="paginationPortfolio" class="grid_21 prefix_1">
<?php		//Pagination
		include('scripts/pagination/wp-pagenavi.php');
		if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	    </div>
<?php	endif; 
	//Reset Query
	wp_reset_query(); ?>
	
      </div>
<?php
    else : ?>
	<div class="grid_22 prefix_1 suffix_1">
	    <h2><?php esc_html_e('Portfolio section for this page has not been found!', 'cloud_clarity'); ?></h2>
	    <p><?php _e("<strong>Reason:</strong> No category has been assigned as Portfolio section for this page yet. In order to fix this, go to the theme's options page and assign a category for this page.", 'cloud_clarity'); ?></p>
	</div>
<?php
    endif; ?>


<?php // BEGIN the actual page content here... ?>
    <div id="main-content" class="grid_21 prefix_1">
<?php	if (have_posts()) : while (have_posts()) : the_post(); ?>
	    <div class="post" id="post-<?php the_ID(); ?>">
<?php	    if ( get_the_content() ) : ?>
		    <div class="entry">
<?php			the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'cloud_clarity'));
			wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		    </div>
<?php	    endif; ?>
	    </div>
<?php	endwhile; endif; ?>
	<div class="clear"></div>
<?php	edit_post_link(esc_html__('Edit this entry.', 'cloud_clarity'), '<p class="editLink prefix_1">', '</p>'); ?>

    </div><!-- end main-content -->
</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();




