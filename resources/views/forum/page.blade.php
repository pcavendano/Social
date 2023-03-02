@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
                @foreach($forumPosts as $forumPost)
                <tr>
                    <td>{{$forumPost->title}}</td>
                    <td>{{$forumPost->forumHasUser->name}}</td>
                </tr>
                @endforeach
            </table>
            {{ $forumPosts }}
        </div>
    </div>
</div>


 @endsection
