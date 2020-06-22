<script>

/**
 * Fired when the select all checkboxe is checked
 * @var
 */
$('.selectAllChbx').on('change', function() {
  	if(this.checked){
    	$('.selectOneChbx').prop('checked', true);
  	}else{
  		$('.selectOneChbx').prop('checked', false);
  	}
    enaDesaSubmit();
});

/**
 * Fired when a select one checkboxe is checked
 * @var 
 */
$('.selectOneChbx').on('change', function() {
  enaDesaSubmit();
  checkSelectAll();
});

/**
 * Enable or desable the submit buttons
 * @return void
 */
function enaDesaSubmit() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"].selectOneChbx');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);

    // First we desable the two submit buttons
    document.getElementById("form_submit_restore").disabled = true;
    document.getElementById("form_submit_delete").disabled = true;
    if (checkedOne) {
      // We enable the two submit buttons as there is at least one checkboxe (with selectOneChbx class) checked
      document.getElementById("form_submit_restore").disabled = false;
      document.getElementById("form_submit_delete").disabled = false;
    }
}

/**
 * Check or uncheck the selec all checkboxe
 * @return void
 */
function checkSelectAll() {

    if (document.querySelectorAll('input[type="checkbox"].selectOneChbx:checked').length === document.querySelectorAll('input[type="checkbox"].selectOneChbx').length) {
        // All checkboxes (with selectOneChbx class) are checked
        $('.selectAllChbx').prop('checked', true);
    } else {
        // Some checkboxes (with selectOneChbx class) are not checked
        $('.selectAllChbx').prop('checked', false);
    }
}
</script>
