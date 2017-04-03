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
elseif ($kod==="00"){ echo "<font size='0'>"; echo include "../airm/zaw_wczytaj.php"; 
					$komunikat = "<center><B><FONT COLOR='#00aa00'><font size='1'> LOKALIZACJE NA MAGAZYNIE PODAJ   </b> KOD BOX</center></b><hr>";
																	echo $komunikat;}
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

$datazz=date("Y-m-d");
$datazy=date("Y");
$datazm=date("n");
$datazd=date("d");

$qty_box_st        = $dlug-9;
$qty_box_end       = $dlug-4;
$qty_box_rob       = substr($kod, $qty_box_st,$qty_box_end);
$qty_box		   = substr($qty_box_rob ,0,5);
$qty_box_il		   = substr(str_replace("O", "", $qty_box_rob) ,5,5);
settype($qty_box, "integer");

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
 $kwerenda52h = "SELECT * FROM prod_got_wys WHERE barcode='$kod'";
 $wynik52h = mysql_query($kwerenda52h);
 $rekordow52h = mysql_numrows($wynik52h);
 mysql_close();
 $klienth	 			= mysql_result($wynik52h, 0, "klient");	
 $dlug_klient = strlen($klienth);
 
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
 $qty_box_bb 			= mysql_result($wynik6, 0, "qty_box");							
echo"$dlug";

$dlug_part_no = strlen($part_no_b);
if($data_exp>$datazz){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_rok<2005){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_rok>$datazy){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_mies>12){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; } 
elseif($data_dzien>31){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Nieprawidłowy lot_no<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; }/* 
elseif($qty_box>$qty_box_bb){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Za duza iloć na etykiecie<BR> Przedrukuj etykiete. 
							              ";
							echo "<font size='0'>$komunikat"; }*/
elseif($lok_z_b==="MP"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko jest przyjete z produkcji<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

elseif(($lok_z_b==="WZ") and (($dlug_klient>2)or($dlug_klient<1))){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko zostalo wyslane do klienta<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif(($lok_z_b==="MW") and (($dlug_klient>2)or($dlug_klient<1))){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko zostalo przygotowane do wysylki<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($lok_z_b==="MG"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko jest na magazynie Glownym<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
elseif($lok_z_b==="ZB"){  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>Pudelko jest na Strefa Zablokowana<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }

elseif (($dlug_part_no<3) or ($dlug <28) or ($dlug>28)) {  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB DANE NIEZGODNE Z BAZA DANYCH<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							else { if (($barcod<>$kod) or (($dlug_klient>1)and($dlug_klient<3))) { echo include "../barcodem/aprcp_z_czytnikabb2.php"; }  else  { 	echo  include "../barcodem/aprcp_z_czytnikabb.php";
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
