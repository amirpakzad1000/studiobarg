@php use studiobarg\Course\Models\Course; @endphp
@extends('Dashboard::master')
@push('style')
    <link rel="stylesheet" href="{{asset('/vendors/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endpush
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
                            <a href="{{ route('users.index') }}">کاربران</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            ویرایش کاربر
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="pd-20 card-box mb-30 pt-20 col-md-12">
        <h4 class="text-center mb-2">ویرایش کاربر</h4>
        <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-12">
                    <x-input name="name" type="text" placeholder="نام کاربر" value="{{ $user->name }}" required/>
                </div>
                <div class="form-group col-md-12">
                    <x-input name="email" type="text" placeholder="ایمیل کاربر" value="{{ $user->email }}" required/>
                </div>
                <div class="form-group col-md-12">
                    <x-input name="username" type="text" placeholder="نام کاربری" value="{{ $user->username }}" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md">
                    <x-input name="mobile" type="text" placeholder="موبایل" value="{{ $user->mobile }}"/>
                </div>
                <div class="form-group  col-md">
                    <x-input name="website" type="text" placeholder="وبسایت" value="{{ $user->website }}" />
                </div>
                <div class="form-group col-md">
                    <x-input name="instagram" type="text" placeholder="اینستاگرام" value="{{ $user->instagram }}" />
                </div>
                <div class="form-group col-md">
                    <x-input name="facebook" type="text" placeholder="فیسبوک" value="{{ $user->facebook }}" />
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md">
                    <x-input name="twitter" type="text" placeholder="توییتر" value="{{ $user->twitter }}" />
                </div>
                <div class="form-group col-md">
                    <x-input name="linkedin" type="text" placeholder="لینکدین" value="{{ $user->linkedin }}" />
                </div>

                <div class="form-group col-md">
                    <x-input name="github" type="text" placeholder="گیت هاب" value="{{ $user->github }}" />
                </div>

                <div class="form-group col-md">
                    <x-input name="youtube" type="text" placeholder="یوتیوب" value="{{ $user->youtube }}" />
                </div>
            </div>


            <div class="form-group">
                <x-select name="status" class="w-full h-[38px]">
                    <option value="" disabled selected>وضعیت کاربر</option>
                    @foreach(\studiobarg\User\Models\User::$statuses as $status)
                        <option class="mb-2" value="{{ $status }}" @if($status == $user->status) selected @endif>
                            {{ __($status) }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="form-group">
               <x-file name="profile-img" placeholder="عکس کاربر" value="{{ $user->getFirstMediaUrl('profile','thumb') }}"/>
            </div>
            <div class="form-group">
                <x-input name="new_password" type="password" placeholder="پسورد جدید"/>
            </div>

            <div class="form-group">
                <x-textarea placeholder="درباره کاربر" name="bio" id="" cols="30" rows="10"
                            value="{{$user->bio}}"/>
            </div>

            <button type="submit" class="btn btn-primary">بروزرسانی کاربر</button>
        </form>

    </div>
@endsection
@push('js')
    <script>
        @required('Common::layout.feedbacks')
    </script>
@endpush
