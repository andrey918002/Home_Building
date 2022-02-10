@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ __('Chats') }}</div>

                    <div class="card-body">
                        <chat-list/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
