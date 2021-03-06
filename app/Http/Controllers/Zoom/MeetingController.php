<?php

namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function list(Request $request) 
    { 
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);
    
        $data = json_decode($response->body(), true);
        $data['meetings'] = array_map(function (&$m) {
            $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
            return $m;
        }, $data['meetings']);
    
        return [
            'success' => $response->ok(),
            'data' => $data,
        ];
    }

    public function create(Request $request) 
    { 
        $validator = Validator::make($request->all(), [
            //'topic' => 'required|string',
            //'start_time' => 'required|date',
            'agenda' => 'string|nullable',
        ]);
        
        if ($validator->fails()) {
            return [
                'success' => false,
                'data' => $validator->errors(),
            ];
        }
        $data = $validator->validated();
    
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            //'topic' => $data['topic'],
            'type' => self::MEETING_TYPE_RECURRING,
            //'schedule_for' => "mahmudul.hasan1.cse@ulab.edu.bd",
            //'start_time' => $this->toZoomTimeFormat($data['start_time']),
            'duration' => 120,
            //'agenda' => $data['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);
    
    
        return [
            //$x = json_decode($response->body()),
            //dd($x),
            //$response->body(),
            json_decode($response->body(), true),
        ];
    }

    public function signature ($meeting_number){

        $time = time() * 1000 - 30000;//time in milliseconds (or close enough)
        
        $data = base64_encode(env('ZOOM_API_KEY') . $meeting_number . $time . 1);
        
        $hash = hash_hmac('sha256', $data, env('ZOOM_API_SECRET'), true);
        
        $_sig = env('ZOOM_API_KEY') . "." . $meeting_number . "." . $time . "." . 1 . "." . base64_encode($hash);
        
        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
        //return $meeting_number;
    }

    public function get(Request $request, string $id) 
    { 
        $path = 'meetings/' . $id;
        $response = $this->zoomGet($path);
    
        $data = json_decode($response->body(), true);
        if ($response->ok()) {
            $data['start_at'] = $this->toUnixTimeStamp($data['start_time'], $data['timezone']);
        }
    
        return [
            'success' => $response->ok(),
            'data' => $data,
        ];
    }

    public function update(Request $request, string $id) 
    { 
        $validator = Validator::make($request->all(), [
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'agenda' => 'string|nullable',
        ]);
    
        if ($validator->fails()) {
            return [
                'success' => false,
                'data' => $validator->errors(),
            ];
        }
        $data = $validator->validated();
    
        $path = 'meetings/' . $id;
        $response = $this->zoomPatch($path, [
            'topic' => $data['topic'],
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => (new \DateTime($data['start_time']))->format('Y-m-d\TH:i:s'),
            'duration' => 30,
            'agenda' => $data['agenda'],
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);
    
        return [
            'success' => $response->status() === 204,
            'data' => json_decode($response->body(), true),
        ]; 
    }
    
    public function delete(Request $request, string $id) 
    { 
        $path = 'meetings/' . $id;
        $response = $this->zoomDelete($path);
    
        return [
            'success' => $response->status() === 204,
            'data' => json_decode($response->body(), true),
        ];
    }
}