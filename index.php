<?php
/*

*/

require_once('config.php');
require_once('stuff/version.php');
require_once('stuff/index_header.php');
require_once('news/news.php');
$page = 0;
$page = (int)$_GET['p']; 

$i = 0;
$i = (int)$_GET['i']; 
if($_GET['i']!=0){$i = (int)$_GET['i'];$si = '&amp;i='.$i;}
else $si = '';

$hash_time = ''; 
$hash_time = $_GET['t']; 
if(!ctype_alnum($hash_time)&&$hash_time!='')$hash_time = '';

$hash_ip = ''; 
$hash_ip = $_GET['a']; 
if(!ctype_alnum($hash_ip)&&$hash_ip!='')$hash_ip = '';

$block = ''; 
$block = $_GET['block']; 
if(preg_match('/[^.0-9]/',$block)&&$block!='')$block = '';

function nlp2nl($str) {return preg_replace("/(\r\n|\n|\r)+/", "\n", $str);}

if($hash_time!=''){
        $file = "gbcontentfile.php";
        if (!file_exists($file));
        else {
                $fcontent = @file_get_contents($file);
                $pattern = " f".$hash_time."(.*)t".$hash_time." ";
                $newcontent = ereg_replace($pattern, "", $fcontent);//I went cray with RE's so I did it simple and stupid in 3 lines
                $newcontent = preg_replace("/[a-zA-Z0-9]{68}/", "", $newcontent);
                $newcontent = nlp2nl(str_replace('<?php /*  */ ?>','',$newcontent));
                $fh2 = fopen($file, 'w');
                fwrite($fh2, $newcontent);
                fclose($fh2);
        }
}        

if($hash_ip!=''){
        $file = "gbcontentfile.php";
        if (!file_exists($file));
        else {
                $fcontent = @file_get_contents($file);
            $pattern = "/IP".$hash_ip."(.*?)IP".$hash_ip."/mis";
                $newcontent = preg_replace($pattern, "", $fcontent);
                $newcontent = nlp2nl(str_replace('<?php /*  */ ?>','',$newcontent));
                $fh2 = fopen($file, 'w');
                fwrite($fh2, $newcontent);
                fclose($fh2);
        }
}        

if($block!=''&&$hash_ip == md5($mysecretword.$block)){
        $file = "bips.php";
        if (!file_exists($file))touch($file);
        $fh = @fopen($file, "r");
        $fcontent = @fread($fh, filesize($file));
        $bip = "
        <?php /* ".$block." */ ?>
        ";
        $towrite = "$bip $fcontent";
        fclose($fh);
        $fh2 = fopen($file, 'w+');
        fwrite($fh2, $bip);
        fclose($fh2);
}        




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<title><?php echo $mypagetitle; ?> - <?php echo $subtitle; ?></title>

<link rel="stylesheet" href="<?php echo $theme; ?>" type="text/css">

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="STYLESHEET" type="text/css" href="http://www.w3.org/StyleSheets/Core/parser.css?family=<?php echo (int)$_GET['i']; ?>&amp;doc=XML" />
<?php echo $page_style; ?>

	<meta charset="UTF-8">
  <meta name="description" content="Your Daily Imageboard written in PHP and HTML! - AbulaChan">
  <meta name="keywords" content="Imageboard, PHP, HTML, 4chan, Chan, AbulaChan, AbulaBoard">
  <meta name="author" content="$aintly2k">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>
<div id="content">
<center><?php echo $index_header; ?></center>
<center><h3><?php echo $mypagetitle; ?> - <?php echo $subtitle; ?> </h3></center>
<small><i><center><?php echo $version; ?></small></i></center>
<!-- pls don't remove the ad :( saintly will be really sad... -->
<hr>
<center><img src="banners/home.jpg" height="120px" width="300px"></img></center>
<hr>





<center><form method="post" action="gb-exec.php">
        <fieldset>
                <label for="name">Boards:</label>
		<small>
                <?php echo $index_boards; ?>
		</small>
		<br>
                <!-- <label for="email">Image (URL):</label> -->
                <!-- <input type="text" class="textfield" name="email" id="email" size="20" /><br /> -->
                <label for="message">News:</label>
		<small>
		[30.05.2021] Your first news!<br>
		<a href="news/">>>View older News...</a>
		</small>
                <!-- <label for="spam"></b>':</label> -->
		<br>
		<br>
		<img src="banners/thumbs.gif" width="80%">
                
        </fieldset>
</form></center>


<?php 
$gbfile = 'gbcontentfile.php';
$fh = @fopen($gbfile, "r");
$fcontent = @fread($fh, filesize($gbfile));
if($fcontent){
        $cnt = substr_count($fcontent,'<?php /* ');
        $cnt = $cnt/2;
        $maxp = 0;
        if($cnt>$page_comments)$maxp = (int)($cnt/$page_comments);
        preg_match_all("/\<\?php .*? \?\>(.*?)\<\?php .*? \?\>/is", $fcontent, $entries);
        $ini = $page*$page_comments;
        $end = ($page+1)*$page_comments;
$ovo = array('<1>','<2>','<3>','<4>');
$sovim = array(
"<div class=\"gbsign\">
        <p><span class=\"gbname\">",
"</span> <span class=\"gbdate\">",
"</span>
        </p>
        <p class=\"gbmessage\">",
"
        </p>
</div>
"
);
        for($j=$ini;$j<$end;$j++)echo str_replace($ovo,$sovim,$entries[1][$j]);
        if($maxp>-1){
                echo '<p>'.strstr($fcontent,'<!--').' Page '; $gap = "";
                for($j=0;$j<$maxp+1;$j++){
                        if($j==0||$j==$maxp||($j-$page)*($j-$page)<26){
                                echo $gap; $gap = "";
                                if($j!=$page)echo "- <a href=\"index.php?p=".$j.$si."\">".($j+1)."</a> " ;
                                else echo "- <b>".($j+1)."</b> " ;
                        }
                        else $gap = "<b>.....</b>"; 
                }
                echo '</p>';
        }
}
?>

</div>
</body>
</html>

