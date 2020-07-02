<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="form-group row {{ $errors->has('articles') ? 'has-error' : '' }}">

            <div class="input-group form-inline mb-3">
                <label class="col-form-label form-control-sm" for="articles">Article(s)</label>
            </div>

            <div class="col-sm-10">
                <select class="form-control" name="articles[]" id="article" style="width:100%" multiple="multiple">
                    @if(isset($selectedarticles))
                        @forelse ($selectedarticles ?? '' as $id => $display)
                            <option value="{{ $id }}" selected>{{ $display }}</option>
                        @empty
                        @endforelse
                    @endif
                </select>
                <small class="text-danger">{{ $errors->has('articles') ? $errors->first('articles') : '' }}</small>
            </div>
        </div>
        <input type="hidden" id="affectationid" value="{{$affectation->id}}"/>
    </div>
</div>

