<?php

namespace App\Http\Controllers;

use App\Model\RadUserGroup;
use Illuminate\Http\Request;
use App\Model\Radcheck;
use APP\Model\Radacct;
use APP\Model\RadReply;
use App\Model\Subscriber;
use App\Model\Profile;

use Illuminate\Support\Str;
use Session;
use Auth;
class ISPUsersController extends Controller
{
  // invoice list App
  public function index()
  {
    $pageConfigs = ['pageHeader' => true];

    return view('ISPUsers.index', ['pageConfigs' => $pageConfigs]);
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

                    $query->where("$key",'=',"$value");


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


    public function add (Request $request){
      $username=$request->username;
      $fullname=$request->fullname;
      $password=$request->password;
      $address=$request->address;
      $phone=$request->phone;
      $email=$request->email;
      $owner=$request->owner;
      $plan=$request->plan;

      $data=new Subscriber();
        $data->username = $username;
        $data->enableuser = 1;
        $data->password = $password;
        $data->user_type = 1;
        $data->owner = $owner;
        $data->fullname = $fullname;
        $data->address = $address;
        $data->email = $email;
        $data->mobile = $phone;
        $data->srvid = $plan;
        $data->expiration = date('Y-m-d H:i:s');
        $data->extended_expiration = date('Y-m-d H:i:s');
        $data->created_by = 1;//Auth::user()->id;
        $data->created_at = date('Y-m-d H:i:s');
        $data->createdon = date('Y-m-d');
        $data->status = 1;
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

}
