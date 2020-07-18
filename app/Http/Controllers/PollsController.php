<?php

namespace App\Http\Controllers;
use App\Poll;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\Poll as PollResource;

class PollsController extends Controller
{
    public function index() {
        return response()->json(Poll::paginate(), 200);
    }

    public function show($id) {
        $poll = Poll::find($id);
        // if(is_null($poll)) {
        //     return response()->json(null, 404);
        // }
        // //return response()->json(Poll::findorFail($id), 200);
        $poll = Poll::with('questions')->findorFail($id);
        $response['poll'] = $poll;
        $response['questions'] = $poll->questions;
        //$response = new PollResource($response, 200);
        return response()->json($response, 200);
    }

    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:10'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $poll = Poll::create($request->all());
        return response()->json($poll, 201);
    }

    public function update(Request $request, Poll $poll){
        $poll->update($request->all());
        return response()->json($poll, 200);
    }

    public function delete(Request $request, Poll $poll){
        $poll->delete();
        return response()->json(null, 204);
    }

    public function errors(){
        return response()->json(['msg' => 'Payment is required'], 501);
    }

    public function questions(Request $request, Poll $poll) {
        $questions = $poll->questions;
        return response()->json($questions, 200);
    }
}
