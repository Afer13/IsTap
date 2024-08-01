<?php

namespace App\Http\Controllers;

use App\Models\Elanlar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function save_elan($elan_id){
        try{
            $save_elan_id=Auth::user()->save_elan;

            $id_arr=explode(",", $save_elan_id);
            $id_status="";
            foreach($id_arr as $id){
                if($id==$elan_id){
                    $id_status="ok";
                    break;
                }
            }
            if($id_status==""){
                if($id_arr[0]==""){
                    $save_elan_id=$elan_id;
                }
                else{
                     $save_elan_id=$save_elan_id.','.$elan_id;
                }
               
                $user=User::where('id',Auth::user()->id)->first();
                $user->save_elan=$save_elan_id;
                $user->save();
                $status=1;
            }
            $count=0;
            if($id_status=="ok"){
                
                for($i=0;$i<count($id_arr);$i++){
                    if($id_arr[$i]==$elan_id){
                        array_splice($id_arr,$i,1);
                    }
                }
                $id_arr=array_values($id_arr);
        
                $save_elan_id1="";
                $count=count($id_arr);
                $count1=$count-1;
                if($count==0){
                    $save_elan_id1="";
                }
                else{
                    for($i=0;$i<$count;$i++){
                        if($i==$count1){
                            $save_elan_id1.=$id_arr[$i];
                        }else{
                            $save_elan_id1.=$id_arr[$i].',';
                        }
                    }
                }

                $user=User::where('id',Auth::user()->id)->first();
                $user->save_elan=$save_elan_id1;
                $user->save();
                $status=0;
            }

            return response()->json(['Message'=>'Uğurlu','status'=>$status,'id_status'=>$id_status,'count'=>$count],200);
        }
        catch(\Exception $exception){
            return response()->json(['Message'=>'Uğursuz','id_status'=>$id_status],500);
        }
    }
    
    public function save_list(){
        $save_elan_id=Auth::user()->save_elan;
        $id_arr=explode(',',$save_elan_id);
        $id_arr=array_reverse($id_arr);
        $elanlar=Elanlar::where('bitme_tarixi','>',date('Y-m-d H:i:s'))->whereIn('id',$id_arr)->paginate(5);
        return view('elan_save',compact('elanlar'));
    }
}
