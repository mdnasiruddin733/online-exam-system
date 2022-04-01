<div>
  <div class="card">
        <div class="card-header bg-primary text-light text-center">
                <div class="row">
                    <div class="col-md-8 text-left">
                        Result analytics for {{$exam->title}}
                    </div>
                    <div class="col-md-4 text-right">
                        <a class="btn btn-success" href="{{route('teacher.export.result',$exam->id)}}">Download Result </a>
                    </div>
                </div>
        </div>
      <div class="card-body table-responsive">
        @if(count($results)>0)
        <table class="table table-stripped" id="result-table">
            <thead>
                <th>Roll</th>
                <th>Name</th>
                <th>Submission Time</th>
                <th>Marks</th>
                <th>Rank</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($results as $key=>$result)
                <tr>
                    <td>{{$result->student->roll}}</td>
                    <td>{{$result->student->name}}</td>
                    <td>{{$result->created_at->diffForHumans()}}</td>
                    <td>{{$result->marks}}</td>
                    <td>{{++$key}}</td>
                    <td>
                        <a href="{{route("teacher.exam.show.result", ["result_id"=>$result->id,"rank"=>$key])}}" class="btn btn-primary">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else 
        <h1 class="text-muted text-center">No Result Found</h1>
        @endif
      </div>
  </div>
</div>
