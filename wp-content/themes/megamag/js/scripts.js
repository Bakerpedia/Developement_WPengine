jQuery(document).ready(function($) {

//////////////////////////////////////////////////////////////////
// TABS
//////////////////////////////////////////////////////////////////

	//When page loads...
	$('.tabs_wrapper').each(function() {
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	});
	
	//On Click Event
	$("ul.tabs li").click(function(e) {
		$(this).parents('.tabs_wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(this).parents('.tabs_wrapper').find(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(this).parents('.tabs_wrapper').find(activeTab).fadeIn('slow'); //Fade in the active ID content
		
		e.preventDefault();
	});
	
	$("ul.tabs li a").click(function(e) {
		e.preventDefault();
	});
	
//////////////////////////////////////////////////////////////////
// REVIEW RELATED
//////////////////////////////////////////////////////////////////

	// Review sliding scores
	$('.grey-bar img').animate({
		height: '14',
		width: 'toggle'
	},{duration: 1500});

//////////////////////////////////////////////////////////////////
// SHORTCODE RELATED
//////////////////////////////////////////////////////////////////


	$('.toggle_content').hide();

	$('.toggle').on('click', function() {
		$(this).next('.toggle_content').slideToggle('fast');
	});

});	

//////////////////////////////////////////////////////////////////
// RESPONSIVE MENU
//////////////////////////////////////////////////////////////////

jQuery(document).ready(function($) {
	//setup menu
	$links = $('#navigation .menu-item a');
	$mainSelect = $('#navigation_select');
	var currentUrl = window.location.href;
	$links.each(function(index) {
		$this = $(this);
		var navlink = $this.attr('href');
		var navname = $this.text();
		var depth = $this.parents('ul').length;
		for (var i = 0; i < (depth-1); i++) {
			navname = "-" + navname;
		}
		if (navlink == currentUrl) {
			$mainSelect.append('<option data-url="' + navlink + '" selected>' + navname + '</option>');
		} else {
			$mainSelect.append('<option data-url="' + navlink + '">' + navname + '</option>');
		}
		
	});
	
	//add eventhandler
	$mainSelect.change(function() {
		$this = $(this);
		$optionUrl = $this.find('option:selected').data('url');
		window.location.href = $optionUrl;
	});
								
});	


//////////////////////////////////////////////////////////////////
// BACK TO TOP BUTTON
//////////////////////////////////////////////////////////////////

jQuery(document).ready(function($) {
	$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$('#to_top').fadeIn();	
			} else {
				$('#to_top').fadeOut();
			}
		});
	 
		$('#to_top').click(function() {
			$('body,html').animate({scrollTop:0},800);
		});	
});	


/*************************************************************
TWITTER VIA WIDGET MEGAMAG DESIGN
*************************************************************/

	jQuery(document).ready(function($) {
		var useMegamagDesign = $('.twitter_via_widget_megamag_design').attr('data-megamag_design');
		if (useMegamagDesign == "false") {
			$('.twitter_via_widget_megamag_design').hide();
				
		} else {
			$('.twitter_widget').hide();
			$(window).load(function() {
				$('.twitter_widget iframe').each(function(index, e) {
					$this = $(this);
					var numTweets = $('.twitter_via_widget_megamag_design').attr('data-num_tweets');
					var tweetCount = 0;
					$this.contents().find('.tweet').each(function(index, e){
						if (tweetCount == numTweets) return;
						$this = $(this);
						var published = $this.find('time').text();
						var tweet = $this.find('.e-entry-title').html();
						var altTweet = "<li>" + tweet + "<span>" + published + "</span></li>";
						$('.twitter_via_widget_megamag_design ul').append(altTweet);
						tweetCount++;
					});

				});
			});
		}
	});

