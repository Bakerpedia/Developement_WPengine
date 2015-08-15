<?php  /* Template Name: lengthConversion */ ?>
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
           <h1 class="blog-heading">Length Conversion</h1>
			
			 <div class="resp_code" align="left">	
				<div align="left">
					<b>Enter your quantity into the appropriate field and the calculation will be done automatically.<br><br> 
				</div>
				<div align="left">
				  <form name="conv" action="" class="frms noborders"> <br> 
					<table width="100%" class="frms noborders"> 
						<tbody>                            
						<tr><td align="center"><input type="text" onkeyup="checnum(this);inchconv();" value="0" name="inch"></td><td>Inch</td></tr> 
						<tr><td align="center"><input type="text" onkeyup="checnum(this);cmconv();" value="0" name="cm"></td><td>Centimeter</td></tr>
						<tr><td align="center"><input type="text" onkeyup="checnum(this);feetconv();" value="0" name="feet"></td><td>Feet</td></tr>
						<tr><td align="center"><input type="text" onkeyup="checnum(this);kiloconv();" value="0" name="kilo"></td><td>Kilometer</td></tr> 
						<tr><td align="center"><input type="text" onkeyup="checnum(this);milesconv();" value="0" name="miles"></td><td>Mile</td></tr> 
						<tr><td align="center"><input type="text" onkeyUp="checnum(this);metersconv();" value="0" name="meters"></td><td>Meters</td></tr>						
						</tbody>
					</table>
					</form><br> 
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
			
<script type="text/javascript">
function checnum(as)
{
	var dd = as.value;
	if(isNaN(dd))
	{
		dd = dd.substring(0,(dd.length-1));
		as.value = dd;
	}
} 

metersconv

function metersconv(val){
	with(document.conv){
		cm.value = (Math.round(meters.value/0.010000)).toFixed(2);
		feet.value=(Math.round(meters.value/3.2808)).toFixed(2);
		inch.value=(Math.round(meters.value*39.370)).toFixed(2);
		kilo.value=((meters.value/1000.00)).toFixed(6);
		miles.value=((meters.value*0.000621)).toFixed(6);
	} 
}

function inchconv(val){
	with(document.conv){
		cm.value = (Math.round(inch.value*2.54)).toFixed(2);
		feet.value=(Math.round(inch.value/12)).toFixed(2);
		var tmp=(inch.value* 2.54)*Math.pow(10,-5);
		kilo.value=((inch.value* 2.54)*Math.pow(10,-5)).toFixed(2);
		miles.value=((inch.value*1.58)*Math.pow(10,-5)).toFixed(2);
		meters.value=((inch.value/39.370)).toFixed(2);
	} 
}

function feetconv(val){
	with(document.conv){
		cm.value=(Math.round(feet.value*30.48)).toFixed(2);
		inch.value=(Math.round(feet.value*12)).toFixed(2);
		kilo.value=((feet.value* 3.05)*Math.pow(10,-4)).toFixed(2);
		miles.value==((feet.value* 0.00018939)).toFixed(2);
		meters.value = ((feet.value/3.2808)).toFixed(2);
	} 
} 

function cmconv(val){
	with(document.conv){
		feet.value = (Math.round(cm.value/30.84)).toFixed(2);
		inch.value = (Math.round(cm.value/2.54)).toFixed(2);
		kilo.value=((cm.value*1)*Math.pow(10,-5)).toFixed(2);
		miles.value==((cm.value*6.21)*Math.pow(10,-6)).toFixed(2);
		meters.value = ((cm.value/100)).toFixed(2);
	} 
} 

function kiloconv(val){
	with(document.conv){
		feet.value = ((kilo.value*3.28)*Math.pow(10,3)).toFixed(2);
		inch.value = ((kilo.value*3.94)*Math.pow(10,4)).toFixed(2);
		cm.value=((kilo.value*1)*Math.pow(10,5)).toFixed(2);
		miles.value=((kilo.value* 0.621)).toFixed(2);
		meters.value = ((kilo.value/0.0010000)).toFixed(2);
	} 
} 

function milesconv(val){
	with(document.conv){
		feet.value =((miles.value* 5.28)*Math.pow(10,3)).toFixed(2);
		inch.value = ((miles.value*6.34)*Math.pow(10,4)).toFixed(2);
		cm.value=((miles.value*1.61)*Math.pow(10,5)).toFixed(2);
		kilo.value=((miles.value*1.61)).toFixed(2);
		meters.value=((miles.value/0.00062137)).toFixed(2);
	} 
} 
</script>

				

