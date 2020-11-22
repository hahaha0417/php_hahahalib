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

// 修改自下方，只保持程式碼同步
// 有需精進則另外寫
// https://phpro.org/classes/Two-Way-Encryption-With-PHP-Mcrypt.html

// https://community.magento.com/t5/Installing-Magento-2-x/How-can-install-mcrypt-in-xampp-for-windows-10/td-p/90003
// PHP 7.2還不能使用
class hahaha_crypt_pro_crypt 
{
	use \hahahalib\hahaha_instance_trait;
	
    /**
    *
    * This is called when we wish to set a variable
    *
    * @access    public
    * @param    string    $name
    * @param    string    $value
    *
    */
    public function __set($name, $value)
    {
        switch($name)
        {
            case 'key':
			{
			}
            case 'ivs':
			{
			}
            case 'iv':
			{
				$this->$name = $value;
			}
            break;
            default:
			{
				throw new Exception( "$name cannot be set" );
			}
        }
    }

    /**
    *
    * Gettor - This is called when an non existant variable is called
    *
    * @access    public
    * @param    string    $name
    *
    */
    public function __get($name)
    {
        switch($name)
        {
            case 'key':
            return 'keee';

            case 'ivs':
			{
				return mcrypt_get_iv_size( 
					MCRYPT_RIJNDAEL_128, 
					MCRYPT_MODE_ECB 
				);
			}
            case 'iv':
            {
				return mcrypt_create_iv( 
					$this->ivs 
				);
			}
            default:
			{
				throw new Exception( "$name cannot be called" );
			}
        }
    }

    /**
    *
    * Encrypt a string
    *
    * @access    public
    * @param    string    $text
    * @return    string    The encrypted string
    *
    */
    public function Encrypt($text)
    {
        // add end of text delimiter
        $data_ = mcrypt_encrypt( 
			MCRYPT_RIJNDAEL_128, $this->key, 
			$text, 
			MCRYPT_MODE_ECB, 
			$this->iv 
		);
        return base64_encode($data_);
		
    }
 
    /**
    *
    * Decrypt a string
    *
    * @access    public
    * @param    string    $text
    * @return    string    The decrypted string
    *
    */
    public function Decrypt($text)
    {
        $text_ = base64_decode( 
			$text
		);
        return mcrypt_decrypt( 
			MCRYPT_RIJNDAEL_128, 
			$this->key, 
			$text_, 
			MCRYPT_MODE_ECB, 
			$this->iv 
		);

	}
} // end of class