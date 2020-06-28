<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>
 </head>
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand text-info active" href="{{url('conges')}}">CONGE</a>
 

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link"  href="{{url('users/profil')}}">PROFIL </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('conges')}}" >DEMANDE</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link " href="{{url('conges/create')}}" >NOUVELLE DEMANDE</a>
      </li>
    </ul>
   <span class="text-white mx-3">@yield('nom') </span> 
    <a href="{{ route('logout') }}" 
    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
    class="h-25 d-inline-block btn-sm my-2 my-sm-0 btn btn-light"> QUITTER <span class="badge  badge-pill badge-danger">X</span></a>
  
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
@yield('content')
 
 
<scipt src="{{asset('js/bootstrap.min.js')}}"></script>
    <scipt src="{{asset('js/jquery.min.js')}}"></script>
                
</body>
</html>