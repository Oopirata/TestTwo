<!DOCTYPE HTML>
<html>
<head>
<title>@yield('title') - Prolims</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{-- <meta http-equiv="refresh" content="60"> --}}
<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Pusher -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
{{-- Audio --}}


<script>
  
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;
  
  var pusher = new Pusher('a980d70c9ad0c7168f38', {
    cluster: 'ap1'
  });

  
  var channel = pusher.subscribe('notification-channel');
  channel.bind('server-alert', function(data) {
    // alert(JSON.stringify(data.message));
    var audio = new Audio("{{ asset('style/sounds/alert3.mp3') }}");
    console.log(audio);
    // audio.muted = true;
    audio.play();
    
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-full-width",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "swing",
      "showMethod": "slideDown",
      "hideMethod": "fadeOut"
    };


    if(data.message.memory>=data.message.cpu && data.message.memory>=data.message.disk){
      toastr["error"](data.message.namaa +" | Memory Utility "+data.message.memory+"%", "Memory " + data.message.namaa + ' Utilitas Tinggi');
    }else if(data.message.cpu>=data.message.memory && data.message.cpu>=data.message.disk){
      toastr["error"](data.message.namaa +" | CPU Utility "+data.message.cpu+"%", "CPU " + data.message.namaa + ' Utilitas Tinggi');
    }else if(data.message.disk>=data.message.memory && data.message.disk>=data.message.cpu){
      toastr["error"](data.message.namaa +" | Disk Utility "+data.message.disk+"%", "Disk " + data.message.namaa + ' Hampir Penuh');
    }

    
  });

  </script>
{{-- endofpusher --}}

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- Datatable -->
<link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<link href="{{ asset('style/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all">

<!-- Custom Theme files -->
<link href="{{ asset('style/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>

<!--js-->
<script src="{{ asset('style/js/jquery-2.1.1.min.js') }}"></script> 

<!--icons-css-->
<script src="https://kit.fontawesome.com/37df1c11da.js" crossorigin="anonymous"></script>
<link href="{{ asset('style/css/font-awesome-1.css') }}" rel="stylesheet">

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

{{-- modernzir --}}
<script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script>window.modernizr || document.write('<script src="lib/modernizr/modernizr-custom.js"><\/script>')</script>
</head>
<style>
    tr[data-href] {
    cursor: pointer;
    }
</style>
<body>
    @yield('page')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
</body>
</html>