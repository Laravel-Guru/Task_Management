@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Project</div>

                <div class="card-body">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        <button type="submit" class="btn btn-outline-success">Create</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
