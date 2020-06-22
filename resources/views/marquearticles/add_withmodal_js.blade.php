<script>
$(document).ready(function() {
  /**
   * for showing create marquearticle popup
   */

  $(document).on('click', "#create-marquearticle", function() {
    $(this).addClass('create-marquearticle-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#create-marquearticle-modal').modal(options)
  })

  // on modal show
  $('#create-marquearticle-modal').on('show.bs.modal', function() {
    var el = $(".create-marquearticle-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('marquearticle-id');
    var nom = row.children(".nom").text();

    // fill the data in the input fields
    $("#modal-input-nom").val(nom);

  })

  // on modal hide
  $('#create-marquearticle-modal').on('hide.bs.modal', function() {
    $('.create-marquearticle-trigger-clicked').removeClass('create-marquearticle-trigger-clicked')
    $("#create-form").trigger("reset");
  })

  $(document).on('submit', 'form#add_marquearticles_form', function (event) {

    event.preventDefault();
    var form = $(this);
    var data = new FormData($(this)[0]);
    var url = form.attr("action");

    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.is-invalid').removeClass('is-invalid');
            if (data.fail) {
                for (control in data.errors) {
                    $('input[name=' + control + ']').addClass('is-invalid');
                    $('#error-' + control).html(data.errors[control]);
                    console.log(data.errors[control])
                }
            } else {
                $('#create-marquearticle-modal').modal('hide');
                var newdata = JSON.parse(data.newdata);
                var select = document.getElementById('marque_article_id');
                var opt = document.createElement('option');
                opt.value = newdata.id;
                opt.innerHTML = newdata.nom;
                select.appendChild(opt);

                ajaxLoad(data.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
    return false;
  });

  function ajaxLoad(filename, content) {
      content = typeof content !== 'undefined' ? content : 'content';
      $('.loading').show();
      $.ajax({
          type: "GET",
          url: filename,
          contentType: false,
          success: function (data) {
              $("#" + content).html(data);
              $('.loading').hide();
          },
          error: function (xhr, status, error) {
              alert(xhr.responseText);
          }
      });
  }
})
</script>
