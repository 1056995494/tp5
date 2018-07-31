<?php
namespace app\learn\controller;
use think\Controller;
use app\learn\model\User;
use think\Request;
use PHPMailer\PHPMailer\PHPMailer;
use think\Session;
use Qcloud\Sms\SmsSingleSender;
class Index extends Controller
{
	//主页
	public function index(Request $request){
		$this->assign('title','主页');
		$name='';
		$hidden='';
		if(Session::has('id')){
			$hidden='hidden';
			$name=(User::get($request->session('id')))->name;
		}
		$this->assign('name',$name);
		$this->assign('hidden',$hidden);
		$this->assign('title','主页');
		$this->view->replace([
			'__CSS__'=>'/static/css',
			'__JS__'=>'/static/learn/js',
		]);
		return $this->fetch();
	}
	//注册界面
   public function region(){
	   $this->assign('title','注册');
	   $this->view->replace([
		   '__CSS__'=>'/static/learn/css/region',
		   '__JS__'=>'/static/learn/js/region'
	   ]);
	   return $this->fetch();
   }
   //注册新增用户,并发送激活邮件
   public function add(Request $request){
	   $data=$request->param();
	   if(strcasecmp(Session::get('phoneactive'),$data['phoneactive'])!==0){
		   $this->error('验证码错误','region');
	   }
	   $data['validate']=uniqid();
	   $user=new User;
	   $result=$user->allowField(true)->save($data);
	   if($result){
		   $mail=new PHPMailer;
		   $mail->isSMTP();
		   $mail->addAddress($data['email'], $data['name']);
		   $mail->isHTML(true);
		   $mail->Subject = '激活邮件';
		   $mail->Body    = '请点击此邮件进行激活<br>'.$request->domain().url('aactive').'?name='.$data['name'].'&validate='.$data['validate'];
		   $result=$mail->send();
		   if(true===$result){
			$this->success('注册成功，激活链接已发送到您的邮箱，请注意查收并进行激活','loginin');
		   }else{
			   $this->error('邮件发送失败');
		   }
	   }else{
		   return $user->getError();
	   }
   }
   //获取短信验证码
   public function phoneactive($phone){
	    $phoneactive=$this->randomkeys(4);
		Session::set('phoneactive',$phoneactive);
	    $appid = 1400112536;
		$appkey = "dbfe9e7e980ee8923b61c7d7bc6e29d1";
		$phoneNumber= $phone;
		$templId = 157922;
		try {
		$sender = new SmsSingleSender($appid, $appkey);
		$params = [$phoneactive, 5];
		$result = $sender->sendWithParam("86", $phoneNumber, $templId,
			$params, "", "", "");
		$rsp = json_decode($result);
		echo $result;
		} catch(\Exception $e) {
		echo var_dump($e);
		}
   }
   //邮件激活链接
   public function aactive($name,$validate){
	   $user=User::getByName($name);
	   if(!empty($user)&&$user->validate==$validate){
		   $user->active=1; 
		   if($user->save()){
			   $this->success('激活成功','loginin');
		   }else{
			   echo '用户已经激活，无需重复点击';
		   }
	   }else{
		   echo '激活失败';
	   } 
   }
   //登陆界面
   public function loginin(){
	   $this->assign('title','登陆');
	   $this->view->replace([
		   '__CSS__'=>'/static/css',
	   ]);
	   return $this->fetch();
   }
   public function ifname($name){
	   $user=User::getByName($name);
	   if(empty($user)){
		   return 0;
	   }else{
		   return 1;
	   }
   }
   //判断登陆
   public function judge(Request $request){
	   $user=User::getByName($request->param('name'));
	   if(empty($user)){
		   $this->error('用户不存在','login');
	   }
	   if($user->password==$request->param('password')){
		   Session::set('name',$user->name);
		   Session::set('password',$user->password);
		   if($user->active==0){
			   $this->view->replace([
					'__CSS__'=>'/static/learn/css',
			   ]);
			   $this->assign('title','是否激活');
			   return $this->fetch('activeornot');
		   }
		   Session::set('id',$user->id);
		   $this->success('登陆成功','index');
	   }else{
		   $this->error('用户名密码不匹配');
	   }
   }
   //进行注销
	public function cancel(){
		Session::clear();
		echo '<script type="text/javascript">window.location.href="http://localhost/learn/index/index.html"</script>';
	}
	//登陆时进行激活
	public function loginactive(Request $request){
		$name=Session::get('name');
		$user=User::getByName($name);
		$validate=$user->validate;
		$email=$user->email;
		echo $email;
		$mail=new PHPMailer;
		$mail->isSMTP();
		$mail->addAddress($email,$name);
		$mail->isHTML(true);
		$mail->Subject='激活邮件';
		$mail->Body='请点击此邮件进行激活<br>'.$request->domain().url('aactive').'?name='.$name.'&validate='.$validate;
		if($mail->send()){
			$this->success('注册成功，激活链接已发送到您的邮箱，请注意查收并进行激活',url('loginin'));
		}else{
			$this->error('邮件发送失败',url('loginin'));
		}
	}
   //生成固定长度的随机字符串
   function randomkeys($length)   
	{   
		$pattern = '1234567890ABCDEFGHIJKLMNPQRSTUVWXYZ';
		$count=strlen($pattern)-1;
		$key='';
		for($i=0;$i<$length;$i++)   
		{   
        $key .= $pattern[mt_rand(0,$count)];    //生成php随机数   
		}   
		return $key;   
	}   
}
