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
multicast 腳本
user_ids用reference原因，因為你不可能預先知道user_id，所以你一定會處理成array，不可能手動填
並且當數量多時reference array這樣比較快
*/
class hahaha_linebot_multicast
{
    use \hahahalib\hahaha_instance_trait;
    
    function __construct()
    {
    }

   /*
    $message string 顯示文字
    return LINE\LINEBot\Response
    */
    public function Text(&$linebot, &$user_ids, $message, $notification_disabled = false)
    {
        $message_text_ = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
        return $linebot->Linebot_->multicast($user_ids, $message_text_, $notification_disabled);
    }

    /*
    $image url 顯示圖片
    $preview url 預覽圖片
    return LINE\LINEBot\Response
    */
    public function Image(&$linebot, &$user_ids, $image, $preview, $notification_disabled = false)
    {
        $message_image_ = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($image, $preview);
        return $linebot->Linebot_->multicast($user_ids, $message_image_, $notification_disabled);
    }	

    /*
    $video url 顯示影像
    $preview url 預覽圖片
    return LINE\LINEBot\Response
    */
    public function Video(&$linebot, &$user_ids, $video, $preview, $notification_disabled = false)
    {
        $message_video_ = new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($video, $preview);
        return $linebot->Linebot_->multicast($user_ids, $message_video_, $notification_disabled);
    }	

    /*
    $audio url 顯示聲音
    $duration 時間
    return LINE\LINEBot\Response
    */
    public function Audio(&$linebot, &$user_ids, $audio, $duration, $notification_disabled = false)
    {
        $message_audio_ = new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($audio, $duration);
        return $linebot->Linebot_->multicast($user_ids, $message_audio_, $notification_disabled);
    }	

    /*
    $audio url 顯示位置
    $title string 標題
    $address string 位址
    $latitube double 經度
    $longtitude double 緯度
    return LINE\LINEBot\Response
    */
    public function Location(&$linebot, &$user_ids, $title, $address, $latitude, $longitude, $notification_disabled = false)
    {
        $message_location_ = new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($title, $address, $latitude, $longitude);
        return $linebot->Linebot_->multicast($user_ids, $message_location_, $notification_disabled);
    }	

    /*
    $package_id 貼圖package id
    $sticker_id 貼圖sticker id
    return LINE\LINEBot\Response
    */
    public function Sticker(&$linebot, &$user_ids, $package_id, $sticker_id, $notification_disabled = false)
    {
        $message_sticker_ = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($package_id, $sticker_id);
        return $linebot->Linebot_->multicast($user_ids, $message_sticker_, $notification_disabled);
    }	

    /*
     @notice maybe no use
     https://developers.line.biz/en/reference/messaging-api/#message-objects
    /
    */
    public function Raw(&$linebot, &$user_ids, $message, $notification_disabled = false)
    {
        $message_raw_ = new \LINE\LINEBot\MessageBuilder\RawMessageBuilder($message);
        return $linebot->Linebot_->multicast($user_ids, $message_raw_, $notification_disabled);
    }	


    public function Multiple(&$linebot, &$user_ids, $messages, $notification_disabled = false)
    {
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

        return $linebot->Linebot_->multicast($user_ids, $message_multiple_, $notification_disabled);
    }	
}