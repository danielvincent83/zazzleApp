	<?php 

    function is_logged_in(){
        return isset($_SESSION['username']);
    }


    function validate_user_creds($username, $password) {
        return ($username === USER1 && $password === USER1PASSWORD || $username === USER2 && $password === USER2PASSWORD || $username === USER3 && $password === USER3PASSWORD);
    }

    define('USER1', 'dvkdesigns');
    define('USER1PASSWORD', 'goal9121');

    define('USER2', 'vince');
    define('USER2PASSWORD', 'vf113869');

    define('USER3', 'justin');
    define('USER3PASSWORD', 'vince1138');

    $vendorid = "inkcorrect";
    $hash = "e4d905a155fa29fde1116542a639d1e7";

    function api_query($url) {
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_FAILONERROR, true); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   
        $result = curl_exec($curl); 
        return $result;
    }

    $results = api_query('https://vendor.Zazzle.com/v100/api.aspx?method=listneworders&vendorid='.$vendorid.'&hash='.$hash.'');
    
    function xml_to_string($results) {
        // Store XML String in Array
        $xml = simplexml_load_string($results);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }

    $array = xml_to_string($results);

    extract($array, EXTR_REFS);
    extract($Result, EXTR_REFS);
    extract($Orders, EXTR_REFS);
    extract($Order, EXTR_REFS);

    $colCount = count($Order);

     
    function md5hash($orderid, $type){
        $orderhash = hash('md5', 'inkcorrect' . $orderid . $type . '17072a61a625b9489c259feba4df46e7');
        return $orderhash;
    }

    function labelhash($orderid, $weight){
        $labelhash = hash('md5', 'inkcorrect' . $orderid . $weight . '17072a61a625b9489c259feba4df46e7');
        return $labelhash;
    }

    function voidlabelhash($tracking){
        $voidlabelhash = hash('md5', 'inkcorrect' . $tracking . '17072a61a625b9489c259feba4df46e7');
        return $voidlabelhash;
    }

    function set_AckOrder($url) {
        $curl = curl_init($url); 
        curl_setopt($curl, CURLOPT_FAILONERROR, true); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   
        $ackorder = curl_exec($curl); 
        return $ackorder;
    }