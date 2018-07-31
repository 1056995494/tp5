<?php
namespace app\test\controller;
use think\Request;
use think\Image;
class Upload extends \think\Controller{
	public function index(){
		$this->view->replace([
			'__CSS__'=>'/static/css',
		]);
		$this->assign('title','上传文件');
		return $this->fetch();
	}
	public function up(Request $request){
		$file=$request->file('file1');
		if(empty($file)){
			$this->error('请选择上传文件');
		}
		$info=$file->validate(['ext'=>'jpg,png'])->move('./uploads');
		if($info){
			$this->success('文件上传成功:'.$info->getRealPath());
		}else{
			$this->error($file->getError());
		}
	}
	public function picture(Request $request){
		$file=$request->file('image');
		$result=$this->validate(['image'=>$file],['image'=>'require|image'],['file.require'=>'请选择上传文件','file.image'=>'非法的图像文件']);
		if(true!==$result){
			$this->error($result);
		}
		$image=Image::open($file);
		switch($request->param('type')){
			case 1:
				$image->crop(300,300);
				break;
			case 2:
				$image->thumb(150,150,Image::THUMB_CENTER);
				break;
			case 3:
				$image->flip();
				break;
			case 4:
				$image->filp(Image::FLIP_Y);
				break;
			case 5:
				$image->rotate();
				break;
			case 6:
				$image->water('.logo.png',Image::WATER_NORTHWEST,50);
				break;
			case 7:
				$image->text('thinkphp',VENDOR_PATH.'topthink/think-captcha/assets/ttfs/1.ttf',20,'#ffffff');
				break;
		}
		$savename=$request->time().'.png';
		if($image->save('uploads/'.$savename,'png',100)){
			$this->success('图片处理完毕...', '/uploads/' . $savename, 1);
		}else{
			$this->error('图片处理失败');
		}
	}
}