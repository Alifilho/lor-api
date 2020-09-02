<?php


namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

use App\Models\Keyword;

class CommonController {
    private $model;

    function __construct(Model $model) {
       $this->setModel($model);
    }

    function getCards() {
        $cards = $this->getModel()::all();

        foreach ($cards as $card) {
            $relationships = DB::table("card_keywords")->where("id_card", $card->card_code)->get();

            if(count($relationships) > 0) {
                $relatedKeywords = array();

                for ($i = 0; $i < count($relationships); $i++) {
                    array_push($relatedKeywords, Keyword::find($relationships[$i]->id_keyword)->keyword);
                }

                $card->keywords = $relatedKeywords;
            }
        }

        return $cards;
    }

    function getCard($id) {
        $card = $this->getModel()::find($id);

        $relationships = DB::table("card_keywords")->where("id_card", $id)->get();

        if(count($relationships) > 0) {
            $relatedKeywords = array();

            for ($i = 0; $i < count($relationships); $i++) {
                array_push($relatedKeywords, Keyword::find($relationships[$i]->id_keyword)->keyword);
            }

            $card->keywords = $relatedKeywords;
        }

        return $card;
    }

    function postCard($data) {
        if($this->getModel()::find($data["card_code"])) {
            return ["message" => "Card already exists"];
        }

        $keywords = $data["keywords"];

        if(count($keywords) > 0) {
            foreach ($keywords as $keyword) {
                $key = Keyword::where('keyword', $keyword)->first()->id;
                DB::table("card_keywords")->insert([
                    "id_card" => $data["card_code"],
                    "id_keyword" => $key
                ]);
            }
            unset($data["keywords"]);
        }

        $card = $this->getModel()::create($data);

        $card["keywords"] = $keywords;

        return $card;
    }

    function updateCard($id, $data) {
        $card = $this->getModel()::find($id);

        if(!$card) {
            return response()->json(["message" => "Card doesn't exists"]);
        }

        $updates = array_keys($data);

        foreach ($updates as $update) {
            if (strcmp($update, "keywords") !== 0) {
                $card[$update] = $data[$update];
            }
        }

        $card->save();

        if(in_array("keywords", $updates)) {
            $relationships = DB::table("card_keywords")->where("id_card", $id)->get();
            for ($i = 0; $i < count($relationships); $i++) {
                DB::table("card_keywords")
                    ->where("relationship_id", "=", $relationships[$i]->relationship_id)
                    ->delete();
            }
            if(count($data["keywords"]) > 0) {
                foreach ($data["keywords"] as $keyword) {
                    $key = Keyword::where('keyword', $keyword)->first()->id;
                    DB::table("card_keywords")->insert([
                        "id_card" => $id,
                        "id_keyword" => $key
                    ]);
                }
            }

            $card->keywords = $data["keywords"];
        }

        return $card;
    }

    function deleteCard($id) {
        $relationships = DB::table("card_keywords")->where("id_card", $id)->get();

        if(count($relationships) > 0) {
            for ($i = 0; $i < count($relationships); $i++) {
                DB::table("card_keywords")
                    ->where("relationship_id", "=", $relationships[$i]->relationship_id)
                    ->delete();
            }
        }

        $follower = $this->getModel()::destroy($id);

        return $follower === 1 ? ["Message" => "Success"] : ["Message" => "Error"];
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }
}
