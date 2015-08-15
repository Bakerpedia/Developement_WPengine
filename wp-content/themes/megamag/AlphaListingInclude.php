 <?php
/*
Template Name: A-Z Pages
A WordPress template to list page titles by first letter.
You should modify the CSS to suit your theme and place it in its proper file.
Be sure to set the $posts_per_row and $posts_per_page variables.
*/

$posts_per_row = 5;
$posts_per_page = 2500;
?>
<style type="text/css">
  /********************************************************************************************************
* CUSTOM CSS FOR ALPHA LISTINGS
*********************************************************************************************************/
   .letter-group { width: 100%; padding-top: 4px; border-top:solid; border-width:2px; font-weight: bold;}
    .letter-cell {  text-align: center; padding-top: 8px; margin-bottom: 8px;  float: left; 
       border:1px solid #616261; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;
       font-size:12px;font-family:arial, helvetica, sans-serif; padding: 10px 10px 10px 10px; text-decoration:none; 
       display:inline-block;text-shadow: -1px -1px 0 rgba(0,0,0,0.3);font-weight:bold; color: #FFFFFF;
       background-color: #7d7e7d; background-image: -webkit-gradient(linear, left top, left bottom, from(#7d7e7d), to(#0e0e0e));
       background-image: -webkit-linear-gradient(top, #7d7e7d, #0e0e0e);
       background-image: -moz-linear-gradient(top, #7d7e7d, #0e0e0e);
       background-image: -ms-linear-gradient(top, #7d7e7d, #0e0e0e);
       background-image: -o-linear-gradient(top, #7d7e7d, #0e0e0e);
       background-image: linear-gradient(to bottom, #7d7e7d, #0e0e0e);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#7d7e7d, endColorstr=#0e0e0e);
      }    
    .row-cells { width: 70%; float: right; margin-right: 125px; padding-left: 5px;}
    .row-cells li a { font-weight: bold;  } 
    .title-cell { width: 70%;  float: left; overflow: hidden; margin-bottom: 8px; border-style:solid; border-width:thin 1px; border-color:#fff; text-transform: lowercase;}
	.title-cell:first-letter{text-transform: uppercase;}
    .clear { clear: both; }  
</style>
<div id="main-column">
    <div class="margin-top"></div>
    <div id="a-z">

     <?php
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array (
        'posts_per_page' => $posts_per_page,
        'post_type' => 'post',
        'cat' => $category,
        'orderby' => 'title',
        'order' => 'ASC',
        'paged' => $paged
      );
      query_posts($args);
      if ( have_posts() ) {
        $in_this_row = 0;
        while ( have_posts() ) {
            the_post();
            $first_letter = strtoupper(substr(apply_filters('the_title',$post->post_title),0,1));
            if ($first_letter != $curr_letter) {
              if (++$post_count > 1) {
                  end_prev_letter();
              }
              start_new_letter($first_letter);
              $curr_letter = $first_letter;
            }
            if (++$in_this_row > $posts_per_row) {
              end_prev_row();
              start_new_row();
              ++$in_this_row;  // Account for this first post
            } ?>
            
    <div class="title-cell">
      <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Click to see <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
    </div>
    <?php }
    end_prev_letter();
    ?>
    <div class="navigation">
      <div class="alignleft">
        <?php next_posts_link('&laquo; Higher Letters') ?>
      </div>
      <div class="alignright">
        <?php previous_posts_link('Lower Letters &raquo;') ?>
      </div>
    </div>
    <?php } else {
    echo "<h2>Sorry, no posts were found!</h2>";
  }
  ?>

  </div>
  <!-- End id='a-z' -->		  		  
</div>
<!-- End class='margin-top -->

<?php
function end_prev_letter() {
   end_prev_row();
   echo "</div><!-- End of letter-group -->\n";
   echo "<div class='clear'></div>\n";
}
function start_new_letter($letter) {
   echo "<div class='letter-group'>\n";
   echo "\t<div class='letter-cell'>$letter</div>\n";
   start_new_row($letter);
}
function end_prev_row() {
   echo "\t</div><!-- End row-cells -->\n";
}
function start_new_row() {
   global $in_this_row;
   $in_this_row = 0;
   echo "\t<div class='row-cells'>\n";
}
?>