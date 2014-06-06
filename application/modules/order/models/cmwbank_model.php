<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*   @model: Cmwbank_model: Virtual Payment Client for Commonwealth Bank
**/

// Define URLs for Payment Server URL
define('VPC2_URL', 'https://migs.mastercard.com.au/vpcdps'); # 2-party (merchant hosted) transactions.
define('VPC3_URL', 'https://migs.mastercard.com.au/vpcpay'); # 3-party (CommWeb hosted) transactions.
// passinglane / pr0passl4n3x  access

// m0r3c4sh
// Define Access Code
define('ACCESS_CODE', 'E330A7C4'); #  Live mode: FAE163FC
define('MERCHANT_ID', 'TESTEDSONICOM01'); # Live mode: EDSONICOM01

class cmwbank_model extends CI_Model {

    var $data = array();
    var $vpcURL = '';

    function init() {
        $this->data = array(
            'vpc_Version' => 1,
            'vpc_Command' => 'pay',
            'vpc_AccessCode' => ACCESS_CODE,
            'vpc_MerchTxnRef' => '',
            'vpc_Merchant' => MERCHANT_ID,
            'vpc_OrderInfo' => '',
            'vpc_Amount' => '',
            'vpc_CardNum' => '',
            'vpc_CardExp' => '',
            'vpc_CardSecurityCode' => ''
            );
        $this->vpcURL = VPC2_URL;
    }

    function add_data($input_key, $input_value) {
        foreach($this->data as $key => $value) {
            if ($key == $input_key) {
                $this->data[$key] = $input_value;
            }
        }
    }

    function process() {
        $postData = "";
        $ampersand = "";
        foreach($this->data as $key => $value) {
            if (strlen($value) > 0) {
                $postData .= $ampersand . urlencode($key) . '=' . urlencode($value);
                $ampersand = "&";
            }
        }


        // Get a HTTPS connection to VPC Gateway and do transaction
        // turn on output buffering to stop response going to browser
        ob_start();

        // initialise Client URL object
        $ch = curl_init();

        // set the URL of the VPC
        curl_setopt ($ch, CURLOPT_URL, $this->vpcURL);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData);

        // (optional) set the proxy IP address and port
        // curl_setopt ($ch, CURLOPT_PROXY, "YOUR_PROXY:PORT");

        // (optional) certificate validation
        // trusted certificate file
        //curl_setopt($ch, CURLOPT_CAINFO, "c:/temp/ca-bundle.crt");

        //turn on/off cert validation
        // 0 = don't verify peer, 1 = do verify
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // 0 = don't verify hostname, 1 = check for existence of hostame, 2 = verify
        //curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 2);

        // connect
        curl_exec ($ch);

        // get response
        $response = ob_get_contents();

        // turn output buffering off.
        ob_end_clean();

        // set up message paramter for error outputs
        $message = "";

        // serach if $response contains html error code
        if(strchr($response,"<html>") || strchr($response,"<html>")) {
            $message = $response;
        } else {
            // check for errors from curl
            if (curl_error($ch))
                $message = "curl_errno=". curl_errno($ch) . "<br/>" . curl_error($ch);
        }

        // close client URL
        curl_close ($ch);

        // Extract the available receipt fields from the VPC Response
        // If not present then let the value be equal to 'No Value Returned'
        $map = array();

        // process response if no errors
        if (strlen($message) == 0) {
            #$pairArray = split("&", $response);
            $pairArray = explode("&", $response);
            foreach ($pairArray as $pair) {
                #$param = split("=", $pair);
                $param = explode("=", $pair);
                $map[urldecode($param[0])] = urldecode($param[1]);
            }
            $message = $this->null2unknown($map, "vpc_Message");
        }

        $amount          = $this->null2unknown($map, "vpc_Amount");
        $locale          = $this->null2unknown($map, "vpc_Locale");
        $batchNo         = $this->null2unknown($map, "vpc_BatchNo");
        $command         = $this->null2unknown($map, "vpc_Command");
        $version         = $this->null2unknown($map, "vpc_Version");
        $cardType        = $this->null2unknown($map, "vpc_Card");
        $orderInfo       = $this->null2unknown($map, "vpc_OrderInfo");
        $receiptNo       = $this->null2unknown($map, "vpc_ReceiptNo");
        $merchantID      = $this->null2unknown($map, "vpc_Merchant");
        $authorizeID     = $this->null2unknown($map, "vpc_AuthorizeId");
        $transactionNr   = $this->null2unknown($map, "vpc_TransactionNo");
        $acqResponseCode = $this->null2unknown($map, "vpc_AcqResponseCode");
        $txnResponseCode = $this->null2unknown($map, "vpc_TxnResponseCode");

