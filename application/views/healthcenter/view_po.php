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
		
	
	<h2 class="page-header">Purchase Order Details </h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Purchase Order Ref. No.</td>
		<td>P.O Date.</td>
		<td>Indent Ref. No.</td>
		<td>Supplier</td>
		<th>Action</th>
		
		
		</tr>
		</thead>
		<tbody>
		<?php ; foreach($show_list as $b){ 
		
		?>
		<tr>
									
									
									
									<td><?php echo strtoupper($b->po_refno); ?></td>
									
									<td> <?php echo date('d M Y', strtotime($b->po_date)); ?></td>
									<td><?php echo strtoupper($b->indent_ref_no); ?></td>
									<td><?php echo strtoupper($b->s_name); ?></td>
									<td><a class="btn btn-primary" data-toggle="modal" value="<?php echo $b->po_id; ?>" id="rv" onclick="my_fungen('<?php echo $b->po_id; ?>')" data-target="#viewreport"  >View Details</a></td>
									
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
<div class="modal fade" tableindex="-1" role="dialog" aria-hidden="true" id="viewreport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Purchase Order Details</h3>
				</div>
				<div class="modal-body">
				<div id="reportresult">
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});

function my_fungen(id)
{
	
	//alert(id);
	//window.open("<?Php echo base_url(); ?>index.php/student_view_report/reports/viewtest/"+id,"_blank","toolbar=no, scrollbar=yes, width=800 height=600, top=50, left=100" );
	$.ajax({
		url: "<?Php echo base_url(); ?>index.php/healthcenter/add_purchase_order/viewpo/",
		data:{"id":id},
		type:"GET",
		success: function(data){
			//alert("data");
			$('#reportresult').html(data);
		}
	})

}
</script>

