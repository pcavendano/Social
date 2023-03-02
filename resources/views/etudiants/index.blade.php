@extends('layouts.app')
@section('content')


    <div class="container">
        <div class=" header mb-2 row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h1 class="display-one mt-2">{{ config('app.name') }}</h1>
                    <h5 class="card-title">@lang('lang.header_liste')<span class="text-muted fw-normal ms-2">({{count
                    ($etudiants)}})</span></h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                    <div>
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a
                                    aria-current="page"
                                    href="#"
                                    class="router-link-active router-link-exact-active nav-link active"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title=""
                                    data-bs-original-title="List"
                                    aria-label="List"
                                >
                                    <i class="bx bx-list-ul"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Grid" aria-label="Grid"><i class="bx bx-grid-alt"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{route('ajouter-etudiant.index')}}"  data-bs-target=".add-new" class="btn btn-primary"><i class="bx bx-plus me-1"></i>Ajouter étudiant</a>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-link text-muted py-1 font-size-16 shadow-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i></i></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="">
                        <table class="table pt-0 mt-0 border border-1 border-top-0 table-hover project-list-table table-nowrap align-middle table-borderless">
                            <thead class="table-primary">
                            <tr>
                                <th scope="col" class="ps-4" style="width: 50px;">
                                    <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck" /><label class="form-check-label" for="contacusercheck"></label></div>
                                </th>
                                <th scope="col">@lang('name')</th>
                                <th scope="col">@lang('email')</th>
                                <th  class="col-lg-4" scope="col">@lang('addresse')</th>
                                <th scope="col">@lang('phone')</th>
                                <th class="col-lg-1" scope="col" style="width: 200px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($etudiants as $etudiant)
                                <tr>
                                    <th scope="row" class="ps-4">
                                        <div class="form-check font-size-16"><input type="checkbox" class="form-check-input" id="contacusercheck1" /><label class="form-check-label" for="contacusercheck1"></label></div>
                                    </th>
                                    <td>

                                        @if(str_contains($etudiant->image, 'http') !== false)
                                            <img src="{{ $etudiant->image}}" alt="" class="avatar-sm rounded-circle me-2" />
                                        @else
                                            <img src="{{ asset('images/'.$etudiant->image)}}" alt="" class="avatar-sm rounded-circle me-2" />
                                        @endif
                                        <a href="./etudiant/{{ $etudiant->id }}" class="text-body">{{ ucfirst($etudiant->nom)}}</a>
                                    </td>
                                    <td><span class="badge badge-soft-success mb-0">{{ $etudiant->email }}</span></td>
                                    <td class="col-lg-4">{{ $etudiant->adresse}}</td>
                                    <td>{{ $etudiant->phone }}</td>
                                    <td class="col-lg-1">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a href="./etudiant/{{ $etudiant->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary">
                                                    <i class="bx bx-pencil font-size-18"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">

                                                    <form id="delete-frm" class="" method="post" action="{{route('effacer-etudiant.delete',[$etudiant->id])}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="id" hidden>Id</label>
                                                            <input type="text" id="id" name="id" class="form-control" required=""
                                                                   value="{{ $etudiant->id }}" hidden>
                                                        </div>
                                                        <!-- Button trigger modal -->
                                                            <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger">
                                                                <i class="bx bx-trash-alt font-size-18"></i>
                                                            </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="staticBackdropLabel">@lang('lang.delete_student_title')</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @lang('lang.delete_student')
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">@lang('lang.')Fermer</button>
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
                                Aucun étudiant enregistré </p>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0 align-items-center pb-4">
            <div class="col-sm-6 col-lg-10">
                <div><p class="mb-sm-0">{{ $etudiants->total()}} résultats</p></div>
            </div>
            <div class="col-sm-6 col-lg-2">
                <div class="float-sm-end">
                    {{ $etudiants->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection
