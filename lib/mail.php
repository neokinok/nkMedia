<?
			
	function sendemail($from,$to,$subject,$body) {
	        $head  = '';
                $head  .= "Date: ". date("D, d M Y H:i:s",time()). "\n";
                $head  .= "From: $from\n";
                $head  .= "Sender: $from\n";
                $head  .= "X-Sender: $from\n";
                $head  .= "X-Priority: 3\n";
                $head  .= "X-Mailer: nkmedia\n";
                $head  .= "Mime-Version: 1.0\n";
                $head  .= "Content-Type: text/html; charset=\"windows-1252\"\n";
		$subject = $noustr = str_replace  ('\"' , '"', $subject);	
		$subject = $noustr = str_replace  ("\'" , "'", $subject);
		// send from local server
		$subjectOK = mb_encode_mimeheader($subject,"UTF-8", "B", "\n");
		$m = mail($to, $subjectOK, $body, $head);
	}
?>
