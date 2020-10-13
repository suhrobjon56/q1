<?php
ob_start();
define('API_KEY','1352792638:AAE9hLNWRxwIl7kUOPkbFGWkEbczFtPhS8Y');
$admin = "1148407"; //admin id
$soat= date('H:i', strtotime('2 hour'));

   function del($nomi){
   array_map('unlink', glob("$nomi"));
   }

   function ty($ch){ 
   return bot('sendChatAction', [
   'chat_id' => $ch,
   'action' => 'typing',
   ]);
   }

function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

  
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$cty = $message->chat->type;
$tx = $message->text;
$usergr = $update->callback_query->message->chat->username;
$userg = $message->chat->username;
$name = $message->chat->first_name;
$user = $message->from->username;
$kun1 = date('z', strtotime('2 hour'));
$fadmin = $message->from->id;
$ismi = $update->message->from->first_name;
$ismi2 = $update->message->from->last_name;
$kanal = file_get_contents("chan/$cid/chan.txt");
$til = file_get_contents("til/$cid.txt");
$name = "<a href='tg://user?id=$fadmin'> $ismi $ismi2 </a>";
$bio = file_get_contents("bio/$cid/bio.txt");
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$callcid = $update->callback_query->message->chat->id;
$calltext = $update->callback_query->message->text;
$clid = $update->callback_query->from->id;
$callmid = $update->callback_query->message->message_id;
$gid = $update->callback_query->message->chat->id;

mkdir("til");
mkdir("chan");
mkdir("bio");
mkdir("chan/$cid");
mkdir("bio/$cid");
$gett = bot('getChatMember', ['chat_id' => $cid,'user_id' => $fadmin,]);
     $get = $gett->result->status;

$gett2 = bot('getChatMember', ['chat_id' => $callcid,'user_id' => $clid,]);
     $get2 = $gett2->result->status;


if((stripos($tx,"/uHelp") !== false) and $cty=="supergroup" or $cty=="group"){
 bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"🌠 *Buyruqlar Ro'yhati*:
📡 `/set @kanaluseri` - Guruhga Kanal Biriktirish,
🗑 `/delch` - Biriktirlgan Kanalni Uzish
📝 `/bio MATN` - Guruhga Bio Sozlash (Vaqt Avtomatik Qo'shiladi),
🗑 `/delbio` - Sozlangan Bioni o'chirish
‼️ Bot Ishlashi Uchun Kiritgan Kanalingizga Botni Admin Qilishingiz Kerak!
📛 BOT KANALDA ADMIN BO'LMASA ISHLAMAYDI!",
'parse_mode'=>"markdown",
]);
}



    if((stripos($tx,"/start") !== false) and $cty=="supergroup" or $cty=="group"){
  $text = "🇺🇿 Tilni Tanlang:
🇷🇺 Выберите язык";
  $a=json_encode(bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>$text,
   'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🇺🇿 UZ','callback_data'=>"UZ"],['text'=>'🇷🇺 RU','callback_data'=>"RU"]],
       ]
    ])
  ]));
}
   if(stripos($tx,"/start reknarx") !== false){
  bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"@uChanBot'ning guruhlarda korinadigan kanalga a'zo bo'ling deyilgan qismida reklama berish narxi 1 kun uchun 20 ming sum! Reklama 1 qatordan iborat bo'ladi. Shartlarga rozi bo'lsangiz @Abroriy yoki @AbroriyBot bilan bog'lanib, to'lov qilishingiz mumkin",
  ]);
}
if($get2 =="creator" or $get2 == "creator"){
if($data=="UZ"){
  unlink("til/$callcid.txt");
  sleep(1);
   $baza=file_get_contents("til/$callcid.txt");
   if(mb_stripos($baza,$callcid) !==false){
   }else{
   $txt="UZ";
   $file=fopen("til/$callcid.txt","a");
   fwrite($file,$txt);
   fclose($file);
   }
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"🇺🇿 O'zbek tili o'rnatildi",
      ]);
    $kanal = file_get_contents("chan/$callcid/chan.txt");
    if ($kanal != NUll){
$startUZ = "❗️ Diqqat! Endi [@$usergr] guruhida habar yozish uchun $kanal kanaliga a'zo bo'lish shart!
📝 /uHelp - Buyruqlarni Ko'rish";
} else {
$startUZ = "👋 Assalom Alaykum Admin!
🛠 Guruhni Kanalingizga Sozlang:
📡 `/set @kanaluseri` - Guruhga Kanal Biriktirish,
🗑 `/delch` - Biriktirlgan Kanalni Uzish
📝 `/bio MATN` - Guruhga Bio Sozlash (Vaqt Avtomatik Qo'shiladi),
🗑 `/delbio` - Sozlangan Bioni o'chirish
‼️ Bot Ishlashi Uchun Kiritgan Kanalingizga Botni Admin Qilishingiz Kerak!
📛 BOT KANALDA ADMIN BO'LMASA ISHLAMAYDI!
";
}
    sleep(2);
  bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>$startUZ,
        'parse_mode'=>'markdown',
]);
}

if($data=="RU"){
  unlink("til/$callcid.txt");
  sleep(1);
   $baza=file_get_contents("til/$callcid.txt");
   if(mb_stripos($baza,$callcid) !==false){
   }else{
   $txt="RU";
   $file=fopen("til/$callcid.txt","a");
   fwrite($file,$txt);
   fclose($file);
   }
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"🇷🇺 Русский язык установлен",
      ]);
    $kanal = file_get_contents("chan/$callcid/chan.txt");
    if ($kanal != NUll){
$startRU = "Diqqat! Endi @$usergr guruhida habar yozish uchun $kanal kanaliga a'zo bo'lish shart!";
} else {
$startRU = "👋 Здраствуйте Админ!
🛠 Настройте группу для своего канала:
📡 `/set @channelusername` - Назначение канала группе,
🗑 `/delch` - Отключить канал

‼️ Вы должны настроить бота на канал как Админ, который вы ввели, чтобы включить бота!
📛 БОТ НЕ РАБОТАЕТ БЕЗ АДМИНА НА КАНАЛ!
";
}
    sleep(2);
  bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>$startRU,
        'parse_mode'=>'markdown',
]);
}
}







if($til=="UZ"){
if((mb_stripos($tx,"/set") !== false) and $get =="creator"){ 
$ex = explode(" ",$tx);
 unlink("chan/$cid/chan.txt");
  sleep(1);
   $baza=file_get_contents("chan/$cid/chan.txt");
   if(mb_stripos($baza,$cid) !==false){
   }else{
   $txt="$ex[1]";
   $file=fopen("chan/$cid/chan.txt","a");
   fwrite($file,$txt);
   fclose($file);
   }
bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"Rahmat Admin! Guruhingiz Uchun $ex[1] Kanali Sozlandi!
Endi Botni $ex[1] Kanalingizga Admin Qilgansiz, Bot To'liq Ishga Tushadi",
'parse_mode'=>"html",
]);
}
if((mb_stripos($tx,"/bio") !== false) and $get =="creator"){ 
$ex = explode(" ",$tx);
 unlink("bio/$cid/bio.txt");
  sleep(1);
   $baza=file_get_contents("bio/$cid/bio.txt");
   if(mb_stripos($baza,$cid) !==false){
   }else{
   $txt="$ex[1] $ex[2] $ex[3] $ex[4] $ex[5] $ex[6] $ex[7] $ex[8] $ex[9] $ex[10] $ex[11] $ex[12] $ex[13] $ex[14] $ex[15] $ex[16] $ex[17] $ex[18] $ex[19] $ex[20] $ex[21] $ex[22] $ex[23] $ex[24] $ex[25] $ex[26] $ex[27] $ex[28] $ex[29] $ex[30] $ex[31] $ex[32]";
   $file=fopen("bio/$cid/bio.txt","a");
   fwrite($file,$txt);
   fclose($file);
   }
bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"✅ Rahmat Admin! Guruhingiz Uchun Bio Sozlandi, Istalgan Bitta Habardan So'ng Bioga Qarang",
'parse_mode'=>"html",
]);
}
$soat= date('H:i', strtotime('2 hour'));
$usa = bot('getChatMembersCount',[
'chat_id'=>$chat_id,
]);
$count = $usa->result;
$kun3 = date('N'); 
$yil =date('Y');
$kun =date('d-M', strtotime('2 hour')); 
$hafta="1Dushanba1 2Seshanba2 3Chorshanba3 4Payshanba4 5Juma5 6Shanba6 7Yakshanba7"; 
$ex=explode("$kun3",$hafta); 
$hafta1="$ex[1]";
if ($bio != NUll){ 
if($soat<"77"){
bot('setChatDescription',[ 
        'chat_id'=>$cid, 
        'description'=>"$bio
🗓 Bugun: $kun $yil-yil
🔵 Hafta Kuni: $hafta1
⌚️ Hozir Vaqt: $soat", 
        'parse_mode'=>'html', 
    ]); 
}
}
if(($tx=="/delch") and ($get =="creator")){ 
 unlink("chan/$cid/chan.txt");
 
 bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"Tashakkur Admin, Endi @$userg guruhiga hech qanday kanal ulanmagan!",
'parse_mode'=>"html",
]);
}
if(($tx=="/delbio") and ($get =="creator")){ 
 unlink("bio/$cid/bio.txt");
 
 bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"Tashakkur Admin, Endi @$userg guruhiga hech qanday bio sozlanmagan!",
'parse_mode'=>"html",
]);
}
}
if($til=="RU"){
if((mb_stripos($tx,"/set") !== false) and $get =="creator"){ 
$ex = explode(" ",$tx);
 unlink("chan/$cid/chan.txt");
  sleep(1);
   $baza=file_get_contents("chan/$cid/chan.txt");
   if(mb_stripos($baza,$cid) !==false){
   }else{
   $txt="$ex[1]";
   $file=fopen("chan/$cid/chan.txt","a");
   fwrite($file,$txt);
   fclose($file);
   }
bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"Спасибо Админ! Канал $ex[1] настроен для вашей группы!
Теперь, если вы выберете Бот в качестве администратора для своего канала $ex[1], бот запустится полностью!",
'parse_mode'=>"html",
]);
}
if(($tx=="/delch") and ($get =="creator")){ 
 unlink("chan/$cid/chan.txt");
 
 bot ('SendMessage',[
"chat_id"=>$cid,
'text'=>"Канал отключен, каналы больше не подключены в группе!",
'parse_mode'=>"html",
]);
}
}
if ($til == "UZ"){
if ($kanal != NUll){
  if(substr($fadmin,0,6) == "777000"){
  }else{
  if(isset($tx)){
  $gett = bot('getChatMember',[
  'chat_id' =>$kanal,
  'user_id' => $fadmin,
  ]);
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "administrator" or $gget == "creator"){

    }
    else{
      
    bot('deleteMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
          ]);
    bot('sendMessage',[
      'chat_id'=>$cid,
      'parse_mode'=>'html',
      'disable_web_page_preview'=>'true',
      'text'=>"⭕️ $name Siz $kanal ga a'zo bo'lsangizgina bu guruhda yoza olasiz.
      
<a href='http://t.me/FutureNet_Uz_Bot?start=115056828'>♻️ PUL ISHLASH</a>",
    ]);
    }
}
}
}
}
if ($til == "RU"){
if ($kanal != NUll){
  if(substr($fadmin,0,6) == "777000"){
  }else{
  if(isset($tx)){
  $gett = bot('getChatMember',[
  'chat_id' =>$kanal,
  'user_id' => $fadmin,
  ]);
  $gget = $gett->result->status;

  if($gget == "member" or $gget == "administrator" or $gget == "creator"){

    }
    else{
      
    bot('deleteMessage',[
      'chat_id'=>$cid,
      'message_id'=>$mid,
          ]);
    bot('sendMessage',[
      'chat_id'=>$cid,
      'parse_mode'=>'html',
      'disable_web_page_preview'=>'true',
      'text'=>"⭕️ $name Вы можете писаться на эту группу, только если вы являетесь участником $kanal.
<a href='http://t.me/FutureNet_Uz_Bot?start=115056828'>🎖 Заработать</a>",
    ]);
    }
}
}
}
}
if((stripos($tx,"/start") !== false) and $cty=="private"){
  $text = "🇺🇿 Tilni Tanlang:
🇷🇺 Выберите язык";
  $a=json_encode(bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>$text,
   'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🇺🇿 UZ','callback_data'=>"UZp"],['text'=>'🇷🇺 RU','callback_data'=>"RUp"]],
       ]
    ])
  ]));
}  
if($data=="UZp"){
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"❗️ Ushbu bot faqat guruhlarda ishlaydi",
        'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🇺🇿 Loyihalar','callback_data'=>"UZPRO"],['text'=>'🇷🇺 Проекты','callback_data'=>"RUPRO"]],
       ]
    ])
      ]);
}
 if($data=="RUp"){
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"❗️ Этот бот работает только в группах",
        'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🇺🇿 Loyihalar','callback_data'=>"UZPRO"],['text'=>'🇷🇺 Проекты','callback_data'=>"RUPRO"]],
       ]
    ])
      ]);

}
if($data=="UZPRO"){
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"👨‍💻 @PHP_OWN Dasturchilar Jamoasi Tasarrufidagi Loyihalar:

💣 @GoPHPbot - Tayyor bot konstruktor!
💣 @uChanBot - Guruhga Kanal Ulaydi!
🎁 @AdvokatBot - Guruhlarni nazorat qilish
🎁 @YoqtiBot - Advokat nusxasi
🎁 @MixChangeBot - Valyuta obmennik (offline)
🎁 @UzChanBot - Kanaldagi Postlarga Avtomatik Like&Share qo'yuvchi
🎁 @UzFileNameBot - Fayllarni Qayta Nomlovchi Bot
🌙 @IslomMediaBot - Islomiy bot
🎁 @MakeMediabot - Media Maker
🎁 @ChannelMediaBot - Kanalda MP3 Maker

📡 @PHP_OWN - Dasturchilar Kanali
📡 @Qitmirvoy - Universal kanal

😎 @Abroriy - Asosiy Dasturchi",
'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🔙 Ortga qaytish','callback_data'=>"UZp"]],
       ]
    ])

      ]);
}
if($data=="RUPRO"){
    bot('editmessagetext',[
        'chat_id'=>$callcid,
        'message_id'=>$callmid,
        'text'=>"👨‍💻 Проекты, связанные с командой программистов @PHP_OWN:

💣 @GoPHPbot - Готовый конструктор ботов!
💣 @uChanBot - Подключить канал на группу!
🎁 @AdvokatBot - Групповой контроль
🎁 @YoqtiBot - Копия AdvokatBota
🎁 @MixChangeBot - Обмен валюты (offline)
🎁 @UzChanBot - Работа с постами канала (Like&Share) 
🎁 @UzFileNameBot - Бот для переименования файлов
🌙 @IslomMediaBot - Исламский бот
🎁 @MakeMediabot - Медиа мейкер
🎁 @ChannelMediaBot - MP3 мейкер (для каналов)

📡 @PHP_OWN - Канал разработчика
📡 @Qitmirvoy - Универсальный канал

😎 @Abroriy - Основной программист",
'reply_markup'=>json_encode([
   'inline_keyboard'=>[
   [['text'=>'🔙 Вернуться назад','callback_data'=>"RUp"]],
       ]
    ])
      ]);
}



?>



