

<div class="row">
	<div class="col-md-4 col-md-offset-4 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	<?php echo form_open('healthcenter/add_finyear/insert',array("id"=>"fyears")); ?>
	
                    <div id="rtr" style="background-color:#FF9999; color:#fff; padding:8px;"></div>
					<br/>
                  
	<div class="box box-solid box-primary">
	<?php echo form_close(); ?>
				<div class="box-header">
					<h3 class="box-title">Financial Year</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="financialyear">Financial Year</label>
									<?php 
											$options = array(
											  '0'  => 'Select Financial Year',
											  '2010'  => '2010-2011',
											  '2011'  => '2011-2012',
											  '2012'  => '2012-2013',
											  '2013' => '2013-2014',
											  '2014' => '2014-2015',
											  '2015' => '2015-2016',
											  '2016' => '2016-2017',
											  '2017' => '2017-2018',
											  '2018' => '2018-2019',
											  '2019' => '2019-2020',
											  '2020' => '2020-2021',
											  '2021' => '2021-2022',
											);
											echo form_dropdown('dropdown_menu',  $options, '0','class="form-control" id="dropdown_menu"');


									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="financialbudget">Budget</label>
									<?php echo form_input(array('name'=>'budget','id'=>'budget','placeholder'=>'Enter Budget','class'=>'form-control',)) ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="fbyear">Budget Date</label>
									<?php echo form_input(array('name'=>'b_date','id'=>'b_date','placeholder'=>'Budget Date','class'=>'form-control','data-date-format'=>'dd M yyyy')) ?>
								</div>
							</div>
						
						</div>
				
						
				</div>
				<div class="box-footer">
							<div class="row">
								<div class="col-md-8">
									<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
								</div>
								</div>
							
				</div>
				
	
		</div>
		
		
		
		
		
		
	</div>
</div>

<h2 class="page-header">Financial Budget</h2>
		<table class="table table-bordered table-striped" id="fin_year">
		<thead>
		<tr>
		<td>Financial Year</td>
		<td>Budget</td>
		<td>Group A Budget</td>
		<td>Group B Budget</td>
		<td>Budget Date</td>
		</tr>
		</thead>
		<tbody>
		
		</tbody>
		
		</table>

<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>

<script type="text/javascript">

$(function(){

		$('#rtr').hide();
	$("#fyears").on("submit",function(){
		//alert("hi");
		//return false;
					$.ajax({
							url:$(this).attr("action"),
									type:"POST",
									data:{"fyear":$("#dropdown_menu").val(),"budget":$("#budget").val(),"b_date":$('#b_date').val()},
									success:function(data){
										
										//alert(data);
										if(data.slice(2,5) !="<p>"){
										var json = $.parseJSON(data);
										var fy=parseInt(json.curr_fin_year);
										var fy1=(fy+1);
										var fy2=fy+"-"+fy1;
										var bug=parseFloat(json.budget);
										var buga=parseFloat(json.b_groupA);
										var bugb=parseFloat(json.b_groupB);
										var per1=(buga*100)/bug;
										var per2=(bugb*100)/bug;
										var ga_bug=buga+" ( "+Math.round(per1)+" %)"
										var gb_bug=bugb+" ( "+Math.round(per2)+" %)"
										//var newDate = dateFormat(json.bud_date, "mm/dd/yyyy");
										//alert(newDate);
										r="<tr><td>"+fy2+"</td><td>"+json.budget+"</td><td>"+ga_bug+"</td><td>"+gb_bug+"</td><td>"+json.bud_date+"</td></tr>";
										$('#fin_year tbody').append(r);
										$('input[type="submit"]').attr('disabled','disabled');
										}else{
												//$('input[type="submit"]').removeAttr('disabled');
												$('#rtr').html(data);
												$('#rtr').show('slow');
													
												setTimeout(function() {
											  $('#rtr').hide('slow');
										}, 3000);
											
										}
									}
					});
						return false;	
	});	

		function IsJsonString(str){
			try{
				JSON.parse(str);
			}catch (e){
				return false;
			}
			return true;
		}
						
		$('#b_date').datepicker({
			endDate:"+0d",
			autoclose:true
		}); 					
});
	
	


</script>
