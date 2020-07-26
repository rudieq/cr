<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CrUser;
use App\CrUserEdit;

class CrBaseController extends Controller
{
    protected $dataTable = 'cr_users';
    protected $dataEditTable = 'cr_user_edits';
    protected $editRoute = 'users.edit';
    protected $updateRoute = 'users.update';
    protected $indexRoute = 'users.index';

    protected function newDataEdit()
    {
        return new CrUserEdit;
    }

    protected function getData($id)
    {
        return CrUser::find($id);
    }

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
        $users = DB::table($this->dataTable)->where('name', 'LIKE', "%%")
            ->leftJoin($this->dataEditTable, $this->dataTable . '.id', '=', $this->dataEditTable . '.cr_id')
            ->select($this->dataTable . '.*', $this->dataEditTable . '.cr_id as edit')
            ->orderBy($this->dataTable . '.id')
            ->paginate(20);

        return view('table')->with(['data'=> $users, 'editRoute' => $this->editRoute]);
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
            DB::table($this->dataEditTable)->where('user_id', auth()->user()->id)->where('cr_id', $id)->delete();
            return redirect(route($this->indexRoute))->with('success', 'Data updated');
        }

        //create edit record
        try {
            $userEdit = $this->newDataEdit();
            $userEdit->user_id = auth()->user()->id;
            $userEdit->cr_id = $id;
            $userEdit->save();
        } finally {
            $user = DB::table($this->dataTable)->find($id);

            return view('edit')->with(['data' => $user, 'url' => route($this->updateRoute,$id)]);
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

        $user = $this->getData($id);
        //data changed conflict
        if ($request->updated_at != $user->updated_at){
            return view('edit')->with(['data' => $user, 'url' => route($this->updateRoute,$id), 'comment' => $request->comment])->withErrors('Database changed');
        }

        $user->comment = $request->comment;
        $user->save();

        
        DB::table($this->dataEditTable)->where('user_id', auth()->user()->id)->where('cr_id', $id)->delete();
        return redirect(route($this->indexRoute))->with('success', 'Data updated');
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
