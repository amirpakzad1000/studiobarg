@extends('Dashboard::master')
@push('style')
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
                            کاربران ها
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
            <h4 class="text-center"> لیست کاربران</h4>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>نام</th>
                        <th class="table-plus datatable-nosort">ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>وضعیت تایید</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{ $user->id }}</th>
                            <td class="table-plus">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="confirmation_status">
                                <ul>
                                    @foreach($user->roles as $userRole)
                                        <li class="deletable-item-list">
                                            <span class="inline-block">{{ $userRole->name }}</span>
                                            <a class="delete-item" type="submit" title="حذف" style="font-size: 10px"
                                               onclick="deleteItem(event, '{{ route('users.removeRole', ['user' => $user->id, 'role' => $userRole->name]) }}', 'li')">
                                                <i class="dw dw-delete-3"></i>
                                            </a>
                                        </li>
                                    @endforeach

                                    <a href="#select-role" class="btn-block" data-toggle="modal"
                                       data-target="#bd-example-modal-lg" type="button"
                                       onclick="setFormAction({{ $user->id }})">
                                        +
                                    </a>
                                </ul>
                            </td>
                            <td class="confirmation_status">
                                {{ $user->hasVerifiedEmail() ? "تایید شده" : "تایید نشده" }}
                            </td>
                            <td>
                                <div class="dropdown d-flex">
                                    <a class="pl-3"
                                       onclick="deleteItem(event,'{{route('users.destroy',$user->id)}}')"
                                       href="#" title="حذف">
                                        <i class="dw dw-delete-3"></i></a>
                                    <a
                                        href="{{route('users.edit',$user->id)}}" title="ویرایش">
                                        <i class="dw dw-edit2"></i></a>

                                    <a href="" class="mr-3" onclick="updateConfirmationStatus(event,
                                    '{{ route('users.manualVerify',$user->id) }}','آیا از تایید این عملیات مطمئن هستید؟','تایید شده')" title="تایید">
                                        <i class="dw dw-check"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="pd-20 card-box height-100-p">
        <h5 class="h4">Large modal</h5>
        <div
            class="modal fade bs-example-modal-lg"
            id="bd-example-modal-lg"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <form action="{{ route('users.addRole',0) }}" method="post" id="select-form-user">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="padding: 5px 10px;align-items: center">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                افزودن نقش کاربری
                            </h4>
                            <button
                                type="button"
                                style="margin: 0;border: 1px solid #ccc;border-radius: 100%;padding: 5px;"
                                class="close"
                                data-dismiss="modal"
                                aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label>Result</label>
                                <select class="form-control" name="role">
                                    <option>Select Result</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script>
        function setFormAction(userId) {
            $("#select-form-user").attr('action', '{{ route('users.addRole',0) }}'.replace('/0/', '/' + userId + '/'))
        }
        @include('Common::layouts.feedbacks')
    </script>
@endpush

