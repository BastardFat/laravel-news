@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>{{$record->title}}
                <small>
                    <a class="pull-right" href="/downloadpost/{{$record->id}}">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download PDF
                    </a>
                </small>
            </h1>
        </div>

        <div class="panel-body">
            <p>
                {!! $record->get_body() !!}

            </p>
        </div>

        <div class="panel-footer">
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
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>{{$comment->posted_user()}} <small>{{$comment->created_at}}</small></h4>
                            </div>

                            <div class="panel-body">
                                <p>{!! nl2br(htmlspecialchars($comment->body)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




@endsection
