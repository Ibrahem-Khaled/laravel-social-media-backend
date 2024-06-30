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
            <h3 class="block-title">Edit Room</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.rooms.update', $room->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-roomname">Name</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-roomname" name="name" placeholder="Enter room name.." value="{{$room->name}}">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">Status</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="status" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option @if ($room->status == 'active')
                                            selected
                                        @endif value="active">active</option>
                                        <option @if ($room->status == 'inactive')
                                            selected
                                        @endif value="inactive">inactive</option>


                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">User</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="user_id" style="width: 100%;" data-placeholder="Choose one user..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($users as $user)
                                        <option @if ($user->id == $room->user_id)
                                            selected
                                        @endif value="{{$user->id}}">{{$user->name}}</option>

                                        @endforeach




                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">Category</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="category_id" style="width: 100%;" data-placeholder="Choose one user..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($ctegories as $category)
                                        <option @if ($category->id == $room->category_id)
                                            selected
                                        @endif value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach




                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Slug</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="slug" placeholder="Enter room slug.." value="{{$room->slug}}">
                        </div>



                        <div class="form-group">
                            <label>Room Image</label>
                            <div class="push">
                                <img class="img-avatar" src="{{$room->image}}" alt="">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input  type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="image">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new room image</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-success">
                                Update
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
