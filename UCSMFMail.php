<?php
function availableStatus($url){
    $page = file_get_contents($url);
    preg_match_all("/<div class=\"available--(.*?)\">(.*?)<\/div>/", $page, $match) ? $match[1] : null;
    return $match[2][0];
}
    $status = availableStatus("https://shop.lego.com/en-SE/Millennium-Falcon-75192");
if($status != $argv[1])
{
    exec('sudo crontab -r');
    exec("sudo echo \"*/5 * * * * php /home/pi/UCSMFMail.php '$status' \n\" >> mycron");
    exec('sudo crontab mycron');
    exec('sudo rm mycron');
    $headers = "From: Måns Sandberg<me@email.com";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    mail("myemail@mail.com", "75192 Millennium Falcon Status update", $status, $headers);
}
?>
