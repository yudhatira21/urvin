<?php
include 'curl.php';


echo "Your Email : ";
$mail = trim(fgets(STDIN));

if ($mail != "") {

	while (true) {
		$date = date('Y-md');
		$tgl = explode('-', $date);
		$fake_name = curl('https://fakenametool.net/generator/random/id_ID/indonesia', null, null, false);
		preg_match_all('/<td>(.*?)<\/td>/s', $fake_name, $result);
		$name = $result[1][0];
		$secmail = curl('https://www.1secmail.com/api/v1/?action=getDomainList', null, null, false);
		$domain = json_decode($secmail);
		$rand = array_rand($domain);
		$email = str_replace(' ', '', strtolower($name)).'@gmail.com';



		$page = curl('https://terminalapp.io/waitlist/email?email='.$mail, null, null, false);
		$json = json_decode($page, true);

		$headers = [
			'Host: terminalapp.io',
			'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0',
			'Accept: */*',
			'Accept-Language: en-US,en;q=0.5',
			'Accept-Encoding: gzip, deflate, br',
			'Sec-Fetch-Dest: empty',
			'Sec-Fetch-Mode: cors',
			'Sec-Fetch-Site: cross-site',
			'Connection: keep-alive'
		];


		$post = curl('https://terminalapp.io/waitlist?email='.$email.'&referral='.$json['code'], ' ', $headers, false);

		if (stripos($post, 'success')) {
			echo $json['code'].' | Your position : '.$json['position']."\n";
		} else {
			echo "Failed\n";
		}
	} 

} else {
	echo "Cannot be blank\n";
}
