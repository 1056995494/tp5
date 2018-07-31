<?php
namespace app\api\controller\v1;
use app\api\model\Decorate as Deco;
use think\Request;
class Decoration
{
	public function add()
	{
		try{
			$data=input();
			$deco=new Deco;
			if($deco->save($data)){
				return 1;
			}else{
				return $deco->getLastSql();
				//return $deco->getError();
			}
		}catch(\Exception $e){
			abort(404,$deco->getLastSql());
		}
		
	}
	public function deletet(){
		$data=input();
		foreach($data as $value){
			Deco::get($value)->delete();
		}
		return '删除成功';
	}
	public function test(Request $request){
		$data=$request->getInput();
		return $data;
	}
}