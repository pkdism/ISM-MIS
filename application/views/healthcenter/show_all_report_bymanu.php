<?php

if($show_details)
{
	?>
<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
	<div class="table-responsive">					
		<?Php 
		
		$manu_id = $this->input->post('manuDrp');
		
	
	if($manu_id=="0")
	{
		$msg1="All Manufacturer";
	}
	else{
		$nm=$this->supplier_model->get_manuName_byID($manu_id);
		//print_r($nm);
		$msg1=$nm[0]->manu_name;
		
	}
	?>
	
	<h2 class="page-header">Report of Manufacturer:-<?Php echo $msg1?><br><br></h2>
	
	
				
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Manufacturer Name</td>
		<td>Supplied Date</td>
		<td>Quantity</td>
		
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_details as $b){ 
		
		?>
		<tr>
									
									
									
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo date('d M Y', strtotime($b->supp_date)); ?></td>
									
									<td><?php echo strtoupper($b->mrec_qty); ?></td>
									
									
									
								</tr>
								<?php  } ?>
		</tbody>
		</tbody>
		</tbody>
		</tbody>
		</table>
	
	</div>
	</div>
	
</div>
</div>
<?php
}
else
{?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> Record Not Found
</div>


<?Php
}

?>
<style>
.group-item-expander{
	background-color: #aaa !important;
	color: #fff;
}
</style>
<script>
$(function(){
	
	$('#po_show').dataTable().rowGrouping({bExpandableGrouping: true,bHideGroupingColumn: false,sGroupingClass:'collapsed-group'}); 
	$('.group-item-expander').removeClass('expanded-group');
	$('.group-item').hide();
	

	
});
</script>

