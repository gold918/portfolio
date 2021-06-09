<?php

namespace App\Http\Controllers\Admin\Count;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Count;
use App\Model\Site\CountItem;

class CountItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.count.item.create')) {
            return view('admin.count.item.create', ['singleId' => $singleId]);
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
            'main_word' => 'required',
            'number' => 'required',
            'text' => 'required',
            'icon' => 'required',
        ]);

        $count = Count::find($singleId);

        if($request->has(['main_word', 'number', 'icon', 'text'])) {
            $countItem = new CountItem;
            $countItem->main_word = $request->main_word;
            $countItem->text = $request->text;
            $countItem->icon = $request->icon;
            $countItem->number = $request->number;
            if($request->has('status')) {
                $countItem->status = 1;
            }
            $countItem->setDate($request->date);
            $count->countItemsAll()->save($countItem);
            return redirect()->route('admin.count.single', ['id' => $count->id]);
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
        $count = Count::find($singleId);
        $countItem = CountItem::find($id);
        $elements = Count::pluck('title', 'id');
        $data = compact('count', 'countItem', 'elements');
        if(view()->exists('admin.count.item.update')) {
            return view('admin.count.item.update', $data);
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

        $countItem = CountItem::find($id);

        $countItem->updateField($request, 'main_word');
        $countItem->updateField($request, 'number');
        $countItem->updateField($request, 'icon');
        $countItem->updateField($request, 'text');
        $countItem->updateFieldStatus($request);
        $countItem->setDate($request->date, 'updated_at');

        if($request->exists('mainElement') && (int)$request->mainElement !== $countItem->count->id) {
            $idKey = (int)$request->mainElement;
            $count = Count::find($idKey);
            $countItem->count()->associate($count);
        }
        $countItem->save();
        return redirect()->route('admin.count.single', ['id' => $singleId]);
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
            $countItem = CountItem::find($id);
            $countItem->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
