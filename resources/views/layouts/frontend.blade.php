<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- MDB -->
        <link href="{{asset('frontend')}}/assets/css/mdb.min.css" rel="stylesheet" />
       
        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield("content")
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{asset('frontend')}}/assets/js/mdb.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="{{asset('frontend/js/ripples.js')}}"></script>
        <script>
           $(document).ready(function(){
               $('body').ripples({
                resolution: 512,
                dropRadius: 20,
                perturbance: 0.04,
                });
           })
        </script>
        
    </body>

</html>
