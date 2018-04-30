@foreach($items as $item)
    <a href="{{route('editor', ['id' => $item->id])}}">
        {{$item->item_name}}
        <img src="{{url('uploads/' .$item->file_path)}}">

    </a>
@endforeach