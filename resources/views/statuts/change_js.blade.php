<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var model_id = $(this).data('id');
        var model_table = $(this).data('tablename');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/statuts.change',
            data: {'status': status, 'model_id': model_id, 'model_table': model_table},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
