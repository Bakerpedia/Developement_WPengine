<?php  /* Template Name: temp2Conversion */ ?>
<style>
.frms{margin:0 auto;padding:10px;border:1px solid #ddd;border-radius:.3em;-moz-border-radius:.3em;
-webkit-border-radius:.3em;-o-border-radius:.3em;font-family:Tahoma,Geneva,sans-serif;color:#333;font-size:.9em;
line-height:1.2em;
height: 60%;width:100%;
}
.frms input[type=text],[type=file],[type=password],select,textarea{width:99%;background:#fff;border:1px solid #ddd;border-radius:.35em;-moz-border-radius:.35em;-webkit-border-radius:.35em;-o-border-radius:.35em;padding:0 .5%;margin-top:5px;margin-bottom:15px;height:35px}

.frms input:hover,select:hover,textarea:hover{box-shadow:#dae1e5 0 0 5px;-moz-box-shadow:#dae1e5 0 0 5px;-webkit-box-shadow:#dae1e5 0 0 5px;-o-box-shadow:#dae1e5 0 0 5px}
.frms input:focus,select:focus,textarea:focus{-webkit-box-shadow:inset 7px 4px 7px -7px rgba(0,0,0,.42);-moz-box-shadow:inset 7px 4px 7px -7px rgba(0,0,0,.42);box-shadow:inset 7px 4px 7px -7px rgba(0,0,0,.42);border:1px solid #9d9983}
.frms input[type=file]{width:99.6%;padding:2px .2%}

.blue_button,.frms input[type=submit],.yellow_button,button,input[type=button],input[type=reset]{padding:7px 14px;font-weight:700;color:#fff;cursor:pointer;border-radius:.3em;-moz-border-radius:.2em;-webkit-border-radius:.2em;-o-border-radius:.2em;margin:10px 0;border:none}

.frms input[type=submit]{background:#75ab22;border-bottom:#629826 3px solid;text-shadow:#396e12 1px 1px 0}
.frms input[type=reset]{background:#ee765d;border-bottom:#d95e44 3px solid;text-shadow:#8c3736 1px 1px 0}
.blue_button,button,input[type=button]{background:#468cd2;border-bottom:#3277bc 3px solid;text-shadow:#214d73 1px 1px 0}
.input_text_class{width:99%;background:#fff;border:1px solid #ddd;border-radius:.35em;-moz-border-radius:.35em;-webkit-border-radius:.35em;-o-border-radius:.35em;padding:0 .5%;margin-top:5px;margin-bottom:15px;height:35px}
.frms select{width:100%;padding:5px .5%}
.frms textarea{min-height:200px;font-family:Tahoma,Geneva,sans-serif;font-size:1.31em;padding:5px .5%;line-height:18px}
.frms label{font-size:1.3em}
.resp_code{
	margin:5px 10px 10px;
	padding:10px 20px;
	font:400 1em/1.3em Tahoma,Geneva,sans-serif;
	color:#333;background:#f8f8f8;border:1px solid #ddd;border-radius:.25em;overflow:auto
}
.resp_code_scripts{margin:10px;padding:20px;background:#f8f8f8;border:1px solid #ddd;border-radius:.25em;overflow:scroll;height:250px}
.noborders{border:none!important}
.f_right{float:right}
.input_text_class{width:99%;background:#fff;border:1px solid #ddd;border-radius:.35em;-moz-border-radius:.35em;-webkit-border-radius:.35em;-o-border-radius:.35em;padding:0 .5%;margin-top:5px;margin-bottom:15px;height:35px}
</style>

<?php get_header(); ?>

<?php $megamag_options_post = get_option('megamag_options_post') ?>
		
		<div id="main" class="container">
		
			<div id="content" >
			<!-- get featured bread post -->
			
			<?php
			global $more;
			$more = 0;
			query_posts('cat=27'); 
				if(have_posts()) : while(have_posts()) : the_post();
			?>
			
			
			<div class="blog-item" id="column1-wrap">	
				<div class="archive-text" style="padding-bottom:5px;" >
					<a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_post_thumbnail($page->ID, 'medium'); ?>
					</a>
				</div>
			</div>
				<div id="column2" class="blog-item">
				
				
				
				<p><br><a href="<?php the_permalink(); ?>" class="readmore">Read More</a></p>
				</div>
			<?php		
			endwhile;
			endif;
			wp_reset_query();
			?>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="post">

				<?php 

					if (isset($megamag_options_post['show_featured'])) {
						$thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
						if (get_the_post_thumbnail() != NULL) { 
							?>
							<img src="<?php printf($thumbnail_url[0]); ?>" width=610>
						<?php
						}
					}
				?>

					<h1 class="post-heading page"><?php the_title(); ?></h1>
					
					<div class="post-content">
						
					<?php /*?>	<?php the_content(); ?><?php */?>
						
						
					</div>
					
					
				</div>
				<!-- END POST -->

				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lcz_megamag'); ?></p>
				<?php endif; ?>	<!-- main post loop -->
					<div class="resp_code" align="left">	
						<div align="center">
							<b>Enter the degree in the Textbox and select an option from combobox <br> 
							Then calculate the temperature from fahrenheit to celsius and vice versa.</b>
							<br><br> 
							<form name="frm" action="" class="frms noborders"> 
							<table style="width:80%">
								<tbody>
								<tr>
									<td style="vertical-align: top;">Enter the degree </td>
									<td>
										<input type="text" name="txt" class="input_text_class"> 
										<select name="myoption"> 
											<option value="Fahrenheit">F</option> 
											<option value="Celsius">C</option> 
										</select> 
									</td>
								</tr>
								<tr><td></td>
								
								</tr>
								<tr>
									<td style="vertical-align: top;">Equal Value </td>
									<td><input type="text" name="txt1" class="input_text_class" readonly></td>
								</tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
                                </tr>		
									<td>&nbsp;</td>								
									<td align="right"><input type="button" class="f_right" onclick="apply()" value="Calculate"></td>
                                </tr>
							</tbody>
							</table> 
							</form> 
						</div> 		
					</div>	       
			
			</div>
			<!-- END CONTENT -->


		
<?php get_sidebar(); ?>		
<?php get_footer(); ?>	

<script type="text/javascript"> function apply() {
	var a=frm.myoption.value;
	if(a=="Fahrenheit")
	{
	var val=frm.txt.value;
	var tf=parseInt(val);
	var tc=(5/9)*(tf-32);
	var res=Math.round(tc*Math.pow(10,2))/Math.pow(10,2);
	frm.txt1.value=res+" C";
	}
	else
	{
	var val=frm.txt.value;
	var tc=parseInt(val);
	var tf=((9/5)*tc)+32;
	var res1=Math.round(tf*Math.pow(10,2))/Math.pow(10,2);
	frm.txt1.value=res1+" F";
	}
	}
</script>
<script type="text/javascript"> function apply() {
	var a=frm.myoption.value;
	if(a=="Fahrenheit")
	{
	var val=frm.txt.value;
	var tf=parseInt(val);
	var tc=(5/9)*(tf-32);
	var res=Math.round(tc*Math.pow(10,2))/Math.pow(10,2);
	frm.txt1.value=res+" C";
	}
	else
	{
	var val=frm.txt.value;
	var tc=parseInt(val);
	var tf=((9/5)*tc)+32;
	var res1=Math.round(tf*Math.pow(10,2))/Math.pow(10,2);
	frm.txt1.value=res1+" F";
	}
	}
</script> 

	



									
				

