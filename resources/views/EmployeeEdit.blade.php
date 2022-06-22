@extends('layouts.App')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('edit') - @lang('employee')({{$employee->id}})</div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::get('success'))
                            <div class="alert alert-success mt-2" role="alert">
                                @lang('operation_successful')
                            </div>
                        @endif
                        <form method="post" action="{{route('employees.update',$employee->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="first_name">@lang('first_name')</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{$employee->first_name}}">
                                @error('first_name')
                                <small id="error-first_name" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">@lang('last_name')</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{$employee->last_name}}">
                                @error('last_name')
                                <small id="error-last_name" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputState">@lang('company')</label>
                                <select name="company_id" class="form-control">
                                    <option value="{{$employee->company_id}}"
                                            selected>{{$employee->company->name}}</option>
                                    @foreach(\App\Models\Company::all() as $company)
                                        @if($employee->company_id==$company->id)
                                            @continue
                                        @else
                                            <option value="{{$company->id}}" >{{$company->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('email_address')</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$employee->email}}">
                                @error('email')
                                <small id="error-email" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">@lang('phone')</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{$employee->phone}}">
                                @error('phone')
                                <small id="error-phone" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('edit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
