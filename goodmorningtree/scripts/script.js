

// Adds a class 'js_on' to the <html> tag if JavaScript is enabled,
// also helps remove flickering...
document.documentElement.className += 'js_on';

// Scroll to Top script
jQuery(document).ready(function($){
    $('a[href=#top]').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
});

// initialise Superfish Menu
jQuery(document).ready(function($){
    $("ul.sf-menu").supersubs({
	minWidth:    12,   // minimum width of sub-menus in em units
	maxWidth:    32,   // maximum width of sub-menus in em units
	extraWidth:  1     // extra width can ensure lines don't sometimes turn over
			   // due to slight rounding differences and font-family
    }).superfish({	   // call supersubs first, then superfish, so that subs are not display:none when measuring. Call before initialising containing tabs for same reason.
	delay:       500,  // the delay in milliseconds that the mouse can remain outside a submenu without it closing
	autoArrows:  false,
	dropShadows: false
    });
});

// ThumbCaption script
jQuery(document).ready(function($){
    $(".portfolioImgThumb").hover(function(){
	    var info=$(this).find(".hover-opacity");
	    info.stop().animate({opacity:0.4},400);
    },
    function(){
	    var info=$(this).find(".hover-opacity");
	    info.stop().animate({opacity:1},400);
    });

    $(".postImage").hover(function(){
	    var info=$(this).find(".hover-opacity");
	    info.stop().animate({opacity:0.6},400);
    },
    function(){
	    var info=$(this).find(".hover-opacity");
	    info.stop().animate({opacity:1},400);
    });
});



// jQuery Validate
jQuery(document).ready(function($){

    $("#contactForm").validate({
	rules: {
		contact_name: {
			required: true,
			minlength: 2
		},
		contact_email: {
			required: true,
			email: true
		},
		contact_message: "required"
	},
	messages: {
		contact_name: {
			required: "Please enter a name",
			minlength: "Your name must consist of at least 2 characters"
		},
		contact_email: "Please enter a valid email address",
		contact_message: "<br />Please enter your message"
	}
    });
});

jQuery(function($){
   $("#contact_phone_NA_format").mask("(999) 999-9999");
   $("#contact_ext_NA_format").mask("? 99999");
});