        // CSC Receipt Data
        $cscResultCode   = $this->null2unknown($map, "vpc_CSCResultCode");
        $cscACQRespCode  = $this->null2unknown($map, "vpc_AcqCSCRespCode");

        // AVS Receipt Data
        $avsResultCode   = $this->null2unknown($map, "vpc_AVSResultCode");
        $vACQAVSRespCode = $this->null2unknown($map, "vpc_AcqAVSRespCode");
        $avs_City        = $this->null2unknown($map, "vpc_AVS_City");
        $avs_Country     = $this->null2unknown($map, "vpc_AVS_Country");
        $avs_Street01    = $this->null2unknown($map, "vpc_AVS_Street01");
        $avs_PostCode    = $this->null2unknown($map, "vpc_AVS_PostCode");
        $avs_StateProv   = $this->null2unknown($map, "vpc_AVS_StateProv");
        $avsRequestCode  = $this->null2unknown($map, "vpc_AVSRequestCode");

        // Show 'Error' in title if an error condition
        $errorTxt = "";
        // Show the display page as an error page
        if ($txnResponseCode == "7" || $txnResponseCode != "No Value Returned") {
            $errorTxt = "Error ";
        }
        $results = array(
            'version' => $version,
            'command' => $command,
            #'merchTxnRef' => $merchTxnRef,
            'merchantID' => $merchantID,
            'orderInfo' => $orderInfo,
            'amount' => $amount,
            'txnResponseCode' => $txnResponseCode,
            'txnResponseCodeDesc' => $this->getResponseDescription($txnResponseCode),
            'message' => $message
            );
        if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned")
        {
            $results['receiptNo'] = $receiptNo;
            $results['transactionNr'] = $transactionNr;
            $results['acqResponseCode'] = $acqResponseCode;
            $results['authorizeID'] = $authorizeID;
            $results['batchNo'] = $batchNo;
            $results['cardType'] = $cardType;
            $results['cscACQRespCode'] = $cscACQRespCode;
            $results['cscResultCode'] = $cscResultCode;
            $results['cscResultCodeDesc'] = $this->displayCSCResponse($cscResultCode);
            $results['avs_Street01'] = $avs_Street01;
            $results['avs_City'] = $avs_City;
            $results['avs_StateProv'] = $avs_StateProv;
            $results['avs_PostCode'] = $avs_PostCode;
            $results['avs_Country'] = $avs_Country;
            $results['vACQAVSRespCode'] = $vACQAVSRespCode;
            $results['avsResultCode'] = $avsResultCode;
            $results['avsResultCodeDesc'] = $this->displayAVSResponse($avsResultCode);
        }
        return $results;
    }

    // This method uses the QSI Response code retrieved from the Digital
    // Receipt and returns an appropriate description for the QSI Response Code
    //
    // @param $responseCode String containing the QSI Response Code
    //
    // @return String containing the appropriate description

    function getResponseDescription($responseCode) {

        switch ($responseCode) {
            case "0" : $result = "Transaction Successful"; break;
            case "?" : $result = "Transaction status is unknown"; break;
            case "1" : $result = "Unknown Error"; break;
            case "2" : $result = "Bank Declined Transaction"; break;
            case "3" : $result = "No Reply from Bank"; break;
            case "4" : $result = "Expired Card"; break;
            case "5" : $result = "Insufficient funds"; break;
            case "6" : $result = "Error Communicating with Bank"; break;
            case "7" : $result = "Payment Server System Error"; break;
            case "8" : $result = "Transaction Type Not Supported"; break;
            case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
            case "A" : $result = "Transaction Aborted"; break;
            case "C" : $result = "Transaction Cancelled"; break;
            case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
            case "F" : $result = "3D Secure Authentication failed"; break;
            case "I" : $result = "Card Security Code verification failed"; break;
            case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
            case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
            case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
            case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
            case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
            case "T" : $result = "Address Verification Failed"; break;
            case "U" : $result = "Card Security Code Failed"; break;
            case "V" : $result = "Address Verification and Card Security Code Failed"; break;
            default  : $result = "Unable to be determined";
        }
        return $result;
    }

    // This function uses the QSI AVS Result Code retrieved from the Digital
    // Receipt and returns an appropriate description for this code.

    // @param vAVSResultCode String containing the QSI AVS Result Code
    // @return description String containing the appropriate description

    function displayAVSResponse($avsResultCode) {

        if ($avsResultCode != "") {
            switch ($avsResultCode) {
                Case "Unsupported" : $result = "AVS not supported or there was no AVS data provided"; break;
                Case "X"  : $result = "Exact match - address and 9 digit ZIP/postal code"; break;
                Case "Y"  : $result = "Exact match - address and 5 digit ZIP/postal code"; break;
                Case "S"  : $result = "Service not supported or address not verified (international transaction)"; break;
                Case "G"  : $result = "Issuer does not participate in AVS (international transaction)"; break;
                Case "A"  : $result = "Address match only"; break;
                Case "W"  : $result = "9 digit ZIP/postal code matched, Address not Matched"; break;
                Case "Z"  : $result = "5 digit ZIP/postal code matched, Address not Matched"; break;
                Case "R"  : $result = "Issuer system is unavailable"; break;
                Case "U"  : $result = "Address unavailable or not verified"; break;
                Case "E"  : $result = "Address and ZIP/postal code not provided"; break;
                Case "N"  : $result = "Address and ZIP/postal code not matched"; break;
                Case "0"  : $result = "AVS not requested"; break;
                default   : $result = "Unable to be determined";
            }
        } else {
            $result = "null response";
        }
        return $result;
    }

    // This function uses the QSI CSC Result Code retrieved from the Digital
    // Receipt and returns an appropriate description for this code.

    // @param vCSCResultCode String containing the QSI CSC Result Code
    // @return description String containing the appropriate description

    function displayCSCResponse($cscResultCode) {

        if ($cscResultCode != "") {
            switch ($cscResultCode) {
                Case "Unsupported" : $result = "CSC not supported or there was no CSC data provided"; break;
                Case "M"  : $result = "Exact code match"; break;
                Case "S"  : $result = "Merchant has indicated that CSC is not present on the card (MOTO situation)"; break;
                Case "P"  : $result = "Code not processed"; break;
                Case "U"  : $result = "Card issuer is not registered and/or certified"; break;
                Case "N"  : $result = "Code invalid or not matched"; break;
                default   : $result = "Unable to be determined"; break;
            }
        } else {
            $result = "null response";
        }
        return $result;
    }

    // This method uses the verRes status code retrieved from the Digital
    // Receipt and returns an appropriate description for the QSI Response Code

    // @param statusResponse String containing the 3DS Authentication Status Code
    // @return String containing the appropriate description

    function getStatusDescription($statusResponse) {
        if ($statusResponse == "" || $statusResponse == "No Value Returned") {
            $result = "3DS not supported or there was no 3DS data provided";
        } else {
            switch ($statusResponse) {
                Case "Y"  : $result = "The cardholder was successfully authenticated."; break;
                Case "E"  : $result = "The cardholder is not enrolled."; break;
                Case "N"  : $result = "The cardholder was not verified."; break;
                Case "U"  : $result = "The cardholder's Issuer was unable to authenticate due to some system error at the Issuer."; break;
                Case "F"  : $result = "There was an error in the format of the request from the merchant."; break;
                Case "A"  : $result = "Authentication of your Merchant ID and Password to the ACS Directory Failed."; break;
                Case "D"  : $result = "Error communicating with the Directory Server."; break;
                Case "C"  : $result = "The card type is not supported for authentication."; break;
                Case "S"  : $result = "The signature on the response received from the Issuer could not be validated."; break;
                Case "P"  : $result = "Error parsing input from Issuer."; break;
                Case "I"  : $result = "Internal Payment Server system error."; break;
                default   : $result = "Unable to be determined"; break;
            }
        }
        return $result;
    }

    // This subroutine takes a data String and returns a predefined value if empty
    // If data Sting is null, returns string "No Value Returned", else returns input

    // @param $in String containing the data String
    // @return String containing the output String

    function null2unknown($map, $key) {
        if (array_key_exists($key, $map)) {
            if (!is_null($map[$key])) {
                return $map[$key];
            }
        }
        return "No Value Returned";
    }
}
