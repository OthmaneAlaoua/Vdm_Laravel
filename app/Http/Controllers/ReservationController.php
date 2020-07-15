<?php

namespace App\Http\Controllers;

use App\Models\Acheteurs;
use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    private function errors($code)
    {
        switch ($code) {
            case 1:
                $error = "Les details de reservation ne sont pas présents";
                break;
            default:
                $error = "Une erreur est survenue veuillez ressayer";
        }
        return $error;
    }

    private function statistiques()
    {

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reservation_details' => 'required|array',
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $this->errors(1)], 400);
        }

        /**Si les details de reservation sont bien récéptionnés**/
        /**On enregistre les acheteurs **/
        $acheteur = new Acheteurs;
        $acheteur->Civilite = $request->reservation_details["Acheteur"]["Civilite"];
        $acheteur->Nom = $request->reservation_details["Acheteur"]["Nom"];
        $acheteur->Prenom = $request->reservation_details["Acheteur"]["Prenom"];
        $acheteur->Age = $request->reservation_details["Acheteur"]["Age"];
        $acheteur->Email = $request->reservation_details["Acheteur"]["Email"];
        $acheteur->save();

        /**On enregistre les informations de partie choisie **/
        $game = new Game;
        $game->Nom = $request->reservation_details["Game"]["Nom"];
        $game->Jour = $request->reservation_details["Game"]["Jour"];
        $game->Horaire = $request->reservation_details["Game"]["Horaire"];
        $game->VR = $request->reservation_details["Game"]["VR"];
        $game->User_Id = $acheteur->_id;


        $game->save();

        /**On parcours le tableau de reservation  pour stocker les spectateurs**/
        foreach ($request->reservation_details["Reservation"] as $key => $value) {
            $reservation = new Reservation();
            $reservation->Spectateur = $value["Spectateur"];
            $reservation->Game_id = $game->_id;
            $reservation->Tarif = $value['Tarif'];
            $reservation->save();
        }
    }

}
