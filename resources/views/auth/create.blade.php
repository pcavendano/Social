@extends('layouts.app')
@section('title', 'Enregistrer')
@section('content')
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 pt-4">
                <div class="card">
                    <h3 class="card-header text-center">
                        @lang('lang.register_title')
                    </h3>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <form action="{{route('user.store')}}" method="post">                                @csrf

                                <div class="form-group mb-3">
                                    <label for="prenom" class="form-label">@lang('lang.name')</label>
                                    <input type="text"
                                           placeholder="@lang('lang.yname')"
                                           class="form-control"
                                           name="prenom"
                                           value="{{old('prenom')}}"
                                    >
                                    @if ($errors->has('prenom'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('prenom')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="nom" class="form-label">@lang('lang.lastname')</label>
                                    <input type="text"
                                           placeholder="@lang('lang.mlastname')"
                                           class="form-control"
                                           name="nom"
                                           value="{{old('nom')}}"
                                    >
                                    @if ($errors->has('nom'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('nom')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date_de_naissance" class="form-label">@lang('lang.birthday')</label>
                                    <input type="date"
                                           class="form-control"
                                           name="date_de_naissance"
                                           required
                                           value="{{old('date_de_naissance')}}"
                                    >
                                    @if ($errors->has('date_de_naissance'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('date_de_naissance')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date_de_naissance" class="form-label">@lang('lang.mphone')</label>
                                    <input type="text"
                                           class="form-control"
                                           name="phone"
                                           required
                                           value="{{old('phone')}}"
                                    >
                                    @if ($errors->has('phone'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('phone')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date_de_naissance" class="form-label">@lang('lang.maddresse')</label>
                                    <input type="text"
                                           class="form-control"
                                           name="adresse"
                                           required
                                           value="{{old('adresse')}}"
                                    >
                                    @if ($errors->has('adresse'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('adresse')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="date_de_naissance" class="form-label">@lang('lang.mcity')</label>
                                    <select class="select2 form-control select2-hidden-accessible"
                                            aria-hidden="true" id="villeId" name="villeId">
                                        @forelse($villes as $ville)
                                            <option value="{{ $ville->id}}">{{ucfirst( $ville->nom )}}</option>
                                        @empty <p class="text-warning">
                                            @lang('lang.ncity')</p>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('adresse'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('adresse')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">@lang('lang.memail')</label>
                                    <input type="email"
                                           class="form-control"
                                           name="email"
                                           required
                                           value="{{old('email')}}"
                                    >
                                    @if ($errors->has('email'))
                                        <div class="text-danger mt-2">
                                            {{$errors->first('email')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">@lang('lang.mpassword')</label>
                                    <input type="password"
                                           placeholder="@lang('lang.password')"
                                           class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <div class="text-danger mt-2">                                            {{$errors->first
                ('password')}}</div>                                    @endif</div>
                                <!-- Avatar -->
                                <!-- https://www.webtrickshome.com/forum/how-to-display-uploaded-image-in-html-using-javascript -->
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h3 class="h6">@lang('lang.mimage')</h3>
                                        <label for="image">@lang('lang.mupload')</label>
                                        <input class="form-control" type="file" accept="image/*" name="image"
                                               id="file">
                                        @if ($errors->has('image'))
                                            <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card mb-4 avatar">
                                    <img class="avatar-img rounded-circle" id="output"/>
                                </div>
                                <div class="d-grid mx-auto">
                                    <input type="submit" value="@lang('lang.save')" class="btn btn-dark
                btn-block"></div>
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="mt-3 text-danger text-left">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
