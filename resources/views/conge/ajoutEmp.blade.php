@extends('layouts.headerMenu')
@section('title', 'nouveau employe')


@section('content')
<style>
.corps{
  width: 90%; float:right; background-color:#dddddd;;min-height: 100vh;
}
</style>

<div  class="corps" >
<h3 class="mx-5 my-4">

Ajouter un employé
</h3>

<div class="mx-auto"  style="width:60%;" >
<form action="{{url('users')}}" method="post">
    {{csrf_field() }}
    
 <div class="bg-dark  my-5 py-5 px-5 mx-auto">
 <div class="form-row ">
 
  </div>
  <div class="form-row mt-5">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">Nom</label>
      <input  type="text" class="form-control  "  name="nom" id="nom" value="{{old('nom')}}">
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
      <input  type="text" class="form-control  "name="prenom"  value="{{old('prenom')}}"  id="prenom">
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
      <input  type="email" class="form-control  "   value="{{old('email')}}"  name="email"id="email" >
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
      <label  class="text-white" for="password">Password</label>
      <input  type="text" class="form-control  "  name="password"  value="{{old('password')}}" id="password">
      @if($errors->get('password'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('password') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">CONGE</label>
      <input  min="0" type="number" class="form-control  "  value="{{old('duree')}}"  name="duree" id="duree" >
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
    <div class="form-group col-md-6 ">
    <input type="submit" value="+ AJOUTER"  class="btn btn-sm btn-outline-success h-50 mt-5 mx-5" OnClick="window.location.href='ajouter'" />

    </div>
  </div>

 </div>
 
</form>
</div>
</div>     




@endsection