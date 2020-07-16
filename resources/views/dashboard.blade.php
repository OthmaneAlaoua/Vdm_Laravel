<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Charts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">VDM</h1>
        <p class="lead">Espace statistiques des games</p>
    </div>
</div>
<div>

    <div class="row">
        <div class="w-50 pl-2">
            {!! $chart->html() !!}
        </div>
        <div class="w-50 p-3">
            {!! $chartGames->html() !!}
        </div>
    </div>

    <div class="progress mb-3">
        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
             aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="container">
        <div class="justify-content-center mb-3">
            {!! $chartGamesMonth->html() !!}
        </div>

        <div class="progress mb-3">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100"
                 aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row">
            <div class="w-50 p-3">
                {!! $chartVr->html() !!}
            </div>
            <div class="w-50 p-3 pt-5 ">
                <div style="max-height: 300px; overflow-y: auto">
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item active">{{$user['nom']}} {{$user['prenom']}}</li>
                            <li class="list-group-item">email : {{$user['Email']}}</li>
                            <li class="list-group-item">choix : {{$user['Game']}}</li>
                            <li class="list-group-item">date de réservation :  {{$user['jour']}}</li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $chartGames->script() !!}
{!! $chartGamesMonth->script() !!}
{!! $chartVr->script() !!}

</body>
</html>
