<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="form-group row {{ $errors->has('permissions') ? 'has-error' : '' }}">
            <!-- <label class="col-form-label col-md-2" for="permissions">Permission(s)</label> -->

            <div class="input-group form-inline mb-3">
              <label class="col-form-label form-control-sm" for="permissions">Permission(s)</label>
              <span class="input-group-append">
                @can('permission-select-all')
                <input type="checkbox" name="select_all" class="switch-input" value="1" {{ old('select_all') }}/>
                @endcan
              </span>
            </div>

            <div class="col-sm-10">
              <select class="form-control" name="permissions[]" id="permission" style="width:100%" multiple="multiple">
                @if(isset($selectedpermissions))
                 @forelse ($selectedpermissions ?? '' as $id => $display)
                    <option value="{{ $id }}" selected>{{ $display }}</option>
                 @empty
                 @endforelse
                @endif
              </select>
              <small class="text-danger">{{ $errors->has('permissions') ? $errors->first('permissions') : '' }}</small>
            </div>
        </div>

    </div>
</div>
