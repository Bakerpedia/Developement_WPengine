	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>

		<h2>MEGAMAG - Homepage Settings</h2>

		<?php 
			//delete_option('megamag_options_hp');
			$megamag_options_hp = get_option('megamag_options_hp'); 
			//var_dump($megamag_options_hp);

			require 'functions_slider_sort.php';

		?>

		<script>
			var templateDirectory = "<?php echo get_template_directory_uri(); ?>";
		</script>

		<br>
		
		<div class="options_wrapper">
		
		<div class="table_container">

			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('group_megamag_options_hp'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
				<?php do_settings_sections('handle_megamag_submenu_homepage'); ?>		

				<?php submit_button(); ?>

				<h3>Style</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_hp_style'>
						<th scope='row'>Homepage Style</th>
						<td class='table_input'>
							<select id="hp_style" name="megamag_options_hp[hp_style]"> 
			     			<option value="magazine" <?php if (isset($megamag_options_hp['hp_style'])) {if ($megamag_options_hp['hp_style'] == "magazine") echo "selected='selected'";} ?>>Magazine</option> 
			     			<option value="blog" <?php if (isset($megamag_options_hp['hp_style'])) {if ($megamag_options_hp['hp_style'] == "blog") echo "selected='selected'";} ?>>Blog</option> 
							</select> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>


				</table>

				<br>

				</table>

				<br>

				<h3>Slider options</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_slider_show'>
						<th scope='row'>Show Slider</th>
						<td class='table_input'>
							<input class="checkbox" type="checkbox" id="slider_show" name="megamag_options_hp[slider_show]" value="checked" <?php checked(isset($megamag_options_hp['slider_show'])) ?>/> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_slider_style'>
						<th scope='row'>Slider style</th>
						<td>
							<select id="slider_style" name="megamag_options_hp[slider_style]"> 
			     			<option value="fullwidth1" <?php if (isset($megamag_options_hp['slider_style'])) {if ($megamag_options_hp['slider_style'] == "fullwidth1") echo "selected='selected'";} ?>>Full width (style 1)</option> 
			     			<option value="fullwidth2" <?php if (isset($megamag_options_hp['slider_style'])) {if ($megamag_options_hp['slider_style'] == "fullwidth2") echo "selected='selected'";} ?>>Full width (style 2)</option> 
			     			<option value="compact" <?php if (isset($megamag_options_hp['slider_style'])) {if ($megamag_options_hp['slider_style'] == "compact") echo "selected='selected'";} ?>>Compact</option> 
							</select> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_slider_fx'>
						<th scope='row'>Transition effect</th>
						<td>
							<select id="slider_fx" name="megamag_options_hp[slider_fx]"> 
			     			<option value="sliceDown" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceDown") echo "selected='selected'";} ?>>sliceDown</option> 
			     			<option value="sliceDownLeft" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceDownLeft") echo "selected='selected'";} ?>>sliceDownLeft</option> 
			     			<option value="sliceUp" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceUp") echo "selected='selected'";} ?>>sliceUp</option> 
			     			<option value="sliceUpLeft" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceUpLeft") echo "selected='selected'";} ?>>sliceUpLeft</option> 
			     			<option value="sliceUpDown" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceUpDown") echo "selected='selected'";} ?>>sliceUpDown</option> 
			     			<option value="sliceUpDownLeft" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "sliceUpDownLeft") echo "selected='selected'";} ?>>sliceUpDownLeft</option> 
			     			<option value="fold" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "fold") echo "selected='selected'";} ?>>fold</option> 
			     			<option value="fade" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "fade") echo "selected='selected'";} ?>>fade</option> 
			     			<option value="random" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "random") echo "selected='selected'";} ?>>random</option> 
			     			<option value="slideInRight" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "slideInRight") echo "selected='selected'";} ?>>slideInRight</option> 
			     			<option value="slideInLeft" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "slideInLeft") echo "selected='selected'";} ?>>slideInLeft</option> 
			     			<option value="boxRandom" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "boxRandom") echo "selected='selected'";} ?>>boxRandom</option> 
			     			<option value="boxRain" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "boxRain") echo "selected='selected'";} ?>>boxRain</option> 
			     			<option value="boxRainReverse" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "boxRainReverse") echo "selected='selected'";} ?>>boxRainReverse</option> 
			     			<option value="boxRainGrow" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "boxRainGrow") echo "selected='selected'";} ?>>boxRainGrow</option> 
			     			<option value="boxRainGrowReverse" <?php if (isset($megamag_options_hp['slider_fx'])) {if ($megamag_options_hp['slider_fx'] == "boxRainGrowReverse") echo "selected='selected'";} ?>>boxRainGrowReverse</option> 
							</select> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_slider_anim_speed'>
						<th scope='row'>Animation speed <i>(ms)</i></th>
						<td>
							<input type='text' id='slider_anim_speed' name='megamag_options_hp[slider_anim_speed]' value='<?php if (isset($megamag_options_hp['slider_anim_speed'])) echo ($megamag_options_hp['slider_anim_speed']); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_slider_pause_time'>
						<th scope='row'>Show each slide for <i>(ms)</i></th>
						<td>
							<input type='text' id='slider_pause_time' name='megamag_options_hp[slider_pause_time]' value='<?php if (isset($megamag_options_hp['slider_pause_time'])) echo ($megamag_options_hp['slider_pause_time']); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

				</table>
				
				<input type='hidden' id='slider_order' name='megamag_options_hp[slider_order]' value='<?php if (isset($megamag_options_hp['slider_order'])) echo ($megamag_options_hp['slider_order']); ?>'>
				
				<br><br>



				<?php 
					if (empty($results_slider_posts)) {
					?>
						<h3><i>No posts added to slider</i></h3>
						<br>

						<table class='form-table'>
							<tr valign='top' class='handle_slider_sort'>
								<td width='769px'>
									To add posts to your slider go to Posts > My Post. <br>
									In the MegaMag Post Settings box check the checkbox "Feature this post in slider?"
								</td>
								<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
							<tr>
						</table>

						<br>
					<?php
					} else {
					?>
						<h3>Slider order</h3>
						<br>

						<table class='form-table'>
							<tr valign='top' class='handle_slider_sort'>
								<td width='769px'>
									Drag and drop to change order. Remember to save changes.
								</td>
								<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
							<tr>
						</table>

						<br>
					<?php
					}
				?>


				<ul id='slider_items_list'>
					<?php 

						for ($i = 0; $i < count($results_slider_posts); $i++) {
							$current_id = $order_array[$i];  
							//get the array key for the object from $results_slider_posts where ID is = $current_id
							for ($n = 0; $n < count($results_slider_posts); $n++) { 
								if ($results_slider_posts[$n]->ID == $current_id) {
									$current_key = $n;
									break;	
								}
							}
							$nonce = wp_create_nonce("del_slider_item_nonce");


						?>
							<li id='<?php echo $current_id; ?>'>
								<?php
									if (has_post_thumbnail($current_id)) { 
										echo get_the_post_thumbnail($current_id,'slider_sort');
									} else { ?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/slider-thumb.jpg" alt="" />
									<?php
									}
								?>

								<?php echo $results_slider_posts[$current_key]->post_title; ?>
								<img src="<?php echo get_template_directory_uri(); ?>/images/admin/sort-icon.png" class="sort" alt="" />
								<button type="button" class='del_item button' data-item_id='<?php echo $current_id; ?>' data-nonce='<?php echo $nonce; ?>'>delete</button>
							</li>
						<?php
						}

					?>
					
					<!-- NEW SLIDER POSTS LAYOUT -->

				</ul>

				<br><br>


				<?php submit_button(); ?>

			</form>

		</div> <!-- end table container -->

		<div class="help_container">

			<div class='popup_help handle_hp_style'>
				You can choose between two styles of homepage: <br>
				<br>
				<i>Magazine style:</i> posts are displayed in different categories on the front page. Use widgets to customize layout.<br>
				<i>Blog style:</i> posts are displayed chronologically with newest posts first. <br>
			</div>

			<div class='popup_help handle_slider_show'>
				Choose whether to show the slider on the front page. <br>
			</div>

			<div class='popup_help handle_slider_style'>
				Choose the slider style: <br>
				<br>
				Full width (style 1): Full width slider with floating caption box.<br>
				Full width (style 2): Full width slider with fixed right side caption box.<br>
				Compact: Compact slider with thumbnail navigation. <br>
			</div>

			<div class='popup_help handle_slider_fx'>
				Choose which one of the transition effects to use when the slider changes from one picture to the next. Random by default.
			</div>

			<div class='popup_help handle_slider_anim_speed'>
				Speed of the transition effect. In milliseconds (ms). Default is 500 ms (0.5 second).
			</div>

			<div class='popup_help handle_slider_pause_time'>
				How long to display one picture before sliding to the next. Default is 3000 ms (3 seconds).
			</div>

			<div class='popup_help handle_slider_sort'>
				Drag and drop to decide the order of the posts that are shown in the slider. The top one is shown first.<br>
				<br>
				If you click the delete button next to a post it will be removed from the slider, but it will not be deleted from the database. <br>
				To select a post for use in the slider go to Posts > My post > Megamag post settings > Feature this post in slider. <br>
				<br>
				NB: Only the top 5 posts will be used in the slider. <br>
			</div>

		</div> <!-- end help_container -->
		
		</div>

	</div>

