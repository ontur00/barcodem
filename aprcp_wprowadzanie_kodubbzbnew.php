<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}

// ##################### Wywietlenie i zatwierdzenie operacji wybranej przez czytnik ######################
// ##################################### script by Przemyslaw Cios Wersja Beta 01-07-2010 ############################################


function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);								// Zwraca TRUE jeli $d (czyli data) jest wypełniona
  return $flaga;
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>przetwarzanie danych czytnik</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">

<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";
session_start();
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);


$kod 	= $_POST['kod'];

 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else{

session_start();
$_SESSION['s_kod1']=$kod;
$login=$_SESSION['luzytkownik'];
$dluglogin = strlen($login);


$dlug = strlen($kod);
$data_rok = substr($kod, 0,4);
$data_mies = substr($kod, 4,2);
$data_dzien = substr($kod, 6,2);
$data_exp="$data_rok-$data_mies-$data_dzien";
$dlug_kor=$dlug-18;

$shinchang_part_no = substr($kod, 8,$dlug_kor);



$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);

$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';
$lok_z_b="";
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda52 = "SELECT * FROM prod_st WHERE barcode='$kod'";
 $wynik52 = mysql_query($kwerenda52);
 $rekordow52 = mysql_numrows($wynik52);
 mysql_close();
 $lok_z_b	 			= mysql_result($wynik52, 0, "lok");	
 
 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_got_prod WHERE barcode='$kod'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $barcod	 			= mysql_result($wynik5, 0, "barcode");							


 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda6 = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
 $wynik6 = mysql_query($kwerenda6);
 $rekordow6 = mysql_numrows($wynik6);
 mysql_close();
 $part_no_b	 			= mysql_result($wynik6, 0, "part_no");							


$dlug_part_no = strlen($part_no_b);

if($lok_z_b==="WZ"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabbzbnew.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko zostalo wyslane do klienta<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($lok_z_b==="MW"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabbzbnew.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko zostalo przygotowane do wysylki<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($lok_z_b==="MG"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabbzbnew.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko jest na magazynie Glownym<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

elseif ($dlug_part_no<3 or $dlug <25) {  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabbzbnew.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							else { if ($barcod<>$kod) { echo include "../barcodem/aprcp_z_czytnikabb2zbnew.php"; }  else  { 	echo  include "../barcodem/aprcp_z_czytnikabbzbnew.php";
						        	                     																$komunikat = "<center><B>
						        	                     																<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
								     																									<FONT COLOR='#FF0000'><font size='1'>ETYKIETA ZOSTAŁA JUŻ WCZYTANA 
																																		 - TOWAR ZOSTAŁ JUŻ WCZESNIEJ PRZYJETY ! powtórz operacje,
																																		  brak skutku magazynowego ";	echo $komunikat; 
													 														}
						               
                                        }

}
?>
</BODY>
</HTML>
