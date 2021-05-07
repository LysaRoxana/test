<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default session "driver" that will be used on
    | requests. By default, we will use the lightweight native driver but
    | you may specify any of the other wonderful drivers provided here.
    |
    | Supported: "file", "cookie", "database", "apc",
    |            "memcached", "redis", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes that you wish the session
    | to be allowed to remain idle before it expires. If you want them
    | to immediately expire on the browser closing, set that option.
    |
    */

    'lifetime' => env('SESSION_LIFETIME', 120),

    'expire_on_close' => false,

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | This option allows you to easily specify that all of your session data
    | should be encrypted before it is stored. All encryption will be run
    | automatically by Laravel and you can use the Session like normal.
    |
    */

    'encrypt' => false,

    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | When using the native session driver, we need a location where session
    | files may be stored. A default has been set for you but a different
    | location may be specified. This is only needed for file sessions.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    |
    | When using the "database" or "redis" session drivers, you may specify a
    | connection that should be used to manage these sessions. This should
    | correspond to a connection in your database configuration options.
    |
    */

    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    |
    | When using the "database" session driver, you may specify the table we
    | should use to manage the sessions. Of course, a sensible default is
    | provided for you; however, you are free to change this as needed.
    |
    */

    'table' => 'sessions',

    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | When using the "apc" or "memcached" session drivers, you may specify a
    | cache store that should be used for these sessions. This value must
    | correspond with one of the application's configured cache stores.
    |
    */

    'store' => null,

    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    |
    | Some session drivers must manually sweep their storage location to get
    | rid of old sessions from storage. Here are the chances that it will
    | happen on a given request. By default, the odds are 2 out of 100.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Here you may change the name of the cookie used to identify a session
    | instance by ID. The name specified here will get used every time a
    | new session cookie is created by the framework for every driver.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        str_slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    |
    | The session cookie path determines the path for which the cookie will
    | be regarded as available. Typically, this will be the root path of
    | your application but you are free to change this when necessary.
    |
    */

    'path' => '/',

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    |
    | Here you may change the domain of the cookie used to identify a session
    | in your application. This will determine which domains the cookie is
    | available to in your application. A sensible default has been set.
    |
    */

    'domain' => env('SESSION_DOMAIN', null),

    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, session cookies will only be sent back
    | to the server if the browser has a HTTPS connection. This will keep
    | the cookie from being sent to you if it can not be done securely.
    |
    */

    'secure' => env('SESSION_SECURE_COOKIE', false),

    /*
    |--------------------------------------------------------------------------
    | HTTP Access Only
    |--------------------------------------------------------------------------
    |
    | Setting this value to true will prevent JavaScript from accessing the
    | value of the cookie and the cookie will only be accessible through
    | the HTTP protocol. You are free to modify this option if needed.
    |
    */

    'http_only' => true,

    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    |
    | This option determines how your cookies behave when cross-site requests
    | take place, and can be used to mitigate CSRF attacks. By default, we
    | do not enable this as other CSRF protection services are in place.
    |
    | Supported: "lax", "strict"
    |
    */

    'same_site' => null,

];
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Marque;
use App\Modele;
use App\Plaque;
use App\Carburant;
use App\Usage;
use App\User;
use App\Vehicule;
use App\Proprietaire;
use App\Periode;
use App\Type_vehicule;
use App\Maison;
class MainController extends Controller
{


public function index(){
// $rose=DB::select('SELECT * FROM vehicules');
// $prod=ProductCat::all();
$marque = DB::table('marques')->orderBy('marque')->pluck("marque","mid");
$puissance = DB::table('puissances')->pluck("puissance","puissance_id");
$categorie = DB::table('plaques')->pluck("categorie","pid");
$carburant = DB::table('carburants')->pluck("type_carburant","carid");
$usage = DB::table('usages')->pluck("usage","usid");
$user = DB::select('select * from users');
return view('rose', [

'marque'=>$marque,
'puissance'=>$puissance,
'categorie'=>$categorie,
'carburant'=>$carburant,
'usage'=>$usage,
'user'=>$user ]);
}

public function save_vehicule(Request $request){

$auto = new Vehicule();
//return $image=$request->file('image');exit;
//echo $image->getClientOriginalExtension();exit;
$auto->num_carte_rose = $request->input('num_carte_rose');
$auto->num_immatriculation = $request->input('num_immatriculation');
$auto->marque = $request->input('marque');
$auto->modele = $request->input('modele');
$auto->num_chassis = $request->input('num_chassis');
$auto->num_moteur = $request->input('num_moteur');
$auto->annee_fabrication = $request->input('annee_fabrication');
$auto->puissance = $request->input('puissance');
$auto->categorie_plaque = $request->input('categorie_plaque');
$auto->poids_net = $request->input('poids_net');
$auto->classification_vehicule = $request->input('classification_vehicule');
$auto->type_carro = $request->input('type_carro');
$auto->couleur = $request->input('couleur');
$auto->carburant = $request->input('carburant');
$auto->nombre_place = $request->input('nombre_place');
$auto->usage = $request->input('usage');
$auto->taxe_dmc = $request->input('taxe_dmc');
$auto->date_of_issue = $request->input('date_of_issue');
$auto->proprietaire = $request->input('proprietaire');


if($request->hasfile('image')){

$file = $request->file('image');
$extension = $file->getClientOriginalExtension();
$filename = time() . '.' . $extension;
$file->move('uploads/rose/', $filename);
$auto->image = $filename;

} else {
return $request;
$auto->image = "";
}

$auto->save();

return redirect()->route('autolist')->with('auto',$auto);

}

public function marque(){

// $prod=ProductCat::all();
$marque = DB::table('marques')->orderBy('marque')->pluck("marque","mid");
$puissance = DB::table('puissances')->pluck("puissance","puissance_id");
$categorie = DB::table('plaques')->pluck("categorie","pid");
$carburant = DB::table('carburants')->pluck("type_carburant","carid");
$usage = DB::table('usages')->pluck("usage","usid");
$user = DB::select('select * from users');
return view('assureurbicor.addvehicule', [
'marque'=>$marque,
'puissance'=>$puissance,
'categorie'=>$categorie,
'carburant'=>$carburant,
'usage'=>$usage,
'user'=>$user ]);
}
public function marq(){

// $prod=ProductCat::all();
$marque = DB::table('marques')->orderBy('marque')->pluck("marque","mid");
$puissance = DB::table('puissances')->pluck("puissance","puissance_id");
$categorie = DB::table('plaques')->pluck("categorie","pid");
$carburant = DB::table('carburants')->pluck("type_carburant","carid");
$usage = DB::table('usages')->pluck("usage","usid");
$user = DB::select('select * from users');
return view('client.ajout_vehicules', [
'marque'=>$marque,
'puissance'=>$puissance,
'categorie'=>$categorie,
'carburant'=>$carburant,
'usage'=>$usage,
'user'=>$user ]);
}

public function getModeles($id)
{
$modele = DB::table("modeles")->where("marque_id",$id)->pluck("modele","modid");
return json_encode($modele);
}

public function save_car (Request $request) {
$rose= new Vehicule();
$rose->num_carte_rose = $request->input('num_carte_rose');
$rose->num_immatriculation = $request->input('num_immatriculation');
$rose->marque = $request->input('marque');
$rose->modele = $request->input('modele');
$rose->num_chassis = $request->input('num_chassis');
$rose->num_moteur = $request->input('num_moteur');
$rose->annee_fabrication = $request->input('annee_fabrication');
$rose->puissance = $request->input('puissance');
$rose->categorie_plaque = $request->input('categorie_plaque');
$rose->poids_net = $request->input('poids_net');
$rose->classification_vehicule = $request->input('classification_vehicule');
$rose->type_carro = $request->input('type_carro');
$rose->couleur = $request->input('couleur');
$rose->carburant = $request->input('carburant');
$rose->nombre_place = $request->input('nombre_place');
$rose->usage = $request->input('usage');
$rose->taxe_dmc = $request->input('taxe_dmc');
$rose->date_of_issue = $request->input('date_of_issue');
$rose->proprietaire = $request->input('proprietaire');

if($request->hasfile('image')){

$file = $request->file('image');
$extension = $file->getClientOriginalExtension();
$filename = time() . '.' . $extension;
$file->move('uploads/rose/', $filename);
$rose->image = $filename;

} else {
return $request;
$rose->image = "";
}

$rose->save();

// $info = new Proprietaire();
// $info->proprietaire = $request->input('proprietaire');
// $info->nif = $request->input('nif');
// $info->cni = $request->input('cni');
// $info->province = $request->input('province');
// $info->categorie_proprietaire = $request->input('categorie_proprietaire');
// $info->save();

return redirect()->route('assureurs/vehicules');


}

public function save_auto(Request $request){

$auto= new Vehicule();

$auto->puissance = request('puissance');
$auto->nombre_place = request('nombre_place');
$auto->usage = request('usage');

$auto->save();

return view('client.home');
}

public function select_devis(){
$maison=Maison::all();
$typo=Type_vehicule::all();
$perio=Periode::all();
$usage =DB::select('SELECT * FROM usages');
$p=DB::select('SELECT * FROM puissances');
$type=DB::select('SELECT * from types');
$periode=DB::select('SELECT * from periodes');
return view('client.home',[
'maison'=>$maison,
'perio'=>$perio,
'typo'=>$typo,
'usage'=>$usage,
'p'=>$p,
'type'=>$type,
'periode'=>$periode,
]);
}

public function go(Request $request){




$puissance=$request->input('puissance_id');
$place=$request->input('nombre_place');
$usage=$request->input('usage_id');
$type=$request->input('type_id');
$periode=$request->input('periode_id');
$assurance=$request->input('assurance_id');
$valeur_du_vehicule=$request->input('valeur_id');


// $place_s=$request->input('place');
// $ta=DB::select('SELECT * FROM tarif_rcs WHERE nombre_place="'.$place.'"');

// $rep=$ta[0]->prime_base;
// if ($place_s!="") {
// if($rep!=null){
// $response = "error";
// }
// else if($rep==null){
// $response = "success";
// }
// return $response;
// }


if(($usage==1) && ($type==1)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');


if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=3000*$place;
$pn=$rc+$iov;

$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$iov=3000*$place;
$pn=$rc+$iov;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=3000*$place;
$pn=$rc+$iov;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
}

else if(($usage==1) && ($type==3)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');

$t=$tarif[0]->prime_base;
if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=3000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=3000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=3000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}

}

else if(($usage==1) && ($type==4)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');


if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=3000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=3000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=3000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}


}

else if(($usage==1) && ($type==5)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=3000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=3000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=3000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==2) && ($type==1)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE nombre_place="'.$place.'" and usage_rc="2"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==2) && ($type==3)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE nombre_place="'.$place.'" and usage_rc="2"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==2) && ($type==4)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE nombre_place="'.$place.'" and usage_rc="2"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==2) && ($type==5)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE nombre_place="'.$place.'" and usage_rc="2"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==3) && ($type==1)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="3"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$pn=$rc;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==3) && ($type==3)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="3"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==3) && ($type==4)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="3"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==3) && ($type==5)){
$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="3"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

else if(($usage==4) && ($type==1)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');


if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=2000*$place;
$pn=$rc+$iov;

$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
else if($periode==2){

$rc=($tarif[0]->prime_base)/2;
$iov=2000*$place;
$pn=$rc+$iov;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=2000*$place;
$pn=$rc+$iov;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}
}

else if(($usage==4) && ($type==3)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');


if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=2000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=2000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=2000*$place;
$dm=($valeur_du_vehicule*5)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}

}

else if(($usage==4) && ($type==4)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');


if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=2000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=2000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=2000*$place;
$dm=($valeur_du_vehicule*2)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}


}

else if(($usage==4) && ($type==5)){

$tarif=DB::select('SELECT * FROM tarif_rcs WHERE puissance="'.$puissance.'" and usage_rc="1"');

if($periode==3){
$rc=$tarif[0]->prime_base;
$iov=2000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==2){
$rc=($tarif[0]->prime_base)/2;
$iov=2000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;

}
else if($periode==1){

$rc=($tarif[0]->prime_base)/4;
$iov=2000*$place;
$dm=(($valeur_du_vehicule*5)/10)/100;
$pn=$rc+$iov+$dm;
$fa=(($pn*10)/100)+1000;
$tva=(($pn+$fa)*18)/100;
$pt=$tva+$fa+$pn;
}

}

$typo=Type_vehicule::all();
$perio=Periode::all();






return $pt;

//return view ('auth.login',['pui'=>$puissance,'price'=>$pt,'place'=>$place,'usage'=>$usage,'perio'=>$perio,'typo'=>$typo]);

//return view('auth.login',['price'=>$pt]);


}

public function a(Request $request){

$puissance=request('puissance');
$place=request('nombre_place');
$usage=request('usage');
$type=request('type');
$assurance=request('assurance');
$periode=request('periode');
$valeur_du_vehicule=request('valeur_du_vehicule');
$request->session()->put('puissance', $puissance);
$request->session()->put('place', $place);
$request->session()->put('usage', $usage);
$request->session()->put('type', $type);
$request->session()->put('periode', $periode);
$request->session()->put('valeur', $valeur_du_vehicule);

return view('auth.login');

}


}