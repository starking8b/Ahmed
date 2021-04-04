<?php

namespace App\Http\Controllers;

use App\Models\RadUserGroup;
use Illuminate\Http\Request;
use App\Models\Radcheck;
use App\Models\Radacct;
use App\Models\RadReply;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\Profile;

use Illuminate\Support\Str;
use Session;
use Auth;
class ISPUsersController extends Controller
{
  // invoice list App
  public function index()
  {
    $pageConfigs = ['pageHeader' => true];
    $users=User::get();

    return view('ISPUsers.index', ['pageConfigs' => $pageConfigs], compact('users'));
  }

    public function reSearch(Request $request) {
        $fileds=$request->_logfields;
        $filters=$request->_filters;
        $paging=(int) $request->_paging;

        $pagenumber=(int) $request->_pagenumber;




        $array=array();
        $pagenumber=$pagenumber-1;
        $offset=$paging *$pagenumber;
        $query=Subscriber::query();



        $query->with('owners')->select($fileds);


        $filters= json_decode($filters, true);

        foreach($filters as $key=>$value){

            $value=str_replace(" ","",$value);
            if(!Str::contains($value,'undefined') && !empty($value)&&!Str::contains($key,'undefined') ){
                       if($key=='owner') {

                           $query->whereHas('owners', function ($q) use($value){
                               return $q->where('name', '=', "$value");
                           });
                       }
                       else{$query->where("$key",'=',"$value");}



            }


        }

          $count =  $query-> offset($offset)->limit( $paging)->get()->count();

        if($count>0)
        {
            $datas =  $query-> limit( $paging)->orderBy('id', 'DESC')->get()->toArray();
            $col=array();
            $strin="";
            for($i=0;$i<count($fileds);$i++){

                $headname=$fileds[$i];
                $col[$i]['headName'][]=$fileds[$i];
                for($j=0;$j<count($datas);$j++){
                        if($headname=='owner')
                            $col[$i]['headVal'][]=$datas[$j]['owners']['name'];
                        else
                    $col[$i]['headVal'][]=$datas[$j][$headname];
                   }
            }
        }
        else {
            $col=[];

            echo  "ss";

             }

         echo json_encode( $col);
    }
    public function getPageCount(Request $request)
    {$filters=$request->_filters;
        $fileds=$request->_logfields;
        $_paging=(int)$request->_paging;
        $deviceId=(int)$request->device;
        $_logfields= ["id", "username","Password",'groupname', "created_at"];
        $query=Subscriber::query();
        $query->select($fileds);

        $filters= json_decode($filters, true);

        foreach($filters as $key=>$value){
            if(!Str::contains($value,'undefined') && !empty($value)&&!Str::contains($key,'undefined') ){

                $query->where("$key",'=',"$value");

            }

        }

        $data=$query->count();
        $pagenumber=ceil($data/$_paging	);
        return json_encode(["PagingCount"=>$pagenumber]);
    }

    public  function addview(){
        $pageConfigs = ['pageHeader' => true];
        $users=User::get();

        return view('ISPUsers.add', ['pageConfigs' => $pageConfigs], compact('users'));

    }


    public function add (Request $request){
      $username=$request->username;
      $fullname=$request->full_name;
      $password=$request->password;
      $address=$request->address;
      $phone=$request->phone;
      $email=$request->email;
      $owner=$request->owner;
      $plan=$request->plan;
      $country=$request->country;
      $city=$request->city;
      $address=$request->address;
      $pincode=$request->pincode;
      $addressswitch=$request->addressswitch;
      $countrybill=$request->countrybill;
      $addressbill=$request->addressbill;
      $pincodebill=$request->pincodebill;
      $citybill=$request->citybill;
      $owner=$request->owner;
      $area=$request->area;
      $street=$request->street;
      $building=$request->building;
      $latitude=$request->latitude;
      $longitude=$request->longitude;
      $ipswitch=$request->ipswitch;
      $ipaddress=$request->ipaddress;
      $mac=$request->mac;
      $notification=$request->notification;
      $comment=$request->comment;
      if(isset($ipaddress))

      $data=new Subscriber();
        $data->username = $username;
        $data->enableuser = 1;
        $data->password = $password;
        $data->user_type = 1;

        if(isset($ipaddress))
            $data->ip=$ipaddress;
        if(isset($mac))
            $data->mac=$mac;
        if(isset($addressbill))
            $data->addressbill=$addressbill;
        else
            $data->addressbill=$address;
        if(isset($countrybill))
            $data->countrybill=$countrybill;
        else
            $data->countrybill=$country;
        if(isset($citybill))
            $data->citybill=$citybill;
        else
            $data->citybill=$city;

        if(isset($pincodebill))
            $data->pincodebill=$pincodebill;
        else
            $data->pincodebill=$pincode;



        $data->owner = $owner;
        $data->fullname = $fullname;
        $data->address = $address;
        $data->email = $email;
        $data->mobile = $phone;
        $data->srvid = $plan;
        $data->expiration = date('Y-m-d H:i:s');
        $data->extended_expiration = date('Y-m-d H:i:s');
        $data->created_by =  Auth::user()->id;
        $data->created_at = date('Y-m-d H:i:s');
        $data->createdon = date('Y-m-d');
        $data->status = 1;
        $data->longitude = $longitude;
        $data->latitude=$latitude;
        $data->building=$building;
        $data->street=$street;
        $data->area=$area;

        $result=$data->save();
        if($result){
            $radPassword = new RadCheck;
            $radPassword->username = $request->username;
            $radPassword->attribute = 'Cleartext-Password';
            $radPassword->op = ':=';
            $radPassword->value = $request->password;
            $radPassword->save();

        $profileName = Profile::where('id', '=', $plan)->firstOrFail();
        $radUserGroup = new RadUserGroup;
        $radUserGroup->username = $request->username;
        $radUserGroup->groupname = $profileName['srvname'];
        $radUserGroup->priority = 1;
        $radUserGroup->save();
        echo json_encode(['success'=>'true','msg'=>'User has been  added Successfully']);
        }
        else{
            echo json_encode(['success'=>'false','msg'=>'Error! Please Try again Later']);
        }
  }
  public function uploadIdImage(Request $request){
          $type=$request->type;
          $file = $request->file('file');
          $filename = $type.time().'.'.$file->extension();
          $location = storage_path().'/upload/ISPUsers/'  ;
          $file->move($location, $filename);
          $path= '/upload/ISPUsers/'.$filename;
          Session::put($type.'_Image', $path);

          return response()->json(['success'=>$filename]);


  }

}
