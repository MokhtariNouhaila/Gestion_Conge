<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

 </head>
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> 
<link rel="icon" type="image/png" href="/icons.png" />
<body class="bg-dark " >
    
             
<nav class="nav flex-column border-bottom avbar-dark bg-dark text-white" >
  <a class="nav-link active " href="#">
  <nav class="nav">
  <a class="text-info navbar-brand   " href="{{ url('/dash') }}"><h5>CONGE</h5></a>
  <a style="margin-left:13px;"  href=" {{ url('/generer') }}"
    class="h-25 d-inline-block btn-sm my-2 my-sm-0 btn btn-info"> GENERER LES CONGES <span class="badge  badge-pill badge-danger">!</span></a>
  
<a style="margin-left:850px;"  href="{{ route('logout') }}" 
    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
    class="h-25 d-inline-block btn-sm my-2 my-sm-0 btn btn-light"> QUITTER <span class="badge  badge-pill badge-danger">X</span></a>
  
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
   

</nav> 
</a>
 </nav>

<div  class="border-right" style="width: 10%;min-height: 100vh; float:left;">  
<a class="nav-link   text-white   mt-4" href="{{ url('/dash') }}">Dashboard</a>
  <a class="nav-link   text-white pt-4 mt-4 border-top" href="{{ url('/users') }}">Employees</a>
  <a class="nav-link  text-white pt-4  mt-4 border-top" href="{{ url('/conges/create') }}">Ajouter un employé</a>
  <a class="nav-link  text-white pt-4  mt-4 border-top" href=" {{ url('/conges') }}">Demandes</a>
  <a class="nav-link text-white  pt-4  mt-4 border-top" href="{{url('conges/5/etat')}} ">En cours</a>
  <a class="nav-link text-white   pt-4 mt-4 border-top" href="{{url('conges/1/etat')}} ">Valider</a>
  <a class="nav-link text-white  pt-4  mt-4 border-top" href="{{url('conges/0/etat')}} ">Rejeter</a></div>
 
 
  @yield('content')
 

<div>

</div>
 
  <scipt src="{{asset('js/bootstrap.min.js')}}"></script>
    <scipt src="{{asset('js/jquery.min.js')}}"></script>
          
</body> 


</html>