@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


@endsection
@section('main')

   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Add New User</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.users.create')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-username">Name</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-username" name="name" placeholder="Enter user name.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Email Address</label>
                            <input required  type="email" class="form-control" id="one-profile-edit-email" name="email" placeholder="Enter user email.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">Role</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="role" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="superAdmin">superAdmin</option>
                                        <option value="admin">admin</option>
                                        <option value="user">user</option>
                                        <option value="editor">editor</option>

                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Phone Number</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="phone" placeholder="Enter user phone number.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Address</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="address" placeholder="Enter user address.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">Gender</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="example-select2" name="gender" style="width: 100%;" data-placeholder="Choose gender..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option value="male">male</option>
                                        <option value="female">female</option>

                                    </select>
                                </div>
                        </div>

                        <div class="form-group ">
                            <label for="example-flatpickr-custom">Date Of Birth</label>
                            <input required  type="text" class="js-flatpickr form-control bg-white" id="example-flatpickr-custom" name="birthDay" placeholder="Choice date of birth" data-date-format="Y-m-d">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Slug</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="slug" placeholder="Enter user slug.." value="">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Password</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="password" placeholder="Enter user password.." value="">
                        </div>

                        <div class="form-group">
                            <label>User Image</label>
                            <div class="push">
                                <img class="img-avatar" src="{{asset('assets/media/avatars/avatar13.jpg')}}" alt="">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input required  type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="image">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new user image</label>
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
    <!-- END User Profile -->






</div>
<!-- END Page Content -->
@endsection


@section('js-after')

<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<script>jQuery(function () { One.helpers(['flatpickr', 'select2' , 'datepicker']);  });</script>
@endsection
