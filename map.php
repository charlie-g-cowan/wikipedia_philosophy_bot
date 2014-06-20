<?php
	$title = $_GET['articletitle'];
	$article = unserialize(file_get_contents("http://en.wikipedia.org/w/api.php?format=php&action=query&titles=" . urlencode($title) . "&prop=revisions&rvprop=content&redirects=true"));
	$pageid = key($article['query']['pages']);
	echo $article['query']['pages'][$pageid]['title'];
	echo "<br>";
	echo $article['query']['pages'][$pageid]['pageid'];
	echo "<br>";
	$string = $article['query']['pages'][$pageid]['revisions']['0']['*'];

$paren_num = 0;
$chars = str_split($string);
$new_string = '';
foreach($chars as $char) {
    if($char=='{') $paren_num++;
    else if($char=='}') $paren_num--;
    else if($paren_num==0) $new_string .= $char;
}
$new_string = trim($new_string);

//Thanks to tyjkenn on Stack Overflow for help with a function that keeps track of brackets: http://stackoverflow.com/questions/2174362/remove-text-between-parentheses-php
$link = preg_match("/\[\[[\w\(\)\|\s\.\,\']+\]\]+(?![^\(]*\))/", $new_string, $matches[], PREG_OFFSET_CAPTURE);
echo "<br>";
echo substr($matches[0][0][0], 2, strlen($matches[0][0][0]) - 4);
//print_r($matches);
echo "<br>";
echo $link;
echo "<br>";
echo $new_string;
// \[\[[\w\(\)\|\s\.\,\']+\]\]+(?![^\[\[File:]*\]\])



?>
