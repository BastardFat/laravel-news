<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    public function posted_user()
    {
        $user = User::find($this->user_id);
        if(!isset($user))
            return "John Doe";
        return $user->name;
    }

    public static function add_record($newsid, $body)
    {
        $record = new Comment;
        $record->post_id = $newsid;
        $record->body = $body;
        $record->user_id = Auth::user()->id;
        $record->save();
        return $record;
    }
}
