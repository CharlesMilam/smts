<?php
/**
 * @package WordPress
 * @subpackage cloud_clarity
 */
/**
 * Template Name: Contact page
 */

if ( $cloud_clarity_options['recaptcha_enabled'] == 'yes' ) {
    if ( !function_exists('_recaptcha_qsencode') ) {
	require_once('scripts/recaptcha/recaptchalib.php');
    }
    $publickey = $cloud_clarity_options['recaptcha_publickey']; // you got this from the signup page
    $privatekey = $cloud_clarity_options['recaptcha_privatekey']; // you got this from the signup page
    $resp = null;
    $error = null;
    if( isset($_POST['submit']) ) {
	$resp = recaptcha_check_answer ($privatekey,
		    $_SERVER["REMOTE_ADDR"],
		    $_POST["recaptcha_challenge_field"],
		    $_POST["recaptcha_response_field"]
		);
	if ( !$resp->is_valid ) {
	    $rCaptcha_error = $resp->error;
	}
    }
}



get_header();

$content_position = ( $cloud_clarity_options['contact_sidebar'] == 'left' ) ? 'grid_16 push_8' : 'grid_16';
$NA_phone_format = $cloud_clarity_options['NA_phone_format'] ? '_NA_format' : '';

//If the form is submitted
if( isset($_POST['submit']) ) {
    // Get form vars
    $contact_name = trim(stripslashes($_POST['contact_name']));
    $contact_email = trim($_POST['contact_email']);
    $contact_phone = trim($_POST["contact_phone{$NA_phone_format}"]);
    $contact_ext = trim($_POST["contact_ext{$NA_phone_format}"]);
    $contact_message = trim(stripslashes($_POST['contact_message']));

    // Error checking if JS is turned off
    if( $contact_name == '' ) { //Check to make sure that the name field is not empty
	$nameError = __('Please enter a name', 'cloud_clarity');
    } else if( strlen($contact_name) < 2 ) {
	$nameError = __('Your name must consist of at least 2 characters', 'cloud_clarity');
    }

    if( $contact_email == '' ) {
	$emailError = __('Please enter a valid email address', 'cloud_clarity');
    } else if( !is_email( $contact_email ) ) {
	$emailError = __('Please enter a valid email address', 'cloud_clarity');
    }

    if( $NA_phone_format ) {
	if( !isPhoneNumberValid( $contact_phone ) || ( $contact_phone == '' && $contact_ext != '' ) ) {
	    $phoneError = __('phone number', 'cloud_clarity');
	}
	if( !eregi("^[0-9]{0,5}$", $contact_ext) ) { // check if the extension consists of 1 to 5 digits, or empty
	    $extError = __('extension', 'cloud_clarity');
	}
    }
    if( isset($phoneError) && isset($extError) ) {
	$phone_extError = sprintf(__('Please enter a valid %1$s and %2$s', 'cloud_clarity'), $phoneError, $extError );
    } else if( isset($phoneError) ) {
	$phone_extError = sprintf(__('Please enter a valid %s', 'cloud_clarity'), $phoneError );
    } else if( isset($extError) ) {
	$phone_extError = sprintf(__('Please enter a valid %s', 'cloud_clarity'), $extError );
    }

    if( $contact_message == '' ) {
	$messageError = __('Please enter your message', 'cloud_clarity');
    }

    if( !isset($nameError) && !isset($emailError) && !isset($messageError) && !isset($rCaptcha_error) ) {
	$ext = ( $contact_ext != '' ) ? ' ext.'.$contact_ext : '';
	$phone = ( $contact_phone != '' ) ? 'Phone: '.$contact_phone.$ext."\r\n" : '';
	// Send email
	$email_address_to = $cloud_clarity_options['email_receipients'];
	$subject = sprintf(__('Contact Form submission from %s', 'cloud_clarity'), get_option('blogname') );
	$message_contents = __("Sender's name: ", 'cloud_clarity') . $contact_name . "\r\n" .
			    __('E-mail: ', 'cloud_clarity') . $contact_email . "\r\n" .
			    __('Phone: ', 'cloud_clarity') . $phone ."\r\n" .
			    __('Message: ', 'cloud_clarity') . $contact_message . " \r\n";

	$header = "From: $contact_name <".$contact_email.">\r\n";
	$header .= "Reply-To: $contact_email\r\n";
	$header .= "Return-Path: $contact_email\r\n";
	$emailSent = ( @wp_mail( $email_address_to, $subject, $message_contents, $header ) ) ? true : false;

	$contact_name_thx = $contact_name;

	// Clear the form
	$contact_name = $contact_email = $contact_phone = $contact_ext = $contact_message = '';
    }
}


