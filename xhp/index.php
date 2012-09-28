<?php

require_once('init.php');

$href = 'http://www.facebook.com';
echo  <a href={$href}>Facebook</a>;


$items = array(1,2,3,4,5);

$list = <ul />;
foreach ($items as $item) {
	  $list->appendChild(<li>{$item}</li>);
}
