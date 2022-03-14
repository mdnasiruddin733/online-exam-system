
@extends('layouts.app')
@section("breadcrumb")
    <li class="breadcrumb-item"><a href="{{route('dashboard.teacher')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('teacher.exam.index',$exam->course->id)}}">{{$exam->title}}</a></li>
    <li class="breadcrumb-item active">Exams</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <table id="data-table">
            <thead>
                <tr>
                    <th>Student Roll</th>
                    <th>Student Name</th>
                    <th>Marks</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $marks=[]; 
                $rank=0;
                foreach($exam->students as $student){
                    
                    $marks[$student->id]=$student->pivot->marks;
                    arsort($marks);
                    
                }
               ?>
                @foreach($marks as $student_id=>$marks)
                 <?php
                  
                  $student= $exam->students->where('id',$student_id)->first();
                  $rank+=1;
                  
                 ?>
                    <tr>
                        <td>{{$student->roll}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->pivot->marks}}</td>
                        <td>{{$rank}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section("scripts")
<script>
   
$('#data-table').DataTable();
</script>
@endsection