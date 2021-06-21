<?php
/*
 2008 Copyright www.inverudio.com
 Attribution-Noncommercial-Share Alike 3.0 Unported
 http://creativecommons.org/licenses/by-nc-sa/3.0/legalcode
 To remove copyright link in guestbook (NOT this copyright notice!), contact author
*/

if($_SERVER['REQUEST_METHOD'] != "POST")exit;
$cururl = str_replace('gb-exec.php','index.php','http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
//if($cururl != $_SERVER['HTTP_REFERER'])exit;
require_once('config.php');
if($mypagetitle==''||$mypagetitle=='//'||$mysecretword==''){
        echo 'You need to set up config.php first!';
        exit;
}
$ip = $_SERVER['REMOTE_ADDR'];
$hash_ip = md5($mysecretword.$ip);
$time = time() + $time_zone*60*60;
$hash_time = md5($mysecretword.$time);

if (!file_exists('bips.php'));
else {
        $fcontent = @file_get_contents('bips.php');
        $ipstr = "<?php /* ".$ip." */ ?>";
        if(strpos($fcontent, $ipstr)>0)exit;
}

function nlp2nl($str) {
    return preg_replace("/(\r\n|\n|\r)+/", "\n", $str);
}
function st2s($str) {
    return preg_replace('/\s\s+/', ' ', preg_replace("/\t+/", " ", $str));
}

$name = stripslashes(strip_tags($_POST['name']));
$email = stripslashes(strip_tags($_POST['email']));
$message = stripslashes(strip_tags($_POST['message']));
$messageF = preg_replace("/(\r\n|\n|\r)/", "<br />", $message);
$spam = strip_tags(str_replace("'",'',$_POST['spam']));

if($enable_guest_images&&$default_guest_image){
        if($email)$grav_url = $email;
        else $grav_url = $default_guest_image;
        if($grav_url)$gravatar = "<img height=\"$guest_image_size\" src=\"$grav_url\" />";
        else $gravatar = "";
}
else $gravatar = "";

if($_POST['i']!=0){$i = (int)$_POST['i'];$si = '?i='.$i;}
else $si = '';

if(strtolower($spam)==$antispam_word&&strlen(trim($message))>2){
        $file = "gbcontentfile.php";
        if (!file_exists($file)) {
                touch($file);
                $fc = fopen($file, 'w');
                
                fwrite($fc, $copyrightlink);
                fclose($fc);
        }
        $fh = @fopen($file, "r");
        $fcontent = @fread($fh, filesize($file));
        $tzs = '+';if($time_zone < 0)$tzs = '';
        $timestr = gmdate("D, d M Y H:i:s",$time)." GMT"." $tzs$time_zone";
        $newcontent = "
<?php /* IP".$hash_ip." f".$hash_time." */ ?><1>".$gravatar." ".$name."<2>".$timestr."<3>".$messageF."<4><?php /* t".$hash_time." IP".$hash_ip." */ ?>
";
        $newcontent = st2s($newcontent);
        $towrite = nlp2nl("$newcontent $fcontent");
        fclose($fh);
        $fh2 = fopen($file, 'w+');
        fwrite($fh2, $towrite);
        fclose($fh2);
        $mailmessage = "
".$gravatar." ".$name." wrote: 

".$message."

<-----end of user submission----->

Above is a new comment in your guestbook. you can see it here:
".$cururl."


To DELETE this comment visit this link:
".$cururl."?t=".$hash_time."&i=".$i."


To DELETE ALL comments submitted by this IP address (".$ip.") visit this link:
".$cururl."?a=".$hash_ip."&i=".$i."


To BLOCK IP address ".$ip." visit this link:
".$cururl."?block=".$ip."&a=".$hash_ip."&i=".$i."
";
        mail($e_mail, 'New GuestBook message', $mailmessage);
        $mailmessage = "
".$message."

<-----end of your submission----->
Above is your comment in a guestbook. you can see it here:
".$cururl."

To DELETE your comment visit this link:
".$cururl."?t=".$hash_time."&i=".$i."

";
        if($email)mail($email, 'New GuestBook message', $mailmessage);
@header("Content-type: text/html; charset=utf-8");  
@header("location: index.php$si");
}
else echo 'You forgot to fill in a required field!';
exit();

?>
