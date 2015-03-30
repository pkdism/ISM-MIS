/**
 * Created by samsidx on 19/3/15.
 */
$(function () {

   $('#leave_table_container').hide();

   $('#leave_type_cancel').on('change', function () {
      var leave_type = $(this).val();
      if (leave_type !== '$') {
          $.ajax({
              url: site_url('leave/leave_cancel_ajax/fetch_leaves/' + leave_type),
              success: function (response) {
                $('#leave_table_container').show();
                $('#leave_to_cancel_table').html(response);
              }
          });
      } else {
          $('#leave_table_container').hide();
      }
   });

});