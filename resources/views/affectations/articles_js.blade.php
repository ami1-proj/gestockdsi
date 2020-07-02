<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#article').select2({
            ajax: {
                url: '{{'/selectmorearticles'}}',
                data: function (params) {
                    var affectation_id = document.getElementById('affectationid').value;
                    console.log('affectation_id: ',affectation_id);
                    return {
                        search: params.term,
                        affectationid: affectation_id,
                        page: params.page || 1
                    };
                },
                dataType: 'json',
                processResults: function (data) {
                    data.page = data.page || 1;
                    return {
                        results: data.items.map(function (item) {
                            return {
                                id: item.id,
                                text: item.reference_complete
                            };
                        }),
                        pagination: {
                            more: data.pagination
                        }
                    }
                },
                cache: true,
                delay: 250
            },
            placeholder: 'Articles',
//                minimumInputLength: 2,
            multiple: true
        });
    });
</script>
