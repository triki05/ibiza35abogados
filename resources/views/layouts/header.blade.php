<nav class="navbar navbar-light sticky-top">
	<div class="container">
		<div class="row">
			<div class="navbar-brand col-12 col-md-4 offset-md-4">
				<a href="{{url('/home')}}"><img src="/img/logo.png" width="100%"></a>
			</div>
			<div class="navbar-text col-10 col-md-2 offset-md-1 text-center text-sm-right pt-md-5 pl-md-5">
				@if(Auth::user())
				<a href="{{url('/logout')}}" id="logout"><strong>Cerrar sesión</strong></a>
				@endif
			</div>
		</div>
	</div>
</nav>