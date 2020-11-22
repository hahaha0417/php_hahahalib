<?php

/*
// --------------------------------------------------------------------------
注意
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
*/

/*
// --------------------------------------------------------------------------

// --------------------------------------------------------------------------
// --------------------------------------------------------------------------
*/

/*

*/

/*

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

namespace hahahalib\script;

use PHPHtmlParser\Dom;

use hahahalib\script\hahaha_html_deal_define_action as action;
use hahahalib\script\hahaha_html_deal_define_attribute as attr;
use hahahalib\script\hahaha_html_deal_define_operator as op;

/*
 -------------------------------------------- 
失敗寫法 - 刪除檔案，似乎在同一層資源不會釋放，所以無法recreate file 
 -------------------------------------------- 
$list_ = [
	// -------------------------------------------- 
	"group1" => [
		// -------------------------------------------- 
		"item1" => [
			op::LOAD_STR => "",
			op::FIND => "",
			op::DEAL_ATTR => [
				attr::ID => [
					action::INSERT_BEFORE => "",
					action::INSERT_AFTER => "",
					action::TEXT => "",
					action::REPLACE => [
						"aaa" => "",
						"bbb" => "",
					],
				],
				attr::CLASS => [
					action::INSERT_BEFORE => [],
					action::INSERT_AFTER => [],
					action::INSERT_1 => [],
					action::INSERT_2 => [],
					action::INSERT_3 => [],
					action::INSERT_4 => [],
					action::INSERT_5 => [],
					action::TEXT => [],
					action::REPLACE => [
						"aaa" => [
							"xxx",
							"xxx",
						],
						"bbb" => [
							"xxx",
							"xxx",
						],
					],
				],
				attr::STYLE => [
					action::INSERT_BEFORE => [],
					action::INSERT_AFTER => [],
					action::INSERT_1 => [],
					action::INSERT_2 => [],
					action::INSERT_3 => [],
					action::INSERT_4 => [],
					action::INSERT_5 => [],
					action::TEXT => [],
					action::REPLACE => [
						"aaa" => [
							"xxx",
							"xxx",
						],
						"bbb" => [
							"xxx",
							"xxx",
						],
					],
				],
				// Other Attr
				"xxx" => [
					action::INSERT_BEFORE => "",
					action::INSERT_AFTER => "",
					action::TEXT => "",
					action::REPLACE => [
						"aaa" => "",
						"bbb" => "",
					],
				],
			],
			op::DEAL_TEXT => [
				action::INSERT_BEFORE => "",
				action::INSERT_AFTER => "",
				action::TEXT => "",
				action::REPLACE => [
					"aaa" => "",
					"bbb" => "",
				],
			],
		],
	],
	// -------------------------------------------- 
];

$script_ = script::Instance();
$script_->Script($list_);

$dom_ = new Dom;
$dom_->loadStr($str_);

$finds_ = $dom_->find("div"); 
$finds_[0]->setAttribute('class', "vvv");
echo $finds_[0]->getAttribute('class');
var_dump($finds_[0]->outerHtml);
// var_dump($finds_[0]->innerHtml);
// paquettg/php-html-parser 似乎有奇怪的Bug，，可能解除連線或清除記憶體，結束時必須強制exit;
// 不然會很久
exit;

 -------------------------------------------- 
連續處理
 -------------------------------------------- 
$list_ = [
	// -------------------------------------------- 
	"group1" => [
		// -------------------------------------------- 
		"item1" => [
			op::LOAD_STR => $str_,
			op::FIND => "div",
			op::ITEMS => [0],
			op::DEAL_ATTR => [
				attr::STYLE => [
					action::INSERT_2 => [
						"z1" => "xxx",
						"z2" => "xxxx",
					],
				
				],
			],			
		],
		"item2" => [
			// op::LOAD_STR => $str_,
			// op::FIND => "div",
			op::ITEMS => [0],
			op::DEAL_ATTR => [
				attr::STYLE => [
					action::INSERT_BEFORE => [
						"1z1" => "xxx",
						"1z2" => "xxxx",
					],
					
				],
			],			
		],
	],
];

$deal_->Script($list_);

$finds_ = $deal_->Finds_; 


var_dump($deal_->Dom_->outerHtml);
unset($deal_->Dom_);
unset($deal_->Finds_);
 -------------------------------------------- 
*/

