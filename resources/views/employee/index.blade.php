@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{route('home')}}">Back</a>
                    {{ __('Employees') }}
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
                    <a class="btn btn-success mb-2 text-white" href="{{route('employees.create')}}">Add Employee</a>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Company</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse($employees as $employee)
                                <tr>
                                    <td scope="col">
                                        {{$employee->company->name}}
                                    </td>
                                    <td scope="col">{{$employee->name}}</td>
                                    <td scope="col">{{$employee->email}}</td>
                                    <td scope="col">{{$employee->phone}}</td>
                                    <td scope="col">
                                        <a class="btn btn-sm" href="{{route('employees.edit',['employee' => $employee->id])}}">Edit</a>
                                        <form action="{{route('employees.destroy',['employee' => $employee->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                        </form> 
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"> No Employee Found</td>
                                </tr>
                                @endforelse
                        </tbody>
                    </table>

                    {{$employees->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
