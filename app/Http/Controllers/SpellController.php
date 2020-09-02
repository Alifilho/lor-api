<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpellController extends Controller {
    private $modelController;
    private $spells;

    function __construct() {
        $this->setModelController(app("App\Models\Spell"));
        $this->setSpells(new CommonController($this->getModelController()));
    }

    public function getModelController() {
        return $this->modelController;
    }

    public function getSpells() {
        return $this->spells;
    }

    public function setSpells($spells) {
        $this->spells = $spells;
    }

    public function setModelController($modelController) {
        $this->modelController = $modelController;
    }

    public function index() {
        return response()->json($this->getSpells()->getCards());
    }

    public function show($id) {
        return response()->json($this->getSpells()->getCard($id));
    }

    public function store(Request $request) {
        return response()->json($this->getSpells()->postCard([
            "asset" => $request->input("asset"),
            "region" => $request->input("region"),
            "cost" => $request->input("cost"),
            "description" => $request->input("description"),
            "flavor_text" => $request->input("flavorText"),
            "artist_name" => $request->input("artistName"),
            "name" => $request->input("name"),
            "card_code" => $request->input("cardCode"),
            "spell_speed" => $request->input("spellSpeed"),
            "rarity" => $request->input("rarity"),
            "supertype" => $request->input("supertype"),
            "collectible" => $request->input("collectible"),
            "keywords" => $request->input("keywords")
        ]));
    }

    public function update($id, Request $request) {
        return response()->json($this->getSpells()->updateCard($id, $request->all()));
    }

    public function destroy(Request $request) {
        return response()->json($this->getSpells()->deleteCard($request->query("id")));
    }
}
