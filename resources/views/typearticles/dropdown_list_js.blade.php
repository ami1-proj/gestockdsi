<script>
$('.type_article_id').select2({
    placeholder: 'Selectionnez un Type',
    ajax: {
      url: '/typearticles.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.libelle,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
