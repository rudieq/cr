<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrUser;
use App\CrUserEdit;

class CrUsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = CrUser::where('name', 'LIKE', "%%")
            ->leftJoin('cr_user_edits', 'cr_users.id', '=', 'cr_user_edits.cr_user_id')
            ->select('cr_users.*', 'cr_user_edits.cr_user_id as edit')
            ->orderBy('cr_users.id')
            ->paginate(20);

        return view('table')->with('data', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
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
    public function edit($id, Request $request)
    {
        //cancel edit
        if ($request->cancel){
            CrUserEdit::where('user_id', auth()->user()->id)->where('cr_user_id', $id)->delete();
            return redirect(route('users.index'))->with('success', 'Data updated');
        }

        //create CrUserEdit record
        try {
            $userEdit = new CrUserEdit;
            $userEdit->user_id = auth()->user()->id;
            $userEdit->cr_user_id = $id;
            $userEdit->save();
        } finally {
            $user = CrUser::find($id);

            return view('edit')->with(['data' => $user, 'url' => route('users.update',$id)]);
        }

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
        $user = CrUser::find($id);

        //data changed conflict
        if ($request->updated_at != $user->updated_at){
            return view('edit')->with(['data' => $user, 'url' => route('users.update',$id), 'comment' => $request->comment])->withErrors('Database changed');
        }

        $user->comment = $request->comment;
        $user->save();
        
        CrUserEdit::where('user_id', auth()->user()->id)->where('cr_user_id', $id)->delete();

        return redirect(route('users.index'))->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
