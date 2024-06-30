@extends('layouts.backend.theme')

@section('css-before')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">

<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


@endsection
@section('main')

    <div class="content">

  <!-- Dynamic Table with Export Buttons -->
  <div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List Likes </h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
            <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Post</th>
                    <th>User</th>

                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1 ;
                @endphp
                @foreach ($likes as $like)

                <tr id="like-row-{{$like->id}}">
                    <td class="text-center font-size-sm">{{$i}}</td>
                    <td class="font-w600 font-size-sm">
                        <a href="{{route('admin.posts.edit', $like->post->id) }}">{{$like->post->title}}</a>
                    </td>

                    <td class="font-w600 font-size-sm">
                        <a href="{{route('admin.users.edit', $like->user->id) }}">{{$like->user->name}}</a>
                    </td>

                    <td class="d-none d-sm-table-cell font-size-sm">
                        <span  > <a href="{{route('admin.likes.edit' , $like->id)}}"> <i class="fa fa-edit" aria-hidden="true"></a></i> </span>
                        <span class="delete-like" data-like-id="{{$like->id}}"> <a href=""> <i class="fa fa-trash" aria-hidden="true"></a></i></span>
                    </td>

                </tr>

                @php
                    $i++;
                @endphp

                @endforeach


            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table with Export Buttons -->

</div>
@endsection


@section('js-after')
<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
<script type="module">
import Swal from 'sweetalert2';

  </script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('.delete-like').forEach(function (element) {
        element.addEventListener('click', function (event) {
          event.preventDefault();
          const likeId = this.getAttribute('data-like-id');
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              // Remove the row from the table
              const row = document.getElementById(`like-row-${likeId}`);

              $.ajax({

                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "http://127.0.0.1:8000/admin/likes/delete/" +likeId ,
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': likeId,
                },
                dataType: 'json',
                contentType: false,
                processData: false,
            // contentType:false,

            success:

            function(response){

                if (row) {
                row.remove();
              }
              // Optionally, send an AJAX request to the server to delete the like from the database
              Swal.fire(
                'Deleted!',
                'The like has been deleted.',
                'success'
              );

            },
            });

            }
          });
        });
      });
    });
  </script>



@endsection