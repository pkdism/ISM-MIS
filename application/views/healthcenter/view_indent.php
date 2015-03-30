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
		
	
	<h2 class="page-header">Indent Details</h2>
	
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Indent Ref.No</td>
		<td>Date</td>
		<td>Supplier Name</td>
		<td>Indent Type</td>
		<th>Action</th>
		
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		
		?>
		<tr>
									
									
									
									<td><?php echo strtoupper($b->indent_ref_no); ?></td>
									<td><?php echo date('d M Y', strtotime($b->indent_date)); ?></td>
									<td><?php echo strtoupper($b->s_name); ?></td>
									<td><?php 
											if(($b->ind_type)=='e')
												$itype="Emergency";
											else
												$itype="Normal";
									
									echo strtoupper($itype); ?></td>
									<td><a class="btn btn-primary" data-toggle="modal" value="<?php echo $b->indent_id; ?>" id="rv" onclick="my_fungen('<?php echo $b->indent_id; ?>')" data-target="#viewreport"  >View Details</a></td>
									
									
									
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
				<h3 id="myModalLabel">Indent Details</h3>
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
		url: "<?Php echo base_url(); ?>index.php/healthcenter/add_indent/viewindent/",
		data:{"id":id},
		type:"GET",
		success: function(data){
			//alert("data");
			$('#reportresult').html(data);
		}
	})

}


</script>

