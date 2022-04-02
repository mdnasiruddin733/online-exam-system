<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <title>{{config("app.name")}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('backend')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="{{asset('frontend/css/countdown.css')}}">
@yield('styles')
</head>

<body>

    <div class="container">
         <main style="margin-top:20px;">
              @yield('content')
         </main>
    </div>

    <script src="{{asset('backend')}}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{asset('backend')}}/assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="{{asset('backend')}}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
    ></script>
    <script src="{{asset('backend')}}/js/waves.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(Session::has('message'))

	<script>
        Swal.fire({
            position: 'top-center',
            icon: "{{Session::get('type')}}",
            title: "{{Session::get('message')}}",
            showConfirmButton: false,
            timer: 1500
        })
	</script>
@endif
	<script>
		function confirmDelete(event){
			Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			if (result.isConfirmed) {
				location.href=event.target.dataset['link']
				Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
				)
			}
		})
		}
	</script>

  @yield('scripts')
  <script>
     window.Echo.private(`warn.{{auth()->user()->id}}`)
            .listen('WarnEvent', (event) => {
               alert(event.message);
        });
  </script>

</body>

</html>
