@extends('layouts.main')
@section('title', 'Change Password')
@section('content')
    <section id="ApiKeyPage">
        <!-- create Change Password -->
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">Create a New Password</h4>
            </div>
            <div class="row">
                <div class="col-md-5 order-md-0 order-1">
                    <div class="card-body">
                        <!-- form -->
                        <form id="createApiForm" method="post" action="{{ route('change.password.update') }}" class="myForm">
                            @csrf
                            <div class="mb-2">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control form-control-merge" id="password"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" tabindex="1" autofocus />
                            </div>

                            <div class="mb-2">
                                <input type="password" class="form-control form-control-merge" id="password-confirm"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password-confirm" tabindex="2" />
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Change Password</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-7 order-md-1 order-0">
                    <div class="text-center">
                        <img class="img-fluid text-center" src="{{ asset('images/illustration/pricing-Illustration.svg') }}"
                            alt="illustration" width="310" />
                    </div>
                </div>
            </div>
        </div>
        </div>

    @endsection
