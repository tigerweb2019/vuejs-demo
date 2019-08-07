<?php

namespace App\Http\Controllers\Api\V1;

use App\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamsController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->get('term');
        $exam_id = $request->get('exam_id');

        if ($exam = Exam::find($exam_id)) {
            $exam['seconds'] = strtotime($exam['time']) - strtotime('00:00:00');

            return $exam;
        } else {
            return Exam::where('title', 'like', '%' . $term . '%')->limit(10)->get();
        }
    }
}
