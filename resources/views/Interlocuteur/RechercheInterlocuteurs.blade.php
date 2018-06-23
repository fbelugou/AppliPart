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
      <h3 class="text-center" style="margin-top:1rem;">Résultats de recherche des interlocuteurs</h3>
    </div>
  </div>
  <div class="row">
		<div class="col-sm-1">
		</div>
    <div class="col-sm-9">
			<div class="table-responsive">
				<table class="table table-striped">
				  <thead class="thead-light">
				    <tr>
				      <th scope="col">Entreprise</th>
				      <th scope="col">Prenom</th>
				      <th scope="col">Nom</th>
				      <th scope="col">Civilité</th>
				      <th scope="col">Fonction</th>
							<th scope="col">Mail : <a class="dark-text" href="{{ route('listeMail') }}">liste à copier</a></th>
							<th scope="col">Téléphone</th>
				    </tr>
				  </thead>
				  <tbody>
						@php Session::put('interlocuteurs', $interlocuteurs) @endphp
						@foreach($interlocuteurs as $interlocuteur)
						<tr>
							<td>
								@foreach($interlocuteur->entreprises->GroupBy('id') as $entreprise)
									<a href="{{ route('FicheEntreprise',['id' => $entreprise->first()->id] ) }}" class="text-dark"> {{ $entreprise->first()->nom }} </a> <br>
								@endforeach
							</td>
							<td> <a href="{{ route('FicheInterlocuteur',['id' => $interlocuteur->id ])}}" class="text-dark">{{ $interlocuteur->prenom }} </a></td>
							<td> <a href="{{ route('FicheInterlocuteur',['id' => $interlocuteur->id ])}}" class="text-dark">{{ $interlocuteur->nom }} </a></td>
							<td>{{ $interlocuteur->civilite }}</td>
							<td>{{ $interlocuteur->fonction }}</td>
							<td>{{ $interlocuteur->mail }}</td>
							<td>{{ $interlocuteur->telMobile }}</td>
				    </tr>
						@endforeach
				  </tbody>
				</table>
			</div>
    </div>
		<div class="col-sm-2">
			{{ link_to_route('InterlocuteurAjout', 'Ajouter un interlocuteur', [], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:10px;white-space: normal;width:80%;margin-bottom:15px;' ]) }}
		</div>
  </div>
</div>

@endsection
