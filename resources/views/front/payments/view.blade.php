<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Choose</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"> --}}
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            font-family: 'Montserrat', sans-serif
        }

        body {
            /* background-color: #3ecc6d; */
        }
        .container {
            margin: 20px auto;
            width: 800px;
            /* padding: 30px; */
            box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%); */
        }
        .container1 {
            margin: 20px auto;
            width: 775px;
            /* padding: 30px; */
            /* box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);  */
        }
        .card.box1 {
            width: 350px;
            height: 500px;
            background-color: #0A0A44;
            color: #ffffff;
            border-radius: 0
        } 
        .card.box3 {
            width: 804px;
            height: 100px;
            /* background-color: #3ecc6d; */
            color: #ffffff;
            border-radius: 0;
            margin-left: -2%
        }
        .card.box2 {
            width: 450px;
            height: 508px;
            background-color: #ffffff;
            border-radius: 0
        }

        .text {
            font-size: 13px
        }

        .btn.btn-success {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ddd;
            box-shadow: none;
            height: 20px;
            font-weight: 600;
            font-size: 14px;
            padding: 15px 0px;
            letter-spacing: 1.5px;
            border-radius: 0
        }

        .logo-image-c {
            width: 110px;
            height: 25px;
            /* object-fit: cover */
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 1px solid #ddd
        }

        .btn-outline-primary {
            color: black;
            background-color: #ddd;
            border: 1px solid #ddd
        }

        .btn-outline-primary:hover {
            background-color: #05cf48;
            border: 1px solid #ddd
        }

        .btn-check:active+.btn-outline-primary,
        .btn-check:checked+.btn-outline-primary,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show,
        .btn-outline-primary:active {
            color: #baf0c3;
            background-color: #0A0A44;
            box-shadow: none;
            border: 1px solid #ddd
        }

        .btn-group>.btn-group:not(:last-child)>.btn,
        .btn-group>.btn:not(:last-child):not(.dropdown-toggle),
        .btn-group>.btn-group:not(:first-child)>.btn,
        .btn-group>.btn:nth-child(n+3),
        .btn-group>:not(.btn-check)+.btn {
            border-radius: 50px;
            margin-right: 20px
        }

        form {
            font-size: 14px
        }

        form .btn.btn-primary {
            margin-top: -10%;
            width: 100%;
            height: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #0A0A44;
            border: 1px solid #ddd
        }

        form .btn.btn-primary:hover {
            background-color: #FF0000
        }

        .none {
            display: none;
        }

        div.pay_logo {
            width: 100%;
            padding: 0;
            height: 50px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        div.pay_logo>img {
            width: 250px;
            height: 100px;
            margin-bottom: 15px;
            border-radius: 2px;
            cursor: pointer;
        }

        .radio_btn {
            cursor: pointer;
        }

        .box1 {
            color: #ffffff;
        }

        @media (max-width:750px) {
            .container {
                padding: 10px;
                width: 100%
            }

            .text-green {
                font-size: 14px
            }

            .card.box1,
            .card.box2 {
                width: 100%
            }

            .nav.nav-tabs .nav-item .nav-link {
                font-size: 12px
            }
        }

        div.pay_logo img:focus {
            /* color: #fff; */
            background-color: #0b5ed7;
            border-color: #0a58ca;
            box-shadow: 0 0 0 0.25rem rgb(49 132 253 / 50%);
        }

        body .loadingi {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 50px;
            cursor: default;
            text-shadow: none !important;
            color: transparent !important;
            opacity: 1;
            pointer-events: auto;
            -webkit-transition: all 0s linear, opacity 0.1s ease;
            transition: all 0s linear, opacity 0.1s ease;
        }

        body .loadingi:after {
            content: '';
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            margin-left: -10px;
            border-radius: 50%;
            border: 12px solid #fff;
            border-color: #fff transparent #fff transparent;
            animation: loadingi 1.2s infinite;
        }

        ul li {
            color: #AAAAAA;
            display: block;
            position: relative;
            float: left;
            width: 100%;
            height: 100px;
            border-bottom: 1px solid #333;
        }

        ul li input[type=radio] {
            position: absolute;
            visibility: hidden;
        }

        ul li label {
            display: block;
            position: relative;
            font-weight: 300;
            font-size: 1.35em;
            padding: 25px 25px 25px 80px;
            /* margin: 10px auto; */
            height: 30px;
            z-index: 9;
            cursor: pointer;
            -webkit-transition: all 0.25s linear;
        }

        ul li:hover label {
            color: #000;
        }

        ul li .check {
            display: block;
            position: absolute;
            border: 5px solid #AAAAAA;
            border-radius: 100%;
            height: 25px;
            width: 25px;
            top: 35px;
            left: 45px;
            z-index: 5;
            transition: border .25s linear;
            -webkit-transition: border .25s linear;
        }

        ul li:hover .check {
            border: 5px solid #aaa;
        }

        ul li .check::before {
            display: block;
            position: absolute;
            content: '';
            border-radius: 100%;
            height: 10px;
            width: 10px;
            top: 2px;
            left: 3px;
            margin: auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
        }

        input[type=radio]:checked~.check {
            border: 5px solid #3ecc6d;
        }

        input[type=radio]:checked~.check::before {
            background: #3ecc6d;
        }

        input[type=radio]:checked~label {
            color: #3ecc6d;
        }

        .signature {
            margin: 10px auto;
            padding: 10px 0;
            width: 100%;
        }

        .signature p {
            text-align: center;
            font-family: Helvetica, Arial, Sans-Serif;
            font-size: 0.85em;
            color: #AAAAAA;
        }

        .signature .much-heart {
            display: inline-block;
            position: relative;
            margin: 0 4px;
            height: 10px;
            width: 10px;
            background: #AC1D3F;
            border-radius: 4px;
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }
		
		.pxsaas {
			padding: 0 2.7rem;
		}

        .signature .much-heart::before,
        .signature .much-heart::after {
            display: block;
            content: '';
            position: absolute;
            margin: auto;
            height: 10px;
            width: 10px;
            border-radius: 5px;
            background: #AC1D3F;
            top: -4px;
        }

        .signature .much-heart::after {
            bottom: 0;
            top: auto;
            left: -4px;
        }

        .signature a {
            color: #AAAAAA;
            text-decoration: none;
            font-weight: bold;
        }
		p{
			margin-bottom:0px;
		}
        @keyframes loadingi {
            0% {
                transform: rotate(0);
                animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
            }

            50% {
                transform: rotate(900deg);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }

            100% {
                transform: rotate(1800deg);
            }
        }
		
		.avatar{
			margin-bottom:0.1rem !important;
		}
    </style>
</head>

<body>
    <div class="container1 bg-light  align-items-center" style="margin-bottom: -1%; ">
      <div class="card box3 shadow-sm justify-content-center align-items-center" style="border: 12px solid #f8f9fa;">
        @php   $org= org_branded_logo($invoice->organisation_id);@endphp
       
        @if(isset($org->moreInfo))
          <p class="avatar">
            @if(isset($org->org_logo) && $org->moreInfo->branded_pay_1 != '0')
               <img
                src="/public/company/logo/{{$org->org_logo}}"
                class="congratulations-img-right"
                alt="card-img-right"
                height="40" 
                width="40"
            />
            @else
           <img
                src="/public/company/logo/logo-360.png"
                class="congratulations-img-right logo-image-c"
                alt="card-img-right"
                height="40" 
                width="40"
            />
  <defs>
    <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
      <stop stop-color="#000000" offset="0%"></stop>
      <stop stop-color="#FFFFFF" offset="100%"></stop>
    </linearGradient>
    <linearGradient
      id="invoice-linearGradient-2"
      x1="64.0437835%"
      y1="46.3276743%"
      x2="37.373316%"
      y2="100%"
    >
    </linearGradient>
  </defs>
  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <g transform="translate(-400.000000, -178.000000)">
      <g transform="translate(400.000000, 178.000000)">
        <path
          class="text-primary"
          d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
          style="fill: currentColor"
        ></path>
        <path
          d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
          fill="url(#invoice-linearGradient-1)"
          opacity="0.2"
        ></path>
        <polygon
          fill="#000000"
          opacity="0.049999997"
          points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"
        ></polygon>
        <polygon
          fill="#000000"
          opacity="0.099999994"
          points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"
        ></polygon>
        <polygon
          fill="url(#invoice-linearGradient-2)"
          opacity="0.099999994"
          points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"
        ></polygon>
      </g>
    </g>
  </g>
</svg>  
              <!-- <span class="user-status text-danger invoice-logo" style="font-size:25px;"><b>
               Rental 360</b>
              </span> -->
            @endif

           
			</p><p class=""style="font-size:14px; color:#000000;"><b>{{( isset($org->org_name) ? $org->org_name : '' )}}</b></p>
        @else
        <svg style="idth: 83px;
    height: 39px;"
  viewBox="0 0 139 95"
  version="1.1"
  xmlns="http://www.w3.org/2000/svg"
  xmlns:xlink="http://www.w3.org/1999/xlink"
  height="24"
>
  <defs>
    <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
      <stop stop-color="#000000" offset="0%"></stop>
      <stop stop-color="#FFFFFF" offset="100%"></stop>
    </linearGradient>
    <linearGradient
      id="invoice-linearGradient-2"
      x1="64.0437835%"
      y1="46.3276743%"
      x2="37.373316%"
      y2="100%"
    >
    </linearGradient>
  </defs>
  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <g transform="translate(-400.000000, -178.000000)">
      <g transform="translate(400.000000, 178.000000)">
        <path
          class="text-primary"
          d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
          style="fill: currentColor"
        ></path>
        <path
          d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
          fill="url(#invoice-linearGradient-1)"
          opacity="0.2"
        ></path>
        <polygon
          fill="#000000"
          opacity="0.049999997"
          points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"
        ></polygon>
        <polygon
          fill="#000000"
          opacity="0.099999994"
          points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"
        ></polygon>
        <polygon
          fill="url(#invoice-linearGradient-2)"
          opacity="0.099999994"
          points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"
        ></polygon>
      </g>
    </g>
  </g>
</svg>  
              <!-- <span class="user-status text-danger invoice-logo" style="font-size:25px;"><b>
Rental 360</b>
              </span> -->
        @endif
              
        </div>  
    </div>
    <div class="container bg-light d-md-flex align-items-center">
        <div class="card box1 shadow-sm p-md-5 p-md-5 p-4" style="margin-top:-1%;">
            <div class="fw-bolder mb-4">
                <span class="fas fa-dollar-sign"></span>
                <span class="ps-1">AED
                    {{ $type == 'Short Payment' ? round(optional($invoice)->amount, 2) : round(optional($invoice)->grand_total, 2) }}</span>
            </div>
            <div class="d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between text">
                    <span class="">Sub Total</span>
                    <span class="fas fa-dollar-sign">
                        <span class="ps-1">AED
                            {{ $type == 'Short Payment' ? round(optional($invoice)->amount, 2) : round(optional($invoice)->subtotal, 2) }}</span>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between text">
                    <span class="">Discount</span>
                    <span class="fas fa-dollar-sign">
                        <span class="ps-1">AED {{ round(optional($invoice)->subtotal_discount, 2) }}</span>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between text">
                    <span class="">Promotion</span>
                    <span class="fas fa-dollar-sign">
                        <span class="ps-1">AED {{ round(optional($invoice)->promotion_value, 2) }}</span>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between text">
                    <span class="">Delivery Charge</span>
                    <span class="fas fa-dollar-sign">
                        <span class="ps-1">AED {{ round(optional($invoice)->delivery_charge, 2) }}</span>
                    </span>
                </div>
                <div class="d-flex align-items-center justify-content-between text mb-4">
                    <span>Total</span>
                    <span class="fas fa-dollar-sign">
                        <span class="ps-1">AED
                            {{ $type == 'Short Payment' ? round(optional($invoice)->amount, 2) : round(optional($invoice)->grand_total, 2) }}</span>
                    </span>
                </div>
                @if ($invoice)
                    <div class="border-bottom mb-4"></div>
                    <div class="d-flex flex-column mb-4">
                        <span class="far fa-file-alt text">
                            <span class="">Invoice ID:</span>
                        </span>
                        <span class="">INV000{{ optional($invoice)->id }}</span>
                    </div>
                @endif
                <div class="border-bottom mb-4"></div>
                <div class="d-flex flex-column mb-4">
                    <span class="far fa-file-alt text">
                        <span class="">Customer:</span>
                    </span>
                    <span
                        class="text">{{ $type == 'Short Payment' ? optional($invoice)->full_name : optional($invoice)->name }}</span>
                    <span class="text ">{{ optional($invoice)->email }}</span>
                    <span class="text">{{ optional($invoice)->phone }}</span>
                </div>
                <div class="d-flex flex-column mb-5">
                    <span class="far fa-calendar-alt text">
                        <span class="">Payment date:</span>
                    </span>
                    <span class="">{{ now()->format('d M,Y') }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between text mt-5">
                    <div class="d-flex flex-column text">
                        <span>Customer Support:</span>
                        <span>online chat 24/7</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card box2 shadow-sm">
            <div class="d-flex align-items-center justify-content-center p-md-5 p-4">
                <span class="h5 fw-bold m-0">Payment Methods</span>
            </div>
            <div class="pay_error px-3 none">
                <div class="alert alert-danger er" role="alert">
                </div>
            </div>
            <form method="post" action="#">
                <div class="row">

                    <ul>
                        <li>
						<div class="pxsaas">
                            <input type="radio" id="f-option" name="selector">
                            <label for="f-option"><img
                src="/public/company/logo/credit-card-logo.png"
                class="congratulations-img-right"
                alt="card-img-right"
                width="100%"
            /></label>
                            <div class="check"></div>
							</div>
                        </li>

                        <!-- <li>
                            <input type="radio" id="s-option" name="selector">
                            <label for="s-option">Crypto Currency Payment</label>

                            <div class="check">
                                <div class="inside"></div>
                            </div>
                        </li> -->
<!-- 
                        <li>
                            <input type="radio" id="t-option" name="selector">
                            <label for="t-option">Pay Later</label>

                            <div class="check">
                                <div class="inside"></div>
                            </div>
                        </li> -->
                    </ul>
                    <div class="box2 p-md-5 p-4" style="margin-top: 200px">
                        <button class="btn btn-primary" id="mayke_pay" type="button">Make Payment</button>
                    </div>
                </div>
            </form>

            <form id="trasaction_form" method="post">
                <input type="hidden" id="payment_method" name="payment_method" value="">
                <!-- @if ($type == 'Invoice')
<input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoice->id }}">
@else
@endif -->
                <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $invoice->id }}">
            </form>


        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#mayke_pay').on('click', function() {
            var invoice_id = $('#invoice_id').val();
            $("#mayke_pay").addClass("loadingi");

            $.ajax({

                url: "/transaction_amount_save",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    invoice_id: invoice_id,
                    type: "{{ $type }}"

                },
                cache: false,
                success: function(dataResult) {
                    if (dataResult.redirect) {
                        window.open(dataResult.redirect);
                        // window.location = dataResult.redirect;
                        console.log(dataResult.redirect);
                    }

                    if (dataResult.error) {
                        console.log(dataResult.error);
                        console.log(dataResult.error.message);
                        if (dataResult.error) {
                            $('.pay_error .er').text(dataResult.error);
                        } else {
                            $('.pay_error .er').text('Exceeds Limits');
                        }
                        $('.pay_error').removeClass('none');
                    }
                    $("#mayke_pay").removeClass("loadingi");
                }
            });

        });

    });
</script>

</html>
