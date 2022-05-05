<?php


$url = "url_to_get";
$ch = curl_init($url);


//curl_setopt($ch,CURLOPT_URL, "http://localhost:5000/users");
curl_setopt($ch,CURLOPT_URL,"http://api.ec2lt.sn/affichecomptes");

curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
#curl_setopt($ch,CURLOPT_CUSTOMREQUEST,$GET);
#curl_setopt($ch,CURLOPT_HTTPGET,TRUE);
$result = curl_exec($ch);
curl_close();

echo $result;

?>



