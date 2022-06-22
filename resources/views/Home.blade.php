@extends('layouts.App')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{route('companies.index')}}">
                            <button type="button" class="btn btn-secondary">@lang('companies_management')</button>
                        </a>
                        <a href="{{route('employees.index')}}">
                            <button type="button" class="btn btn-secondary"
                                    onclick="">@lang('employees_management')</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
