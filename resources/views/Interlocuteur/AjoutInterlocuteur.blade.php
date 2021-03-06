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
						 <a class="nav-link" href="{{ route('Entreprises') }}">Entreprises</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('Actions') }}">Actions</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
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
			<h2 class="card-header">Création d'un interlocuteur</h2>
			<div class="card-body">
				{{ Form::open(['route' => 'InterlocuteurEnregistrer']) }}
          <div class="form-group" style="margin-top:10px;">
						{{ Form::label('prenom', 'Prénom :') }}
  					{{ Form::text('prenom', null, ['class' => 'form-control', 'placeholder' => 'Prénom']) }}
  					{!! $errors->first('prenom', '<div class="form-text text-muted">:message</div>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('nom','Nom :') }}
  					{{ Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom']) }}
  					{!! $errors->first('nom', '<div class="form-text text-muted">:message</div>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::checkbox('transmission', null, false, ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('transmission', 'Transmission de coordonnées',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('civilite', 'Civilité :') }}
						{{ Form::select('civilite', ['M','Mme','Dr','Pr','Me'] ,null,['class' => 'form-control']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('type', 'Type de fonction :') }}
						{{ Form::select('type', ['Choisissez un type de fonction','Opérationel','Ressources Humaines','Mission Handicap'] ,null,['class' => 'form-control']) }}
						{!! $errors->first('type', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('fonction', 'Fonction :') }}
						{{ Form::text('fonction', null, ['class' => 'form-control', 'placeholder' => 'Fonction']) }}
  					{!! $errors->first('fonction', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('telFixe', 'Téléphone fixe :') }}
						{{ Form::text('telFixe', null, ['class' => 'form-control', 'placeholder' => 'Téléphone fixe']) }}
  					{!! $errors->first('telFixe', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('telMobile', 'Téléphone mobile :') }}
						{{ Form::text('telMobile', null, ['class' => 'form-control', 'placeholder' => 'Téléphone mobile']) }}
  					{!! $errors->first('telMobile', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('mail', 'Adresse E-mail :') }}
						{{ Form::text('mail', null, ['class' => 'form-control', 'placeholder' => 'Mail']) }}
  					{!! $errors->first('mail', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('commentaire', 'Commentaire :') }}
						{{ Form::text('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire']) }}
  					{!! $errors->first('commentaire', '<div class="form-text text-muted">:message</div>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('entreprises', 'Entreprise(s) :') }}
            {{ Form::select('entreprises', $entreprises ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'entreprises[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs entreprises </small>
  				</div>
					Fiche de suivi
					<table class="table table-striped">
						<thead class="thead-light">
							<th style="width:8%;">Utilisateur </th>
							<th style="width:15%;">Date </th>
							<th style="width:25%;">Nature </th>
							<th style="width:52%;">Commentaire </th>
						</thead>
						<tbody>
							<tr>
								 <td>{{ Form::text('utilisateur',mb_strtoupper(Auth::user()->initials[0],'UTF-8'), ['class' => 'form-control']) }}</td>
								 <td>{{ Form::date('date', \Carbon\Carbon::now()) }}</td>
								 <td>{{ Form::text('nature','Création', ['class' => 'form-control']) }}</td>
								 <td>{{ Form::text('commentaireEvent',null, ['class' => 'form-control', 'placeholder' => 'Commentaire']) }}</td>
							 </tr>
						</tbody>
					</table>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
			{{ Form::submit('Valider', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:20px;' ]) }}
			{{ link_to_route('Interlocuteurs', 'Annuler',[],['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }}
		{{ Form::close() }}
	</div>
</div>
@endsection