//Contact Information Fields from the Admin Options
$contact_field_array = array(
    array(
	'desc' => $cloud_clarity_options['contact_field_name1'],
	'value' => $cloud_clarity_options['contact_field_value1'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name2'],
	'value' => $cloud_clarity_options['contact_field_value2'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name3'],
	'value' => $cloud_clarity_options['contact_field_value3'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name4'],
	'value' => $cloud_clarity_options['contact_field_value4'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name5'],
	'value' => $cloud_clarity_options['contact_field_value5'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name6'],
	'value' => $cloud_clarity_options['contact_field_value6'] ),
    array(
	'desc' => $cloud_clarity_options['contact_field_name7'],
	'value' => $cloud_clarity_options['contact_field_value7']
    )
);


?>

<div id="content-container" class="container_24">
    <div id="main-content" class="<?php echo $content_position; ?>">
	<div class="main-content-padding">
<?php	if (have_posts()) : while (have_posts()) : the_post();
	  if($post->post_content != "") : ?>
	    <div class="post" id="post-<?php the_ID(); ?>">
		<div class="entry">
		    <?php the_content(__('<p class="serif">Read the rest of this page &raquo;</p>', 'cloud_clarity')); ?>
		    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	    </div>
<?php	  endif;
	endwhile; endif; ?>
	<?php edit_post_link(esc_html__('Edit this entry.', 'cloud_clarity'), '<p class="editLink">', '</p>'); ?>
	<br />

	<div class="clear"></div>

<?php	// Contact Fields...
	if ( $cloud_clarity_options['show_contact_fields'] ) : ?>
	    <div id="contactInfo">
<?php		foreach( $contact_field_array as $field_array ) :
		    if( $field_array['value'] != '' ) : ?>
			<div class="grid_4 contactFieldDesc"><?php echo $field_array['desc']; ?></div>
			<div class="grid_11 contactFieldValue"><?php echo $field_array['value']; ?></div>
			<div class="clear"></div>
<?php		    endif;
		endforeach; ?>
	    </div>
	    <div class="clear"></div>
<?php	endif; ?>

	<div id="contact-wrapper">
<?php	    // Message Area.  It shows a message upon successful email submission
	    if( isset( $emailSent ) && $emailSent == true ) : ?>
		<div class="success">
		    <div class="msg-box-icon">
			<strong><?php esc_html_e('Email Successfully Sent!', 'cloud_clarity'); ?></strong><br />
			<?php printf(__('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you shortly.', 'cloud_clarity'), $contact_name_thx) ?>
		    </div>
		</div>
<?php	    elseif ( isset( $emailSent ) && $emailSent == false ) : ?>
		<div class="erroneous">
		    <div class="msg-box-icon">
			<?php esc_html_e('Failed to connect to mailserver!', 'cloud_clarity'); ?>
		    </div>
		</div>
<?php	    endif; ?>

	    <form id="contactForm" class="cmxform" method="post" action="<?php echo the_permalink(); ?>#contact-wrapper">
		<strong><?php esc_html_e('Please use the form below to send us an email:', 'cloud_clarity'); ?></strong>
		<div>
		    <label for="contact_name"><?php esc_html_e('Name', 'cloud_clarity'); ?> </label><em><?php esc_html_e('(required, at least 2 characters)', 'cloud_clarity'); ?></em><br />
		    <input id="contact_name" name="contact_name" size="30" class="required<?php if(isset($nameError)) echo ' error'; ?>" minlength="2" value="<?php echo esc_attr($contact_name); ?>" />
<?php		    if(isset($nameError)) echo '<label class="error" for="contact_name" generated="true">'.$nameError.'</label>'; ?>
		</div>
		<div>
		    <label for="contact_email"><?php esc_html_e('E-Mail', 'cloud_clarity'); ?> </label><em><?php esc_html_e('(required)', 'cloud_clarity'); ?></em><br />
		    <input id="contact_email" name="contact_email" size="30"  class="required email<?php if(isset($emailError)) echo ' error'; ?>" value="<?php echo esc_attr($contact_email); ?>" />
<?php		    if(isset($emailError)) echo '<label class="error" for="contact_email" generated="true">'.$emailError.'</label>'; ?>
		</div>
		<div>
		    <label for="contact_phone"><?php esc_html_e('Phone', 'cloud_clarity'); ?> </label><em><?php esc_html_e('(optional)', 'cloud_clarity'); ?></em><br />
		    <input id="contact_phone<?php echo $NA_phone_format; ?>" name="contact_phone<?php echo $NA_phone_format; ?>" size="14" class="phone<?php if(isset($phoneError)) echo ' error'; ?>" value="<?php echo esc_attr($contact_phone); ?>" maxlength="14" />
		    <label for="contact_ext"><?php esc_html_e('ext.', 'cloud_clarity'); ?> </label>
		    <input id="contact_ext<?php echo $NA_phone_format; ?>" name="contact_ext<?php echo $NA_phone_format; ?>" size="5" class="ext<?php if(isset($extError)) echo ' error'; ?>" value="<?php echo esc_attr($contact_ext); ?>" maxlength="5" />
<?php		    if(isset($phone_extError)) echo '<label class="error" for="contact_phone" generated="true">'.$phone_extError.'</label>'; ?>
		</div>
		<div>
		    <label for="contact_message"><?php esc_html_e('Your comment', 'cloud_clarity'); ?> </label><em><?php esc_html_e('(required)', 'cloud_clarity'); ?></em><br />
		    <textarea id="contact_message" name="contact_message" cols="70" rows="7" class="required<?php if(isset($messageError)) echo ' error'; ?>"><?php echo esc_attr($contact_message); ?></textarea>
<?php		    if(isset($messageError)) echo '<br /><label class="error" for="contact_message" generated="true">'.$messageError.'</label>'; ?>
		</div>

<?php		if ( $cloud_clarity_options['recaptcha_enabled'] == 'yes' ) : ?>
		    <script type="text/javascript">var RecaptchaOptions = {theme : '<?php echo $cloud_clarity_options['recaptcha_theme']; ?>', lang : '<?php echo $cloud_clarity_options['recaptcha_lang']; ?>'};</script>
		    <div>
<?php			echo recaptcha_get_html( $publickey, $rCaptcha_error ); ?>
		    </div>
<?php		endif; ?>

		<div>
		    <input name="submit" class="submit" type="submit" value="<?php esc_attr_e('Submit'); ?>"/>
		</div>
	    </form>

	</div><!-- end contact-wrapper -->
	</div><!-- end main-content-padding -->
    </div><!-- end main-content -->


<?php if( sidebar_exist('ContactSidebar') ) { get_sidebar('ContactSidebar'); } ?>

</div><!-- end content-container -->

<div class="clear"></div>

<?php

get_footer();




