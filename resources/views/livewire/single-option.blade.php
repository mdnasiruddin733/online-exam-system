
<div class="row">
    <style>
        .option{
             transition: 0.1s;
        }
        .option:hover{
            background-color:#e2e9de;
        }
        .option button {
            display:none;
             transition: display 0.1s;
        }
        .option:hover button{
            display:inline;
           
        }
    </style>
    <div class="col-md-12 option">

        <div class="row">
            <div class="col-10">
                <span class="badge badge-{{$option->correct? "success" : "default"}}">{{$index}}</span>
                <span class="p-3 text-{{$option->correct? "success" : "default"}}">{{$option->text}}</span>
            </div>
            <div class="col-2 text-right">
                <button type="button" class="btn btn-danger btn-floating btn-sm ml-3" wire:click="delete">
                    <i class="fas fa-close"></i>
                </button>
            </div>
        </div>
    </div>
</div>

