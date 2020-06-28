@extends('layouts.userMenu')
@section('title', 'profil')

@section('content')

 <div class="bg-dark w-50 my-5 py-5 px-5 mx-auto">
 <div class="form-row ">
 @section('nom')
 {{$user->nom}} {{$user->prenom}} 
  @endsection

  </div>
  <div class="form-row mt-5">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">Email</label>
      <input disabled type="email" class="form-control  " id="inputEmail4" value="{{$user->email}}">
    </div>
    <div class="form-group col-md-6">
      <label  class="text-white" for="inputPassword4">Conge total</label>
      <input disabled type="text" class="form-control  " id="inputPassword4" value="{{$user->autorise}}">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label class="text-white" for="inputEmail4">CONGE</label>
      <input disabled type="number" class="form-control  " id="inputEmail4" value="{{$user->duree}}">
    </div>
    <div class="form-group col-md-6 ">
      <label  class="text-white" for="inputPassword4">CREDIT</label>
      <input disabled type="number" class="form-control  " id="inputPassword4" value="{{$user->credit}}">
    </div>
  </div>
 </div>
@endsection