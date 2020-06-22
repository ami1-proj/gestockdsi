<script>
$(document).ready(function() {
  /**
   * for showing create fonctionemploye popup
   */

  $(document).on('click', "#create-fonctionemploye", function() {
    $(this).addClass('create-fonctionemploye-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#create-modal').modal(options)
  })

  // on modal show
  $('#create-modal').on('show.bs.modal', function() {
    var el = $(".create-fonctionemploye-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('fonctionemploye-id');
    var intitule = row.children(".intitule").text();
    var description = row.children(".description").text();

    // fill the data in the input fields
    $("#modal-input-id").val(id);
    $("#modal-input-intitule").val(intitule);
    $("#modal-input-description").val(description);

  })

  // on modal hide
  $('#create-modal').on('hide.bs.modal', function() {
    $('.create-fonctionemploye-trigger-clicked').removeClass('create-fonctionemploye-trigger-clicked')
    $("#create-form").trigger("reset");
  })

  $(document).on('submit', 'form#add_fonctionemployes_form', function (event) {

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
                $('#create-modal').modal('hide');
                var newdata = JSON.parse(data.newdata);
                var select = document.getElementById('fonction_employe_id');
                var opt = document.createElement('option');
                opt.value = newdata.id;
                opt.innerHTML = newdata.intitule;
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
