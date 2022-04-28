<?php

class jwt_helper extends CI_Controller
{
    const CONSUMER_KEY = 'gmediaJogja2018*';
    const CONSUMER_SECRET = '5963551b2b46bcb99e40a7d03d414ac0';
    const CONSUMER_TTL = 86400; // second

    // create token
    public static function create($userid=0, $params=array(), $algo = 'HS256')
    {
        $CI =& get_instance();
        $CI->load->library('jwt');
        $token = $CI->jwt->encode(array(
            // 'consumerKey' => self::CONSUMER_KEY,
            'userId' => $userid,
            'sub'  => $params,
            // 'iat' => date(DATE_ISO8601, strtotime("now")),
            'iat'   => time(),
        ), self::CONSUMER_SECRET, $algo);
        return $token;
    }

    // validate token
    public static function validate($token)
    {
        $CI =& get_instance();
        $CI->load->library('jwt');
        try {
            $decodeToken = $CI->jwt->decode($token, self::CONSUMER_SECRET);
            // validate token is not expired
            // $ttl_time = strtotime($decodeToken->iat);
            // $now_time = strtotime(date(DATE_ISO8601, strtotime("now")));
            $ttl_time = $decodeToken->iat;
            $now_time = time();
            if(($now_time - $ttl_time) > self::CONSUMER_TTL) {
                throw new Exception('Expired');
            } else {
                return true;
            }
        } catch (Exception $e) {
            return false;
        }

    }

    // refresh token
    public static function refresh($old_token)
    {
        $CI =& get_instance();
        $CI->load->library('jwt');
        try {
            $decodeToken = $CI->jwt->decode($old_token, self::CONSUMER_SECRET);
            $arrayDecodeToken = json_decode(json_encode($decodeToken), true);
            $arrayDecodeToken['iat'] = time();
            $token = $CI->jwt->encode($arrayDecodeToken, self::CONSUMER_SECRET);
            return $token;
        } catch (Exception $e) {
            return false;
        }

    }

    // refresh token
    public static function update($old_token, $sub = array() )
    {
        $CI =& get_instance();
        $CI->load->library('jwt');
        try {
            $decodeToken = $CI->jwt->decode($old_token, self::CONSUMER_SECRET);
            $arrayDecodeToken = json_decode(json_encode($decodeToken), true);
            $arrayDecodeToken['sub'] = $sub;
            $arrayDecodeToken['iat'] = time();
            $token = $CI->jwt->encode($arrayDecodeToken, self::CONSUMER_SECRET);
            return $token;
        } catch (Exception $e) {
            return false;
        }

    }

    // decode token
    public static function decode($token)
    {
        $CI =& get_instance();
        $CI->load->library('JWT');
        try {
            $decodeToken = $CI->jwt->decode($token, self::CONSUMER_SECRET);
            return $decodeToken;
        } catch (Exception $e) {
            return false;
        }
    }
}