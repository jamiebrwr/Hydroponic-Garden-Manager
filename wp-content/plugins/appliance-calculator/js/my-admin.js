jQuery(document).ready(function ($) {    
    jQuery('.color-picker').iris();
	
    jQuery(document).click(function (e) {
        if (!jQuery(e.target).is(".color-picker, .iris-picker, .iris-picker-inner")) {
            jQuery('.color-picker').iris('hide');
        }
    });
    jQuery('.color-picker').click(function (event) {
        jQuery('.color-picker').iris('hide');
        jQuery(this).iris('show');
    });
});