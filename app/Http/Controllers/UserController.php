<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\User;
use App\Conge;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //affichage
    public function index()
    {
        //$listuser=User::all();
        $listuser = User::where('is_admin', '!=', 1)->get();
        return view('conge.emp',['s'=>$listuser]);

    }
    //affiche form de creation
    public function create()
    {
        return view('conge.ajoutEmp');

    }
    //enregistrer
    public function store(userRequest $request)
    {
      $user=new User();
      $user->nom=$request->input('nom');
      $user->prenom=$request->input('prenom');
      $user->email=$request->input('email');
      $user->password=Hash::make($request->input('password'));
      $user->duree=$request->input('duree');
      $user->autorise=$request->input('duree');
     
        $user->save();
        session()->flash('success','l\'employe à été bien enregistré!!');
        return redirect('users');

    }
    //reccup conge pour modifier
    public function edit($id)
    {
        $user=User::find($id);
        return view ('conge.edit',['user'=>$user]);

    }
    //modifier
    public function update(userRequest $request,$id)
    {
        $user=User::find($id);
        $user->nom=$request->input('nom');
        $user->prenom=$request->input('prenom');
        $user->email=$request->input('email');
        $user->password=$user->password;
        $i=$request->input('duree')-$user->autorise;
        $user->autorise=$request->input('duree');
   
if($i<0)
{
 if($user->credit!=0){$user->credit=$user->credit+$i;} 
 else if($user->credit==0)
   {
    if($user->duree==(-$i)){$user->duree=0;}
    else if($user->duree<(-$i)){$user->credit=$user->duree+$i;$user->duree=0;}
    else if($user->duree>(-$i)){$user->duree=$user->duree+$i;}
   }
}
elseif($i>0)
{
  if($user->credit==0){$user->duree=$user->duree+$i;} 
  else if($user->credit!=0){
  if($user->credit==(-$i)){$user->credit=0;}
  else if($user->credit>(-$i)){$user->duree=$user->credit+$i;$user->credit=0;}
  else if($user->credit<(-$i)){$user->credit=$user->credit+$i;}
}
}
        $user->save();
        session()->flash('success','l\'employe à été bien modifié!!');
        return redirect('users');

    }
    //supp
    public function destroy(Request $request,$id)
    {
        $user=User::find($id);
        $user->delete();
        session()->flash('success','l\'employe à été bien supprime!!');
        return redirect('users');
    }
    
    /* */
    public function show()
    {
        $user=User::find(Auth::user()->id);
        return view ('conge.profil',['user'=>$user]);
    }
    public function generer()
    {$users = User::all();
foreach($users as $user){

      if($user->credit==0){
        $user->duree+=$user->autorise;
    }
    else{
      if(-($user->credit)<=$user->autorise){
        $user->duree= $user->credit+$user->autorise;

          $user->credit=0;
    }
    else  if(-($user->credit)>$user->autorise){
        $user->credit= $user->credit+$user->autorise;
    }
    }
 
    $user->save();
 
}
       return redirect('users');
    }
    public function countUser()
    {
        $user=User::where('is_admin', '!=', 1)->count();
        $conge=Conge::count();
        $congeV=Conge::where('etat', '=', '1')->count();
        $congeR=Conge::where('etat', '=', '0')->count();
        $congeA=Conge::where('etat', '=', '5')->count();
        $congeAnnee= DB::table('conges')->select(DB::raw('count(id) as total'),
        DB::raw('YEAR(debut) year, MONTH(debut) month'))->where('etat', '=', '1')->groupby('year','month')
        ->get()  ;  
        $dt = Carbon::now();
$countconge= DB::table('conges')->whereRaw('"'.$dt.'" between debut and fin')
->where('etat', '=', '1')->distinct('user_id')->count();
        
        $info=array('0'=>$user,
                    '1'=>$conge,
                    '2'=>$congeV,
                    '3'=>$congeR,
                    '4'=>$congeA,
                    '5'=>$countconge,
                    );
        return view ('conge.dashboard',compact('info','congeAnnee'));
    }
 
   
}
