<?php 

$page_content = "We are going to extract shortcodes in core PHP<br/>";
$page_content .= "[crest_directory order_by=date order_type=desc limit=5]<br/>";
$page_content .= "Let me add one more shortcode here<br/>";
$page_content .= "[crest_events ids=1,2,3,4]<br/>";

echo "Page Content<br/><br/>";
echo $page_content;


$shortcodes = array('crest_directory','crest_events','crest_news');
foreach($shortcodes as $shortcode){
	$regex_pattern ='\[(\[?)('.$shortcode.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
	
	if (preg_match ('/'.$regex_pattern.'/s', $page_content, $matches)){
		
		$keys = array();
		$result = array();
		$result['code'] = $matches[2];
		$get = str_replace(" ", "&" , $matches[3]);
		parse_str($get, $output);
	
		//get all shortcode attribute keys
		$keys = array_unique( array_merge(  $keys, array_keys($output)) );
		$result['attr'] = $output;
		echo "<pre>"; print_r($result);
	
	
	}
}
//echo "<pre>"; print_r($regex_matches); exit;

?>