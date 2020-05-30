<?php
    //Untuk memastikan bahwa setiap sesi web dimulai dari halaman ini
    define( 'validSession', 1 );
    //ini_set('display_errors', 'On');
    //error_reporting(E_ALL);
    //Periksa keberadaan file config.php. Jika ada, load file tersebut untuk memasukkan variable konfigurasi umum
    if (!file_exists( 'config.php' ) ) 
    {
        exit();
    }

    require_once( 'config.php' );
    require_once('./class/c_user.php');

    session_name("fortune");
    session_start();

    require_once('./function/fungsi_menu.php');
    require_once('./function/getUserPrivilege.php');
    require_once('./function/pagedresults.php');
    require_once('./function/secureParam.php');
    

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title><?php echo "Sistem " . $siteTitle; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/fmsicon.ico">
    <link rel="stylesheet" href="css/jquery-ui-1.11.4.css">
    <link type="text/css" rel="stylesheet" href="styles/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">   
   <script type="application/x-javascript" language="javascript" src="js/enter.js"></script>	
<?php 
$bglogin = "";
   if(isset($_SESSION["my"])==false || $_GET["page"]=='login_detail')
    {
        $bglogin = " style='background-color:#b80000;' ";
    }
?>
<body <?= $bglogin; ?>>    

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.11.4.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="script/bootstrap-hover-dropdown.js"></script>
<script type="text/javascript">
var currenttime = '<?php print date("F d, Y H:i:s", time())?>' //PHP method of getting the server date

var montharray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember")
var serverdate=new Date(currenttime)

function padlength(what)
{
	var output=(what.toString().length==1)? "0"+what : what
	return output
}


</script>

    
<?php /* Periksa session $my, jika belum teregistrasi load modul login */ 

if(isset($_SESSION["my"])==false || $_GET["page"]=='login_detail')
{
        require_once('login_detail.php' );
}
else
{

    ?>

    <!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <a id="logo" href="index.php" class="navbar-brand"> <img src="image/logo.png" class="logo" width="43" height="43" /> <span class="fa fa-rocket"></span><!-- <span class="logo-text"><?php  //echo $siteTitle; ?>"</span> --><span style="display: none" class="logo-text-icon">�</span></a></div>
            <div class="topbar-main">
                <?php
                echo menu();
                ?>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    
                    <li class="dropdown"><a style="font-size:14px;font-weight:bold;padding-top:2px; text-align: center;" data-hover="dropdown" href="index.php?page=login_detail&eventCode=20" class="dropdown-toggle"><?php   echo $_SESSION["my"]->gudangAktif."<br />".$_SESSION['my']->name. ' ( Log Out )'; ?></a>
                        
                    </li>
                    
                </ul>
            </div>
        </nav>

    </div>
    <!--END TOPBAR-->    
    <?php
    /************ Start Main Content ***********/
    if(empty($_SESSION["my"]->id))
    {
        require_once('view/setPrivilege_detail.php');
    }
    else
    {	
        if(isset($_GET["page"]))
            require_once('view/'.$_GET["page"].".php");
        else
            echo "<div style='background:url(image/background.jpg) no-repeat center center; width: 100%; height: 100%;' align='center'>&nbsp</div>";
            //echo "<div style='width: 100%; height: 100%;'><img src='image/background.jpg' style='display:block;margin:auto;'></div>";
    }
    /*************** End  Main Content**************/
} ?>
<div id="footer">
    <p>Copyright &copy; Tuusolutio, Developed by Tuusolutio</p>
</div>
</body>
</html>
