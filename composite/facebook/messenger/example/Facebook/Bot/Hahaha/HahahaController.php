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



namespace App\Api\Controllers\Front\v1_0\Facebook\Bot\Hahaha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
//require_once HAHAHALIB . '\composite\facebook\messenger\facebook_messenger.php';
use BotMan\BotMan\BotMan;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class HahahaController extends CommonController
{    
    //
    public function __construct()
    {

    }
	
	public function broadcast($type)
    {		

		
		
		
	}

    public function callback()
    {  
		$facebook_messenger_ = new \hahahalib\facebook_messenger(
			'17c1813d6225957e7c18646a4362ae8b',			
			'EAADjHqxJo3wBAJLbedKG9wkRD2HGVL5LdNQy4ULgyf2h77hs9yKU27NMt56zmPYNSUFUu71QybRjkUjEChQpqF3DFMZBbDfTG5n9vGub0ZAVdMaTXpjyOYBob1312gKA9awOZC5tcjbWtxvnXdU0dHQNdfnZB6A6FSWHewwVcQZDZD',
			'hahaha'
		);

		$facebook_messenger_->Facebook_Messenger_->hears('hello', function(BotMan $bot)
		{
			$bot->reply("hello");
			
		});
		
		//測試的要加入開發者
		// https://stackoverflow.com/questions/36803570/facebook-messenger-webhook-setup-but-not-triggered	
		// 出錯太多會卡住，似乎要等到全部錯的跑完才會恢復正常
		// https://botman.io/2.0/installation
		$facebook_messenger_->Facebook_Messenger_->hears('button', function(BotMan $bot)
		{
			$bot->reply(ButtonTemplate::create('Do you want to know more about BotMan?')
				->addButton(ElementButton::create('Tell me more')
					->type('postback')
					->payload('tellmemore')
				)
				->addButton(ElementButton::create('Show me the docs')
					->url('http://botman.io/')
				)
			);
			
		});
			
		$facebook_messenger_->Facebook_Messenger_->listen();
		
		
    }
}
