@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Update Project</div>
                        <div class="col-auto">
                            <form action="{{ route('projects.destroy', ['id' => $project->id]) }}" method="POST" class="delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger bg-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>

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

                    <form method="POST" action="{{ route('projects.update', ['id' => $project->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="{{ $project->name }}" required>
                        </div>

                        <button type="submit" class="btn btn-success bg-success">Update</button>
                        <a href="{{ route('projects.index') }}" class="btn btn-warning">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
