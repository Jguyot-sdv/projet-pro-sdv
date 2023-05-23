<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));	
    $ip = escapeshellarg($_POST['ip']);
    $command = $_POST['command'];

    switch ($command) {
        case 'nmap':
	    $output = shell_exec("nmap -sV -A -T5 -p- $ip");
            break;
        case 'nslookup':
            $output = shell_exec("nslookup -type=any -debug $ip");
	    break;
	case 'dig':
	    $output = shell_exec("dig +nocmd +noall +answer +stats -t any $ip");
	    break;
	case 'sqlmap':
	    $output = shell_exec("sqlmap -u \"$ip\" --risk=3 --level=5 --dbs --threads=10 --eta --dbms=mysql --os=linux -p \"id,user,username,password,email,search,category,type,filter,page,date,year,month\" --batch --smart -v");
	    break;
	case 'nikto':
	    $output = shell_exec("nikto -h $ip -p 80,443 -C all -evasion A");
	    break;
	case 'traceroute':
            $output = shell_exec("traceroute $ip");
            break;
        case 'ping':
            $output = shell_exec("ping -c 10 $ip");  // Pings the host 4 times only.
            break;
        case 'netcat':
            $output = shell_exec("printf 'GET / HTTP/1.1\r\nHost: $ip\r\nUser-Agent: Netcat\r\nAccept: */*\r\nConnection: close\r\n\r\n' | nc $ip 80 -q 1");	
	    break;
        case 'whois':
            $output = shell_exec("whois $ip");
	    break;
	 case 'gobuster':
            $output = shell_exec("gobuster dir -u http://$ip -w /usr/share/wordlists/dirb/common.txt");
            break;
	default:
            $output = "Unknown command: $command";
    }
    // save the output to a file
    $filename = "./logs/$command-" . date('Y-m-d-H-i-s') . ".txt";
    file_put_contents($filename, $output);

    // return the output and filename in JSON format
    echo json_encode(['output' => $output, 'filename' => $filename]);
}
?>
