@extends('layouts.master')

@section('content')

    <div class="container dashboard">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                        <form method="post" id="upload-form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" id="design_image" name="design_image" />
                        </form>

                        <div id="items-list">
                            @include('dashboard.parts.items_list')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#design_image').change(function(){
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
@endsection