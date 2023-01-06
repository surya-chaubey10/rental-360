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
          <form class="update-subscriptions_plans modal-content pt-0 form-block" autocomplete="off" method="post"
            id="form_subscription" enctype="multipart/form-data">

            <input type="hidden" id="smenuid" value="" name="smenu">
            <div class="card-header">
              <h4 style="font-size: 1.486rem;">Update Plan</h4>

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
                      <input class="form-control" type="text" id="plan_name" value="{{ $SubscriptionPlans->plan_name}}"
                        name="plan_name" placeholder="Silver Plan">
                    </div>
                  </div>
                  <input class="form-control" type="hidden" value="{{ $SubscriptionPlans->id}}" name="update_id">
                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="form-label" for="typeInput">Add On Charges</label>
                      <input class="form-control" type="text" id="add_on_charge"
                        value="{{ $SubscriptionPlans->add_on_charge}}" name="add_on_charge" placeholder="$300">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-1">
                      <label class="form-label" for="typeInput">Deposit</label>
                      <input class="form-control" type="text" id="deposit" value="{{ $SubscriptionPlans->deposit}}"
                        name="deposit" placeholder="$10">
                    </div>
                  </div>
                </div>

            <section id="vuexy-radio-color">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="margin-bottom:-15px;">
                        <div class="card-header" style="padding: 0.5rem 1.5rem;">
                          <label class="form-label" for="typeInput">Convenience Fees Type</label>
                        </div>
                        <div class="card-body">
                          <div class="demo-inline-spacing">
                            <div class="form-check form-check-success">
                              <input type="radio" id="customColorRadio3" name="customColorRadio3"
                                class="form-check-input show_Convenience" value="1" {{ ($SubscriptionPlans->convenience_fees_type=="1") ?
                              "checked" : "" }} >

                              <label class="form-check-label" for="customColorRadio3">Flat</label>
                            </div>
                            <div class="form-check form-check-danger">
                              <input type="radio" id="customColorRadio5" name="customColorRadio3"
                                class="form-check-input show_Convenience" value="2" {{ ($SubscriptionPlans->convenience_fees_type=="2") ?
                              "checked" : "" }}>
                              <label class="form-check-label" for="customColorRadio5">Percentage</label>
                            </div>
                            <div class="form-check form-check-warning">
                              <input type="radio" id="hide_Convenience" name="customColorRadio3"
                                class="form-check-input" value="3" {{ ($SubscriptionPlans->convenience_fees_type=="3") ?
                              "checked" : "" }}>
                              <label class="form-check-label" for="customColorRadio4">None</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-1">
                        <label class="form-label" for="typeInput">Convenience Amount</label>
                        <input class="form-control" type="text" id="convenience_fees_amount"
                          value="{{ $SubscriptionPlans->convenience_fees_amount}}" name="convenience_fees_amount"
                          placeholder="%">
                      </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card" style="margin-bottom:-15px;">
                        <div class="card-header" style="padding: 0.5rem 1.5rem;">
                          <label class="form-label" for="typeInput">Commission Fees Type</label>
                        </div>
                        <div class="card-body">
                          <div class="demo-inline-spacing">
                            <div class="form-check form-check-success">
                              <input type="radio" id="customColorRadio3" name="customColorRadio4"
                                class="form-check-input show_Commission" value="1" {{ ($SubscriptionPlans->commission_fees_type=="1") ?
                              "checked" : "" }}>
                              <label class="form-check-label" for="customColorRadio3">Flat</label>
                            </div>
                            <div class="form-check form-check-danger">
                              <input type="radio" id="customColorRadio5" name="customColorRadio4"
                                class="form-check-input show_Commission" {{ ($SubscriptionPlans->commission_fees_type=="2") ? "checked"
                              : "" }} value="2">
                              <label class="form-check-label" for="customColorRadio5">Percentage</label>
                            </div>
                            <div class="form-check form-check-warning">
                              <input type="radio" id="hide_Commission" name="customColorRadio4"
                                class="form-check-input" value="3" {{ ($SubscriptionPlans->commission_fees_type=="3") ?
                              "checked" : "" }}>
                              <label class="form-check-label" for="customColorRadio4">None</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-1">
                        <label class="form-label" for="typeInput">Commission Amount</label>
                        <input class="form-control" type="text" id="commission_fees_amount"
                          value="{{ $SubscriptionPlans->commission_fees_amount}}" name="commission_fees_amount"
                          placeholder="%">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-header" style="padding: 0.5rem 1.5rem;">
                          <label class="form-label" for="typeInput">Withdrawal Charges Add</label>
                        </div>
                        <div class="card-body">
                          <div class="demo-inline-spacing">

                            <div class="form-check form-check-success">
                              <input type="radio" id="customColorRadio5" name="customColorRadio5"
                                class="form-check-input show_withdral" {{ ($SubscriptionPlans->withdrawal_charges_add=="1") ?
                              "checked" : "" }} value="1">
                              <label class="form-check-label" for="customColorRadio5">Flat</label>
                            </div>
                            <div class="form-check form-check-danger">
                              <input type="radio" id="customColorRadio5" name="customColorRadio5"
                                class="form-check-input show_withdral" {{ ($SubscriptionPlans->withdrawal_charges_add=="2") ?
                              "checked" : "" }} value="2">
                              <label class="form-check-label" for="customColorRadio5">Percentage</label>
                            </div>
                            <div class="form-check form-check-warning">
                              <input type="radio" id="hide_withdral" name="customColorRadio5"
                                class="form-check-input" {{ ($SubscriptionPlans->withdrawal_charges_add=="3") ?
                              "checked" : "" }} value="3">
                              <label class="form-check-label" for="customColorRadio4">None</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-1">
                        <label class="form-label" for="typeInput">Withdrawal Charges Amount</label>
                        <input class="form-control" type="text" id="withdrawal_charges_amuont"
                          value="{{ $SubscriptionPlans->withdrawal_charges_amuont}}" name="withdrawal_charges_amuont"
                          placeholder="%">
                      </div>
                    </div>
                  </div>
                </section>

                {{--  <section id="input-mask-wrapper">
                  <label class="form-label mb-1" for="user-name-column">
                    <h4 class="card-title">Payment Gateway Charges</h4>
                  </label>
                  <br>
                  <div class="row">
                    <div class="col-md-3 col-12">
                      <div class="mb-1  ">
                        <input class="form-check-input ml-1" type="checkbox" name="payment_gateway_charge[]"
                          id="payment_gateway_charge" value="1" {{in_array('1',$payment_gateway) ? 'checked' : '' }} />

                        <label class="form-label" for="user-name-column">Visa/Mastercard</label>

                      </div>
                    </div>
                    <div class="col-md-3 col-12">

                      <div class="mb-1  ">
                        <input class="form-check-input ml-1" type="checkbox" name="payment_gateway_charge[]"
                          id="payment_gateway_charge" value="2" {{in_array('2',$payment_gateway) ? 'checked' : '' }} />
                        <label class="form-label" for="user-name-column">Amex</label>


                      </div>
                    </div>

                    <div class="col-md-3 col-12">
                      <div class="mb-1  ">
                        <input class="form-check-input ml-1" type="checkbox" name="payment_gateway_charge[]"
                          id="payment_gateway_charge" value="3" {{in_array('3',$payment_gateway) ? 'checked' : '' }} />
                        <label class="form-label" for="user-name-column">Binance Pay</label>
                      </div>
                    </div>
                    <div class="col-md-3 col-12">
                      <div class="mb-1  ">
                        <input class="form-check-input ml-1" type="checkbox" name="payment_gateway_charge[]"
                          id="payment_gateway_charge" value="4" {{in_array('4',$payment_gateway) ? 'checked' : '' }} />
                        <label class="form-label" for="user-name-column">Spotii</label>


                      </div>
                    </div>
                    <div class="col-md-3 col-12">

                      <div class="mb-1  ">
                        <input class="form-check-input ml-1" type="checkbox" name="payment_gateway_charge[]"
                          id="payment_gateway_charge" value="5" {{in_array('5',$payment_gateway) ? 'checked' : '' }} />
                        <label class="form-label" for="user-name-column">Tabby</label>


                      </div>
                    </div>
                  </div>
                </section>  --}}
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
                              id="payement_gateway_amount" readonly="readonly" placeholder="%" value=" " />

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
                  <textarea class="form-control" id="description" name="description" rows="3"
                    placeholder="">{{ $SubscriptionPlans->note}}</textarea>
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
                                  id="menu" value="{{$menu->id}}" {{ in_array($menu->id, $inserted_menu) ? 'checked' : '' }} readonly />
                                <label class="form-check-label" for="menu">{{$menu->name}}</label>
                              </div>
                            </div>
                          </td>
                          <td>
                            @foreach($menu->sub_menu as $sub_menu)
                            <div class="d-flex align-items-center">
                              <div class="form-check-inline">
                                <input class="form-check-input sub_module{{$key}}" name="sub_menu[]" style="border-color: black;" data-id="{{$menu->id}}" type="checkbox" id="sub_menu" value="{{$sub_menu->id}}" {{ in_array($sub_menu->id, $inserted_subMenu) ? 'checked' : '' }} readonly/>
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
                <button id="submit" name="submit" type="submit" class="btn btn-danger me-1 btn-form-block"
                  value="{{ csrf_token() }}">Submit</button>
              </div>
          </form>
        </div>
      </div>
    </div><!-- card-body -->
  </div><!-- card end -->

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
<script src="{{ asset('js/scripts/pages/app-subscription-edit.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-toastr.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-blockui.js') }}"></script>
<script src="{{ asset('js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>


<script>
    $(document).ready(function () {
        $("#hide_withdral").click(function(){
          document.getElementById('withdrawal_charges_amuont').setAttribute('readonly', true);
        });
        $(".show_withdral").click(function(){
          document.getElementById('withdrawal_charges_amuont').removeAttribute('readonly', true);
        });

      $("#hide_Convenience").click(function(){
           document.getElementById('convenience_fees_amount').setAttribute('readonly', true);
      });
      $(".show_Convenience").click(function(){
           document.getElementById('convenience_fees_amount').removeAttribute('readonly', true);
      });
      $("#hide_Commission").click(function(){
        document.getElementById('commission_fees_amount').setAttribute('readonly', true);
      });
      $(".show_Commission").click(function(){
        document.getElementById('commission_fees_amount').removeAttribute('readonly', true);
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
