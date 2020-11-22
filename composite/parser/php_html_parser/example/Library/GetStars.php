<?php

namespace App\Library;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use PHPHtmlParser\Dom;
use App\Stars;
use App\StarsDetail;

class GetStars
{
    public function getData($timeout = 5)
    {
        $client = new Client(['base_uri' => 'http://astro.click108.com.tw/']);
        $request = new Request('GET', 'http://astro.click108.com.tw/');
        $response = $client->send($request, [
                'timeout' => $timeout,
            ]
        );
        // https://github.com/paquettg/php-html-parser
        $dom = new Dom;
        $dom->load((string)$response->getbody());
        
        //$a = $dom->find('.STAR12_BOX .STAR_01 a')[0]->firstChild()->text;
        //dd($a);
        // 取得12星座連結
        $data = [];
        $dataObj = $dom->find('.STAR12_BOX li a');
        foreach($dataObj as $key => $value)
        {
            $link = $value->getTag()->getAttribute('href')['value'];
            $link = explode('RedirectTo=', $link);
            
            $data[] = [
                // 星座名稱
                'name' => $value->text,
                'link' => urldecode($link[1])        
            ];
            
        }
        // dd($data);exit;
        foreach($data as $key => &$value)
        {
            $client = new Client(['base_uri' => $value['link']]);
            $requestValue = new Request('GET', $value['link']);
            $responseValue = $client->send($requestValue, [
                    'timeout' => $timeout,
                ]
            );
            $domValue = new Dom;
            $domValue->load((string)$responseValue->getbody());

            $dataValueObj = $domValue->find('.TODAY_FORTUNE .QUERY_DATE form table tr td select option');
            foreach($dataValueObj as $key2 => $value2)
            {
                if($value2->getAttribute('selected')  != "")
                {
                    // 當天日期
                    $value['date'] = $value2->text;
                    break;
                }

            }

            $dataValueObj2 = $domValue->find('.FORTUNE_CONTENT .TODAY_CONTENT p');

            foreach($dataValueObj2 as $key3 => $value3)
            {
                if($key3 == 0)
                {
                    // 整體運勢評分
                    $value['total'] = [
                        'score' => $this->getScore($value3->find('span')[0]->text)
                    ];
                }
                else if($key3 == 1)
                {
                    // 整體運勢說明
                    $value['total']['description'] = $value3->text;
                }
                else if($key3 == 2)
                {
                    // 愛情運勢評分
                    $value['love'] = [
                        'score' => $this->getScore($value3->find('span')[0]->text)
                    ];
                }
                else if($key3 == 3)
                {
                    // 愛情運勢說明
                    $value['love']['description'] = $value3->text;
                }
                else if($key3 == 4)
                {
                    // 事業運勢評分
                    $value['career'] = [
                        'score' => $this->getScore($value3->find('span')[0]->text)
                    ];
                }
                else if($key3 == 5)
                {
                    // 事業運勢說明
                    $value['career']['description'] = $value3->text;
                }
                else if($key3 == 6)
                {
                    // 財運運勢評分
                    $value['wealth'] = [
                        'score' => $this->getScore($value3->find('span')[0]->text)
                    ];
                }
                else if($key3 == 7)
                {
                    // 財運運勢說明
                    $value['wealth']['description'] = $value3->text;
                }
               
            }
            
        }

        // 存入
        $hour = date("H",(time() + 8 * 3600));
        foreach($data as $key => $value)
        {
            $stars = new Stars;
            $stars->name = $value['name'];
            $stars->date = $value['date'];
            $stars->hour = $hour;
            $stars->save();

            $starsDetail = new StarsDetail;
            $starsDetail->type = 0;
            $starsDetail->stars_id = $stars->id;
            $starsDetail->score = $value['total']['score'];
            $starsDetail->description = $value['total']['description'];
            $starsDetail->save();

            $starsDetail = new StarsDetail;
            $starsDetail->type = 1;
            $starsDetail->stars_id = $stars->id;
            $starsDetail->score = $value['love']['score'];
            $starsDetail->description = $value['love']['description'];
            $starsDetail->save();

            $starsDetail = new StarsDetail;
            $starsDetail->type = 2;
            $starsDetail->stars_id = $stars->id;
            $starsDetail->score = $value['career']['score'];
            $starsDetail->description = $value['career']['description'];
            $starsDetail->save();

            $starsDetail = new StarsDetail;
            $starsDetail->type = 3;
            $starsDetail->stars_id = $stars->id;
            $starsDetail->score = $value['wealth']['score'];
            $starsDetail->description = $value['wealth']['description'];
            $starsDetail->save();
        }
        
        return "成功";
    }

    public function getScore($text)
    {
        $count = 0;
        for($i = 0; $i < mb_strlen($text, 'utf-8'); $i++)
        {
            if(mb_substr($text, $i, 1) == '★')
            {
                $count++;
            }
        }
        return $count;
    }

}