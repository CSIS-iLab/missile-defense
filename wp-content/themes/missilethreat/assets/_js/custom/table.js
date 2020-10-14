jQuery(document).ready(function ($) {
  $('#missileTable').DataTable({
    "paging": false,
    "info": false,
    "order": [],
    "searching": false
  });
  $('#missileTable_filter input').removeClass('input-sm');
});