@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">


@endsection
@section('main')

   <!-- Page Content -->
   <div class="content content-boxed">
    <!-- Like Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Add New Like</h3>
        </div>
        <div class="block-content">
            <form action="{{route('admin.likes.create')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="row push">
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-8 col-xl-5">

                        <div class="form-group">
                            <label for="one-profile-edit-name">Post</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="post_id" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($posts as $post)
                                        <option value="{{$post->id}}">{{$post->title}}</option>

                                        @endforeach




                                    </select>
                                </div>
                        </div>




                        <div class="form-group">
                            <label for="one-profile-edit-name">User</label>

                                <div class="form-group">
                                    <select class="js-select2 form-control" id="" name="user_id" style="width: 100%;" data-placeholder="Choose one role..">
                                        <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>

                                        @endforeach




                                    </select>
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
    <!-- END Like Profile -->






</div>
<!-- END Page Content -->
@endsection


@section('js-after')

<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>


<script>jQuery(function () { One.helpers(['flatpickr', 'select2' , 'datepicker']);  });</script>
@endsection
