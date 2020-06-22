<script>
$('.employe_id').select2({
    placeholder: 'Selectionnez un Employé',
    ajax: {
      url: '/employes.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.nom_complet,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
