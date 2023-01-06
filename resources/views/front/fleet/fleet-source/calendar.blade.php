@extends('layouts.main')


@section('vendor-style')
  {{-- Page Css files --}}

  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/maps/leaflet.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">


@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/maps/map-leaflet.css') }}">
  <link rel="stylesheet" href="{{asset('public/css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">


@endsection


@section('title', 'Fleet Calendar ')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

@section('content')
<!-- Full calendar start -->
<section>
<div class="card"> 
  <div class="card-body"> 

    <div id='calendar'></div>
    <input type="hidden" name="fleet_id" id="fleet_id" value="{{$uuid}}">
  </div>
</div>


</section>
<!-- Full calendar end -->
@endsection



@section('page-script')
  {{-- Page js files --}}

  <script>  
          document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var uuid = document.getElementById('fleet_id').value;
        console.log(uuid);
        var calendar = new FullCalendar.Calendar(calendarEl, {
          dayMaxEvents: 3,
          editable:false,
          selectable: true,
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          eventSources: [
            {
              url:'../fetchFleetCalenderEvent/'+uuid
            }

          ],


          eventClick: function(info) {

            var eventObj = info.event;

            if (eventObj.url) {

              window.open(eventObj.url);

              info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
            }
          },

        });

        calendar.render();


      });





</script>


@section('vendor-script')
  {{-- Vendor js files --}}
    
  <script src="{{ asset('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>

  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script> 
  <script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
  <script src="{{ asset('vendors/js/maps/leaflet.min.js')}}"></script>
  <script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>

   
  {{-- data table --}} 
 
@endsection


<script src="{{ asset('js/scripts/forms/form-repeater.js') }}"></script> 
  <script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
  <script src="{{ asset('js/scripts/maps/map-leaflet.js')}}"></script>
  <script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

@endsection



