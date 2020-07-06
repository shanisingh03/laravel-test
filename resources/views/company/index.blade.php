@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{route('home')}}">Back</a>
                    {{ __('Companies') }}
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
                    @endif
                    <a class="btn btn-success mb-2 text-white" href="{{route('companies.create')}}">Create new Company</a>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Logo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Website</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse($companies as $company)
                                <tr>
                                    <td scope="col">
                                        <img src="{{asset($company->logo)}}" height='100' width='100' alt="{{$company->name}}">
                                    </td>
                                    <td scope="col">{{$company->name}}</td>
                                    <td scope="col">{{$company->email}}</td>
                                    <td scope="col">{{$company->website}}</td>
                                    <td scope="col">
                                        <a class="btn btn-sm" href="{{route('companies.edit',['company' => $company->id])}}">Edit</a>
                                        <form action="{{route('companies.destroy',['company' => $company->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                        </form> 
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"> No Company Found</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>

                    {{$companies->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
