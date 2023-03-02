@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="container">
            <!-- Navigation -->
            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <a href="{{route('accueil')}}" class="btn btn-outline-primary btn-sm">@lang('lang.return')</a>
            </div>
            <!-- Titre de la page-->
            <div class="d-flex justify-content-between align-items-lg-center py-3 flex-column flex-lg-row">
                <h2 class="h5 mb-3 mb-lg-0">
                    @lang('lang.etudiant_create_student')
                </h2>
            </div>
            <!-- Fin de la section titre de la page-->

            <!-- Section Formulaire pour la création d'un formulaire -->
            <div class="row">
                <!-- Left side -->
                <div class="col-lg-8">
                    <!-- Vérification de la session et affichage des messages d'erreur -->
                    @if(Session::get('success', false))
                        <?php $data = Session::get('success'); ?>
                        @if (is_array($data))
                            @foreach ($data as $msg)
                                <div class="alert alert-success" role="alert">
                                    <i class="fa fa-check"></i>
                                    {{ $msg }}
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-success" role="alert">
                                <i class="fa fa-check"></i>
                                {{ $data }}
                            </div>
                        @endif
                        <div class="m-2">
                            <img class="avatar-img rounded-circle" src="images/{{ Session::get('image') }}"
                                 width="200px">
                        </div>
                @endif
                <!-- Fin de la vérification de la session et affichage des messages d'erreur -->


                    <!-- Début du formulaire d'authentification -->
                    <form enctype="multipart/form-data" name="ajouter-etudiant-post-form"
                          id="ajouter-etudiant-post-form" method="post"
                          action="{{route('ajouter-etudiant.post')}}">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="h6 mb-4">@lang('lang.basic_information')</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nom" class="form-label">@lang('name')</label>
                                            <input id="nom"
                                                   name="nom"
                                                   type="text"
                                                   class="form-control"
                                                   value="{{ old('nom') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="date_de_naissance">@lang('dbirthday')</label>
                                            <input type="date"
                                                   id="date_de_naissance"
                                                   name="date_de_naissance"
                                                   class="form-control"
                                                   required="" value="{{ old('date_de_naissance') }}"/>
                                            @if ($errors->has('nom'))
                                                <div class="text-danger mt-2">
                                                    {{$errors->first('nom')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">@lang('email')</label>
                                            <input id="email" name="email" type="email" class="form-control"
                                                   value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">@lang('phone')</label>
                                            <input id="phone" name="phone" type="text" class="form-control"
                                                   value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h3 class="h6 mb-4">@lang('lang.maddresse')</h3>
                                <div class="mb-3">
                                    <label for="adresse"
                                           class="form-label">
                                        @lang('lang.addresse')
                                    </label>
                                    <input id="adresse"
                                           name="adresse"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('adresse') }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="villeId">@lang('lang.city')</label>
                                    <select class="select2 form-control select2-hidden-accessible"
                                            aria-hidden="true" id="villeId" name="villeId">
                                        @forelse($villes as $ville)
                                            <option value="{{ $ville->id}}">{{ucfirst( $ville->nom )}}</option>
                                        @empty <p class="text-warning">
                                            @lang('lang.ncity') </p>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Section d'inscription du passe -->
                        <div class="mb-3">
                            <label for="password"
                                   class="form-label">
                                @lang('lang.password')
                            </label>
                            <input id="password"
                                   name="password"
                                   type="text"
                                   class="form-control"
                                   value="{{ old('password') }}">
                        </div>
                        <!-- Fin de la section pour le mot de passe -->
                        <button type="submit" class="btn btn-primary col-lg-4">Submit</button>


                        <!-- Right side -->
                        <div class="col-lg-4">
                            <!-- Avatar -->
                            <!-- https://www.webtrickshome.com/forum/how-to-display-uploaded-image-in-html-using-javascript -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3 class="h6">@lang('lang.mimage')</h3>
                                    <label for="image">@lang('lang.mupload')</label>
                                    <input class="form-control" type="file" accept="image/*" name="image" id="file">
                                    @if ($errors->has('image'))
                                        <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card mb-4 avatar">
                                <img class="avatar-img rounded-circle" id="output"/>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

@endsection
