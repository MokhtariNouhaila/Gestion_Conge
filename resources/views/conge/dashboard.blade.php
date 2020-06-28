
@extends('layouts.headerMenu')
@section('title', 'dashboard')
 
@section('content')
<style>
.cor{
   width: 90%; float:right; background-color:#dddddd;;min-height: 100vh;
}
.wid{
   width:17%;
}
.can{
   width:46%;height: 300px;
}
</style>

 
<div  class="cor">
 
<a   href="{{ url('/users') }}"  class="wid btn text-white btn-secondary ml-5 mr-2 my-5 ">
  Employees <span class="badge badge-light">{{$info[0]}}</span>
</a>
<a  href="{{ url('conges') }}"  class="wid btn text-white btn-success mx-2 my-5 ">
  Demandes <span class="badge badge-light">{{$info[1]}}</span>
</a>
<a  href="{{url('conges/1/etat')}}"  class="wid btn text-white btn-info mx-2 my-5 ">
  Demandes valider <span class="badge badge-light">{{$info[2]}}</span>
</a>
<a    href="{{url('conges/0/etat')}}" class="wid btn text-white btn-danger mx-2 my-5 ">
  Demandes reffuser <span class="badge badge-light">{{$info[3]}}</span>
</a>
<a   href="{{url('conges/5/etat')}}"  class="wid text-white btn btn-warning mx-2 my-5 ">
  Demandes en attend <span class="badge badge-light">{{$info[4]}}</span>
</a>
<div   class="mx-5" style="width:70%" >
<div style="float:right">

<span class="mx-5 text-info" href="">nombre des employés en travail : {{$info[0]-$info[5]}}</span>
  </div>
 
<div >
<span class="mx-5 text-info" href="">nombre des employés en conge : {{$info[5]}}</span>

</div>
 
</div>

 
<table style="display:none" id = "datatable">
         
         <tbody >
            <thead>
            <tr>
               <th></th>
               <th>les demandes</th>
                 
            </tr>
         </thead>
         @foreach ($congeAnnee as $node)
          <tr>
               <th>{{ $node->month }}</th>
               <td> {{  $node->total }}</td>
              </tr>
            
     
      @endforeach
          
            
         </tbody>
      </table>
<div id="piechart_3d" class="my-5 mr-5 can"style="float:right;"></div>
 <div id = "container" class="my-5 ml-5 can " ></div>
 </div>  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['accepter', {{$info[2]}}],
          ['reffuser', {{$info[3]}}],
          ['en attend', {{$info[4]}}]
        ]);

        var options = {
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
   
   
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      <script src = "https://code.highcharts.com/highcharts.js"></script> 
      <script src = "https://code.highcharts.com/modules/data.js"></script>
      <script language = "JavaScript">
         $(document).ready(function() {
            var data = {
               table: 'datatable'
            };
            var chart = {
               type: 'column'
            };
            
            var yAxis = {
               allowDecimals: false,
               title: {
                  text: 'employeees'
               }
            };
            var tooltip = {
               formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                     this.point.y + ' ' + this.point.name.toLowerCase();
               }
            };
            var credits = {
               enabled: false
               
            };  
            var json = {};   
            json.chart = chart; 
            json.title = ""; 
            json.data = data;
            json.yAxis = yAxis;
            json.credits = credits;  
            json.tooltip = tooltip;  
            $('#container').highcharts(json);
         });
      </script>
      
   

  
@endsection 
 