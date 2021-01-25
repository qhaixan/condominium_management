<script>
var defaultOption = '<option value="">Select One</option>'
var old_block = "{{ old('unit_block') ? old('unit_block') : (@$visitor->unit->unit_block? @$visitor->unit->unit_block: '') }}"
var old_unit = "{{ old('unit_number') ? old('unit_number') : (@$visitor->unit->unit_number? @$visitor->unit->unit_number: '') }}"
function getUnits() {
  var block = $('#block_select').val();
  
  $('#unit_select').html(defaultOption);
  $.get( "/api/unit_select/number", { block: block } )
  .done(function( data ) {
    for (var i = 0; i < data.length; i++) {
      $('#unit_select').append('<option value="'+data[i]+'" '+(old_unit==data[i]?'selected':'')+'>'+data[i]+'</option>');
    }
  });
}
$( document ).ready(function() {
  //fill block options
  $('#block_select').html(defaultOption);
  $.get( "/api/unit_select/block")
  .done(function( data ) {
    for (var i = 0; i < data.length; i++) {
      $('#block_select').append('<option value="'+data[i]+'" '+(old_block==data[i]?'selected':'')+'>'+data[i]+'</option>');
    }
    
    getUnits();
  });
  
  //fill unit options
  $('#block_select').change(function() {
    getUnits()
  });
});
</script>