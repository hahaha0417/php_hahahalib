<?php

namespace hahahalib;

/*
翻譯模組
*/
class hahaha_asset
{
	use \hahahalib\hahaha_instance_trait;

	// --------------------------------------------------------------------------
	// Constant
	// --------------------------------------------------------------------------	
	const SEQUENCE = 0;
	const SEPERATE = 1;

	// --------------------------------------------------------------------------
	// Property
	// --------------------------------------------------------------------------
	public $Type = self::SEQUENCE;

	// --------------------------------------------------------------------------
	// 
	// --------------------------------------------------------------------------
	// 路徑
	public $Asset_List_ = [];


	function __construct()
	{		
		
	}
		
	/*
	// 注意 : 有Target可以用，可以選Node
	// --------------------------------------------------------------------------
	// 簡易
	// --------------------------------------------------------------------------
	$asset_manager_ = \hahaha\hahaha_asset::Instance()->Initial();
	$asset_ = $asset_manager_->Asset('default')->Initial(); 

	$asseter_ = \hahahalib\hahaha_asset::Instance();
	$asset_->Asset($asseter_, '', 'water_wheel_carousel', ['plugin', 'carousel']);
	$asset_->Asset($asseter_, '', 'water_wheel_carousel', ['plugin', 'carousel']);
	$asset_->Asset($asseter_, '', 'app');
	echo "<pre>";
	var_dump( $asseter_->Render() );
	// --------------------------------------------------------------------------
	// 一般
	// --------------------------------------------------------------------------
	$asset_manager_ = \hahaha\hahaha_asset::Instance()->Initial();
	$asset_ = $asset_manager_->Asset('default')->Initial(); 

	$asseter_ = \hahahalib\hahaha_asset::Instance();
	$asset_->Asset($asseter_, '', 'water_wheel_carousel', ['plugin', 'carousel'], \hahaha\asset\hahaha_asset_base::FRONT);
	$asset_->Asset($asseter_, '', 'water_wheel_carousel', ['plugin', 'carousel'], \hahaha\asset\hahaha_asset_base::FRONT);
	$asset_->Asset($asseter_, '', 'app');
	echo "<pre>";
	$asseter_->Type = \hahahalib\hahaha_asset::SEQUENCE;
	//$asseter_->Type = \hahahalib\hahaha_asset::SEPERATE;
	var_dump( $asseter_->Render() );
	// --------------------------------------------------------------------------
	// 初始階段
	// --------------------------------------------------------------------------
	$asset_manager_ = \hahaha\hahaha_asset::Instance()->Initial();
	$asset_ = $asset_manager_->Asset('default')->Initial(); 

	$asseter_ = \hahahalib\hahaha_asset::Instance();

	// 初始asset階段
	$asset_->Asset($asseter_, 'main');
	$asset_->Asset($asseter_, 'sub');
	// 加入
	$asset_->Asset($asseter_, 'main', 'water_wheel_carousel', ['plugin', 'carousel'], \hahaha\asset\hahaha_asset_base::FRONT);
	$asset_->Asset($asseter_, 'main', 'water_wheel_carousel', ['plugin', 'carousel'], \hahaha\asset\hahaha_asset_base::FRONT);
	$asset_->Asset($asseter_, 'main', 'app');

	echo "<pre>";
	// var_dump($asseter_->Asset_List_);exit;
	$asseter_->Type = \hahahalib\hahaha_asset::SEQUENCE;
	// $asseter_->Type = \hahahalib\hahaha_asset::SEPERATE;
	var_dump( $asseter_->Render() );
	// var_dump( $asseter_->Render(['main']) );
	// --------------------------------------------------------------------------
	// NULL是全部渲染，有設定則是局部
	// --------------------------------------------------------------------------
	// $asset_phase array
	*/
	public function Render($asset_names = [])
	{		
		// 每次重新處理即可，因為不會有需要render兩次
		// 是否重複
		$repeat_ = [];
		// 渲染
		$render_ = "";

		if($this->Type == self::SEQUENCE)
		{
			foreach($this->Asset_List_ as $phase => &$asset_phase)
			{
				if(!empty($asset_names) )
				{
					if(!in_array($phase, $asset_names))
					{
						continue;
					}
				}
				
				foreach($asset_phase as &$asset)
				{					
					foreach($asset[1] as &$item)
					{
						if(!empty($item['css']))
						{	
							$item_ = $asset[0] . $item['css'];
							if(!empty($repeat_[$item_]))
							{
								continue;
							}
							$repeat_[$item_] = $item_;
							$render_ .= '<link href="' . $item_ . '" rel="stylesheet" type="text/css"/>' . "\r\n";
						}
						else if(!empty($item['js']))
						{
							$item_ = $asset[0] . $item['js'];
							if(!empty($repeat_[$item_]))
							{
								continue;
							}
							$repeat_[$item_] = $item_;
							$render_ .= '<script type="text/javascript" src="' . $item_ . '"></script>' . "\r\n";
						}
					}
				}
			}
		}
		else if($this->Type == self::SEPERATE)
		{
			// 先css再js
			foreach($this->Asset_List_ as &$asset_phase)
			{
				foreach($asset_phase as &$asset)
				{
					foreach($asset[1] as &$item)
					{
						if(!empty($item['css']))
						{	
							$item_ = $asset[0] . $item['css'];
							if(!empty($repeat_[$item_]))
							{
								continue;
							}
							$repeat_[$item_] = $item_;
							$render_ .= '<link href="' . $item_ . '" rel="stylesheet" type="text/css"/>' . "\r\n";
						}
					}
				}
			}
			$render_ .= "\r\n";
			foreach($this->Asset_List_ as &$asset_phase)
			{
				foreach($asset_phase as &$asset)
				{
					foreach($asset[1] as &$item)
					{
						if(!empty($item['js']))
						{
							$item_ = $asset[0] . $item['js'];
							if(!empty($repeat_[$item_]))
							{
								continue;
							}
							$repeat_[$item_] = $item_;
							$render_ .= '<script type="text/javascript" src="' . $item_ . '"></script>' . "\r\n";
						}
					}
				}
			}
		}
		
		return $render_;
	}

	public function Reset()
	{
		$this->Asset_List_ = [];
	}

	
}

