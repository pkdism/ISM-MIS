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
		
	
	<h2 class="page-header">Expiry  Date Report</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Manufacturer Name</td>
		<td>Supplied Date</td>
		<td>Mfg. Date</td>
		<td>Exp. Date</td>
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
									<td><?php echo date('d M Y', strtotime($b->mfg_date)); ?></td>
									<td><?php echo date('d M Y', strtotime($b->exp_date)); ?></td>
									
									<td><?php echo ($b->mrec_qty); ?></td>
									
									
									
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

