<?php
namespace app\test\controller;
use Qcloud\Sms\SmsSingleSender;
class Message
{
	public function smsSend(){
		$appid=1400112536;
		$appkey='dbfe9e7e980ee8923b61c7d7bc6e29d1';
		$phoneNumber="18769405778";
		$temlId=157922;
		//$sesSign="宋涛工作经验学习总结";
		$params=["44734","5"];
		try{
		$sender=new SmsSingleSender($appid,$appkey);
		$result=$sender->sendWithParam("86",$phoneNumber,$temlId,$params,"","","");
		$rsp=json_decode($result);
		echo $result;
		}catch(\Exception $e){
			echo var_dump($e);
		}
	}
}