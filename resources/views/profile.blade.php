@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">{{ __('Profile') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('edit-profile') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $user['id'] }}"/>

                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <label style="min-height:50px; width:100%; background:#eeeeee; margin-bottom: 10px">
                                <img id="profile-image" src="{{ $user['image'] ? '/storage/' . $user['image'] : '/img/placeholder.png' }}" alt="" style="width:100%"/>
                                <input id="input-image" type="file" name="image" class="visually-hidden"/>
                            </label>
                        </div>
                        <div class="col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Full Name') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user['name'] }}" required/>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Instagram') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" value="{{ $user['instagram'] }}"/>
                                            @error('instagram')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>
                                        <div class="col-md-8">
                                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $user['date_of_birth'] }}"/>
                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Facebook') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $user['facebook'] }}"/>
                                            @error('facebook')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" placeholder="Position" value="{{ $user['position'] }}"/>
                                            @error('position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user['address'] }}"/>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user['phone'] }}"/>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}" required/>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="ccol-12 col-sm-6">
                                    <div class="row mb-3">
                                        <label class="col-md-4 col-form-label text-md-end">{{ __('Last Place of Work') }}</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control @error('last_place_of_work') is-invalid @enderror" name="last_place_of_work">{{ $user['last_place_of_work'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($user->id == Auth::user()->id || $user->position !== 'Editor')
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            let imgInp = document.getElementById('input-image')

            imgInp.addEventListener('change', function () {
                const [file] = imgInp.files
                if (file) {
                    document.getElementById('profile-image').setAttribute('src', URL.createObjectURL(file))
                }
            })
        });
    </script>
@endsection
