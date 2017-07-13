<?php 

$page_content = "We are going to extract shortcodes in core PHP<br/>";
$page_content .= "[crest_directory order_by=date order_type=desc limit=5]<br/>";
$page_content .= "[crest_directory order_by=id order_type=asc limit=10]<br/>";
$page_content .= "Let me add one more shortcode here<br/>";
$page_content .= "[crest_events ids=1,2,3,4]<br/>";

echo "Page Content<br/><br/>";
echo $page_content;


function do_shortcode($page_content){

	$shortcodes = array('crest_directory','crest_events','crest_news');
	
	foreach($shortcodes as $shortcode){
		
		$regex_pattern ='\[(\[?)('.$shortcode.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
		
		if (preg_match_all ('/'.$regex_pattern.'/s', $page_content, $matches)){
			//echo "<pre>"; print_r($matches); exit;
			for($index= 0; $index < count($matches[0]); $index++){		
				$keys = array();
				$result = array();
				$result['code'] = $matches[2][$index];
				$get = str_replace(" ", "&" , $matches[3][$index]);
				parse_str($get, $output);
			
				//get all shortcode attribute keys
				$keys = array_unique( array_merge(  $keys, array_keys($output)) );
				$result['attr'] = $output;
				echo "<pre>"; print_r($result);
			}
			
		}
	}
}

do_shortcode($page_content);
//echo "<pre>"; print_r($regex_matches); exit;

?>