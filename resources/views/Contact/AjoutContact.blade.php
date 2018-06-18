@extends('vueMere')

@section('contenu')
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
				<ul class="navbar-nav ml-md-auto">
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Groupes') }}">Groupes</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Entreprises') }}">Entreprises</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Actions') }}">Actions</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
					</li>
					<li class="nav-item">
						 <span class="navbar-text">Utilisateur : {{ strtoupper(Auth::user()->initials[0]) }}</span>
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
	<div class="col-sm-3">
	</div>
	<div class="col-sm-6">
		<div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
			<h2 class="card-header">Ajout d'un contact</h2>
			<div class="card-body">
				{{ Form::open(['route' => 'ContactEnregistrer']) }}
          <div id="nat" class="form-group" style="margin-top:10px;">
						{{ Form::label('contactAMIO', 'Contact au sein d\'AMIO :') }}
  					{{ Form::text('contactAMIO',strtoupper(auth::user()->initials[0]), ['class' => 'form-control']) }}
  					{!! $errors->first('contactAMIO', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('objet', 'Objet de l\'échange :') }}
						{{ Form::text('objet' ,null,['class' => 'form-control', 'placeholder' => 'Mail, Téléphone, Salon, ...']) }}
					</div>
          <div class="form-group" style="margin-top:10px;">
						{{ Form::label('date', 'Date :') }}
  					{{ Form::date('date', null) }}
  					{!! $errors->first('date', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('entreprise', 'Entreprise :') }}
						{{ Form::select('entreprise', $entreprises ,$entreprise_id,['class' => 'form-control']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('interlocuteur', 'Interlocuteur :') }}
						{{ Form::select('interlocuteur', $interlocuteurs ,null,['class' => 'form-control']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('commentaire', 'Commentaire :') }}
  					{{ Form::text('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire']) }}
  					{!! $errors->first('commentaire', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
			{{ Form::submit('Valider', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:20px;' ]) }}
			{{ link_to_route('FicheEntreprise', 'Annuler',['id'=>$entreprise_id],['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }}
		{{ Form::close() }}
	</div>
</div>
@endsection
