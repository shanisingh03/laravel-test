@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{route('home')}}">Back</a>
                    {{ __('Create New Company') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @elseif (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{route('companies.store')}}" enctype='multipart/form-data' >
                            @csrf
                                {{-- Name   --}}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                                    @if($errors->has('name'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('name')}}
                                    </span>
                                    @endif
                                </div>
                                {{--  Email  --}}
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
                                    @if($errors->has('email'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('email')}}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" value="{{old('website')}}" required >
                                    @if($errors->has('website'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('website')}}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>LOGO</label>
                                    <input type="file" name="logo" class="form-control" value="{{old('logo')}}" required >
                                    @if($errors->has('logo'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('logo')}}
                                    </span>
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
