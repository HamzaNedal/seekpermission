@extends('backend.layouts.app')

@section('content')
    {{-- <section class="content-header">
        <h1>
            Role And Permmison
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'roleAndPermmisons.store']) !!}

                        @include('role_and_permmisons.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div> --}}

    @push('css')

@endpush
 <!-- Content Header (Page header) -->
 <div class="content-header">
  {{-- @include('adminlte-templates::common.errors') --}}

    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Create Role</h1>
        </div><!-- /.col -->
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col --> --}}
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Role </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="main" action="{{ route('admin.role.store') }}" method="post">
                    @csrf
                    @include('backend.role_and_permmisons.fields')
                {{-- @include('backend.users.fields') --}}
                </form>
              </div>
              <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      @push('js')
          <script>
          //   $('#role').on('change',function(){
          //  let id = $(this).val();
          //       $.ajax({
          //         url: "{{ url('/getPermissions') }}",
          //         data: {
          //           id:id
          //         },
          //       }).done(function(res) {
          //         // console.log(res[0].length);
          //         checked = false;
          //         $('#permissions').html('');
          //         for (let index = 0; index < res[1].length; index++) {
          //           for (let index1 = 0; index1 <  res[0].length; index1++) {
          //             // console.log(res[0][index1].name);
          //             if(res[1][index].name == res[0][index1].name){
          //                 checked = true;
          //             }
          //           }

          //           $('#permissions').append(
          //           `        
          //           <div class="form-check">
          //               <input class="form-check-input" type="checkbox" name='permission[]' value="${res[1][index].name}" ${checked ? 'checked' : ''}>
          //               <label class="form-check-label">${res[1][index].name}</label>
          //           </div>`
          //         );
          //         checked = false;
          //         }
                

          //       });
          //   })
          
          </script>
      @endpush  
@endsection
