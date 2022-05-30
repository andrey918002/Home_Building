@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }} <a href="{{ route('task.add') }}" class="btn btn-primary">{{ __('Add Task') }}</a></div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->todo_time }}</td>
                                    <td style="display: flex; flex-direction: row">
                                        <a href="#" class="btn btn-primary">{{ __('Edit') }}</a>
                                        <a href="#" class="btn btn-danger">{{ __('Delete') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if($tasks->hasPages())
                            <ul class="pagination">
                                @if($tasks->currentPage() != 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tasks->previousPageUrl() }}">{{ __('Previous') }}</a>
                                    </li>
                                @endif
                                @if($tasks->currentPage() != $tasks->lastPage())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tasks->nextPageUrl() }}">{{ __('Next') }}</a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
