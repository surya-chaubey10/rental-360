@extends('layouts.main')
@section('title', '')

@section('vendor-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('vendors/css/forms/select/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/animate/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset('css/base/plugins/forms/form-validation.css') }}">
<link rel="stylesheet" href="{{ asset('css/base/plugins/extensions/ext-component-toastr.css') }}">
<link rel="stylesheet" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">
@endsection
<style>
  .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 18px;
  }

  .switch input {
    display: none;
  }

  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #737373;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 34px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    border-radius: 50%;
  }

  input:checked+.slider {
    background-color: #2ab934;
  }

  input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
  }

  input:checked+.slider:before {
    -webkit-transform: translateX(12px);
    -ms-transform: translateX(12px);
    transform: translateX(33px);
  }

  /*------ ADDED CSS ---------*/
  .slider:after {
    content: 'OFF';
    color: white;
    display: block;
    position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%;
    font-size: 10px;
    font-family: Verdana, sans-serif;
  }

  input:checked+.slider:after {
    content: 'ON';
  }
</style>
@section('content')

<section class="app-user-list">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-12 col-lg-5 col-md-5 order-1 order-md-0">

      <div class="card">
        <div class="card-body">
          <form id="form_subscription" method="post" class="add-subscriptions_plans modal-content pt-0 form-block"
            autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="smenuid" value="" name="smenu">
            <div class="card-header">
              <h4 style="font-size: 1.486rem;">Create Plan</h4>
            </div>
            <hr>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                  type="button" role="tab" aria-controls="pills-home" aria-selected="true">Plan</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-Permission-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-Permission" type="button" role="tab" aria-controls="pills-Permission"
                  aria-selected="false">Permission</button>
              </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-1">
                      <label class="form-label" for="typeInput">Plan Name</label>
                      <input class="form-control" type="text" id="plan_name" name="plan_name" placeholder="Silver Plan">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="form-label" for="typeInput">Add On Charges</label>
                      <input class="form-control" type="number" id="add_on_charge" name="add_on_charge" placeholder="AED">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="form-label" for="typeInput">Deposit</label>
                      <input class="form-control" type="number" id="deposit" name="deposit" placeholder="AED">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="convenience_fees_type">Convenience Fees Type</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_Convenience" type="radio" name="convenience_fees_type"
                          id="convenience_fees_type1" value="1" />
                        <label class="form-check-label" for="inlineRadio2">Flat</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_Convenience" type="radio" name="convenience_fees_type"
                          id="convenience_fees_type2" value="2" checked />
                        <label class="form-check-label" for="inlineRadio2">Percentage</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="convenience_fees_type" id="hide_Convenience"
                          value="3" />
                        <label class="form-check-label" for="inlineRadio2">None</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="user-name-column">Convenience Amount</label>
                      <input type="number" id="convenience_amount" class="form-control" name="convenience_fees_amount"
                        value="" placeholder="%" name="username" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="commission_fees_type">Commission Fees Type</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_Commission" type="radio" name="commission_fees_type"
                          id="commission_fees_type" value="1" />
                        <label class="form-check-label" for="inlineRadio2">Flat</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_Commission" type="radio" name="commission_fees_type"
                          id="commission_fees_type" value="2" checked />
                        <label class="form-check-label" for="inlineRadio2">Percentage</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="commission_fees_type" id="hide_Commission"
                          value="3" />
                        <label class="form-check-label" for="inlineRadio2">None</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="user-name-column">Commission Amount</label>
                      <input class="form-control" type="number" id="commission_amount" name="commission_fees_amount"
                        placeholder="%">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="customColorRadio5">Withdrawal Charges Add</label><br>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_withdral" type="radio" name="customColorRadio5"
                          id="customColorRadio51" value="1" />
                        <label class="form-check-label" for="inlineRadio2">Flat</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input show_withdral" type="radio" name="customColorRadio5"
                          id="customColorRadio52" value="2" checked />
                        <label class="form-check-label" for="inlineRadio2">Percentage</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="customColorRadio5" id="hide_withdral"
                          value="3" />
                        <label class="form-check-label" for="inlineRadio2">None</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="mb-1">
                      <label class="form-label mb-1" for="user-name-column">Withdrawal Charges Amount</label>
                      <input type="number" id="withdrawal_charges_amuont" class="form-control" value="" placeholder="%"
                        name="withdrawal_charges_amuont" />
                    </div>
                  </div>
                </div>


                <section id="input-mask-wrapper">
                  <label class="form-label mb-1 mt-1" for="user-name-column"> Payment Gateway Changes</label>
                  <br>
                  <div class="row mb-1">
                    <!-- payment gateway row start -->

                    <div class="col-8">
                      <!-- col-8 start -->

                      <div class="row">
                        <!-- row start -->

                        <div class="col-md-6 col-6">

                          <div class="mb-1  mt-2">
                            <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="1"
                              name="payment_gateway_charge[]" id="payment_gateway_charge1" value="1" />

                            <label class="form-label" for="user-name-column">Visa/Mastercard</label>

                          </div>

                        </div>


                        <div class="col-md-4 col-4 mb-1">

                          <input class="form-control ml-1 pga1" type="number" name="payement_gateway_amount[]"
                            id="payement_gateway_amount" readonly="readonly" placeholder="%" value="" />

                        </div>

                      </div> <!-- row end -->

                    </div><!-- col-8 end -->


                    <div class="col-8">
                      <!-- col-8 start -->

                      <div class="row">
                        <!-- row start -->

                        <div class="col-md-6 col-6">

                          <div class="mb-1  mt-2">
                            <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="2"
                              name="payment_gateway_charge[]" id="payment_gateway_charge2" value="2" />
                            <label class="form-label" for="user-name-column">Amex</label>

                          </div>

                        </div>


                        <div class="col-md-4 col-4 mb-1">



                          <input class="form-control ml-1 pga2" type="number" name="payement_gateway_amount[]"
                            id="payement_gateway_amount" readonly="readonly" placeholder="%" value="" />

                        </div>

                      </div> <!-- row end -->

                    </div><!-- col-8 end -->


                    <div class="col-8">
                      <!-- col-8 start -->

                      <div class="row">
                        <!-- row start -->

                        <div class="col-md-6 col-6">

                          <div class="mb-1  mt-2">
                            <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="3"
                              name="payment_gateway_charge[]" id="payment_gateway_charge3" value="3" />
                            <label class="form-label" for="user-name-column">Binance Pay</label>


                          </div>
                        </div>

                        <div class="col-md-4 col-4 mb-1">



                          <input class="form-control ml-1 pga3" type="number" name="payement_gateway_amount[]"
                            id="payement_gateway_amount" readonly="readonly" placeholder="%" value="" />

                        </div>

                      </div> <!-- row end -->
                    </div><!-- col-8 end -->

                    <div class="col-8">
                      <!-- col-8 start -->
                      <div class="row">
                        <!-- row start -->
                        <div class="col-md-6 col-6">
                          <div class="mb-1 mt-2 ">
                            <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="4"
                              name="payment_gateway_charge[]" id="payment_gateway_charge4" value="4" />
                            <label class="form-label" for="user-name-column">Spotii</label>
                          </div>
                        </div>

                        <div class="col-md-4 col-4 mb-1">
                          <input class="form-control ml-1 pga4" type="number" name="payement_gateway_amount[]"
                            id="payement_gateway_amount" readonly="readonly" placeholder="%" value="" />
                        </div>
                      </div> <!-- row end -->
                    </div><!-- col-8 end -->


                    <div class="col-8">
                      <!-- col-8 start -->
                      <div class="row">
                        <!-- row start -->
                        <div class="col-md-6 col-6">
                          <div class="mb-1  mt-2">
                            <input class="form-check-input ml-1 payment_gateway_charge" type="checkbox" data-id="5"
                              name="payment_gateway_charge[]" id="payment_gateway_charge5" value="5" />
                            <label class="form-label" for="user-name-column">Tabby</label>
                          </div>
                        </div>
                        <div class="col-md-4 col-4 mb-1">
                          <input class="form-control ml-1 pga5" type="number" name="payement_gateway_amount[]"
                            id="payement_gateway_amount" readonly="readonly" placeholder="%" value="" />
                        </div>
                      </div> <!-- row end -->
                    </div><!-- col-8 end -->
                  </div> <!-- payment gateway row end -->

                </section>


                <div class="mb-1">
                  <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="3" style="resize: none;"
                    placeholder=""></textarea>
                </div>
              </div>

            
        <div class="tab-pane fade" id="pills-Permission" role="tabpanel" aria-labelledby="pills-Permission-tab">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table mb-2">
                <thead>
                  <tr>
                    <th>MODULE</th>
                    <th>SUBMODULE</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($menus as $key => $menu)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="form-check-inline">
                          <input class="form-check-input module" data-id="{{$key}}" name="menu[]" type="checkbox"
                            id="menu" value="{{$menu->id}}" checked readonly />
                          <label class="form-check-label" for="menu">{{$menu->name}}</label>
                        </div>
                      </div>
                    </td>
                    <td>
                      @foreach($menu->sub_menu as $sub_menu)
                      <div class="d-flex align-items-center">
                        <div class="form-check-inline">
                          <input class="form-check-input sub_module{{$key}}" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="sub_menu" value="{{$sub_menu->id}}" checked readonly/>

                          {{--  <input class="form-check-input sub_module{{$key}}" name="sub_menu[]"
                            style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="sub_menu"
                            value="{{$sub_menu->id}}" checked readonly />  --}}
                          <label class="form-check-label mb-1" for="sub_menu">{{$sub_menu->name}}</label>
                        </div>
                      </div>
                      @endforeach
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
        <div class="text-center">
          <button  id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block-overlay save">Submit</button>
        </div>
        </form>
      </div>
    </div><!-- card-body -->
  </div><!-- card end -->
  </div>
  <!-- list and filter end -->
