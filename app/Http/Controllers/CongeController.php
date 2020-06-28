<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Conge;
use App\Http\Requests\congeRequest;


class CongeController extends Controller
{
  /*  public function __construct()
    {
        $this->middleware('auth');
    }*/
    function leap_year($year)
    {
        return date("L", mktime(0, 0, 0, 1, 1, $year));
    }

    function nb_jours( $date1, $date2 )
    {

    $timestamp1    = strtotime($date1);
    $timestamp2    = strtotime($date2);
    
    $tot = 0; // total de jours entre les 2 dates

    // dates en jours de l'année ( depuis le 1er jan )
    $date1 = date("z", $timestamp1) ; // date de depart
    $date2 = date("z", $timestamp2) ; //date d'arrivée
    
    $day_stamp = 86400 ; //(3600 * 24 ); // un journée en timestamp

    // années des deux dates
    $year1 = date("Y", $timestamp1) ;
    $year2 = date("Y", $timestamp2) ;

    $num = 0; // nombre de jours feries a compter sur la duree totale
    $counter = 0; // la durée entre deux date par année
    
    $year = $year1; // l'année en cours ( defaut : $year1 )
    
    
// on calcule le nombre de jours de différence entre les deux dates, en tenant
// compte des années
    while ( $year <= $year2 )
    {
        $date3         = date("d-n-Y", mktime(0, 0, 0, 1,  1,  $year));
        $timestamp3 = strtotime($date3); 
// date de référence pour l'année en cours
        $counter = 0; // compteur de jours pour chaque année
        
        //on récupère la date de pâques   
        $easterDate   = easter_date($year) ;
        $easterDay    = date('j', $easterDate) ;
        $easterMonth  = date('n', $easterDate) ;
        $easterYear   = date('Y', $easterDate) ;
    
        
        
// le tableau sort les jours fériés de l'année depuis le premier janvier
        $closed = array
        (
            // dates fixes
            date("z", mktime(0, 0, 0, 1,  1,  $year)),  // 1er janvier
            date("z", mktime(0, 0, 0, 1,  11,  $year)),  // Manifeste de l’Indépendance
            date("z", mktime(0, 0, 0, 5,  1,  $year)),  // Fête du travail
            date("z", mktime(0, 0, 0, 7,  30, $year)),  // Fête du Trône
            date("z", mktime(0, 0, 0, 8,  14, $year)),  // Journée de Oued Ed-Dahab 
            date("z", mktime(0, 0, 0, 8, 20,  $year)),  // La révolution du Roi et du peuple
            date("z", mktime(0, 0, 0, 8, 21, $year)),  // Fête de la Jeunesse 
            date("z", mktime(0, 0, 0, 11, 6, $year)),//Marche verte 

            date("z", mktime(0, 0, 0, 11, 18, $year)),   // Fête de l’indépendance 

            // Dates basées sur Paques
            date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear)

),  // Lundi de Paques
            date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear

)), // Ascension
            date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear

))  // Lundi de Pentecote
            
        );
        
        // si c'est la première année -> on commence par la date de depart; 
        // le compteur compte les jours jusqu'au 31dec
        if( $year == $year1 && $year < $year2 )
        { 
            $i = $date1; 
            $counter +=  (364+leap_year($year)) ; 
        }

        
