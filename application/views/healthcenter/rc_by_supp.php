<?php echo form_open('healthcenter/rc_by_supp/insert',array("id"=>"rcsupp")); ?>

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
					<h3 class="box-title">Rate Contract By Supplier</h3>
				</div>
				
				<div class="box-body">
				
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="supp">Supplier</label>
									
								<?php echo form_dropdown('suppDrp', $supp_list,'','class="form-control" id="suppDrp"'); ?> 	
									
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="manu">Manufacturer</label>
									<?php echo form_dropdown('manuDrp',  array(), '','class="form-control" id="manuDrp"');?>
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
	<h2 class="page-header">Supplier Discount Details</h2>
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
                  $(document).ready(function() {  
                     $("#suppDrp").change(function(){  
					//alert($(this).val());
					 
					 
                     /*dropdown post *///  
                    $.ajax({  
                        url:"<?php echo base_url();?>index.php/healthcenter/rc_by_supp/show_manu",  
                        data: {id:$(this).val()},  
                        type: "POST",  
                        success:function(data){  
                       						
						//alert(data);
						 var json = $.parseJSON(data);
    					// $("#manu").val(json.manu_nm[0].manu_name);
						 
						 // Population of Supplier List 
						 var appenddata = "";
						$.each(json.manu_nm, function (key, value) {
							appenddata += "<option value = '" + value.manu_id + " '>" + value.manu_name + " </option>";                        
						});
						$('#manuDrp').html(appenddata);
						 
						
                     }  
                  });  
               });  
			   
			   //$('#ms_date').datepicker(); 
			  // $('#me_date').datepicker(); 
			  //  $('#ss_date').datepicker(); 
			  // $('#se_date').datepicker(); 
		
		$('#b_sub').click(function(){
			sid=$("#suppDrp").val();
			mid=$("#manuDrp").val();
			
			//alert("supp ID="+id);
			//alert("manu ID="+id1);
			
				$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/rc_by_manu/show_medi/"+mid,
					 success: function(data)
						{
								var json = $.parseJSON(data);
						
							$('#rc_dis tbody').html("");
							var i =0;
							//alert(data);
							$.each(json,function(key,value){
									r="<tr><td><input data-toggle='tooltip' data-placement='top' type='text'disabled='disabled' value='"+value.m_name+"' id='mid-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='mdis-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='mvfrom_dt-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='mvto_dt-"+i+"'/></td><td> <a onclick='save("+value.m_id+","+i+","+value.manu_id+","+sid+")'><span style='color:green;' class='glyphicon glyphicon-floppy-disk'></span></a></td></tr>";
									$('#rc_dis').append(r);
									i++;
									
							});
						}
				});
	
	  });
			   
			   
            });  
			
function save(mid,row,manuid,sid)
  {
	  
	 var manuid=manuid;
	 var mid=mid;
	 var sid=sid;
	 var dis=$('#mdis-'+row).val();
	 var vfrom=$('#mvfrom_dt-'+row).val();
	 var vto=$('#mvto_dt-'+row).val();
	 
	 if(dis==""||vfrom==""||vto=="")
	{
		alert("Please Provide Input");
	}
	else{
// alert("mid="+mid); alert("row="+row); alert("manu="+manuid);alert("sid="+sid); alert("dis="+dis); alert("dis from="+vfrom); alert("dis to="+vto);
	 $.ajax({
						url:'<?php echo site_url('healthcenter/rc_by_supp/insert') ?>',
						type:"POST",
						data:{"s_id":sid,"manu_id":manuid,"m_id":mid,"sdis":dis,"sdvfrom":vfrom,"sdvto":vto},
						success:function(data){
						
							
								
								alert("Record Saved");
								
							
						}
					});
	 
	}
	 
	 

  }	  
         </script>  
