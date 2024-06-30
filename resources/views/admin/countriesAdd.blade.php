@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


@endsection
@section('main')

   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- Country Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Add New Country</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.countries.create')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-roomname">Name</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-roomname" name="name" placeholder="Enter country name.." value="">
                        </div>



                        <div class="form-group">
                            <label for="one-profile-edit-name">Status</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="status" style="width: 100%;" data-placeholder="Choose one status..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="active">active</option>
                                        <option value="inactive">inactive</option>


                                    </select>
                                </div>
                        </div>




                        <div class="form-group">
                            <label for="one-profile-edit-email">CCA2</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="cca2" placeholder="Enter country slug.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Country Code</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="code" placeholder="Enter country password.." value="">
                        </div>

                        <div class="form-group">
                            <label>Country Image</label>
                            <div class="push">
                                <img class="img-avatar" src="{{asset('assets/media/avatars/avatar13.jpg')}}" alt="">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input required  type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="flag">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new country image</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Country Profile -->






</div>
<!-- END Page Content -->
@endsection


@section('js-after')

<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<script>jQuery(function () { One.helpers(['flatpickr', 'select2' , 'datepicker']);  });</script>
@endsection
