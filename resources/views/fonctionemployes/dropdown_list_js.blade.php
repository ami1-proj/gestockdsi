<script>
$('.fonction_employe_id').select2({
    placeholder: 'Selectionner une Fonction',
    ajax: {
      url: '/fonctionemployes.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.intitule,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
