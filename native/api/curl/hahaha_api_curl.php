<?php
/*
 * 原始 : hahaha
 * 維護 : 
 * 指揮 : 
 * ---------------------------------------------------------------------------- 
 * 決定 : name
 * ----------------------------------------------------------------------------
 * 說明 : 
 * ----------------------------------------------------------------------------   
    
 * ----------------------------------------------------------------------------

*/

namespace hahahalib;

/*
// 可以用來撈網頁

// http://lovetotally.pixnet.net/blog/post/10207504-%5B%E8%BD%89%E8%B2%BC%5D-php-curl-%E8%A9%B3%E8%A7%A3
// http://lovetotally.pixnet.net/blog/post/10207504-%5B%E8%BD%89%E8%B2%BC%5D-php-curl-%E8%A9%B3%E8%A7%A3
// 建立curl連線
$ch = curl_init();
// 設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com/");
curl_setopt($ch, CURLOPT_HEADER, false);
// 將獲取的訊息以文件流的形式返回，而不是直接輸出
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 執行
$temp = curl_exec($ch);

// 關閉curl連線
curl_close($ch);

echo $temp;


// -------------------------------------------------------- 



// // cURL GET request
// $get_data = callAPI('GET', 'https://api.example.com/get_url/'.$user['User']['customer_id'], false);
// $response = json_decode($get_data, true);
// $errors = $response['response']['errors'];
// $data = $response['response']['data'][0];

// // cURL POST request
// $data_array =  array(
//     "customer"        => $user['User']['customer_id'],
//     "payment"         => array(
//           "number"         => $this->request->data['account'],
//           "routing"        => $this->request->data['routing'],
//           "method"         => $this->request->data['method']
//     ),
// );

// $make_call = callAPI('POST', 'https://api.example.com/post_url/', json_encode($data_array));
// $response = json_decode($make_call, true);
// $errors   = $response['response']['errors'];
// $data     = $response['response']['data'][0];

// // cURL PUT request
// $data_array =  array(
//     "amount" => (string)($lease['amount'] / $tenant_count)
//  );
 
//  $update_plan = callAPI('PUT', 'https://api.example.com/put_url/'.$lease['plan_id'], json_encode($data_array));
//  $response = json_decode($update_plan, true);
//  $errors = $response['response']['errors'];
//  $data = $response['response']['data'][0];

//  // cURL DELETE request
//  callAPI('DELETE', 'https://api.example.com/delete_url/' . $id, false);

// // Creating custom headers before our call
// $one_month_ago = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . "-1 month"));
// $rent_header = 'Search: and[][created][greater]=' . $one_month_ago . '%and[][created][less]=' . date('Y-m-d') . '%';

// //the actual call with custom search header
// $make_call = callAPI('GET', 'https://api.example.com/get_url/', false, $rent_header);

require_once 'library/api/curl/hahaha_api_curl.php';

$api = new hahahalib\hahaha_api_curl;

$data_array =  array(
    "search" => "aoi",
    "count" => "20"
);

$make_call = $api->Call_API('POST', 'http://192.168.2.105:8081/api/1.0/product/content/home', json_encode($data_array));
// $response = json_decode($make_call, true);
// $errors   = $response['response']['errors'];
// $data     = $response['response']['data'][0];
echo $make_call;
*/
class hahaha_api_curl{
    use \hahahalib\hahaha_instance_trait;
	
    //-----------------------------------------------------------
    function __construct() {
		
	}
	
	function __destruct() {
		
    }

    function Call_API($method, $url, $data, $headers = false)
	{
        $curl_ = curl_init();
     
        switch ($method){
			case "POST":
			{
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data)
				{
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				}
				break;
			}
			case "PUT":
			{
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
				if ($data)
				{
					curl_setopt($curl_, CURLOPT_POSTFIELDS, $data);
				}					
				break;
			}
			default:
			{
				if ($data)
				{
					$url_ = sprintf("%s?%s", $url, http_build_query($data));
				}
			}
        }
     
        // OPTIONS:
        curl_setopt($curl_, CURLOPT_URL, $url_);
        if(!$headers)
		{
            curl_setopt($curl_, CURLOPT_HTTPHEADER, [
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
            ]);
        }
		else{
            curl_setopt($curl_, CURLOPT_HTTPHEADER, [
                'APIKEY: 111111111111111111111',
                'Content-Type: application/json',
                $headers
            ]);
        }
        curl_setopt($curl_, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
     
        // EXECUTE:
        $result_ = curl_exec($curl_);
        if(!$result_)
		{
			die("Connection Failure");
		}
        curl_close($curl_);
        return $result_;
    }

     

}