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
				<a class="nav-link" href="{{ route('Entreprises') }}">Entreprises</a>
		</li>
  <li class="nav-item">
				<a class="nav-link" href="{{ route('Actions') }}">Actions</a>
		</li>
  <li class="nav-item">
		  <a class="nav-link active" href="{{ route('Interlocuteurs') }}">Interlocuteurs</a>
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
      <h3 class="text-center" style="margin-top:1rem;">{{ $interlocuteur->prenom }} {{ $interlocuteur->nom }}</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-3">
		</div>
    <div class="col-sm-6">
			<table class="table">
				<tbody>
					<tr>
						<td style="width:60%">Transmission de coordonnées :</td>
						<td style="width:40%"><img src="{{ ($interlocuteur->transmission)? URL::asset('img/V.png') : URL::asset('img/X.png') }}" height="16px" widht="16px"/> </td>
					</tr>
					<tr>
						<td>Fonction :</td>
						<td> {{ $interlocuteur->fonction }} </td>
					</tr>
					<tr>
						<td>Adresse E-mail :</td>
						<td> {{ $interlocuteur->mail }} </td>
					</tr>
					<tr>
						<td>Téléphone fixe :</td>
						<td> {{ $interlocuteur->telFixe }} </td>
					</tr>
					<tr>
						<td>Téléphone portable :</td>
						<td> {{ $interlocuteur->telMobile }} </td>
					</tr>
					<tr>
						<td>Commentaire :</td>
						<td> {{ $interlocuteur->commentaire }} </td>
					</tr>
					<tr>
						<td>Entreprise(s) :</td>
						<td>
							@foreach($interlocuteur->entreprises->groupBy('id') as $entreprise)
								<a href="{{ route('FicheEntreprise',['id' => $entreprise->first()->id]) }}" class="text-dark">{{ $entreprise->first()->nom }}</a> <br>
							@endforeach
						</td>
					</tr>
				</tbody>
			</table>
    </div>
		<div class="col-sm-3">
			{{ link_to_route('InterlocuteurModifier', 'Modifier', ['id' => $interlocuteur->id ], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px;' ]) }} <br/> <br/> <br/>
			{!! Form::open(['method' => 'DELETE', 'route' => ['InterlocuteurSupprimer', $interlocuteur->id]]) !!}
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger pull-right','style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:55%;margin-bottom:15px' , 'onclick' => 'return confirm(\'Vraiment supprimer cet interlocuteur ?\')']) !!}
			{!! Form::close() !!}
		</div>
  </div>
	<div class="row">
		@if(!empty($interlocuteur->evenements->first()))
		<div class="col-sm-3">
		</div>
		<div class="col-sm-1">
				Suivi
		</div>
		<div class="col-sm-5">
				<table class="table table-striped">
					<thead class="thead-light">
						<th style="width:10%;">Utilisateur </th>
						<th style="width:20%;">Date </th>
						<th style="width:20%;">Nature </th>
						<th style="width:50%;">Commentaire </th>
					</thead>
					<tbody>
						@foreach($interlocuteur->evenements as $evenement)
						<tr>
							 <td>{{ $evenement->utilisateur }}</td>
							 <td>{{ date_create($evenement['date'])->format('d/m/Y') }}</td>
							 <td>{{ $evenement->nature }}</td>
							 <td>{{ $evenement->commentaire }}...</td>
						 </tr>
						@endforeach
					</tbody>
				</table>

		</div>
		<div class="col-sm-3">
		</div>
		@endif
	</div>
</div>

@endsection
