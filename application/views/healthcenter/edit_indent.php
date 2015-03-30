

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
					<h3 class="box-title">Edit Indent Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					
										
					<div class="col-md-12">
						
						<div class="form-group">
							<label for="porefno">Select Indent Reference Number</label>
							<?php echo form_dropdown('indent_id', $indent_list,"",'class="form-control" id="indent_id"' )?>
						</div>
					</div>
			
			
				<div class="col-md-6">
					<div class="box-footer">
					
					<button type="button" class="btn btn-primary" id="b_mod">Modify</button>
					
					</div>
				</div>
				<div class="col-md-6">
					<div class="box-footer">
					<button type="button" class="btn btn-primary" id="b_del">Delete</button>
					</div>
				</div>
			</div>
			</div>
		</div>
	
	<h2 class="page-header">Indented  Items</h2>
		<div class="table-responsive">
		<table class="table table-bordered table-striped "  id="ind-des">
		<thead>
		<tr>
		<td>Particulars</td>
		<td>Pr.Stock</td>
		<td>Group</td>
		<td>MFG.CO.</td>
		<td>Std.Pkt</td>
		<td>Approx.Rate</td>
		<td>Qty.Req</td>
		<td>Approx.Cost</td>
		<td>Action</td>
		</tr>
		</thead>
		<tbody>	
		
		</tbody>
		
		</table>
	</div>
	<div id="addbutton">
	<button type="button" class="btn btn-primary">Add More Medicine</button>
	
	
	
	</div>
	<div id="myModal" class="modal fade">
	<?php echo form_open('healthcenter/add_indent/insert_desc',array("id"=>"indent",)); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                	
						
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="indrefno">Choose Medicine</label>
							<?php echo form_input(array('name'=>'m_name','id'=>'m_id','placeholder'=>'Medicine Name','class'=>'form-control ',)) ?>
							
						</div>
						 
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Pri.Stock</label>
							<?php echo form_input(array('name'=>'p_stock','id'=>'p_stock','disabled'=>"disabled",'class'=>'form-control',)) ?>
							
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Group</label>
							<?php echo form_input(array('name'=>'group','id'=>'group','disabled'=>"disabled",'class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">MFG Co.</label>
							<?php echo form_input(array('name'=>'mfgco','id'=>'mfgco','disabled'=>"disabled",'class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Std.Pkt</label>
							<?php echo form_input(array('name'=>'std_pkt','id'=>'std_pkt','placeholder'=>'Standard Packet ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">App.Rate</label>
							<?php echo form_input(array('name'=>'app_rate','id'=>'app_rate','placeholder'=>'Approx. Rate ','class'=>'form-control','style'=>'text-align:right;')) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address2">Qty</label>
							<?php echo form_input(array('name'=>'m_quantity','id'=>'m_quantity','placeholder'=>'Quantity','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address2">App.Cost</label>
							<?php echo form_input(array('name'=>'app_cost','id'=>'app_cost','placeholder'=>'Approx. Cost','disabled'=>'disabled','class'=>'form-control','style'=>'text-align:right;')) ?>
						</div>
					</div>
			
			</div>
			
				
			
			
				
            </div>
            <div class="modal-footer">
			<?php echo form_hidden('indId','')?><?php echo form_hidden('mh_id'); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<?php  echo form_submit('submit','Save','class="btn btn-primary"'); ?>
            </div>
        </div>
    </div>
	<?php echo form_close(); ?>
</div>
	</div>
</div>

<style>
input {
width: 80px;
}

.ui-autocomplete {
    z-index: 5000;
}
.ui-autocomplete{
	
	background-color:#fff;
	width:250px;

}
.ui-autocomplete li{
	list-style:none;
}

</style>
<script>
  $(function() {
	  
	  //---------------------------Fetching medicine name and other based on Medicine ID---------------
	$('#m_id').on('focusout',function(){
	
		
		$.ajax({
				type: "GET",
				dataType: "text",
				url:"<?php echo base_url() ?>index.php/healthcenter/add_indent/getMedicineA/",
				data:{"mid":$("#m_id").val()},
                             
							 success:function(data){
                                 //var JSONArray = $.parseJSON(data);
								 var json = $.parseJSON(data);
								 $("input[name=mh_id]").val(json.m_id);
								 $("#p_stock").val(json.c_stock);
								 $("#group").val(json.m_group);
								 $("#mfgco").val(json.manu_name);
								 $('input[name=indId]').val($('#indent_id').val());
	
                              }
					
						
		});
	});
	//---------------------End of Fetching medicine------------------------------------
	  
	  //--------------------------Autocomplete--------------------------------
		
	$("#m_id").autocomplete({
	source: "<?php echo base_url() ?>index.php/healthcenter/add_indent/GetMedi/",
	});
	
	$('#m_quantity').on('focusout',function(){
		//alert($(this).val());
		if($('#app_rate').val().length > 0 ){
				$('#app_cost').val(($('#app_rate').val()*$('#m_quantity').val()));
		}else{
			
			$('#app_rate').focus();
		}
	});
	
	
	//---------------------End of Autocomplete------------------------------------
	  
	  		// Indent save-------------
			$("#indent").on("submit",function(){
						//alert($("input[name=mh_id]").val());
						
					$.ajax({
						
						url:$(this).attr("action"),
						type:"POST",
						data:{"indId":$("input[name=indId]").val(),m_id:$("input[name=mh_id]").val(),"std_pkt":$("#std_pkt").val(),"app_rate":$("#app_rate").val(),"m_quantity":$("#m_quantity").val()},
						success:function(data){
							var json = $.parseJSON(data);
							
		r="<tr id='t_"+json.ind_des_id+"'><td>"+json.m_name+"</td><td>"+json.c_stock+"</td><td>"+json.m_group+"</td><td>"+json.manu_name+"</td><td>"+json.std_pkt+"</td><td>"+json.app_rate+"</td><td>"+json.ind_qty+"</td><td>"+json.app_cost+"</td><td><a onclick='del("+json.ind_des_id+")'><span style='color:red;' class='glyphicon glyphicon-remove'></span></a></td></tr>";
							
							$('#ind-des tbody').append(r);
							$("#m_id,#mh_id,#std_pkt,#app_rate,#m_quantity,#m_name,#p_stock,#group,#mfgco").val("");
							//$("#m_id").focus();
							$('#myModal').modal('hide');
							
						}
						
						
					});
						return false;
						
						});
	  
	  $("#addbutton").hide();
	  
	  $('#b_del').click(function(){
			id=$("#indent_id").val();
			alert(id);
			$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/add_indent/del_indent/"+id,
					 success: function()
						{
								alert("Indent Deleted Successfully");
								//$('#reportresult').html(data);
						}
				});
					
				
		});
		
		
		$('#b_mod').click(function(){
			
			id=$("#indent_id").val();
			$('input[name=indId]').val(id);
			//alert(id);
			$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/add_indent/fedit_indent/"+id,
					 success: function(data)
						{
								var json = $.parseJSON(data);
						
							$('#ind-des tbody').html("");
							var i =0;
							//alert(data);
							$.each(json,function(key,value){
									r="<tr id='t_"+value.ind_des_id+"' ><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.m_name+"' id='mname-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.c_stock+"' id='cstock-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.m_group+"' id='mgroup-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.manu_name+"' id='mmanu-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.std_pkt+"' id='mspkt-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.app_rate+"' id='ind_rate-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.ind_qty+"' onfocusout='calc("+i+")' id='sqty-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='amount-"+i+"'/></td><td><a  onclick='save("+value.m_id+","+i+","+value.ind_des_id+")'><span style='color:green;' class='glyphicon glyphicon-floppy-disk'></span></a><a onclick='del("+value.ind_des_id+")'><span style='color:red;' class='glyphicon glyphicon-remove'></span></a></td></tr>";
									$('#ind-des tbody').append(r);
									i++;
									
							});
						}
				});
			$("#addbutton").show();
			
		});
		//------------------Add More Medicine----------
		$('#addbutton').click(function(){
			
			id=$("#indent_id").val();
			
			$("#IndId").val($(this).data(id));
			
			$("#myModal").modal('show');
			
			
			
		});
		//--------------------------------------------
    $("#fetch_medi").on("submit",function(){
		
					//	alert($("#indent_id").val());
						
						
						$.ajax({
						
						url:$(this).attr("action"),
						type:"POST",
						data:{"indent_id":$("#indent_id").val()},
						success:function(data){
						
							var json = $.parseJSON(data);
						
							$('#ind-des tbody').html("");
							var i =0;
							//alert(data);
							$.each(json,function(key,value){
									r="<tr ><td>"+value.m_name+"</td><td>"+value.c_stock+"</td><td>"+value.m_group+"</td><td>"+value.manu_name+"</td><td>"+value.std_pkt+"</td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.app_rate+"' disabled='disabled' id='ind_rate-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='"+value.ind_qty+"' onfocusout='calc("+i+")' id='sqty-"+i+"'/></td><td><input data-toggle='tooltip' data-placement='top' type='text' value='' id='amount-"+i+"'/></td><td><a  onclick='save("+value.m_id+","+i+","+value.ind_des_id+")'><span style='color:green;' class='glyphicon glyphicon-floppy-disk'></span></a></td></tr>";
									$('#ind-des tbody').append(r);
									i++;
									
							});
													
						}
						
						
					});
						
					return false;
						});
			
	
  });
  
    
  function save(mid,row,ind_des_id)
  {
	  var amt=$('#amount-'+row).val();
	  var sqty1=$('#sqty-'+row).val();
	 // alert("M="+mid);
	  //alert("I="+ind_des_id);
	  $.ajax({
						url:'<?php echo site_url('healthcenter/add_indent/ind_update') ?>',
						type:"POST",
						data:{"m_id":mid,"ind_qty":sqty1,"app_cost":amt,"ind_des_id":ind_des_id},
						success:function(data){
							//var json = $.parseJSON(data);
							if(data !='0'){
							//
							$("#"+data+"-"+row).css('background-color','#FEC7C8');
							$("#"+data+"-"+row).attr('title','Provide Input');
							$("#"+data+"-"+row).tooltip();
							}else{
								$('#qty-'+row).css('background-color','#C3CFDB');
								$('#qty-'+row).attr("disabled", "disabled"); 
								
							}
						}
					});
	  
	  
							
  }
  function calc(id)
		{
			//alert(id);
			
			
			$('#amount-'+id).val($('#ind_rate-'+id).val()*$('#sqty-'+id).val());
			
			$('#amount-'+id).attr("disabled", "disabled"); 
			
		}
		
		function del(id){
			
			if(confirm("Do You want to Delete this Record"))
			{
				$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/add_indent/desc_delete/"+id,
					 success: function()
						{
						  $('#t_'+id).remove();
						}
				});
										
					
					
			}
		}
  
 </script>

