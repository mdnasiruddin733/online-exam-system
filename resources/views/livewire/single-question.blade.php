<div class="card">
    <div class="card-header bg-dark text-white">
        <strong class="pr-2"><span class="badge badge-success p-2">{{$index}}</span></strong>{{$question->text}}
    </div>
    <div class="card-body">
        <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control @error('option') is-invalid @enderror" placeholder="Option text" wire:model="option" wire:model="option">
                    @error('option')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="checkbox-{{$index}}" wire:model="correct" value="1"/>
                        <label class="form-check-label" for="checkbox-{{$index}}">Correct Answer</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <button wire:click="submit" title="Add Option" type="button" class="btn btn-success  btn-sm ripple-surface-dark" data-mdb-ripple-color="dark">
                        Add Option
                    </button>
                </div>
             </div>
        <div class="row">
            <div class="col-md-12">
                <ol style="list-style-type:lower-alpha;" class="ml-3">
                @foreach($options as $option)
                    <li class="{{$option->correct?'text-success':''}}">{{$option->text}}</span></li>
                @endforeach
            </ol>
            </div>
        </div>
    </div>
</div>