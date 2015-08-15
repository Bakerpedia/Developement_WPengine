<style type="text/css">
	
	/* body font */
	body, #respond textarea {
		font-family:"Open Sans";
        <?php if ($megamag_options_appearance['font_main'][0] != 'megamag_default') echo 'font-family: "' . $megamag_options_appearance['font_main'][0] . '";'; ?>
	}
	
	/* Navigation font */
	#navigation-wrapper .menu li a {
		font-family:"Francois One";
        <?php if ($megamag_options_appearance['font_nav'][0] != 'megamag_default') echo 'font-family: "' . $megamag_options_appearance['font_nav'][0] . '";'; ?>
	}
	
	/* Widget headings */
	.home-widget h1, .blog-heading, #sidebar .widget h1, #sidebar .widget ul.tabs, #footer .widget h1, .post-author h1, .post-related h1, .comments h1, .browsing h1, .item .item-image .item-score.big span.the-score, #sidebar .widget .social-count span, .review-wrapper .overall .score, .blog-item .item-image .item-score.big span.the-score {
		font-family:"Francois One";
        <?php if ($megamag_options_appearance['font_widget_headings'][0] != 'megamag_default') echo 'font-family: "' . $megamag_options_appearance['font_widget_headings'][0] . '";'; ?>
	}
	
	/* Post headings */
	.item h2 a, h1.post-heading, .post-related .related-item h2, #respond  h3, .blog-item h2 a, a.button, #navigation-wrapper .menu li ul li a, .item .item-image .item-score.small span.the-score, .nivo-caption h2 a {
		font-family:"Droid Sans";
        <?php if ($megamag_options_appearance['font_post_headings'][0] != 'megamag_default') echo 'font-family: "' . $megamag_options_appearance['font_post_headings'][0] . '";'; ?>
	}
	
	body { 
		background:<?php echo $megamag_options_appearance['color_body_bg']; ?> url(<?php if (!empty($megamag_options_appearance['custom_bg_url'])) {echo $megamag_options_appearance['custom_bg_url'];} else { echo get_template_directory_uri() . "/images/patterns/" . $megamag_options_appearance['bg_img']; } ?>) fixed; 
	}

	#header-wrapper { 
		background:<?php echo $megamag_options_appearance['color_header_bg']; ?> <?php if (!empty($megamag_options_appearance['gradient_header']))echo "url(" . get_template_directory_uri() . "/images/header-trans.png) repeat-x top;"; ?> 

	}
	#navigation-wrapper { 
		background:<?php echo $megamag_options_appearance['color_nav_bg']; ?> <?php if (!empty($megamag_options_appearance['gradient_nav']))echo "url(" . get_template_directory_uri() . "/images/navigation-trans.png) repeat-x;"; ?> 
	}
	
	.menu li a {
		color:<?php echo $megamag_options_appearance['color_nav_text']; ?> !important; <?php if ($megamag_options_appearance['nav_text_shadow'] == 'dark') { echo "text-shadow:0 -1px 0 rgba(0, 0, 0, 1);"; } else { echo "text-shadow:1px 1px 0 rgba(240, 240, 240, 1);"; } ?> 
	}
	
	.home-widget h1, #sidebar .widget h1, .post-author, .post-related h1, .comments h1, .browsing, .blog-heading {
		border-left:10px solid <?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	.home-widget .block .item p a, .item.small h2 a:hover, .home-widget .block .item.big h2 a:hover, .post-related h2 a:hover, .blog-item h2 a:hover, .item ul.meta li a.comment:hover, .widget ul.twitter li a span {
		color:<?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	#sidebar .widget ul.tabs li:hover, #sidebar .widget ul.tabs li.active, .tab_tag_cloud a:hover, .post-tags a:hover, ul.page-numbers a:hover, ul.page-numbers .current {
		background:<?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	#sidebar .widget .item.small.comment .item-comment a:hover, #footer .widget a, .nivo-caption h2 a:hover, ul.menu li ul li a:hover, a {
		color:<?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	#footer .widget h1, .comment-content {
		border-left:5px solid <?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	.comment .arrow {
		border-right:7px solid <?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	.slider-wrapper.full.two .nivo-caption {
		border-left:4px solid <?php echo $megamag_options_appearance['color_main']; ?>; 
	}

	ul.post-meta li.comment, .item.big ul.meta li.comment { 
		background:<?php echo $megamag_options_appearance['color_main']; ?> url(<?php echo get_template_directory_uri(); ?>/images/post-comment.png); 
	}
	
	#main, #footer, #footer-bottom, #header-wrapper {
		<?php if (!empty($megamag_options_appearance['shadow_box'])) echo "-webkit-box-shadow:0px 5px 16px rgba(15, 15, 15, 1); -moz-box-shadow:0px 5px 16px rgba(15, 15, 15, 1);	box-shadow:0px 5px 16px rgba(15, 15, 15, 1);"; ?> 
	}

	#navigation-wrapper {
		<?php if (!empty($megamag_options_appearance['shadow_box'])) echo "-webkit-box-shadow: 0px 5px 5px rgba(15, 15, 15, 0.8); -moz-box-shadow:0px 5px 5px rgba(15, 15, 15, 0.8); box-shadow:0px 5px 5px rgba(15, 15, 15, 0.8);"; ?> 
	}
	
	
</style>

