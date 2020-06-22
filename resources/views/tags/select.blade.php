@extends('layouts.app')

@section('page')
  Numéros Téléphone
@endsection

@section('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <h1 style="font-size: 1.3rem;">Select2 load more function with laravel</h1>
            <hr/>
            <div class="form-group row required">

                <label for="tag" class="col-form-label col-md-2">Tag</label>
                <div class="col-md-6">

                    <select class="form-control" name="tag" id="tag" value="[]" style="width:100%">

                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tag').select2({
                ajax: {
                    url: '{{'select2-load-more'}}',
                    data: function (params) {
                        return {
                            search: params.term,
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
                                    text: item.name
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
                placeholder: 'Tags',
//                minimumInputLength: 2,
                multiple: true
            });
        });
    </script>
@endsection
