<div>
  <div class="card">
        <div class="card-header bg-primary text-light">     
           
            <div class="row">
                    <div class="col-md-6 text-left">
                         Students activity monitoring for {{$exam->title}}
                    </div>
                    <div class="col-md-6 text-right">
                        <input type="text" class="form-control" placeholder="Write warning message for students" wire:model="message">
                    </div>
            </div>   
        </div>
      <div class="card-body table-responsive">
        @if(count($monitors)>0)
        <table class="table table-stripped" id="monitor-table">
            <thead>
                <th>Roll</th>
                <th>Name</th>
                <th>Exam Left Count</th>
                <th>Time</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($monitors as $key=>$monitor)
                <tr>
                    <td>{{$monitor->student->roll}}</td>
                    <td>{{$monitor->student->name}}</td>
                    <td>{{$monitor->count}}</td>
                    <td>{{$monitor->created_at->diffForHumans()}}</td>
                    <td>
                       <button class="btn btn-primary" wire:click="warn({{$monitor->student_id}})">Warn Student</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else 
        <h1 class="text-muted text-center">No Monitor Found</h1>
        @endif
      </div>
  </div>
</div>
