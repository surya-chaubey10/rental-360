<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/superadmin/user-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/user-list.json')) {
            \File::delete($path . '/user-list.json');
        }

        if (!file_exists($path . '/user-list.json')) {
            $user = $this->jsonUserList();
            $data = array('data' => $user);
            \File::put($path . '/user-list.json', collect($data));
        }

        return view('users.list', ['pageConfigs' => $pageConfigs]);
    }

    private function jsonUserList()
    {
        return User::select('users.fullname', 'roles.name as role', 'users.email', 'users.mobile', 'users.status')
            ->leftJoin('default_roles as roles', function ($join) {
                $join->on('roles.id', '=', 'users.role_id');
            })
            ->where('usertype', 1)
            ->get();
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

public function edit($uuid)
  { 
      
        $user = User::select('users.uuid','users.fullname', 'roles.name as role', 'users.email', 'users.mobile', 'users.status')
             ->leftJoin('default_roles as roles', function ($join) {
              $join->on('roles.id', '=', 'users.role_id');
             })
             ->where('users.uuid',$uuid)->first();
   

      return view('users.edit',compact('user'));    
  } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
