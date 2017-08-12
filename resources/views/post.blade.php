@extends('layouts.app')

@section('content')

    <h4>Add new post:</h4>
    <form action="/save" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group">
            <input class="form-control" type="text" name="title" required/>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="body" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection
