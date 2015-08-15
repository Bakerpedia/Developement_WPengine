<?php get_header(); ?>
<?php global $wpdb;
	$thispost = get_the_ID();
	$loop = $wpdb->get_results("SELECT * FROM wp_sam_ads");
	$loopindex = $wpdb->num_rows;
	$derptest = 0;
	foreach($loop as $thisloop){
		$thisview = explode(',',$thisloop->view_id);
		$length = count($thisview);
	if($length > 0){
		for($i=0;$i<=$length;$i++){
			if($thispost == $thisview[$i]){
				$derptest = 1;
			}
		}
	}
	}
	if($derptest == 1){
		drawAdsPlace(array('id' => 4), true);
	}else{
		drawAdsPlace(array('id' => 1), true);
	}
	?>
  
    <?php get_template_part('/partials/sitemap'); ?>

	<?php $megamag_options_post = get_option('megamag_options_post') ?>
		
		<div id="main" class="container">
		
			<div id="content">
			

			<?php woocommerce_content(); ?>	<!-- main post loop -->


			</div>
			<!-- END CONTENT -->


<?php get_sidebar(); ?>			

<?php get_footer(); ?>