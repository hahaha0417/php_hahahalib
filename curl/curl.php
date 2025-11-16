<?php

namespace hahahalib;

// https://codertw.com/%E7%A8%8B%E5%BC%8F%E8%AA%9E%E8%A8%80/199253/
class curl
{
    use \hahahalib\instance;

    public $Curl;
    public $Is_Initial = false;

    public function Initial()
    {
        // if(!$this->Is_Initial)
        // {
        //     $this->Curl = curl_init();
        //     $this->Is_Initial = true;
        // }
        return $this;

    }

    /*
    $get_data []
    $options []
    https://www.php.net/manual/en/function.curl-exec.php *
    */
    public function Get($url, &$get_data, &$options )
    {
        $defaults = [
            CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($get_data),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 4
        ];
       
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if( ! $result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;

    }

    /*
    $post_data []
    $options []
    
    https://www.php.net/manual/en/function.curl-exec.php *
    */
    public function Post($url, &$post_data, &$options )
    {
        $defaults = [
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $url,
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 4,
            CURLOPT_POSTFIELDS => http_build_query($post_data)
        ];
    
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if( ! $result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;

    }

    public function Put($url, &$data, $size, &$information, $header = [] )
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_INFILE, $data);
        curl_setopt($ch, CURLOPT_INFILESIZE, $size);



        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);
        return $result;

    }


  
} 