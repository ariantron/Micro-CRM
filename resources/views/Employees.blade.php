@extends('layouts.App')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('employees_management') }}</div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::get('success'))
                            <div class="alert alert-success mt-2" role="alert">
                                @lang('operation_successful')
                            </div>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::get('deleted'))
                            <div class="alert alert-danger mt-2" role="alert">
                                @lang('item_deleted')
                            </div>
                        @endif
                        <a href="{{route('employees.create')}}">
                            <button type="button" class="btn btn-primary mb-3">+ @lang('add_employee')</button>
                        </a>
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">@lang('id')</th>
                                <th scope="col">@lang('first_name')</th>
                                <th scope="col">@lang('last_name')</th>
                                <th scope="col">@lang('company')</th>
                                <th scope="col">@lang('email_address')</th>
                                <th scope="col">@lang('phone')</th>
                                <th scope="col">@lang('created_at')</th>
                                <th class="text-center" scope="col">@lang('actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <th class="text-center" scope="row">{{$employee->id}}</th>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->last_name}}</td>
                                    <td>{{$employee->company->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>{{$employee->created_at}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm mb-1" href="{{route('employees.edit',$employee->id)}}" role="button" style="width: 4rem">@lang('edit')</a>
                                        <a class="btn btn-danger btn-sm mb-1" href="javascript:;" onclick="$('#modal-delete-{{$employee->id}}').modal('show')"
                                           role="button" style="width: 4rem">@lang('delete')</a>
                                    </td>
                                </tr>
                                {{--delete modal--}}
                                <div id="modal-delete-{{$employee->id}}" class="modal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">@lang('warning')</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>@lang('wanna_delete')</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                        onclick="itemDelete('{{$employee->id}}')">@lang('yes')</button>
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">@lang('cancel')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                        @include('partials.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function itemDelete(id) {
            req('employees/' + id, {
                employee: id,
                _token: '{{csrf_token()}}',
                _method: 'delete'
            });
        }
    </script>
@endsection
