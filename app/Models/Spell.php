<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model {
    public $timestamps = false;

    protected $table = "spells";

    protected $primaryKey = "card_code";

    public $incrementing = false;

    protected $keyType = "string";

    protected $fillable = [
        "asset",
        "region",
        "cost",
        "description",
        "flavor_text",
        "artist_name",
        "name",
        "card_code",
        "spell_speed",
        "rarity",
        "supertype",
        "collectible"
    ];

    protected $casts = [
        "asset" => "string",
        "region" => "string",
        "cost" => "integer",
        "description" => "string",
        "flavor_text" => "string",
        "artist_name" => "string",
        "name" => "string",
        "card_code" => "string",
        "spell_speed" => "string",
        "rarity" => "string",
        "supertype" => "string",
        "collectible" => "boolean"
    ];

}