/*

因為套版用Text先不做 Replace & Delete，要有通用用途才做，不然自己加在Custom
 -------------------------------------------- 
注意 : 其他有遇到才規劃
 -------------------------------------------- 

 -------------------------------------------- 
作法
 --------------------------------------------  
// 上班流程 - 程式法
1. 用DOM讀入來產生正確的HTML格式 
2. 用browser 選需要的擷取選擇器，用腳本輸出
3. CSS & JS & HTML 分類輸出
 ----------------------- 
// 自己流程 - GUI 用法，較快，不用寫程式
1. 用browser 選需要的擷取選擇器，用腳本插入tag，給xml_split批量輸出
2. 

 -------------------------------------------- 
*/
class hahaha_html_deal
{
	use \hahahalib\hahaha_instance_trait;

	public $Dom_ = null;
	public $Finds_ = null;

    public function Initial()
    {
		$this->Dom_ = new Dom;
		return $this;

    }
	
	public function Script(&$list)
	{
		foreach($list as $key_group => &$group) 
		{
			foreach($group as $key_item => &$item) 
			{
				foreach($item as $key_op => &$op) 
				{
					
					// -------------------------------------------- 
					// 因為沒很多東西，所以目前這裡只留Custom繼承出去自定義
					// 如確定很多才做整理
					/*
					$deal_ = false;
					if($deal_)
					{
						$deal_ = $this->xxx();
					}
					if($deal_)
					{
						$deal_ = $this->yyy();
					}
					// 或另外弄到class 分類
					*/
					// -------------------------------------------- 
					if($key_op == op::LOAD_STR) 
					{
						$this->Dom_->loadStr($op);
						$this->Finds_ = NULL;
					}
					if($key_op == op::FIND) 
					{
						$this->Finds_ = $this->Dom_->find($op); 
						
					}
					else if($key_op == op::DEAL_ATTR) 
					{
						foreach ($this->Finds_ as $key_find => &$find) 
						{
							if(empty($item[op::ITEMS]) )
							{
								
							}
							else 
							{
								if(!in_array( $key_find, $item[op::ITEMS]) )
								{
									continue;
								}
							}

							foreach ($op as $key_attr => &$attr) 
							{
								if($key_attr == attr::ID)
								{
									foreach ($attr as $key_action => &$action) 
									{
										if($key_action == action::INSERT_BEFORE)
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $action . $str_);
										}
										else if($key_action == action::INSERT_AFTER)
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $str_ . $action);
										}
										else if($key_action == action::TEXT)
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $str_);
										}
									}
								}	
								else if($key_attr == attr::CLASS_)
								{
									foreach ($attr as $key_action => &$action) 
									{
										if($key_action == action::INSERT_BEFORE)
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											// 插前面
											foreach ($action as $key_insert_class => &$insert_class) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}	
												$new_class_ .= $insert_class;

											}	
											// 
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												
											}
																					
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
										else if($key_action == action::INSERT_AFTER)
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												
											}
											// 插後面
											foreach ($action as $key_insert_class => &$insert_class) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}	
												$new_class_ .= $insert_class;

											}	
											// 
																					
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
										else if($key_action == action::TEXT)
										{
											$new_class_ = "";
											$first_ = true;
											// 替代
											foreach ($action as $key_insert_class => &$insert_class) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}	
												$new_class_ .= $insert_class;

											}	
																					
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
										elseif ($key_action == action::INSERT_1) 
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												if($key_class == 0) 
												{
													$deal_insert_ = true;
													// 插後面
													foreach ($action as $key_insert_class => &$insert_class) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_class_ .= " ";	
														}	
														$new_class_ .= $insert_class;

													}	
													// 
												}
											}
											if(!$deal_insert_) 
											{
												$deal_insert_ = true;
												// 插後面
												foreach ($action as $key_insert_class => &$insert_class) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_class_ .= " ";	
													}	
													$new_class_ .= $insert_class;

												}	
												// 
											}	
											
											$find->setAttribute(attr::CLASS_, $new_class_);
										} 
										elseif ($key_action == action::INSERT_2) 
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												if($key_class == 1) 
												{
													$deal_insert_ = true;
													// 插後面
													foreach ($action as $key_insert_class => &$insert_class) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_class_ .= " ";	
														}	
														$new_class_ .= $insert_class;

													}	
													// 
												}
											}
											if(!$deal_insert_) 
											{
												$deal_insert_ = true;
												// 插後面
												foreach ($action as $key_insert_class => &$insert_class) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_class_ .= " ";	
													}	
													$new_class_ .= $insert_class;

												}	
												// 
											}	
																																
											$find->setAttribute(attr::CLASS_, $new_class_);
										} 
										elseif ($key_action == action::INSERT_3) 
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												if($key_class == 2) 
												{
													$deal_insert_ = true;
													// 插後面
													foreach ($action as $key_insert_class => &$insert_class) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_class_ .= " ";	
														}	
														$new_class_ .= $insert_class;

													}	
													// 
												}
											}
											if(!$deal_insert_) 
											{
												$deal_insert_ = true;
												// 插後面
												foreach ($action as $key_insert_class => &$insert_class) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_class_ .= " ";	
													}	
													$new_class_ .= $insert_class;

												}	
												// 
											}	
																																
											$find->setAttribute(attr::CLASS_, $new_class_);
										} 
										elseif ($key_action == action::INSERT_4) 
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												if($key_class == 3) 
												{
													$deal_insert_ = true;
													// 插後面
													foreach ($action as $key_insert_class => &$insert_class) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_class_ .= " ";	
														}	
														$new_class_ .= $insert_class;

													}	
													// 
												}
											}
											if(!$deal_insert_) 
											{
												$deal_insert_ = true;
												// 插後面
												foreach ($action as $key_insert_class => &$insert_class) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_class_ .= " ";	
													}	
													$new_class_ .= $insert_class;

												}	
												// 
											}	
																																
											$find->setAttribute(attr::CLASS_, $new_class_);
										} 
										elseif ($key_action == action::INSERT_5) 
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}

												$new_class_ .= $class;
												if($key_class == 4) 
												{
													$deal_insert_ = true;
													// 插後面
													foreach ($action as $key_insert_class => &$insert_class) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_class_ .= " ";	
														}	
														$new_class_ .= $insert_class;

													}	
													// 
												}
											}
											if(!$deal_insert_) 
											{
												$deal_insert_ = true;
												// 插後面
												foreach ($action as $key_insert_class => &$insert_class) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_class_ .= " ";	
													}	
													$new_class_ .= $insert_class;

												}	
												// 
											}	
																																
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
										else if($key_action == action::REPLACE)
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											// 替換
											foreach ($action as $key_replace_class => &$replace_class) 
											{
                                                foreach ($classes_ as $key_class => &$class) {
                                                    if ($key_replace_class == $class) {
														$classes_[$key_class] = $replace_class;
														break;
                                                    }
                                                }
											}
											//
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}
												$new_class_ .= $class;
											}																				
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
										else if($key_action == action::DELETE)
										{
											$str_ = $find->getAttribute(attr::CLASS_);
											$classes_ = explode(" ", $str_);
											// 刪除
											foreach ($action as $key_delete_class => &$delete_class) 
											{
												foreach ($classes_ as $key_class => &$class) 
												{
                                            		if ($delete_class == $class) {
														unset($classes_[$key_class]);
														break;
                                                    }
												}
											}
											// 
											$new_class_ = "";
											$first_ = true;

											$deal_insert_ = false;
											foreach ($classes_ as $key_class => &$class) 
											{
												
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_class_ .= " ";	
												}
												$new_class_ .= $class;
											}																				
											$find->setAttribute(attr::CLASS_, $new_class_);
										}
                                    }
								}	
								else if($key_attr == attr::STYLE)
								{
									foreach ($attr as $key_action => &$action) 
									{
										if($key_action == action::INSERT_BEFORE)
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;

											// 插前面
											foreach ($action as $key_insert_style => &$insert_style) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}	
												$new_style_ .= $key_insert_style . ":" . $insert_style;

											}	
											// 
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);
												
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										}
										else if($key_action == action::INSERT_AFTER)
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;

											
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);
												
											}
											// 插後面
											foreach ($action as $key_insert_style => &$insert_style) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}	
												$new_style_ .= $key_insert_style . ":" . $insert_style;

											}	
											// 
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										}
										else if($key_action == action::TEXT)
										{
											$new_style_ = "";
											$first_ = true;

											// 插前面
											foreach ($action as $key_insert_style => &$insert_style) 
											{
												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}	
												$new_style_ .= $key_insert_style . ":" . $insert_style;

											}	
											// 											
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										}
										elseif ($key_action == action::INSERT_1) 
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

												if($key_style == 0)
												{
													$deal_insert_ = true;
													// 插前面
													foreach ($action as $key_insert_style => &$insert_style) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_style_ .= ";";	
														}	
														$new_style_ .= $key_insert_style . ":" . $insert_style;

													}	
													// 
												}
												
											}

											if(!$deal_insert_)
											{
												$deal_insert_ = true;
												// 插前面
												foreach ($action as $key_insert_style => &$insert_style) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_style_ .= ";";	
													}	
													$new_style_ .= $key_insert_style . ":" . $insert_style;

												}	
												// 
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										} 
										elseif ($key_action == action::INSERT_2) 
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;

											$deal_insert_ = false;
											
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

												if($key_style == 1)
												{
													$deal_insert_ = true;
													// 插前面
													foreach ($action as $key_insert_style => &$insert_style) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_style_ .= ";";	
														}	
														$new_style_ .= $key_insert_style . ":" . $insert_style;

													}	
													// 
												}
												
											}
											if(!$deal_insert_)
											{
												$deal_insert_ = true;
												// 插前面
												foreach ($action as $key_insert_style => &$insert_style) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_style_ .= ";";	
													}	
													$new_style_ .= $key_insert_style . ":" . $insert_style;

												}	
												// 
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										} 
										elseif ($key_action == action::INSERT_3) 
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

												if($key_style == 2)
												{
													$deal_insert_ = true;
													// 插前面
													foreach ($action as $key_insert_style => &$insert_style) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_style_ .= ";";	
														}	
														$new_style_ .= $key_insert_style . ":" . $insert_style;

													}	
													// 
												}
												
											}
											if(!$deal_insert_)
											{
												$deal_insert_ = true;
												// 插前面
												foreach ($action as $key_insert_style => &$insert_style) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_style_ .= ";";	
													}	
													$new_style_ .= $key_insert_style . ":" . $insert_style;

												}	
												// 
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										} 
										elseif ($key_action == action::INSERT_4) 
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

												if($key_style == 3)
												{
													$deal_insert_ = true;
													// 插前面
													foreach ($action as $key_insert_style => &$insert_style) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_style_ .= ";";	
														}	
														$new_style_ .= $key_insert_style . ":" . $insert_style;

													}	
													// 
												}
												
											}
											if(!$deal_insert_)
											{
												$deal_insert_ = true;
												// 插前面
												foreach ($action as $key_insert_style => &$insert_style) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_style_ .= ";";	
													}	
													$new_style_ .= $key_insert_style . ":" . $insert_style;

												}	
												// 
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										} 
										elseif ($key_action == action::INSERT_5) 
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

												if($key_style == 4)
												{
													$deal_insert_ = true;
													// 插前面
													foreach ($action as $key_insert_style => &$insert_style) 
													{
														if($first_)
														{
															$first_ = false;
														}
														else
														{
															$new_style_ .= ";";	
														}	
														$new_style_ .= $key_insert_style . ":" . $insert_style;

													}	
													// 
												}
												
											}
											if(!$deal_insert_)
											{
												$deal_insert_ = true;
												// 插前面
												foreach ($action as $key_insert_style => &$insert_style) 
												{
													if($first_)
													{
														$first_ = false;
													}
													else
													{
														$new_style_ .= ";";	
													}	
													$new_style_ .= $key_insert_style . ":" . $insert_style;

												}	
												// 
											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										} 
										else if($key_action == action::REPLACE)
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											// 替換
											foreach ($action as $key_replace_style => &$replace_style) 
											{
												foreach ($styles_ as $key_style => &$style) 
												{
													if(trim($style) == "")
													{
														continue;
													}
                                                    $s_ = explode(":", $style);
                                                    if ($key_replace_style == $s_[0]) {
														$styles_[$key_style] = $key_replace_style . ":" . $replace_style;
														break;
                                                    }
                                                }
											}
											//
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										}
										else if($key_action == action::DELETE)
										{
											$str_ = $find->getAttribute(attr::STYLE);
											$styles_ = explode(";", $str_);
											// 刪除
											foreach ($action as $key_delete_style => &$delete_style) 
											{
												foreach ($styles_ as $key_style => &$style) 
												{
													if(trim($style) == "")
													{
														continue;
													}

													$s_ = explode(":", $style);
													if ($delete_style == $s_[0]) 
													{
														unset($styles_[$key_style]);	
														break;
													}
												}
											}
											// 
											$new_style_ = "";
											$first_ = true;
											
											$deal_insert_ = false;
											foreach ($styles_ as $key_style => &$style) 
											{
												if(trim($style) == "")
												{
													continue;
												}

												if($first_)
												{
													$first_ = false;
												}
												else
												{
													$new_style_ .= ";";	
												}

												$new_style_ .= trim($style);

											}
											$new_style_ .= ";";											
											$find->setAttribute(attr::STYLE, $new_style_);
										}
									}
								}	
								else 
								{
									foreach ($attr as $key_action => &$action) 
									{
										if($key_action == action::INSERT_BEFORE) 
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $action . $str_);
										}
										else if($key_action == action::INSERT_AFTER) 
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $str_ . $action);
										}
										else if($key_action == action::TEXT) 
										{
											$str_ = $find->getAttribute(attr::ID);
											$find->setAttribute(attr::ID, $str_);
										}
									}
								}	
							}	
                        }
					}
					if($key_op == op::DEAL_TEXT) 
					{
						foreach ($this->Finds_ as &$find) 
						{
							foreach ($op as $key_attr => &$attr) 
							{
								if($key_action == action::INSERT_BEFORE)
								{
									$str_ = $find->getAttribute(attr::ID);
									$find->setAttribute(attr::ID, $action . $str_);
								}
								else if($key_action == action::INSERT_AFTER)
								{
									$str_ = $find->getAttribute(attr::ID);
									$find->setAttribute(attr::ID, $str_ . $action);
								}
								else if($key_action == action::TEXT)
								{
									$str_ = $find->getAttribute(attr::ID);
									$find->setAttribute(attr::ID, $str_);
								}
								// else if($attr == action::REPLACE)
								// {
								// 	// "aaa" => "",
								// 	// "bbb" => "",
								// }
                            }
                        }
					}
					// -------------------------------------------- 
					else
					{
						$this->Operator_Custom($key_op, $op);
					}
					// -------------------------------------------- 
				}
			}
		}
	}
	
	public function Operator_Custom(&$key_op, &$op)
	{
		// 在Script()內執行echo，所以會先顯示
		// echo $key_op;
	}
	
}