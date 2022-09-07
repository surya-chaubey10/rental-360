<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\InviteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/user-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_user-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
            $user = $this->jsonUserList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_user-list.json', collect($data));
        }

        return view('users.list', ['pageConfigs' => $pageConfigs]);
    }

    private function jsonUserList()
    {
        return User::select('users.fullname', 'ors.name as role', 'users.email', 'users.mobile', 'users.status')
            ->join('organisation_roles as ors', function ($join) {
                $join->on('ors.id', '=', 'users.role_id');
            })
            ->withoutGlobalScope('organisation_id')
            ->where('usertype', 4)
            ->where('users.organisation_id', getUser()->organisation_id)
            ->get();
    }
}
