@extends('layouts.master')

@section('content')
    <div class="container dashboard">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                        <div>
                            {{$item->item_name}}
                            <img src="{{url('uploads/' .$item->file_path)}}">
                            @if($itemProofers)
                                @foreach($itemProofers as $itemProofer)
                                    {{$itemProofer->proofer->name}}
                                @endforeach
                            @endif
                        </div>

                        <button data-url="{{route('editor.accept',[$item->id])}}" id="accept">Accept</button>

                    <form method="post" action="{{route('addProofer')}}">
                        {{csrf_field()}}
                        @foreach($users as $user)
                            <label>
                                <input type="checkbox" {{ in_array($user->id, $itemProofers->pluck('user_id')->all()) ? 'checked' : ''}} name="proofers[]" value="{{$user->id}}" />
                                {{$user->name}}
                            </label>
                        @endforeach
                        {{--@if(!$itemProofers->isEmpty())--}}
                            {{--@foreach($users as $user)--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" {{ in_array($user->id, $itemProofers->pluck('user_id')->all()) ? 'checked' : ''}} name="proofers[]" value="{{$user->id}}" />--}}
                                    {{--{{$user->name}}--}}
                                {{--</label>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--@foreach($users as $user)--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" name="proofers[]" value="{{$user->id}}" />--}}
                                    {{--{{$user->name}}--}}
                                {{--</label>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                        <input type="hidden" name="item_id" id="item_id" value="{{$item->id}}">
                        <input type="submit" value="Save"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection