@extends('app')

@section('title')
    {{ $task ? 'Update Task' : 'Add Task' }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="mb-0">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <form method="POST">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 col-form-label">
                                <label for="text">Task:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="text" value="{{ $task ? $task->getText() : '' }}">
                            </div>
                        </div>
                        @if ($task)
                            <div class="row">
                                <div class="col-md-3">Status:</div>
                                <div class="col-md-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="checked" id="checked" {{ $task && $task->getChecked() ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checked">Done</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" class="btn btn-primary" value="{{ $task ? 'Update' : 'Add' }}">
                        @csrf
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection