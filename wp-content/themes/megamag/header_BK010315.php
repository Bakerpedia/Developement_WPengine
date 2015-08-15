<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<title></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- for responsive theming -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="SHORTCUT ICON" href="http://www.bakerpedia.com/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

	<!-- get options -->
	<?php $megamag_options = get_option('megamag_options'); ?>
	<?php $megamag_options_hp = get_option('megamag_options_hp'); ?>
	<?php $megamag_options_appearance = get_option('megamag_options_appearance'); ?>
    <?php $postid = get_the_ID(); ?> <!-- get the post id of the current page-->

	<!-- If the user chose boxed layout include this css file -->
	<?php 
		if ($megamag_options_appearance['header_style'] == 'boxed') {
		?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/boxed.css" />
		<?php
		}
	?>

	<!-- RESPONSIVE.CSS -->
	<?php 
		if (!empty($megamag_options['use_responsive_design'])) { 
		?>
			<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css" />
		<?php 
		}
	?>

	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Francois+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
	
	<!--KJH  custom code for Accordion on video page-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

	<?php //var_dump($megamag_options_appearance['font_main'][0]); ?>
	
	<?php if ($megamag_options_appearance['font_main'][0] != "megamag_default") echo mb_get_google_webfonts_link($megamag_options_appearance['font_main']); ?>
	<?php if ($megamag_options_appearance['font_nav'][0] != "megamag_default") echo mb_get_google_webfonts_link($megamag_options_appearance['font_nav']); ?>
	<?php if ($megamag_options_appearance['font_widget_headings'][0] != "megamag_default") echo mb_get_google_webfonts_link($megamag_options_appearance['font_widget_headings']); ?>
	<?php if ($megamag_options_appearance['font_post_headings'][0] != "megamag_default") echo mb_get_google_webfonts_link($megamag_options_appearance['font_post_headings']); ?>

	<?php wp_enqueue_script('jquery'); ?>
	<?php wp_enqueue_script('megamag_script', get_template_directory_uri() . '/js/scripts.js'); ?>
	<?php wp_enqueue_script('nivo_slider', get_template_directory_uri(). '/js/jquery.nivo.slider.pack.js'); ?>

	<?php
		/* Support threaded comments*/
		if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	?>
	
	<?php wp_head(); ?>
	<!-- Accordion Video page -->
	<script>
  $(function() {
    $( "#accordion" ).accordion({
      event: "click hoverintent"
    });
  });
 
  /*
   * hoverIntent | Copyright 2011 Brian Cherne
   * http://cherne.net/brian/resources/jquery.hoverIntent.html
   * modified by the jQuery UI team
   */
  $.event.special.hoverintent = {
    setup: function() {
      $( this ).bind( "mouseover", jQuery.event.special.hoverintent.handler );
    },
    teardown: function() {
      $( this ).unbind( "mouseover", jQuery.event.special.hoverintent.handler );
    },
    handler: function( event ) {
      var currentX, currentY, timeout,
        args = arguments,
        target = $( event.target ),
        previousX = event.pageX,
        previousY = event.pageY;
 
      function track( event ) {
        currentX = event.pageX;
        currentY = event.pageY;
      };
 
      function clear() {
        target
          .unbind( "mousemove", track )
          .unbind( "mouseout", clear );
        clearTimeout( timeout );
      }
 
      function handler() {
        var prop,
          orig = event;
 
        if ( ( Math.abs( previousX - currentX ) +
            Math.abs( previousY - currentY ) ) < 7 ) {
          clear();
 
          event = $.Event( "hoverintent" );
          for ( prop in orig ) {
            if ( !( prop in event ) ) {
              event[ prop ] = orig[ prop ];
            }
          }
          // Prevent accessing the original event since the new event
          // is fired asynchronously and the old event is no longer
          // usable (#6028)
          delete event.originalEvent;
 
          target.trigger( event );
        } else {
          previousX = currentX;
          previousY = currentY;
          timeout = setTimeout( handler, 100 );
        }
      }
 
      timeout = setTimeout( handler, 100 );
      target.bind({
        mousemove: track,
        mouseout: clear
      });
    }
  };
  </script>
	<!-- Nivo slider -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(window).load(function() {
				$('#slider').nivoSlider({
					effect: '<?php echo $megamag_options_hp['slider_fx']; ?>', // Specify sets like: 'fold,fade,sliceDown'
					animSpeed: <?php echo $megamag_options_hp['slider_anim_speed']; ?>,	//animation transition speed default 500
					pauseTime: <?php echo $megamag_options_hp['slider_pause_time']; ?>, // How long each slide will show default 3000
					captionOpacity:false, // Universal caption opacity
					directionNav:false, // Next & Prev navigation
					directionNavHide:false, // Only show on hover
					<?php if ($megamag_options_hp['slider_style'] == 'compact') {
							echo "controlNavThumbs:true,";		//if nav is thumbs
						} else {
							echo "controlNav:true,"; 			//if nav is bullets
						} 
					?>
				});

			});
		});
	</script>
	
	<!-- DYNAMIC CSS (Style changes from theme options) -->
	<?php 
		require "css/dynamic.css.php";
	?>


	<!-- Custom category background images -->
	<?php 
		if (is_single() || mb_get_page_type() == 'category') {
			$header_cat = get_the_category();
			$cat_ID = $header_cat[0]->cat_ID;
			if (!empty($megamag_options_appearance['bg_url_cat_' . $cat_ID])) {
			?>
				<style type="text/css">
					body { background:<?php echo $megamag_options_appearance['color_body_bg']; ?> url(<?php echo $megamag_options_appearance['bg_url_cat_' . $cat_ID]; ?>) fixed; }
				</style>
			<?php
			}

		}
	?>

