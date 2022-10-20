<?php
# ------------------------------
# START CONFIGURATION SECTION		https://gist.github.com/matthanger/1171921
#

/*
			[oauth_version] => 1.0
			[oauth_nonce] => fc0f044f664f3ef85421c92069b6fdd2
			[oauth_timestamp] => 1568295344
			[oauth_consumer_key] => demotest
			[user_id] => 4
			[lis_person_sourcedid] => 
			[roles] => Instructor
			[context_id] => 2
			[context_label] => corso_demo
			[context_title] => corso_demo
			[resource_link_title] => prova LTI
			[resource_link_description] => 
			[resource_link_id] => 1
			[context_type] => CourseSection
			[lis_course_section_sourcedid] => 
			[lis_result_sourcedid] => {"data":{"instanceid":"1","userid":"4","typeid":null,"launchid":588518499},"hash":"5f3df2e63c4a885bad89706669599b8cf139e68d074b548cdc53ddb2acc25234"}
			[lis_outcome_service_url] => https://dt.unitus.it/else/mod/lti/service.php
			[lis_person_name_given] => Teacher
			[lis_person_name_family] => ELSE
			[lis_person_name_full] => Teacher ELSE
			[ext_user_username] => else_teacher
			[lis_person_contact_email_primary] => teacher@else.eu
			[launch_presentation_locale] => en
			[ext_lms] => moodle-2
			[tool_consumer_info_product_family_code] => moodle
			[tool_consumer_info_version] => 2019052002
			[oauth_callback] => about:blank
			[lti_version] => LTI-1p0
			[lti_message_type] => basic-lti-launch-request
			[tool_consumer_instance_guid] => dt.unitus.it
			[tool_consumer_instance_name] => ELSE_dev_platform
			[tool_consumer_instance_description] => ELSE_development
			[launch_presentation_document_target] => window
			[launch_presentation_return_url] => https://dt.unitus.it/else/mod/lti/return.php?course=2&launch_container=4&instanceid=1&sesskey=iJiXK5E01u
			[oauth_signature_method] => HMAC-SHA1
			[oauth_signature] => LALOTb5Vdsy6G5z7Fk4j7nIinhY=

*/


$launch_url = "https://else.entropylearningplatform.it/moodleT.php";
$key = "E2SystemsConsumerKey";
$secret = "63736373";
$launch_data = array(
        "user_id" => "2",
        "roles" => "1",
);
#
# END OF CONFIGURATION SECTION
# ------------------------------
date_default_timezone_set("Europe/London");
$now = new DateTime();
$launch_data["lti_version"] = "LTI-1p0";
$launch_data["lti_message_type"] = "basic-lti-launch-request";
# Basic LTI uses OAuth to sign requests
# OAuth Core 1.0 spec: http://oauth.net/core/1.0/
$launch_data["oauth_callback"] = "about:blank";
$launch_data["oauth_consumer_key"] = $key;
$launch_data["oauth_version"] = "1.0";
$launch_data["oauth_nonce"] = uniqid('', true);
$launch_data["oauth_timestamp"] = $now->getTimestamp();
$launch_data["oauth_signature_method"] = "HMAC-SHA1";
# In OAuth, request parameters must be sorted by name
$launch_data_keys = array_keys($launch_data);
sort($launch_data_keys);
$launch_params = array();
foreach ($launch_data_keys as $key) {
  array_push($launch_params, $key . "=" . rawurlencode($launch_data[$key]));
}
$base_string = "POST&" . urlencode($launch_url) . "&" . rawurlencode(implode("&", $launch_params));
$secret1 = urlencode($secret) . "&";
$signature = base64_encode(hash_hmac("sha1", $base_string, $secret1, true));



?>

<html>
<head></head>
<!-- <body onload="document.ltiLaunchForm.submit();"> -->
<body>
<pre>
<?php 


$launch_dataR=$_POST;
unset ($launch_dataR["oauth_signature"]);
//$launch_dataR["submit"]="Launch";

print_r($_POST);

$launch_data_keysR = array_keys($launch_dataR);
sort($launch_data_keysR);
$launch_paramsR = array();
foreach ($launch_data_keysR as $key) {
  array_push($launch_paramsR, $key . "=" . rawurlencode($launch_dataR[$key]));
}
$base_stringR = "POST&" . urlencode($launch_url) . "&" . rawurlencode(implode("&", $launch_paramsR));
$secretR = urlencode($secret) . "&";
$signatureR = base64_encode(hash_hmac("sha1", $base_stringR, $secretR, true));
echo "<br>\$signatureR $signatureR ";
?>
</pre>
<form id="ltiLaunchForm" name="ltiLaunchForm" method="POST" action="<?php printf($launch_url); ?>">
<?php foreach ($launch_data as $k => $v ) { ?>
        <input type="text" name="<?php echo $k ?>" value="<?php echo $v ?>">
<?php } ?>
<br>
oauth_signature:
        <input type="text"  size ="32" name="oauth_signature" value="<?php echo $signature ?>">
        <button type="submit">Launch</button>
</form>
</body>
</html>