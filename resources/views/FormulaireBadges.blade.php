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
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">Application de gestion de partenariats</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2">
  	</div>
  	<div class="col-sm-8">
  		<div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
  			<h2 class="card-header">Formulaire de génération de badges</h2>
  			<div class="card-body">
  				{{ Form::open(['route' => 'Badges']) }}
            <div class="form-group" style="margin-top:10px;">
  						{{ Form::label('intitule', 'Intitulé :') }}
    					{{ Form::text('intitule', null, ['class' => 'form-control', 'placeholder' => 'Forum handicap et emploi']) }}
    					{!! $errors->first('intitule', '<small class="form-text text-muted">:message</small>') !!}
    				</div>
            <table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th style="width:4%"></th>
									<th style="width:30%">Entreprise(s)</th>
									<th style="width:20%">Prénom</th>
									<th style="width:20%">Nom</th>
									<th style="width:26%">Fonction</th>
								</tr>
							</thead>
							<tbody>
								@foreach($interlocuteurs as $interlocuteur)
									<tr>
										<td><div class="form-group" >{{ Form::checkbox($interlocuteur->id, null, false, ['class' => 'form-check-input','style'=>'margin-left:auto;']) }}</div></td>
										<td>
											@if(null != $interlocuteur->entreprisesDate()->first())
												<a class="text-dark" href="{{ route('FicheEntreprise',['id'=>$interlocuteur->entreprisesDate()->first()->id]) }}">{{ $interlocuteur->entreprisesDate()->first()->nom }}<br/>
											@endif
										</td>
										<td>{{ $interlocuteur->prenom }}</td>
										<td>{{ $interlocuteur->nom }}</td>
										<td>{{ $interlocuteur->fonction }}</td>
									</tr>
								@endforeach
							</tbody>
            </table>
  			</div>
  		</div>
  	</div>
  	<div class="col-sm-2">
  			{{ Form::submit('Télécharger', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:68px;margin-right:25px;margin-bottom:20px;' ]) }}
  		{{ Form::close() }}
  	</div>
  </div>
</div>
@endsection
