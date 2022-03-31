
@php 
    $minutes=timeDiff($exam->started_at,$exam->ended_at);
    $hours=0;
    if($minutes>60){
        $hours=floor($minutes/60);
        $minutes=$minutes%60;
    }
    $seconds=$minutes*60;
@endphp

@extends("layouts.app2")
@section('content')
<div class="row">
    <div class="col-md-12 mb-2">
       <div class="card">
           <div class="crad-body text-white p-3" style="background-color:#34495e">
                <h3 class="text-center">{{$exam->title}}</h3>
                <div class="alert alert-warning" id="warning">
                    <p>
                         <strong>Warning:</strong>
                       If you leave or hide this page before submission, your submission will not be considered as valid.
                    </p> 
                </div>
                <p><strong>Instructions:</strong>{{$exam->instructions}}</p>
                <div class="row mb-3">
                    <div class="col-md-12 justify-align-center">
                        {{-- Countdown clock starts --}}
                        <div class="countdown countdown-container container">
                            <div class="clock row">
                                <div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3" style="@if($seconds<86400) visibility:hidden; margin-left:-50px; @endif">
                                    <div class="wrap">
                                        <div class="inner">
                                            <div id="canvas-days" class="clock-canvas"></div>

                                            <div class="text">
                                                <p class="val">0</p>
                                                <p class="type-days type-time">DAYS</p>
                                            </div><!-- /.text -->
                                        </div><!-- /.inner -->
                                    </div><!-- /.wrap -->
                                </div><!-- /.clock-item -->
                                
                                
                                <div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3" style="@if($seconds<3600) visibility:hidden; margin-left:-50px; @endif">
                                    <div class="wrap">
                                        <div class="inner">
                                            <div id="canvas-hours" class="clock-canvas"></div>

                                            <div class="text">
                                                <p class="val">0</p>
                                                <p class="type-hours type-time">HOURS</p>
                                            </div><!-- /.text -->
                                        </div><!-- /.inner -->
                                    </div><!-- /.wrap -->
                                </div><!-- /.clock-item -->
                                
                                <div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
                                    <div class="wrap">
                                        <div class="inner">
                                            <div id="canvas-minutes" class="clock-canvas"></div>

                                            <div class="text">
                                                <p class="val">0</p>
                                                <p class="type-minutes type-time">MINUTES</p>
                                            </div><!-- /.text -->
                                        </div><!-- /.inner -->
                                    </div><!-- /.wrap -->
                                </div><!-- /.clock-item -->

                                <div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
                                    <div class="wrap">
                                        <div class="inner">
                                            <div id="canvas-seconds" class="clock-canvas"></div>

                                            <div class="text">
                                                <p class="val">0</p>
                                                <p class="type-seconds type-time">SECONDS</p>
                                            </div><!-- /.text -->
                                        </div><!-- /.inner -->
                                    </div><!-- /.wrap -->
                                </div><!-- /.clock-item -->
                            </div>
                        </div>
                        {{-- Countdown clock ends --}}
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-6">
                        <strong> Time:@if($hours>0) {{$hours}} hour @endif @if($minutes>0) {{$minutes}} minutes @endif</strong>
                    </div>
                    <div class="col-6 text-right">
                        <strong>Full Marks: {{fullmarks($exam)}}</strong>
                    </div>
                   
                </div>
           </div>
       </div>
    </div>

    <form action="{{route("student.exam.submit")}}" method="post">
        @csrf
        <input type="hidden" name="exam_id" value="{{$exam->id}}">
        @foreach ($exam->questions as $question)
        @php  
              $previous_selected_options=[];
              if(!is_null(old('questions'))){
                if(array_key_exists($question->id,old('questions'))) {
                    $previous_selected_options=old('questions')[$question->id];
                } 
              }
                         
        @endphp
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <h5>{{$question->text}}</h5>
                        </div>
                        <div class="col-md-4 col-12 text-right">
                            <strong>Marks:</strong><span>{{$question->marks}} || </span>
                            <strong>Negative Marks:</strong><span>{{$question->negative_marks}}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @foreach($question->options as $key=>$option)
                        <div class="form-check  pl-4">
                            <input class="form-check-input" type="checkbox" id="checkbox-{{$question->id.$option->id}}" name="questions[{{$question->id}}][]" @if(in_array($option->id,$previous_selected_options)) checked @endif value="{{$option->id}}"/>
                            <label class="form-check-label" for="checkbox-{{$question->id.$option->id}}">{{$option->text}}</label>
                        </div>
                    @endforeach
                </div>
               
                @error("questions.".$question->id) <div class="card-footer"><strong class="text-danger">{{$message}}</strong></div> @enderror
            </div>
        </div>
        @endforeach
        <div class="col-md-12 mb-4">
           <input type="submit" value="Submit" class="btn btn-success"> 
        </div>
    </form>
</div>
@endsection

@section("scripts")
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/kinetic.js')}}"></script>
<script src="{{asset('frontend/js/final_countdown.min.js')}}"></script>
<script>

            

    document.addEventListener("visibilitychange",function(event){
       if(event.target.visibilityState!=="visible"){
           $.ajax({
               url:"{{route('student.another-tab-open')}}",
               method:"post",
               data:{"_token":"{{csrf_token()}}"},
               dataType:"json",
               success:function(res){
                  $("#warning").html(`<p><strong>you have already left this page ${res.count} times</strong></p>`)
               }
           })
       }
    })

    $(document).ready(function(){
        
        $('.countdown').final_countdown({
            'start': "{{strtotime($exam->started_at)}}",
            'end': "{{strtotime($exam->ended_at)}}",
            'now': "{{time()}}"       
        },function(){
            alert("Time over")
        });
    })


</script>
@endsection