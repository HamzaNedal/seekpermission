<form action="{{ route('admin.'.$route.'.destroy', ['id'=>$data->id]) }}" method="post">
    @method('delete')
    @csrf
<div class='btn-group'>
    @if ($route!='request')
      <a href="{{ route('admin.'.$route.'.edit', [$data->id]) }}" class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
      @else
      @if ($data->status !='pendding')
         <a data-url="{{ route('admin.'.$route.'.show', [$data->id]) }}" id="show" class='btn btn-default btn-xs'><i class="fa fa-eye"></i></a>
      @endif
    @endif
    @if ($data->status =='pendding')
    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('هل انت متأكد من الحذف ؟')"><i class="fa fa-trash"></i></button>
 @endif
</div>
</form>