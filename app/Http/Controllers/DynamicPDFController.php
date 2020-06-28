<?php

namespace App\Http\Controllers;
use App\Conge;

use Illuminate\Http\Request;

class DynamicPDFController extends Controller
{
   function index($id)
       {
        $conge=Conge::find($id);
   
         $output=   
           '<h1 style="margin-left:35%;margin-bottom:100px;">Demande de Conge : </h1>'.
         '<p> DEMANDE ID : '.$conge->id.'</p>'.
          '<p> ID EMPLOYE: '.$conge->user_id.'</p>'.
          '<p> EMPLOYE : '.$conge->user->nom.' '.$conge->user->prenom.'</p>'.
          '
          <table style="width:100%">
            <tr>
              <th style="border: 1px solid;">DEBUT</th>
              <th style="border: 1px solid;">FIN</th> 
              <th style="border: 1px solid;">DUREE</th>
            </tr>
            <tr>
              <td style="border: 1px solid;">'.date('d-m-Y', strtotime($conge->debut)).'</td>
              <td style="border: 1px solid;">'.date('d-m-Y', strtotime($conge->fin)).'</td>
              <td style="border: 1px solid;">'.$conge->duree.'</td>
            </tr>
          </table>'
          ;
        return $output;
       }

    function pdf($id) {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->index($id));
        return $pdf->stream();
       }
   
      
   
}
