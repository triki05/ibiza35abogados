@extends('layouts.app')

<!-- Main Content -->
@section('content')
@extends('layouts.header')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Restablecer contraseña</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}
						
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 offset-md-4 control-label">Dirección de email</label>
                            @if ($errors->has('email'))
                                <span class="help-block col-md-4 offset-md-4">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="col-md-4 offset-md-4">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                     Restablecer contraseña  <i class="fa fa-btn fa-send"></i>
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
