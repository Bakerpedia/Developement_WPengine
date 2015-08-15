/*****************************************
BACKEND SCRIPTS

WIDGET COLORS
ADMIN SETTINGS
CUSTOM META BOXES
COLORPICKER
UPLOAD
ADMIN POP-UP HELP
BACKGROUND IMAGE PICKER
SKIN PICKER
AJAX DELETE SLIDER ITEM
GOOGLE WEBFONTS

*****************************************/



/*****************************************
WIDGET COLORS
*****************************************/

jQuery(document).ready(function($) {

	$('#main_widget_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#fab764');
	$('#sidebar_widget_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#aed689');
	$('#footer_1_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#aed689');
	$('#footer_2_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#aed689');
	$('#footer_3_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#aed689');
	$('#footer_4_area').closest('.widgets-holder-wrap').children('.sidebar-name').children('h3').css('backgroundColor','#aed689');

	$('.widget').each(function(index, e) {
		$this = $(this);

		if ($this.attr('id')) {
			if ($this.attr('id').indexOf('megamag_main') != -1) $this.find('.widget-title').css('backgroundColor','#fab764');
			if ($this.attr('id').indexOf('megamag_nomain') != -1) $this.find('.widget-title').css('backgroundColor','#aed689');
		}

	});
});


/*****************************************
ADMIN SETTINGS
*****************************************/

jQuery(document).ready(function($) {

	//SLIDER SORT
	$("#slider_items_list").sortable({
		create: function () {
			$(this).children('li').css('opacity','0.6');
			$(this).children('li:eq(0),:eq(1),:eq(2),:eq(3),:eq(4)').css('opacity','1.0');
		},
	    update : function () {
	        var order = $('#slider_items_list').sortable('toArray');
	        $("#slider_order").attr('value', order);
	        $(this).children('li').css('opacity','0.6');
			$(this).children('li:eq(0),:eq(1),:eq(2),:eq(3),:eq(4)').css('opacity','1.0');
	    }
	}); 	

	
	//RATING SLIDER NEW
	//remember this script is dependent variables sliderMin and sliderMax that are set dynamically in each main document.

	if (typeof sliderMin != 'undefined') {
		$rating_slider = $(".rating_slider");
		$rating_slider.slider({
			range: 'min',
			animate: 'fast',
			min: sliderMin,
			max: sliderMax,
			step: sliderIncr,
			create: function (e, ui) {
				var start_value = $(this).next('input').attr('value');
				$(this).slider('option','value', start_value);
			},
			slide: function (e, ui) {
				var rating_value = $(this).slider('option','value');
				$(this).next('input').attr('value', rating_value);
			}
		});

	} 

	//RESET SETTINGS
	$('#reset_all_button').on('click', function() {
		var conf = confirm("WARNING: You are about to reset all MegaMag settings!");
		if (conf === true) {
			$('#reset_all').val('RESET');
		}
	});

});

/*****************************************
CUSTOM META BOXES
*****************************************/

jQuery(document).ready(function($) {

	//TOGGLES
	if (!$('#cmb_slider_feature').attr('checked')) $('#slider_options_popup').hide();

	$('#cmb_slider_feature').on('click', function() {
		$('#slider_options_popup').slideToggle('slow');
	});


	if (!$('#cmb_is_review').attr('checked')) $('#review_options_popup').hide();
	
	$('#cmb_is_review').on('click', function () {
		$('#review_options_popup').slideToggle('slow');
	});

	//ADD
	$('#template_criterion').hide();
	$('#submit_add_criteria').on('click', function() {
		$newItem = $('#template_criterion .option_item').clone().appendTo('#review_criteria').show();
		if ($newItem.prev('.option_item').size() == 1) {
			var id = parseInt($newItem.prev('.option_item').attr('id')) + 1;
		} else {
			var id = 0;	
		}
		$newItem.attr('id', id);

		var criterionText = 'Criterion ' + (id+1);
		$newItem.children('span:eq(0)').text(criterionText);

		var nameText = 'cmb_review_criteria[' + id + '][0]';
		$newItem.children('.criteria_name').attr('id', nameText).attr('name', nameText);

		var sliderValue = 'cmb_review_criteria['+ id +'][1]';
		$newItem.children('.slider_value').attr('id', sliderValue).attr('name', sliderValue);

		//event handler for newly created element
		$newItem.children('.button_del_criteria').on('click', function () {
			$(this).parent('.option_item').remove();
		});

		//activate slider
		$newItem.children('.rating_slider').slider({
			range: 'min',
			animate: 'fast',
			min: sliderMin,
			max: sliderMax,
			step: sliderIncr,
			create: function (e, ui) {
				var start_value = $(this).next('input').attr('value');
				$(this).slider('option','value', start_value);
			},
			slide: function (e, ui) {
				var rating_value = $(this).slider('option','value');
				$(this).next('input').attr('value', rating_value);
			}
		});
	});

	//DELETE
	$('.button_del_criteria').on('click', function() {
		$(this).parent('.option_item').remove();
	});

});

