<script>
$('.marque_article_id').select2({
    placeholder: 'Selectionnez une Marque',
    ajax: {
      url: '/marquearticles.softget',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
                return {
                    text: item.nom,
                    id: item.id
                }
            })
        };
      },
      cache: true
    }
  });
</script>
