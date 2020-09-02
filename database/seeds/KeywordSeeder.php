<?php

use Illuminate\Database\Seeder;

use App\Models\Keyword;

class KeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set1Path = realpath(__DIR__ . "/../../resources/globals.json");
        $set1 = json_decode(file_get_contents($set1Path), true);

        $set1Keywords = array_merge($set1["vocabTerms"], $set1["keywords"]);

        for ($i = 0; $i < count($set1Keywords); $i++) {
            if($set1Keywords[$i]["description"] === " ") {
                unset($set1Keywords[$i]);
            }
            unset($set1Keywords[$i]["nameRef"]);
        }

        foreach ($set1Keywords as $card) {
            Keyword::create([
                "keyword" => $card["name"],
                "description" => $card["description"]
            ]);
        }
    }
}
