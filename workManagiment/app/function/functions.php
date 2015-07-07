<?php
function calculate_time($office_end_time,$end_time)
{
				$dtime=$office_end_time;
				$atime=$end_time;
								 $nextDay=$dtime>$atime?1:0;
				 $dep=EXPLODE(':',$dtime);
				 $arr=EXPLODE(':',$atime);
				 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
				 $hours=FLOOR($diff/(60*60));
				 $mins=FLOOR(($diff-($hours*60*60))/(60));
				 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
				 IF(STRLEN($hours)<2){$hours="0".$hours;}
				 IF(STRLEN($mins)<2){$mins="0".$mins;}
				 IF(STRLEN($secs)<2){$secs="0".$secs;}
				return $hours.':'.$mins.':'.$secs;
}
?>