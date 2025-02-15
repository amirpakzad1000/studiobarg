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
                            نقش های کاربری
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-wrap justify-content-between">
        @include('RolePermissions::create')
        <div class="card-box mb-30 pt-20 col-md-7 ml-md-4">
            <h4 class="text-center"> لیست نقش ها</h4>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th class="table-plus datatable-nosort">نام نقش</th>
                        <td> --</td>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td class="table-plus">{{ $role->name }}</td>
                            <td>
                                <ul>
                                    @foreach($role->permissions as $permission)
                                        <li>@lang($permission->name)</li>
                                    @endforeach
                                </ul>
                            </td>
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

                                        <a class="dropdown-item" href="{{ route('role-permissions.edit',$role->id) }}"
                                        ><i class="dw dw-edit2"></i> Edit</a>

                                        <a class="dropdown-item" onclick="
                                        deleteItem(event,'{{ route('role-permissions.destroy',$role->id) }}')" href="#">
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

