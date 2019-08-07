<?php

namespace App\Http\Controllers\Api\V1;

use App\ExamDetail;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function index(Request $request)
    {
        $exam_id = $request->get('exam_id');

        $examDetail = ExamDetail::where('exam_id', $exam_id)->pluck('question_id');

        return Question::whereIn('id', $examDetail)->get();
    }
}
