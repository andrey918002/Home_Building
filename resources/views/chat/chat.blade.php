@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ $chat['name'] }}</div>

                    <div class="card-body">
                        <chat-component/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_scripts')
    <script>
        window.chat_id = "{{ $chat['id'] }}"
    </script>
@endsection
