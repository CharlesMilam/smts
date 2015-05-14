<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */

	get_header();

	// Home Page Before Content Widget Area
	$before_cont_1_is_active = sidebar_exist_and_active('Home Page Before Content');
	if ( $before_cont_1_is_active  ) : // hide this area if no widgets are active...
?>

<div id="before-content-column" class="container_24">
	<div class="home-page-divider pngfix"></div>

	<?php
		if ( $before_cont_1_is_active ) {
	    		eval( '?>' . get_column( 'before-cont-box-1', 'column_3_of_3 home-cont-box', 'Home Page Before Content' ) . '<?php ' );
		}
	?>
		<div class="home-page-divider pngfix"></div>
	    </div>
	    <!-- end before-content-column -->

	    <div class="clear"></div>

<?php	endif; ?>


<?php
	// Home Page Main Content Widget Areas
	$cont_1_is_active = sidebar_exist_and_active('Home Page Column 1');
	$cont_2_is_active = sidebar_exist_and_active('Home Page Column 2');
	$cont_3_is_active = sidebar_exist_and_active('Home Page Column 3');
	$home_page_col_1_fixed = $cloud_clarity_options['home_page_col_1_fixed'];

	if ( $cont_1_is_active || $cont_2_is_active || $cont_3_is_active ) : // hide this area if no widgets are active...
?>

	    <div id="content-container" class="container_24">
<?php
		if ( !$home_page_col_1_fixed ) { // if the "Home Page Column 1" Widget Area width is set to stay fixed
		    // 3 active: 1 case
		    if ( $cont_1_is_active && $cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_3 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_3 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_3 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    // 2 active: 3 cases
		    if ( !$cont_1_is_active && $cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_2 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_2 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( $cont_1_is_active && !$cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_2 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_2 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( $cont_1_is_active && $cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_2 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_2 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
		    }
		    // 1 active: 3 cases
		    if ( $cont_1_is_active && !$cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_1 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
		    }
		    if ( !$cont_1_is_active && !$cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_1 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( !$cont_1_is_active && $cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_1 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
		    }
		} else { // The "Home Page Column 1" Widget Area width can dynamically resize
		    // 3 active: 1 case
		    if ( $cont_1_is_active && $cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_3 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_3 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_3 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    // 2 active: 3 cases
		    if ( !$cont_1_is_active && $cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_2 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_2 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( $cont_1_is_active && !$cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_3 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-3', 'column_2_of_3 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( $cont_1_is_active && $cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_3 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
			eval( '?>' . get_column( 'cont-box-2', 'column_2_of_3 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
		    }
		    // 1 active: 3 cases
		    if ( $cont_1_is_active && !$cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-1', 'column_1_of_1 home-cont-box', 'Home Page Column 1' ) . '<?php ' );
		    }
		    if ( !$cont_1_is_active && !$cont_2_is_active && $cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-3', 'column_1_of_1 home-cont-box', 'Home Page Column 3' ) . '<?php ' );
		    }
		    if ( !$cont_1_is_active && $cont_2_is_active && !$cont_3_is_active ) {
			eval( '?>' . get_column( 'cont-box-2', 'column_1_of_1 home-cont-box', 'Home Page Column 2' ) . '<?php ' );
		    }
		}
?>
	    </div>
	    <!-- end content-container -->

	    <div class="clear"></div>

<?php	endif; ?>


<?php	get_footer();






