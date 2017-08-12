<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Feed\FeedItem;
use GrahamCampbell\Markdown\Facades\Markdown;


class News extends Model implements FeedItem
{
    public function short_body()
    {
        $temp = substr(strip_tags(Markdown::convertToHtml($this->body)),0,96);
        $temp = strlen($temp) < 95 ? $temp : $temp." ...";
        return $temp;
    }

    public function posted_user()
    {
        $user = User::find($this->user_id);
        return isset($user)?$user->name:"Anonimous";
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

    public function get_body()
    {
        return Markdown::convertToHtml($this->body);
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
