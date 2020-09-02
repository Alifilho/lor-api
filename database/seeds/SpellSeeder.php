<?php

use Illuminate\Database\Seeder;

use App\Models\Spell;
use App\Models\Keyword;
use \Illuminate\Support\Facades\DB;

class SpellsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set1Path = realpath(__DIR__ . "/../../resources/set1.json");
        $set1 = json_decode(file_get_contents($set1Path), true);

        $set2Path = realpath(__DIR__ . "/../../resources/set2.json");
        $set2 = json_decode(file_get_contents($set2Path), true);

        $sets = array_merge($set1, $set2);

        $Spells = array();

        foreach ($sets as $card) {
            if($card["type"] === "Spell" && $card["flavorText"] !== "") {
                array_push($Spells, $card);
            }
        }

        foreach ($Spells as $card) {
            if(count($card["keywords"]) > 1) {
                foreach ($card["keywords"] as $keyword) {
                    if($keyword !== "Burst" && $keyword !== "Fast" && $keyword !== "Slow") {
                        $keywordId = Keyword::where('keyword', '=', $keyword)->firstOrFail()->id;
                        DB::table("card_keywords")->insert([
                            "id_card" => $card["cardCode"],
                            "id_keyword" => $keywordId
                        ]);
                    }
                }
            }

            Spell::create([
                "asset" => $card["assets"][0]["gameAbsolutePath"],
                "region" => $card["region"],
                "cost" => $card["cost"],
                "description" => $card["descriptionRaw"],
                "flavor_text" => $card["flavorText"],
                "artist_name" => $card["artistName"],
                "name" => $card["name"],
                "card_code" => $card["cardCode"],
                "spell_speed" => $card["spellSpeedRef"],
                "rarity" => $card["rarityRef"],
                "supertype" => $card["supertype"],
                "collectible" => $card["collectible"]
            ]);
        }
    }
}
