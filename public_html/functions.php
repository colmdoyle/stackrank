<?php

//Rank that shit.

define("STACK_API_KEY","<STACKOVERFLOW_API_KEY_HERE>");
define("STACK_API_URL","http://api.stackoverflow.com/1.1");

function curPageURL() {
   $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
       $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
         } else {
             $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
              }
    return $pageURL;
}


function curl_call($url) {

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_ENCODING , "gzip");

  $payload = curl_exec($ch);

  curl_close($ch);

  return $payload;
}

function getFbTags() {
  /*
   * Returns a Semicolon delimited list of tags matching 'facebook'
   */

  $url = STACK_API_URL.'/tags?filter=facebook&pagesize=100&key='.STACK_API_KEY;

  $data_array = json_decode(curl_call($url), 1);
  $tag_array = $data_array['tags'];

  return $tag_array;
}

function getReputation($ids) {

  $id_string = '';

  foreach ($ids as $id)
  {
    $id_string .= $id . ';';
  }

  $url = STACK_API_URL.'/users/'.$id_string;

  $url = rtrim($url,';');

  $url .= '?order=asc&pagesize=100&key=FyEi2ptqSEaN4DisQ4udUA';

  $payload = json_decode(curl_call($url),1);
  if(!empty($payload['total'])) {
    $count = $payload['total'];
    $count--;
  } else {
    $count = 0;
    die('no results');
  }

  while($count >= 0)
  {

    $name = $payload['users'][$count]['display_name'];
    $rep = $payload['users'][$count]['reputation'];
    $answers = $payload['users'][$count]['answer_count'];
    $user_id = $payload['users'][$count]['user_id'];

    $results_array[$count] = array(
      "name" => $name,
      "rep" => $rep,
      "answers" => $answers,
      "user_id" => $user_id,
    );

    $count--;

  }

  return $results_array;

}
