<script>
$('.departement_id').select2({
    placeholder: 'Selectionnez un Département',
    ajax: {
      url: '/departements.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.chemin_complet,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
