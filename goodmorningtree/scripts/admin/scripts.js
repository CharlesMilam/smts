
jQuery.noConflict();

// fixes the firefox radio button bug on refresh (http://www.ryancramer.com/journal/entries/radio_buttons_firefox/)
jQuery(document).ready(function($) {
    if($.browser.mozilla)
         $("#qualifire-metaboxes-general form").attr("autocomplete", "off");
});

jQuery(document).ready(function($) {
	$('#upload_logo_button').click(function() {
	    formfield = jQuery('#custom_logo_img').attr('name');
	    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	    return false;
	});
	window.send_to_editor = function(html) {
	    imgurl = jQuery('img',html).attr('src');
	    $('#custom_logo_img').val(imgurl);
	    tb_remove();
	}
});

// color picker script
jQuery(document).ready(function($) {
    addUploader('#pm_text_background', '#colorSelector1', 'B7B7B7');
    addUploader('#pm_inner_color', '#colorSelector2', '111111');
    addUploader('#c2_text_color', '#c2-colorSelector1', 'FFFFFF');
    function addUploader(inputField, colorSelector, defaultColor) {
	$(colorSelector).ColorPicker({
		color: '#'+defaultColor,
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$(colorSelector+' div').css('backgroundColor', '#' + hex);
			$('input'+inputField).attr("value", hex);
		},
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		}
	});
    }
});




