<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Feature;
use App\Model\Site\FeatureItem;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::get();

        if(view()->exists('admin.feature.index')) {
            return view('admin.feature.index', ['features' => $features]);
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
        if(view()->exists('admin.feature.create')) {
            return view('admin.feature.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Feature $feature)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        if($request->has(['image'])) {
            $feature->uploadImage($request->file('image'), 'img', 'image');
            if($request->has('status')) {
                $feature->status = 1;
            }
            $feature->setDate($request->date);
            $feature->save();
            return redirect()->route('admin.feature');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature = Feature::find($id);
        $featureItems = $feature->featureItemsAll;
        if(view()->exists('admin.feature.item.index')) {
            return view('admin.feature.item.index', ['feature' => $feature, 'featureItems' => $featureItems]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature = Feature::find($id);
        if(view()->exists('admin.feature.update')) {
            return view('admin.feature.update', ['feature' => $feature]);
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
        $feature = Feature::find($id);
        $rules = [
            'image' => 'image',
        ];
        $request->validate($rules);

        $feature->uploadImage($request->file('image'), 'img', 'image');
        $feature->updateFieldStatus($request);
        $feature->setDate($request->date, 'updated_at');
        $feature->save();
        return redirect()->route('admin.feature');
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
            $feature = Feature::find($id);
            if(isset($feature->featureItemsAll) && is_object($feature->featureItemsAll)) {
                $feature->featureItemsAll()->delete();
            }
            $feature->delete();
            $feature->removeImage('img', 'image');
            if (isset($request->redirect)) {
                return response(route('admin.feature'));
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
