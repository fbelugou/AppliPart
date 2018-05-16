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
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">Liste des groupes</h3>
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
										<a href="{{ route('FicheGroupe',['id' => ($entreprise->siegeSocial)? $entreprise->id : ' ' ])}}" class="text-dark">{{ ($entreprise->siegeSocial)? $entreprise->nom : ' '  }} </a>
									@endforeach
								@endif
							</td>
							<td>
								@if (!empty($groupe->entreprises))
									@foreach($groupe->entreprises as $entreprise)
										<a href="{{ route('FicheGroupe',['id' => ($entreprise->siegeSocial)? ' ' : $entreprise->id ])}}" class="text-dark">{{ ($entreprise->siegeSocial)? ' ' : $entreprise->nom  }} </a>
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
			{{ link_to_route('GroupeAjout', 'Ajouter un groupe', [], ['class' => 'btn btn-info pull-right']) }}
		</div>
  </div>
</div>

@endsection
