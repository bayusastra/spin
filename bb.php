<?php
function register($rand){
	$endpoint = "/api/spinwin/login?emailid=warungflig$rand@gmail.com&name=Warung+Flig&appversion=1.3";
	return json_decode(curl($endpoint),true);
}
function reff($reff,$uid){
	$rand = rand(12345678,99999999);
	$endpoint = "/api/spinwin/referral?userid=$uid&phoneno=857$rand&referralcode=$reff";
	return json_decode(curl($endpoint),true);
}
function accept_terms($uid){
	$endpoint = "/api/spinwin/updatepolicyaccepted?userid=$uid";
	return json_decode(curl($endpoint),true);
}
function curl($endpoint){
	$h = array();
	$h[] = "Authorization: Ayush@Spinwin@2018#12345";
	$h[] = "User-Agent: Dalvik/2.1.0 (Linux; U; Android 5.1.1; CPH1729 Build/LMY48Z)";
	$h[] = "Host: moongapps.com";
	$h[] = "Connection: Keep-Alive";
	$h[] = "Content-Type: application/x-www-form-urlencoded";
	$h[] = "Content-Length: 0";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://moongapps.com".$endpoint);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "");
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$x = curl_exec($ch); curl_close($ch);
	return $x;
}
echo "?Reff		";
$ref = trim(fgets(STDIN));
echo "?Jumlah		";
$jum = trim(fgets(STDIN));
$a=0;
while($a<$jum){
	$rand = rand(12345678,99999999);
	$uid = register($rand)['userId'];
	$reff = reff($ref,$uid);
	if($reff['isSuccess']==1){
		echo "[$uid] Sukses\n";
	}
	accept_terms($uid);
	$a++;
}