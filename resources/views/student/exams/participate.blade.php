@extends("layouts.app2")




@section("content")
@if(strtotime($exam->started_at) > strtotime(now()))
    <h1 class="text-center">Exam Not Started</h1>
@elseif(strtotime($exam->ended_at) < strtotime(now())))
     <h1 class="text-center text-danger">Exam Ended</h1>
@else
    <div class="row m-3">
        <form action="{{route("student.exam.submit")}}" method="post">
            @csrf 
            <input type="hidden" name="exam_id" value="{{$exam->id}}">
            <div class="col-md-12 mb-2">
           <div class="card">
               <div class="card-body text-center">
                   <p style="font-size:20px;">Course Code: {{$exam->course->code}}</p>
                   <p style="font-size:20px;">Course Name: {{$exam->course->name}}</p>
                   <p style="font-size:20px;">Exam Topic: {{$exam->title}}</p>
                   <p>{{$exam->instructions}}</p>
                   @php 
                   $total_marks=0;
                    foreach($exam->questions as $question){
                        $total_marks+=$question->marks;
                    }
                   @endphp
                   <p>Full Marks: {{$total_marks}}</p>
               </div>
           </div>
        </div>
        <div class="col-md-12 mb-2">
        @if(count($exam->questions)>0)
            @foreach($exam->questions as $key => $question)
                <div class="col-md-12 mb-2">
                    <div class="card p-3">
                        <span style="font-size:24px;padding:2px;">{{++$key}})</span>
                        <p style="text-align:right;">Marks: {{$question->marks}}</p>
                        {!! $question->question !!}
                            <ol style="list-style-type:none;">
                                <li><input type="radio" name="answers[{{$question->id}}]" style="margin:5px; float:left;" value="1">{!! $question->option_1 !!}</li>
                                <li><input type="radio" name="answers[{{$question->id}}]" style="margin:5px; float:left;" value="2">{!! $question->option_2 !!}</li>
                                <li><input type="radio" name="answers[{{$question->id}}]" style="margin:5px; float:left;" value="3">{!! $question->option_3 !!}</li>
                                <li><input type="radio" name="answers[{{$question->id}}]" style="margin:5px; float:left;" value="4">{!! $question->option_4 !!}</li>
                            </ol>
                            @error("answers.".$question->id)
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                    </div>
                </div>
            @endforeach
            <div class="col-md-12">
                <input type="submit" class="btn btn-success" value="Submit">
            </div>
            @else 
            <h3 class="text-muted">No Questions Set Yet</h3>
        @endif
        </form>
    </div>
</div>
@endif

@endsection

