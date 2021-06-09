<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::get();

        if(view()->exists('admin.contact.index')) {
            return view('admin.contact.index', ['contacts' => $contacts]);
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
        if(view()->exists('admin.contact.create')) {
            return view('admin.contact.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contact $contact)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'icon' => 'required',
        ]);

        if($request->has(['title', 'value', 'icon'])) {
            $contact->title = $request->title;
            $contact->value = $request->value;
            $contact->icon = $request->icon;
            if($request->has('status')) {
                $contact->status = 1;
            }
            $contact->setDate($request->date);
            $contact->save();
            return redirect()->route('admin.contact');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        if(view()->exists('admin.contact.update')) {
            return view('admin.contact.update', ['contact' => $contact]);
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
        $contact = Contact::find($id);

        $contact->updateField($request, 'title');
        $contact->updateField($request, 'value');
        $contact->updateField($request, 'icon');
        $contact->updateFieldStatus($request);
        $contact->setDate($request->date, 'updated_at');
        $contact->save();
        return redirect()->route('admin.contact');
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
            $contact = Contact::find($id);
            $contact->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
