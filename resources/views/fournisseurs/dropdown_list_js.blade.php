<script>
$('.fournisseur_id').select2({
    placeholder: 'Selectionnez un Fournisseur',
    ajax: {
      url: '/fournisseurs.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.raison_sociale,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
