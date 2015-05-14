<?php
    /*
    @package WordPress
    @subpackage cloud_clarity
    */

    global $cloud_clarity_options, $style, $current_slider;

    // get the current color scheme subdirectory
    $style = ( $cloud_clarity_options['color_scheme'] ) ? "style{$cloud_clarity_options['color_scheme']}": "style1";



    $logo_img_url = ( $cloud_clarity_options['custom_logo_img'] ) ? $cloud_clarity_options['custom_logo_img'] : get_bloginfo('template_url').'/styles/'.$style.'/images/logo.png';

    $logo_width = $cloud_clarity_options['logo_width'];

    $logo_height = $cloud_clarity_options['logo_height'];

    $current_slider = $cloud_clarity_options['current_slider'];
?>

<!DOCTYPE html >

<html <?php language_attributes(); ?>>

<head>
    <meta name="google-site-verification" content="zYqUQWQaybdEFzFTZC798ey6M6BfFsbCV2mbjdNRai4" />
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="geo.region" content="US- TX" />
    <meta name="geo.placename" content="Austin, Texas" />
    <meta name="geo.position" content="30.306516 ,-97.744076" />
    <meta name="ICBM" content="30.306516 ,-97.744076" />
    <meta name="copyright" content="Sid Mourning Tree Services 2015" />

    <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>

    <style>
        #services{}
        tr #services2{margin-bottom:2px;background:#000;}
        #services2 tr:hover {margin-bottom:2px;background:#fff;}
    </style>

    <!--[if IE 6]>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/common-css/ie6.css" media="screen" type="text/css" />

        <style type="text/css">
            body{ behavior: url("<?php bloginfo('template_directory'); ?>/scripts/csshover3.htc"); }
        </style>

        <script  type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/DD_belatedPNG_0.0.8a-min.js"></script>

        <script  type="text/javascript">
            // <![CDATA[
                DD_belatedPNG.fix('.pngfix, img, #home-page-content li, #page-content li, #bottom li, #footer li, #recentcomments li span');
            // ]]>
        </script>
    <![endif]-->

    <!--[if lte IE 7]>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/common-css/ie6-7.css" media="screen" type="text/css" />
    <![endif]-->

    <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/common-css/ie-all.css" media="screen" type="text/css" />
    <![endif]-->
</head>

