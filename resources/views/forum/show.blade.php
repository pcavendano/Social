@extends('layouts.app')
@section('title', 'Forum')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('forum.index') }}" class="btn btn-outline-primary btn-sm">Retouner</a>
            <h4 class="display-one mt-2">
                {{ $forumPost->title }}
            </h4>
            <hr>
            <p> {!! $forumPost->body !!}</p>
            <p><strong>Category:</strong> @isset($forumPost->forumHasCategory->category) {{ $forumPost->forumHasCategory->category }} @endisset</p>
            <p><strong>Author:</strong> {{ $forumPost->forumHasUser->name}}</p>
            <hr>
        </div>
    </div>
    <div class="row text-center mb-2">
    <div class="col-4">
            <a href="{{route('forum.pdf', $forumPost->id)}}" class="btn btn-warning">PDF</a>
        </div>
        <div class="col-4">
            <a href="{{route('forum.edit', $forumPost->id)}}" class="btn btn-success">Mettre a jour</a>
        </div>
        <div class="col-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Effacer
            </button>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Effacer un article</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Etes-vous certain de vouloir effacer cette donnée?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('forum.edit', $forumPost->id)}}" method="post">
                @csrf
                @method('delete')
            <input type="submit" class="btn btn-danger" value="Effacer">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
