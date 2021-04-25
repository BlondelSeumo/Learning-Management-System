<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\SystemSetting\Entities\Message;
use Modules\CourseSetting\Entities\Notification;
use Modules\CourseSetting\Entities\CourseComment;

class CommunicationController extends Controller
{
    public function QuestionAnswer()
    {
        $comments = CourseComment::where('instructor_id', Auth::id())->with('course', 'replies', 'user')->paginate(10);
        return view('backend.communication.question_answer', compact('comments'));
    }

    public function PrivateMessage()
    {
        if (Auth::id() == 1)
            $users = User::where('id', '!=', Auth::id())->where('role_id',2)->with('reciever')->paginate(10);
        elseif (Auth::user()->role_id == 2)
            $users = User::with('reciever')->where('id','!=',Auth::id())->where(function ($query){
              $query->where('role_id',1)->orWhereHas('enrollStudents');
            })->paginate(10);


        $singleMessage = Message::where('sender_id', Auth::id())->orderBy('id', 'DESC')->first();
        if ($singleMessage) {
            $messages = Message::whereIn('reciever_id', array(Auth::id(), $singleMessage->reciever_id))
                ->whereIn('sender_id', array(Auth::id(), $singleMessage->reciever_id))->get();

        } else {
            $messages = "";
        }
        // return $singleMessages;
        return view('backend.communication.private_messages', compact('messages', 'users', 'singleMessage'));
    }


    public function StorePrivateMessage(Request $request)
    {

        $request->validate([
            'message' => 'required',
        ]);
        try {

            $message = new Message;
            $message->sender_id = Auth::id();
            $message->reciever_id = $request->reciever_id;
            $message->message = $request->message;
            $message->type = Auth::id() == 1 ? 1 : 2;
            $message->seen = 0;
            $message->save();

            $notification = new Notification();
            $notification->author_id = Auth::id();
            $notification->user_id = $request->reciever_id;
            $notification->message_id = $message->id;
            $notification->save();


            Toastr::success('Message has been send successfully', 'Success');

            $messages = Message::whereIn('reciever_id', array(Auth::id(), $request->reciever_id))
                ->whereIn('sender_id', array(Auth::id(), $request->reciever_id))->get();

            // return $messages;
            $output = getConversations($messages);

            return response()->json($output);

        } catch (\Exception $e) {

            Log::info($e);
            return response()->json(['error' => $e]);
        }
    }


    public function getMessage(Request $request)
    {

        try {
            $receiver_id=$request->id;
           $messages= Message::whereIn('reciever_id',array(Auth::id(),$receiver_id))
                         ->whereIn('sender_id',array(Auth::id(),$receiver_id))->get();
            $output =getConversations($messages);
            Message::where('seen', '=', 0)->where('sender_id',$receiver_id)->where('reciever_id',Auth::id())->update(['seen' => 1]);
            $data['messages']=$output;
            $receiver=User::find($receiver_id);
            $data['receiver_name']=$receiver->name;
            $data['avatar']=url('public/'.$receiver->image);
            return response()->json($data);

        } catch (\Exception $e) {

            Log::info($e);
            return response()->json(['error' => 'error']);
        }
    }


}
