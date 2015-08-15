 <div class="wrap">
		<div id="icon-themes" class="icon32"></div>

		<h2>MEGAMAG - Appearance Settings</h2>

		<?php 
			//delete_option('megamag_options_appearance');
			$megamag_options_appearance = get_option('megamag_options_appearance');
			//var_dump($megamag_options_appearance); 

		?>

		<script>var templateDirectory = "<?php echo get_template_directory_uri(); ?>";</script>

		<br>
		
		<div class="options_wrapper">
		
		<div class='table_container'>

			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('group_megamag_options_appearance'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
				<?php do_settings_sections('handle_megamag_submenu_appearance'); ?>		

				<?php submit_button(); ?>
				
				<h3 class="mega_heading">Choose a predefined skin</h3>
				
				<table class='form-table'>

					<tr valign='top' class='handle_skins'>
						
						<td width='742'>
							<div id="mega_skins">
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre1.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#000000"
									data-gradient_header	="checked"
									data-color_nav_bg		="#000000"
									data-gradient_nav		="checked"
									data-color_nav_text		="#ffffff"
									data-nav_text_shadow	="dark"
									data-color_body_bg		="#4C4946"
									data-color_main			="#FF8604"
									data-color_rating_bar	="#FF8604"
									data-shadow_box			="checked"
									data-bg_img				=""
								/>
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre2.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#ffffff"
									data-gradient_header	=""
									data-color_nav_bg		="#282828"
									data-gradient_nav		=""
									data-color_nav_text		="#ffffff"
									data-nav_text_shadow	="dark"
									data-color_body_bg		="#eeeeee"
									data-color_main			="#ec635d"
									data-color_rating_bar	="#ec635d"
									data-shadow_box			=""
									data-bg_img				="pat10.png"
								/>
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre3.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#000000"
									data-gradient_header	=""
									data-color_nav_bg		="#191919"
									data-gradient_nav		="checked"
									data-color_nav_text		="#ffffff"
									data-nav_text_shadow	="dark"
									data-color_body_bg		="#111111"
									data-color_main			="#ca2020"
									data-color_rating_bar	="#ca2020"
									data-shadow_box			="checked"
									data-bg_img				=""
								/>
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre4.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#f15a2d"
									data-gradient_header	=""
									data-color_nav_bg		="#e4e4e4"
									data-gradient_nav		=""
									data-color_nav_text		="#666666"
									data-nav_text_shadow	="white"
									data-color_body_bg		="#eeeeee"
									data-color_main			="#f15a2d"
									data-color_rating_bar	="#f15a2d"
									data-shadow_box			=""
									data-bg_img				="pat23.png"
								/>
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre5.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#ffffff"
									data-gradient_header	=""
									data-color_nav_bg		="#ed0f69"
									data-gradient_nav		="checked"
									data-color_nav_text		="#ffffff"
									data-nav_text_shadow	="dark"
									data-color_body_bg		="#e7e7e7"
									data-color_main			="#ed0f69"
									data-color_rating_bar	="#ed0f69"
									data-shadow_box			=""
									data-bg_img				="pat1.png"
								/>
								<img src="<?php echo get_template_directory_uri() ?>/images/admin/predefined/pre6.png" alt="" 
									data-header_style		="boxed"
									data-color_header_bg	="#292929"
									data-gradient_header	="checked"
									data-color_nav_bg		="#73990b"
									data-gradient_nav		="checked"
									data-color_nav_text		="#ffffff"
									data-nav_text_shadow	="dark"
									data-color_body_bg		="#111111"
									data-color_main			="#73990b"
									data-color_rating_bar	="#73990b"
									data-shadow_box			="checked"
									data-bg_img				="pat16.png"
								/>
							</div>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

				</table>
				
				<h3 class="mega_heading">Create your own skin</h3>
				
				<h3>Color settings</h3>

				<table class='form-table'>
					
					<tr valign='top' class='handle_header_style'>
						<th scope='row'>Layout style</th>
						<td style="width:140px;">
							<select id="header_style" name="megamag_options_appearance[header_style]">
								<option value="boxed" <?php if (isset($megamag_options_appearance['header_style'])) {if ($megamag_options_appearance['header_style'] == "boxed") echo "selected='selected'";} ?>>Boxed</option> 
								<option value="full" <?php if (isset($megamag_options_appearance['header_style'])) {if ($megamag_options_appearance['header_style'] == "full") echo "selected='selected'";} ?>>Full width</option> 
							</select>
						</td>
						<td width='360'></td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>
					
					<tr valign='top'>
						<th scope='row'>Header background color</th>
						<td style="width:140px;">
							<input type="text" id="color_header_bg" name="megamag_options_appearance[color_header_bg]" value="<?php echo $megamag_options_appearance['color_header_bg']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_header_bg" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_header_bg']; ?>"></div></div>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show header gradient</th>
						<td>
							<input class="checkbox" type="checkbox" id="gradient_header" name="megamag_options_appearance[gradient_header]" value="checked" <?php checked(isset($megamag_options_appearance['gradient_header'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Navigation menu background color</th>
						<td>
							<input type="text" id="color_nav_bg" name="megamag_options_appearance[color_nav_bg]" value="<?php echo $megamag_options_appearance['color_nav_bg']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_nav_bg" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_nav_bg']; ?>"></div></div>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show navigation menu gradient</th>
						<td>
							<input class="checkbox" type="checkbox" id="gradient_nav" name="megamag_options_appearance[gradient_nav]" value="checked" <?php checked(isset($megamag_options_appearance['gradient_nav'])) ?>/> 
						</td>
					</tr>
					
					<!-- new -->
					<tr valign='top'>
						<th scope='row'>Navigation menu text color</th>
						<td>
							<input type="text" id="color_nav_text" name="megamag_options_appearance[color_nav_text]" value="<?php echo $megamag_options_appearance['color_nav_text']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_nav_text" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_nav_text']; ?>"></div></div>
						</td>
					</tr>
					
					<tr valign='top' class='handle_nav_text_shadow'>
						<th scope='row'>Navigation menu text shadow</th>
						<td style="width:140px;">
							<select id="nav_text_shadow" name="megamag_options_appearance[nav_text_shadow]">
								<option value="dark" <?php if (isset($megamag_options_appearance['nav_text_shadow'])) {if ($megamag_options_appearance['nav_text_shadow'] == "dark") echo "selected='selected'";} ?>>Dark shadow</option> 
								<option value="white" <?php if (isset($megamag_options_appearance['nav_text_shadow'])) {if ($megamag_options_appearance['nav_text_shadow'] == "white") echo "selected='selected'";} ?>>White shadow</option> 
							</select>
						</td>

					</tr>

					<tr valign='top'>
						<th scope='row'>Body background color</th>
						<td>
							<input type="text" id="color_body_bg" name="megamag_options_appearance[color_body_bg]" value="<?php echo $megamag_options_appearance['color_body_bg']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_body_bg" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_body_bg']; ?>"></div></div>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Main color</th>
						<td>
							<input type="text" id="color_main" name="megamag_options_appearance[color_main]" value="<?php echo $megamag_options_appearance['color_main']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_main" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_main']; ?>"></div></div>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Rating bar color</th>
						<td>
							<input type="text" id="color_rating_bar" name="megamag_options_appearance[color_rating_bar]" value="<?php echo $megamag_options_appearance['color_rating_bar']; ?>" />    
						</td>
						<td>
							<div id="colorSelector_rating_bar" class="colorSelectorBox"><div style="background-color: <?php echo $megamag_options_appearance['color_rating_bar']; ?>"></div></div>
						</td>
					</tr>

				</table>
				
				<h3>Box shadows</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_shadow_box'>
						<th scope='row'>Show box shadows</th>
						<td width='520'>
							<input class="checkbox" type="checkbox" id="shadow_box" name="megamag_options_appearance[shadow_box]" value="checked" <?php checked(isset($megamag_options_appearance['shadow_box'])) ?>/> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

				</table>

				<br><br>

				<h3>Fonts</h3>

				<table class='form-table'>

		          <!-- MAIN FONT -->  

		            <tr id='font_main' valign='top' class='megamag_webfonts_controller'>
		              <th scope='row'>Main font</th>
		              <td>
		                <select id="font_main_family" name="megamag_options_appearance[font_main][0]" class="megamag_font_family" data-selected="<?php if (isset($megamag_options_appearance['font_main'][0])) echo $megamag_options_appearance['font_main'][0]; ?>"> 
		                    <option value="megamag_default" <?php if (isset($megamag_options_appearance['font_main'][0])) {if ($megamag_options_appearance['font_main'][0] == "megamag_default") echo "selected='selected'";} ?>>MEGAMAG DEFAULT</option> 
                    		<option value="megamag_default">----</option> 
		                  
		                </select> 
		              </td>
		              <td>
		                <select id="font_main_variant" name="megamag_options_appearance[font_main][1]" class="megamag_font_variant" data-selected="<?php if (isset($megamag_options_appearance['font_main'][1])) echo $megamag_options_appearance['font_main'][1]; ?>"> 
		                </select> 
		              </td>
		              <td>
		                <select id="font_main_subset" name="megamag_options_appearance[font_main][2]" class="megamag_font_subset" data-selected="<?php if (isset($megamag_options_appearance['font_main'][2])) echo $megamag_options_appearance['font_main'][2]; ?>"> 
		                </select> 
		              </td>
		            </tr>

		            <tr id='font_nav' valign='top' class='megamag_webfonts_controller'>
		              <th scope='row'>Navigation menu font</th>
		              <td>
		                <select id="font_nav_family" name="megamag_options_appearance[font_nav][0]" class="megamag_font_family" data-selected="<?php if (isset($megamag_options_appearance['font_nav'][0])) echo $megamag_options_appearance['font_nav'][0]; ?>"> 
		                    <option value="megamag_default" <?php if (isset($megamag_options_appearance['font_nav'][0])) {if ($megamag_options_appearance['font_nav'][0] == "megamag_default") echo "selected='selected'";} ?>>MEGAMAG DEFAULT</option> 
                    		<option value="megamag_default">----</option> 
		                  
		                </select> 
		              </td>
		              <td>
		                <select id="font_nav_variant" name="megamag_options_appearance[font_nav][1]" class="megamag_font_variant" data-selected="<?php if (isset($megamag_options_appearance['font_nav'][1])) echo $megamag_options_appearance['font_nav'][1]; ?>"> 
		                </select> 
		              </td>
		              <td>
		                <select id="font_nav_subset" name="megamag_options_appearance[font_nav][2]" class="megamag_font_subset" data-selected="<?php if (isset($megamag_options_appearance['font_nav'][2])) echo $megamag_options_appearance['font_nav'][2]; ?>"> 
		                </select> 
		              </td>
		            </tr>

		            <tr id='font_widget_headings' valign='top' class='megamag_webfonts_controller'>
		              <th scope='row'>Widget headings font</th>
		              <td>
		                <select id="font_widget_headings_family" name="megamag_options_appearance[font_widget_headings][0]" class="megamag_font_family" data-selected="<?php if (isset($megamag_options_appearance['font_widget_headings'][0])) echo $megamag_options_appearance['font_widget_headings'][0]; ?>"> 
		                    <option value="megamag_default" <?php if (isset($megamag_options_appearance['font_widget_headings'][0])) {if ($megamag_options_appearance['font_widget_headings'][0] == "megamag_default") echo "selected='selected'";} ?>>MEGAMAG DEFAULT</option> 
                    		<option value="megamag_default">----</option> 
		                  
		                </select> 
		              </td>
		              <td>
		                <select id="font_widget_headings_variant" name="megamag_options_appearance[font_widget_headings][1]" class="megamag_font_variant" data-selected="<?php if (isset($megamag_options_appearance['font_widget_headings'][1])) echo $megamag_options_appearance['font_widget_headings'][1]; ?>"> 
		                </select> 
		              </td>
		              <td>
		                <select id="font_widget_headings_subset" name="megamag_options_appearance[font_widget_headings][2]" class="megamag_font_subset" data-selected="<?php if (isset($megamag_options_appearance['font_widget_headings'][2])) echo $megamag_options_appearance['font_widget_headings'][2]; ?>"> 
		                </select> 
		              </td>
		            </tr>

		            <tr id='font_post_headings' valign='top' class='megamag_webfonts_controller'>
		              <th scope='row'>Post headings font</th>
		              <td>
		                <select id="font_post_headings_family" name="megamag_options_appearance[font_post_headings][0]" class="megamag_font_family" data-selected="<?php if (isset($megamag_options_appearance['font_post_headings'][0])) echo $megamag_options_appearance['font_post_headings'][0]; ?>"> 
		                    <option value="megamag_default" <?php if (isset($megamag_options_appearance['font_post_headings'][0])) {if ($megamag_options_appearance['font_post_headings'][0] == "megamag_default") echo "selected='selected'";} ?>>MEGAMAG DEFAULT</option> 
                    		<option value="megamag_default">----</option> 
		                  
		                </select> 
		              </td>
		              <td>
		                <select id="font_post_headings_variant" name="megamag_options_appearance[font_post_headings][1]" class="megamag_font_variant" data-selected="<?php if (isset($megamag_options_appearance['font_post_headings'][1])) echo $megamag_options_appearance['font_post_headings'][1]; ?>"> 
		                </select> 
		              </td>
		              <td>
		                <select id="font_post_headings_subset" name="megamag_options_appearance[font_post_headings][2]" class="megamag_font_subset" data-selected="<?php if (isset($megamag_options_appearance['font_post_headings'][2])) echo $megamag_options_appearance['font_post_headings'][2]; ?>"> 
		                </select> 
		              </td>
		            </tr>

				</table>

				<br><br>

				<h3>Background Settings</h3>
				
				<table class='form-table'>

					<tr valign='top' class='handle_bg_img'>
						<th scope='row'>Background patterns</th>
						<td>
							<div id="mega_backgrounds">
								<img id="pat1.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat1.png" alt="" />
								<img id="pat2.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat2.png" alt="" />
								<img id="pat3.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat3.png" alt="" />
								<img id="pat4.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat4.png" alt="" />
								<img id="pat5.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat5.png" alt="" />
								<img id="pat6.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat6.png" alt="" />
								<img id="pat7.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat7.png" alt="" />
								<img id="pat9.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat9.png" alt="" />
								<img id="pat10.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat10.png" alt="" />
								<img id="pat11.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat11.png" alt="" />
								<img id="pat12.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat12.png" alt="" />
								<img id="pat13.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat13.png" alt="" />
								<img id="pat14.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat14.png" alt="" />
								<img id="pat15.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat15.png" alt="" />
								<img id="pat16.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat16.png" alt="" />
								<img id="pat17.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat17.png" alt="" />
								<img id="pat19.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat19.png" alt="" />
								<img id="pat20.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat20.png" alt="" />
								<img id="pat21.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat21.png" alt="" />
								<img id="pat23.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat23.png" alt="" />
								<img id="pat24.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat24.png" alt="" />
								<img id="pat25.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat25.png" alt="" />
								<img id="pat26.png" src="<?php echo get_template_directory_uri() ?>/images/admin/backgrounds/pat26.png" alt="" />
							</div>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<input type="hidden" id="bg_img" name="megamag_options_appearance[bg_img]" value="<?php if (isset($megamag_options_appearance['bg_img'])) echo $megamag_options_appearance['bg_img']; ?>">

					<tr valign='top'>
						<th scope='row'>Custom background upload</th>
						<td>
							<input type='text' id='custom_bg_url' name='megamag_options_appearance[custom_bg_url]' value='<?php if (isset($megamag_options_appearance['custom_bg_url'])) echo $megamag_options_appearance['custom_bg_url']; ?>'>
							<input class='bg_button button' type="button" value="Upload Custom Background" />
						</td>
					</tr>

				</table>

				<br>
				<h3>Category backgrounds</h3>

				<table class='form-table'>

				<?php 
					$categories = get_categories(array(
						'orderby' => 'name',
						'order' => 'ASC',
						'hide_empty' => 1,
					));

					$categories = array_values($categories);

					if (count($categories) < 1) {
					?>
							<tr>
								<th><i>No categories found!</i></th>
							</tr>

					<?php
					} else {
						for ($i = 0; $i < count($categories); $i++) { 
						?>
							<tr <?php if ($i == 0) { echo "valign='top' class='handle_cat_bg'";}?>>
								<th><?php echo $categories[$i]->name; ?>
								</th>	
								<td>
									<input class='cat_bg_input' type='text' id='bg_url_cat_<?php echo $categories[$i]->cat_ID; ?>' name='megamag_options_appearance[bg_url_cat_<?php echo $categories[$i]->cat_ID; ?>]' value='<?php if (isset($megamag_options_appearance['bg_url_cat_'. $categories[$i]->cat_ID])) echo $megamag_options_appearance['bg_url_cat_'. $categories[$i]->cat_ID]; ?>'>
									<input class='bg_button button' type="button" value="Choose category background" />
								</td>
								<?php 
									if ($i == 0) {
										echo "<td class='table_icon open'><img src='" . get_template_directory_uri() . "/images/arrow_right.png'></td>";
									}
								?>
							</tr>

						<?php
						}

							
					}

				?>


				</table>

				<br>

					<p>
						
					</p>
				<?php submit_button(); ?>

			</form>
		</div> <!-- end table container -->

		<div class='help_container'>

			<div class='popup_help handle_skins'>
				Choose one of the predefined skins.<br>
				<br>
				Clicking a skin will change the appearance properties to fit that particular skin. <br>
				You can still change the individual properties if you wish to put your own spin on a given skin.<br>
				<br>
				Remember to hit the save button for the changes to take effect.<br>
			</div>

			<div class='popup_help handle_header_style'>
				Here you can change the individual properties that define the appearance.<br>
				<br>
				Layour style:<br>
				<b>boxed</b>: header and menu are contained within a boxed layout.<br>
				<b>full width</b>: header and menu span the entire width of the page while the main content is displayed centered and boxed.<br>
				<br>
				Color settings note: Main color and Rating bar color usually looks best if they are kept the same. If you leave the Rating bar color empty<br>
				the Main color will be used automatically. If you however wish for the two colors to be different from each other you can define<br>
				individual colors for each.<br>
			</div>

			<div class='popup_help handle_shadow_box'>
				Show shadows around container boxes (header, nav-bar, main content and footer).
			</div>

			<div class='popup_help handle_bg_img'>
				Choose your background.<br>
				<br>
				You can either choose a pattern or you can upload your own custom background image. <br>
				If a custom background image is uploaded the default pattern/image will not be used. <br>
				To use one of the predefined patterns / images simply leave the URL text field empty.<br>
				<br>
				Notice: Some of the background patterns are semi-transparent and will show better on a light background (body background color).<br>
			</div>

			<div class='popup_help handle_cat_bg'>
				You can choose a different background image for each category.<br>
				<br>
				The category background image will be displayed on single posts with the given category and also on the category archive page.<br>
			</div>

		</div>
		
		</div>
		
	</div>

