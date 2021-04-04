<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Thana;
use App\Models\State;
use App\Models\NAS;
use App\Models\RadUserGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;
use Validator;

use Session;
use Auth;
class NASController extends Controller
{
  // invoice list App
  public function index()
  {

 $devices=NAS::get();

    $pageConfigs = ['pageHeader' => true];


    return view('Locations.index', ['pageConfigs' => $pageConfigs],  compact('stateShow','thanaShow','areaShow','cityShow'));
  }




}
