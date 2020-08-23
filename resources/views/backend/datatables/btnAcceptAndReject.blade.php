<td>
    <a class="btn btn-warning" style="color: #fff" href="{{route('admin.'.$route,['user_id'=>$data->user_id,'order_id'=>$data->id,'status'=>1])}}" data-target="#modal-danger">  قبول  </a>
    <a class="btn btn-danger" style="color: #fff" href="{{route('admin.'.$route,['user_id'=>$data->user_id,'order_id'=>$data->id,'status'=>2])}}" data-target="#modal-danger">  رفض  </a>
</td>