<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
?>
<?php	global $cloud_clarity_options, $style; ?>
</div><!-- end page-content -->
<div class="clear"></div>
<?php
 $bottom_1_is_active = sidebar_exist_and_active('Bottom 1');
 $bottom_2_is_active = sidebar_exist_and_active('Bottom 2');
 $bottom_3_is_active = sidebar_exist_and_active('Bottom 3');
 $bottom_4_is_active = sidebar_exist_and_active('Bottom 4');
	if ( $bottom_1_is_active || $bottom_2_is_active || $bottom_3_is_active || $bottom_4_is_active ) : // hide this area if no widgets are active...
 ?>
	    <div id="bottom-bg">
		<div id="bottom" class="container_24">
 <?php
 // all 4 active: 1 case
 if ( $bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {
 			eval( '?>' . get_column( 'bottom_1', 'column_1_of_4', 'Bottom 1' ) . '<?php ' );
			eval( '?>' . get_column( 'bottom_2', 'column_1_of_4', 'Bottom 2' ) . '<?php ' );
			eval( '?>' . get_column( 'bottom_3', 'column_1_of_4', 'Bottom 3' ) . '<?php ' );
			eval( '?>' . get_column( 'bottom_4', 'column_1_of_4', 'Bottom 4' ) . '<?php ' );
		    }
		    // 3 active: 4 cases
		    if ( $bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {
			eval( '?>' . get_column( 'bottom_1', 'column_1_of_3', 'Bottom 1' ) . '<?php ' );
			eval( '?>' . get_column( 'bottom_2', 'column_1_of_3', 'Bottom 2' ) . '<?php ' );
			eval( '?>' . get_column( 'bottom_3', 'column_1_of_3', 'Bottom 3' ) . '<?php ' );
		    }



		    if ( $bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_3', 'Bottom 1' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_3', 'Bottom 2' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_3', 'Bottom 4' ) . '<?php ' );



		    }



		    if ( $bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_3', 'Bottom 1' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_3', 'Bottom 3' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_3', 'Bottom 4' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_3', 'Bottom 2' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_3', 'Bottom 3' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_3', 'Bottom 4' ) . '<?php ' );



		    }



		    // 2 active: 6 cases



		    if ( $bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_2', 'Bottom 1' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_2', 'Bottom 2' ) . '<?php ' );



		    }



		    if ( $bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_2', 'Bottom 1' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_2', 'Bottom 3' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && $bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_2', 'Bottom 2' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_2', 'Bottom 3' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_2', 'Bottom 2' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_2', 'Bottom 4' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_2', 'Bottom 3' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_2', 'Bottom 4' ) . '<?php ' );



		    }



		    if ( $bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_2', 'Bottom 1' ) . '<?php ' );



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_2', 'Bottom 4' ) . '<?php ' );



		    }



		    // 1 active: 4 cases



		    if ( $bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_1', 'column_1_of_1', 'Bottom 1' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && $bottom_2_is_active && !$bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_2', 'column_1_of_1', 'Bottom 2' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && !$bottom_2_is_active && $bottom_3_is_active && !$bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_3', 'column_1_of_1', 'Bottom 3' ) . '<?php ' );



		    }



		    if ( !$bottom_1_is_active && !$bottom_2_is_active && !$bottom_3_is_active && $bottom_4_is_active ) {



			eval( '?>' . get_column( 'bottom_4', 'column_1_of_1', 'Bottom 4' ) . '<?php ' );



		    }



?>



		</div>



		<!-- end bottom -->



	    </div>



	    <!-- end bottom-bg -->







	    <div class="clear"></div>











<?php	endif; ?>

<!-- Footer text -->
<div id="footer-bg">
	<div id="footer" class="container_24 footer-top">
		<div id="contact_footer">
			<p>Call<span>512-420-0733</span> to schedule a free estimate.</p>
		</div>
		
		<div id="footer_text" class="grid_23">
			&copy; 2015 Sid Mourning Tree Service &bull; All Rights Reserved<br>
			<!-- Business info suitable for SEO -->
			<div itemscope itemtype="http://schema.org/LocalBusiness"> 
				<span itemprop="name">Sid Mourning Tree Service</span> - 
				<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"> 
				<span itemprop="streetAddress">3810 Medical Parkway</span>, 
				<span itemprop="addressLocality">Austin</span>, 
				<span itemprop="addressRegion">TX</span> 
				<span itemprop="postalCode">78756</span> 
				Phone: <span itemprop="telephone">(512) 420-0733</span></span>
			</div>
			<a href="http://www.sidmourningtreeservice.com/privacy-policy/">Our Privacy Policy</a> 
		</div>
	</div>
</div>

<div class="clear"></div>

<?php wp_footer(); ?>

<!-- GeoCoordinates and Google+ link -->
<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
	<meta itemprop="latitude" content="30.306516" />
	<meta itemprop="longitude" content="-97.744076" /> </div>
	
</div><!-- end wrapper-1 -->




<!-- Google Code for Remarketing Tag (original) -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 975192608;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/975192608/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>




<!-- Google Code for Remarketing Tag (Katie 2.0) -->
 <script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 968562111;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/968562111/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<!-- Google Analytics -->
  <script type="text/javascript"> Cufon.now(); </script>
  <?php echo $cloud_clarity_options['google_analaytics']; ?>
  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38466541-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<!-- start number replacer -->
<script type="text/javascript"><!--vs_account_id  = "CtjSZlOI3EMbSQDY";//--></script>
<script type="text/javascript" src="http://adtrack.voicestar.com/euinc/number-changer.js">
</script>
<!-- end ad widget -->
</body>
</html>