		
			<div id="sidebar">
			
				<a class="btnRequest" href="http://bakerpedia.com/ask-topic/">Ask for a topic</a>
				<div id=buttonpadding1></div>
				
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar Widget Area") ) : ?>  
		        <?php endif; ?>  
										
			<div id="colRightTopic">
			
			<?php
			if ( is_front_page() ) 
			{
				$recentposts=get_posts('showposts=5');
					if ($recentposts) 
					{
					echo "<div class='widget'>";
					echo "<h1>Latest Posts</h1>";	
						foreach($recentposts as $post) 
						{
							setup_postdata($post);
			?>					
				<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php
						}
					}
			}
			?>
			</div>
			<?php
		
			if (  !is_front_page() ) {
				$key = "related_topics";
				$thumb = get_post_meta(get_the_ID(), $key, true);
				$topiccount = count($thumb);
				if ($thumb)
				{
					$closeneed = true;
					$counter = 0;
					echo "<div class='widget'>";
					echo "<h1>Related Topics</h1>";				
					
					for($i=0;$i<$topiccount;$i++)
					{
						$postID = get_page_by_title($thumb[$i],'OBJECT','post');
						if(!in_category('company',$postID) && !is_null($postID))
						{
							$base = site_url() . "/";
							// upper case the first letter in each string
							$thumb[$i] = ucwords($thumb[$i]);
							$thumb[$i] = ucwords(strtolower($thumb[$i]));
							$thistopic = $base . str_replace(" ", "_",$thumb[$i]);							
							$topiclink = "<li><a title='Click me to navigate to related topic' href='" . $thistopic. "'>" . $thumb[$i] . "</a></li>";														
							echo $topiclink;												
						}
						if(in_category('company',$postID))
						{
							$base = site_url() . "/";
							// upper case the first letter in each string
							$thumb[$i] = ucwords($thumb[$i]);
							$thumb[$i] = ucwords(strtolower($thumb[$i]));
							$temp = str_replace(".", "",$thumb[$i]);
							$thistopic = $base . str_replace(" ", "_",$temp);							
							$topiclink = "<li><a title='Click me to navigate to related topic' href='" . $thistopic. "'>" . $thumb[$i] . "</a></li>";
							$companylist = $topiclink;
							$counter++;
						}
					}							
				}	
				$key2 = "related_topics";
				$thumbTest = get_post_meta(get_the_ID(), $key2, true);
				if(empty($thumbTest)) {				
					echo "<div class='widget'>";
					echo "<h1>Related Topics</h1>";					
				}	
				
				$values = get_field('topic_related_topics'); 				
				if($values)
				{									 
					foreach($values as $value)					
					{
						$base = site_url() . "/";
						$temp = str_replace($base, " ", $value);
						$thistopic = str_replace("_", " ",$temp);	
						$thistopic = str_replace("/", " ",$thistopic);								
						// upper case the first letter in each string
						$thistopic = ucwords($thistopic);
													
						echo "<li><a title='Click me to navigate to related topic' href='" . $value . "'>" . $thistopic . "</a></li>";							
					}				 
				}
				
				$key3 = "related_links";
				$thumbfunny = get_post_meta(get_the_ID(), $key3, true);
				$topiccount = count($thumbfunny);
				if ($thumbfunny)
				{
					echo "</br>";
					echo "<div class='widget'>";
					echo "<h1>Resources</h1>";
					
					for($i=0;$i<$topiccount;$i++)
					{
						$thumb = $thumbfunny[$i];
						$topiclink = "<li><a title='Click me to navigate to resource' target='_blank' href='" . $thumb[0] . "'>" . $thumb[1] . "</a></li>";
						echo $topiclink;
					}
					echo "</div>";
				}			
						
				$key = "topic_related_links";
				$thumb = get_post_meta(get_the_ID(), $key, true);
				$relatedtopiccount = count($thumb);
				if ($thumb)
				{
					echo "<h1 class=test>Related Links</h1>";
					
					for($i=0;$i<$relatedtopiccount;$i++)
					{
										
						$topiclink = "<div class='relatedTopics'>" . $thumb;
						echo $topiclink;						
					}
					echo "</div>";
				}
						
			wp_reset_postdata();				
			}
			?>		

			</div>
		</div>
			<!-- END SIDEBAR -->