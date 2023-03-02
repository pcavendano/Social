@extends('layouts.app')
@section('content')
    <div class="container-lg mb-2 bg-primary ">
        <div class="row">
            <div class="col-12 pt-2"><a href="{{route('accueil')}}" class="btn btn-light btn-outline-primary btn-sm">Retourner</a>


                <!-- Fiche de l'étudiant avec bootstrap  -->
                <!-- https://www.bootdey.com/snippets/view/profile-with-data-and-skills -->

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="main-breadcrumb bg-white mb-2 mt-2">
                    <ol class="breadcrumb p-1">

                        <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($etudiant->nom) }}</li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex flex-column align-items-center text-center">
                                    @if(str_contains($etudiant->image, 'http') !== false)
                                        <img src="{{ $etudiant->image}}" alt="" class="rounded-circle" width="150">
                                    @else
                                        <img src="{{ asset('images/'.$etudiant->image)}}" alt="" class="rounded-circle" width="150">
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{ $etudiant->nom }}</h4>
                                        <p class="text-secondary mb-1">Full Stack Developer</p>
                                        <p class="text-muted font-size-sm">{{ $ville->nom }}</p>
                                        <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom: </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ ucfirst($etudiant->nom) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Courriel electronique:</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $etudiant->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Numero de téléphone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $etudiant->phone }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $etudiant->adresse }}, {{ $ville->nom }}
                                    </div>
                                </div>
                                <hr>
                                <div class="flex flex-row">
                                    <span class="col-sm-12">
                                        <a href="{{route('modifier-etudiant.index', [$etudiant->id]) }}" class=
                                        "btn btn-outline-primary">Modifier l'étudiant</a>
                                    </span>
                                    <form id="delete-frm" class="d-inline-block p-2 " method="post" action="{{route('effacer-etudiant.delete',[$etudiant->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <div class="form-group">
                                            <label for="id" hidden>Id</label>
                                            <input type="text" id="id" name="id" class="form-control" required=""
                                                   value="{{ $etudiant->id }}" hidden>
                                        </div>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Supprimer l'étudiant
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Supprimer l'étudiant</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vous êtes sûr de vouloir effacer votre profil?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit"  class="btn btn-danger">Oui je sui sûr</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>


            </div
            >
        </div
        >
    </div
    >@endsection
