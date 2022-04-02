

@extends("layouts.app")
@section("breadcrumb")
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$exam->course->name}}</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">{{$exam->title}}</a></li>
        <li class="breadcrumb-item active">Questions</li>
@endsection
@section("content")
<button onclick="savePDF()" class="btn btn-success m-3">Download Question</button>
<div class="container" id="container">
    <div class="row">
        @foreach($exam->questions as $key=>$question)
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header bg-primary text-light">
                    <div class="row">
                        <div class="col-md-8">
                            ({{$key+1}})&nbsp;{{$question->text}}
                        </div>
                        
                        <div class="col-md-2 text-right">
                            Marks:{{$question->marks}}
                        </div>
                        <div class="col-md-2 text-right">
                            Negative Marks: {{$question->negative_marks}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($question->options as $key=>$option)
                        <div>
                            <span class="badge badge-{{$option->correct?'success':'dark'}} mr-2">{{$key}}</span>
                            <span class="text-{{$option->correct?'success':'dark'}} mr-2">{{$option->text}}</span>
                            @if($option->correct)
                            <span class="text-success fas fa-check"></span>
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
            filename:     'questions_{{$exam->title}}.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
   }
</script>
@endsection