</head>

<body <?php body_class();  ?>>

	<div id="wrapper">

		<!-- HEADER -->

		<?php 
			if (isset($megamag_options['replace_header_box'])) {
			?>	
				<a href="<?php  echo home_url(); ?>">
                <img id='header-image' src='<?php echo $megamag_options['header_replacement_img']; ?>' <?php if ($megamag_options_appearance['header_style'] == 'boxed') echo "width='980'"; ?> /></a>
			<?php
			} else {
			?>	

				<div id="header-wrapper">
					
					<div class="container">
						<!-- KJH 1/1/15 Don't show the banner for post 2947 Thermal Profiling or 2978 BakeWatch.-->
						<?php 
						 if (!($postid == '2947' || $postid == '2978')) {
							if (isset($megamag_options['show_header_banner'])) {
							?>
								<div id="header-banner">

									<?php 
										if (!empty($megamag_options['header_banner_code'])) {
											echo $megamag_options['header_banner_code']; 	
										} else { 
									?>
                                   
									 <a target="_blank" onclick="_gaq.push(['_trackEvent','KStateCall','clicks','KStateCall']);" 
                                        href="http://www.grains.k-state.edu/undergraduate-programs/degree-options/bakery-science-and-management.html">
										<img class="header image" alt="banner image" src="<?php echo get_template_directory_uri(); ?>/images/default_banner_header.jpg"/>
									 </a>
                                    
									<?php			
										}
									?>
								
								</div>

						 	<?php	
						 	}
						}
						?>
					
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-39853201-1']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script>

					
						<div id="logo">
						
						  <a href="<?php  echo home_url(); ?>"><img src="<?php if (empty($megamag_options['logo_img_url'])) { echo get_template_directory_uri() . "/images/default_logo.png";} else {echo $megamag_options['logo_img_url'];} ?>" alt="" /></a>
							
						</div>
						
						<div class="clearfix" id="logoText">The Commercial Baker's Encyclopedia<span id="logoTM">&trade; </span></div>
					
					</div>
				
				</div>
				<!-- END HEADER-WRAPPER -->
					
			<?php
			}

		?>

		<!-- NAVIGATION -->

		<div id="navigation-wrapper">
		
			<div class="container">
		
				<?php wp_nav_menu(array( 
					'theme_location' => 'navigation',
					'menu_id' => 'navigation',
					'container' => false,
					'show_home' => '1'
					));
				 ?>
				 
				 <select id="navigation_select">
				 </select>

			</div>
		
		</div>
		<!-- END NAVIGATION-WRAPPER -->
