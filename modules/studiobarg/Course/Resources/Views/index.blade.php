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
                            دوره ها
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
            <h4 class="text-center"> لیست دوره ها</h4>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>تصویر</th>
                        <th>ردیف</th>
                        <th class="table-plus datatable-nosort">عنوان</th>
                        <th>نوع دوره</th>
                        <th>درصد مدرس</th>
                        <th>وضعیت دوره</th>
                        <th>وضعیت تایید</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
            @foreach($courses as $course)
                        <tr>
                            <th>{{ $course->id }}</th>
                            <td>
                                @if($course->getFirstMediaUrl('images'))
                                    <img src="{{ $course->getFirstMediaUrl('images', 'thumb') ??
                                     asset('images/default-image.jpg') }}" alt="Course Banner">
                                @else
                                    <p>No image available</p>
                                @endif
                            </td>
                            <td>{{$course->priority}}</td>
                            <td class="table-plus">{{ $course->title }}</td>
                            <td>@lang($course->type)</td>
                            <td>%@lang($course->percent)</td>
                            <td class="status">@lang($course->status)</td>
                            <td class="confirmation_status">@lang($course->confirmation_status)</td>
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
                                        <a class="dropdown-item" href="{{ route('courses.edit',$course->id) }}"
                                        ><i class="dw dw-edit2"></i> Edit</a>

                                        <a class="dropdown-item"
                                           onclick="deleteItem(event,'{{ route('courses.destroy',$course->id) }}')"
                                           href="#">
                                            <i class="dw dw-delete-3"></i> حذف</a>

                                        <a class="dropdown-item" href=""
                                           onclick="updateConfirmationStatus(event, '{{ route('course.reject', $course->id) }}',
                                    'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')">
                                            <i class="dw dw-check"></i> تایید</a>

                                        <a class="dropdown-item" href=""
                                           onclick="updateConfirmationStatus(event,'{{ route('course.accept',
                                           $course->id)}}','آیا از رد این عملیات مطمئن هستید؟','رد شده')">
                                            <i class="dw dw-ban"></i> رد </a>

                                        <a class="dropdown-item" href=""
                                           onclick="updateConfirmationStatus(event,'{{ route('course.lock',
                                           $course->id)}}','آیا از قفل کردن این عملیات آیتم مطمئن هستید؟','قفل شده','قفل شده')">
                                            <i class="dw dw-ban"></i> قفل شده </a>
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

