<?php
	$out = '';
	//if(isset($_POST['GO']))
	//{		
		$mach = $_REQUEST["machine"];
		$channel = $_REQUEST["channel"];
		$ip = $_REQUEST["ipaddress"];
		$baud = $_REQUEST["baudrate"];
		$port = $_REQUEST["port"];
		$cmd = $_REQUEST["command"];
		$str = '';
		/*
		switch($mach){
		case "AVERY": */
		if($channel=='COM'){
		if($baud) $str.=' '.$baud;
		if($port) $str.=' '.$port;
		if($mach) $str.=' '.$mach;
		if($cmd){
			$str.=' '.$cmd;
		}
		//echo $str;
		$out = shell_exec("python cb.py".$str);
		$code = mb_detect_encoding($str);
		/*return '<textarea class="col-md-6 form-control" type="text" value="'.$out.'"  name="command"></textarea>';*/
		echo json_encode(array('sent' => $str, 'out'=>$out,'codec'=>$code, 'channel'=>$channel,'Indicator'=>$mach));
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
			echo json_encode(array('sent' => $str, 'out'=>$out,'codec'=>$code, 'channel'=>$channel,'Indicator'=>$mach));
		}
		/*
		break;
		case "BILANCIAI":
		
		
		case "":
		
		}
		*/
		
	//}
	
?>