<?php
/*
{{-- 原始 : hahaha --}}
{{-- 維護 :  --}}
{{-- 指揮 :  --}}
{{-- ---------------------------------------------------------------------------------------------- --}}
{{-- 決定 : name --}}
{{-- 
    ----------------------------------------------------------------------------
    說明 : 
    ----------------------------------------------------------------------------   
    
    ----------------------------------------------------------------------------
--}}
{{-- ---------------------------------------------------------------------------------------------- --}}
*/

// https://blog.toright.com/posts/5727/%E7%94%A8-php-%E5%AF%A6%E7%8F%BE-line-message-api-%E6%8E%A5%E6%94%B6%E7%B3%BB%E7%B5%B1%E8%A8%8A%E6%81%AF.html
// https://developers.line.biz/en/reference/messaging-api/#send-reply-message
//
// Line SDK
// https://developers.line.biz/en/reference/messaging-api/#message-objects
// https://github.com/line/line-bot-sdk-php/blob/master/src/LINEBot.php
// https://line.github.io/line-bot-sdk-php/namespace-LINE.LINEBot.MessageBuilder.html
// http://marcoyan0814.blogspot.com/2016/11/line-line-messaging-api-for-php-line-bot.html
// http://hiroasake.blogspot.com/2018/10/line-botphp-bot.html

namespace App\Api\Controllers\Front\v1_0\Line\Bot\Hahaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;


class HahahaController extends CommonController
{    
    //
    public function __construct()
    {

    }
	
	public function broadcast($type)
    {
		$linebot_ = new \hahahalib\linebot(
			'x/eb6xIldWmwn38EPY8y2lhQJKln2QIrCrikJfUvdxjVnlsGEuFkfSey7V+a0ucKL+lhNUm9YwUwyLmzOJ2RNY7qmPMu5XEp8/SXvG03peOJ69PTF7ZZu0D6Lor5Z+nsc7l2oQ/iGYafjEbVIvuHqAdB04t89/1O/w1cDnyilFU=',
			'742e69bbc26d797d8cfdbe7be93a1862'
		);
		
		$linebot_broadcast_ = new \hahahalib\linebot_broadcast;
		
		switch($type)
		{
			case 'text':
			{					
				// bot dirty logic
				$result = $linebot_broadcast_->Text($linebot_, "文字");
			}
			break;
			case 'image':
			{
				$origin_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
				$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
				$result = $linebot_broadcast_->Image($linebot_, $origin_url, $preview_url);  
			}
			break;
			case 'video':
			{
					$origin_url = 'https://hahaha0417.zapto.org:8443/video/Oring.mp4';
					$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
					$result = $linebot_broadcast_->Video($linebot_, $origin_url, $preview_url);  

			}
			break;
			case 'audio':
			{
					$origin_url = 'https://static.rti.org.tw/assets/audio/2019/09/13/1_20190913_2005_1572.mp3';
					$result = $linebot_broadcast_->Audio($linebot_, $origin_url, 10);  

			}
			break;
			case 'location':
			{
					$title = 'title';
					$address = 'address';
					$latitude = 25.0478142;	
					$longitude = 121.51694880000002;		
					$result = $linebot_broadcast_->Location($linebot_, $title, $address, $latitude, $longitude);  

			}
			break;
			case 'sticker':
			{
					$package_id = '1';		
					$sticker_id = '1';
					$result = $linebot_broadcast_->Sticker($linebot_, $package_id, $sticker_id);  

			}
			break;
			/*
			case 'raw':
			{
					$message = [
							'one line',
							'two line'
					];
					$result = $linebot_broadcast_->Raw($linebot_, $message);  

			}
			break;
			*/


			case 'multiple':
			{
					$message = 'multi';
					$origin_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
					$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
					
					$video_url = 'https://hahaha0417.zapto.org:8443/video/Oring.mp4';
					$audio_url = 'https://static.rti.org.tw/assets/audio/2019/09/13/1_20190913_2005_1572.mp3';

					$title = 'title';
					$address = 'address';
					$latitude = 25.0478142;	
					$longitude = 121.51694880000002;		

					$package_id = '1';		
					$sticker_id = '1';


					$messages = [
							
							'text' => [
									'text' => $message
							],
							'image' => [
									'image' => $origin_url, 						
									'preview' => $preview_url 
							],
							'video' => [
									'video' => $video_url, 						
									'preview' => $preview_url 
							],
							'audio' => [
									'audio' => $audio_url,
									'duration' => 10						
							],
							'location' => [
									'title' => $title,
									'address' => $address,
									'latitude' => $latitude,
									'longitude' => $longitude
							],
							// 不能和location同時送
							/*
							'sticker' => [
									'package_id' => $package_id,
									'sticker_id' => $sticker_id 
							],
							 */

							 
					];
					$linebot_broadcast_->Multiple($linebot_, $messages); 
					
			}
			break;
		}
	}

