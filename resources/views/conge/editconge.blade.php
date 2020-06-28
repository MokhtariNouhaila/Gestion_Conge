@extends('layouts.userMenu')

@section('title', 'modifier')
@section('nom')
 {{$conge->user->nom}} {{$conge->user->prenom}} 
  @endsection

@section('content')


<div  style="width: 90%;" >
<h3 class="mx-5 my-4">

modifier un conge

</h3>


@if(session()->has('fail'))
 <div class="alert alert-danger mx-auto w-75">
 {{session()->get('fail')}}
 </div>
 @endif

<div class="mx-auto"  style="width:60%;" >
<form action="{{url('conges/'.$conge->id)}}" method="post">
<input type="hidden" name="_method" value="PUT">
    {{csrf_field() }}
 <div class="bg-dark  my-5 py-5 px-5 mx-auto">
 <div class="form-row ">
 
  </div>
  <div class="form-row mt-5">
    <div class="form-group col-md-6">
      <label class="text-white" for="debut">Debut</label>
      <input  type="date" class="form-control  " min="{{date('Y-m-d')}}" value="{{date('Y-m-d', strtotime($conge->debut))}}" name="debut" id="debut" >
      @if($errors->get('debut'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('debut') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
    <div class="form-group col-md-6">
      <label  class="text-white" for="fin">Fin</label>
      <input  type="date" class="form-control  " min="{{date('Y-m-d')}}" value="{{date('Y-m-d', strtotime($conge->fin))}}" id="fin" name="fin">
      @if($errors->get('fin'))
<div class="text-danger" >
  <ul>
  @foreach($errors->get('fin') as $message)
  <li>{{$message}}</li>
  @endforeach
  </ul>
</div>
@endif
    </div>
  </div>
 
  <div style="margin-left:60%" class="form-row">
  
     
    <input type="submit" value="Envoyer"  class="btn btn-outline-success  mt-5 px-5" />

   
  </div>

 </div>
 
</form>
</div>
</div>   
@endsection