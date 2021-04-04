<?php

namespace Modules\User\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => route('users.index'), 'name' => "Users"]
        ];
        if($request->has('data')){
            $user=User::select(['id','name','email'])->get();
            return Datatables::of($user)
                ->addColumn('actions', function ($data) {
                    return view('user::actions.action-column',compact('data'));
                })
                ->rawColumns(['id','name','email','actions'])
                ->toJson();
        }
        return view('user::backend.index', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => route('users.index'), 'name' => "Users"], ['name' => "Create User"]
        ];
        return view('user::backend.create', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        User::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('user::backend.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
         $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => route('users.index'), 'name' => "Users"], ['name' => "User Edit"]
        ];
        $user=User::where('id',$id)->first();

        return view('user::backend.edit', [
            'breadcrumbs' => $breadcrumbs,'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        User::where('id',$id)->first()->update(['name'=>$request->name,'email'=>$request->email,'password'=>Hash::make($request->password)]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}
