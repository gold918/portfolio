<?php

namespace App\Http\Controllers\Admin\Feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Feature;
use App\Model\Site\FeatureItem;

class FeatureItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.feature.item.create')) {
            return view('admin.feature.item.create', ['singleId' => $singleId]);
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $singleId
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $singleId)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required',
            'icon' => 'required',
        ]);

        $feature = Feature::find($singleId);

        if($request->has(['title', 'text', 'icon'])) {
            $featureItem = new FeatureItem();
            $featureItem->title = $request->title;
            $featureItem->text = $request->text;
            $featureItem->icon = $request->icon;
            if($request->has('status')) {
                $featureItem->status = 1;
            }
            $featureItem->setDate($request->date);
            $feature->featureItemsAll()->save($featureItem);
            return redirect()->route('admin.feature.single', ['id' => $feature->id]);
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    public function edit($singleId, $id)
    {
        $feature = Feature::find($singleId);
        $featureItem = FeatureItem::find($id);
        $mainElements = Feature::pluck('id');
        $data = compact('feature', 'featureItem', 'mainElements');
        if(view()->exists('admin.feature.item.update')) {
            return view('admin.feature.item.update', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $singleId, $id)
    {

        $featureItem = FeatureItem::find($id);

        $featureItem->updateField($request, 'title');
        $featureItem->updateField($request, 'icon');
        $featureItem->updateFieldStatus($request);
        $featureItem->setDate($request->date, 'updated_at');


        if($request->exists('mainElement') && strpos($request->mainElement, (string)$featureItem->feature->id) === false ) {
            $idKey = explode(': ', $request->mainElement);
            $feature = Feature::find($idKey[1]);
            $featureItem->feature()->associate($feature);
        }
        $featureItem->save();
        return redirect()->route('admin.feature.single', ['id' => $singleId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($singleId, $id)
    {
        try{
            $featureItem = FeatureItem::find($id);
            $featureItem->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
