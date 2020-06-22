<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="form-group row {{ $errors->has('roles') ? 'has-error' : '' }}">
            <label class="col-form-label col-md-2" for="roles">Role(s)</label>
            <div class="col-sm-10">
              <select class="form-control" name="roles[]" id="role" style="width:100%" multiple="multiple">
                @if(isset($selectedroles))
                 @forelse ($selectedroles ?? '' as $id => $display)
                    <option value="{{ $id }}" selected>{{ $display }}</option>
                 @empty
                 @endforelse
                @endif
              </select>
              <small class="text-danger">{{ $errors->has('roles') ? $errors->first('roles') : '' }}</small>
            </div>
        </div>

    </div>
</div>
