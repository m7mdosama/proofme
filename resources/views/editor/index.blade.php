@extends('layouts.master')

@section('content')
    <div class="container editor">
        <div class="row">
            <div class="col-sm-9 text-center">
                <h3> {{substr($item->item_name,0,-4)}} </h3>
                <img style="display: none;" src="{{url('uploads/' .$item->file_path)}}">
                <div style="display: block;margin: 0 auto;width: 700px;padding-top: 92px;">
                    <div id="myCanvas" style="position:relative"></div>
                </div>


                {{--@if($itemProofers)--}}
                    {{--@foreach($itemProofers as $itemProofer)--}}
                        {{--{{$itemProofer->proofer->name}}--}}
                    {{--@endforeach--}}
                {{--@endif--}}
                <div class="row">
                    @if( in_array(Auth::user()->role_id, [1, 2] ))
                    <button id="accept" type="button" class="btn btn-primary" onclick="window.location='{{route('editor.accept',[$item->id])}}'">
                        Accept
                    </button>
                    @endif
                    @if( in_array(Auth::user()->role_id, [1, 3] ))
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prooferModalCenter">
                            Proofers ( {{count($itemProofers)}} )
                        </button>
                    @endif
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commentModalCenter">
                    Add Comment
                    </button>
                </div>
            </div>
            <div id="comments-div" class="col-sm-3">
                @include('editor.parts.comments')
            </div>
        </div>
    </div>
<div class="modal fade" id="prooferModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">The Reviewers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('addProofer')}}">
            <div class="modal-body">
                    {{csrf_field()}}
                    @foreach($users as $user)
                        <label class="proofer-label">
                            <input type="checkbox" {{ in_array($user->id, $itemProofers->pluck('user_id')->all()) ? 'checked' : ''}} name="proofers[]" value="{{$user->id}}" />
                            {{$user->name}}
                        </label>
                    @endforeach
                    <input type="hidden" name="item_id" id="item_id" value="{{$item->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="commentModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                        <textarea class="form-control" rows="10" cols="1000" id="commentxt" name="commentxt"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="add" class="btn btn-primary"  data-dismiss="modal">Add Comment</button>
                </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{asset('assets/js/djaodjin.js')}}"></script>
    <script>
        var options={
            color: 'blue',
            bootstrap: true,
            images: ['{{url('uploads/' .$item->file_path)}}'],
            onExport: function(image){},
            width: 700,			// Width of canvas
            height: 600,			// Height of canvas
            color:"#ff2a12", 			// Color for shape and text
            type : "rectangle",		// default shape: can be "rectangle", "arrow" or "text"
            //images: null,			// Array of images path : ["images/image1.png", "images/image2.png"]
            linewidth:4,			// Line width for rectangle and arrow shapes
            fontsize:"25px",		// font size for text
            //bootstrap: true,		// Bootstrap theme design
            position: "top",		// Position of toolbar (available only with bootstrap)
            idAttribute: "id",		// Attribute to select image id.
            selectEvent: "change",	// listened event to select image
            unselectTool: false		// display an unselect tool for mobile
            //onExport: function(image){}
        };

        $(document).ready(function(){
            $('#myCanvas').annotate(options);
            $("#add").click(function(event) {
                var txt = $('#commentxt').val();
                $('#commentxt').val('');
                $('#myCanvas').annotate("export", {type: "image/jpeg", quality: 1},function(d){
                    $.ajax({
                        type: "POST",
                        url: '{{route('addComment')}}',
                        data: {
                            _token: '{{csrf_token()}}',
                            comment : txt,
                            image : d,
                            item_id:'{{$item->id}}'
                        },
                        success: function(data)
                        {
                            if (data) {
                                $('#comments-div').html(data);
                                $('#myCanvas').annotate("destroy");
                                $('#myCanvas').annotate(options);
                            }
                            else {
                                // alert('Error');
                            }
                        },
                        error: function( error )
                        { alert( error.responseText ); }
                    });
                });
            });
        });
        function prviewCommnet(d){
            var imgpth =$(d).find('img')[0].src
            $("#myCanvas").annotate("push", imgpth);
        }


    </script>
    <style>
        .container.editor {
            width: 100%;
            padding: 75px 0  0;
        }
        .container.editor > .row{
            margin: 0;
        }
        .proofer-label{
            display: block;
            line-height: 48px;
            padding: 0   130px  0 10px;
            margin: 0 auto;
            font-size: 25px;
        }
        .proofer-label input[type="checkbox"] {
            transform: scale(2.5);
            margin: 0 15px;
        }
        h5#exampleModalLongTitle {
            font: 30px/30px FANTASY;
            color: #17365a;
            display: inline-block;
        }
        .modal-header .close {
            margin-top: 4px;
            display: none;
        }
        .modal-dialog {
            width: 350px;
            min-height: calc(100% - (3rem * 2));
            display: flex;
            align-items: center;
        }
        .container.editor button[type="button"]{
            margin: 7px 50px 0;
            width: 150px;
            font-size: large;
        }


        .annotate-container{
            position: relative;
        }

        .annotate-container > [id^=baseLayer]{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            background: url({{asset('assets/img/png.png')}}),#e2e2e2;
            background-blend-mode: hard-light;
            border: 1px solid black;
            border-radius: 7px;
        }

        .annotate-container > [id^=drawingLayer]{
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            background: transparent;
        }
        .myanno {
            padding: 19px;
            margin: 1px;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            font-size: 0;
        }
        .myrect {
            background-image: url({{asset('assets/img/anno/rect.svg')}});
        }
        .mycyrc {
            background-image: url({{asset('assets/img/anno/sprite.svg')}});
            background-position: -4px -239px;
        }
        .mytext {
            background-image: url({{asset('assets/img/anno/text1.png')}});
            background-size: 100% 100%;
        }
        .myarrow{
            background-image: url({{asset('assets/img/anno/arrow.svg')}});
        }
        .myfreehand{
            background-image: url({{asset('assets/img/anno/path.svg')}});
        }
        .myannolabel {
            background-color: #eeeeee88;
            border-color: #9c9c9c;
            margin: 0 15px;
            border-radius: 10px !important;
        }
        .myannolabel, i.myanno{
            transition: .3s ease;
        }
        .myannolabel:hover {
            transform: scale(1.4);
            margin: 0 18px !important;


        }
        .myannolabel.active{
            background-color: rgb(43, 135, 198);
            border-color: #2a2a2b;
        }
        .myannolabel:hover i.myanno{
            transform: scale(1.1);
        }
        label.btn.myannolabel {
            padding: 16.7px;
        }
        .myannolabel input[type="radio"] {
            display: none;
        }
        .my-image-selector {
            padding: 40px 8% 0;
        }

        /***********comments***********/
        #comments-div a > div {
            display: inline-block;
            width: 90px;
            height: 90px;
        }
        #comments-div a {
            border: 1px solid black;
            width: 100%;
            height: 100%;
            display: block;
            padding: 7px 10px 0;
            border-width: 1px 1px 0px 1px;
            box-shadow: 1px 1px 2px 0px black;
            transition: 0.2s ease;
            margin-bottom: 4px;
        }
        #comments-div a:hover{
            margin: 0 5px 4px;
            box-shadow: 1px 1px 2px 0px #e82121;
        }
        #comments-div a:hover *{
            transform: scaleX(1.02);
            font-weight: bold;
        }
        div#comments-div {
            padding: 0;
        }
        #comments-div > div:last-child a {
            border-bottom-width: 1px;
        }
        #comments-div > div:nth-child(2n) a{
            background: #d3d3d38a;
        }
        /*******end comments*************/
    </style>
@endsection