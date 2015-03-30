<?php echo form_open('healthcenter/rc_by_manu/insert',array("id"=>"rcmenu")); ?>

<div class="row">
	<div class="col-md-6 col-md-offset-2  ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	
                    
                  
	<div class="box box-solid box-primary">

				<div class="box-header">
					<h3 class="box-title">Rate Contract By Manufacturer</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="manuname">Select Manufacturer</label>
									
									<select id ="selmanu" name="selmanu" class="form-control" >
										<option value="none" selected="selected">Select </option>

										<?php foreach($manu_list as $r):?>
										<option value="<?php echo $r->manu_id?>"><?php echo $r->manu_name?></option>
										<?php endforeach;?>
									</select>
									
									
									
								</div>
							</div>
						</div>
				</div>
		
				<div class="box-footer">
							<div class="row">
								<div class="col-md-8">
									<button type="button" class="btn btn-primary" id="b_sub">Sumbit</button>
								</div>
								</div>
							
				</div>
				
	
		</div>
		
			
		
		
	</div>
	</div>
	<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<h2 class="page-header">Manufacturer Discount Details</h2>
		<div class="table-responsive">
		<table class="table table-bordered table-striped "  id="rc_dis">
		<thead>
		<tr>
		<td>Medicine Name</td>
		<td> Discout (In Percentage)</td>
		<td>Valid From</td>
		<td>Valid To</td>
		<td>Action</td>
		</tr>
		</thead>
		<tbody>	
		
		</tbody>
		
		</table>
	</div>
	</div>
</div>
<?php echo form_close(); ?>
<style>
.box-primary{
	border:1px groove #3c8dbc !important;
}
</style>
<script type="text/javascript">  
  $(function() {
	  
	  $('#b_sub').click(function(){
			
					
			id=$("#selmanu").val();
			//alert(id);
				$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/rc_by_manu/show_medi/"+id,
					 success: function(data)
						{
								var json = $.parseJSON(data);
						
							$('#rc_dis tbody').html("");
							var i =0;
						//	alert(data);
							$.each(json,function(key,value){
									r="<tr><td><input data-toggle='tooltip' data-placement='top' type='text' disabled='disabled' value='"+value.m_name+"' id='mid-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='mdis-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='mvfrom_dt-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='mvto_dt-"+i+"'/></td><td> <a onclick='save("+value.m_id+","+i+","+value.manu_id+")'><span style='color:green;' class='glyphicon glyphicon-floppy-disk'></span></a></td></tr>";
									$('#rc_dis').append(r);
									i++;
									
							});
						}
				});
	
	  });
  });              
          
	function save(mid,row,manuid)
  {
	  
	 var manuid=manuid;
	 var mid=mid;
	 var dis=$('#mdis-'+row).val();
	 var vfrom=$('#mvfrom_dt-'+row).val();
	 var vto=$('#mvto_dt-'+row).val();
	 
	 
	 
	if(dis==""||vfrom==""||vto=="")
	{
		alert("Please Provide Input");
	}
	else{
//	alert("mid="+mid); alert("row="+row); alert("manu="+manuid); alert("dis="+dis); alert("dis from="+vfrom); alert("dis to="+vto);
	 $.ajax({
						url:'<?php echo site_url('healthcenter/rc_by_manu/insert') ?>',
						type:"POST",
						data:{"manu_id":manuid,"m_id":mid,"mdis":dis,"mdvfrom":vfrom,"mdvto":vto},
						success:function(data){
							//alert(data);
							alert("Record Saved");
						}
					});
	 
	}
	 
	 

  }	  
			   
			   
           
</script>  
