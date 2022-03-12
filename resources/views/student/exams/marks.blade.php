@extends("layouts.app2")

@section("content")
    <div class="row m-3">
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Submission Time</th>
                                <th>Full Marks</th>
                                <th>Your Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> {{date("d-M-Y H:i A",strtotime($details[0]->submitted_at))}}</td>
                                <td>
                                    @php
                                    $full_marks=0;
                                    foreach($exam->questions as $question)
                                        $full_marks+=$question->marks;
                                    @endphp
                                    {{$full_marks}}
                                </td>
                                <td>{{$details[0]->marks}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if(count($exam->questions)>0)
    @foreach(json_decode($details[0]->answers,true) as $key => $answer)
            @php 
            $question=$exam->questions->where("id",$key)->first(); 
            @endphp
        <div class="col-md-12 mb-2">
            <div class="card p-3">
                <p><b>{{++$key}}.&nbsp;</b>
                    @if($answer===$question->answer)
                        <span class="text-success" style="font-size:30px;">&check;</span>
                    @else 
                        <span class="text-danger" style="font-size:30px;">&times;</span>
                    @endif
                    {!! $question->question !!}
                </p>
                    <ol style="list-style-type:upper-alpha;">
                        <li class="@if($answer==1 && $question->answer==1) text-success @elseif($answer==1 && $question->answer!=1) text-danger @elseif($question->answer==1) text-success @endif">{!! $question->option_1!!}</li>
                        <li class="@if($answer==2 && $question->answer==2) text-success @elseif($answer==2 && $question->answer!=2) text-danger @elseif($question->answer==2) text-success @endif">{!! $question->option_2!!}</li>
                        <li class="@if($answer==3 && $question->answer==3) text-success @elseif($answer==3 && $question->answer!=3) text-danger @elseif($question->answer==3) text-success @endif">{!! $question->option_3!!}</li>
                        <li class="@if($answer==4 && $question->answer==4) text-success @elseif($answer==4 && $question->answer!=4) text-danger @elseif($question->answer==4) text-success @endif">{!! $question->option_4!!}</li>
                    </ol>
                <p><strong>Answer:&nbsp;{{['A','B','C','D'][ $question->answer-1]}} &nbsp;||&nbsp; Marks: {{$question->marks}}</strong></p>
             </div>
        </div>
    @endforeach
    @else 
    <h3 class="text-muted">No Questions Set Yet</h3>
    @endif
        </div>
    </div>
@endsection