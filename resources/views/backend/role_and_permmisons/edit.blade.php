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
                   {!! Form::model($roleAndPermmison, ['route' => ['roleAndPermmisons.update', $roleAndPermmison->id], 'method' => 'patch']) !!}

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
         <h1 class="m-0 text-dark">edit role</h1>
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
                 <h3 class="card-title"> صلاحية</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form role="form" action="{{ route('admin.role.update',['id'=>$role->id]) }}" method="post">
                   @csrf
                   @method('put')
                   @include('backend.role_and_permmisons.fields')
               {{-- @include('backend.users.fields') --}}
               </form>
             </div>
             <!-- /.card -->
           </div>
       </div><!-- /.container-fluid -->
     </section>
     <!-- /.content -->
@endsection