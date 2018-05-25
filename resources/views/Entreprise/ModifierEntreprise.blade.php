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
						 <span class="navbar-text">Utilisateur : XX</span>
					</li>
					<li class="nav-item">
						 <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
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
						{{ Form::select('groupe', $groupes ,null,['class' => 'form-control']) }}
						{{ Form::checkbox('siegeSocial', null, false, ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('siegeSocial', 'Siège social',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('taille', 'Taille :') }}
						{{ Form::text('taille', null, ['class' => 'form-control', 'placeholder' => 'Nombre de salariés']) }}
						{!! $errors->first('taille', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('activites', 'Activite(s) :') }}
						{{ Form::select('activites', $activites ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'activites[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs activités </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('filieres', 'Filiere(s) :') }}
						{{ Form::select('filieres', $activites ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'filieres[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs filières </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('rue', 'Rue :') }}
						{{ Form::text('rue', null, ['class' => 'form-control', 'placeholder' => 'Rue']) }}
						{!! $errors->first('rue', '<small class="form-text text-muted">:message</small>') !!}
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
						{{ Form::label('telephone', 'Telephone :') }}
						{{ Form::text('telephone',null, ['class' => 'form-control', 'placeholder' => 'Telephone']) }}
						{!! $errors->first('telephone', '<small class="form-text text-muted">:message</small>') !!}
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('interlocuteurs', 'Interlocuteurs :') }}
						{{ Form::select('interlocuteurs', $interlocuteurs ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'interlocuteurs[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs Interlocuteurs </small>
					</div>
					<div class="form-group" style="margin-top:10px;">
						{{ Form::label('commentaire', 'Commentaire :') }}
						{{ Form::textarea('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire', 'style' => 'height:120px;']) }}
						{!! $errors->first('commentaire', '<small class="form-text text-muted">:message</small>') !!}
					</div>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
			{{ Form::submit('Envoyer', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:20px;' ]) }}
			{{ link_to_route('FicheEntreprise', 'Annuler',['id' => $entreprise->id],['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:15px;' ]) }}
		{{ Form::close() }}
	</div>
</div>
@endsection
