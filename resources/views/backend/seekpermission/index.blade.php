@extends('backend.layouts.app')

@section('content')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

@endpush
    <section class="content-header">
        {{-- <h1 class="pull-left">{{ __('dashboard.attributes.prodcut') }}</h1> --}}

    </section>
    <div class="content">
        <div class="clearfix"></div>
  @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
    {{  Session::get('success') }}
    </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-denger" role="alert">
  {{  Session::get('error') }}
  </div>
  @endif
        <div class="clearfix"></div>
        <div class="box box-primary">
 
            <div class="box-body">
                    @include('backend.seekpermission.table')

                    <div id="showModal"></div>
            </div>
        </div>

    </div>
@push('js')
  
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
     {{-- datatable --}}
     <script>
      $(function() {
          $('#form').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{!! route('admin.request.datatable') !!}',
              columns: [
                  // { data: 'id', name: 'id' },
                  { data: 'note', name: 'note' },
                  { data: 'status', name: 'status' },
                  { data: 'created_at', name: 'created_at' },
                  {data: 'action', name: 'action', orderable: false, searchable: false}
              ]
          });
      });
      $(document).on('click','#show',function(e){
        // e.preventDefault();
        // console.log($(this).data('url'))
          $.ajax({
              type: "get",
              url: $(this).data('url'),
            //   data: "data",
              dataType: "html",
              success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                 $('#showModal').html(response.modal);
                 $('#chickToshowModal').click();
              }
          });
      });
  </script>
@endpush
@endsection

