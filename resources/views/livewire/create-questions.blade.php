<div class="">
    <div class="col-md-12">
    <div class="card">
        <div class="card-header text-center bg-success">
            <div class="card-title text-white">Create Questions</div>
        </div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-12">
                    <input type="text" class="form-control @error('text') is-invalid @enderror" placeholder="Write question here" wire:model="text">
                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <input type="number" class="form-control @error('marks') is-invalid @enderror" placeholder="Marks" wire:model="marks">
                    @error('marks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control @error('negative_marks') is-invalid @enderror" placeholder="Negative Marks" wire:model="negative_marks">
                    @error('negative_marks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4 mx-auto">
                    <button class="btn btn-success btn-block" wire:click="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($questions->reverse() as $key=>$question)
<div class="col-md-12 mt-2">
   @livewire("single-question",['question'=>$question,'index'=>++$key],key($question->id))
</div>
@endforeach
</div>