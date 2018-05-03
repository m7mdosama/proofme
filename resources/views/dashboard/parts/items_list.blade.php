{{--Hello {{Auth::user()->name}}--}}
@if(Auth::user()->role_id==3) {{--only designer--}}
<div class="col-sm-3">
    <form method="post" id="upload-form" enctype="multipart/form-data" onclick="document.getElementById('design_image').click()">
        {{ csrf_field() }}
        <input accept=".jpg,.png,.pdf,.jpeg" type="file" id="design_image" name="design_image" />
        <a href="#">
            <div></div>
            <span>Add new Proof</span>
        </a>
    </form>
</div>
@endif

@foreach($items as $item)
    <div class="col-sm-3">
        <a href="{{route('editor', ['id' => $item->id])}}">
            <div><img src="{{url('uploads/' .$item->file_path)}}"></div>
            <span>{{str_limit($item->item_name,12)}}</span>
        </a>
    </div>
@endforeach