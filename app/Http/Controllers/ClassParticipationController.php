<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ClassParticipationController extends Controller
{
    public function participate(Request $request, $userid, $id)
    {

        $participate = \App\Models\Participation::updateOrCreate(
            ['date' => Carbon::now()->format('Y-m-d'), 'user_id' => $userid, 'course_id' => $id],
            ['audio_time' => $request->time]
        );

    }
}
