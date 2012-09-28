<?php

include_once('../xhp/init.php');
require_once('functions.php');

$title = 'StackRank 1.0';
$home = 'http://stackrank.fbdublin.com';

$fb_team = array(
  '851643',
	'128035',
  '596554',
  '508382',
  '854536',
  '1628782',
  '1566636',
  '1081504',
  '470877',
  '89593',
  '850495',
  '855298',
  '469456',
  '434112',
  '426839',
  '850730',
  '362728',
  '851006',
  '21062',
  '851727',
  '850494',
  '851194',
  '90025',
  '860483',
  '850493',
  '207672',
  '850947',
  '850570',
  '850573',
  '854782',
  '851019',
  '860170',
  '581371',
  '318666',
  '851657',
	'166535',
);

$likebtn =
  <iframe src="http://www.facebook.com/plugins/like.php?app_id=240541359300868&amp;href=http%3A%2F%2Fstackrank.fbdublin.com&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>;

$fb_div = <div id="fb-root"></div>;
$script = <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>;
$head =
  <head>
    <title>{$title}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta property="og:title" content="StackRank" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content={"$home"} />
    <meta property="og:image" content={"$home/ifstph.png"} />
    <meta property="og:site_name" content="StackRank" />
    <meta property="fb:admins" content="260300016" />
    <link rel="stylesheet" type="text/css"
      href="http://colmd.fbdublin.com/blueprint-css/blueprint/screen.css" />
    <link rel="stylesheet" type="text/css"
      href="http://stackrank.fbdublin.com/css/custom.css" />
    </head>;

$opening_header = <a href={$home}><h1>{$title}</h1></a>;

$opening_p = 'Everyone loves a bit of competition'.
  ' and we\'re no different';

$top_h2 =
    <h2 class="alt">{$opening_p}</h2>;

$stats =
  <iframe src="http://soflow.goodostuff.com/count/sr/" height="600"></iframe>;

$scoreboard = getReputation($fb_team);

  $tbody = <tbody />;
  $tbody->appendChild(
    <tr>
      <td>Name</td>
      <td>Rep</td>
      <td>Number of Answers</td>
    </tr>
  );
  foreach ($scoreboard as $entry) {
    $profile_url = 'http://stackoverflow.com/users/' . $entry['user_id'];
    $tbody->appendChild(
      <tr>
        <td>
          <a href={$profile_url}>
            {$entry['name']}
          </a>
        </td>
        <td>{$entry['rep']}</td>
        <td>{$entry['answers']}</td>
      </tr>
    );
  }

  $footermsg = 'Carthago delenda est';

  $footer =
    <div class="span-24">
      <h3 class="alt prepend-10 clearfix">{$footermsg}</h3>
    </div>;
// Assemble the page below

echo
<html>
  {$head}
  {$fb_div}
  {$script}
  <body>
  <div class="container">
    <div id="top" class="span-24">
      {$opening_header}
      {$top_h2}
      {$likebtn}
    </div>
    <div id="left" class="span-11">
    <table>
      {$tbody}
      </table>
    </div>
    <div id="right" class="span-13 last">
      {$stats}
      <fb:comments href={"$home"} num_posts="10" width="425"/>
    </div>
  {$footer}
  </div>
  </body>
</html>;

