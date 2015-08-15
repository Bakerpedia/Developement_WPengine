	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>

		<h2>MEGAMAG - General Settings</h2>

		<?php 
			//delete_option('megamag_options');
			$megamag_options = get_option('megamag_options'); 

			//RESET
				if ($megamag_options['reset_all'] == 'RESET') {
					delete_option('megamag_options');
					delete_option('megamag_options_hp');
					delete_option('megamag_options_post');
					delete_option('megamag_options_appearance');
					delete_transient('twitter_count');
					echo "<script>alert('All MegaMag settings have been reset!'); window.location.reload();</script>";
				}
			//var_dump($megamag_options);

		?>

		<script>var templateDirectory = "<?php echo get_template_directory_uri(); ?>";</script>

		<br>
		
		<div class="options_wrapper">
		
		<div class="table_container">

			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('group_megamag_options'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
				<?php do_settings_sections('handle_megamag_menu'); ?>		

				<?php submit_button(); ?>

				<h3>General</h3>

				<table class='form-table'>

					<tr valign='top'>
						<th scope='row'>Replace header box with image</th>
						<td>
							<input class="checkbox" type="checkbox" id="replace_header_box" name="megamag_options[replace_header_box]" value="checked" <?php checked(isset($megamag_options['replace_header_box'])) ?>/> 
						</td>
					</tr>

					<tr valign='top' class='handle_header_replacement_img'>
						<th scope='row'>Header replacement image</th>
						<td>
							<input type='text' id='header_replacement_img' name='megamag_options[header_replacement_img]' class='megamag_upload_input' value='<?php if (isset($megamag_options['header_replacement_img'])) echo $megamag_options['header_replacement_img']; ?>'>
							<input id="upload_header_replacement_img_button" type="button" class="button megamag_upload_button" value="Upload image" />
							<div id="upload_header_replacement_img_confirm"> Header replacement image updated! </div>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_header_banner_code'>
						<th scope='row'>Header banner code</th>
						<td class='table_input'>
							<textarea id='header_banner_code' name='megamag_options[header_banner_code]' rows='5' cols='100'><?php if (isset($megamag_options['header_banner_code'])) echo htmlentities($megamag_options['header_banner_code']); ?></textarea>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show header banner</th>
						<td>
							<input class="checkbox" type="checkbox" id="show_header_banner" name="megamag_options[show_header_banner]" value="checked" <?php checked(isset($megamag_options['show_header_banner'])) ?>/> 
						</td>
					</tr>


					<tr valign='top' class='handle_logo_img_url'>
						<th scope='row'>Logo URL</th>
						<td>
							<input type='text' id='logo_img_url' name='megamag_options[logo_img_url]' class='megamag_upload_input' value='<?php if (isset($megamag_options['logo_img_url'])) echo $megamag_options['logo_img_url']; ?>'>
							<input id="upload_logo_button" type="button" class="button megamag_upload_button" value="Upload logo" />
							<div id="upload_confirm"> Logo updated! </div>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_favicon_url'>
						<th scope='row'>Favicon URL</th>
						<td>
							<input type='text' id='favicon_url' name='megamag_options[favicon_url]' class='megamag_upload_input' value='<?php if (isset($megamag_options['favicon_url'])) echo $megamag_options['favicon_url']; ?>'>
							<input id="upload_favicon_button" type="button" class="button megamag_upload_button" value="Upload favicon" />
							<div id="upload_favicon_confirm"> Favicon updated! </div>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_use_responsive_design'>
						<th scope='row'>Use responsive design</th>
						<td>
							<input class="checkbox" type="checkbox" id="use_responsive_design" name="megamag_options[use_responsive_design]" value="checked" <?php checked(isset($megamag_options['use_responsive_design'])) ?>/> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>


				</table>

				<br>

				<h3>Accounts</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_main_twitter_screen_name'>
						<th scope='row'>Twitter Screen Name</th>
						<td class='table_input'>
							<input type='text' id='main_twitter_screen_name' name='megamag_options[main_twitter_screen_name]' value='<?php if (isset($megamag_options['main_twitter_screen_name'])) echo $megamag_options['main_twitter_screen_name']; ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_main_fb_page'>
						<th scope='row'>Facebook Page</th>
						<td>
							<input type='text' id='main_fb_page' name='megamag_options[main_fb_page]' value='<?php if (isset($megamag_options['main_fb_page'])) echo $megamag_options['main_fb_page']; ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_main_feedburner_account'>
						<th scope='row'>Feedburner Account</th>
						<td>
							<input type='text' id='main_feedburner_account' name='megamag_options[main_feedburner_account]' value='<?php if (isset($megamag_options['main_feedburner_account'])) echo $megamag_options['main_feedburner_account']; ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_main_flickr_id'>
						<th scope='row'>Flickr ID</th>
						<td>
							<input type='text' id='main_flickr_id' name='megamag_options[main_flickr_id]' value='<?php if (isset($megamag_options['main_flickr_id'])) echo $megamag_options['main_flickr_id']; ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>


				</table>

				<br>

				<h3>Footer</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_google_analytics_code'>
						<th scope='row'>Google Analytics</th>
						<td class='table_input'>
							<textarea id='google_analytics_code' name='megamag_options[google_analytics_code]' rows='5' cols='100'><?php if (isset($megamag_options['google_analytics_code'])) echo $megamag_options['google_analytics_code']; ?></textarea>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_footer_text_left'>
						<th scope='row'>Footer Text Left</th>
						<td>
							<textarea id='footer_text_left' name='megamag_options[footer_text_left]' rows='5' cols='100'><?php if (isset($megamag_options['footer_text_left'])) echo $megamag_options['footer_text_left']; ?></textarea>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_footer_text_right'>
						<th scope='row'>Footer Text Right</th>
						<td>
							<textarea id='footer_text_right' name='megamag_options[footer_text_right]' rows='5' cols='100'><?php if (isset($megamag_options['footer_text_right'])) echo $megamag_options['footer_text_right']; ?></textarea>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

				</table>

				<?php submit_button(); ?>
				<button id="reset_all_button" name="reset_all_button" class="button-primary">Reset</button>
				<input type="hidden" id="reset_all" name="megamag_options[reset_all]" value="">

			</form>
		</div> <!-- end table container -->	

		<div class="help_container">

			<div class='popup_help handle_header_replacement_img'>
				The header box contains the logo and optionally the header banner.<br>
				You can remove this and replace it with an image instead.<br>
				<br>
				<b>For boxed version</b> your image will be resized to 980 pixels in width.<br>
				<b>For full width version</b> your image will not be resized but it is recommended that you use images of 1920 pixels or more in size.<br>
			</div>

			<div class='popup_help handle_header_banner_code'>
				This is the code responsible for displaying the banner located in the header area. <br>
				Usually in the form of &lt;img src="thepath/thefilename.jpg"&gt;. <br>
				If no input the default_header_banner.jpg will be displayed (size: 468x60px) <br>
			</div>

			<div class='popup_help handle_logo_img_url'>
				Complete URL to your logo. You can choose to upload a new image and use that as your logo. Click on the "Upload logo" button. Choose an image and be sure to click the "Use as logo" button. <br>
				The image will be uploaded to your media library and you can edit or delete it through the Media menu. You can also insert a URL manually in the text field. <br>
				If you wish to use an image you have already uploaded to your media library go to the Media menu, choose your image and copy the File URL into the Logo URL text field. <br>
				If you leave the text field empty the default logo will be displayed. <br>
			</div>

			<div class='popup_help handle_favicon_url'>
				Works like the Logo URL. Either insert a URL manually or use the upload function. You can edit or delete the favicon using the Media menu. Leave the text field blank to use the default favicon. <br>
			</div>

			<div class='popup_help handle_use_responsive_design'>
				Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. The MegaMag theme supports 4 browser sizes which are roughly: Normal computer screen, tablet horizontal, tablet vertical and mobile phone.<br>
				<br>
				Turning off the responsive design will make the site look the same across all devices and browser sizes.<br>
			</div>

			<div class='popup_help handle_main_twitter_screen_name'>
				This is where you set your general social media info. The MEGAMAG theme will attempt to use this info in the MEGAMAG widgets. <br>
				You can however input new info individually in each of the widgets to overwrite the general info you input on this page. <br>
				That way you can have multiple social media widgets each connected to a different account.<br>
				<br>
				If your Twitter homepage is http://twitter.com/<i>envato</i> then your Twitter screen name is: <i>envato</i>			
			</div>

			<div class='popup_help handle_main_fb_page'>
				If your Facebook homepage is http://www.facebook.com/<i>envato</i> then your Facebook page is: <i>envato</i><br>
				NOTICE: You need to register a Facebook Page username. Go to your facebook page > edit page > basic information > username <br>
			</div>

			<div class='popup_help handle_main_feedburner_account'>
				If your Feedburner feed has the url: http://feeds.feedburner.com/<i>affiliateblogs</i> then your account name is <i>affiliateblogs</i>
			</div>

			<div class='popup_help handle_main_flickr_id'>
				If you are unsure what your Flickr ID is then you can use <a href='http://idgettr.com/' target='_blank'>http://idgettr.com/</a> to find it
			</div>

			<div class='popup_help handle_google_analytics_code'>
				Insert your Google Analytics code here.
			</div>

			<div class='popup_help handle_footer_text_left'>
				The text that is displayed in the bottom left-hand corner of your footer. Can contain HTML.
			</div>

			<div class='popup_help handle_footer_text_right'>
				The text that is displayed in the bottom right-hand corner of your footer. Can contain HTML.
			</div>

		</div> <!-- end help_container -->
	
		</div>

	</div>

