<?php

$access_token = 'pwyQ98/qu170TI3fm1oEWiPjYO3ROkAxo6rG2rew3iGeTRuIcAUVXFlaJxK/HhFuK0F4PNvTsGTZTucHKWGjQYTRBroFt4wjzOrQaifI43b8tn1O/VolxrN3tchOb+TcXynPvHaHzb0TMWr7KsxP8QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
