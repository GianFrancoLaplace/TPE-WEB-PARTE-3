<?php

include_once 'config.php';

function base64url_encode($data) { 
    //cadena codificada en Base64 
    $base64 = base64_encode($data);
    
    //Los caracteres '+' y '/' son reemplazados por '-' y '_'
    $base64url = strtr($base64, '+/', '-_');

    //Se elimina l carácter de relleno '=' utilizado al final
    return rtrim($base64url, '=');
}

//strtr(string translate) realizar la sustitución de caracteres o conjunto de caracteres en una cadena


class TokenApiHelper {

    public static function getAuthHeaders() { //devolver header de autenticacion
        $header = "";
        //hay dos lugares para buscar
        if(isset($_SERVER['HTTP_AUTHORIZATION']))
            $header = $_SERVER['HTTP_AUTHORIZATION'];
        if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        return $header;
    }

    public static function createToken($payload) {
        //token se compone de 3 partes:
        
        ///Parte 1 : header => encabezado
        $header = array(
            'alg' => 'HS256',
            'typ' => 'JWT'
        );

        ///Parte 2: payload => info util de userData
        $expirationTime = time() + JWT_EXP;
        $payload['exp'] = $expirationTime; 
        
        //primero convertimos el arreglo en json luego convertimos en string de json
        $header = base64url_encode(json_encode($header)); 
        $payload = base64url_encode(json_encode($payload));

        //Parte 3: signature => firma
        $signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
        $signature = base64url_encode($signature);

        $token = "$header.$payload.$signature";

        return $token;
    }

    public static function verifyToken($token) {
        //$header.$payload.$signature
        $token = explode(".",$token);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];

        //firmo denuevo el token
        $new_signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
        $new_signature = base64url_encode($new_signature);

        //y comparo para ver si son iguales

        if($signature!=$new_signature){
            return false;
        }

        //si esta bien desarmo el payload
        $payload = json_decode(base64_decode($payload));
        if($payload->exp<time()){
            return false;
        }
        return $payload;
    }

    public static function currentUser(){
        $auth = TokenApiHelper::getAuthHeaders(); //Bearer $token
        $auth = explode(" ", $auth); //["Bearer", "$token"]

        if ($auth[0] != 'Bearer'){
            return false;
        }

        return TokenApiHelper::verifyToken($auth[1]);
    }
}