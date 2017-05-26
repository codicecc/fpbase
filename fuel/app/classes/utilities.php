<?php
class utilities{
	static function trim2($str) {
	   return str_replace(" ","",$str);
  }
  static function uppercase2($str) {
	   return strtoupper($str);
  }
  static function standardize2($str) {
	   return self::trim2(self::uppercase2($str));
  }
  static function listOrderField($field){
  	  $s="<a href=\"".Uri::current()."?orderby=".$field."\">+</a><a href=\"".Uri::current()."?orderby=".$field."&order=desc\">-</a>";
  	  return $s;
  }
  static function adminActions($item,$controllerName,$aActions){
  	$t="";
		for($i=0;$i<count($aActions);$i++){
			//if(Auth::has_access(Request::active()->route->segments[1].'.'.$aActions[$i][1])):
			if(Auth::has_access(Request::active()->controller.'.'.$aActions[$i][1])):
				$tstr=array("class" => "btn btn-primary");
				if(($aActions[$i][1]=="delete"))$tstr=array("onclick" => "return confirm('Are you sure?')","class" => "btn btn-danger");
				$t.=" ".Html::anchor('admin/'.$controllerName.'/'.$aActions[$i][1].'/'.$item->id, $aActions[$i][0],$tstr);
			endif;
		}
		return $t;
	}
  static function agrouplabel(){		
		// generate grouplabel array
		$grouplabel=array();
		foreach(Auth::group('Simplegroup')->groups() as $label => $value):
			//Debug::dump($value);
			array_push($grouplabel,array($value=>Auth::group('Simplegroup')->get_name($value)));
		endforeach;
		return $grouplabel;
	}
	static function alanguage(){		
		// generate grouplabel array
		$alanguage=array();
		foreach(Config::get('locales') as $label => $value):
			//Debug::dump($value);
			array_push($alanguage,array($label=>$value));
		endforeach;
		return $alanguage;
	}
}
?>
