<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();

        if(view()->exists('admin.service.index')) {
            return view('admin.service.index', ['services' => $services]);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(view()->exists('admin.service.create')) {
            return view('admin.service.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'alias' => 'required|regex:/^([a-zA-Z]+-?)+$/|unique:services,alias',
            'icon' => 'required',
            'text' => 'required'
        ]);

        if($request->has(['title', 'alias', 'icon', 'text'])) {
            $service->title = $request->title;
            $service->alias = $request->alias;
            $service->text = $request->text;
            $service->icon = $request->icon;
            if($request->has('status')) {
                $service->status = 1;
            }
            $service->setDate($request->date);
            $service->save();
            return redirect()->route('admin.service');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        if(view()->exists('admin.service.update')) {
            return view('admin.service.update', ['service' => $service]);
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $rules = [
            'alias' => 'regex:/^([a-zA-Z]+-?)+$/',
        ];
        if(isset($service->alias) && $request->exists('alias') && $request->alias !== $service->alias) {
            $rules['alias'] = 'regex:/^([a-zA-Z]+-?)+$/|unique:services,alias';
        }
        $request->validate($rules);

        $service->updateField($request, 'title');
        $service->updateField($request, 'alias');
        $service->updateField($request, 'text');
        $service->updateField($request, 'icon');
        $service->updateFieldStatus($request);
        $service->setDate($request->date, 'updated_at');
        $service->save();
        return redirect()->route('admin.service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            $service = Service::find($id);
            $service->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
