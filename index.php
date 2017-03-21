﻿<?php
$access_token = 'pwyQ98/qu170TI3fm1oEWiPjYO3ROkAxo6rG2rew3iGeTRuIcAUVXFlaJxK/HhFuK0F4PNvTsGTZTucHKWGjQYTRBroFt4wjzOrQaifI43b8tn1O/VolxrN3tchOb+TcXynPvHaHzb0TMWr7KsxP8QdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events']))
{
    // Loop through each event
    foreach ($events['events'] as $event)
    {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text')
        {

            // Get text sent
            $text = $event['message']['text'];

            if ($text == 'ขอหวยหน่อย')
            {
                $ran = rand(00, 99);
                $msg = "ดูจากหน้าตาเอาเลขนี้ไปแล้วกัน {$ran}";
            }
            else if($text == 'อยากซื้อสติ๊กเกอร์ไลน์')
            {
                 $msg = "แอดไลน์มาสั่งเลยที่ LINE ID : kitnuarsira";
            }
            else if($text == 'วันนี้กินไรดี')
            {
                 $msg = "ตอนนี้ยังไม่พร้อม คิดเองไปก่อนนะ";
            }
            else
            {
                $cal = eval('return ' . $text . ';');
                $msg = $text . " เท่ากับ " . $cal . " จ้า";
                if ($cal == $event['message']['text'])
                {
                    $msg = "สวัสดี เราจะช่วยคุณคิดเลขเอง พิมพ์ข้อความเช่น '1+1'";
                }
            }



            // Get replyToken
            $replyToken = $event['replyToken'];

            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $msg
            ];

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result . "\r\n";
        }
    }
}
echo "OK";
