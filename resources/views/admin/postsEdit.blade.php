@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


@endsection
@section('main')

   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- Posts Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Edit Posts</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.posts.update', $post->id)}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="one-profile-edit-postname">Title</label>
                            <input required  type="text" class="form-control" id="one-profile-edit-postname" name="title" placeholder="Enter post name.." value="{{$post->title}}">
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">Status</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="status" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        <option @if ($post->status == 'active')
                                            selected
                                        @endif value="active">active</option>
                                        <option @if ($post->status == 'inactive')
                                            selected
                                        @endif value="inactive">inactive</option>


                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-name">User</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="user_id" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($users as $user)
                                        <option @if ($user->id == $post->user_id)
                                            selected
                                        @endif value="{{$user->id}}">{{$user->name}}</option>

                                        @endforeach




                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="one-profile-edit-email">Body</label>
                            <textarea class="form-control" id="example-textarea-input" name="body" rows="4" placeholder="Enter Post Body..">{{$post->body}}</textarea>
                        </div>



                        <div class="form-group">
                            <label>Posts Image</label>
                            <div class="push">
                                <img class="img-avatar" src="{{$post->image}}" alt="">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input  type="file" class="custom-file-input" data-toggle="custom-file-input" id="one-profile-edit-avatar" name="image">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new post image</label>
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
    <!-- END Posts Profile -->






</div>
<!-- END Page Content -->
@endsection


@section('js-after')

<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<script>jQuery(function () { One.helpers(['flatpickr', 'select2' , 'datepicker']);  });</script>
@endsection
