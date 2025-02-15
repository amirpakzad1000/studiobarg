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
                            <a href="{{ route('courses.index') }}">دوره ها</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            ایجاد دوره
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="pd-20 card-box mb-30 pt-20 col-md-12">
        <h4 class="text-center mb-2">افزودن دوره جدید</h4>
        <form action="{{ route('courses.store') }}" method="post"enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <x-input name="title" type="text" placeholder="عنوان دوره" value="" required/>
            </div>
            <div class="form-group">
                <x-input name="slug" type="text" placeholder="عنوان انگلیسی" value="" required/>
            </div>

            <div class="form-group">
                <div class="col-md-12 d-flex p-0">
                    <div class="col-md-4 pr-0">
                        <div class="form-group">
                            <x-input name="priority" type="number" placeholder="ردیف دوره" class="form-control"
                                     value="" required/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <x-input name="price" type="number" placeholder="مبلغ دوره" value="" required/>
                        </div>
                    </div>
                    <div class="col-md-4 pl-0">
                        <div class="form-group">
                            <x-input name="percent" type="number" placeholder="درصد مدرس" value="" required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="d-block">تگ ها</label>
                <x-tagselect multiple="" name="tags" data-role="tagsinput" style="display: none;">
                    <option class="mb-3" value="Amsterdam" selected="selected">Amsterdam</option>
                </x-tagselect>
            </div>

            <div class="form-group">
                <x-select
                    class="custom-select2"
                    name="teacher_id"
                    style="width: 100%; height: 38px">
                    <option value="">انتخاب مدرس</option>
                    @foreach($teachers as $teacher)
                        <option class="mb-3" value="{{ $teacher->id }}"
                                @if($teacher->id == old('teacher_id')) selected @endif>
                            {{ $teacher->name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="form-group">
                <x-select
                    name="type"
                    style="width: 100%; height: 38px">
                    <option value="">نوع دوره</option>
                    @foreach(Course::$types as $type)
                        <option class="mb-2" value="{{ $type }}"
                        @if($type == old('type')) selected @endif>
                            @lang($type)</option>
                    @endforeach
                </x-select>
            </div>

            <div class="form-group">
                <x-select name="status" class="w-full h-[38px]">
                    <option value="" disabled selected>وضعیت دوره</option>
                    @foreach(Course::$statuses as $status)
                        <option class="mb-2" value="{{ $status }}">
                            {{ __($status) }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="form-group">
                <x-select
                    name="category_id"
                    style="width: 100%; height: 38px">
                    <option value="">دسته بندی دوره</option>
                    @foreach($categories as $category)
                        <option class="mb-2" value="{{ $category->id }}" @if($category->id == old('category_id'))
                            selected @endif>{{ $category->title }}</option>
                    @endforeach
                </x-select>
            </div>

            <div class="form-group">
                <x-file name="banner_id" placeholder="بنر دوره"/>
            </div>

            <div class="form-group">
                <x-textarea placeholder="توضیحات دوره" name="description" id="" cols="30" rows="10"/>
            </div>

            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>

    </div>
@endsection
@push('js')
    <script src="{{asset('/vendors/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
@endpush