/*****************************************
COLORPICKER
*****************************************/

jQuery(document).ready(function($) {

	initColorPicker('#colorSelector_header_bg','#color_header_bg');
	initColorPicker('#colorSelector_nav_bg','#color_nav_bg');
	initColorPicker('#colorSelector_nav_text','#color_nav_text');
	initColorPicker('#colorSelector_body_bg','#color_body_bg');
	initColorPicker('#colorSelector_main','#color_main');
	initColorPicker('#colorSelector_rating_bar','#color_rating_bar');

	function initColorPicker (mainSelector, inputSelector) {
		var initColor = $(inputSelector).val();

		$(mainSelector).ColorPicker({
			color: initColor,
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$(mainSelector + ' div').css('backgroundColor', '#' + hex);
				$(inputSelector).val("#" + hex);
			}
		});
	}

});

/*****************************************
UPLOAD
*****************************************/

//header replacement image upload
jQuery(document).ready(function($) {

	if (document.getElementById('upload_header_replacement_img_confirm')) {		//confirms that we are on the page with upload_header_replacement_img_confirm element
	    document.getElementById('upload_header_replacement_img_confirm').style.display = 'none';

	    $('#upload_header_replacement_img_button').click(function() {  
	    	uploadID = jQuery(this).prev('input'); 		//chooses the previous input element relative to the button
	      	confirmDiv = jQuery(this).next();
	        tb_show('Upload a header replacement image', 'media-upload.php?referer=megamag_header_replacement_img&type=image&TB_iframe=true&post_id=0', false);  
	        return false;  
	    });  

		window.send_to_editor = function(html) {  
		    var image_url = $('img',html).attr('src');  
		   	uploadID.val(image_url); 
		    tb_remove();  
		    confirmDiv.css('display','inline');
		    confirmDiv.fadeOut(3000, function() {
		    	$('#submit').trigger('click'); 
		    });
		}
	} 

});

//logo upload
jQuery(document).ready(function($) {

	if (document.getElementById('upload_confirm')) {		//confirms that we are on the page with upload_confirm element
	    document.getElementById('upload_confirm').style.display = 'none';

	    $('#upload_logo_button').click(function() {  
	    	uploadID = jQuery(this).prev('input'); 		//chooses the previous input element relative to the button
	      	confirmDiv = jQuery(this).next();
	        tb_show('Upload a logo', 'media-upload.php?referer=megamag_settings&type=image&TB_iframe=true&post_id=0', false);  
	        return false;  
	    });  

		window.send_to_editor = function(html) {  
		    var image_url = $('img',html).attr('src');  
		   	uploadID.val(image_url); 
		    tb_remove();  
		    confirmDiv.css('display','inline');
		    confirmDiv.fadeOut(3000, function() {
		    	$('#submit').trigger('click'); 
		    });
		}
	} 

});

//favicon upload
jQuery(document).ready(function($) {

	if (document.getElementById('upload_favicon_confirm')) {
	    document.getElementById('upload_favicon_confirm').style.display = 'none';

	    $('#upload_favicon_button').click(function() {  
	       	uploadID = jQuery(this).prev('input'); 		//chooses the previous input element relative to the button
	       	confirmDiv = jQuery(this).next();
	        tb_show('Upload a favicon', 'media-upload.php?referer=megamag_favicon&type=image&TB_iframe=true&post_id=0', false);  
	        return false;  
	    });  

		window.send_to_editor = function(html) {  
		    var image_url = $('img',html).attr('src');  
		   	uploadID.val(image_url);
		    tb_remove();  
		    confirmDiv.css('display','inline');
		    confirmDiv.fadeOut(3000, function() {
		    	$('#submit').trigger('click'); 
		    });
		}
	}
});

