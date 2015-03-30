<?php echo form_open('healthcenter/add_medicine_receive/show_medicine',array("id"=>"fetch_medi",)); ?>

<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Medicine Recieve Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					
										
					<div class="col-md-6">
						
						<div class="form-group">
							<label for="porefno">Select Purchase Order Reference Number</label>
							<?php echo form_dropdown('po_id', $po_list,"",'class="form-control" id="po_id"' )?>
						</div>
					</div>
					<div class="col-md-6">
						
						<div class="form-group">
							<label for="porefno">Out Dated Purchase Order Reference Number</label>
							<?php echo form_dropdown('po_id', $po_list1,"",'class="form-control" id="po_id_out"' )?>
						</div>
					</div>
												
			
			</div>
				
				<div class="box-footer">
				<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
				</div>
			
			</div>
		</div>
	
	<h2 class="page-header">Indented  Items</h2>
		<div class="table-responsive">
		<table class="table table-bordered table-striped "  id="ind-des">
		<thead>
		<tr>
		<td>Particulars</td>
		<td>Pack</td>
		<td>Qty</td>
		<td>Rec.Qty</td>
		<td>Supplied Date</td>
		<td>Mgf.Date</td>
		<td>Exp.Date</td>
		<td>Batch No</td>
		
		<td>MRP</td>
		<td>Rate</td>
		<td>Amount</td>
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
input {
width: 80px;
}
</style>
<script>
  $(function() {
	  
    $("#fetch_medi").on("submit",function(){
		
						//alert($("#po_id").val());
						
						
						$.ajax({
						
						url:$(this).attr("action"),
						type:"POST",
						data:{"po_id":$("#po_id").val()},
						success:function(data){
							var json = $.parseJSON(data);
						
							$('#ind-des tbody').html("");
							var i =0;
							//alert(data)
							$.each(json,function(key,value){
									r="<tr ><td>"+value.m_name+"</td><td>"+value.std_pkt+"</td><td><input data-toggle='tooltip' data-placement='top' type='text' disabled='disabled' value='"+value.ind_qty+"' id='sqty-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='qty-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='supp_date-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='mfg_date-"+i+"'/></td><td><input  data-toggle='tooltip' data-placement='top' data-provide='datepicker' data-date-format='dd M yyyy' id='exp_date-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='batch_no-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='mrp-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' onfocusout='calc("+i+")' id='rate_of_pur-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='amount-"+i+"'/></td><td><a  onclick='save("+value.m_id+","+i+","+value.po_id+")'><span style='color:green;' class='glyphicon glyphicon-floppy-disk'></span></a></td></tr>";
									$('#ind-des tbody').append(r);
									i++;
									
							});
													
						}
						
						
					});
						
					return false;
						});
			
	
  });
  
  function dat(){
	  
	  $("#mfgdate").datepicker();
  }
  
  function save(mid,row,poid)
  {
	  
	  var recqty=$('#qty-'+row).val();
	  var mfgdate=$('#mfg_date-'+row).val();
	  var expdate=$('#exp_date-'+row).val();
	  var batchno=$('#batch_no-'+row).val();
	  var suppdate=$('#supp_date-'+row).val();
	  var mrp=$('#mrp-'+row).val();
	  var rate_of_pur=$('#rate_of_pur-'+row).val();
	  var amt=$('#amount-'+row).val();
	  var sqty1=$('#sqty-'+row).val();
	  
		
		//alert(expdate);
		//----------------------------------------------------------
		
 
		var dt1 = new Date(suppdate);
		var dt2 = new Date(expdate);
		var diff = dt2.getTime() - dt1.getTime();
		var days = diff/(1000 * 60 * 60 * 24);
		//alert(dt1 + ", " + dt2);
 
		//alert(days);
		//------------------------------------------------------------
		
	
	 if(parseInt(recqty) > parseInt(sqty1))
	  {
		alert("Received Quantity Can Not be Greater Than Indented Quantity");
		$('#qty-'+row).focus();
	  }
	  else if(days>180)
	  {
		  
		  alert("Please Check Expiry Date of Medicine. It may be greater than 6 Month ")
		  $('#qty-'+row).focus();
	  }
	  else{
	 
	  $.ajax({
					
						
						url:'<?php echo site_url('healthcenter/add_medicine_receive/medi_receive') ?>',
						type:"POST",
						data:{"m_id":mid,"mrec_qty":recqty,"mfg_date":mfgdate,"exp_date":expdate,"batch_no":batchno,"supp_date":suppdate,"mrp":mrp,"rate_of_pur":rate_of_pur,"amount":amt,"po_id":poid},
						success:function(data){
							//var json = $.parseJSON(data);
							if(data !='0'){
							//
							alert("Please Provide Input");
							//$("#"+data+"-"+row).css('background-color','#FEC7C8');
							//$("#"+data+"-"+row).attr('title','Provide Input');
							//$("#"+data+"-"+row).tooltip();
							}else{
								//$('#qty-'+row).css('background-color','#C3CFDB');
								//$('#qty-'+row).attr("disabled", "disabled"); 
								
								alert("Record Saved");
								
							}
							
							
						}
						
						
					});
	  
	  }
							
  }
  function calc(id)
		{
			//alert(id);
			
			
			$('#amount-'+id).val($('#rate_of_pur-'+id).val()*$('#qty-'+id).val());
			
			$('#amount-'+id).attr("disabled", "disabled"); 
			
		}
  
 </script>

