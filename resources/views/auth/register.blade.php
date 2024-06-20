@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-md-8 shadow-lg p-3 mb-5 bg-body" style="border-radius:18px;">
        <div class="p-5">
            <div class="text-center h1 mb-4">REGISTER</div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="post">
                    @csrf
                        <div class="mb-3 input-group-lg">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 input-group-lg">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 input-group-lg">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" value="{{ old('password') }}">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 input-group-lg">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                value="{{ old('password_confirmation') }}">
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    <div class="text-center">
                            <input type="submit" class="text-center btn btn-lg btn-primary mt-4" value="Login">
                        </div>  

                        <div class="text-center mt-4">
                            <p>Have already an account ? <a class="{{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}"> Login</a></p>
                        </div>  
                </form>
            </div>
        </div>
    </div>
</div>

@endsection