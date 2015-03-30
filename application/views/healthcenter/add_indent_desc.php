<?php echo form_open('healthcenter/add_indent/insert_desc',array("id"=>"indent",)); ?>

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
					<h3 class="box-title">Enter Indent Details</h3>
				</div>
				<div class="box-body">
				
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="indrefno">Choose Medicine</label>
							<?php echo form_input(array('name'=>'m_name','id'=>'m_id','placeholder'=>'Medicine Name','class'=>'form-control ',)) ?>
							
						</div>
						<?php echo form_hidden('indId',$ind_id)?>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Present Stock</label>
							<?php echo form_input(array('name'=>'p_stock','id'=>'p_stock','disabled'=>"disabled",'class'=>'form-control',)) ?>
							<?php echo form_hidden('mh_id'); ?>
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
							<label for="address1">Manufacturer Company</label>
							<?php echo form_input(array('name'=>'mfgco','id'=>'mfgco','disabled'=>"disabled",'class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Stdandard Packet</label>
							<?php echo form_input(array('name'=>'std_pkt','id'=>'std_pkt','placeholder'=>'Standard Packet ','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address1">Approx Rate</label>
							<?php echo form_input(array('name'=>'app_rate','id'=>'app_rate','placeholder'=>'Approx. Rate ','class'=>'form-control','style'=>'text-align:right;')) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address2">Qtantitiy</label>
							<?php echo form_input(array('name'=>'m_quantity','id'=>'m_quantity','placeholder'=>'Quantity','class'=>'form-control',)) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="address2">Approx Cost</label>
							<?php echo form_input(array('name'=>'app_cost','id'=>'app_cost','placeholder'=>'Approx. Cost','disabled'=>'disabled','class'=>'form-control','style'=>'text-align:right;')) ?>
						</div>
					</div>
			
			</div>
			
				<div class="box-footer">
				<?php  echo form_submit('submit','Submit','class="btn btn-primary"'); ?>
				</div>
			
			</div>
		</div>
	
	<h2 class="page-header">Indent  Items</h2>
		<table class="table table-bordered table-striped" id="ind-des">
		<thead>
		<tr>
		<td>Name of Medicine</td>
		<td>Pr. Stock</td>
		<td>Group</td>
		<td>MFG. Co.</td>
		<td>Std. Pack</td>
		<td>Approx.Rate</td>
		<td>Qty. Req</td>
		<td>Approx. Cost</td>
		<td>Action</td>
		</tr>
		</thead>
		<tbody>
		
		</tbody>
		</tbody>
		</tbody>
		</tbody>
		</table>
	
	</div>
</div>

<?php echo form_close(); ?>
<div class="suggestMed">
<ul id="Med">
</ul>
</div>
<style>
.suggestMed{ position:absolute;
			bottom:0;
			right:10px;
			border: 1px solid #000;
			padding:8px;
			background-color:#FFF;
}


 .ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}
</style>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<style>
	label.error { width: 250px; display: inline; color: red;}
	clear: both;
	</style>
<script type="text/javascript">
	$(function(){
		
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
	// Disable Button-----
		
		
		
	//----------End of disable button
		
		
		$('input[type="submit"]').attr('disabled','disabled');
					
					$("#std_pkt").on('focusout',function(){
						if ($("#std_pkt").val() <=0) {
							setTimeout(function() {
								alert("Please Provide Input")
								$("#std_pkt").css('background-color', '#F4977B');
								$("#std_pkt").css('color', '#FFFFFF');
							}, 100);
							return false;
						}
						
					});
					$("#app_rate").on('focusout',function(){
						if ($("#app_rate").val() <=0) {
							setTimeout(function() {
								alert("Please Provide Input")
								$("#app_rate").css('background-color', '#F4977B');
								$("#app_rate").css('color', '#FFFFFF');
							}, 100);
							return false;
						}
						
						
					});
					$("#m_quantity").on('focusout',function(){
						if ($("#m_quantity").val() <=0) {
							setTimeout(function() {
								alert("Please Provide Input")
								$("#m_quantity").css('background-color', '#F4977B');
								$("#m_quantity").css('color', '#FFFFFF');
							}, 100);
							return false;
						}
						else{
							$('input[type="submit"]').removeAttr('disabled');
						}
					});
					
	$("#m_id").focusin(function() {
			$('input[type="submit"]').attr('disabled','disabled')
	});
	//---------------------------Fetching medicine name and other based on Medicine ID---------------
	$('#m_id').on('focusout',function(){
	
		
		$.ajax({
				type: "GET",
				dataType: "text",
				url:"<?php echo base_url() ?>index.php/healthcenter/add_indent/getMedicineA/",
				data:{"mid":$("#m_id").val()},
                             
							 success:function(data){
                                 //var JSONArray = $.parseJSON(data);
								// alert(data);
								 var json = $.parseJSON(data);
								 $("input[name=mh_id]").val(json.med_d[0].m_id);
								 $("#p_stock").val(json.med_d[0].c_stock);
								 $("#group").val(json.med_d[0].m_group);
								 $("#mfgco").val(json.med_d[0].manu_name);
								 $('#Med').html('');
								 $.each(json.suggest, function(key,val){
									 r= '<li>'+val.m_name+","+val.c_stock+'</li>';
									 $('#Med').append(r);
								 });
	
                              }
		});
		
		
	});
	//---------------------End of Fetching medicine------------------------------------


   	//-----------------------------------Logic to show data in table start----------------------------------
	
		
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
							$("#m_id,#mh_id,#std_pkt,#app_rate,#m_quantity,#m_name,#p_stock,#group,#mfgco,#app_cost").val("");
							$("#m_id").focus();
							
						}
						
						
					});
						return false;
						
						});
					
						
						
					//form.submit();
			
	
	//----------------------------Logic to show data in table end------------------------------------
	
	//------------------------delete row start----------------------------------
	
	//------------------------delete row end-----------------------------------------
	
	});
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
	


