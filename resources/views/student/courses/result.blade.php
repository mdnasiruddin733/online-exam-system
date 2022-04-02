

@php 
$count=0;
$my_answers=json_decode($result->my_answers,true);
$right_answers=json_decode($result->right_answers,true);
@endphp

@extends("layouts.app")
@section("breadcrumb")
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$result->exam->course->name}}</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$result->exam->title}}</a></li>
        <li class="breadcrumb-item active">Result</li>
@endsection
@section("content")
<button onclick="savePDF()" class="btn btn-success m-3">Save result as pdf</button>
<div class="container" id="container">
    <div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center bg-primary text-light">My Information</div>
            <div class="card-body">
                <p><strong>Name:</strong><span class="mx-2">{{$result->student->name}}</span></p>
                <p><strong>Email:</strong><span class="mx-2">{{$result->student->email}}</span></p>
                <p><strong>Roll:</strong><span class="mx-2">{{$result->student->roll}}</span></p>
            </div>
        </div>
    </div>
     <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center bg-primary text-light">My Result</div>
            <div class="card-body">
                <p><strong>Aquired Marks:</strong><span class="mx-2">{{$result->marks}}</span></p>
                <p><strong>Full Marks:</strong><span class="mx-2">{{array_sum($result->exam->questions->pluck('marks')->toArray())}}</span></p>
                <p><strong>Student Rank:</strong><span class="mx-2">{{$rank}}</span></p>
            </div>
        </div>
    </div>
</div>
<div class="row">

    @foreach($my_answers as $key=>$my_answer)
    @php 
        $count++;
        $question=$result->exam->questions->where('id',$key)->first();
        $right_answer=$right_answers[$key];
    @endphp
    <div class="col-md-12">
        <div class="card">
    
            <div class="card-header bg-{{$my_answer==$right_answer? "success" :"danger"}} text-light">
                <div class="row">
                    <div class="col-md-9">
                        ({{$count}})&nbsp;{{$question->text}}
                    </div>
                    <div class="col-md-3">
                        Marks:{{$question->marks}}&nbsp;||&nbsp;Negative Marks: {{$question->negative_marks}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach($question->options as $key=>$option)
                    @php
                    $class="dark";
                        if((in_array($option->id, $my_answer) && $option->correct)){
                            $class="success";
                        }elseif((in_array($option->id, $my_answer) && $option->correct==0)){
                            $class="danger";
                        }
                    @endphp
                    <div class="text-{{$class}}">
                        <span class="badge badge-{{$class}}">{{+$key}}</span>
                        <span>{{$option->text}}</span>
                        @if($class=="danger")
                        <span class="fas fa-times"></span>
                        @endif
                        @if($option->correct)
                        <span class="fas fa-check"></span>
                        @endif
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>
@endsection


@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   function savePDF(){
        var element = document.getElementById('container');
        var opt = {
            margin:       0.2,
            filename:     'my-result.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
   }
</script>
@endsection