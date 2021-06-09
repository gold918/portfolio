<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\About;
use App\Model\Site\AboutItem;

class AboutItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.about.item.create')) {
            return view('admin.about.item.create', ['singleId' => $singleId]);
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
            'list_item' => 'required',
        ]);

        $about = About::find($singleId);

        if($request->has(['list_item'])) {
            $aboutItem = new AboutItem;
            $aboutItem->list_item = $request->list_item;
            if($request->has('status')) {
                $aboutItem->status = 1;
            }
            $aboutItem->setDate($request->date);
            $about->aboutItemsAll()->save($aboutItem);
            return redirect()->route('about.single', ['id' => $about->id]);
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $singleId
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($singleId, $id)
    {
        $about = About::find($singleId);
        $aboutItem = AboutItem::find($id);
        $mainElements = About::pluck('title', 'id');
        $data = compact('about', 'aboutItem', 'mainElements');
        if(view()->exists('admin.about.item.update')) {
            return view('admin.about.item.update', $data);
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

        $aboutItem = AboutItem::find($id);

        $aboutItem->updateField($request, 'list_item');
        $aboutItem->updateFieldStatus($request);
        $aboutItem->setDate($request->date, 'updated_at');
//        dd($aboutItem->about->id, $request->mainElement);

        if($request->exists('mainElement') && strpos($request->mainElement, (string)$aboutItem->about->id) === false ) {
            $idKey = explode(' - ', $request->mainElement);
            $about = About::find($idKey[0]);
            $aboutItem->about()->associate($about);
        }
        $aboutItem->save();
        return redirect()->route('about.single', ['id' => $singleId]);
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
            $aboutItem = AboutItem::find($id);
            $aboutItem->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
