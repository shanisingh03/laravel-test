@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{route('employees.index')}}">Back</a>
                    {{ __('Add New Employee') }}
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
                            <form method="post" action="{{route('employees.store')}}" >
                            @csrf
                                {{-- Company   --}}
                                <div class="form-group">
                                    <label>Company</label>
                                    <select class="form-control" required name="company_id">
                                        <option value="" disabeld selected>Please Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}" {{old('company_id') == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('company_id'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('company_id')}}
                                    </span>
                                    @endif
                                </div>
                                {{-- Name   --}}
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}" required>
                                    @if($errors->has('first_name'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('first_name')}}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" required>
                                    @if($errors->has('last_name'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('last_name')}}
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
                                    <label>Phone</label>
                                    <input type="number" name="phone" class="form-control" value="{{old('phone')}}" required >
                                    @if($errors->has('phone'))
                                    <span class="errorfield">
                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ $errors->first('phone')}}
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
