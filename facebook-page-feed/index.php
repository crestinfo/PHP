<?php 
include("facebook/autoload.php");

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

$app_id ="FB_APP_ID";
$app_secrete ="FB_APP_SECRETE";
$access_token ="FB_ACCESS_TOKEN";
$page_id = "FB_PAGEID";
FacebookSession::setDefaultApplication($app_id, $app_secrete);

$session = new FacebookSession($access_token);

// Get the GraphUser object for the current user:

try {
$request = new FacebookRequest(
  $session,
  'GET',
  '/'.$page_id.'/feed?limit=3&fields=type,message,id,story,link,picture,attachments'
);
$response = $request->execute();
$facebookObj = $response->getGraphObject();
$facebookData = $facebookObj->asArray();
$facebookPosts = $facebookData["data"];
echo "<pre>"; print_r($facebookPosts);

} catch (FacebookRequestException $e) {
 
} catch (\Exception $e) {
}

?>