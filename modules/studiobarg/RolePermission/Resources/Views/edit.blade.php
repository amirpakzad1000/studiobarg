@extends('Dashboard::master')
@section('breadcrumb')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">پیشخوان</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{ route('role-permissions.index') }}">نقش کاربری</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            ویرایش نقش کاربری
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="pd-20 card-box mb-30 pt-20 col-md-8">
        <h4 class="text-center"> <strong style="color: #0a58ca">{{ $role->name }}</strong> :ویرایش نقش </h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('role-permissions.update',$role->id) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $role->id }}">
            <div class="form-group">
                <label>نام نقش کاربری</label>
                <input class="form-control" name="name" type="text" value="{{ $role->name }}" required
                       placeholder="نام نقش کاربری"/>
            </div>
            <div class="form-group">
                <label>انتخاب مجوزها</label>
                @foreach($permissions as $permission)
                    <div class="custom-control custom-checkbox mb-5">
                        <input type="checkbox" name="permissions[{{$permission->name}}]" value="{{$permission->name}}"
                               @if($role->hasPermissionTo($permission->name)) checked  @endif
                        class="custom-control-input" id="{{ 'permission'.$permission->id }}">
                        <label class="custom-control-label" for="{{ 'permission'.$permission->id }}">
                            @lang($permission->name) </label>
                    </div>
                @endforeach
                @error('permissions')
                <span class="alert-error mt-4">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit"> ذخیره تغییرات</button>
        </form>

    </div>
@endsection
