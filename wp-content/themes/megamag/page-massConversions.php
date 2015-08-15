<?php  /* Template Name: massConversion */ ?>
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
</style>

<?php get_header(); ?>		
		<div id="main" class="container">		
			<div id="content">
           <h1 class="blog-heading">Mass Conversions</h1>
			
			 <div class="resp_code" align="left">
				<div align="left">
					<b>Enter your quantity into the appropriate field and click Calculate.<b>
				</div>			 
				<div align="left">
				  <form method="post"> 
					<table width="100%" class="frms noborders"> 
						<tbody>                          
							
							<tr style="height:1px;"><td><input type="hidden" value="Clear form" onclick="clearform(this.form)" ></td></tr>
							<tr style="height:25px;"><td align="center"><input type="TEXT" name="val1" size="6" onfocus="clearform(this.form)"></td><td align="left" style="padding-left: 5px;">Kilograms</td></tr>
							<tr style="height:25px;"><td align="center"><input type="TEXT" name="val2" size="6" onfocus="clearform(this.form)"></td><td align="left" style="padding-left: 5px;">Ounces</td></tr>
							<tr style="height:25px;"><td align="center"><input type="TEXT" name="val3" size="6" onfocus="clearform(this.form)"></td><td align="left" style="padding-left: 5px;">Pounds</td></tr>
							<tr style="height:25px;"><td align="center"><input type="TEXT" name="val6" size="6" onfocus="clearform(this.form)"></td><td align="left" style="padding-left: 5px;">Tons</td></tr>									
							<tr style="height:25px;">
								<td style="align:left;"><input type="button" value="Calculate" onclick="convertform(this.form)"></td>								
							</tr>							
						</tbody>
					</table>
					</form><br> 
					<div></div>
				</div> 		
			</div>	   
		
			<div class="blog-item" id="column1-wrap">	
				<div class="archive-text" style="padding-bottom:5px;" >					
				</div>
			</div>
				<div id="column2" class="blog-item"></div>	
				<div class="post">
					<div class="post-content"></div>
				</div>
				<!-- END POST -->
			</div>
			<!-- END CONTENT -->


<?php get_sidebar(); ?>			

<?php get_footer(); ?>	
			
<script language="JavaScript">
<!-- Set conversion factors for each item in form.
document.forms[0].count = 4;
document.forms[0].rsize = 4;
document.forms[0].val1.factor = 1;
document.forms[0].val2.factor = 35.273944;
document.forms[0].val3.factor = 2.2046215;
<!-- document.forms[0].val4.factor = 2.6792765;-->
<!-- document.forms[0].val5.factor = 0.1574731232747;  -->
document.forms[0].val6.factor = 0.00110231075;
<!-- document.forms[0].val7.factor = 0.001; -->
<!-- done hiding from old browsers -->
</script>			     
		
			
<script language="JavaScript">
<!-- Generic Unit Conversion Program
// Author    : Jonathan Weesner (jweesner@cyberstation.net)  21 Nov 95
// Copyright : You want it? Take it! ... but leave the Author line intact please!
function convertform(form){

    var firstvalue = 0;
    for (var i = 1; i <= form.count; i++) {
       // Find first non-blank entry
       if (form.elements[i].value != null && form.elements[i].value.length != 0) {
			if (i == 1 && form.elements[2].value != "") return false;
			firstvalue = form.elements[i].value / form.elements[i].factor;
		break;
       }
    }

    if (firstvalue == 0) {
       clearform(form);
       return false;
    }

    for (var i = 1; i <= form.count; i++)
       form.elements[i].value = formatvalue((firstvalue * form.elements[i].factor), form.rsize);
    return true;
}

function formatvalue(input, rsize) {
   var invalid = "**************************";
   var nines = "999999999999999999999999";
   var strin = "" + input;
   var fltin = parseFloat(strin);

   if (strin.length <= rsize) return strin;

   if (strin.indexOf("e") != -1 ||
       fltin > parseFloat(nines.substring(0,rsize)+".4"))
      return invalid.substring(0, rsize);
	  var rounded = "" + (fltin + (fltin - parseFloat(strin.substring(0, rsize))));
      return rounded.substring(0, rsize);

}

function resetform(form) {
    clearform(form);	
   
    return true;
}

function clearform(form) {
    for (var i = 1; i <= form.count; i++) form.elements[i].value = "";
    return true;
}
<!-- done hiding from old browsers -->
</script>