<?php

use Illuminate\Database\Seeder;

use App\Models\Follower;
use App\Models\Keyword;
use \Illuminate\Support\Facades\DB;

class FollowersSeeder extends Seeder
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

        $Followers = array();

        foreach ($sets as $card) {
            if($card["type"] === "Unit" && $card["supertype"] !== "Champion") {
                array_push($Followers, $card);
            }
        }

        foreach ($Followers as $card) {
            if(count($card["keywords"]) > 0) {
                foreach ($card["keywords"] as $keyword) {
                    $keywordId = Keyword::where('keyword', '=', $keyword)->firstOrFail()->id;
                    DB::table("card_keywords")->insert([
                        "id_card" => $card["cardCode"],
                        "id_keyword" => $keywordId
                    ]);
                }
            }
            Follower::create([
                "asset" => $card["assets"][0]["gameAbsolutePath"],
                "region" => $card["region"],
                "attack" => $card["attack"],
                "cost" => $card["cost"],
                "health" => $card["health"],
                "description" => $card["descriptionRaw"],
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
