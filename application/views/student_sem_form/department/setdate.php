
<div class="row">

<div class="col-md-6 col-md-offset-3">	
 <?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	<?php echo form_open_multipart('student_sem_form/date'); ?>
	<div class="box box-solid box-primary"> 
	
		<div class="box-header">
			<h3 class="box-title">Set Date For Regration From</h3>
		</div> 
		<div class="box-body">
      
     <div class="row">
       <div class="col-md-6">
		<div class="form-group">
        <label for="sessionYear">Session Year</label>
        <?php echo form_dropdown('session',array(""=>"Select","2015"=>'2015 - 2016','2016'=>'2016 - 2017'),'','id="session" class="form-control"'); ?>
        </div>
        </div>
        
        <div class="col-md-6">
		<div class="form-group">
        <label for="season">Season</label>
        <?php echo form_dropdown('season',array(""=>"Select","M"=>'Monsoon','W'=>'Winter','S'=>'Summer'),'','id="session" class="form-control"'); ?>
        </div>
        </div>
        
         <div class="col-md-6">
		<div class="form-group">
        <label for="startDate">Start Date</label>
        <?php 
	echo form_input(array('name'=>'stdate','id'=>'stdate','value'=>
	date('d M Y',strtotime($sdate[0]->opendate)),'placeholder'=>'Start Date','class'=>'form-control','data-date-format'=>'d M yy')) ?>
    <?php echo form_hidden('osd',date('d M Y',strtotime($sdate[0]->opendate)) ) ?>
        </div>
        </div>
        
        <div class="col-md-6">
		<div class="form-group">
        <label for="endDate">End Date</label>
       <?php echo form_input(array('name'=>'eddate','id'=>'eddate','value'=>date('d M Y',strtotime($sdate[0]->closedate)),'placeholder'=>'End Date','class'=>'form-control','data-date-format'=>'dd M yy')) ?>
        <?php echo form_hidden('ocd',date('d M Y',strtotime($sdate[0]->closedate))) ?>
        </div>
        </div>
        
        <div class="col-md-6">
		<div class="form-group">
        <label for="type">Type</label>
      <?php echo form_dropdown('type',array(""=>"Select","1"=>'Normal','2'=>'With Late Fee'),'','id="type" class="form-control"'); ?>
        </div>
        </div>
        
        <div class="col-md-6" id="re" style="display:none;">
		<div class="form-group">
        <label for="Remark">Remark</label>
      <?php echo form_textarea(array('name'=>'remark','id'=>'remark','placeholder'=>'Remark','class'=>'form-control','style'=>'height:50px;')) ?>
        </div>
        </div>
       
   </div>
    <div class="box-footer">
    <?php echo form_submit('submit','Set Date','class="btn btn-primary"'); ?></td>
	</div>

</div>
<?php echo form_close(); ?>
</div>
</div>

</div>
 <script>
$(function() {
$( "#stdate" ).datepicker({

onClose: function( selectedDate ) {
$( "#eddate" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#eddate" ).datepicker({

onClose: function( selectedDate ) {
$( "#stdate" ).datepicker( "option", "maxDate", selectedDate );
}
});
$('#type').change(function(){
		if($(this).val() == 2){
				$('#re').show();
			}else{
				$('#re').hide();
				}
	});
});
</script>