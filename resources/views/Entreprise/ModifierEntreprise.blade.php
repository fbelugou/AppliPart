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
			<h2 class="card-header">Modification d'une entreprise</h2>
			<div class="card-body">
				{{ Form::model($entreprise,['route' => ['EntrepriseMAJ',$entreprise->id], 'method' => 'put']) }}
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('nom', 'Nom :') }}
						{{ Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom']) }}
						{!! $errors->first('nom', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::checkbox('partenaireRegulier', null, null, ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('partenaireRegulier', 'Partenaire régulier',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::select('groupe', $groupes ,$entreprise->groupe_id,['class' => 'form-control']) }}
						{{ Form::checkbox('siegeSocial', null, false, ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('siegeSocial', 'Siège social',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('taille', 'Taille :') }}
						{{ Form::text('taille', null, ['class' => 'form-control', 'placeholder' => 'Nombre de salariés']) }}
						{!! $errors->first('taille', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('activites', 'Activité(s) :') }}
						{{ Form::select('activites', $activites ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'activites[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs activités </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('filieres', 'Filierè(s) :') }}
						{{ Form::select('filieres', $filieres ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'filieres[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs filières </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('adresse1', 'Adresse :') }}
  					{{ Form::text('adresse1', null, ['class' => 'form-control', 'placeholder' => 'Adresse']) }}
  					{!! $errors->first('adresse1', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('adresse2', 'Complément d\'adresse :') }}
  					{{ Form::text('adresse2', null, ['class' => 'form-control', 'placeholder' => 'Complément d\'adresse']) }}
  					{!! $errors->first('adresse2', '<small class="form-text text-muted">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('cp', 'Code postal :') }}
						{{ Form::text('cp', null, ['class' => 'form-control', 'placeholder' => 'Code Postal']) }}
						{!! $errors->first('cp', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('ville', 'Ville :') }}
						{{ Form::text('ville', null, ['class' => 'form-control', 'placeholder' => 'Ville']) }}
						{!! $errors->first('rue', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('siteWeb', 'Site Web :') }}
						{{ Form::text('siteWeb', null, ['class' => 'form-control', 'placeholder' => 'Site Web']) }}
						{!! $errors->first('siteWeb', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('telephone', 'Téléphone :') }}
						{{ Form::text('telephone',null, ['class' => 'form-control', 'placeholder' => 'Téléphone']) }}
						{!! $errors->first('telephone', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('interlocuteurs', 'Interlocuteurs :') }}
						{{ Form::select('interlocuteurs', $interlocuteurs ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'interlocuteurs[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour sélectionner plusieurs interlocuteurs </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('commentaire', 'Commentaire :') }}
						{{ Form::textarea('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire', 'style' => 'height:120px;']) }}
						{!! $errors->first('commentaire', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					Fiche de suivi
					<table class="table table-striped">
						<thead class="thead-light">
							<th style="width:10%;">Utilisateur </th>
							<th style="width:20%;">Date </th>
							<th style="width:20%;">Nature </th>
							<th style="width:50%;">Commentaire </th>
						</thead>
						<tbody>
							@foreach($entreprise->evenements as $evenement)
							<tr>
								 <td>{{ $evenement->utilisateur }}</td>
								 <td>{{ date_create($evenement['date'])->format('d/m/Y') }}</td>
								 <td>{{ $evenement->nature }}</td>
								 <td>{{ $evenement->commentaire }}...</td>
							 </tr>
							@endforeach
							<tr>
								 <td>{{ Form::text('utilisateur',mb_strtoupper(Auth::user()->initials[0],'UTF-8'), ['class' => 'form-control']) }}</td>
								 <td>{{ Form::date('date', \Carbon\Carbon::now()) }}</td>
								 <td>{{ Form::text('nature','Modification', ['class' => 'form-control']) }}</td>
								 <td>{{ Form::text('commentaireEvent',null, ['class' => 'form-control', 'placeholder' => 'Commentaire']) }}</td>
							 </tr>
						</tbody>
					</table>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
			{{ Form::submit('Valider', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:20px;' ]) }}
			{{ link_to_route('FicheEntreprise', 'Annuler',['id' => $entreprise->id],['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }}
		{{ Form::close() }}
	</div>
</div>
@endsection
