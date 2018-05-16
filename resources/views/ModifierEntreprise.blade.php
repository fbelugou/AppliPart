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
					<li class="nav-item active">
						 <a class="nav-link active" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Groupes') }}">Groupes</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Entreprises') }}">Entreprises</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Actions') }}">Actions</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
					</li>
					<li class="nav-item">
						 <span class="navbar-text">Utilisateur : XX</span>
					</li>
					<li class="nav-item">
						 <a class="nav-link active" href="{{ route('logout') }}">Déconnexion</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
			<h2 class="card-header">Création d'une entreprise</h2>
			<div class="card-body">
				{{ Form::model($entreprise,['route' => ['EntrepriseMAJ',$entreprise->id], 'method' => 'put']) }}
          <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}" style="margin-top:10px;">
  					{{ Form::text('nom', null, ['class' => 'form-control', 'placeholder' => 'Nom']) }}
  					{!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
  				</div>
          <div class="form-group" style="margin-top:10px;">
						{{ Form::checkbox('partenaireRegulier', null, ($entreprise->partenaireRegulier==1 ? 1 : 0 ), ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('partenaireRegulier', 'Partenaire régulier',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
  				</div>
					<div class="form-group" style="margin-top:10px;">
            {{ Form::select('groupe_id', $groupes , null,['class' => 'form-control']) }}
						{{ Form::checkbox('siegeSocial', null, ($entreprise->siegeSocial==1 ? 1 : 0 ), ['class' => 'form-check-input','style' => 'margin-left:5px;']) }}
						{{ Form::label('siegeSocial', 'Siège social',['class' => 'form-check-label','style' => 'margin-left:30px;']) }}
  				</div>
          <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}" style="margin-top:10px;">
  					{{ Form::text('taille', null, ['class' => 'form-control', 'placeholder' => 'Nombre de salariés']) }}
  					{!! $errors->first('taille', '<small class="help-block">:message</small>') !!}
  				</div>
					<div class="form-group" style="margin-top:10px;">
            {{ Form::select('activites', $activites ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'activites[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs activités </small>
  				</div>
					<div class="form-group" style="margin-top:10px;">
            {{ Form::select('filieres', $activites ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'filieres[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs filières </small>
  				</div>
          <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}" style="margin-top:10px;">
  					{{ Form::text('rue', null, ['class' => 'form-control', 'placeholder' => 'Rue']) }}
  					{!! $errors->first('rue', '<small class="help-block">:message</small>') !!}
  				</div>
          <div class="form-group" style="margin-top:10px;">
  					{{ Form::text('cp', null, ['class' => 'form-control', 'placeholder' => 'Code Postal']) }}
  				</div>
          <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}" style="margin-top:10px;">
  					{{ Form::text('ville', null, ['class' => 'form-control', 'placeholder' => 'Ville']) }}
  					{!! $errors->first('rue', '<small class="help-block">:message</small>') !!}
  				</div>
          <div class="form-group" style="margin-top:10px;">
  					{{ Form::text('siteWeb', null, ['class' => 'form-control', 'placeholder' => 'Site Web']) }}
  				</div>
  				<div class="form-group" style="margin-top:10px;">
  					{{ Form::text('tel',null, ['class' => 'form-control', 'placeholder' => 'Telephone']) }}
  				</div>
					<div class="form-group" style="margin-top:10px;">
            {{ Form::select('interlocuteurs', $interlocuteurs ,null,[ 'class'=>'form-control', 'multiple'=>'' ,'name'=>'interlocuteurs[]']) }}
						<small class="form-text text-muted">Maintenez la touche Ctrl pour selectionner plusieurs Interlocuteurs </small>
  				</div>
          <div class="form-group {{ $errors->has('nom') ? 'has-error' : '' }}" style="margin-top:10px;">
  					{{ Form::textarea('commentaire', null, ['class' => 'form-control', 'placeholder' => 'Commentaire', 'style' => 'height:120px;']) }}
  					{!! $errors->first('commentaire', '<small class="help-block">:message</small>') !!}
  				</div>
  				{{ Form::submit('Envoyer', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;']) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection
