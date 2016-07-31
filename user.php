<?php
$directory = 'users';
$users = array_diff(scandir($directory), array('..', '.'));

define('API_KEY','220881773:AAGkt5QQ35id8ZU1mKTqdCFXxD1hE5UEW70');

function makeHTTPRequest($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY
."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function ufile($f){
$content = (int)  file_get_contents($f);
if($content > 1) file_put_contents($f,($content+1));
}

$i = 0;
foreach($users as $u ){
$i++;
if($i > 10 ){
sleep(2);
$i=0;
}
$j = json_decode(file_get_contents("users/$u"));
$r =(makeHTTPRequest("sendMessage",[
'chat_id'=>$j->id,
'text'=>"❗️  ربات بفروش می رسد ( درصورت نبود تقاضا منحل می شود )

سورس این ربات بزودی کامل در گیت هاب قرار میگیرد و این ربات به همراه شناسه و اطلاعات قبلی به فروش می رسد .

جهت سوالات بیشتر با @arshiahp_bot تماس بگیرید.

سازنده:@arshiahp",
'parse_mode'=>'HTML'
]));


if ($r->ok){
ufile("ok");
}
else{
ufile("nok");
}

}
