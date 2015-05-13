<?php

$secial_break_char = mb_convert_encoding('&#1217;', 'UTF-8', 'HTML-ENTITIES');

$piecemakerXML = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>
    <Settings>
	<imageWidth>{$pm_image_width}</imageWidth>
	<imageHeight>{$pm_image_height}</imageHeight>
	<segments>{$pm_segments}</segments>
	<tweenTime>{$pm_tween_time}</tweenTime>
	<tweenDelay>{$pm_tween_delay}</tweenDelay>
	<tweenType>{$pm_tween_type}</tweenType>
	<zDistance>{$pm_z_distance}</zDistance>
	<expand>{$pm_expand}</expand>
	<shadowDarkness>{$pm_shadow_darkness}</shadowDarkness>
	<autoplay>{$pm_autoplay}</autoplay>
	<textDistance>{$pm_text_distance}</textDistance>
	<textBackground>0x{$pm_text_background}</textBackground>
	<innerColor>0x{$pm_inner_color}</innerColor>
    </Settings>

XML;

$pm_slides_array = explode( ',', $pm_slides_order_str );
foreach( $pm_slides_array as $slide_row_number ) {
    $slide_img_name = $options['pm_slide_img_url_'.$slide_row_number];
    $pm_slider_default_info_txt = preg_replace( '/special_break/', $secial_break_char, $options['pm_slider_default_info_txt_'.$slide_row_number] );
$piecemakerXML .= <<<XML
    <Image Filename="{$slide_img_name}">
	<Text>
	    {$pm_slider_default_info_txt}
	</Text>
    </Image>

XML;
}

$piecemakerXML .= <<<XML
</Piecemaker>
XML;

$MyFile = "../wp-content/themes/qualifire/sliders/piecemaker/piecemakerXML.xml";
$handling = fopen($MyFile, 'w');
fwrite($handling, $piecemakerXML);