//category bg upload
jQuery(document).ready(function($) {

	if (document.getElementById('mega_skins')) {

	    $('.bg_button').click(function() {  
	    	$this = $(this);
	    	textInput = $this.prev('input'); 		//chooses the previous input element relative to the button
	    	console.log(textInput);
	        tb_show('Choose a background', 'media-upload.php?referer=megamag_bg&type=image&TB_iframe=true', false);  
	        return false;  
	    });  

			window.send_to_editor = function(html) {  
			    var image_url = $('img',html).attr('src');  
			   	textInput.val(image_url); 
			    tb_remove();  
			}
	} 

});


/*****************************************
ADMIN POP-UP HELP
*****************************************/

jQuery(document).ready(function($) {

	//remember this script is dependent varibale templateDirectory that is set dynamically in each main document.

	//options general
	mb_pop_up_help('handle_header_replacement_img');
	mb_pop_up_help('handle_header_banner_code');
	mb_pop_up_help('handle_logo_img_url');
	mb_pop_up_help('handle_favicon_url');
	mb_pop_up_help('handle_use_responsive_design');
	mb_pop_up_help('handle_main_twitter_screen_name');
	mb_pop_up_help('handle_main_fb_page');
	mb_pop_up_help('handle_main_feedburner_account');
	mb_pop_up_help('handle_main_flickr_id');
	mb_pop_up_help('handle_google_analytics_code');
	mb_pop_up_help('handle_footer_text_left');
	mb_pop_up_help('handle_footer_text_right');

	//options homepage
	mb_pop_up_help('handle_hp_style');
	mb_pop_up_help('handle_slider_show');
	mb_pop_up_help('handle_slider_style');
	mb_pop_up_help('handle_slider_fx');
	mb_pop_up_help('handle_slider_anim_speed');
	mb_pop_up_help('handle_slider_pause_time');
	mb_pop_up_help('handle_slider_sort');

	//options post
	mb_pop_up_help('handle_show_featured');
	mb_pop_up_help('handle_share_fb');
	mb_pop_up_help('handle_oauth_consumer_key');
	mb_pop_up_help('handle_review_min');
	mb_pop_up_help('handle_review_max');
	mb_pop_up_help('handle_review_increments');
	mb_pop_up_help('handle_review_label_100');

	//options appearance
	mb_pop_up_help('handle_skins');
	mb_pop_up_help('handle_header_style');
	mb_pop_up_help('handle_shadow_box');
	mb_pop_up_help('handle_bg_img');
	mb_pop_up_help('handle_cat_bg');

	function mb_pop_up_help(handle) {
		$mbIcon = $('.table_container .' + handle + ' .table_icon img');
		if ($mbIcon.size()) {
			$mbIconTd = $('.table_container .' + handle + ' .table_icon');
			$help = $('.help_container .' + handle);
			$downset = $mbIcon.position().top + 2;

			$help.css({
				'position': 'absolute',
				'left': '-820px',
				'top': $downset
			});
			$mbIcon.css('cursor', 'pointer');

			$mbIcon.on('click', function () {
				handle = $(this).closest('tr').attr('class');
				$mbIcon = $('.table_container .' + handle + ' .table_icon img');
				$mbIconTd = $('.table_container .' + handle + ' .table_icon');
				$help = $('.help_container .' + handle);
				$downset = $mbIcon.position().top + 2;
				$help.css({
					'top': $downset
				});


				if ($mbIconTd.hasClass('open')) {
					//close all
					$allTd = $('.table_container .table_icon');
					$.each($allTd, function() {
						src = templateDirectory + "/images/arrow_right.png";
						$(this).children('img').attr('src', src).css('opacity', 0.3);
						$(this).removeClass('close');
						$(this).addClass('open');
						eachhandle = $(this).closest('tr').attr('class');
						$eachhelp = $('.help_container .' + eachhandle);
						$eachhelp.animate({
							'left': '-820'
						});
					});

					//open requested
					$help.animate({
						'left': '0'
					}, function () {
						src = templateDirectory + "/images/arrow_left_orange.png";
						$mbIcon.attr('src', src);
						$mbIcon.css('opacity', 1.0)
						$mbIconTd.removeClass('open');
						$mbIconTd.addClass('close');
					});

						
				} else {
					$help.animate({
						'left': '-820'
					}, function () {
						src = templateDirectory + "/images/arrow_right.png";
						$mbIcon.attr('src', src);
						$mbIcon.css('opacity', 0.3)
						$mbIconTd.removeClass('close');
						$mbIconTd.addClass('open');
					});
				}
			});
	
		}	//endif
	}

});


