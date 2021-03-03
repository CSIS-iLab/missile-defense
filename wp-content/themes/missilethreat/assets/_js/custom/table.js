jQuery(document).ready(function ($) {
  if ($('#missileTable').length) {
    $('#missileTable').DataTable({
      "paging": false,
      "info": false,
      "order": [],
      "searching": false
    });
    $('#missileTable_filter input').removeClass('input-sm');
  }
});