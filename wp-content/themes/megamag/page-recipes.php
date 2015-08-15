<?php  /* Template Name: Recipes */ ?>
<?php 
  /* used for the alphabetical listing include */
  $category = 14;
?>
<?php get_header(); ?>
  
  <?php $megamag_options_post = get_option('megamag_options_post') ?>
		
		<div id="main" class="container">		
			<div id="content">
			<!---NEW alpha listing include 02/24 KJH-->
				<?php include('AlphaListingInclude.php'); ?>
			</div>
			<!-- END CONTENT -->

<?php get_sidebar(); ?>			

<?php get_footer(); ?>

<script type="text/javascript">
  $(document).ready(function () {
  $(".post-heading.page").hide();
  });
</script>
