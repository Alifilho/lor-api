<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller {
    private $modelController;
    private $followers;

    function __construct() {
        $this->setModelController(app("App\Models\Follower"));
        $this->setFollowers(new CommonController($this->getModelController()));
    }

    public function getModelController() {
        return $this->modelController;
    }

    public function setModelController($modelController) {
        $this->modelController = $modelController;
    }

    public function getFollowers() {
        return $this->followers;
    }

    public function setFollowers($followers) {
        $this->followers = $followers;
    }

    public function index() {
        return response()->json($this->getFollowers()->getCards());
    }

    public function show($id) {
        return response()->json($this->getFollowers()->getCard($id));
    }

    public function store(Request $request) {
        return response()->json($this->getFollowers()->postCard([
            "asset" => $request->input("asset"),
            "region" => $request->input("region"),
            "attack" => $request->input("attack"),
            "cost" => $request->input("cost"),
            "health" => $request->input("health"),
            "description" => $request->input("description"),
            "flavor_text" => $request->input("flavorText"),
            "artist_name" => $request->input("artistName"),
            "name" => $request->input("name"),
            "card_code" => $request->input("cardCode"),
            "rarity" => $request->input("rarity"),
            "subtype" => $request->input("subtype"),
            "collectible" => $request->input("collectible"),
            "keywords" => $request->input("keywords")
        ]));
    }

    public function update($id, Request $request) {
        return response()->json($this->getFollowers()->updateCard($id, $request->all()));
    }

    public function destroy(Request $request) {
        return response()->json($this->getFollowers()->deleteCard($request->query("id")));
    }
}
