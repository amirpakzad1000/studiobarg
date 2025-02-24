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
                            مقاله ها
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-wrap justify-content-between">
        <div class="card-box mb-30 pt-20 col-md-12">
            <h4 class="text-center"> لیست مقاله ها</h4>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>تصویر</th>
                        <th class="table-plus datatable-nosort">عنوان</th>
                        <th>دسته بندی مقاله</th>
                        <th>نوع مقاله</th>
                        <th>وضعیت تایید</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
            @foreach($articles as $article)
                        <tr>
                            <th>{{ $article->id }}</th>
                            <td>
                                @if($article->getFirstMediaUrl('article'))
                                    <img src="{{ $article->getFirstMediaUrl('article', 'thumb') ??
                                     asset('images/default-image.jpg') }}" alt="Course Banner">
                                @else
                                    <p>No image available</p>
                                @endif
                            </td>
                            <td class="table-plus">{{ $article->title }}</td>
                            <td>@lang($article->category->title)</td>
                            <td class="status">@lang($article->type)</td>
                            <td class="status">@lang($article->status)</td>
                            <td class="confirmation_status"></td>
                            <td>
                                <div class="dropdown">
                                    <a
                                        class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> مشاهده</a>
                                        <a class="dropdown-item" href="{{ route('articles.edit',$article->id) }}"
                                        ><i class="dw dw-edit2"></i> Edit</a>

                                        <a class="dropdown-item"
                                           onclick="deleteItem(event,'{{ route('articles.destroy',$article->id) }}')"
                                           href="#">
                                            <i class="dw dw-delete-3"></i> حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

