
<div class="card-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name"@isset($employee)  value="{{ $employee->name }}" @endisset value="{{ old('name') }}"  name="name" placeholder="enter name">
        </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" @isset($employee) value="{{ $employee->email }}" @endisset value="{{ old('email') }}"  name="email" placeholder="enter email ">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="password">password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="enter password ">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="identify">Identify</label>
        <input type="text" class="form-control" id="identify" @isset($employee) value="{{ $employee->identify }}" @endisset value="{{ old('identify') }}"  name="identify" placeholder="enter identify ">
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" @isset($employee) value="{{ $employee->address }}" @endisset value="{{ old('address') }}"  name="address" placeholder="enter address ">
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="phone">phone</label>
        <input type="text" class="form-control" id="phone" @isset($employee) value="{{ $employee->phone }}" @endisset value="{{ old('phone') }}"  name="phone" placeholder="enter phone ">
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Date:</label>
        <input type="date" name="dob" class="form-control datetimepicker-input" value="{{ old('dob')}}" data-target="#reservationdate">
      </div>
    </div>
  </div>
  <div class="form-group">
        
    <label for="exampleInputPassword1">Roles</label>
    @foreach ($roles as $role)
      <div class="form-check">
        <input  id="{{  $role->name }}" class="form-check-input" type="radio" name="role"  value="{{ $role->name }}" @isset($employee) {{  $employee->hasRole($role->name) ? 'checked':'' }} @endisset>
        <label for="{{  $role->name }}" class="form-check-label">{{ $role->name }}</label>
      </div>  
    @endforeach
  </div>

  </div>
  <!-- /.card-body -->

