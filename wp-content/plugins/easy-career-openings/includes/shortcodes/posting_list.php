<?php
global $wpdb;
	$sql = "SELECT id, JobTitle, JobBody, PostingCity, PostingState FROM ".$wpdb->prefix."eco_career_openings ORDER BY id DESC";
     $result = mysql_query($sql) or die (mysql_error());
     echo '<table id="jobBoard">';
echo '<th><h1>Bakery Jobs</th>';
     while ($row = mysql_fetch_array($result)) {
    $jobid = $row['id'];
    $jobtitle = $row['JobTitle'];
    $jobbody = $row['JobBody'];
    $state = $row['PostingState'];
    $city = $row['PostingCity'];    
	echo '	<tr class="yellow">';    
    echo '		<td style="padding:8px;border-left:1px solid #ccc;border-bottom:1px solid #ccc;">'.$jobtitle.'<br/>
<a href="'.get_option('eco-career-details-page').'?jobid='.$jobid.'">+ More</a></td>';
    echo '	</tr>';
    //$row_count++;
    }
    echo '</table>';
