@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Task</div>

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

                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>

                        {{-- <div class="form-group">
                            <label>Assigned To</label>
                            <select class="form-control" name="user_id">
                                <option value="">-</option>
                                @foreach( $users as $user )
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label>Project</label>
                            <select class="form-control" name="project_id">
                                <option value="">-</option>
                                @foreach( $projects as $project )
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-success">Create</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[name="user_id"]').val({{ old('project') }});
            $('[name="project_id"]').val({{ old('project') }});
        });
    </script>
@endsection
