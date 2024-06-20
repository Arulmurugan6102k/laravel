@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8 shadow-lg p-3 mb-5 bg-body" style="border-radius:18px;">
        <div class="p-5">
            <div class="text-center h1 mb-4">LOGIN</div>
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                        <div class="mb-3 input-group-lg">
                            <label for="email" class="form-label">Email
                                Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3 input-group-lg">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="text-center">
                            <input type="submit" class="text-center btn btn-lg btn-primary mt-4" value="Login">
                        </div>
                        
                        <div class="text-center mt-4">
                            <p>I don't have an account ? <a class="{{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('register') }}"> Signup</a></p>
                        </div>  
                </form>
            </div>
        </div>
    </div>
</div>

@endsection