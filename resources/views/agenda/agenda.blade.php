@extends('layouts.app')

@section('content')
@extends('layouts.header')
<link rel="stylesheet" href="/fullcalendar/fullcalendar.css">
<script src="/fullcalendar/lib/jquery.min.js"></script>
<script src="/fullcalendar/lib/moment.min.js"></script>
<script src="/fullcalendar/fullcalendar.js"></script>
<script src="/fullcalendar/locale/es.js"></script>
<script src="/fullcalendar/gcal.js"></script>
<div class="container-fluid ml-3">
	<div class="row">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
				<li class="breadcrumb-item active"><a href="{{url('/agenda')}}">Agenda</a></li>
			</ol>
		</nav>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-8 offset-sm-2">
			<div class="text-center">
				<h1>Agenda</h1>
			</div>
			<div id="calendar"></div>
		</div>
	</div>
</div>

<script>
	$('#calendar').fullCalendar({
		showNonCurrentDates: false,
		fixedWeekCount: false,
		locale: 'es',
		height: 450,
		header:{
			left: 'prev,next',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		dayClick: function(date,jsEvent,view){
			$("#dayModal").modal();
		},
		eventClick: function(calEvent,jsEvent,view){
			$('#tituloEvento').html(calEvent.title);
			$('#descripcionEvento').html(calEvent.descripcion);
			$('#eventModal').modal();
		},
		eventSources:[{
			events:[
				{
					title: 'Evento 1',
					descripcion: 'Descripcion 1',
					start: '2018-06-03'
				},
				{
					title: 'Evento 2',
					descripcion: 'Descripcion 2',
					start: '2018-06-04',
					end: '2018-06-06',
				}
			]
		}],
	});
</script>
<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="descripcionEvento"></div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-success">Agregar</button>
      	<button type="button" class="btn btn-primary">Modificar</button>
        <button type="button" class="btn btn-danger">Borrar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
@endsection