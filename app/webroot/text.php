$url = 'POST https://apis.live.net/v5.0/me/skydrive/files';
$form_data = array(
   'token'=> 'ACCESS_TOKEN',
   'file' => 'Test',
   'name' => 'Public'
);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
$result = curl_exec($ch);
var_dump(json_decode($result));
curl_close($ch);
