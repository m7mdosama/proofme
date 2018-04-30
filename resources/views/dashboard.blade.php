@extends('layouts.app')

@section('content')
<div class="container">
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
                    <form method="post" id="upload-form" action="{{route('uploadDesign')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" id="design_image" name="design_image" multiple/>
                        <input type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $('#design_image').change(function(){
            /*$('#upload-form').ajaxForm(function(res){

            });*/

            //$.post('{{route('uploadDesign')}}', $('#upload-form').serialize(), function(res){
            //})

        });
    });
</script>
@endsection