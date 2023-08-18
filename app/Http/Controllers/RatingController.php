<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingValidator;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;


class RatingController extends Controller
{

    public function getByUserId($user_id = 0)
    {
        return Rating::where("user_id",$user_id)->get();
    }

    public function addRating(RatingValidator $request){

        $user = User::find($request->user_id);
        $rater = User::find($request->rater_id);


        if(!$user || !$rater){
            return response()->json(["error" => "Houve um erro"]);
        }

        if($user->id == $rater->id){
            return response()->json(["error" => "O utilizador nao pode se autoavaliar"]);
        }

        $rating = Rating::create([
            "user_id" => $request->user_id,
            "rating_comments" => $request->rating_comments,
            "rating_number" => $request->rating_number,
            "rater_id" => $request->rater_id
        ]);

        return $rating;

    }

    public function deleteOne($id = 0) {
        $rating = Rating::find($id);

        if(!$rating){
            return response()->json(["error" => "Avaliacao nao existe"]);
        }

        return $rating->delete();
    }

    public function updateOne(Request $request, $id = 0){

        $rating = Rating::find($id);

        if(!$rating){
            return response()->json(["error" => "Impossivel avaliar este utilizador"]);
        }

        $rating->update([
            "user_id" => $request->user_id,
            "rating_comments" => $request->rating_comments,
            "rating_number" => $request->rating_number,
            "rater_id" => $request->rater_id
        ]);

        return $rating;
    }

}