<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Models\Acheteurs;
use App\Models\Game;
use App\User;
use Illuminate\Http\Request;
use App\Product;
use Charts;
use DB;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        /**Statistique reservations**/
        $users = Acheteurs::all();
        $chart = Charts::database($users, 'line', 'highcharts')
            ->title('Nombre total de reservations du mois')
            ->elementLabel('Total réservations mois')
            ->dimensions(700, 500)
            ->colors(['red', 'green', 'blue', 'yellow', 'orange', 'cyan', 'magenta'])
            ->groupByDay(date('m'), date('Y'), true);


        /**Statistique game les plus joué **/
        $games = Game::all();
        $grouped = $games->groupBy('Nom');
        $gamesName = [];
        $gamesReservations = [];

        $grouped->toArray();

        foreach ($grouped as $key => $value) {
            array_push($gamesName, $key);
            array_push($gamesReservations, count($value));
        }
        $chartGame = Charts::create('donut', 'highcharts')
            ->title('Statistiques des games et leurs utilisation')
            ->labels($gamesName)
            ->values($gamesReservations)
            ->dimensions(700, 500)
            ->responsive(false);


        /** Reservation du mois */
        $monthGames = Game::all();
        $monthGrouped = $monthGames->groupBy('Jour');
        $monthReservations = [];
        /**On garde juste les date du meme jour **/
        foreach ($monthGrouped as $key => $value) {
            if (date('m', strtotime($key)) == date('m')) {
                $monthReservations[$key] = count($value);
            }
        }

        $number = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $dayOfMonth = [];
        for ($i = 1; $i <= $number; $i++) {
            if ($i < 10) {
                $i = '0' . $i;
            }
            array_push($dayOfMonth, date('Y') . '-' . date('m') . "-$i");
        }

        $finalArray = [];
        foreach ($dayOfMonth as $value) {
            if(isset($monthReservations[$value])){
                array_push($finalArray,$monthReservations[$value]);
            }else{
                array_push($finalArray,0);
            }
        }
        $chartGamesMonth = Charts::create('bar', 'highcharts')
            ->title('reservations du mois')
            ->labels($dayOfMonth)
            ->elementLabel('Réservations')
            ->values($finalArray)
            ->dimensions(1000, 500)
            ->responsive(false);


        /**Statistique utilisation de la VR **/
        $vr = Game::all();
        $groupedVr = $vr->groupBy('VR');
        $groupedVr->toArray();
        $chartVr = Charts::create('pie', 'highcharts')
            ->title('Utilisation de la VR')
            ->labels(['Non','Oui'])
            ->elementLabel('VR')
            ->values([count($groupedVr['Non']),count($groupedVr['Oui'])])
            ->dimensions(450, 450)
            ->responsive(false);

        /**Partie listes des reservation **/
        $users = Acheteurs::all();
        $userInformation = [];

        foreach ($users as $key => $value){
            $userGame = $value->game;
            $userInformation[$key]['nom'] = $value->Nom;
            $userInformation[$key]['prenom'] = $value->Prenom;
            $userInformation[$key]['Email'] = $value->Email;
            $userInformation[$key]['Game'] = $userGame->Nom;
            $userInformation[$key]['jour'] = $userGame->Jour;
        }

        return view('dashboard', [
            'chart' => $chart,
            'chartGames' => $chartGame,
            'chartGamesMonth' => $chartGamesMonth,
            'chartVr' => $chartVr,
            'users' => $userInformation
        ]);


    }


}
