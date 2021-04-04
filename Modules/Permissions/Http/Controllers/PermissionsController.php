<?php

namespace Modules\Permissions\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if($request->has('data')){
            $permissions=Permission::select(['id','name'])->get();
            return Datatables::of($permissions)
                ->addColumn('actions', function ($data) {
                    return view('permissions::actions.action-column',compact('data'));
                })
                ->rawColumns(['id','name','actions'])
                ->toJson();
        }
        return view('permissions::backend.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('permissions::backend.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        Permission::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return $id;
      //  return view('permissions::backend.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $permission=Permission::findById($id);
        return view('permissions::backend.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        Permission::findById($id)->update(['name'=>$request->name]);
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Permission::find($id)->delete();
         return redirect()->back();
    }
}
