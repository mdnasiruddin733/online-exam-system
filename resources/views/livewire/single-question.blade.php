<div class="card">
    <div class="card-header bg-dark text-white">
        <div class="row">
            <div class="col-10"><strong class="pr-2"><span class="badge badge-success p-2">{{$index}}</span></strong>{{$question->text}}</div>
            <div class="text-right col-2">
                <button title="Remove Question" type="button" class="btn btn-danger btn-floating btn-sm" style="" wire:click="remove">
                    <i class="fas fa-trash-o"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
                <div class="col-md-6 col-12 mb-2">
                    <input type="text" class="form-control @error('option') is-invalid @enderror" placeholder="Option text" wire:model="option" wire:model="option">
                    @error('option')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 col-6">
                    <div class="form-check form-check-inline pl-0">
                        <input class="form-check-input" type="checkbox" id="checkbox-{{$index}}" wire:model="correct" value="1"/>
                        <label class="form-check-label" for="checkbox-{{$index}}">Correct Answer</label>
                    </div>
                </div>
                <div class="col-md-2 col-6 text-right">
                    <button wire:click="submit" title="Add Option" type="button" class="btn btn-success  btn-sm ripple-surface-dark" data-mdb-ripple-color="dark">
                        Add Option
                    </button>
                </div>
             </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($options as $key=>$option)
                    @livewire("single-option",["option"=>$option,"index"=>++$key],key($option->id))
                @endforeach
            </div>
        </div>
    </div>
</div>