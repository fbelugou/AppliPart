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
      <h3 class="text-center" style="margin-top:1rem;">{{$entreprise->nom}}</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-3">
		</div>
    <div class="col-sm-6">
			<table class="table">
				<tbody>
					<tr>
						<td style="width:60%">Partenaire régulier :</td>
						<td style="width:40%"><img src="{{ ($entreprise->partenaireRegulier)? URL::asset('img/V.png') : URL::asset('img/X.png') }}" height="16px" widht="16px"/> </td>
					</tr>
					<tr>
						<td>Groupe :</td>
						<td><a href="{{ route('FicheGroupe',['id'=>(!is_null($entreprise->groupe)) ? $entreprise->groupe->id : '#']) }}">{{ (!is_null($entreprise->groupe)) ? $entreprise->groupe->nom : ' ' }}</a></td>
					</tr>
					<tr>
						<td>Taille :</td>
						<td>{{ $entreprise->taille }}</td>
					</tr>
					<tr>
					  <td>Activité(s) :</td>
						<td>
							@foreach($entreprise->activites as $activite)
								{{ $activite->libelle }} <br>
							@endforeach
						</td>
					</tr>
					<tr>
					  <td>Filière(s) :</td>
						<td>
							@foreach($entreprise->filieres as $filiere)
								{{ $filiere->metier }}<br>
							@endforeach
						</td>
					</tr>
					<tr>
					  <td>Adresse :</td>
						<td> {{ $entreprise->adresse1 }} {{ $entreprise->adresse2 }} {{ $entreprise->cp }} {{ $entreprise->ville }}</td>
					</tr>
					<tr>
						<td>Site Web :</td>
						<td><a href="{{ $entreprise->siteWeb }}">{{ $entreprise->siteWeb }}</a></td>
					</tr>
					<tr>
						<td>Téléphone :</td>
						<td>{{ $entreprise->telephone }} </td>
					</tr>
					<tr>
						<td>Interlocuteur(s) :</td>
						<td>
							@foreach($entreprise->Interlocuteurs->GroupBy('interlocuteur_id') as $interlocuteur)
								 <a class="text-dark" href="{{ route('FicheInterlocuteur',[ 'id' => $interlocuteur->first()->id ]) }}">{{  $interlocuteur->first()->prenom  }}  {{ $interlocuteur->first()->nom }}</a><br>
							@endforeach
						</td>
					</tr>
					<tr>
						<td>Commentaire :</td>
						<td> {{ $entreprise->commentaire }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-3">
			{{ link_to_route('EntrepriseModifier', 'Modifier', ['id' => $entreprise->id ],['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }} <br/> <br/> <br/>
			{!! Form::open(['method' => 'DELETE', 'route' => ['EntrepriseSupprimer', $entreprise->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right','style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px' , 'onclick' => 'return confirm(\'Vraiment supprimer cette entreprise ?\')']) !!}
			{!! Form::close() !!}
		</div>
	</div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-1">
				Contacts
			</div>
			<div class="col-sm-5">
				@if(!empty(contacts($entreprise)))
					<table class="table table-striped">
						<thead class="thead-light">
							<th style="width:10%;">Contact </th>
							<th style="width:20%;">Date </th>
							<th style="width:15%;">Nature </th>
							<th style="width:55%;">Commentaire </th>
						</thead>
						<tbody>
							@foreach(contacts($entreprise) as $contact)
							<tr>
								 <td>{{ $contact['contactAMIO'] }}</td>
								 <td><a class="text-dark" href="{{ route('FicheContact',[ 'id' => $contact['id'] ]) }}">{{ date_create($contact['date'])->format('d/m/Y') }}</a></td>
								 <td><a class="text-dark" href="{{ route('FicheContact',[ 'id' => $contact['id'] ]) }}">{{ $contact['nature'] }}</a></td>
								 <td>{{ substr($contact['commentaire'],0,50) }}...</td>
							 </tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
			<div class="col-sm-3">
				{{ link_to_route('ContactAjout', 'Ajouter un contact', ['id'=> $entreprise->id], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:10px;white-space: normal;width:55%;margin-bottom:15px;' ]) }}
			</div>
	  </div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-1">
					Actions
			</div>
			<div class="col-sm-5">
				@if(!empty($entreprise->Actions->first()))
					<table class="table table-striped">
						<thead class="thead-light">
							<th style="width:25%;">Nature </th>
							<th style="width:20%;">Date </th>
							<th style="width:55%;">Commentaire </th>
						</thead>
						<tbody>
							@foreach($entreprise->Actions as $action)
							<tr>
								 <td><a class="text-dark" href="{{ route('FicheAction',[ 'id' => $action->id ]) }}">{{ $action->nature }}</a></td>
								 <td>{{ date_create($action['date'])->format('d/m/Y') }}</td>
								 <td>{{ substr($action->commentaire,0,50) }}...</td>
							 </tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
			<div class="col-sm-3">
				{{ link_to_route('ActionAjoutEntreprise', 'Ajouter une action', ['id'=> $entreprise->id], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:10px;white-space: normal;width:55%;margin-bottom:15px;' ]) }}
			</div>
	  </div>
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-1">
					Suivi
			</div>
			<div class="col-sm-5">
				@if(!empty($entreprise->evenements->first()))
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
								 <td>{{ $evenement->commentaire }}</td>
							 </tr>
							@endforeach
						</tbody>
					</table>
				@endif
			</div>
			<div class="col-sm-3">
			</div>
	  </div>
	</div>
</div>

@endsection