// Piecemaker Slider jQuery functionality to drag-n-drop, delete and upload images
jQuery(document).ready(function($) {
	// Initialise the table
	$('#pm-table-slides').tableDnD({
		onDragClass: "myDragClass",
		onDrop: function(table, row) {
		    var rows = table.tBodies[0].rows;
		    var slidesOrder = rows[0].id;
		    for (var i=1; i<rows.length; i++) {
			slidesOrder += ","+rows[i].id;
		    }
		    $('input#pm_slides_order_str').val(slidesOrder);
		},
		dragHandle: "dragHandle"
	});

	// Attach the file uploader module to each row
	$('#pm-table-slides tr').each(function() {
	    var curID = parseInt($(this).attr('id'));
	    addUploader('#pm-table-slides', curID)
	});

	// Delete a slide
	$('#pm-table-slides tr td.deleteSlide').bind("mousedown", ( deleteSlide ));

	// Add a new slide
	$('.add-row').bind("mousedown", (function(event){
		// find current highest tr id
		var highestID = 0;
		$('#pm-table-slides tr').each(function() {
		    var curID = parseInt($(this).attr('id'));
		    if (highestID < curID){
			highestID = curID;
		    }
		});
		// Clone table row
		$('#pm-clone-table tr').clone().appendTo($('#pm-table-slides'));
		$('#pm-table-slides tr:last').attr("id",++highestID);
		$('#pm-table-slides tr:last td input').attr("value","").attr("id","pm_slide_img_url_"+highestID).attr("name","qualifire_options[pm_slide_img_url_"+highestID+"]");
		// Update slide's info text
		$('#pm-table-slides tr:last td.slide-info-text textarea').attr("name",'qualifire_options[pm_slider_default_info_txt_'+highestID+']').attr("id",'pm_slider_default_info_txt_'+highestID);
		// Update Uplodify ID's
		$('#pm-table-slides tr:last td div.uploadify input').attr("id",'uploadify-'+highestID).attr("name",'uploadify-'+highestID);
		$('#pm-table-slides tr:last td .file-uploaded').attr("id",'file-uploaded-'+highestID);
		$('#pm-table-slides tr:last td div.uploadify object').attr("id",'uploadify-'+highestID+'Uploader');
		$('#pm-table-slides tr:last td div.uploadify div').attr("id",'uploadify-'+highestID+'Queue');
		// Add the image upload module to the newly added row
		addUploader('#pm-table-slides tr:last', highestID)

		// sort displayed row numbers
		$('#pm-table-slides tr').each(function(index) {
		    $("#pm-table-slides tr td.position").eq(index).html(index+1);
		});


		// Add click event to the remove button on the newly added row
		$('#pm-table-slides tr:last td.deleteSlide').bind("mousedown", ( deleteSlide ));

		// update the slides' list
		var slidesOrder = '';
		$('#pm-table-slides tr').each(function(index) {
		    if (index == 0){
			slidesOrder += $(this).attr('id');
		    } else {
			slidesOrder += ","+$(this).attr('id');
		    }
		});
		// update the input#pm_slides_order_str
		$('input#pm_slides_order_str').val(slidesOrder);
		$("#pm-table-slides").tableDnDUpdate();

		event.stopPropagation;
		return false;
	}));

	function deleteSlide() {
		// remove delete slide button if only one slide is left
		if ($('#pm-table-slides tr').size() == 1) {
		    alert("Deletion is not allowed! At least one slide must be present.");
		    return false;
		} else {
		    if (confirm("Delete this Slide?")) {
			$(this).parent().remove();
		    }
		    // sort displayed row numbers
		    $('#pm-table-slides tr').each(function(index) {
			$("#pm-table-slides tr td.position").eq(index).html(index+1);
		    });

		    // update the slides order
		    var slidesOrder = '';
		    $('#pm-table-slides tr').each(function(index) {
			if (index == 0){
			    slidesOrder += $(this).attr('id');
			}else {
			    slidesOrder += ","+$(this).attr('id');
			}
		    });
		    // update the input#pm_slides_order_str
		    $('input#pm_slides_order_str').val(slidesOrder);
		    $("#pm-table-slides").tableDnDUpdate();

		    event.stopPropagation;
		    return false;
		}
	}
	function addUploader(tableOrRow, rowID) {
	    $(tableOrRow+' #uploadify-'+rowID).uploadify({
		'uploader': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.swf',
		'script': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.php',
		'folder': '../wp-content/themes/qualifire/sliders/piecemaker/images',
		'cancelImg': '../wp-content/themes/qualifire/scripts/admin/uploadify/cancel.png',
		'fileDesc': 'Only images with extensions: *.jpg, *.jpeg, *.png, *.gif are allowed',
		'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
		'sizeLimit': 2097152, // 2 MB file size limit
		'auto': true,
		'multi': false,
		onComplete: function(event, queueID, fileObj, reposnse, data) {
		     $('#pm-table-slides #file-uploaded-'+rowID).empty().append('The image <strong>'+fileObj.name+'</strong> was uploaded successfully!');
		     $('#pm-table-slides input#pm_slide_img_url_'+rowID).attr("value", fileObj.name);
		}
	    });
	}

});



// Cycle 1 Slider jQuery functionality to drag-n-drop, delete and upload images
jQuery(document).ready(function($) {

	// Initialise the table
	$('#c1-table-slides').tableDnD({
		onDragClass: "myDragClass",
		onDrop: function(table, row) {
		    var rows = table.tBodies[0].rows;
		    var slidesOrder = rows[0].id;
		    for (var i=1; i<rows.length; i++) {
			slidesOrder += ","+rows[i].id;
		    }
		    $('input#c1_slides_order_str').val(slidesOrder);
		},
		dragHandle: "dragHandle"
	});

	// Attach the file uploader module to each row
	$('#c1-table-slides tr').each(function() {
	    var curID = parseInt($(this).attr('id'));
	    addUploader('#c1-table-slides', curID)
	});

	// Delete a slide
	$('#c1-table-slides tr td.deleteSlide').bind("mousedown", ( deleteSlide ));

	// Add a new slide
	$('.add-row').bind("mousedown", (function(event){
		// find current highest tr id
		var highestID = 0;
		$('#c1-table-slides tr').each(function() {
		    var curID = parseInt($(this).attr('id'));
		    if (highestID < curID){
			highestID = curID;
		    }
		});
		// Clone table row
		$('#c1-clone-table tr').clone().appendTo($('#c1-table-slides'));
		$('#c1-table-slides tr:last').attr("id",++highestID);
		// Update Uplodify ID's
		$('#c1-table-slides tr:last td textarea').attr("value","").attr("id","c1_slide_img_url_"+highestID).attr("name","qualifire_options[c1_slide_img_url_"+highestID+"]");
		$('#c1-table-slides tr:last td div.uploadify input').attr("id",'uploadify-'+highestID).attr("name",'uploadify-'+highestID);
		$('#c1-table-slides tr:last td .file-uploaded').attr("id",'file-uploaded-'+highestID);
		$('#c1-table-slides tr:last td div.uploadify object').attr("id",'uploadify-'+highestID+'Uploader');
		$('#c1-table-slides tr:last td div.uploadify div').attr("id",'uploadify-'+highestID+'Queue');
		// Update Transition Type
		$('#c1-table-slides tr:last td div.transition-type select').attr("value","").attr("id","c1_transition_type_"+highestID).attr("name","qualifire_options[c1_transition_type_"+highestID+"]");
		// Update Slide Link ID's
		$('#c1-table-slides tr:last td div.slide-link').attr("id",'c1_slide_link_url_'+highestID);
		$('#c1-table-slides tr:last td div.slide-link label.link-url').attr("for",'c1_slide_link_url_'+highestID);
		$('#c1-table-slides tr:last td div.slide-link input').attr("name",'qualifire_options[c1_slide_link_url_'+highestID+']').attr("id",'c1_slide_link_url_'+highestID);
		$('#c1-table-slides tr:last td div.slide-link label.link-target').attr("for",'c1_slide_link_target_'+highestID);
		$('#c1-table-slides tr:last td div.slide-link label.link-target select').attr("name",'qualifire_options[c1_slide_link_target_'+highestID+']').attr("id",'c1_slide_link_target_'+highestID);
		// Add the image upload module to the newly added row
		addUploader('#c1-table-slides tr:last', highestID)

		// sort displayed row numbers
		$('#c1-table-slides tr').each(function(index) {
		    $("#c1-table-slides tr td.position").eq(index).html(index+1);
		});

		// Add click event to the remove button on the newly added row
		$('#c1-table-slides tr:last td.deleteSlide').bind("mousedown", ( deleteSlide ));

		// update the slides' list
		var slidesOrder = '';
		$('#c1-table-slides tr').each(function(index) {
		    if (index == 0){
			slidesOrder += $(this).attr('id');
		    } else {
			slidesOrder += ","+$(this).attr('id');
		    }
		});
		// update the input#c1_slides_order_str
		$('input#c1_slides_order_str').val(slidesOrder);
		$("#c1-table-slides").tableDnDUpdate();

		event.stopPropagation;
		return false;
	}));

	function deleteSlide() {
		// remove delete slide button if only one slide is left
		if ($('#c1-table-slides tr').size() == 1) {
		    alert("Deletion is not allowed! At least one slide must be present.");
		    return false;
		} else {
		    if (confirm("Delete this Slide?")) {
			$(this).parent().remove();
		    }
		    // sort displayed row numbers
		    $('#c1-table-slides tr').each(function(index) {
			$("#c1-table-slides tr td.position").eq(index).html(index+1);
		    });

		    // update the slides order
		    var slidesOrder = '';
		    $('#c1-table-slides tr').each(function(index) {
			if (index == 0){
			    slidesOrder += $(this).attr('id');
			}else {
			    slidesOrder += ","+$(this).attr('id');
			}
		    });
		    // update the input#c1_slides_order_str
		    $('input#c1_slides_order_str').val(slidesOrder);
		    $("#c1-table-slides").tableDnDUpdate();

		    event.stopPropagation;
		    return false;
		}
	}
	function addUploader(tableOrRow, rowID) {
	    $(tableOrRow+' #uploadify-'+rowID).uploadify({
		'uploader': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.swf',
		'script': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.php',
		'folder': '../wp-content/themes/qualifire/sliders/cycle/cycle1/images',
		'cancelImg': '../wp-content/themes/qualifire/scripts/admin/uploadify/cancel.png',
		'fileDesc': 'Only images with extensions: *.jpg, *.jpeg, *.png, *.gif are allowed',
		'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
		'sizeLimit': 2097152, // 2 MB file size limit
		'auto': true,
		'multi': false,
		onComplete: function(event, queueID, fileObj, reposnse, data) {
		     $('#c1-table-slides #file-uploaded-'+rowID).empty().append('The image <strong>'+fileObj.name+'</strong> was uploaded successfully!');
		     $('#c1-table-slides textarea#c1_slide_img_url_'+rowID).attr("value", fileObj.filePath);

		}
	    });
	}

});



// Cycle 2 Slider jQuery functionality to drag-n-drop, delete and upload images
jQuery(document).ready(function($) {

	// Initialise the table
	$('#c2-table-slides').tableDnD({
		onDragClass: "myDragClass",
		onDrop: function(table, row) {
		    var rows = table.tBodies[0].rows;
		    var slidesOrder = rows[0].id;
		    for (var i=1; i<rows.length; i++) {
			slidesOrder += ","+rows[i].id;
		    }
		    $('input#c2_slides_order_str').val(slidesOrder);
		},
		dragHandle: "dragHandle"
	});

	// Attach the file uploader module to each row
	$('#c2-table-slides tr').each(function() {
	    var curID = parseInt($(this).attr('id'));
	    addUploader('#c2-table-slides', curID)
	});

	// Delete a slide
	$('#c2-table-slides tr td.deleteSlide').bind("mousedown", ( deleteSlide ));

	// Add a new slide
	$('.add-row').bind("mousedown", (function(event){
		// find current highest tr id
		var highestID = 0;
		$('#c2-table-slides tr').each(function() {
		    var curID = parseInt($(this).attr('id'));
		    if (highestID < curID){
			highestID = curID;
		    }
		});
		// Clone table row
		$('#c2-clone-table tr').clone().appendTo($('#c2-table-slides'));
		$('#c2-table-slides tr:last').attr("id",++highestID);
		// Update Uplodify ID's
		$('#c2-table-slides tr:last td div.c2_slide_img_url label').attr("for",'c2_slide_img_url_'+highestID);
		$('#c2-table-slides tr:last td div.c2_slide_img_url input').attr("value","").attr("id","c2_slide_img_url_"+highestID).attr("name","qualifire_options[c2_slide_img_url_"+highestID+"]");
		$('#c2-table-slides tr:last td div.uploadify input').attr("id",'uploadify-'+highestID).attr("name",'uploadify-'+highestID);
		$('#c2-table-slides tr:last td .file-uploaded').attr("id",'file-uploaded-'+highestID);
		$('#c2-table-slides tr:last td div.uploadify object').attr("id",'uploadify-'+highestID+'Uploader');
		$('#c2-table-slides tr:last td div.uploadify div').attr("id",'uploadify-'+highestID+'Queue');
		// Update Transition Type
		$('#c2-table-slides tr:last td div.transition-type select').attr("value","").attr("id","c2_transition_type_"+highestID).attr("name","qualifire_options[c2_transition_type_"+highestID+"]");
		// Update Slide Link
		$('#c2-table-slides tr:last td div.slide-link').attr("id",'c2_slide_link_url_'+highestID);
		$('#c2-table-slides tr:last td div.slide-link label.link-url').attr("for",'c2_slide_link_url_'+highestID);
		$('#c2-table-slides tr:last td div.slide-link input').attr("name",'qualifire_options[c2_slide_link_url_'+highestID+']').attr("id",'c2_slide_link_url_'+highestID);
		$('#c2-table-slides tr:last td div.slide-link label.link-target').attr("for",'c2_slide_link_target_'+highestID);
		$('#c2-table-slides tr:last td div.slide-link label.link-target select').attr("name",'qualifire_options[c2_slide_link_target_'+highestID+']').attr("id",'c2_slide_link_target_'+highestID);
		// Update slide's info text
		$('#c2-table-slides tr:last td div.slide-info-text textarea').attr("name",'qualifire_options[c2_slide_default_info_txt_'+highestID+']').attr("id",'c2_slide_default_info_txt_'+highestID);
		// Update Slide Button Text
		$('#c2-table-slides tr:last td div.slide-button label').attr("for",'c2_slide_button_txt_'+highestID);
		$('#c2-table-slides tr:last td div.slide-button input').attr("name",'qualifire_options[c2_slide_button_txt_'+highestID+']').attr("id",'c2_slide_button_txt_'+highestID);

		// Add the image upload module to the newly added row
		addUploader('#c2-table-slides tr:last', highestID)

		// sort displayed row numbers
		$('#c2-table-slides tr').each(function(index) {
		    $("#c2-table-slides tr td.position").eq(index).html(index+1);
		});

		// Add click event to the remove button on the newly added row
		$('#c2-table-slides tr:last td.deleteSlide').bind("mousedown", ( deleteSlide ));

		// update the slides' list
		var slidesOrder = '';
		$('#c2-table-slides tr').each(function(index) {
		    if (index == 0){
			slidesOrder += $(this).attr('id');
		    } else {
			slidesOrder += ","+$(this).attr('id');
		    }
		});
		// update the input#c2_slides_order_str
		$('input#c2_slides_order_str').val(slidesOrder);
		$("#c2-table-slides").tableDnDUpdate();

		event.stopPropagation;
		return false;
	}));

	function deleteSlide() {
		// remove delete slide button if only one slide is left
		if ($('#c2-table-slides tr').size() == 1) {
		    alert("Deletion is not allowed! At least one slide must be present.");
		    return false;
		} else {
		    if (confirm("Delete this Slide?")) {
			$(this).parent().remove();
		    }
		    // sort displayed row numbers
		    $('#c2-table-slides tr').each(function(index) {
			$("#c2-table-slides tr td.position").eq(index).html(index+1);
		    });

		    // update the slides order
		    var slidesOrder = '';
		    $('#c2-table-slides tr').each(function(index) {
			if (index == 0){
			    slidesOrder += $(this).attr('id');
			}else {
			    slidesOrder += ","+$(this).attr('id');
			}
		    });
		    // update the input#c2_slides_order_str
		    $('input#c2_slides_order_str').val(slidesOrder);
		    $("#c2-table-slides").tableDnDUpdate();

		    event.stopPropagation;
		    return false;
		}
	}
	function addUploader(tableOrRow, rowID) {
	    $(tableOrRow+' #uploadify-'+rowID).uploadify({
		'uploader': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.swf',
		'script': '../wp-content/themes/qualifire/scripts/admin/uploadify/uploadify.php',
		'folder': '../wp-content/themes/qualifire/sliders/cycle/cycle2/images',
		'cancelImg': '../wp-content/themes/qualifire/scripts/admin/uploadify/cancel.png',
		'fileDesc': 'Only images with extensions: *.jpg, *.jpeg, *.png, *.gif are allowed',
		'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
		'sizeLimit': 2097152, // 2 MB file size limit
		'auto': true,
		'multi': false,
		onComplete: function(event, queueID, fileObj, reposnse, data) {
		     $('#c2-table-slides #file-uploaded-'+rowID).empty().append('The image <strong>'+fileObj.name+'</strong> was uploaded successfully!');
		     $('#c2-table-slides div.c2_slide_img_url input#c2_slide_img_url_'+rowID).attr("value", fileObj.filePath);

		}
	    });
	}

});






