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
      				 <a class="nav-link" href="{{ route('Accueil') }}">Accueil<span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item">
      				 <a class="nav-link active" href="{{ route('Groupes') }}">Groupes</a>
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
      <h3 class="text-center" style="margin-top:1rem;">Résultats de recherche de groupes</h3>
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
				      <th scope="col">Groupe</th>
				      <th scope="col">Siège social</th>
				      <th scope="col">Entreprises</th>
				    </tr>
				  </thead>
				  <tbody>
						@foreach($groupes as $groupe)
						<tr>
							<td> <a href="{{ route('FicheGroupe',['id' => $groupe->id] ) }}" class="text-dark"> {{ $groupe->nom }} </a> </td>
							<td>
								@if (!empty($groupe->entreprises))
									@foreach($groupe->entreprises as $entreprise)
										@if($entreprise->siegeSocial)
											<a href="{{ route('FicheEntreprise',['id' => ($entreprise->siegeSocial)? $entreprise->id : ' ' ])}}" class="text-dark">{{ ($entreprise->siegeSocial)? $entreprise->nom : ' '  }} </a> <br>
										@endif
									@endforeach
								@endif
							</td>
							<td>
								@if (!empty($groupe->entreprises))
									@foreach($groupe->entreprises as $entreprise)
										@if(!$entreprise->siegeSocial)
										<a href="{{ route('FicheEntreprise',['id' => ($entreprise->siegeSocial)? ' ' : $entreprise->id ])}}" class="text-dark">{{ ($entreprise->siegeSocial)? ' ' : $entreprise->nom  }} </a> <br>
										@endif
									@endforeach
								@endif
							</td>
				    </tr>
						@endforeach
				  </tbody>
				</table>
			</div>
    </div>
		<div class="col-sm-2">
			{{ link_to_route('GroupeAjout', 'Ajouter un groupe', [], ['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:10px;white-space: normal;width:80%;margin-bottom:15px;' ]) }}
		</div>
  </div>
</div>

@endsection
