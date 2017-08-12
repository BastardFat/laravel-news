<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Feed\FeedItem;

class News extends Model implements FeedItem
{
    public function short_body()
    {
        if(strlen($this->body) <= 96)
            return $this->body;
        return substr($this->body, 0,96) . ' ...';
    }

    public function posted_user()
    {
        $user = User::find($this->user_id);
        if(!isset($user))
            return "John Doe";
        return $user->name;
    }

    public static function add_record($title, $body)
    {
        $record = new News;
        $record->title = $title;
        $record->body = $body;
        $record->user_id = Auth::user()->id;
        $record->save();
        return $record;
    }

    public function getFeedItemId()
    {
        return $this->id;
    }

    public function getFeedItemTitle() : string
    {
        return $this->title;
    }

    public function getFeedItemUpdated() : Carbon
    {
        return $this->updated_at;
    }

    public function getFeedItemSummary() : string
    {
        return $this->body;
    }

    public function getFeedItemLink() : string
    {
        return url('/news/'.$this->id);
    }

    public function getFeedItemAuthor() : string
    {
        return $this->posted_user();
    }

    public function getFeedItems()
    {
        return News::all();
    }}
