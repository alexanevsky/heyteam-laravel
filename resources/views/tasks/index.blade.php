@extends('app')

@section('title')
    Tasks List
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 40%;">Tasks <span class="badge bg-dark">{{ count($tasks) }}</span></th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th class="d-flex justify-content-end">
                            <a href="/add" class="btn btn-primary btn-sm">Add new task</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $i => $task)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if ($task->getChecked())
                                <del>{{ $task->getText() }}</del>
                                <i class="fas fa-check ms-1 text-success"></i>
                                @else
                                    {{ $task->getText() }}
                                @endif

                            </td>
                            <td>
                                <small>{{ $task->getCreatedAt()->format('F d Y, H:i') }}</small>
                            </td>
                            <td>
                                @if (!$task->getUpdatedAt() || $task->getCreatedAt()->format('c') === $task->getUpdatedAt()->format('c'))
                                    <small class="text-muted">Never updated</small>
                                @else
                                <small>{{ $task->getUpdatedAt()->format('F d Y, H:i') }}</small>
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="/{{$task->getId()}}" class="btn btn-primary"><i class="fas fa-pen fa-fw"></i></a>
                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{ $task->getId() }}"><i class="fas fa-times fa-fw"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')
    @foreach($tasks as $task)
        <div class="modal fade" tabindex="-1" id="delete-{{ $task->getId() }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ $task->getId() }}/delete">
                        <div class="modal-body">
                            <p class="mb-0">Are you sure you want to delete this task?</p>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @csrf
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection