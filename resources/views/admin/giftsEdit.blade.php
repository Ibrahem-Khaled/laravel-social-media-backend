@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


@endsection
@section('main')

   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- Gift Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Edit Gift</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.gifts.update' ,$gift->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-giftname">Title</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-giftname" name="title" placeholder="Enter gift title.." value="{{$gift->title}}">
                        </div>



                        <div class="form-group">
                            <label for="one-profile-edit-email">Price</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-email" name="price" placeholder="Enter gift price.." value="{{$gift->price}}">
                        </div>

                        <div class="form-group">
                            <label>Gift Image</label>
                            <div class="push">
                                <img class="img-avatar" src="{{$gift->image}}" alt="">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input   type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="image">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new gift image</label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Gift Video</label>
                            <div class="push">
                                <video src="{{$gift->video}}" autoplay controls></video>
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input   type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="video">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new gift image</label>
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
    <!-- END Gift Profile -->






</div>
<!-- END Page Content -->
@endsection


@section('js-after')

<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<script>jQuery(function () { One.helpers(['flatpickr', 'select2' , 'datepicker']);  });</script>
@endsection