/*****************************************
BACKGROUND IMAGE PICKER
*****************************************/

jQuery(document).ready(function($) {

	$imgs = $('#mega_backgrounds img');

	var initId = $('#bg_img').val();
	$('#mega_backgrounds img[id="' + initId + '"]').addClass('active');

	$imgs.on('click', function () {
		$this = $(this);

		//display active
		$imgs.removeClass('active');
		$this.addClass('active');

		//get and put id
		var id = $this.attr('id');
		$('#bg_img').val(id);
			
	});
});


/*****************************************
SKIN PICKER
*****************************************/

jQuery(document).ready(function($) {
	$skins = $('#mega_skins img');

	$skins.on('click', function() {
		$this = $(this);

		//display active
		$skins.removeClass('active');
		$this.addClass('active');

		//get data
		var header_style = $this.data('header_style');
		var color_header_bg = $this.data('color_header_bg');
		var gradient_header = $this.data('gradient_header');
		var color_nav_bg = $this.data('color_nav_bg');
		var gradient_nav = $this.data('gradient_nav');
		var color_nav_text = $this.data('color_nav_text');
		var nav_text_shadow = $this.data('nav_text_shadow');
		var color_body_bg = $this.data('color_body_bg');
		var color_main = $this.data('color_main');
		var color_rating_bar = $this.data('color_rating_bar');
		var shadow_box = $this.data('shadow_box');
		var bg_img = $this.data('bg_img');

		//display data
		$('#header_style option').removeAttr('selected');
		$('#header_style option[value=' + header_style + ']').attr('selected','selected');		//get the select option where the value is equal to our header style and add attr selected='selected'

		$('#color_header_bg').val(color_header_bg);
		$('#color_header_bg').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_header_bg);

		$('#color_nav_bg').val(color_nav_bg);
		$('#color_nav_bg').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_nav_bg);
		
		$('#color_nav_text').val(color_nav_text);
		$('#color_nav_text').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_nav_text);
		
		$('#nav_text_shadow option').removeAttr('selected');
		$('#nav_text_shadow option[value=' + nav_text_shadow + ']').attr('selected','selected');

		$('#color_body_bg').val(color_body_bg);
		$('#color_body_bg').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_body_bg);

		$('#color_main').val(color_main);
		$('#color_main').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_main);

		$('#color_rating_bar').val(color_rating_bar);
		$('#color_rating_bar').parent('td').next('td').find('.colorSelectorBox div').css('backgroundColor', color_rating_bar);

		//checkboxes
		//first uncheck all
		$('.checkbox').removeAttr('checked');
		//then check if skin turns it on
		if (gradient_header == 'checked') $('#gradient_header').attr('checked','checked');
		if (gradient_nav == 'checked') $('#gradient_nav').attr('checked','checked');
		if (shadow_box == 'checked') $('#shadow_box').attr('checked','checked');


		//update background image
		$('#mega_backgrounds img').removeClass('active');
		$('#mega_backgrounds img[id="' + bg_img + '"]').addClass('active');
		$('#bg_img').val(bg_img);
			

	});
});

/*****************************************
AJAX DELETE SLIDER ITEM
*****************************************/

jQuery(document).ready(function($) {

	$('.del_item').on('click', function () {
		$this = $(this);
		var itemId = $this.attr('data-item_id');
		var nonce = $this.attr('data-nonce');

		$.ajax({
			type: 'post',
			dataType: 'json',
			url: extData.ajaxUrl,
			data: {action: 'del_slider_item', item_id: itemId, nonce: nonce},
			success: function(response) {
				$('#' + itemId).remove();
			}

		}); //end ajax
			
	}); //end click

});


/*****************************************
GOOGLE WEBFONTS
*****************************************/

