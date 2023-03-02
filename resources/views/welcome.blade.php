@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5 mb-5">
                    {{ config('app.name')}}
                </h1>

                <a href="{{ route('forum.index')}}" class="btn btn-outline-primary">
                    @lang('lang.show_forum')
                </a>
            </div>
        </div>
    </div>
@endsection
