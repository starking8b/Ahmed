<?php

namespace Modules\ISP\Http\Controllers;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\ISP\Entities\ISP;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Renderable;

class ISPController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
         
        if ($request->has('data')) {
            $isps = ISP::select(['id', 'name'])->get();
            return Datatables::of($isps)
                ->addColumn('actions', function ($data) {
                    return view('isp::actions.action-column', compact('data'));
                })
                ->rawColumns(['id', 'name', 'actions'])
                ->toJson();
        }
        return view('isp::index');
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('isp::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            Flash::error('can not save');
            return redirect()->back()->withInput();
        }

        $isp = ISP::create($request->except('logo'));

        if ($request->file('logo')) {
            $request->validate([
                'logo' => 'mimes:jpg,png|max:2048',
            ]);
            if ($isp->logo != "") {
                unlink('storage/logos/' . $isp->id . '/' . $isp->logo);
            }
            $fileName = time() . '.' . $request->logo->extension();
            $request->file('logo')->storeAs('public/logos/' . $isp->id, $fileName);
            $isp->logo = $fileName;
            $isp->save();
        }

        Flash::success('save done');
        return redirect()->route('isp.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('isp::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $isp = ISP::findOrFail($id);
        return view('isp::edit', compact('isp'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            Flash::error('can not save');
            return redirect()->back()->withInput();
        }

        $isp =  ISP::find($id);
        $isp->update($request->except('logo'));
 
        if ($request->file('logo')) {
            $request->validate([
                'logo' => 'mimes:jpg,png|max:2048',
            ]);
            if ($isp->logo != "") {
                unlink('storage/logos/' . $isp->id . '/' . $isp->logo);
            }
            $fileName = time() . '.' . $request->logo->extension();
            $request->file('logo')->storeAs('public/logos/' . $isp->id, $fileName);
            $isp->logo = $fileName;
            $isp->save();
        }

        Flash::success('save done');
        return redirect()->route('isp.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $isp = ISP::find($id);
        if ($isp->logo != "") {
            unlink('storage/logos/' . $isp->id . '/' . $isp->logo);
        }
        $isp->delete();
        Flash::success('delete done');
        return  redirect()->route('isp.index');
    }
}
