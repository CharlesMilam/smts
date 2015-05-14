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

