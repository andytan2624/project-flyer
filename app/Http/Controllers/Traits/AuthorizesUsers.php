<?php

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Http\Request;

trait AuthorizesUsers {
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id,
        ])->exists();
    }

    public function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No Way'], 403);
        }

        flash('No Way.');

        return redirect('/');
    }
}