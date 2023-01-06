@extends('layouts.main')
@section('title', 'Profile')

@section('content')

<!-- Documents Tab Menu -->
<form method="post" enctype="multipart/form-data" action="{{route('docs_post')}}">
  {!! csrf_field() !!}

  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Owner Documents</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bussiness Documents</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Others</button>
    </li>
  </ul>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <section id="multiple-column-form">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="own_doc1">Upload Document</label>
                      <input type="file" class="form-control" name="own_doc1" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>
                      <select class="form-select" id="ow_document_type1" name="ow_document_type1">
                        <option value="">--Select Type--</option>
                        <option value="1">Passport ID</option>
                        <option value="2">Resident ID</option>
                        <option value="3">License ID</option>
                        <option value="4">Other</option>

                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="own_doc2">Upload Document</label>
                      <input type="file" class="form-control" value="" name="own_doc2" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>
                      <select class="form-select" id="ow_document_type2" name="ow_document_type2">
                        <option value="">--Select Type--</option>
                        <option value="1">Passport ID</option>
                        <option value="2">Resident ID</option>
                        <option value="3">License ID</option>
                        <option value="4">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="own_doc3">Upload Document</label>
                      <input type="file" class="form-control" value="" name="own_doc3" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>
                      <select class="form-select" id="ow_document_type3" name="ow_document_type3">
                        <option value="">--Select Type--</option>
                        <option value="1">Passport ID</option>
                        <option value="2">Resident ID</option>
                        <option value="3">License ID</option>
                        <option value="4">Other</option>

                      </select>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="own_doc4">Upload Document</label>
                      <input type="file" class="form-control" value="" name="own_doc4" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>
                      <select class="form-select" id="ow_document_type4" name="ow_document_type4">
                        <option value="">--Select Type--</option>
                        <option value="1">Passport ID</option>
                        <option value="2">Resident ID</option>
                        <option value="3">License ID</option>
                        <option value="4">Other</option>

                      </select>
                    </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

      <section id="multiple-column-form">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <div class="row">

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_doc1">Upload Document</label>
                      <input type="file" class="form-control" value="" name="bu_doc1" />
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_document_type_1">Document Type</label>

                      <input class="form-control" type="text" name="" id="" value="License *" readonly>
                      <input class="form-control" type="hidden" name="bu_document_type_1" id="bu_document_type_1" value="1">
                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_doc2">Upload Document</label>
                      <input type="file" class="form-control" value="" name="bu_doc2" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_document_type_2">Document Type</label>

                      <input class="form-control" type="text" name="" id="" value="MoA *" readonly>
                      <input class="form-control" type="hidden" name="bu_document_type_2" id="bu_document_type_2" value="2">

                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_doc3">Upload Document</label>
                      <input type="file" class="form-control" value="" name="bu_doc3" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_document_type_3">Document Type</label>

                      <input class="form-control" type="text" name="" id="" value="Share certificate" readonly>
                      <input class="form-control" type="hidden" name="bu_document_type_3" id="bu_document_type_3" value="3">

                    </div>
                  </div>

                  <!-- Do you have tax certificate section -->
                  <div class="col-md-12 col-12 mb-1">

                    <label class="form-label mb-1 mt-1" for="user-name-column"> Do you have tax certificate?</label>
                    <br>

                    <div class="row ">

                      <div class="col-md-4 col-12">
                        <div class="  ">
                          <input class="form-check-input ml-1 tax_document_check_box" type="radio" name="tax_document_check_box" id="tax_document_check_box1" value="1" checked />

                          <label class="form-label" for="user-name-column">Yes</label>

                        </div>
                      </div>

                      <div class="col-md-4 col-12">
                        <div class="  ">
                          <input class="form-check-input ml-1 tax_document_check_box" type="radio" name="tax_document_check_box" id="tax_document_check_box2" value="0" />
                          <label class="form-label" for="user-name-column">No</label>


                        </div>
                      </div>

                      <div class="col-md-4 col-12 ">

                        <a id="tax_cert_button" class="btn btn-primary d-none" role="button" download="tax_certificate.pdf" href="/public/company/template/TaxCertificateTemplate.pdf">
                          Download Template
                        </a>

                      </div>
                    </div>
                  </div>

                  <!-- tax certificate section end -->


                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_doc4">Upload Document</label>
                      <input type="file" class="form-control" value="" name="bu_doc4" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>

                      <input class="form-control" type="text" name="" id="" value="Tax Certificate" readonly>
                      <input class="form-control" type="hidden" name="bu_document_type_4" id="bu_document_type_4" value="4">

                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="bu_doc5">Upload Document</label>
                      <input type="file" class="form-control" value="" name="bu_doc5" />
                    </div>
                  </div>


                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="last-name-column">Document Type</label>

                      <input class="form-control" type="text" name="" id="" value="Proof of Bank Account" readonly>
                      <input class="form-control" type="hidden" name="bu_document_type_5" id="bu_document_type_5" value="5">

                    </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
      <section id="multiple-column-form">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="other_doc1">Upload Document</label>
                      <input type="file" class="form-control" value="" name="other_doc1" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="ot_document_type_1">Document Type</label>
                      <input type="text" class="form-control" id="ot_document_type_1" name="ot_document_type_1">

                    </div>
                  </div>

                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="other_doc2">Upload Document</label>
                      <input type="file" class="form-control" value="" name="other_doc2" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="ot_document_type_2">Document Type</label>
                      <input type="text" class="form-control" id="ot_document_type_2" name="ot_document_type_2">
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="other_doc3">Upload Document</label>
                      <input type="file" class="form-control" value="" name="other_doc3" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="ot_document_type_3">Document Type</label>
                      <input type="text" class="form-control" id="ot_document_type_3" name="ot_document_type_3">
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="other_doc4">Upload Document</label>
                      <input type="file" class="form-control" value="" name="other_doc4" />
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="mb-1">
                      <label class="form-label" for="ot_document_type_4">Document Type</label>
                      <input type="text" class="form-control" id="ot_document_type_4" name="ot_document_type_4">
                    </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  </section>
  <div class="text-center">
    <button type="submit" class="btn btn-danger me-1 btn-form-block">Save</button>
    <div>
</form>
@endsection