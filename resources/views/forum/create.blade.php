@extends('layouts.app')
@section('title', 'Ajouter')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one ">
                @lang('lang.forum_create_post')
            </h1>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <form method="post">
                    @csrf
                    <div class="card-header">
                        @lang('lang.forum_post')
                    </div>
                    <div class="card-body">
                        <div class="control-group col-12">
                            <label for="title">@lang('lang.forum_post_titre')</label>
                            <input type="text" id="title" name="title" class="form-control">
                        </div>
                        <div class="control-group col-12">
                            <label for="body">@lang('lang.forum_post_message')</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>
                        <div class="control-group col-12">
                            <label for="category">@lang('lang.forum_post_category')</label>
                            <select name="categorys_id" id="category" class="form-control">
                                <option value="">@lang('lang.forum_post_scategory')</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Sauvegarder" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
