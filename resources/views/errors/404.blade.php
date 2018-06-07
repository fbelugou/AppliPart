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
      </nav>

			</div>
		</div>
  <div class="row">
		<div class="col-md-12">
      <h3 class="text-center" style="margin-top:1rem;">Un problème est survenu</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card" style="max-width:75rem;margin-left:auto;margin-right:auto;">
        <h4 class="card-header text-white bg-info">Une erreur est survenue</h4>
        <div class="card-body">
					Désolé, la page désirée n'existe pas...
					{{ link_to_route('Accueil', 'Retour à l\'accueil', null ,['class' => 'btn btn-info pull-right', 'style' => 'margin-top:10px;margin-right:25px;height:2.5rem;width:15rem;margin-bottom:15px;' ]) }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
