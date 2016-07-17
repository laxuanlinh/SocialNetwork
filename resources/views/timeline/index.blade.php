@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <form role="form" action="{{ route('status.post') }}" method="post">
                <div class="form-group">
                    <textarea id="status" placeholder="What's up {{Auth::user()->getFirstNameOrUsername()}}?" name="status" class="form-control" rows="2"></textarea>
                </div>
                <button type="button" id="postBtn" class="btn btn-default">Update status</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <hr>
        </div>
    </div>
    <div class="row col-lg-8">
        <div id="status-section" class="col-lg-12">
            @if($statuses->count()===0)
                <p>Nothing to see here</p>
            @else
                @foreach($statuses as $status)
                    @include('templates.partial.status')
                @endforeach
                {!! $statuses->render() !!}
            @endif
        </div>
    </div>
    @include('templates.partial.reply-template');
    @include('templates.partial.status-template');
@stop
