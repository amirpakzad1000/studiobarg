<div class="pd-20 card-box mb-30 pt-20 col-md-4">
    <h4 class="text-center">افزودن نقش کاربری جدید</h4>
    <form method="post" action="{{ route('role-permissions.store') }}">
        @csrf
        <div class="form-group">
            <label>نام نقش کاربری</label>
            <input class="form-control" name="name" type="text" required value="{{ old('name') }}" placeholder="نام نقش کاربری"/>
            @error('name')
            <span class="alert-error mt-4">{{ $message }}</span>
            @enderror
        </div>

      <div class="form-group">
            <label>مجوزها</label>
          @foreach($permissions as $permission)
          <div class="custom-control custom-checkbox mb-5">
              <input type="checkbox" name="permissions[{{$permission->name}}]" value="{{$permission->name}}"
                     @if(is_array(old('permissions')) && array_key_exists($permission->name, old('permissions'))) checked  @endif
                     class="custom-control-input" id="{{ 'permission'.$permission->id }}">
              <label class="custom-control-label" for="{{ 'permission'.$permission->id }}">
                  @lang($permission->name) </label>
          </div>
          @endforeach
          @error('permissions')
          <span class="alert-error mt-4">{{ $message }}</span>
          @enderror
        </div>
        <button class="btn btn-primary" type="submit">ذخیره</button>
    </form>

</div>
