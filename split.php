<?php 
{"CreditorPublicId":"985966ad-a129-434b-a5bd-fe7ceed7af12","DebtorPublicId":"40b30193-71b5-4035-aacd-2fe68d43e98a","InvoiceDate":"2017-09-05 04:13:42","DueDate":"2017-09-07 04:13:42","DeliveryDate":null,"Records":[{"SequenceNo":0,"Units":"pairs","ArticleDescription":"Kreativ test product","Quantity":1,"UnitPrice":{"CurrencyCode":"SEK","Value":1600,"ValueForView":1600},"DiscountAmount":null,"DiscountPercentage":0,"DiscountType":"Amount","VAT":25,"VatIsIncluded":false,"Hidden":false,"TotalIncVAT":{"CurrencyCode":"SEK","Value":"400","ValueForView":"400"},"ProductPublicId":"da5b464a-9208-4f76-a5dd-4ff5f1482e32"}],"OurReference":"John Doe","DeliveryMethod":"Email","CommunicationLanguage":"SV","Message":"This is first invoice created by me ","InvoiceFee":null,"VatIsIncluded":false,"SendByMailIfEmailNotViewedInDays":null,"SplitInvoice":{"UseSplitInvoice":true,"NumberOfSplitInvoices":2,"SplitInvoiceDetails":[{"Text":"Invoice 1 of 2","DueDate":"2017-09-19 00:00:00+02:00","PeriodStart":null,"PeriodStop":null,"ReminderDate":null,"SendDate":null,"AmountOfArticle":{"Key":"0","Value":0.5}},{"Text":"Invoice 2 of 2","DueDate":"2017-10-19 00:00:00+02:00","PeriodStart":null,"PeriodStop":null,"ReminderDate":null,"SendDate":"2017-10-01 00:00:00+02:00","0":"AmountOfArticle"}]},"InvoicePDF":null,"CreditingInvoicePublicId":null,"ExternalReference":null}{"CreditorPublicId":"985966ad-a129-434b-a5bd-fe7ceed7af12","DebtorPublicId":"40b30193-71b5-4035-aacd-2fe68d43e98a","InvoiceDate":"2017-09-05 04:13:42","DueDate":"2017-09-07 04:13:42","DeliveryDate":null,"Records":[{"SequenceNo":0,"Units":"pairs","ArticleDescription":"Kreativ test product","Quantity":1,"UnitPrice":{"CurrencyCode":"SEK","Value":1600,"ValueForView":1600},"DiscountAmount":null,"DiscountPercentage":0,"DiscountType":"Amount","VAT":25,"VatIsIncluded":false,"Hidden":false,"TotalIncVAT":{"CurrencyCode":"SEK","Value":"400","ValueForView":"400"},"ProductPublicId":"da5b464a-9208-4f76-a5dd-4ff5f1482e32"}],"OurReference":"John Doe","DeliveryMethod":"Email","CommunicationLanguage":"SV","Message":"This is first invoice created by me ","InvoiceFee":null,"VatIsIncluded":false,"SendByMailIfEmailNotViewedInDays":null,"SplitInvoice":{"UseSplitInvoice":true,"NumberOfSplitInvoices":2,"SplitInvoiceDetails":[{"Text":"Invoice 1 of 2","DueDate":"2017-09-19 00:00:00+02:00","PeriodStart":null,"PeriodStop":null,"ReminderDate":null,"SendDate":null,"AmountOfArticle":{"Key":"0","Value":0.5}},{"Text":"Invoice 2 of 2","DueDate":"2017-10-19 00:00:00+02:00","PeriodStart":null,"PeriodStop":null,"ReminderDate":null,"SendDate":"2017-10-01 00:00:00+02:00","0":"AmountOfArticle"}]},"InvoicePDF":null,"CreditingInvoicePublicId":null,"ExternalReference":null}



$split=array("UseSplitInvoice"=>true,"NumberOfSplitInvoices"=>2,"SplitInvoiceDetails"=>array("0"=>array("Text"=>"Invoice 1 of 2","DueDate"=>"2017-09-19 00:00:00+02:00","PeriodStart"=>null,"PeriodStop"=>null,"ReminderDate"=>null,"SendDate"=>null,"AmountOfArticle"=>array("Key"=>"0","Value"=>0.5)),"1"=>array("Text"=>"Invoice 2 of 2","DueDate"=>"2017-10-19 00:00:00+02:00","PeriodStart"=>null,"PeriodStop"=>null,"ReminderDate"=>null,"SendDate"=>"2017-10-01 00:00:00+02:00","AmountOfArticle")));


$split=json_encode($split);
print_r($split);
exit;
$ch = curl_init("https://apitest.billecta.com/v1/invoice/attest/7545769088");
        $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
//Use the CURLOPT_PUT option to tell cURL that
//this is a PUT request.
curl_setopt($ch, CURLOPT_PUT, true);
curl_setopt($ch, CURLOPT_HEADER, true);
 
//We want the result / output returned.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				"Authorization: Basic $authentication"));

 
 
 $response = curl_exec($ch);
 $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 echo 'HTTP code: ' . $httpcode;
print_r($response);


 
 
 
exit;
function put_request($url,$request)
    {
       echo $authentication = base64_encode("dag@kreativinsikt.se:Stockholm66");
	   $ch = curl_init($url);
        $options = array(
                CURLOPT_RETURNTRANSFER => true,         // return web page
                CURLOPT_HEADER         => true,        // don't return headers
                CURLOPT_FOLLOWLOCATION => false,         // follow redirects
               // CURLOPT_ENCODING       => "utf-8",           // handle all encodings
			   CURLOPT_CUSTOMREQUEST =>"PUT",
                CURLOPT_HTTPHEADER     => array(
				"Authorization: Basic $authentication",
                    "Content-Type: application/json",
					"Content-Length:1000")    
        );
		//print_r($options);
        curl_setopt_array($ch,$options);
        $data = curl_exec($ch);
	
        $curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
        //echo $curl_errno;
        //echo $curl_error;
        curl_close($ch);
        return $data;
    }
	
	
echo $inv_url="https://apitest.billecta.com/v1/invoice/attest/9894431122";
	// $jsonDataEncoded=array();
// $jsonDataEncoded=json_encode($jsonDataEncoded);
	//$test_invoice=put_request($inv_url,$jsonDataEncoded);
	//print_r($test_invoice);

?>