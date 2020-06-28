@extends('layouts.userMenu')

@section('title', 'les demandes')

@section('content')


<div  style="width: 100%; ">
<h3 class="mx-5 my-4">
les Demandes 
</h3>
<div class="mx-5">
<a href="{{ url('conges') }} ">Tout les demandes | </a>
<a href="{{url('conges/5/etat')}} ">Demande en attend | </a>
<a href="{{url('conges/1/etat')}} "> Demande accepter | </a>

<a href="{{url('conges/0/etat')}} ">Demande reffuser</a>

</div>
 @if(session()->has('success'))
 <div class="alert alert-success mx-auto w-75">
 {{session()->get('success')}}
 </div>
 @endif
<table class=" my-3 mx-auto table border w-75">
  <thead class="thead-dark">
    <tr >
     
      <th  class="border" scope="col">DEBUT</th>
      <th  class="border" scope="col">FIN</th>
       <th class="border"  scope="col">DUREE</th>
      <th class="border"  scope="col">ETAT</th>
      <th class="border"  scope="col">ACTION</th>
     </tr>
  </thead>
  <tbody >
  @foreach($conges as $conge)
  @section('nom')
 {{$conge->user->nom}} {{$conge->user->prenom}} 
  @endsection

    <tr  >
 
      <td class="border">{{date('d-m-Y', strtotime($conge->debut))}}</td>
      <td class="border" >{{date('d-m-Y', strtotime($conge->fin))}}</td>
    
      <td class="border" >{{$conge->duree}}</td>
     
      @if($conge->etat==5)<td class="border text-warning">En attend</td>
      @elseif($conge->etat==1)<td class="border text-success">accepter</td>
      @else<td class="border text-danger">reffuser</td>
      @endif
    
    <td>  @if($conge->etat==5) 
    <form action="{{url('conges/'.$conge->id)}}" method="post">
       {{csrf_field() }}
       {{method_field('DELETE') }} 
      <a href="{{url('conges/'.$conge->id.'/edit')}}" class="btn ml-5  btn-outline-success btn-sm">MODIFIER</a>
       <button type="submit"  class="btn btn-outline-danger btn-sm">SUPPRIMER</button>
       </form>
      @elseif($conge->etat==1)
     
      <a href="{{url('conges/'.$conge->id.'/dynamic_pdf/pdf')}}" class="btn ml-5  btn-outline-info btn-sm">IMPRIMER</a>
       
      @else
      @endif</td>
    
     
       
    </tr>
      
   
  
    @endforeach

  </tbody>
</table></div>
@endsection