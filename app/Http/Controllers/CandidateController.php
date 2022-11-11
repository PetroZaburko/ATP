<?php

namespace App\Http\Controllers;

use App\Http\Requests\BecomeCandidateRequest;
use App\Models\Candidate;
use App\Models\User;
use TCG\Voyager\Facades\Voyager;

class CandidateController extends Controller
{
    public function index()
    {
        return view('vendor.voyager.candidate');
    }

    public function store(BecomeCandidateRequest $request)
    {
        $candidate = Candidate::create($request->all());
        return view('vendor.voyager.login')->with(
            [
                'message' => "Dear { $candidate->name . $candidate->surname }, your application accepted",
                'alert-type' => 'success'
            ]
        );
    }

    public function convert($id)
    {
        $candidate = Candidate::find($id);
        $user = new User();
        $user->name = $candidate->name;
        $user->surname = $candidate->surname;
        $user->email = $candidate->email;
        $user->birth = $candidate->birth;
        $user->role_id = config('atp.candidate_role');

        $dataType = Voyager::model('DataType')->where('slug', '=', 'users')->first();
        $isModelTranslatable = is_bread_translatable($user);
        return view(
            'vendor.voyager.users.edit-add',
            [
                'dataType' => $dataType,
                'dataTypeContent' => $user,
                'isModelTranslatable' => $isModelTranslatable
            ]
        );
    }
}
