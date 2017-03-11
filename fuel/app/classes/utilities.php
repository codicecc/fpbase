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
  static function adminActions($item,$controllerName,$aActions){
  	$t="";
		for($i=0;$i<count($aActions);$i++){
			//if(Auth::has_access(Request::active()->route->segments[1].'.'.$aActions[$i][1])):
			if(Auth::has_access(Request::active()->controller.'.'.$aActions[$i][1])):
				$tstr=array("onclick" => "return confirm('Are you sure?')");
				if(!($aActions[$i][1]=="delete"))$tstr="";
				$t.=Html::anchor('admin/'.$controllerName.'/'.$aActions[$i][1].'/'.$item->id, $aActions[$i][0],$tstr);
				$t.=" | ";
			endif;
		}
		$t=substr($t, 0,-3);
		return $t;
	}
}
?>
