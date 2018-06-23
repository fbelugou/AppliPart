@extends('vueMere')


@section('contenu')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="{{ route('Accueil') }}">
<img src="{{ URL::asset('img/AMIOlogo.png') }}" height="33 px" width="83 px"class="rounded float-left" alt="logo AMIO">
</a>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="navbar-nav">
  <li class="nav-item">
				<span class="navbar-text">Utilisateur : XX</span>
		</li>
		  </ul>
	<ul class="navbar-nav ml-md-auto">
		<li class="nav-item">
				<a class="nav-link active" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
		</li>
  <li class="nav-item">
				<a class="nav-link" href="{{ route('Groupes') }}">Groupes</a>
		</li>
  <li class="nav-item">
				<a class="nav-link" href="{{ route('Entreprises') }}">Entreprises</a>
		</li>
  <li class="nav-item">
				<a class="nav-link" href="{{ route('Actions') }}">Actions</a>
		</li>
  <li class="nav-item">
		  <a class="nav-link" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
  </li>
  <li class="nav-item">
				<a class="nav-link" href="#" onclick="document.getElementById('formLogout').submit();">Déconnexion</a>
					  {{ Form::open(['url' => route('logout'), 'id' => 'formLogout']) }}
					  {{ Form::close() }}
		</li>
	</ul>
</div>
</nav>

			</div>
		</div>
  <div class="row">
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">Un problème est survenu</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
        <h4 class="card-header text-white bg-info">Une erreur est survenue</h4>
        <div class="card-body">
					Désolé, la page désirée n'existe pas...
					{{ link_to_route('Accueil', 'Retour à l\'accueil', null ,['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:15px;' ]) }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
