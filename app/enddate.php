public function confirmcommande(Request $data){
  
        $status = $data->input()['status'];
        $amount = $data->input()['amount'];
        $currency = $data->input()['currency'];
        $client_token_encode= $data->input()['client_token'];
        $client_token = base64_decode($client_token_encode);
        $client_token_expl = explode("_",$client_token);
        if($status == "success"){
              $assurer = DB::table('vehicules')->where('id',16)->update(['status'=>$status_order, 'start_date'=>Carbon::now() ,'end_date' =>Carbon::now()->addMinutes(2)]); 
             $assurer = DB::table('vehicules')->where('id',16)->update(['status'=>1, 'start_date'=>Carbon::now()->addHours(2) ,'end_date' =>Carbon::now()->addHours(2)->addMinutes(1)]); 
         }
            
        
        if($status == "success"){
               $status_order = "1";
               $update = DB::update('update commandes set status = ? where id = ?',[$status_order,$client_token_expl[2]]);
               if($update){
                   file_put_contents(__DIR__.'/assurancelogs.txt',$data->input(), FILE_APPEND);
           
             
               }
             
         }elseif($status == "error"){
               $status_order = "1";
               $periode = $client_token_expl[3];
               $update = DB::update('update commandes set status = ? where id = ?',[$status_order,$client_token_expl[2]]);

             if($periode == "3 mois"){

               $assurer = DB::table('vehicules')->where('id', $client_token_expl[4])->update(['status'=>$status_order, 'start_date'=>Carbon::now() ,'end_date' =>Carbon::now()->addMonths(3)]);   

             }
             elseif ($periode == "6 mois") {

               $assurer = DB::table('vehicules')->where('id', $client_token_expl[4])->update(['status'=>$status_order, 'start_date'=>Carbon::now() ,'end_date' =>Carbon::now()->addMonths(6)]); 
             }
             else {

               $assurer = DB::table('vehicules')->where('id', $client_token_expl[4])->update(['status'=>$status_order, 'start_date'=>Carbon::now() ,'end_date' =>Carbon::now()->addMonths(12)]); 
             }

               if($update && $assurer){
           file_put_contents(__DIR__.'/assurancelogs.txt',"erreur", FILE_APPEND);

         }
       }
             

}