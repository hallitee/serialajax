<?php
	$out = '';
	//if(isset($_POST['GO']))
	//{		
		$channel = $_REQUEST["channel"];
		$ip = $_REQUEST["ipaddress"];
		$baud = $_REQUEST["baudrate"];
		$port = $_REQUEST["port"];
		$cmd = $_REQUEST["command"];
		$cmd = strtoupper($cmd);
		$str = '';
		if($channel=='COM'){
		if($baud) $str.=' '.$baud;
		if($port) $str.=' '.$port;
		if($cmd){
			//($start)? $cmd=$start.$cmd : $cmd='\x02'.$cmd;
			//($end)? $cmd=$cmd.$end : $cmd=$cmd.'\x03';
			$str.=' '.$cmd;
		}
		//echo $str;
		$out = shell_exec("python ser3.py".$str);
		$code = mb_detect_encoding($str);
		/*return '<textarea class="col-md-6 form-control" type="text" value="'.$out.'"  name="command"></textarea>';*/
		echo json_encode(array('sent' => $str, 'out'=>$out,'codec'=>$code, 'channel'=>$channel));
		}else{
			$con='';
		if($ip) $str.=' '.$ip;
		if($port) $str.=' '.$port;
		if($cmd){
			//($start)? $cmd=$start.$cmd : $cmd='\x02'.$cmd;
			//($end)? $cmd=$cmd.$end : $cmd=$cmd.'\x03';
			$str.=' '.$cmd;
		}			
			$out = shell_exec("python client.py".$str);
			$code = mb_detect_encoding($str);
			//echo json_encode(array('out'=>$con, 'sent'=>$str, 'channel'=>$channel));
			echo json_encode(array('sent' => $str, 'out'=>$out,'codec'=>$code, 'channel'=>$channel));
		}
	//}
	
?>