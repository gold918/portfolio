<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Site\Team;
use App\Model\Site\TeamSocial;

class TeamSocialController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $singleId
     * @return \Illuminate\Http\Response
     */
    public function create($singleId)
    {
        if(view()->exists('admin.team.item.create')) {
            return view('admin.team.item.create', ['singleId' => $singleId]);
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
            'name' => 'required',
            'icon' => 'required',
            'link' => 'required|active_url',
        ]);

        $teamMember = Team::find($singleId);

        if($request->has(['name', 'link', 'icon'])) {
            $teamMemberSocial = new TeamSocial;
            $teamMemberSocial->name = $request->name;
            $teamMemberSocial->icon = $request->icon;
            $teamMemberSocial->link = $request->link;
            if($request->has('status')) {
                $teamMemberSocial->status = 1;
            }
            $teamMemberSocial->setDate($request->date);
            $teamMember->teamSocialsAll()->save($teamMemberSocial);
            return redirect()->route('admin.team.single', ['id' => $teamMember->id]);
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
        $teamMember = Team::find($singleId);
        $teamMemberSocial = TeamSocial::find($id);
        $elements = Team::pluck('name');
        $data = compact('teamMember', 'teamMemberSocial', 'elements');
        if(view()->exists('admin.team.item.update')) {
            return view('admin.team.item.update', $data);
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

        $teamMemberSocial = TeamSocial::find($id);
        $rules = [
            'link' => 'active_url',
        ];
        $request->validate($rules);

        $teamMemberSocial->updateField($request, 'name');
        $teamMemberSocial->updateField($request, 'link');
        $teamMemberSocial->updateField($request, 'icon');
        $teamMemberSocial->updateFieldStatus($request);
        $teamMemberSocial->setDate($request->date, 'updated_at');

        if($request->exists('mainElement') && strpos($request->mainElement, $teamMemberSocial->team->name) === false ) {
            $teamMember = Team::where('name', $request->mainElement)->first();
            $teamMemberSocial->team()->associate($teamMember);
        }
        $teamMemberSocial->save();
        return redirect()->route('admin.team.single', ['id' => $singleId]);
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
            $teamMemberSocials = TeamSocial::find($id);
            $teamMemberSocials->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
