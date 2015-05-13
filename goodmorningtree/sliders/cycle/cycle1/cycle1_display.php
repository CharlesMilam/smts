<?php

	    $c1_slides_array = explode( ',', $qualifire_options['c1_slides_order_str'] );
	    $hide_controls = ( count($c1_slides_array) < 2 ) ? 'visibility:hidden': '';
	    $c1_no_3d_shadow = $qualifire_options['c1_remove_3d_shadow'];
	    $c1_image_width = $qualifire_options['c1_image_width'];
	    $c1_image_height = $qualifire_options['c1_image_height'];
?>

	    <div id="c1-header">
		<div id="header-content" class="container_24">
		    <div class="c1-slideshow">
			    <div class="c1-slider-navigation" style="width:<?php echo $c1_image_width.'px'; ?>; <?php echo $hide_controls; ?>">
				<a href="#"><span id="slider-prev" class="pngfix"><?php esc_html_e('Prev', 'qualifire'); ?></span></a>
				<a href="#"><span id="slider-next" class="pngfix"><?php esc_html_e('Next', 'qualifire'); ?></span></a>
			    </div>
			    <ul id="c1-slider">
<?php				foreach( $c1_slides_array as $slide_row_number ) :
				    $c1_slide_link_url = $qualifire_options['c1_slide_link_url_'.$slide_row_number];
				    $c1_slide_link_target = $qualifire_options['c1_slide_link_target_'.$slide_row_number]; ?>
				    <li style="width:<?php echo $c1_image_width.'px'; ?>; height:<?php echo $c1_image_height.'px'; ?>;">
					<div class="c1-slide-img-wrapper">
<?php					    echo ($c1_slide_link_url) ? "<a href='{$c1_slide_link_url}' target='_{$c1_slide_link_target}'>" : '' ; ?>
						<img src="<?php echo $qualifire_options['c1_slide_img_url_'.$slide_row_number]; ?>" alt="" class="slide-img" />
<?php					    echo ($c1_slide_link_url) ? "</a>" : '' ; ?>
					</div>
				    </li>
<?php				endforeach; ?>
			    </ul>
			    <input type="hidden" class="base-url" value="<?php bloginfo('wpurl'); ?>" />
		    </div>
		    <!-- end c1-slideshow -->
		    <span id="c1-resumeButton" style="<?php echo $hide_controls; ?>"><a href="" title="<?php esc_attr_e('Play', 'qualifire'); ?>" class="pngfix"><?php esc_html_e('Play', 'qualifire'); ?></a></span>
		    <span id="c1-pauseButton" style="<?php echo $hide_controls; ?>"><a href="" title="<?php esc_attr_e('Pause', 'qualifire'); ?>" class="pngfix"><?php esc_html_e('Pause', 'qualifire'); ?></a></span>
		    <div id="c1-nav" style="<?php echo $hide_controls; ?>"></div>
		    
		</div>
		<!-- end header-content -->
<?php		if ( !$c1_no_3d_shadow == 'yes' ) : ?>
		    <div class="clear"></div>
		    <div id="c1-shadow" class="container_24 pngfix"> </div>
<?php		endif; ?>
	    </div>
	    <!-- end c1-header -->