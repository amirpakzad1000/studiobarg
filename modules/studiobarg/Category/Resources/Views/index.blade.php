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
                            دسته بندی ها
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-wrap justify-content-between">
        @include('Category::create')
        <div class="card-box mb-30 pt-20 col-md-7 ml-md-4">
            <h4 class="text-center"> لیست دسنه بندی ها</h4>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th class="table-plus datatable-nosort">نام دسته بندی</th>
                        <th>والد دسته</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td class="table-plus">{{ $category->title }}</td>
                            <td>{{ $category->parent }}</td>
                            <td>
                                <div class="dropdown">
                                    <a
                                        class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-toggle="dropdown"
                                    >
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
                                    >
                                        <a class="dropdown-item" href="#"
                                        ><i class="dw dw-eye"></i> View</a
                                        >
                                        <a class="dropdown-item" href="{{ route('categories.edit',$category->id) }}"
                                        ><i class="dw dw-edit2"></i> Edit</a>

                                        <a class="dropdown-item" onclick="event.preventDefault(),
                                        deleteItem(event,'{{ route('categories.destroy',$category->id) }}')" href="#">
                                            <i class="dw dw-delete-3"></i> Delete</a>
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
@push('js')
    <script src="{{asset('vendors/scripts/jquery.toaster.js')}}"></script>
    <script>
        function deleteItem(event, route) {
            if (confirm('آیا از این عملیات مطمئن هستید؟')) {
                $.post(route, {_method: "delete", _token: '{{csrf_token()}}'})
                    .done(function (response) {
                        event.target.closest('tr').remove();
                        $.toaster({
                            heading: 'عملیات موفق',
                            title: 'پیام',
                            message: response.message || 'عملیات با موفقیت انجام شد.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    })

                    .fail(function (response) {
                        let errorMessage = response.responseJSON ? response.responseJSON.message : 'خطای ناشناخته رخ داده است!';
                        $.toaster({
                            heading: 'خطا!',
                            message: errorMessage,
                            showHideTransition: 'fade',
                            icon: 'error',
                            position: 'top-right'
                        });
                    })
            }
        }
    </script>
@endpush
