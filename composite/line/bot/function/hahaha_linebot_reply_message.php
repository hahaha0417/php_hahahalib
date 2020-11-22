<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

 /**
  * 照開源加入apache 2.0規範
  * 
  */

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

namespace hahahalib\line;

/*
repry message 腳本
*/
class hahaha_linebot_reply_message
{
    use \hahahalib\hahaha_instance_trait;
    
    /*    
    暫時用，Handle跑完則清空 
    $Linebot_ \LINE\LINEBot
    */
    public $Linebot_ = NULL;

    function __construct()
    {
    }

    /*     
    $linebot \LINE\LINEBot
    $callback callback function  
    */
    public function Handle(&$linebot, $callback)
    {
        $signature_ = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
        $body_ = file_get_contents("php://input");
            
        try 
        {
            $this->Linebot_ = $linebot;
            // https://github.com/line/line-bot-sdk-php/blob/master/src/LINEBot.php
            $events_ = $linebot->Linebot_->parseEventRequest($body_, $signature_);
            
            foreach ($events_ as &$event_) { 
                if($callback)
                {
                    $callback($this, $event_);
                }
            }

            $this->Linebot_ = NULL;                
        } catch (Exception $e) { 	
            throw new Exception($e->getMessage());
        }
                        
    }

    /*
    $message string 顯示文字
    return LINE\LINEBot\Response
    */
    public function Text(&$event, $message)
    {
        $reply_token_ = $event->getReplyToken();  
        $message_text_ = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_text_);
    }

    /*
    $image url 顯示圖片
    $preview url 預覽圖片
    return LINE\LINEBot\Response
    */
    public function Image(&$event, $image, $preview)
    {
        $reply_token_ = $event->getReplyToken();
        $message_image_ = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($image, $preview);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_image_);
    }	

    /*
    $video url 顯示影像
    $preview url 預覽圖片
    return LINE\LINEBot\Response
    */
    public function Video(&$event, $video, $preview)
    {
        $reply_token_ = $event->getReplyToken();
        $message_video_ = new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($video, $preview);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_video_);
    }	

    /*
    $audio url 顯示聲音
    $duration 時間
    return LINE\LINEBot\Response
    */
    public function Audio(&$event, $audio, $duration)
    {
        $reply_token_ = $event->getReplyToken();
        $message_audio_ = new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($audio, $duration);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_audio_);
    }	

    /*
    $audio url 顯示位置
    $title string 標題
    $address string 位址
    $latitube double 經度
    $longtitude double 緯度
    return LINE\LINEBot\Response
    */
    public function Location(&$event, $title, $address, $latitude, $longitude)
    {
        $reply_token_ = $event->getReplyToken();
        $message_location_ = new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($title, $address, $latitude, $longitude);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_location_);
    }	

    /*
    $package_id 貼圖package id
    $sticker_id 貼圖sticker id
    return LINE\LINEBot\Response
    */
    public function Sticker(&$event, $package_id, $sticker_id)
    {
        $reply_token_ = $event->getReplyToken();
        $message_sticker_ = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($package_id, $sticker_id);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_sticker_);
    }	

    /*
     @notice maybe no use
     https://developers.line.biz/en/reference/messaging-api/#message-objects
    /
    */
    public function Raw(&$event, $message)
    {
        $reply_token_ = $event->getReplyToken();
        $message_raw_ = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($message);
        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_raw_);
    }	


    public function Multiple(&$event, $messages)
    {
        $reply_token_ = $event->getReplyToken();
        $message_multiple_ = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        foreach($messages as $key => &$value)
        {
            switch($key)
            {
            case 'text':
            {
                $message_text_ = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($value['text']);
                $message_multiple_->add($message_text_);
            }
            break;
            case 'image':
            {
                $message_image_ = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($value['image'], $value['preview']);
                $message_multiple_->add($message_image_);
            }
            break;
            case 'video':
            {
                $message_video_ = new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($value['video'], $value['preview']);
                $message_multiple_->add($message_video_);
            }
            break;
            case 'audio':
            {
                $message_audio_ = new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($value['audio'], $value['duration']);
                $message_multiple_->add($message_audio_);
            }
            break;
            case 'location':
            {
                $message_location_ = new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($value['title'], $value['address'], $value['latitude'], $value['longitude']);
                $message_multiple_->add($message_location_);
            }
            break;
            case 'sticker':
            {
                $message_sticker_ = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($value['package_id'], $value['sticker_id']);
                $message_multiple_->add($message_sticker_);
            }
            break;

            }
        
        }

        return $this->Linebot_->Linebot_->replyMessage($reply_token_, $message_multiple_);
    }	

}