<?php
/*
<<<<<<< HEAD
	閫氳繃娣樺疂鏁版嵁搴撴彁渚涚殑api锛岀劧鍚庡埄鐢ㄥ凡鏈塈P锛屽垽鏂綊灞炲湴
=======
	通过淘宝数据库提供的api，然后利用已有IP，判断归属地
>>>>>>> parent of df97f03... Revert "taobao's api"
	by qing.chen
*/
class taobao 
{
	public $ip;

	function __construct($ip)
	{
		if(isset($ip)){
			$this->ip=$ip ;
		}else{
			$this->ip="";
		}
	}
	
	private function get_content($ip_addr)
	{
		if(empty($ip_addr)){
			exit("this need one ip address !");
		}

		$url_handle = curl_init();
		curl_setopt($url_handle,CURLOPT_URL,"http://ip.taobao.com/service/getIpInfo.php?ip=".$ip_addr);
		curl_setopt($url_handle, CURLOPT_RETURNTRANSFER, true) ;
		$output = curl_exec($url_handle);
		curl_close($url_handle);
		if($output === FALSE){
			return false ;
		}else{
			return $output;
		}
	
	}
	private function json_process_decode()
	{
		$output = $this->get_content($this->ip);
		if(! $output)
			exit("get content from ip.taobao.com error");
		$content = json_decode($output);
		if($content->{'code'} == 0)
			return $content	;
		else
			return false ;
	}
	
	public function get_region()
	{
		$content = $this->json_process_decode();
		return $content->{'data'}->{'region'};
	}
		
	public function get_isp()
	{
		$content = $this->json_process_decode();
                return $content->{'data'}->{'isp'};
	}
	public function get_country()
	{
		$content = $this->json_process_decode();
                return $content->{'data'}->{'country'};
	}
	public function get_city()
	{
		$content = $this->json_process_decode();
                return $content->{'data'}->{'city'};
	}

}
?>
