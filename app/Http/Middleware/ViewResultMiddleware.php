<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ViewResultMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $exam=Exam::findOrFail($request->route('exam_id'));
        $student=Student::find(Auth::id());
        if($student->hasGivenExam($exam->id)){
             return $next($request);
        }else if(strtotime($exam->ended_at) < strtotime(now())){
             return $next($request);
        }else{
            abort(404);
        }
       
    }
}
