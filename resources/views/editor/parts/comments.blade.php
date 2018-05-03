
@foreach($comments as $comment)
    <div class="col-sm-12">
        <a href="#" onclick="prviewCommnet(this)">
            <div><img src="{{url('uploads/' .$comment->comment_path)}}"></div>
            <span>{{str_limit($comment->comment_txt,12)}}</span>
        </a>
    </div>
@endforeach