<table>
    <thead>
        <tr class="thead">
            <th style="padding:50px;">Roll</th>
            <th style="padding:50px;">Name</th>
            <th>Email</th>
            <th>Full Marks</th>
            <th>Acquired Marks</th>
            <th>Rank</th>
            <th>Submission Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $key=>$result)
            <tr>
                <td>{{$result->student->roll}}</td>
                <td>{{$result->student->name}}</td>
                <td>{{$result->student->email}}</td>
                <td>{{$result->exam->questions->sum("marks")}}</td>
                <td>{{$result->marks}}</td>
                <td>{{$key+1}}</td>
                <td>{{$result->created_at->format('d-m-Y g:ia')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>