<body <?php body_class(); ?>>
    <div id="wrapper-1" class="pngfix">
        <div id="top-container" class="container_24">
            <div class="clear"></div>
            <div id="top" class="grid_24">
            <div id="logo" class="grid_14">
                <h1>
                    <a class="pngfix" style="background: transparent url( <?php echo esc_url($logo_img_url); ?> ) no-repeat 0 100%; width:<?php echo $logo_width; ?>px; height:<?php echo $logo_height; ?>px;" href="<?php echo get_bloginfo('wpurl'); ?>" title="Sid Mourning Tree Services" alt="Sid Mourning Tree Services">
                        <?php bloginfo('name'); ?>
                    </a>

                </h1>
            </div>
            <div id="contact_us">
            	<h3>Call Today</h3>
            	<h4>512-420-0733</h4>
            	<h5>To Schedule Free Estimate</h5>
            </div>

            <div id="slogan" class="grid_17" style="top:<?php echo $cloud_clarity_options['slogan_distance_from_the_top']; ?>px; left:<?php echo $cloud_clarity_options['slogan_distance_from_the_left']; ?>px;"><?php bloginfo('description'); ?>
            </div>
            <!-- end logo slogan -->

            <div id="search" class="grid_7 prefix_17"></div>
            <!-- end search -->
            <!-- end top-icons -->

        </div>
        <!-- end top -->

        <div class="clear"></div>

        <div id="dropdown-holder" class="grid_24">
            <div id="menu" >
                <a id="btn_1" class="page_item " href="<?php bloginfo('wpurl'); ?>" class="lines3" title="Good Morning Tree ">
                    HOME
                </a>
                <a id="btn_2" href="<?php bloginfo('wpurl'); ?>/tree-service-austin-tx" title="Our Tree Services">
                    SERVICES
                </a>
                <a id="btn_3" href="<?php bloginfo('wpurl'); ?>/about-us" title="About Us">
                    ABOUT US
                </a>
                <a id="btn_4" href="<?php bloginfo('wpurl'); ?>/our-work-gallery" class="lines2" title="Reference Gallery">
                    REFERENCE GALLERY
                </a>
                <a id="btn_5" href="<?php bloginfo('wpurl'); ?>/job-estimate" title="Estimates">
                    ESTIMATES
                </a>
                <a id="btn_6" href="<?php bloginfo('wpurl'); ?>/resources" title="Resources">
                    RESOURCES
                </a>
                <a id="btn_7" href="<?php bloginfo('wpurl'); ?>/faq" title="FAQ">
                    FAQ
                </a>
                <a id="btn_8" href="<?php bloginfo('wpurl'); ?>/contact-us" title="Contact Us">
                    CONTACT US
                </a>
            </div>

            <div class="nav-extra">
                <?php	if( $cloud_clarity_options['show_login_link_in_menu'] ) : ?>
                    <div class="nav-login"><?php wp_loginout(); ?></div>
                <?php	endif; ?>

                <?php	if( $cloud_clarity_options['show_rss_link_in_menu'] ) : ?>
                    <div class="nav-rss">
                        <a href="<?php bloginfo('rss2_url'); ?>" title="<?php esc_attr_e('Entries (RSS)', 'cloud_clarity'); ?>">
                            <img src="<?php bloginfo('template_url'); ?>/styles/common-images/rss_16.png" alt="RSS" border="0" width="16" height="16" />
                        </a>
                    </div>
                <?php	endif; ?>
            </div>
        </div>
        <!-- end dropdown-holder -->
    </div>
    <!-- end top-container -->

    <div class="clear"></div>

    <?php if(is_front_page()) : ?><?php
        if( $current_slider == '0' ) :
            include( 'sliders/piecemaker/piecemaker_display.php' );
        elseif ( $current_slider == '2' ) :
            include( 'sliders/cycle/cycle1/cycle1_display.php' );
        elseif ( $current_slider == '3' ) :
            include( 'sliders/cycle/cycle2/cycle2_display.php' );
        elseif ( $current_slider == '4' ) : // no slider ?>
            <div id="page-content">
    <?php	    endif; ?>

    <div class="clear"></div>

    <?php if( $current_slider != '4' ) // no slider
        echo '<div id="home-page-content">' ?>
    <?php else : ?>
        <div id="page-content">
            <div id="page-content-header" class="container_24">
                <div id="page-title">
                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works.
                    if (is_page()) : ?>
                <?php elseif ( is_single() ) : ?>
                    <h2><?php the_category(', '); ?></h2>
                <?php elseif (is_category()) : /* If this is a category archive */ ?>
                    <h2 class="pagetitle"><?php printf( __('Archive for the &#8216;%s&#8217; Category', 'cloud_clarity' ), single_cat_title("", false) ); ?></h2>
                <?php elseif (is_search()) : /* If this is a search results page */ ?>
                    <h2 class="pagetitle"><?php printf( __('Search Results for &#8216;<em>%s</em>&#8216;', 'cloud_clarity' ), get_search_query() ); ?></h2>
                <?php elseif (is_404()) : /* If this is a search results page */ ?>
                    <h2 class="pagetitle"><?php esc_html_e('Page Not Found (Error 404)', 'cloud_clarity'); ?></h2>
                <?php elseif( is_tag() ) : /* If this is a tag archive */ ?>
                    <h2 class="pagetitle"><?php printf( __('Posts Tagged &#8216;%s&#8217;', 'cloud_clarity' ), single_tag_title("", false) ); ?></h2>
                <?php elseif (is_day()) : /* If this is a daily archive */ ?>
                    <h2 class="pagetitle"><?php printf( __('Archive for %s', 'cloud_clarity' ), get_the_time('F jS, Y') ); ?></h2>
                <?php elseif (is_month()) : /* If this is a monthly archive */ ?>
                    <h2 class="pagetitle"><?php printf( __('Archive for %s', 'cloud_clarity' ), get_the_time('F, Y') ); ?></h2>
                <?php elseif (is_year()) : /* If this is a yearly archive */ ?>
                    <h2 class="pagetitle"><?php printf( __('Archive for %s', 'cloud_clarity' ), get_the_time('Y') ); ?></h2>
                <?php elseif (is_author()) : /* If this is an author archive */ ?>
                    <h2 class="pagetitle"><?php esc_html_e('Author Archive', 'cloud_clarity'); ?></h2>
                <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : /* If this is a paged archive */ ?>
                    <h2 class="pagetitle"><?php esc_html_e('Blog Archives', 'cloud_clarity'); ?></h2>
                <?php endif; ?>

	   </div>
            </div>
    <?php	endif; ?>


