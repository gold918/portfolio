<?php

namespace App\Http\Controllers\Admin\CTA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Action;

class CTAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actions = Action::get();

        if(view()->exists('admin.cta.index')) {
            return view('admin.cta.index', ['actions' => $actions]);
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
        if(view()->exists('admin.cta.create')) {
            return view('admin.cta.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Action $action)
    {
        $request->validate([
            'title' => 'required',
            'button_text' => 'required',
            'link' => 'required|regex:/^(\w+-*\/?)+$/|unique:actions,link',
            'background_image' => 'required|image',
            'text' => 'required'
        ]);

        if($request->has(['title', 'button_text', 'link', 'background_image', 'text'])) {
            $action->title = $request->title;
            $action->text = $request->text;
            $action->button_text = $request->button_text;
            $action->link = $request->link;
            $action->uploadImage($request->file('background_image'), 'img', 'background_image');
            if($request->has('status')) {
                $action->status = 1;
            }
            $action->setDate($request->date);
            $action->save();
            return redirect()->route('admin.cta');
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
        $action = Action::find($id);
        if(view()->exists('admin.cta.update')) {
            return view('admin.cta.update', ['action' => $action]);
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
        $action = Action::find($id);
        $rules = [
            'link' => 'regex:/^(\w+-*\/?)+$/',
            'background_image' => 'image',
        ];
        if(isset($action->link) && $request->exists('link') && $request->link !== $action->link) {
            $rules['alias'] = 'regex:/^(\w+-*\/?)+$/|unique:actions,link';
        }
        $request->validate($rules);

        $action->updateField($request, 'title');
        $action->updateField($request, 'button_text');
        $action->updateField($request, 'link');
        $action->updateField($request, 'text');
        $action->uploadImage($request->file('background_image'), 'img', 'background_image');
        $action->updateFieldStatus($request);
        $action->setDate($request->date, 'updated_at');
        $action->save();
        return redirect()->route('admin.cta');
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
            $action = Action::find($id);
            $action->delete();
            $action->removeImage('img', 'background_image');
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
