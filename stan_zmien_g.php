<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
<link rel="stylesheet" href="style.css" type="text/css">



</HEAD>
<BODY>


<?php
$znacznik="qc";

session_start();
$id=$_SESSION['sqid'];

$kod 	    = $_POST['kod'];
$baza 		= 'barcode';
$uzytkownik = 'robak';
$haslo 		= 'robak1';
$o="Q";
// echo" id jest = $id";


mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
$kwerenda = "SELECT * FROM rej_prod_got WHERE id='$id'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

               
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$shinchang_part_no 		= mysql_result($wynik, $a, "shinchang_part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data1 	 				= mysql_result($wynik, $a, "data_z_kodu");
$barcode 	 			= mysql_result($wynik, $a, "barcode");
$ilosc_pierwotna		= mysql_result($wynik, $a, "iloac_pierwotna");
$qty_box 	 			= mysql_result($wynik, $a, "qty_box");
$no_box         		= mysql_result($wynik, $a, "no_box");
$nr_zlec     			= mysql_result($wynik, $a, "nr_zlec");
$klient     			= mysql_result($wynik, $a, "klient");



mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
$kwerenda = "SELECT * FROM qc_powod WHERE kod='$kod'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();
$kodb = mysql_result($wynik, $a, "kod");  
$powod = mysql_result($wynik, $a, "powod"); 

settype($qty_box, "integer");
settype($ilosc_pierwotna, "integer");

$roznica=$ilosc_pierwotna-$qty_box;    

if ($kodb>$kod or $kodb<$kod) { 
$blad=" <font size=5><center> Wprowadz W�asciwy Kod / Enter the appropriate code<br><hr><FONT COLOR='#FF0000'>To nie jest kod bledu / This is not an error code<hr> </font></font></center>"; 
	echo include "qc_dodaj.php";                    }

				 else {
				 
				?> 
				 
<script language="JavaScript">
<!--
function klawisze(evnt) {
 if (document.all) Key = event.keyCode; else Key = evnt.which;
  <?php
  echo "
   switch (Key) {
     case 55: document.location.href='qc_dodajk.php?kod=$kod&id=$id&qty_box=$qty_box&no_box=$no_box'; 
	 break;
     case 57: document.location.href='qc_zapis_baza.php?linia=$linia&pojazd=$pojazd&part_no=$part_no&shinchang_part_no=$shinchang_part_no&part_name=$part_name&data1=$data1&barcode=$barcode&ilosc_pierwotna=$ilosc_pierwotna&qty_box=$qty_box&no_box=$no_box&nr_zlec=$nr_zlec&klient=$klient&kod=$kod';
     break;
     default: alert('Naci�nij ENTER, a nast�pnie / Press ENTER, and then:\\n9 - je�li operacja zako�czona lub / or if the operation completed \\n7 - aby wczyta� ponownie kod kreskowy / to read the bar code again');
   }"
  ?>
}
document.onkeypress=klawisze;
if (document.layers) document.captureEvents(Event.KeyDown);
//-->
</script>
				 
<?php	
echo"
<div style='margin: 0px;'>
	<TABLE ALIGN='center' WIDTH='100%' CELLSPACING='0' CELLPADDING='0' BORDER='0' >
	<TR>
	<TD BGCOLOR='#ff9999'>
	<A HREF='qc_zapis_baza.php?linia=$linia&pojazd=$pojazd&part_no=$part_no&shinchang_part_no=$shinchang_part_no&part_name=$part_name&data1=$data1&barcode=$barcode&ilosc_pierwotna=$ilosc_pierwotna&qty_box=$qty_box&no_box=$no_box&nr_zlec=$nr_zlec&klient=$klient&kod=$kod'>
	ROZPOCZECIE REJESTRACJI / REGISTRATION BEGINS<BR><FONT COLOR='#4444FF'>
	<B>NACISNIJ / PRESS  9 </B></A></FONT>
	</TD>
	
	<TD  BGCOLOR='#ccffcc'><A HREF='qc_dodajk.php?kod=$kod&id=$id&qty_box=$qty_box&no_box=$no_box'>PONOWNE WCZYTYWANIE KODU KRESKOWEGO / RELOADING BARCODE<BR><FONT COLOR='4444FF'><B>NACISNIJ / PRESS 7</B> </A></FONT></TD>
		
	</TR>
	</TABLE>
</div>
";


			 
				 echo "<br><br><center> Wczytano kod:<br><br> $powod <br> Kod Bledu: $kodb <br><br><br>
				 <IMG SRC='code39.php?kod=$kodb'WIDTH='200' HEIGHT='70'></center><br><br><br>
				 ";
                  } 
				  
?>
</BODY>
</HTML>