</section>
@endsection

@section('vendor-script')
{{-- Vendor js files --}}
<script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendors/js/forms/cleave/cleave.min.js') }}"></script>
<script src="{{ asset('vendors/js/forms/cleave/addons/cleave-phone.us.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/polyfill.min.js') }}"></script>

@endsection

@section('page-script')
{{-- Page js files --}}
<script src="{{ asset('js/scripts/pages/app-subscriptions_plans.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>

<script>
  $(document).ready(function () {
      $("#hide_withdral").click(function(){
        $("#withdrawal_charges_amuont").val(null);
        document.getElementById('withdrawal_charges_amuont').setAttribute('readonly', true);
      });
      $(".show_withdral").click(function(){
        document.getElementById('withdrawal_charges_amuont').removeAttribute('readonly', true);
      });

    $("#hide_Convenience").click(function(){
        $("#convenience_amount").val(null);
        document.getElementById('convenience_amount').setAttribute('readonly', true);
    });
    $(".show_Convenience").click(function(){

        document.getElementById('convenience_amount').removeAttribute('readonly', true);
    });
    $("#hide_Commission").click(function(){
      $("#commission_amount").val(null);
       
      document.getElementById('commission_amount').setAttribute('readonly', true);
    });
    $(".show_Commission").click(function(){
      document.getElementById('commission_amount').removeAttribute('readonly', true);
    });

    $('input[name="payment_gateway_charge[]"]').click(function(){
      var id = $(this).data('id');

      if($(this).is(':checked')){

        $('.pga'+id).removeAttr('readonly');
        $('.pga'+id).val('');

      }else{

        $('.pga'+id).attr('readonly', 'readonly');
        $('.pga'+id).val('');

      }


    });


  });
</script>
@endsection
