<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model {
    public $timestamps = false;

    protected $table = "champions";

    protected $primaryKey = "card_code";

    public $incrementing = false;

    protected $keyType = "string";

    protected $fillable = [
        "asset",
        "region",
        "attack",
        "cost",
        "health",
        "description",
        "levelup_description",
        "flavor_text",
        "artist_name",
        "name",
        "card_code",
        "rarity",
        "subtype",
        "collectible"
    ];

    protected $casts = [
        "asset" => "string",
        "region" => "string",
        "attack" => "integer",
        "cost" => "integer",
        "health" => "integer",
        "description" => "string",
        "levelup_description" => "string",
        "flavor_text" => "string",
        "artist_name" => "string",
        "name" => "string",
        "card_code" => "string",
        "rarity" => "string",
        "subtype" => "string",
        "collectible" => "boolean"
    ];

}
