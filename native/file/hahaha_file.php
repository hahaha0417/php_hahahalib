<?php

namespace hahahalib;

/*
 ------------------------------------- 
注意 : 和PHP相同的就不再包一次(除非帶來額外好處)，php hahahalib沒有要完整取代原生php
 ------------------------------------- 
 
https://www.php.net/manual/en/ref.filesystem.php
glob($path . '/*'); - 搜尋資料夾

// $file_->Recursive_Copy("jquery", "jquery_aaa");
// $file_->Delete_Tree("jquery_aaa");
// $file_->Move("jquery_aaa", "jquery_aaabbb");
*/
class hahaha_file
{
	use \hahahalib\hahaha_instance_trait;
	
	public function Initial()
    {

    }

	// https://gist.github.com/gserrano/4c9648ec9eb293b9377b
	public function Recursive_Copy($src, $dst) {
		if (is_dir($src)) 
		{ 
			$dir_ = opendir($src);
			@mkdir($dst);
			while(( $file_ = readdir($dir_)) ) {
				if (( $file_ != '.' ) && ( $file_ != '..' )) {
					if ( is_dir($src . '/' . $file_) ) {
						$this->Recursive_Copy($src .'/'. $file_, $dst . '/' . $file_);
					}
					else {
						@copy($src . '/' . $file_, $dst . '/' . $file_);
					}
				}
			}
			closedir($dir_);
		}
	}
	
	// https://stackoverflow.com/questions/3338123/how-do-i-recursively-delete-a-directory-and-its-entire-contents-files-sub-dir
	// 不要用 https://andy-carter.com/blog/recursively-remove-a-directory-in-php
	// 這檔案數太多會會搜尋很久	
	/*
	 ------------------------------------- 
	注意 : 危險，請小心使用
	 ------------------------------------- 
	*/
	public function Delete_Tree($dir) { 
		if (is_dir($dir)) 
		{ 
			$objects_ = @scandir($dir);
			foreach ($objects_ as &$object) { 
				if ($object != "." && $object != "..") { 
					if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir . "/" . $object))
						$this->Delete_Tree($dir. DIRECTORY_SEPARATOR . $object);
					else
						@unlink($dir . DIRECTORY_SEPARATOR . $object); 
				} 
			}
			@rmdir($dir); 
		} 
	}
	
	// https://stackoverflow.com/questions/9835492/move-all-files-and-folders-in-a-folder-to-another
	public function Move($src, $dst, $mode = 0777){
		if( !is_dir($dst) ) {
			// 建立目錄
			@mkdir($dst, $mode, true);
			// 刪除目的目錄
			@rmdir($dst);
		}
		// 搬移
		@rename($src, $dst);
	}
  

}