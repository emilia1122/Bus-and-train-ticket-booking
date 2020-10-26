$(function() {
  $('#datetimepicker7').datetimepicker({
    useCurrent: true,
    format: 'MM/DD/YYYY',

  });
  $('#datetimepicker8').datetimepicker({
    useCurrent: false,
    format: 'MM/DD/YYYY'
  });
  $("#datetimepicker7").on("change.datetimepicker", function(e) {//Triggered when the underlying value of a DateTimePicker is changed
    $('#datetimepicker8').datetimepicker('maxDate', e.date);
  });
  $("#datetimepicker8").on("change.datetimepicker", function(e) {
    $('#datetimepicker7').datetimepicker('minDate', e.date);
  });
});