    public function callback()
    {  
		// http_response_code(200); 
		
		$linebot_ = new \hahahalib\linebot(
			'x/eb6xIldWmwn38EPY8y2lhQJKln2QIrCrikJfUvdxjVnlsGEuFkfSey7V+a0ucKL+lhNUm9YwUwyLmzOJ2RNY7qmPMu5XEp8/SXvG03peOJ69PTF7ZZu0D6Lor5Z+nsc7l2oQ/iGYafjEbVIvuHqAdB04t89/1O/w1cDnyilFU=',
			'742e69bbc26d797d8cfdbe7be93a1862'
		);
		
		$linebot_reply_message_ = new \hahahalib\linebot_reply_message;
		$linebot_push_message_ = new \hahahalib\linebot_push_message;
		$linebot_multicast_ = new \hahahalib\linebot_multicast;
		$linebot_broadcast_ = new \hahahalib\linebot_broadcast;
		
		$linebot_reply_message_->Handle($linebot_, function(&$linebot_reply_message, &$event){
			// 陣列裡面是物件
			// http://hiroasake.blogspot.com/2018/10/line-botphp-bot.html
			$message = "";
			$command = strtolower($event->getText());
			// 特殊狀況寫法
			//if($command) 
			//{
			//}

			switch($command)
			{

				case 'text':
				{					
					// bot dirty logic
					$result = $linebot_reply_message->Text($event, "文字");
				}
				break;
				case 'image':
				{
					$origin_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
					$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
					$result = $linebot_reply_message->Image($event, $origin_url, $preview_url);  
				}
				break;
				case 'video':
				{
						$origin_url = 'https://hahaha0417.zapto.org:8443/video/Oring.mp4';
						$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
						$result = $linebot_reply_message->Video($event, $origin_url, $preview_url);  

				}
				break;
				case 'audio':
				{
						$origin_url = 'https://static.rti.org.tw/assets/audio/2019/09/13/1_20190913_2005_1572.mp3';
						$result = $linebot_reply_message->Audio($event, $origin_url, 10);  

				}
				break;
				case 'location':
				{
						$title = 'title';
						$address = 'address';
						$latitude = 25.0478142;	
						$longitude = 121.51694880000002;		
						$result = $linebot_reply_message->Location($event, $title, $address, $latitude, $longitude);  

				}
				break;
				case 'sticker':
				{
						$package_id = '1';		
						$sticker_id = '1';
						$result = $linebot_reply_message->Sticker($event, $package_id, $sticker_id);  

				}
				break;
				/*
				case 'raw':
				{
						$message = [
								'one line',
								'two line'
						];
						$result = $linebot_reply_message->Raw($event, $message);  

				}
				break;
				*/


				case 'multiple':
				{
						$message = 'multi';
						$origin_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
						$preview_url = 'https://hahaha0417.zapto.org:8443/image/front/home/overview/OBS%20iForm%E7%A4%BA%E6%84%8F%E5%9C%96.png';
						
						$video_url = 'https://hahaha0417.zapto.org:8443/video/Oring.mp4';
						$audio_url = 'https://static.rti.org.tw/assets/audio/2019/09/13/1_20190913_2005_1572.mp3';

						$title = 'title';
						$address = 'address';
						$latitude = 25.0478142;	
						$longitude = 121.51694880000002;		

						$package_id = '1';		
						$sticker_id = '1';


						$messages = [
								
								'text' => [
										'text' => $message
								],
								'image' => [
										'image' => $origin_url, 						
										'preview' => $preview_url 
								],
								'video' => [
										'video' => $video_url, 						
										'preview' => $preview_url 
								],
								'audio' => [
										'audio' => $audio_url,
										'duration' => 10						
								],
								'location' => [
										'title' => $title,
										'address' => $address,
										'latitude' => $latitude,
										'longitude' => $longitude
								],
								// 不能和location同時送
								/*
								'sticker' => [
										'package_id' => $package_id,
										'sticker_id' => $sticker_id 
								],
								 */

								 
						];
						$linebot_reply_message->Multiple($event, $messages); 
						
				}
				break;
			}
		});
		
    }
}
