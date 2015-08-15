	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>

		<h2>MEGAMAG - Post Settings</h2>

		<?php 
			//delete_option('megamag_options_post');
			//var_dump($megamag_options_post);
			$megamag_options_post = get_option('megamag_options_post'); 
			//var_dump($megamag_options_post);


			//determine oauth stage
			$oauth_stage = 1;
			if (empty($megamag_options_post['oauth_consumer_key']) || empty($megamag_options_post['oauth_consumer_secret'])) {
				$oauth_stage = 1;
			} elseif (empty($megamag_options_post['request_token'])) {
				$oauth_stage = 2;
			} elseif (empty($megamag_options_post['oauth_access_token']['oauth_token'])) {
				$oauth_stage = 3;	
			} else {
				$oauth_stage = 4;	
			}

			$current_url = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'];


			if ($oauth_stage === 2) {
				delete_transient('twitter_count');
			    $twitteroauth = new TwitterOAuth($megamag_options_post['oauth_consumer_key'], $megamag_options_post['oauth_consumer_secret']);
			    $request_token = $twitteroauth->getRequestToken($current_url);
		        $megamag_options_post['request_token'] = $request_token;
		        update_option('megamag_options_post', $megamag_options_post);
			    //var_dump($request_token);

			    if($twitteroauth->http_code==200){
			        $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
					if (headers_sent()){
						die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
				    }else{
				        header('Location: '. $url);
				    	die();
				    }    
			    } else {
			        echo "Twitter OAuth ERROR (2)!";
			    }

			}

			if ($oauth_stage === 3) {

			    //var_dump($megamag_options_post['request_token']['oauth_token']);

			    if(!empty($_GET['oauth_verifier']) && !empty($megamag_options_post['request_token']['oauth_token'])){
        			$twitteroauth = new TwitterOAuth($megamag_options_post['oauth_consumer_key'], $megamag_options_post['oauth_consumer_secret'], $megamag_options_post['request_token']['oauth_token'],$megamag_options_post['request_token']['oauth_token_secret']);
			        $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			        //var_dump($access_token);
			        // Save it
			        $megamag_options_post['oauth_access_token'] = $access_token;
			        update_option('megamag_options_post', $megamag_options_post);
			        // Let's get the user's info
			        $user_info = $twitteroauth->get('account/verify_credentials');
			        // Print user's info
			        //var_dump($user_info);
			    } else {
			        echo "Twitter OAuth ERROR (3)!";
			    }

					
			}

		    if ($oauth_stage === 4) {
		    	//var_dump($megamag_options_post['oauth_access_token']);
		    }

		?>

		<script>var templateDirectory = "<?php echo get_template_directory_uri(); ?>";</script>

		<br>
		
		<div class="options_wrapper">
		
		<div class="table_container">
			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields('group_megamag_options_post'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
				<?php do_settings_sections('handle_megamag_submenu_post'); ?>		

				<?php submit_button(); ?>

				<h3>Post</h3>

				<table class='form-table'>

						<input type="hidden" id="default_check" name="megamag_options_post[default_check]" value="checked">

					<tr valign='top' class='handle_show_featured'>
						<th scope='row'>Show featured image</th>
						<td class='table_input'>
							<input class="checkbox" type="checkbox" id="show_featured" name="megamag_options_post[show_featured]" value="checked" <?php checked(isset($megamag_options_post['show_featured'])) ?>/> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show author info</th>
						<td>
							<input class="checkbox" type="checkbox" id="show_author_info" name="megamag_options_post[show_author_info]" value="checked" <?php checked(isset($megamag_options_post['show_author_info'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show tags</th>
						<td>
							<input class="checkbox" type="checkbox" id="show_tags" name="megamag_options_post[show_tags]" value="checked" <?php checked(isset($megamag_options_post['show_tags'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show related posts</th>
						<td>
							<input class="checkbox" type="checkbox" id="show_related" name="megamag_options_post[show_related]" value="checked" <?php checked(isset($megamag_options_post['show_related'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show comments</th>
						<td>
							<input class="checkbox" type="checkbox" id="show_comments" name="megamag_options_post[show_comments]" value="checked" <?php checked(isset($megamag_options_post['show_comments'])) ?>/> 
						</td>
					</tr>


				</table>

				<br>

				<h3>Share</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_share_fb'>
						<th scope='row'>Show facebook like button</th>
						<td class='table_input'>
							<input class="checkbox" type="checkbox" id="share_fb" name="megamag_options_post[share_fb]" value="checked" <?php checked(isset($megamag_options_post['share_fb'])) ?>/> 
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show tweet button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_twitter" name="megamag_options_post[share_twitter]" value="checked" <?php checked(isset($megamag_options_post['share_twitter'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show digg button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_digg" name="megamag_options_post[share_digg]" value="checked" <?php checked(isset($megamag_options_post['share_digg'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show pin it button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_pin" name="megamag_options_post[share_pin]" value="checked" <?php checked(isset($megamag_options_post['share_pin'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show google button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_google" name="megamag_options_post[share_google]" value="checked" <?php checked(isset($megamag_options_post['share_google'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show reddit button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_reddit" name="megamag_options_post[share_reddit]" value="checked" <?php checked(isset($megamag_options_post['share_reddit'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show tumblr button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_tumblr" name="megamag_options_post[share_tumblr]" value="checked" <?php checked(isset($megamag_options_post['share_tumblr'])) ?>/> 
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>Show stumble upon button</th>
						<td>
							<input class="checkbox" type="checkbox" id="share_stumble" name="megamag_options_post[share_stumble]" value="checked" <?php checked(isset($megamag_options_post['share_stumble'])) ?>/> 
						</td>
					</tr>


				</table>

				<br>

				<h3>Twitter OAuth</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_oauth_consumer_key'>
						<th scope='row'>Consumer Key</th>
						<td class='table_input'>
							<input class="widefat" type='text' id='oauth_consumer_key' name='megamag_options_post[oauth_consumer_key]' value='<?php if (isset($megamag_options_post['oauth_consumer_key'])) echo $megamag_options_post['oauth_consumer_key']; ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri(); ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_main_fb_page'>
						<th scope='row'>Consumer Secret</th>
						<td>
							<input class="widefat" type='text' id='oauth_consumer_secret' name='megamag_options_post[oauth_consumer_secret]' value='<?php if (isset($megamag_options_post['oauth_consumer_secret'])) echo $megamag_options_post['oauth_consumer_secret']; ?>'>
						</td>
					</tr>

					<tr>
						<th></th>
						<td>
							<?php 

								if ($oauth_stage === 1) {
									echo "<a href='https://dev.twitter.com/' target='_blank'>Click here to register your site as a Twitter app</a>";
								} elseif ($oauth_stage === 2) {
									echo "Put in your OAuth Consumer Key and Secret - NB: You will be taken to Twitter to authorize access.";
								} elseif ($oauth_stage > 2) {
									echo "<i>Your homepage has been authorized to access your Twitter account. <br>
											Reset settings to unauthorize.</i>";
								}

							?>

						</td>
					</tr>

				</table>

				<br>


				<h3>Reviews</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_review_min'>
						<th scope='row'>Minimum rating</th>
						<td class='table_input'>
							<input type='text' id='review_min' name='megamag_options_post[review_min]' value='<?php if (isset($megamag_options_post['review_min'])) echo ($megamag_options_post['review_min']); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_review_max'>
						<th scope='row'>Maximum rating</th>
						<td>
							<input type='text' id='review_max' name='megamag_options_post[review_max]' value='<?php if (isset($megamag_options_post['review_max'])) echo ($megamag_options_post['review_max']); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top' class='handle_review_increments'>
						<th scope='row'>Rating increments</th>
						<td>
							<input type='text' id='review_increments' name='megamag_options_post[review_increments]' value='<?php if (isset($megamag_options_post['review_increments'])) echo ($megamag_options_post['review_increments']); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

				</table>

				<br>

				<h3>Rating labels</h3>

				<table class='form-table'>

					<tr valign='top' class='handle_review_label_100'>
						<th scope='row'>100% (Top rating)</th>
						<td class='table_input'>
							<input type='text' id='review_label_100' name='megamag_options_post[review_label_100]' value='<?php if (!empty($megamag_options_post["review_label_100"])) echo ($megamag_options_post["review_label_100"]); ?>'>
						</td>
						<td class='table_icon open'><img src='<?php echo get_template_directory_uri() ?>/images/arrow_right.png'></td>
					</tr>

					<tr valign='top'>
						<th scope='row'>90%</th>
						<td>
							<input type='text' id='review_label_90' name='megamag_options_post[review_label_90]' value='<?php if (isset($megamag_options_post['review_label_90'])) echo ($megamag_options_post['review_label_90']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>80%</th>
						<td>
							<input type='text' id='review_label_80' name='megamag_options_post[review_label_80]' value='<?php if (isset($megamag_options_post['review_label_80'])) echo ($megamag_options_post['review_label_80']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>70%</th>
						<td>
							<input type='text' id='review_label_70' name='megamag_options_post[review_label_70]' value='<?php if (isset($megamag_options_post['review_label_70'])) echo ($megamag_options_post['review_label_70']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>60%</th>
						<td>
							<input type='text' id='review_label_60' name='megamag_options_post[review_label_60]' value='<?php if (isset($megamag_options_post['review_label_60'])) echo ($megamag_options_post['review_label_60']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>50% (Average)</th>
						<td>
							<input type='text' id='review_label_50' name='megamag_options_post[review_label_50]' value='<?php if (isset($megamag_options_post['review_label_50'])) echo ($megamag_options_post['review_label_50']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>40%</th>
						<td>
							<input type='text' id='review_label_40' name='megamag_options_post[review_label_40]' value='<?php if (isset($megamag_options_post['review_label_40'])) echo ($megamag_options_post['review_label_40']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>30%</th>
						<td>
							<input type='text' id='review_label_30' name='megamag_options_post[review_label_30]' value='<?php if (isset($megamag_options_post['review_label_30'])) echo ($megamag_options_post['review_label_30']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>20%</th>
						<td>
							<input type='text' id='review_label_20' name='megamag_options_post[review_label_20]' value='<?php if (isset($megamag_options_post['review_label_20'])) echo ($megamag_options_post['review_label_20']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>10%</th>
						<td>
							<input type='text' id='review_label_10' name='megamag_options_post[review_label_10]' value='<?php if (isset($megamag_options_post['review_label_10'])) echo ($megamag_options_post['review_label_10']); ?>'>
						</td>
					</tr>

					<tr valign='top'>
						<th scope='row'>0% (Bottom rating)</th>
						<td>
							<input type='text' id='review_label_0' name='megamag_options_post[review_label_0]' value='<?php if (isset($megamag_options_post['review_label_0'])) echo ($megamag_options_post['review_label_0']); ?>'>
						</td>
					</tr>

				</table>

				<br>


				<?php submit_button(); ?>

			</form>
		</div> <!-- end table_container -->

		<div class='help_container'>

			<div class='popup_help handle_show_featured'>
				These settings decide what components your post will have.<br>
				<br>
				<b>Show featured image</b>: if you have selected a featured image for your post this will be shown at the top of your post.<br>
				<br>
				<b>Show author info</b>: information about the author of the post. You can fill out bio info on each author by going to: <br>
				Users > the user/author > about yourself > biographical info.<br>
				<br>
				<b>Show tags</b>: display the tags related to the post if any are available.<br>
				<br>
				<b>Show related posts</b>: Show suggestions for further reading by listing related posts. <br>
				The related posts come from the same category as the post. If there are not enough related posts, random posts will be shown in the remaining slots.<br>
				<br>
				<b>Show comments</b>: whether to the post comments. Notice that other comment settings are available at <br>
				(Wordpress general) Settings > discussion.<br>

			</div>

			<div class='popup_help handle_share_fb'>
				Choose your share buttons. These will be displayed in a share box on your post page.<br>
				<br>
				If none are chosen the share box will not be shown. <br>

			</div>

			<div class='popup_help handle_oauth_consumer_key'>
				Register your site as a Twitter App.<br>
				<br>
				- Click the link. This will take you to the Twitter Dev homepage. <br>
				- Sign in to your Twitter account.<br>
				- Click icon > My applications > Create new application.<br>
				- Fill out the Create new application form:<br>
				<br>
				Name: e.g. My Homepage<br>
				Description: e.g. My homepage<br>
				Website: e.g. http://yoursite.com.<br>
				Pingback URL: e.g http://yoursite.com.<br>
				<br>
				Fill out the CAPTCHA <br>
				Click the Create your twitter application button.<br>
				<br>
				- Once created you will be taken to a new page.<br>
				- Copy Consumer key and secret to the theme backend and press Save Changes.<br>
				<br>
				- When you click Save Changes you will be taken to Twitter.com where you will need to Authorize your homepage app.<br>
				<br>
				- Click the Authorize App button and you will be taken back to your homepage.<br>
				- You have now successfully authorized your homepage to access your Twitter account.<br>

			</div>

			<div class='popup_help handle_review_min'>
				Choose the minimum possible score. Recommended: 1
			</div>

			<div class='popup_help handle_review_max'>
				Choose the maximum possible score.
			</div>

			<div class='popup_help handle_review_increments'>
				Choose the increments of your ratings scale.<br>
				<br>
				E.g: If your minimum score is 1 and your maximum score is 10:<br>
				If you choose increments of 1 then you rating scale will have the following values: 1, 2, 3, 4, 5 etc.<br>
				If you choose increments of 0,5 then your rating scale will have the following values: 1, 1.5, 2, 2.5, 3, 3.5, 4 etc.<br>
				if you choose increments of 0,1 then your rating scale will have the following values: 1, 1.1, 1.2, 1.3, 1.4 etc<br>
			</div>

			<div class='popup_help handle_review_label_100'>
				You can choose to attach a word to your overall score. This will be displayed in the review box on your review posts as a one-word verdict.<br>
				<br>
				You can have 11 different words attached to your rating scale.<br>
				You don't have to fill out all 11 words.<br>
				Your overall score will display the word associated with the nearest lowest step on the scale.<br>
				<br>
				E.g. using the default settings:<br>
				A score of 40% on your custom scale (e.g. 4/10) will display the verdict: average.<br>
				A score of 58% on your custom scale (e.g. 5.8/10) will display the verdict: average.<br>
				A score of 60% on your custom scale (e.g. 6/10) will display the verdict: good.<br>
				<br>
				Notice that each step is a percentage step. This is to accommodate many different rating scales.<br>
				E.g. 60% is equal to:<br>
				the score of 6 on a 10 scale.<br>
				the score of 60 on a 100 scale.<br>
				the score of 3 on a 5 scale.<br>

			</div>

		</div>
		</div>
	</div>

