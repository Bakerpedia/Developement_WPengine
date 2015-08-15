<?php

/**************************************
CUSTOM META BOXES
***************************************/

	add_action('add_meta_boxes', 'register_cmb_megamag_post_settings');
	add_action ('save_post', 'update_cmb_megamag_post_settings');

	function register_cmb_megamag_post_settings () {
		add_meta_box('cmb_megamag_post_settings','MEGAMAG post settings', 'display_cmb_megamag_post_settings','post');
	}

	function display_cmb_megamag_post_settings ($post) {
		//get the post meta data
		$result_cmb_excerpt = get_post_meta($post->ID, 'cmb_excerpt', true);
		$result_cmb_retire_popular = get_post_meta($post->ID, 'cmb_retire_popular', true);
		
		$result_cmb_slider_feature = get_post_meta($post->ID, 'cmb_slider_feature', true);
		$result_cmb_slider_caption = get_post_meta($post->ID, 'cmb_slider_caption', true);
		$result_cmb_slider_caption_title = get_post_meta($post->ID, 'cmb_slider_caption_title', true);
		$result_cmb_hide_slider_caption_title = get_post_meta($post->ID, 'cmb_hide_slider_caption_title', true);
		$result_cmb_hide_slider_caption = get_post_meta($post->ID, 'cmb_hide_slider_caption', true);
		
		$result_cmb_is_review = get_post_meta($post->ID, 'cmb_is_review', true);
		$result_cmb_review_overall = get_post_meta($post->ID, 'cmb_review_overall', true);
		
		$megamag_options_post = get_option('megamag_options_post');
		
		$result_cmb_review_criteria = get_post_meta($post->ID, 'cmb_review_criteria',true);
		if (gettype($result_cmb_review_criteria) == 'array') $result_cmb_review_criteria = array_values($result_cmb_review_criteria);

		//var_dump($result_cmb_review_criteria);
		//$debug = get_post_meta($post->ID, 'debug', true);
		//var_dump($debug);
		//$debug = get_option('megamag_options_cmb');
		//var_dump($debug);

		?>

		<script>
			var sliderMin = <?php echo $megamag_options_post['review_min'] ?>;
			var sliderMax = <?php echo $megamag_options_post['review_max'] ?>;
			var sliderIncr= <?php echo $megamag_options_post['review_increments'] ?>;
		</script>

		<!-- GENERAL OPTIONS -->
		<div class="option_heading top">
			<span>General Post Options</span>
		</div>
		
		<div class="option_item">
			<label for='cmb_excerpt'>Excerpt</label><br>
			<textarea id='cmb_excerpt' name='cmb_excerpt' class='widefat'><?php if (!empty($result_cmb_excerpt)) echo $result_cmb_excerpt; ?></textarea>
			<span class="item_hint">(Leave empty for auto-excerpt)</span>
		</div>

		<!-- POPULAR OPTIONS -->
		<div class="option_heading top">
			<span>Popular Widget Option</span>
		</div>
		
		<div class="option_item">
			<input type='checkbox' id='cmb_retire_popular' name='cmb_retire_popular' value='checked' <?php checked(!empty($result_cmb_retire_popular)); ?> class="option_checkbox">
			<label for='cmb_retire_popular'>Do not display this post in popular post lists?</label>
		</div>

		<!-- SLIDER OPTIONS -->
		<div class="option_heading">
			<span>Slider Options</span>
		</div>

		<div class="option_item">
			<input type='checkbox' id='cmb_slider_feature' name='cmb_slider_feature' value='checked' <?php checked(!empty($result_cmb_slider_feature)); ?> class="option_checkbox">
			<label for='cmb_slider_feature'>Feature this post in slider?</label>
		</div>
		
		<div id='slider_options_popup'>
			<div class="option_item">
				<label for='cmb_slider_caption_title'>Slider caption title</label><br>
				<input class='widefat' type='text' id='cmb_slider_caption_title' name='cmb_slider_caption_title' value='<?php if (!empty($result_cmb_slider_caption_title)) {echo $result_cmb_slider_caption_title;} else {echo $post->post_title;} ?>'>
				<input type='checkbox' id='cmb_hide_slider_caption_title' name='cmb_hide_slider_caption_title' value='checked' <?php checked(!empty($result_cmb_hide_slider_caption_title)); ?> class="option_checkbox"> Hide caption title?
			</div>
			
			<div class="option_item">
				<label for='cmb_slider_caption'>Slider caption text</label><br>
				<textarea class='widefat' id='cmb_slider_caption' name='cmb_slider_caption'><?php if (!empty($result_cmb_slider_caption)) {echo $result_cmb_slider_caption;} else {echo mb_make_excerpt($post->post_content, 328,true);} ?></textarea>
				<input type='checkbox' id='cmb_hide_slider_caption' name='cmb_hide_slider_caption' value='checked' <?php checked(!empty($result_cmb_hide_slider_caption)); ?> class="option_checkbox"> Hide caption text?
			</div>
		</div>

		<!-- REVIEW OPTIONS -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />

		<div class="option_heading">
			<span>Review Options</span>
		</div>

		<div class="option_item">
			<input type='checkbox' id='cmb_is_review' name='cmb_is_review' value='checked' <?php checked(!empty($result_cmb_is_review)); ?>>
			<label for='cmb_is_review'>This post is a review.</label>
		</div>

		<div id='review_options_popup'>
		
			<div class="option_item">
				
				<span class='text overall'>Overall Score</span>
				<div class='rating_slider'></div>
				<input type='text' class='slider_value' name='cmb_review_overall' value='<?php if (!empty($result_cmb_review_overall)) {echo $result_cmb_review_overall;} else {echo 0;} ?>'>
				
			</div>

			<div id="review_criteria">
				<?php 
					for ($i = 0; $i < (count($result_cmb_review_criteria)); $i++) {
				?>
				
				<div class="option_item" id="<?php echo $i; ?>">
					
					<span class='text'>Criterion <?php echo ($i+1); ?></span>
					<input type='text' id='cmb_review_criteria[<?php echo $i; ?>][0]' name='cmb_review_criteria[<?php echo $i; ?>][0]' value='<?php if (!empty($result_cmb_review_criteria[$i][0])) echo $result_cmb_review_criteria[$i][0]; ?>' class='criteria_name'>
					<div class='rating_slider'></div>
					<input type='text' id='cmb_review_criteria[<?php echo $i; ?>][1]' name='cmb_review_criteria[<?php echo $i; ?>][1]' value='<?php if (!empty($result_cmb_review_criteria[$i][1])) {echo $result_cmb_review_criteria[$i][1];} else {echo 0;} ?>' class='slider_value'>
					<button name="button_del_criteria" type="button" class="button-secondary button_del_criteria">delete</button>
					
				</div>
				
				<?php 
					}
				?>


			</div>

			<div id="template_criterion">
				
				<div class="option_item" id="999">
					
					<span class='text'>Criterion 999</span>
					<input type='text' value='' class='criteria_name'>
					<div class='rating_slider'></div>
					<input type='text' value='0' class='slider_value'>
					<button name="button_del_criteria" type="button" class="button-secondary button_del_criteria">delete</button>
				</div>

			</div>

			<div class="option_item">
				
				<button type="button" name="submit_add_criteria" id='submit_add_criteria' value="add" class="button-secondary">add new criteria</button>
				<button type="submit" name="submit_load_template" id="submit_load_template" value="load" class="button-secondary">load template</button>
				<button type="submit" name="submit_save_template" id="submit_save_template" value="save" class="button-secondary">save as template</button>
				
			</div>


			<br>


		</div>	<!-- end review_options_pop -->



		<?php	
			// $cmb_criteria_del = get_post_meta($post->ID, 'cmb_criteria_del', true);		//array key of criteria to delete
			// $cmb_criteria_add = get_post_meta($post->ID, 'cmb_criteria_add', true);
			// var_dump($result_cmb_review_criteria);
			// var_dump($cmb_criteria_add);
			// var_dump($cmb_criteria_del);
	}

	function update_cmb_megamag_post_settings ($post_id) {
		// verify nonce.  

		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__))) {
			return false;
		}

		//regular update
		update_post_meta($post_id, 'cmb_excerpt', $_POST['cmb_excerpt']);
		update_post_meta($post_id, 'cmb_slider_feature', $_POST['cmb_slider_feature']);
		update_post_meta($post_id, 'cmb_retire_popular', $_POST['cmb_retire_popular']);
		update_post_meta($post_id, 'cmb_slider_caption', $_POST['cmb_slider_caption']);
		update_post_meta($post_id, 'cmb_slider_caption_title', $_POST['cmb_slider_caption_title']);
		update_post_meta($post_id, 'cmb_hide_slider_caption_title', $_POST['cmb_hide_slider_caption_title']);
		update_post_meta($post_id, 'cmb_hide_slider_caption', $_POST['cmb_hide_slider_caption']);
		update_post_meta($post_id, 'cmb_is_review', $_POST['cmb_is_review']);
		update_post_meta($post_id, 'cmb_review_overall', $_POST['cmb_review_overall']);
		update_post_meta($post_id, 'cmb_review_criteria', $_POST['cmb_review_criteria']);

		//if load template (important this is after cmb_review_criteria has been updated)
		if ($_POST['submit_load_template'] == 'load') {
			$cmb_template = get_option('megamag_options_cmb');
			if ($cmb_template == '' or $cmb_templage === false) {
				$cmb_template[0][0] = 'Gameplay'; $cmb_template[0][1] = 5;	
				$cmb_template[1][0] = 'Graphics'; $cmb_template[1][1] = 5;	
				$cmb_template[2][0] = 'Sound'; $cmb_template[2][1] = 5;	
				$cmb_template[3][0] = 'Story'; $cmb_template[3][1] = 5;	
			}
			update_post_meta($post_id, 'cmb_review_criteria', $cmb_template);
		}

		//if save as template
		if ($_POST['submit_save_template'] == 'save') {
			update_option('megamag_options_cmb', $_POST['cmb_review_criteria']);
		}
	}
