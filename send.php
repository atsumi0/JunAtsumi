<?php
try {
    $to='atmjun@live.jp';
    $title=$_POST['title'];
    $subject='/r/n会社名：'
    .$_POST['company']
    .'/r/nお名前：'
    .$_POST['name']
    .'/r/nメールアドレス：'
    .$_POST['mail']
    .'/r/nご依頼内容：'
    .$_POST['message'];
    $header = 'From: send_atmjun_server@outlook.jp';
    if(mb_send_mail($to, $title, $subject, $header)) {
    echo "送信完了";
} else {
    echo "送信失敗";
}}
 catch (Exception $e) {
    echo '捕捉した例外: ',  $e->getMessage(), "\n";
}
?>
