<?php
namespace macroseso\qvapay;
/**
 * QvaPay Payment Card library
 */
        class QvaPay
{

    // app_id / app?secret de QvaPay
    private $app_id = "";
    private $app_secret = "";
    private $base_url = "https://qvapay.com/api/v1/";


    /**
     * Constructor
     */
    public function __construct($app_id, $app_secret)
    {
        $this->app_id = $app_id;
        $this->app_secret = $app_secret;
    }

    public function balance(){
        
        $uri=$this->base_url.'balance';
        
              $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri.'?app_id='.$this->app_id.'&app_secret='.$app_secret);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE, true);
        if($code==200){
            $response=json_decode($result);
        }else{
            echo 'error de pago';
        } 
        curl_close($ch);
        
        return $response;
    }
    
    /*
    amount == Precio
    $descripcion = nombre del producto o servicio 
    $remote_id = numero de factura del sitio (no requerido)
    signed= url firmada, el el]nlace de pago tiene vencimiento Bool
    
    */
    
    public function createInvoice($amount, $description, $remote_id){
        
        $uri=$this->base_url.'create_invoice';
        
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri.'?app_id='.$this->app_id.'&app_secret='.$app_secret.'&amount='.$amount.'&description='.$description.'remote_id='.$remote_id.'&signed=true');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $result = curl_exec($ch);
        $error = curl_error($ch);
        $erno = curl_errno($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($code==200){
            $response=json_decode($result);
        }else{
            $response=$code;
        } 
        curl_close($ch);
        
        return $response;
    }















}
