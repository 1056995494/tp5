<?php
namespace app\api\controller\v3;
use PHPMailer\PHPMailer\PHPMailer;
class Mail{
	public function index($subject,$body){
	 $mail=new PHPMailer();
        try{
            //邮件调试模式
      //      $mail->SMTPDebug = 2;  
            //设置邮件使用SMTP
            $mail->isSMTP();
            // 设置邮件程序以使用SMTP
     //       $mail->Host = 'smtp.163.com';
            // 设置邮件内容的编码
     //       $mail->CharSet='UTF-8';
            // 启用SMTP验证
      //      $mail->SMTPAuth = true;
            // SMTP username
      //      $mail->Username = 'xcx20180531@163.com';
            // SMTP password
     //       $mail->Password = 'a1056995494';
            // 启用TLS加密，`ssl`也被接受
//            $mail->SMTPSecure = 'tls';
            // 连接的TCP端口
//            $mail->Port = 587;
            //设置发件人
      //      $mail->setFrom('xcx20180531@163.com', '宋涛');
           //  添加收件人1
            $mail->addAddress('1056995494@qq.com', 'qq');     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            收件人回复的邮箱
     //       $mail->addReplyTo('xcx20180531@163.com', '宋涛');
//            抄送
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');
            //附件
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            // 将电子邮件格式设置为HTML
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
//            $mail->AltBody = '这是非HTML邮件客户端的纯文本';
            $mail->send();
            echo 'Message has been sent';
       //      $mail->isSMTP();
        }catch (\Exception $e){
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
	}
}