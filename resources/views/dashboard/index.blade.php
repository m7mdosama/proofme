@extends('layouts.master')

@section('content')

    <div class="container dashboard">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row" id="items-list">
            @include('dashboard.parts.items_list')
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#items-list').on('change','#design_image',function(){
                /*$('#upload-form').ajaxForm(function(res){

                });*/
                {{--$.post('{{route('uploadDesign')}}', new FormData($('#upload-form')[0]), function(res){--}}
                    {{--alert(res);--}}
                {{--},false);--}}
                $.ajax({
                    type: "POST",
                    url: '{{route('uploadDesign')}}',
                    contentType: false,
                    processData: false,
                    data: new FormData($('#upload-form')[0]),
                    success: function(data)
                    {
                        if(data){
                           $('#items-list').html(data);
                        }
                        else{
                            alert('Error');
                        }
                    },
                    error: function( error )
                    { alert( error.responseText ); }
                });

            });
        });

    </script>
    <style>
        .dashboard input[type="file"] {
            display: none;
        }
        .dashboard a {
            width: 95%;
            height: 270px;
            display: block;
            margin: 0 auto 40px;
            text-align: center;
            border-width: 3px;
            border-color: transparent;
            border-style: ridge;
            border-radius: 7px;
            transition: 0.5s ease;
            background-color: rgba(148, 239, 241, 0.27);
        }
        .dashboard a:hover {
            border-color:lightgray;
            box-shadow: 3px 3px 10px #010138;
        }
        .dashboard #items-list a div {
            height: 80%;
            display: inline-block;
            margin: 7px auto;
            text-align: center;
            box-shadow: 0px 1px 3px black;
            border-radius: 11px;
            overflow: hidden;
            max-width: 95%;
            opacity: 0.5;
        }
        .dashboard #items-list a div:hover {
            transition: 0.3s;
            opacity: 1;
        }
        .dashboard img{
            height: 100%;
            display: block;
            background: url({{asset('assets/img/png.png')}}),#e2e2e2;
            background-blend-mode: hard-light;
            transition: 0.5s ease;
        }
        .dashboard a img:hover {
            /*transform-origin: top;*/
            transform: scale(1.25) rotate(5deg);
            transition: 3.1s ease-in;
        }
        .dashboard span {
            font-family: cursive;
            font-size: large;
            font-style: oblique;
            font-variant: all-small-caps;
            text-decoration: wavy;
            text-shadow: 1px 1px 2px #384451;
            color: dimgray;
            margin: 7px 20px 0;
            display: block;
            text-align: left;
        }

        .dashboard label[style]:hover {
            color: transparent;
            transform:scale(2.2);
        }
        #upload-form{
            cursor: pointer;
            width: 100%;
            height: 270px;
        }
        .dashboard #items-list form a div{
            background: url('{{asset('assets/img/add.png')}}')50%/85% 85% no-repeat;
            width: 85%;
            box-shadow: none;
        }


        .dash::-webkit-scrollbar{
            width: 0;
        }
        .row.wow.fadeIn.dash{
            /*height: auto;*/
        }
        .dash .view{
            /*max-height: 200px;*/
        }
        .dash img.img-fluid {
            width: 100%;
            height: 270px;
        }
        .card.card-cascade.narrower .view {
            margin-left: 4%;
            margin-right: 4%;
            margin-top: -20px;
        }
        .card.card-cascade .view {
            border-radius: .25rem;
        }
        .dash .card.card-cascade .view.overlay{
            box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
        }
        .dash .card{
            background-color: #fffdbbc9;
            color: #003083;
        }
        .card .card-body .card-text{
            color: #9c9c9c;
            text-align: center;
        }
        .dash .col-md-3 {
            padding-bottom: 70px;
        }
        .stats {
            float: left;
            font-size: 30px;
            color: gray;
            cursor: pointer;
            margin-bottom: 0;
        }
        .stats[d] {
            color: green;
        }
    </style>
@endsection