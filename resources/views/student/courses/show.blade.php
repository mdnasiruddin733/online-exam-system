@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.student')}}">Home</a></li>
     <li class="breadcrumb-item"><a href="{{route('student.course.enrolled-course')}}">Enrolled Courses</a></li>
    <li class="breadcrumb-item active">{{$course->name}}</li>
@endsection
@section('content')
@if(count($course->exams)>0)
<div class="row">
    @foreach($course->exams as $exam)
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <a href="{{route('student.course.show',$exam->id)}}">
        <div class="card">
            <div class="card-block">
               <center><strong style="color:hsl(332, 100%, 50%);">{{$exam->title}}</strong></center>
               <hr>
              <table class="table table-striped">
                  </tr><th>Type:</th><td class="text-uppercase">{{$exam->type}}</td></tr>
                  </tr><th>Total Question:</th><td class="text-uppercase">{{count($exam->questions)}}</td></tr>
                   </tr><th>Start Time:</th><td class="text-uppercase">{{date('d-M-Y (D) || H:i A',strtotime($exam->started_at))}}</td></tr>
                   </tr><th>End Time:</th><td class="text-uppercase">{{date('d-M-Y (D) || H:i A',strtotime($exam->ended_at))}}</td></tr>
                    <?php
                        $datetime1 = new DateTime($exam->started_at);
                        $datetime2 = new DateTime($exam->ended_at);
                        $interval = $datetime1->diff($datetime2);
                        $start=(int) strtotime($exam->started_at) ;
                        $end=(int) strtotime($exam->ended_at) ;
                        $now=time();
                    ?>
                    </tr><th>Duration:</th><td class="text-uppercase">{{$interval->format('%h')." Hours ".$interval->format('%i')." Minutes"}}</td></tr>
                </tr><th><i class="mdi mdi-clock"></i>&nbsp;Time Left for Ending Exam:</th>
                
                   @if($end > $now)
                    <td class="text-uppercase" id="timer-{{$exam->id}}" style="font-family:serif;"></td>
                   @else
                   <td class="text-danger">Exam Ended</td>
                   @endif
                </tr>
            
              </table>
              
                @if($start < $now && $now < $end)
                    @if(auth()->user()->hasGivenExam($exam->id))
                          <a href="{{route('student.exam.view-result',$exam->id)}}" class="btn btn-success">View Result</a>
                    @else
                    <a href="{{route('student.exam.participate',$exam->id)}}" class="btn btn-success">Participate</a>
                    @endif
                @elseif($now < $start)
                <p class="text-warning">Exam Not Started</p>
                
                @elseif($now > $end)
                    @if(auth()->user()->hasGivenExam($exam->id))
                          <a href="{{route('student.exam.view-result',$exam->id)}}" class="btn btn-success">View Result</a>
                    @else
                        <p class="text-danger text-center">Exam Ended. Unfortunately, you didn't participated.</p>
                    @endif
                @endif
            </div>
        </div>
        </a>
    </div>
    @endforeach
</div>
@else 
<div class="row">
    <center class="text-danger p-3">You are not enrolled in any courses</center>
</div>
@endif
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();


@foreach($course->exams as $exam)
    setTimer(`{{date('M d, Y H:i:s',strtotime($exam->ended_at))}}`,`timer-{{$exam->id}}`)
@endforeach

function setTimer(end_date,id){
    
    var countDownDate = new Date(end_date).getTime();
    var timer=document.getElementById(id)
    var myfunc = setInterval(function() {
    var now = new Date().getTime();
    var timeleft = countDownDate - now;
        
    var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
    timer.innerHTML=days+":"+hours+":"+minutes+":"+seconds

    }, 1000)
}
    
</script>
@endsection