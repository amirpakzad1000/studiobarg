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
                            <a href="{{ route('categories.index') }}">دسته بندی ها</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            ویرایش دسته بندی
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="pd-20 card-box mb-30 pt-20 col-md-8">
        <h4 class="text-center">افزودن دسته جدید</h4>
        <form method="post" action="{{ route('categories.update',$category->id) }}">
            @csrf
            @method('patch')
            <div class="form-group">
                <label>نام دسته</label>
                <input class="form-control" name="title" type="text" value="{{ $category->title }}" required
                       placeholder="نام دسته بندی"/>
            </div>
            <div class="form-group">
                <label>نام انگلیسی</label>
                <input class="form-control" name="slug" type="text" value="{{ $category->slug }}" required
                       placeholder="نام انگلیسی"/>
            </div>
            <div class="form-group">
                <label>دسته والد</label>
                <select class="custom-select form-control" id="parent_id" name="parent_id"
                        style="width: 100%; height: 38px">
                    <option value="">بدون والد</option>
                    @foreach($categories as $categoryItem)
                        <option value="{{ $categoryItem->id }}"
                                @if($categoryItem->id == $category->parent_id) selected @endif >{{ $categoryItem->title }}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label>توقیحات</label>
                <textarea class="form-control" name="description" placeholder="توضیحات دسته بندی"></textarea>
            </div>
            <div class="form-group">
                <label>تصویر</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="category_img"/>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">ذخیره</button>
        </form>

    </div>
@endsection
