@extends('layouts.headerMenu')

@section('title', 'les employees')


@section('content')

<style>
.crp{
  width: 90%; float:right; background-color:#dddddd;;min-height: 100vh;
}
</style>
<div  class="crp" >
<h3 class="mx-5 my-4">
les employées

<a href="{{url('users/create')}}"
class="btn btn-success mx-5"  >+ Ajouter un employé</a>
</h3>
@if(session()->has('success'))
 <div class="alert alert-success mx-auto w-75">
 {{session()->get('success')}}
 </div>
 @endif
<table class=" my-3 mx-5 table border-left "style="width: inherit;background-color:#ffffff;">
  <thead class="thead-dark">
    <tr>
      <th class="border" scope="col">#</th>
      <th class="border" scope="col">NOM</th>
      <th class="border" scope="col">PRENOM</th>
      <th class="border" scope="col">DUREE</th>
      <th class="border" scope="col">CREDIT</th>
      <th class="border" scope="col">CONGE</th>
      <th class="border" scope="col">EMAIL</th>
    
      <th class="border" scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
    @foreach($s as $user)
    <tr>
      <th  class="border"scope="row">{{$user->id}}</th>
      <td class="border"> {{$user->nom}}</td>
      <td class="border">{{$user->prenom}}</td>
      <td class="border">{{$user->duree}}</td>
      <td class="border">{{$user->credit}}</td>
      <td class="border">{{$user->autorise}}</td>
      <td class="border">{{$user->email}}</td>
     
       <td class="border">
       <form action="{{url('users/'.$user->id)}}" method="post">
       {{csrf_field() }}
       {{method_field('DELETE') }} 
       <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-outline-primary btn-sm">MODIFIER</a >
       <button  type="submit" class="btn btn-outline-danger btn-sm">SUPPRIMER</button >
       </form>
      
      
       </td>
    </tr>
    @endforeach
  </tbody>
</table></div>




@endsection