<?php 
$str="dag@kreativinsikt.se:Stockholm66";
$my=base64_decode($str);
 $code="Basic ".$my;
$url="https://apitest.billecta.com/v1/authentication/apiauthenticate";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization:Basic $my",
    'Content-Length:0',
	'Accept: application/json'
    ));
$data = curl_exec($ch);
print_r($data);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
/*curl -X "POST"  -H "Content-Length:0" -H "Authorization: SecureToken NVVpczU0RW1RLzlqSnRHaFFvUzhLOXhIUnNNWFFoWmc9PQ==" -H "Accept: application/json"*/


 function CurlSendPostRequest($url,$request)
    {
        $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");

        $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => false,         // return web page
                CURLOPT_HEADER         => false,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
                CURLOPT_AUTOREFERER    => true,         // set referer on redirect
                CURLOPT_CONNECTTIMEOUT => 20,          // timeout on connect
                CURLOPT_TIMEOUT        => 20,          // timeout on response
                CURLOPT_POST            => 1,            // i am sending post data
                CURLOPT_POSTFIELDS     => $request,    // this are my post vars
                CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
                CURLOPT_SSL_VERIFYPEER => false,        //
                CURLOPT_VERBOSE        => 1,
                CURLOPT_HTTPHEADER     => array(
                    "Authorization: Basic $authentication",
                    "Content-Type: application/json",
					"Content-Length:0"
                )

        );
		print_r($options);

        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
$url="https://apitest.billecta.com/v1/authentication/apiauthenticate";
$output=CurlSendPostRequest($url,$request=array());
print_r($output);




?>