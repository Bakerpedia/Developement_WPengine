					<a name="comments"></a>
					<div class="comments">

						
						<?php 
							echo "<h1>";
							comments_number(__('No comments','lcz_megamag'), __('1 Comment','lcz_megamag'), '% ' . __('Comments','lcz_megamag') );
							echo "</h1>";


							wp_list_comments(array(
								'avatar_size' 	=> '60',
								'style'			=> 'ul',
								'callback'		=> 'megamag_comment',
								'type'			=> 'all'
							));

						?>

						<div id='comments_pagination'>
							<?php paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;')); ?>  
						</div>

						<?php 

							$custom_comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';  //label removed for cleaner layout

							comment_form(array(
								'comment_field' => $custom_comment_field,
								'comment_notes_after'=>'',
								'logged_in_as' => '',
								'comment_notes_before' => '',
							));
						 ?>

					</div> <!-- end comments div -->
					



						
						