// si c'est ni la première ni la dernière année -> on commence au premier
// janvier; 
        //le compteur compte tous les jours de l'année
        if( $year > $year1 && $year < $year2 )
        {
            $i = date("z", mktime(0, 0, 0, 1,  1,  $year));  
            $counter += 364+leap_year($year); 
        }

        // si c'est la dernière année -> on commence au premier janvier; 
        // le compteur va jusqu'a la date d'arrivée
        if( $year == $year2 && $year > $year1 )
        { 
            $i = date("z", mktime(0, 0, 0, 1,  1,  $year)); 
            $counter += $date2 ; 
        }
        
        // si les deux dates sont dans la même année
        if( $year == $year1 && $year == $year2 )
        { 
            $i = $date1; 
            $counter += $date2 ; 
        }
        
        // on boucle les jours sur la période donnée
        while ( $i <= $counter )
        {
            $tot = $tot +1; // on ajoute 1 pour chaque jour passé en revue

            if( in_array($i, $closed) ) 
            {
                $num++; // on ajoute 1 pour chaque jour férié rencontré
            }
            
            // on compte chaque samedi et chaque dimanche
            if(((date("w", $timestamp3 + $i * $day_stamp) == 6) or (date("w", 
$timestamp3 + $i * $day_stamp) == 0)) and !in_array($i, $closed)) 
            {
                $num++ ;
            }
            $i++;
        }
        $year++ ; // on incremente l'année
    }
    $res = $tot - $num; 
    // nombre de jours entre les 2 dates fournies - nombre de jours non ouvrés
    return $res;
    }
    //affichage
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
         if(Auth::user()->is_admin){
        $conge=Conge::all();
        return view('conge.demande',['conges'=>$conge]);
    }
    else{
         $listconge=Conge::where('user_id',Auth::user()->id)->get();
        return view('conge.demandeuser',['conges'=>$listconge]);

    }
       
       

        
    }
     
    //affiche form de creation
    public function create()
    {
        if(Auth::user()->is_admin){
        return view('conge.ajoutEmp');
    }
    else{

    } return view('conge.create',['user'=>Auth::user()]);
    }
    //enregistrer
    public function store(congeRequest $request)
    {
      $conge=new Conge();
      $conge->debut=$request->input('debut');
      $conge->fin=$request->input('fin');
      $conge->user_id=Auth::user()->id;
      $i=$this->nb_jours($request->input('debut'),$request->input('fin'))-1;
      if($i>0){
        echo "<script>alert(\"votre conge est d'une duree de \"+$i+\" jours\")</script>";
        $conge->duree=$this->nb_jours($request->input('debut'),$request->input('fin'))-1;
        

        $conge->save();
        session()->flash('success','votre conge à été bien enregistré!!');
                return redirect('conges');

      }
      else{
        session()->flash('fail','votre conge n\'a pas enregistré!!');
        return redirect('conges/create');

      }
   

    }
    //reccup conge pour modifier
    public function edit($id)
    {
        
        $conge=Conge::find($id);
        $this->authorize('update',$conge);
        return view ('conge.editconge',['conge'=>$conge]);

    }
    //modifier
    public function update(congeRequest $request,$id)
    {
        $conge=Conge::find($id);
        $conge->debut=$request->input('debut');
        $conge->fin=$request->input('fin');
        $i=$this->nb_jours($request->input('debut'),$request->input('fin'))-1;
      if($i>0){
        echo "<script>alert(\"votre conge est d'une duree de \"+$i+\" jours\")</script>";
        $conge->duree=$i;
        

        $conge->save();
        session()->flash('success','votre conge à été bien modifié!!');
        
                return redirect('conges');

      }
      else{
          session()->flash('fail','votre conge n\'a pas modifié!!');
        return view ('conge.editconge',['conge'=>$conge]);

      }
        
    }
    //supp
    public function destroy(Request $request,$id)
    {
        $conge=Conge::find($id);
        $conge->delete();
        session()->flash('success','votre conge à été bien supprime!!');
        return redirect('conges');
    }
   /** */
  
   /** 
    * 
    */
    public function valider($id)
    {
        $conge=Conge::find($id);
        $conge->etat=1;
        $user=User::find( $conge->user_id);
       $resultat=$user->duree-$conge->duree;
       
        if($resultat>=0){
            $user->duree= $resultat;
        }
        else {
            $user->duree=0;

            $user->credit+=$resultat;
        }
   
        $user->save();
        $conge->save();
        return redirect('conges');
    }
        public function rejeter($id)
    {
        $conge=Conge::find($id);
      
        if($conge->etat==1){
            $user=User::find( $conge->user_id);
            if($user->credit==0)
            {
                $user->duree+=$conge->duree;
                $conge->etat=0;
                $conge->save();
                $user->save();
                return redirect('conges');
            }
            else if($user->credit!=0)
            {$resultat=$user->credit+$conge->duree;
                if($resultat<0)
                {
                    $user->credit=$resultat;
                    $user->duree=0;
                }
               else if($resultat>0)
                {
                    $user->credit=0;
                    $user->duree=$resultat;
                }
                else if($resultat==0)
                {
                    $user->credit=0;
                    $user->duree=0;
                }
                $conge->etat=0;
                $conge->save();
                $user->save();
                return redirect('conges');
            }
           
        }
      
        else if( $conge->etat!=1) {
            $conge->etat=0;
            $conge->save();
            return redirect('conges');
        }
      
    }

/** 
 * 
 */
    public function etat($etat)
    {//valider
       if($etat==1){
        if(Auth::user()->is_admin){

            $listconge=Conge::where('etat',1)->get();
           return view('conge.demande',['conges'=>$listconge]);
       }
       else{
   
           $listconge = Conge::where('user_id', Auth::user()->id)
           ->where('etat', 1)
           ->get();
                       return view('conge.demandeUser',['conges'=>$listconge]);
       } 
       }
       //reffuser
       else if($etat==0){

        if(Auth::user()->is_admin){

            $listconge=Conge::where('etat',0)->get();
           return view('conge.demande',['conges'=>$listconge]);
       }
       else{
   
           $listconge = Conge::where('user_id', Auth::user()->id)
           ->where('etat', 0)
           ->get();
                       return view('conge.demandeUser',['conges'=>$listconge]);
       } 
       }
         //attend
       else{
        if(Auth::user()->is_admin){

            $listconge=Conge::where('etat',5)->get();
           return view('conge.demande',['conges'=>$listconge]);
       }
       else{
   
           $listconge = Conge::where('user_id', Auth::user()->id)
           ->where('etat', 5)
           ->get();
                       return view('conge.demandeUser',['conges'=>$listconge]);
       } 
       }
    }
    /**
     * 
     */
 
   /**
    * 
    */
}
