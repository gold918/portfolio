<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMembers = Team::get();

        if(view()->exists('admin.team.index')) {
            return view('admin.team.index', ['teamMembers' => $teamMembers]);
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
        if(view()->exists('admin.team.create')) {
            return view('admin.team.create');
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $teamMember)
    {
        $request->validate([
            'name' => 'required|unique:teams,name',
            'position' => 'required',
            'photo' => 'required|image',
        ]);

        if($request->has(['name', 'position', 'photo'])) {
            $teamMember->name = $request->name;
            $teamMember->position = $request->position;
            $teamMember->uploadImage($request->file('photo'), 'img/team', 'photo');
            if($request->has('status')) {
                $teamMember->status = 1;
            }
            $teamMember->setDate($request->date);
            $teamMember->save();
            return redirect()->route('admin.team');
        }
        return back()->withErrors(['inform' => 'Что-то пошло не так. Пожалуйста, повторите попытку.']);
    }

    public function show($id)
    {
        $teamMember = Team::find($id);
        $teamMemberSocials = $teamMember->teamSocialsAll;
        if(view()->exists('admin.team.item.index')) {
            return view('admin.team.item.index', ['teamMember' => $teamMember, 'teamMemberSocials' => $teamMemberSocials]);
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teamMember = Team::find($id);
        if(view()->exists('admin.team.update')) {
            return view('admin.team.update', ['teamMember' => $teamMember]);
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
        $teamMember = Team::find($id);
        $rules = [
            'photo' => 'image',
        ];
        if(isset($teamMember->name) && $request->exists('name') && $request->name !== $teamMember->name) {
            $rules['name'] = 'unique:teams,name';
        }

        $request->validate($rules);

        $teamMember->updateField($request, 'name');
        $teamMember->updateField($request, 'position');
        $teamMember->uploadImage($request->file('photo'), 'img/team', 'photo');
        $teamMember->updateFieldStatus($request);
        $teamMember->setDate($request->date, 'updated_at');
        $teamMember->save();
        return redirect()->route('admin.team');
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
            $teamMember = Team::find($id);
            if(isset($teamMember->teamSocialsAll) && is_object($teamMember->teamSocialsAll)) {
                $teamMember->teamSocialsAll()->delete();
            }
            $teamMember->delete();
            $teamMember->removeImage('img/team', 'photo');
            if (isset($request->redirect)) {
                return response($request->redirect);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
