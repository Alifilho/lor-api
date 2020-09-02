<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChampionController extends Controller {
    private $modelController;
    private $champions;

    function __construct() {
        $this->setModelController(app("App\Models\Champion"));
        $this->setChampions(new CommonController($this->getModelController()));
    }

    public function getModelController() {
        return $this->modelController;
    }

    public function setModelController($modelController) {
        $this->modelController = $modelController;
    }

    public function getChampions() {
        return $this->champions;
    }

    public function setChampions($champions) {
        $this->champions = $champions;
    }

    public function index() {
        return response()->json($this->getChampions()->getCards());
    }

    public function show($id) {
        return response()->json($this->getChampions()->getCard($id));
    }

    public function store(Request $request) {
        return response()->json($this->getChampions()->postCard([
            "asset" => $request->input("asset"),
            "region" => $request->input("region"),
            "attack" => $request->input("attack"),
            "cost" => $request->input("cost"),
            "health" => $request->input("health"),
            "description" => $request->input("description"),
            "levelup_description" => $request->input("levelupDescription"),
            "flavor_text" => $request->input("flavorText"),
            "artist_name" =>  $request->input("artistName"),
            "name" => $request->input("name"),
            "card_code" => $request->input("cardCode"),
            "rarity" => $request->input("rarity"),
            "subtype" => $request->input("subtype"),
            "collectible" => $request->input("collectible"),
            "keywords" => $request->input("keywords")
        ]));
    }

    public function update($id, Request $request) {
        return response()->json($this->getChampions()->updateCard($id, $request->all()));
    }

    public function destroy(Request $request) {
        return response()->json($this->getChampions()->deleteCard($request->query("id")));
    }
}
