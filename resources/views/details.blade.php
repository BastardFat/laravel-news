@extends('layouts.app')

@section('content')

    <h1>{{$record->title}}</h1>
    <pre>{{$record->body}}</pre>
    <hr>
    <h4>Leave a Comment:</h4>
    <form action="/addcomment" method="post">
        <input type="hidden" name="news_id" value="{{$record->id}}"/>
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <textarea class="form-control" name="body" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    <br><br>

    <p><span class="badge">{{count($comments)}}</span> Comments:</p><br>

    <div class="row">
        @foreach($comments as $comment)
        <div class="col-sm-10">
            <h4>{{$comment->posted_user()}} <small>{{$comment->created_at}}</small></h4>
            <p>{{$comment->body}}</p>
            <br>
        </div>
        @endforeach
    </div>

@endsection
