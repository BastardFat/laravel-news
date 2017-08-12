@extends('layouts.app')

@section('content')
    @foreach($records as $record)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <small>{{$record->created_at}}</small>
                        <h3 style="margin: 0;">{{$record->title}}<small> by {{$record->posted_user()}}</small></h3>
                    </div>
                    <div class="panel-body">

                        {{$record->short_body()}}
                        <hr>
                        <div>
                            <a class="btn btn-default btn-sm" href="/news/{{$record->id}}">Read more...</a>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    @endforeach
@endsection
