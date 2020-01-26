<nav class="navbar navbar-light sticky-top">
	<a href="{{url('/home')}}" class="navbar-brand mx-auto"><img src="{{url('/img/logo_header.png')}}" width="100%"></a>
	@if(Auth::user())
	<a href="{{url('/logout')}}" id="logout" class="navbar-text"><strong>Cerrar sesión</strong></a>
	@endif
</nav>