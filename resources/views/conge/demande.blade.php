@extends('layouts.headerMenu')

@section('title', 'les demandes')

@section('content')
<style>
.cop{
  width: 90%; float:right; background-color:#dddddd;;min-height: 100vh;
}
.tabl{
  
  width: inherit;background-color:#ffffff;
}
</style>

<div class="cop" >
<h3 class="mx-5 my-4">
les Demandes 
</h3>
<div class="mx-5">
<a href="{{ url('conges') }} ">Tout les demandes | </a>
<a href="{{url('conges/5/etat')}} ">Demande en attend | </a>
<a href="{{url('conges/1/etat')}} "> Demande accepter | </a>

<a href="{{url('conges/0/etat')}} ">Demande reffuser</a>

</div>

<table class=" my-3 mx-5 table border-left tabl ">
  <thead class="thead-dark">
    <tr>
      
      <th class="border" scope="col">NOM</th>
      <th class="border" scope="col">PRENOM</th>
      <th class="border" scope="col">INFOS</th>
        <th class="border" scope="col">DEBUT/FIN</th>
   <th class="border" scope="col">DUREE</th> 
      <th class="border" scope="col">ETAT</th>
      <th class="border" scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  @foreach($conges as $conge)
    <tr>
     
      <td class="border">{{$conge->user->nom}}</td>
      <td class="border">{{$conge->user->prenom}}</td>
      <td class="border">{{$conge->user->credit}} jours de credit <br/>{{$conge->user->duree}} jours de conge</td>
       <td class="border">{{date('Y-m-d', strtotime($conge->debut))}}<br/>{{date('Y-m-d', strtotime($conge->fin))}}</td>
       <td class="border">{{$conge->duree}}</td>
     
      @if($conge->etat==5)<td class="text-warning border">En attend</td>
      @elseif($conge->etat==1)<td class="text-success border">accepter</td>
      @else<td class="text-danger border">reffuser</td>
      @endif
      @if($conge->etat==5) 
        <td class="border">
       <a href="{{url('conges/'.$conge->id.'/valider')}}" 
        class="btn btn-outline-primary btn-sm">ACCEPTER</a>
       <a  href="{{url('conges/'.$conge->id.'/rejeter')}}"  
       class="btn btn-outline-danger text-danger btn-sm">REFFUSER</a>
       </td>
     
       
      @elseif($conge->etat==1)
         <td class="border">
      
         <a  href="{{url('conges/'.$conge->id.'/rejeter')}}"  
       class="btn btn-outline-danger text-danger btn-sm">REFFUSER</a>
          </td>
      @else<td class="border" > <a  href="{{url('conges/'.$conge->id.'/valider')}}"
        class="btn btn-outline-primary btn-sm">ACCEPTER</a></td>
      @endif
    
    </tr>
       @endforeach
  </tbody>
</table></div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 




@endsection