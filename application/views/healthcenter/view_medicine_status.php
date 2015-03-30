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
		
	
	<h2 class="page-header">Medicine Status Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Manufacturer Name</td>
		<td>Rack No.</td>
		<td>Cabinet No.</td>
		<td>Stock</td>
		<td>Threshold</td>
		<td>Status</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		$st=( $b->c_stock + $this->medicine_model->getMrecQtyById($b->m_id)->mrec_qty);
		?>
		<tr>
									
									
									
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo ($b->rack_no); ?></td>
									<td><?php echo ($b->cabi_no); ?></td>
									<td><?php echo $st; ?></td>
									<td><?php echo ($b->threshold); ?></td>
									<?php if($st==($b->threshold))
									{
									?>
									<td><button type="button" class="btn btn-danger">Danger</button></td>
									<?php
									}
									?>
									<?php 
									$x=($st-($b->threshold));
									if( $st>($b->threshold)&&$x<=100 )
									{
									?>
									<td><button type="button" class="btn btn-warning">Warning</button></td>
									<?php
									}
									?>
									<?php 
									$x=($st-($b->threshold));
									if($x>=100)
									{
									?>
									<td><button type="button" class="btn btn-success">OK</button></td>
									<?php
									}
									?>
									
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

<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

