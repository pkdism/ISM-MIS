
<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
						
		
	
	<h2 class="page-header">Financial Year Budget</h2>
		<table class="table table-bordered table-striped" id="fy_show">
		<thead>
		<tr>
		<td>Financial Year</td>
		<td>Budget</td>
		<td>Date of Budget</td>
		<td>Group A Limit</td>
		<td>Group B Limit</td>
		<td>Action</td>
		
		
		
		</tr>
		</thead>
		<tbody>
		<?php $i=1; foreach($fy_list as $b){ 
		$syear=$b->curr_fin_year;
		$eyear=$syear+1;
		
		?>
		<tr id="row-<?php echo $b->budget_id; ?>">
																	
									<td><?php echo strtoupper($syear."-".$eyear); ?></td>
									<td><?php echo strtoupper($b->budget); ?></td>
									<td><?php echo date('d M Y', strtotime($b->bud_date)); ?></td>
									<td><?php echo strtoupper($b->b_groupA); ?></td>
									<td><?php echo strtoupper($b->b_groupB); ?></td>
									<td><a class="btn btn-primary" data-toggle="modal" value="<?php echo $b->budget_id; ?>" id="rv" onclick="my_fun_edit('<?php echo $b->budget_id; ?>')" data-target="#viewreport"  >Edit</a>
									
									<a class="btn btn-primary" value="<?php echo $b->budget_id; ?>" id="rdel" onclick="my_fun_del('<?php echo $b->budget_id; ?>')"  >Delete</a>
									
									</td>
									
					
									
								</tr>
								<?php $i++; } ?>
		</tbody>
		
		</table>
	
	</div>
	
</div>
</div>
<div class="modal fade" tableindex="-1" role="dialog" aria-hidden="true" id="viewreport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Edit Budget</h3>
				</div>
				<div class="modal-body">
				<div id="reportresult">
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#viewreport .modal-dialog
{
  width: 70%;
  height: 80% !important;
	
}


</style>
<script type="text/javascript">

function my_fun_edit(id)
{
	
	//alert(id);
	$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/add_finyear/budget_show/"+id,
					 success: function(data)
						{
								//alert("Hello");
								$('#reportresult').html(data);
						}
				});
		
}

function my_fun_del(id)
{
	//var $row = $(this).parent().parent();
	//var rowid = id;  
	//alert(rowid);
	
	if(confirm("Do You want to Delete this Record"))
	{
		
		$.ajax({
					url: "<?Php echo base_url(); ?>index.php/healthcenter/add_finyear/budget_delete/"+id,
					 success: function()
						{
								$('#row-'+id).remove();	
						}
				});
		
		
		
    }
}

</script>

<script>
$(function(){
	
	$('#fy_show').dataTable(); 
	

	
});
</script>
