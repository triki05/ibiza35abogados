@extends('layouts.app')

@section('content')

<div class="logo col-12 col-md-8 offset-md-2">
	<img src="/img/logo.png" class="col-12">
</div>
<div class="form-login col-12 col-md-6 offset-md-3">
    <form class="form-horizontal" role="form" method="post" action="{{ url('login') }}">
    {!! csrf_field() !!}
    	<div class="form-group col-md-10 offset-md-1">
    		@if ($errors->has('email'))
            	<span class="help-block">
                	<strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
    		<div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
    			<div class="input-group-prepend">
    				<span class="input-group-text"><i class="mdi mdi-account"></i></span>
    			</div>
    			<input type="email" class="form-control" placeholder="Correo electrónico" name="email">
    		</div>
    	</div>
    	
    	<div class="form-group col-md-10 offset-md-1">
    		@if ($errors->has('password'))
            	<span class="help-block">
                	<strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
    		<div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
    			<div class="input-group-prepend">
    				<span class="input-group-text"><i class="mdi mdi-key-variant"></i></span>
    			</div>
    			<input type="password" class="form-control" placeholder="Contraseña" name="password">
    		</div>
    	</div>
    	
    	<div class="form-group col-md-10 offset-md-1">
            <div class="col-6 col-md-5 col-lg-4 offset-3 offset-md-4">
                <button type="submit" class="btn btn-danger col-md-12">
                    Entrar 
                </button>
            </div>
            <div class="col-12 text-center">
            	<a href="{{ url('/password/reset') }}">¿Has olvidado la contraseña?</a>
            </div>
        </div>
    </form>
</div>
@endsection