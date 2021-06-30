<?php

namespace App\Http\Controllers;

use App\Model\Site\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    public function add (Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'subscribe' => 'required|email|unique:subscribers,mail',
            ]);
            if ($validator->fails())
            {
                return response()->json($validator->errors()->all(), 422);
            }
            $subscribe = new Subscriber([
                'mail' => $request->subscribe,
            ]);
            $subscribe->save();

            return response()->json('Email успешно сохранен!');


        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
