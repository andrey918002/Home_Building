@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Task') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.save') }}">
                            @csrf

                            <div class="row mb-12">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required/>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br/>

                            <div class="row mb-12">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-9">
                                    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <br/>

                            <div class="row mb-12">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Todo Time') }}</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control date-time-picker @error('todo_time') is-invalid @enderror" name="todo_time" value="{{ old('todo_time') }}" required/>

                                    @error('todo_time')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <br/>

                            <div class="row mb-12">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.date-time-picker').datetimepicker({
            format: "YYYY-MM-DD hh:mm"
        })
    </script>
@endsection