jQuery(document).ready(function($) {

    if (typeof extDataFonts != 'undefined') {

      // console.log(extDataFonts.fonts.items[0].family);

      $('.megamag_webfonts_controller').each(function(index, e) {
        //GET VARS        
        $thisController = $(this);
        $selectFamily = $thisController.find('.megamag_font_family');
        $selectVariant = $thisController.find('.megamag_font_variant');
        $selectSubset = $thisController.find('.megamag_font_subset');
        var selectedFamily = $selectFamily.attr('data-selected');
        var selectedVariant = $selectVariant.attr('data-selected');
        var selectedSubset = $selectSubset.attr('data-selected');
        var selectedKey = 0;

      /*****************************************
      BUILD SELECTS
      *****************************************/
        //BUILD FAMILY SELECT
        for (i = 0; i < extDataFonts.fonts.items.length; i++) {
          if (extDataFonts.fonts.items[i].family == selectedFamily) {
            var optionFamilyHTML = "<option value='"+ extDataFonts.fonts.items[i].family +"' selected='selected'>"+ extDataFonts.fonts.items[i].family +"</option>";
            selectedKey = i;
          } else {
            var optionFamilyHTML = "<option value='"+ extDataFonts.fonts.items[i].family +"'>"+ extDataFonts.fonts.items[i].family +"</option>";
          }
          $selectFamily.append(optionFamilyHTML);
        }

        //clear out select
        $selectVariant.empty();
        $selectSubset.empty();

        //build variants select
        for (i = 0; i < extDataFonts.fonts.items[selectedKey].variants.length; i++) {
          if (extDataFonts.fonts.items[selectedKey].variants[i] == selectedVariant) {
            var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].variants[i] +"' selected='selected'>"+ extDataFonts.fonts.items[selectedKey].variants[i] +"</option>";
          } else {
            var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].variants[i] +"'>"+ extDataFonts.fonts.items[selectedKey].variants[i] +"</option>";
          }
          $selectVariant.append(optionVariantHTML);
        }

        //build subsets select
        for (i = 0; i < extDataFonts.fonts.items[selectedKey].subsets.length; i++) {
          if (extDataFonts.fonts.items[selectedKey].subsets[i] == selectedSubset) {
            var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"' selected='selected'>"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"</option>";
          } else {
            var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"'>"+ extDataFonts.fonts.items[selectedKey].subsets[i] +"</option>";
          }
          $selectSubset.append(optionSubsetHTML);
        }


      /*****************************************
      ON CHANGE
      *****************************************/
        //ON FAMILY CHANGE EVENT
        $selectFamily.on('change', function () {
            $thisFamilySelect = $(this);
            $relatedVariantSelect = $thisFamilySelect.closest('tr').find('.megamag_font_variant');
            $relatedSubsetSelect = $thisFamilySelect.closest('tr').find('.megamag_font_subset');
            var selectedOption = $thisFamilySelect.val();
            var currentKey = 0;
            //first get the array key
            for (i = 0; i < extDataFonts.fonts.items.length; i++) {
              if (extDataFonts.fonts.items[i].family == selectedOption) currentKey = i;
            }

            //clear out select
            $relatedVariantSelect.empty();
            $relatedSubsetSelect.empty();

            //build variants select
            for (i = 0; i < extDataFonts.fonts.items[currentKey].variants.length; i++) {
              if (extDataFonts.fonts.items[currentKey].variants[i] == selectedVariant) {
                var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].variants[i] +"' selected='selected'>"+ extDataFonts.fonts.items[currentKey].variants[i] +"</option>";
              } else {
                var optionVariantHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].variants[i] +"'>"+ extDataFonts.fonts.items[currentKey].variants[i] +"</option>";
              }
              $relatedVariantSelect.append(optionVariantHTML);
            }

            //build subsets select
            for (i = 0; i < extDataFonts.fonts.items[currentKey].subsets.length; i++) {
              if (extDataFonts.fonts.items[currentKey].subsets[i] == selectedSubset) {
                var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].subsets[i] +"' selected='selected'>"+ extDataFonts.fonts.items[currentKey].subsets[i] +"</option>";
              } else {
                var optionSubsetHTML = "<option value='"+ extDataFonts.fonts.items[currentKey].subsets[i] +"'>"+ extDataFonts.fonts.items[currentKey].subsets[i] +"</option>";
              }
              $relatedSubsetSelect.append(optionSubsetHTML);
            }
        });
      });
    } //end if typof 
});
