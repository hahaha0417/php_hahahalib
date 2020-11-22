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
注意 : c++ hahahalib 參考此實作

https://www.php.net/manual/en/function.socket-create.php
https://www.itread01.com/articles/1478023512.html * 
*/
trait hahaha_socket_trait
{
	// 預設應該是block，需要再確認
	public $Is_Block_ = true;
	//-----------------------------------------------------------
	// Basic
	//-----------------------------------------------------------
	public function Set_Block()
	{
		return $this->Is_Block_ = socket_set_block($this->Socket_) ? true : $this->Is_Block_;
		
	}
	
	public function Set_Non_Block()
	{
		return $this->Is_Block_ = socket_set_nonblock($this->Socket_) ? true : $this->Is_Block_;
		
	}
	
	public function Is_Block()
	{
		return $this->Is_Block_;
		
	}
	
	//-----------------------------------------------------------
	// Receive
	//-----------------------------------------------------------
	/*
	https://www.php.net/manual/en/function.socket-read.php
	
	PHP_BINARY_READ (Default) - use the system recv() function. Safe for reading binary data.
	PHP_NORMAL_READ - reading stops at \n or \r
	*/
	public function Read($socket, $length, $type = PHP_BINARY_READ)
	{
		return socket_read($socket, $length, $type);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recv.php
	
	MSG_OOB	Process out-of-band data.
	MSG_PEEK	Receive data from the beginning of the receive queue without removing it from the queue.
	MSG_WAITALL	Block until at least len are received. However, if a signal is caught or the remote host disconnects, the function may return less data.
	MSG_DONTWAIT	With this flag set, the function returns even if it would normally have blocked.
	*/
	public function Receive(&$socket, &$buffer, $length = 1024, $flags = MSG_WAITALL)
	{
		return socket_recv($socket, $buffer, $length, $flags);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recvfrom.php
	
	MSG_OOB	Process out-of-band data.
	MSG_PEEK	Receive data from the beginning of the receive queue without removing it from the queue.
	MSG_WAITALL	Block until at least len are received. However, if a signal is caught or the remote host disconnects, the function may return less data.
	MSG_DONTWAIT	With this flag set, the function returns even if it would normally have blocked.
	
	port = 0
	*/
	public function Receive_From($name, $port, &$buffer, $length = 1024, $flags = MSG_WAITALL)
	{
		return socket_recv($this->Socket_, $buffer, $length, $flags, $name, $port);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recvmsg.php
	
	MSG_OOB	Process out-of-band data.
	MSG_PEEK	Receive data from the beginning of the receive queue without removing it from the queue.
	MSG_WAITALL	Block until at least len are received. However, if a signal is caught or the remote host disconnects, the function may return less data.
	MSG_DONTWAIT	With this flag set, the function returns even if it would normally have blocked.
	
	這個在windows不能用，linux不確定
	*/
	public function Receive_Message(&$socket, &$message, $flags = MSG_WAITALL)
	{
		return socket_recvmsg($socket, $message, $flags);
		
	}
	
	
	//-----------------------------------------------------------
	// Send
	//-----------------------------------------------------------
	/*
	https://www.php.net/manual/en/function.socket-write.php
	
	*/
	public function Write($socket, &$buffer, $length = 1024)
	{
		return socket_write($socket, $length, $type);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recv.php
	
	MSG_OOB	Send OOB (out-of-band) data.
	MSG_EOR	Indicate a record mark. The sent data completes the record.
	MSG_EOF	Close the sender side of the socket and include an appropriate notification of this at the end of the sent data. The sent data completes the transaction.
	MSG_DONTROUTE	Bypass routing, use direct interface.

	https://www.php.net/manual/en/sockets.constants.php
	MSG_EOF (integer)
	Not available on Windows platforms.
	*/
	public function Send(&$socket, &$buffer, $length = 1024, $flags = 0)
	{
		return socket_send($socket, $buffer, $length, 0);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recvfrom.php
	
	MSG_OOB	Send OOB (out-of-band) data.
	MSG_EOR	Indicate a record mark. The sent data completes the record.
	MSG_EOF	Close the sender side of the socket and include an appropriate notification of this at the end of the sent data. The sent data completes the transaction.
	MSG_DONTROUTE	Bypass routing, use direct interface.
	
	port = 0

	https://www.php.net/manual/en/sockets.constants.php
	MSG_EOF (integer)
	Not available on Windows platforms.
	*/
	public function Send_To($address, $port, &$buffer, $length = 1024, $flags = 0)
	{
		return socket_sendto($this->Socket_, $buffer, $length, $flags, $address, $port);
		
	}
	
	/*
	https://www.php.net/manual/en/function.socket-recvmsg.php
	
	MSG_OOB	Send OOB (out-of-band) data.
	MSG_EOR	Indicate a record mark. The sent data completes the record.
	MSG_EOF	Close the sender side of the socket and include an appropriate notification of this at the end of the sent data. The sent data completes the transaction.
	MSG_DONTROUTE	Bypass routing, use direct interface.

	https://www.php.net/manual/en/sockets.constants.php
	MSG_EOF (integer)
	Not available on Windows platforms.
	
	這個在windows不能用，linux不確定
	*/
	public function Send_Message(&$socket, &$message, $flags = 0)
	{
		return socket_sendmsg($socket, $message, $flags);
		
	}
	
	//-----------------------------------------------------------
	// Options
	//-----------------------------------------------------------
	/*
	https://www.php.net/manual/en/function.socket-get-option.php
	
	$option
	ex. SO_BROADCAST
	*/
	public function Get_Option(&$socket, $option_name, $level = SOL_SOCKET)
	{
		return socket_get_option($socket, $level, $option_name);
	}
	
	/*
	https://www.php.net/manual/en/function.socket-set-option.php
	
	$option
	ex. SO_BROADCAST
	*/
	public function Set_Option(&$socket, $option_name, $option_value, $level = SOL_SOCKET)
	{
		return socket_set_option($socket, $level, $option_name, $option_value);
	}

	//-----------------------------------------------------------
	// Error
	//-----------------------------------------------------------
	public function Clear_Error()
	{
		socket_clear_error($this->Socket_);
		
	}
	
	//-----------------------------------------------------------
	// 
	//-----------------------------------------------------------

}
