<?php
namespace baseHandle;

class BaseHandle{
    function generateHmacSha256Hex($data, $key) {
        $hmac = hash_hmac('sha256', $data, $key, true);
        return bin2hex($hmac);
    }

    function getServiceCode($phone) {

        $serviceCode = "";
        $codeType = "";

        if (substr((string)$phone, 0, 2) === "69") {
            $serviceCode = "PAIEMENTMARCHAND_ORANGE_CM";
            $codeType = "#150*50#";
        }elseif(substr((string)$phone, 0, 2) === "67"){
            $serviceCode = "PAIEMENTMARCHAND_MTN_CM";
            $codeType = "*126#";
        } 
        elseif(substr((string)$phone, 0, 3) > '654' && substr((string)$phone, 0, 3) < '660'){
            $serviceCode = "PAIEMENTMARCHAND_ORANGE_CM";
            $codeType = "#150*50#";
        }
        elseif(substr((string)$phone, 0, 3) < '655' && substr((string)$phone, 0, 3) > '649'){
            $serviceCode = "PAIEMENTMARCHAND_MTN_CM";
            $codeType = "*126#";
        }
        else {
            $serviceCode = "PAIEMENTMARCHAND_MTN_CM";
            $codeType = "*126#";
        }
        return [
            "serviceCode" => $serviceCode,
            "codeType" => $codeType,
        ];
    }

}

?>