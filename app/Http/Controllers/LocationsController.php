<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Thana;
use App\Models\State;
use App\Models\RadUserGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Str;
use Validator;

use Session;
use Auth;
class LocationsController extends Controller
{
  // invoice list App
  public function index()
  { $state = State::get();
      $city = City ::get();
      $thana = Thana::get();
      $area = Area::get();

        $stateShow = State::select('state_name', 'id')->get();
      $cityShow = City::select('city_name', 'id')->get();
      $thanaShow = Thana::select('thana_name', 'id')->get();
      $areaShow = Area::pluck('area_name', 'id');

      $data['states']=$state;
      $data['cities']=$city;
      $data['thanas']=$thana;
      $data['areas']=$area;

      $data['statesShow']=$stateShow;
      $data['citiesShow']=$cityShow;
      $data['thanasShow']=$thanaShow;
      $data['areasShow']=$areaShow;
    $pageConfigs = ['pageHeader' => true];


    return view('Locations.index', ['pageConfigs' => $pageConfigs],  compact('stateShow','thanaShow','areaShow','cityShow'));
  }

    public function addState(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state' => 'required|unique:states,state_name',
        ]);

        if ($validator->fails()) {
            $array['success'] = 0;
            $array['message'] = "State Already Exist";
            return $array;
        } else {
            $state = new State;
            $state->state_name = $request->state;
            if ($state->save()) {
                $array['success'] = 1;
                $array['message'] = "State Add Successfully";
                $array['states'] = State::pluck('state_name', 'id');
                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Insert Error";
                return $array;
            }
        }
    }
    public function add_city(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_name' => 'required|unique:cities,city_name',
            'state_id' => 'required',
        ]);


        if ($validator->fails()) {
            $array['success'] = 0;
            $array['message'] = "City Already Exist";
            return $array;
        } else {
            $city = new City();
            $city->city_name = $request->city_name;
            $city->state_id = $request->state_id;
            if ($city->save()) {
                $array['success'] = 1;
                $array['message'] = "City Add Successfully";

                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Insert Error";
                return $array;
            }
        }
    }
    public function add_thana(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thana_name' => 'required|unique:thanas,thana_name',
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            $array['success'] = 0;
            $array['message'] = "Thana Already Exist";
            return $array;
        } else {
            $thana = new Thana();
            $thana->thana_name = $request->thana_name;
            $thana->city_id = $request->city_id;
            if ($thana->save()) {
                $array['success'] = 1;
                $array['message'] = "Thana Add Successfully";
                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Insert Error";
                return $array;
            }
        }
    }
    public function add_area(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area_name' => 'required|unique:areas,area_name',
            'thana_id' => 'required',
        ]);

        if ($validator->fails()) {
            $array['success'] = 0;
            $array['message'] = "Area Already Exist";
            return $array;
        } else {
            $area = new Area();
            $area->area_name = $request->area_name;
            $area->thana_id = $request->thana_id;
            if ($area->save()) {
                $array['success'] = 1;
                $array['message'] = "Area Add Successfully";

                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Insert Error";
                return $array;
            }
        }
    }
    public function state_list_get(Request $request)
    {

        $data = State::select('id', 'state_name' );

        $func='State';


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use($func) {


                return view(' Actions.location_actions', compact( 'data','func'));
            })

            ->editColumn('state_name', function ($data) {

                $state_name = '<strong>'.$data->state_name.'</strong>';
                return $state_name;
            })


            ->rawColumns(['state_name' ])
            ->orderColumns(['id'], '-:column $1')

            ->make(true);
    }

    public function city_list_get(Request $request)
    {
        $stateId = $request->stateId;
         $data = City::with('states' )->get();
         $func='City';

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use($func) {


                return view(' Actions.location_actions', compact( 'data','func'));
            })

            ->editColumn('state_name', function ($data) {

                $state_name = '<strong>'.$data->states->state_name.'</strong>';
                return $state_name;
            })
            ->editColumn('city_name', function ($data) {

                $city_name = '<strong>'.$data->city_name.'</strong>';
                return $city_name;
            })

            ->rawColumns(['state_name','city_name' ])


            ->make(true);

    }

    public function thana_list_get(Request $request)
    {

        $data = Thana::with('cities' )->get();
        $func='Thana';

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use($func) {


                return view(' Actions.location_actions', compact( 'data','func'));
            })

            ->editColumn('city_name', function ($data) {

                $city_name = '<strong>'.$data->cities->city_name.'</strong>';
                return $city_name;
            })
            ->editColumn('thana_name', function ($data) {

                $thana_name = '<strong>'.$data->thana_name.'</strong>';
                return $thana_name;
            })

            ->rawColumns(['thana_name','city_name' ])


            ->make(true);

    }

    public function area_list_get(Request $request)
    {

        $data = Area::with('thanas' )->get();
        $func='Area';

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) use($func) {


                return view(' Actions.location_actions', compact( 'data','func'));
            })

            ->editColumn('thana_name', function ($data) {

                $thana_name = '<strong>'.$data->thanas->thanay_name.'</strong>';
                return $thana_name;
            })
            ->editColumn('area_name', function ($data) {

                $area_name = '<strong>'.$data->area_name.'</strong>';
                return $area_name;
            })

            ->rawColumns(['thana_name','area_name' ])


            ->make(true);

    }




    public function add_state(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_name' => 'required|unique:states,state_name',
        ]);

        if ($validator->fails()) {
            $array['success'] = 0;
            $array['message'] = "State Already Exist";
            return $array;
        } else {
            $state = new State;
            $state->state_name = $request->state_name;
            if ($state->save()) {
                $array['success'] = 1;
                $array['message'] = "State Add Successfully";
                $array['states'] = State::pluck('state_name', 'id');
                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Insert Error";
                return $array;
            }
        }
    }
    public function edit_state(Request $request)
    {
        $stateId = $request->state_id;
        $stateName = $request->state_name;

        $this->validate($request, [
            'state_name' => 'required|unique:states,state_name,' . $stateId . ',id',
        ]);

        $data = State::findOrFail($stateId);
        $data->state_name = $stateName;
        $data->save();

        if ($data->id) {
            $array['success'] = 1;
            $array['message'] = "State Edit Successfully";
            return $array;
        } else {
            $array['success'] = 0;
            $array['message'] = "Update Error";
            return $array;
        }
    }

    public function edit_city(Request $request)
    {

        $stateId = $request->state_id;
        $cityName = $request->city_name;
        $cityId = $request->city_id;

        $this->validate($request, [
            'city_name' => 'required|unique:cities,city_name,' . $cityId . ',id',
            'state_id' => 'required',
        ]);

        $data = City::findOrFail($cityId);
        $data->city_name = $cityName;
        $data->state_id = $stateId;
        $data->save();


        if ($data->id) {
            $array['success'] = 1;
            $array['message'] = "City Edit Successfully";
            return $array;
        } else {
            $array['success'] = 0;
            $array['message'] = "Update Error";
            return $array;
        }
    }

    public function edit_thana(Request $request)
    {
        $cityId = $request->city_id;
        $thanaName = $request->thana_name;
        $thanaId = $request->thana_id;

        $this->validate($request, [
            'thana_name' => 'required|unique:thanas,thana_name,' . $thanaId . ',id',
            'city_id' => 'required',
        ]);

        $data = Thana::findOrFail($thanaId);
        $data->thana_name = $thanaName;
        $data->city_id = $cityId;
        $data->save();


        if ($data->id) {
            $array['success'] = 1;
            $array['message'] = "Thana Edit Successfully";
            return $array;
        } else {
            $array['success'] = 0;
            $array['message'] = "Update Error";
            return $array;
        }
    }

    public function edit_area(Request $request)
    {
        $thanaId = $request->thana_id;
        $areaName = $request->area_name;
        $areaId = $request->area_id;

        $this->validate($request, [
            'area_name' => 'required|unique:areas,area_name,' . $areaId . ',id',
            'thana_id' => 'required',
        ]);

        $data = Area::findOrFail($areaId);
        $data->area_name = $areaName;
        $data->thana_id = $thanaId;
        $data->save();


        if ($data->id) {
            $array['success'] = 1;
            $array['message'] = "Area Updated Successfully";
            return $array;
        } else {
            $array['success'] = 0;
            $array['message'] = "Update Error";
            return $array;
        }
    }



    public function delete_state(Request  $request) {
        $id=$request->id;

        $item = State::findOrFail($id);
        $city = City::where('state_id',$id)->count();
        if($city > 0){
            $array['success'] = 0;
            $array['message'] = "City Exist Under This State";
            return $array;

        }else{
            if ($item->delete()) {

                $array['success'] = 1;
                $array['message'] = "State delete successfully done";
                return $array;

            } else {

                $array['success'] = 0;
                $array['message'] = "State delete failed! Please try again!!!";
                return $array;
            }
        }

    }

    public function delete_city(Request  $request) {
         $id=$request->id;
         $item = City::findOrFail($id);
        $thana = Thana::where('city_id',$id)->count();

        if($thana > 0){
            $array['success'] = 0;
            $array['message'] = "Thana Exist Under This City";
            return $array;

        }else{
            if ($item->delete()) {
                $array['success'] = 1;
                $array['message'] = "City delete successfully done";
                return $array;

            } else {
                $array['success'] = 0;
                $array['message'] = "City delete failed! Please try again!!!";
                return $array;

            }
        }

    }
    public function delete_thana(Request  $request) {
      $id=$request->id;
        $item = Thana::findOrFail($id);
        $area = Area::where('thana_id',$id)->count();

        if($area > 0){
            $array['success'] = 1;
            $array['message'] = "Area Exist Under This Thana";
            return $array;

        }else{
            if ($item->delete()) {
                $array['success'] = 1;
                $array['message'] = "Thana delete successfully done";
                return $array;
            } else {
                $array['success'] = 0;
                $array['message'] = "Thana delete failed! Please try again!!!";
                return $array;

            }
        }
    }

    public function delete_area(Request  $request) {
      $id=$request->id;
        $item = Area::findOrFail($id);
        if ($item->delete()) {
            $array['success'] = 1;
            $array['message'] = "Area delete successfully done";
            return $array;
        } else {
            $array['success'] = 0;
            $array['message'] = "Area delete failed! Please try again!!!";
            return $array;
        }
    }

    public function get_all_states()
    {
        $data=State::get();
        return $data;

    }
    public function get_all_cities()
    {
        $data=City::get();
        return $data;

    }
    public function get_all_thana()
    {
        $data=Thana::get();
        return $data;

    }

}
