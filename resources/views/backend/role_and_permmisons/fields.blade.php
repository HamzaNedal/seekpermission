{{-- 


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('roleAndPermmisons.index') }}" class="btn btn-default">Cancel</a>
</div> --}}

<div class="card-body">
    <div class="form-group">
        <label>role</label>
        {{-- <select class="form-control" name="role" id="role"> --}}
            @isset($role)
                {{-- <label>{{  $role->name }}</label>     --}}
                <input type="text" class="form-control" value="{{ $role->name }}" disabled="">
                <input class="form-control" type="hidden"  name='role' value="{{ $role->id }}" >
             @else
                <input class="form-control" type="text"  name='role'>
            @endisset

        {{-- </select> --}}
    </div>
    <div class="form-group" id="permissions">
        <label>permissions</label>
        @foreach ($permissions as $permission)

        <div class="form-check">
            <input class="form-check-input" type="checkbox"  name='permission[]' value="{{ $permission->name }}" 
           @isset($role)
               @if ($role->permissions)
                   @foreach ($role->permissions as $permission1)
                       @if ($permission->name == $permission1->name)
                                {{ "checked" }}
                       @endif
                   @endforeach
               @endif
           @endisset
            >
            <label class="form-check-label">{{ $permission->name }}</label>
        </div>
        @endforeach
       
      </div>
</div>
<!-- /.card-body -->

<div class="card-footer">
  <button type="submit" class="btn btn-primary">حفظ</button>
</div>
