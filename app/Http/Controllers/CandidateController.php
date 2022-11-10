<?php

namespace App\Http\Controllers;

use App\Http\Requests\BecomeCandidateRequest;
use App\Models\Candidate;

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
                'message' => 'Your application accepted',
                'alert-type' => 'success'
            ]
        );
    }
}
