<?php

use Illuminate\Database\Seeder;

use App\Models\Champion;
use App\Models\Keyword;
use \Illuminate\Support\Facades\DB;

class ChampionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $set1Path = realpath(__DIR__ . "/../../resources/set1.json");
        $set1 = json_decode(file_get_contents($set1Path), true);

        $set2Path = realpath(__DIR__ . "/../../resources/set2.json");
        $set2 = json_decode(file_get_contents($set2Path), true);

        $sets = array_merge($set1, $set2);

        $Champions = array();

        foreach ($sets as $card) {
            if($card["rarity"] === "Champion" ||
                ($card["supertype"] === "Champion" && $card["rarity"] === "None" && $card["type"] === "Unit")) {
                array_push($Champions, $card);
            }
        }

        foreach ($Champions as $card) {
            if(count($card["keywords"]) > 0) {
                foreach ($card["keywords"] as $keyword) {
                    $keywordId = Keyword::where('keyword', '=', $keyword)->firstOrFail()->id;
                    DB::table("card_keywords")->insert([
                        "id_card" => $card["cardCode"],
                        "id_keyword" => $keywordId
                    ]);
                }
            }

            Champion::create([
                "asset" => $card["assets"][0]["gameAbsolutePath"],
                "region" => $card["region"],
                "attack" => $card["attack"],
                "cost" => $card["cost"],
                "health" => $card["health"],
                "description" => $card["descriptionRaw"],
                "levelup_description" => $card["levelupDescriptionRaw"],
                "flavor_text" => $card["flavorText"],
                "artist_name" => $card["artistName"],
                "name" => $card["name"],
                "card_code" => $card["cardCode"],
                "rarity" => $card["rarityRef"],
                "subtype" => ucfirst(strtolower($card["subtype"])),
                "collectible" => $card["collectible"]
            ]);
        }
    }
}
