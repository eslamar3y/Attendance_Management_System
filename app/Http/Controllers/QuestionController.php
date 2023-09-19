<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function getRandomQuestion()
    {
        $questions = question::all();
        $randomQuestion = $questions->random(1);
        return response()->json($randomQuestion);
    }
}
