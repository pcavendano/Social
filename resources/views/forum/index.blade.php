@extends('layouts.app')
@section('title', 'Forum List')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one">
                    @lang('lang.my_forum')
                </h1>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            @lang('lang.reading_title')
                        </p>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('forum.create')}}" class="btn btn-outline-primary">
                            @lang('lang.add_post')
                        </a>
                    </div>
                </div>
                <hr>
            </div>
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1>@lang('lang.posts_list')</h1>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="">

                            <table class="table pt-0 mt-0 border border-1 border-top-0 table-hover
                            \roject-list-table table-nowrap align-middle table-borderless">
                                <thead class="table-primary">
                                <tr>
                                    <th scope="col" class="ps-4" style="width: 50px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="contacusercheck" />
                                            <label class="form-check-label" for="contacusercheck"></label></div>
                                    </th>
                                    <th scope="col">@lang('lang.forum_post_titre')</th>
                                    <th scope="col">@lang('lang.forum_post_message')</th>
                                    <th class="col" scope="col" style="width: 200px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($forums as $forum)
                                    <tr>
                                        <th scope="row" class="ps-4">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" class="form-check-input" id="contacusercheck1" />
                                                <label class="form-check-label" for="contacusercheck1"></label></div>
                                        </th>
{{--                                        <td>--}}

{{--                                            @if(str_contains($forum->image, 'http') !== false)--}}
{{--                                                <img src="{{ $forum->image}}" alt="" class="avatar-sm rounded-circle me-2" />--}}
{{--                                            @else--}}
{{--                                                <img src="{{ asset('images/'.$etudiant->image)}}" alt="" class="avatar-sm rounded-circle me-2" />--}}
{{--                                            @endif--}}
{{--                                            <a href="./etudiant/{{ $forum->id }}" class="text-body">{{ ucfirst($forum->nom)}}</a>--}}
{{--                                        </td>--}}
                                        <td>
                                            <span class="badge badge-soft-success mb-0">
                                            <a href="{{ route('forum.show', $forum->id)}}">{{ $forum->title }}</a>
                                            </span>
                                        </td>
                                        <td class="col">{{ $forum->body}}</td>
                                        <td class="col">
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{ route('forum.edit', $forum->id)}}"
                                                       data-bs-toggle="tooltip"
                                                       data-bs-placement="top"
                                                       title="Edit" class="px-2 text-primary">
                                                        <i class="bx bx-pencil font-size-18"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">

                                                    <form id="delete-frm" class="" method="post"
                                                          action="{{route('forum.delete',[$forum->id])}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="id" hidden>Id</label>
                                                            <input type="text" id="id" name="id" class="form-control" required=""
                                                                   value="{{ $forum->id }}" hidden>
                                                        </div>
                                                        <!-- Button trigger modal -->
                                                        <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger">
                                                            <i class="bx bx-trash-alt font-size-18"></i>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop"
                                                             data-bs-backdrop="static" data-bs-keyboard="false"
                                                             tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="staticBackdropLabel">
                                                                            @lang('lang.delete_student_title')
                                                                        </h1>
                                                                        <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal" aria-label="Close">

                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @lang('lang.delete_student')
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-primary"
                                                                                data-bs-dismiss="modal">
                                                                            @lang('lang.')Fermer</button>
                                                                        <button type="submit"  class="btn
                                                                        btn-danger">@lang('lang.delete_student_confirmation')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @empty <p class="text-warning">
                                    @lang('lang.no_students')</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection
