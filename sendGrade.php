<?php
error_reporting(E_ALL ^ E_NOTICE);ini_set("display_errors",1);
include_once("config/config.inc.php");
//"\_lib\ims-lti-master\php-simple";

function callAPI($data, $metod="post",$url="https://dt.unitus.it/else/mod/lti/service.php"){
	if ($metod=="get") {
	   $curl = curl_init();
	   if (!$data["apiToken"]) $data["apiToken"]="web1.0"; 
		$url = sprintf("%s?%s", $url, http_build_query($data));
	   // OPTIONS:
	   curl_setopt($curl, CURLOPT_URL, $url);
	
	   
	   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		  'Content-Type: application/json',
	   ));
	   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	
	   // EXECUTE:
	   $result = curl_exec($curl);
	   if(!$result)		return ("Connection Failure");
	   curl_close($curl);
	   ///$result["url"]=$url;
	   $obj =json_decode($result);
	  $result= object2array($obj);
	   return $result["response"];
	}
	
	///////////////////////////////
	if ($metod=="post") {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, ($data));
		$response = curl_exec($ch);
		//$obj =json_decode($response);
//		$result= object2array($response);				
		return  $result;

		
	}
//   return $url;
}

$key = "demotest";
$secret = "09i1o22gx9t8hgwxjxcynvp3hjdvah4t";


require_once("_lib/ims-lti-master/php-simple/ims-blti/OAuthBody.php");
//echo "ciao";

/*
if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
 error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else { 
 error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
}
*/
$_REQUEST['key']="demotest";
$_REQUEST['secret']="09i1o22gx9t8hgwxjxcynvp3hjdvah4t";

//failure
//$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"409","userid":"5","typeid":"1","launchid":588518499},"hash":"5f3df2e63c4a885bad89706669599b8cf139e68d074b548cdc53ddb2acc25234"}';
//$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"409","userid":"5","typeid":null,"launchid":588518499},"hash":"5f3df2e63c4a885bad89706669599b8cf139e68d074b548cdc53ddb2acc25234"}';
//$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"409","userid":"5","typeid":null,"launchid":1193661300},"hash":"e4eee69ba6c1ad65981b497ed09a078322cb080ae16549a156ff55ae95c72240"}';

// success
$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"1","userid":"5","typeid":null,"launchid":1193661300},"hash":"e4eee69ba6c1ad65981b497ed09a078322cb080ae16549a156ff55ae95c72240"}';
// ??
$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"5","userid":"2","typeid":"2","launchid":695210416},"hash":"ec5c27d84418c8436de57fefe65a12cca344cee864aebedfc00c76c486d8e896"}';

$_REQUEST['lis_result_sourcedid']= '{"data":{"instanceid":"5","userid":"74","typeid":"2","launchid":84283086},"hash":"a599dbb9e66764c23ad7484448c262e1ab9c7cd0486f661ea4a6a031673751d3"}';

/*
function lti_build_sourcedid($instanceid, $userid, $servicesalt, $typeid = null, $launchid = null) {
    $data = new \stdClass();
    $data->instanceid = $instanceid;
    $data->userid = $userid;
    $data->typeid = $typeid;
    if (!empty($launchid)) {
        $data->launchid = $launchid;
    } else {
        $data->launchid = mt_rand();
    }
    $json = json_encode($data);
    $hash = hash('sha256', $json . $servicesalt, false);
    $container = new \stdClass();
    $container->data = $data;
    $container->hash = $hash;
    return json_encode(object2array($container));
}
$_REQUEST['lis_result_sourcedid']=lti_build_sourcedid(1, 5, "test",null, "1193661300");
*/

//$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"1","userid":"6","typeid":null,"launchid":1193661300},"hash":"e4eee69ba6c1ad65981b497ed09a078322cb080ae16549a156ff55ae95c72240"}';


//$_REQUEST['lis_result_sourcedid']='{"data":{"instanceid":"409","userid":"5","typeid":"1","launchid":588518499},"hash":"5f3df2e63c4a885bad89706669599b8cf139e68d074b548cdc53ddb2acc25234"}';

/*$_REQUEST['lis_result_sourcedid']=object2array(json_decode($_REQUEST['lis_result_sourcedid']));


$_REQUEST['lis_result_sourcedid']=array(
	"data"=>array(
	"instanceid"=>"1",
	"userid"=>"1",
	"typeid"=>null,
	"launchid"=>"588518499",
	),
"hash"=>"5f3df2e63c4a885bad89706669599b8cf139e68d074b548cdc53ddb2acc25234"
);


$_REQUEST['lis_result_sourcedid']=1;
*/
$_REQUEST['lis_outcome_service_url']="https://else.unitus.it/else/mod/lti/service.php";
$_REQUEST['grade']=0.6;

echo "<pre>".print_r($_REQUEST,true);

$method="POST";
$oauth_consumer_secret = $_REQUEST['secret'];

$sourcedid = $_REQUEST['lis_result_sourcedid'];
if (get_magic_quotes_gpc()) $sourcedid = stripslashes($sourcedid);
$oauth_consumer_key = $_REQUEST['key'];
$endpoint = $_REQUEST['lis_outcome_service_url'];
$content_type = "application/xml";

$body = '<?xml version = "1.0" encoding = "UTF-8"?>  
<imsx_POXEnvelopeRequest xmlns = "http://www.imsglobal.org/lis/oms1p0/pox">      
    <imsx_POXHeader>         
        <imsx_POXRequestHeaderInfo>            
            <imsx_version>V1.0</imsx_version>  
            <imsx_messageIdentifier>MESSAGE</imsx_messageIdentifier>         
        </imsx_POXRequestHeaderInfo>      
    </imsx_POXHeader>      
    <imsx_POXBody>         
        <OPERATION>            
            <resultRecord>
                <sourcedGUID>
                    <sourcedId>SOURCEDID</sourcedId>
                </sourcedGUID>
                <result>
                    <resultScore>
                        <language>en-us</language>
                        <textString>GRADE</textString>
                    </resultScore>
                </result>
            </resultRecord>       
        </OPERATION>      
    </imsx_POXBody>   
</imsx_POXEnvelopeRequest>';

if (isset($_REQUEST['grade'])) {
    $operation = 'replaceResultRequest';
    $postBody = str_replace(
    array('SOURCEDID', 'GRADE', 'OPERATION','MESSAGE'), 
    array($sourcedid, $_REQUEST['grade'], $operation, uniqid()),
    $body);
	
		echo '
		'.htmlentities($postBody);

} else {
    exit();
}

$response = sendOAuthBodyPOST($method, $endpoint, $oauth_consumer_key, $oauth_consumer_secret, $content_type, $postBody);
echo "
<strong>RESPONSE</strong>
";
print_r($response);
echo "

";


$xml = simplexml_load_string($response);
print_r($xml);
/*foreach ($xml->Formula as $element) {
    foreach($element->children() as $key => $val) {
        echo "{$key}: {$val}
";
    }
}
*/


//echo tmlentities($postBody)
/*
$G=callAPI(
"<?xml version = \"1.0\" encoding = \"UTF-8\"?>
<imsx_POXEnvelopeRequest xmlns=\"http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0\">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>999999123</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <replaceResultRequest>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>3124567</sourcedId>
        </sourcedGUID>
        <result>
          <!-- Added element -->
          <resultTotalScore>
            <language>en</language>
            <textString>50</textString>
          </resultTotalScore>
        </result>
      </resultRecord>
    </replaceResultRequest>
  </imsx_POXBody>
  </imsx_POXEnvelopeRequest>"
);
echo "<pre>aa";
//print_r($G);
/*
 lis_outcome_service_url =https://dt.unitus.it/else/mod/lti/service.php
 
 
 

https://canvas.instructure.com/doc/api/file.assignment_tools.html

<?xml version = "1.0" encoding = "UTF-8"?>
<imsx_POXEnvelopeRequest xmlns="http://www.imsglobal.org/services/ltiv1p1/xsd/imsoms_v1p0">
  <imsx_POXHeader>
    <imsx_POXRequestHeaderInfo>
      <imsx_version>V1.0</imsx_version>
      <imsx_messageIdentifier>999999123</imsx_messageIdentifier>
    </imsx_POXRequestHeaderInfo>
  </imsx_POXHeader>
  <imsx_POXBody>
    <replaceResultRequest>
      <resultRecord>
        <sourcedGUID>
          <sourcedId>3124567</sourcedId>
        </sourcedGUID>
        <result>
          <!-- Added element -->
          <resultTotalScore>
            <language>en</language>
            <textString>50</textString>
          </resultTotalScore>
        </result>
      </resultRecord>
    </replaceResultRequest>
  </imsx_POXBody>
</imsx_POXEnvelopeRequest>

*/
 ?>