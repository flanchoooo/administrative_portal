@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">{{ __('Create Role') }}
                    </div>

                    @if ($flash = session('message'))
                        <div  class="alert alert-success" role="alert">
                            {{$flash}}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="/assign/store" aria-label="{{ __('Add Product') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <input id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="name" value="{{ old('status') }}" required autofocus  >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="user" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="description" value="{{ old('status') }}" required autofocus  >
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Validate') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection