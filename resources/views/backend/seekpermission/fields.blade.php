
<div class="card-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control"  name="note">@isset($request)  value="{{ $request->note }}" @endisset</textarea>

        </div>
    </div>
  </div>
</div>
  <!-- /.card-body -->

