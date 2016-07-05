<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Str;
use DB;

function get_fcontent( $url,  $javascript_loop = 0, $timeout = 5 ) {
  $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_REFERER, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
return $result;
}
class MyList extends Model
{
    //

    public function user() {
      return $this->belongsTo('App\User');
    }

    public static function addToList($title, $book_id, $user_id, $rating, $state, $thumbnail) {
      $check = DB::table('mylists')->where([['user_id', $user_id],['slug', str_slug($title, '+')],])->value('slug');
      if($check == str_slug($title, '+'))
        return false;
      return DB::table('mylists')->insert(
      ['title' => $title, 'slug' => str_slug($title, '+'), 'book_id' => $book_id, 'user_id' => $user_id, 'rating' => $rating, 'state' => $state, 'thumbnail' => $thumbnail]
    );
    }

    public static function searchBook($book, $author) {
      $url = "https://www.googleapis.com/books/v1/volumes?q=";
      $APIKey = "AIzaSyBMSskIwQgSzn6WZyLyhOYjehdUEFAWb0o";
      $author = "+inauthor:".str_slug($author, "+");
      $key = "&key=".$APIKey;
      $book = str_replace(' ', '+', str_slug($book, "+"));
      $rep = str_slug($book, "+");

      try {
        if(!$author == "+inauthor:author+optional") {
          $json = get_fcontent($url.str_slug($rep, "+").$author.$key);
          //echo $json_decode($json);
        } else {
          //echo str_slug($book, "+");
          $json = get_fcontent($url.str_slug($rep, "+").$key);
          //echo print_r($json);
        }
      }

      catch(Exception $e) {
        echo 'Message: '.$e->getMessage();
      }
      if($json)
        return $json;
    }
}
