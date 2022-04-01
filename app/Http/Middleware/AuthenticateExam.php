<?php

namespace App\Http\Middleware;

use App\Models\Exam;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthenticateExam
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
        $exam_id=$request->route('exam_id');
        $exam=Exam::findOrFail($exam_id);
        $student=$exam->course->students->where("id",Auth::id())->firstOrFail();
        if(empty($student)){
            abort(403);
        }
        return $next($request);
    }
}
