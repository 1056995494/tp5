<?php
interface Animals{
	public function eat();
}
class Donkey implements Animals{
	public function eat(){
		echo '驴子再吃';
	}
}
class Monkey implements Animals{
	public function eat(){
		echo '猴子再吃';
	}
}
class Factory{
	public static function getAnimal($data){
		switch ($data){
			case 'donkey':
				return new Donkey();
				break;
			case 'monkey':
				return new Monkey();
				break;
			default:
				return null;
				break;
		}
	}
}
$animal=Factory::getAnimal('donkey');
$animal->eat();