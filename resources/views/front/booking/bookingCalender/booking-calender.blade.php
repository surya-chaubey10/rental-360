@extends('layouts.main')
@section('title', 'Booking Calendar ')


@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset('vendors/css/calendars/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/pickers/form-flat-pickr.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/pages/app-calendar.css') }}">
  <link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
@endsection

@section('content')
<!-- Full calendar start -->
<section>
  <div class="app-calendar overflow-hidden border">
    <div class="row g-0">
    
      <!-- Calendar -->
      <div class="col position-relative">
        <div class="card shadow-none border-0 mb-0 rounded-0">
          <div class="card-body pb-0">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
      <!-- /Calendar -->
      <div class="body-content-overlay"></div>
    </div>
  </div>
  <!-- Calendar Add/Update/Delete event modal-->
  <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
    <div class="modal-dialog sidebar-lg">
      <div class="modal-content p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title">Add Event</h5>
        </div>
        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
          <form class="event-form needs-validation" data-ajax="false" novalidate>
            <div class="mb-1">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Event Title" required />
            </div>
            <div class="mb-1">
              <label for="select-label" class="form-label">Label</label>
              <select class="select2 select-label form-select w-100" id="select-label" name="select-label">
                <option data-label="primary" value="Business" selected>Business</option>
                <option data-label="danger" value="Personal">Personal</option>
                <option data-label="warning" value="Family">Family</option>
                <option data-label="success" value="Holiday">Holiday</option>
                <option data-label="info" value="ETC">ETC</option>
              </select>
            </div>
            <div class="mb-1 position-relative">
              <label for="start-date" class="form-label">Start Date</label>
              <input type="text" class="form-control" id="start-date" name="start-date" placeholder="Start Date" />
            </div>
            <div class="mb-1 position-relative">
              <label for="end-date" class="form-label">End Date</label>
              <input type="text" class="form-control" id="end-date" name="end-date" placeholder="End Date" />
            </div>
            <div class="mb-1">
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input allDay-switch" id="customSwitch3" />
                <label class="form-check-label" for="customSwitch3">All Day</label>
              </div>
            </div>
            <div class="mb-1">
              <label for="event-url" class="form-label">Event URL</label>
              <input type="url" class="form-control" id="event-url" placeholder="https://www.google.com" />
            </div>
            <div class="mb-1 select2-primary">
              <label for="event-guests" class="form-label">Add Guests</label>
              <select class="select2 select-add-guests form-select w-100" id="event-guests" multiple>
                <option data-avatar="1-small.png" value="Jane Foster">Jane Foster</option>
                <option data-avatar="3-small.png" value="Donna Frank">Donna Frank</option>
                <option data-avatar="5-small.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                <option data-avatar="7-small.png" value="Lori Spears">Lori Spears</option>
                <option data-avatar="9-small.png" value="Sandy Vega">Sandy Vega</option>
                <option data-avatar="11-small.png" value="Cheryl May">Cheryl May</option>
              </select>
            </div>
            <div class="mb-1">
              <label for="event-location" class="form-label">Location</label>
              <input type="text" class="form-control" id="event-location" placeholder="Enter Location" />
            </div>
            <div class="mb-1">
              <label class="form-label">Description</label>
              <textarea name="event-description-editor" id="event-description-editor" class="form-control"></textarea>
            </div>
            <div class="mb-1 d-flex">
              <button type="submit" class="btn btn-primary add-event-btn me-1">Add</button>
              <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary update-event-btn d-none me-1">Update</button>
              <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Calendar Add/Update/Delete event modal-->
</section>
<!-- Full calendar end -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset('vendors/js/calendar/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('vendors/js/extensions/moment.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
  <script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset('js/scripts/pages/app-calendar-events.js') }}"></script>
  <script src="{{ asset('js/scripts/pages/app-calendar.js') }}"></script>
@endsection
