<?php

/*
 *  Namirial ESP Client
 *  Doc
 */
class esp_client {

    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $env;
    /**
     * @var string
     */
    private $final;
    /**
     * @var string
     */
    private $apikey;
    /**
     * @var integer
     */
    private $level;
    /**
     * @var string
     */
    private $att;
    /**
     * @var string
     */
    private $spidtype;

    /**
     * @var string[][]
     */
    private $headers;

    function __construct(){
        $this->host = get_option('esp_host');
        $this->env = get_option('esp_env');
        $this->final = get_option('esp_final');
        $this->apikey = get_option('esp_apikey');
        $this->level = get_option('esp_level');
        $this->att = get_option('esp_attributes');
        $this->spidtype = get_option('esp_spidtype');
        $this->headers = array(
//            'sslverify' => false,
            'headers' => array(
                'Esp-Api-Key' => $this->apikey
            )
        );
    }

    /**
     * @return string
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @return string
     */
    public function getKey(){
        try {
            $url = $this->host . '/api/secure/' . $this->env . '/getkey';
//            return $url;
            $response = wp_remote_get( $url, $this->headers);
//            return $response;
            if ( ( !is_wp_error($response)) && (200 === wp_remote_retrieve_response_code( $response ) ) ) {
//                $responseBody = json_decode($response['body']);
                $responseBody = $response['body'];
                if( json_last_error() === JSON_ERROR_NONE ) {
                    //Do your thing.
                    return $responseBody;
                }
                return $responseBody;
            }
        } catch( Exception $ex ) {
            //Handle Exception.
            return $ex->getMessage();
        }

    }

    /**
     * @param $authnKey string
     * @return string
     */
    public function getLoginUrl($authnKey){
        return $this->host . '/' . $this->env . '/spidlogin?authnKey=' . $authnKey . '&final=' . $this->final;
    }

    /**
     * @param $id string
     * @param $key string
     * @return string
     */
    public function getUser($id, $key){
        try {
            $url = $this->host . '/api/secure/' . $this->env . '/getuser?ID=' . $id . '&key=' . $key;
            $response = wp_remote_get( $url, $this->headers);
            if ( ( !is_wp_error($response)) && (200 === wp_remote_retrieve_response_code( $response ) ) ) {
                $responseBody = $response['body'];
                $content = explode('.', $responseBody)[1];
                $json = base64_decode($content);
                return json_decode($json);
            }
        } catch( Exception $ex ) {
            //Handle Exception.
            return $ex->getMessage();
        }

    }
}