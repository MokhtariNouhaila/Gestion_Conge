@extends('layouts.headerMenu')


@section('title', 'modifier')
@section('content')


<div  style="width: 90%; float:right; background-color:#dddddd;;min-height: 100vh" >
<h3 class="mx-5 my-4">

Modifier un employé
</h3>

@if(session()->has('fail'))
 <div class="alert alert-danger mx-auto w-75">
 {{session()->get('fail')}}
 </div>
 @endif
 
<div class="mx-auto"  style="width:60%;" >
<form action="{{url('users/'.$user->id)}}" method="post">
<input type="hidden" name="_method" value="PUT">
    {{csrf_field() }}
    
 <div class="bg-dark  my-5 py-5 px-5 mx-auto">
 <div class="form-row ">
 
  </div>
  <div class="form-row mt-5">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">Nom</label>
      <input  type="text" class="form-control  "  name="nom" id="nom" value="{{$user->nom}}">
      @if($errors->get('nom'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('nom') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
    <div class="form-group col-md-6">
      <label  class="text-white" for="inputPassword4">Prenom</label>
      <input  type="text" class="form-control  "name="prenom" id="prenom" value="{{$user->prenom}}">
      @if($errors->get('prenom'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('prenom') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
  </div>
  <div class="form-row ">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">Email</label>
      <input  type="email" class="form-control  "  name="email"id="email" value="{{$user->email}}">
      @if($errors->get('email'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('email') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
    <div class="form-group col-md-6">
    <label class="text-white" for="inputEmail4">CONGE</label>
      <input  min="0" type="number" class="form-control  " name="duree" id="duree" value="{{$user->autorise}}">
      @if($errors->get('duree'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('duree') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
  </div>
  
    <div class="form-group col-md-6 ">
    <input type="hidden" name="password" id="password" value="{{$user->password}}"/>
    <input type="hidden" name="autorise" id="autorise" value="{{$user->autorise}}"/>
    <input type="submit"  class="btn btn-sm btn-outline-success h-50 mt-5 mx-5" value="MODIFIER"/>
    

    </div>
  </div>

 </div>
 
</form>
</div>
</div>     




@endsection