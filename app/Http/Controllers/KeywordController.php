<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Keyword;

class KeywordController extends  Controller {
    public function index() {
        $keywords = Keyword::all();

        return response()->json($keywords);
    }

    public function show($id) {
        $keyword = Keyword::find($id);

        return response()->json($keyword);
    }

    public function store(Request $request) {
        $keywordName = $request->input("keyword");
        $description = $request->input("description");

        $keyword = Keyword::create([
            "keyword" => $keywordName,
            "description" => $description
        ]);

        return response()->json($keyword);
    }

    public function update($id, Request $request) {
        $keyword = Keyword::find($id);

        $body = $request->all();
        $updates = array_keys($body);

        foreach ($updates as $update) {
            $keyword[$update] = $body[$update];
        }

        $keyword->save();

        return response()->json($keyword);
    }

    public function destroy(Request $request) {
        $id = $request->query("id");

        $keyword = Keyword::destroy($id);

        $message = $keyword === 1 ? ["Message" => "Success"] : ["Message" => "Error"];

        return response()->json($message);
    }
}
