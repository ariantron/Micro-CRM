@extends('layouts.App')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('edit') - @lang('company')({{$company->id}})</div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::get('success'))
                            <div class="alert alert-success mt-2" role="alert">
                                @lang('operation_successful')
                            </div>
                        @endif
                        <form method="post" action="{{route('companies.update',$company->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">@lang('name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
                                @error('name')
                                <small id="error-name" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('email_address')</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$company->email}}">
                                @error('email')
                                <small id="error-email" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="website">@lang('website')</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{$company->website}}">
                                @error('website')
                                <small id="error-website" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="logo">@lang('logo')</label>
                                <div>
                                    <img style="width: 5rem; @if(empty($company->logo_path)) display:none @endif " class="mt-2 mb-2" id="img-logo" alt="" src="{{$company->getLogoPath()}}">
                                </div>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="">
                                @error('logo_path')
                                <small id="error-logo_path" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('edit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('logo').onchange = function (evt) {
            document.getElementById('img-logo').setAttribute('style','width: 5rem;');
            let tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            if (FileReader && files && files.length) {
                let fr = new FileReader();
                fr.onload = function () {
                    document.getElementById('img-logo').src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
        }
    </script>
@endsection
