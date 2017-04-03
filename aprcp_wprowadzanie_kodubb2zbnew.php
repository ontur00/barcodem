<?php
session_start();
if (isset($_SESSION['srcp_id_przewodnika'])){unset($_SESSION['srcp_id_przewodnika']);}
if (isset($_SESSION['srcp_zdarzenie']))		{unset($_SESSION['srcp_zdarzenie']);}



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

$kod1=$_SESSION['s_kod1'];



$kod 	= $_POST['kod2'];
$kodal 	= $_POST['kodalc'];

 if($dluglogin<2){ echo "<font size='0'>"; echo include "wyloguj.php"; 
$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'>Zaloguj ponownie<BR>. 
             ";
echo "<font size='0'>$komunikat"; 
		 }

else{
						
$kodalc = str_replace(" ", "", $kodal);

$dlkodalc 	= strlen($kodalc);
if ($dlkoda1<1) {$komunikat1 = "<center><B><font size='1'><FONT COLOR='#FF0000'>";}
else{$komunikat1 = "<EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
<center><B><font size='1'><FONT COLOR='#FF0000'>WCZYTALES NIEPRAWIDŁOWY ALC KOD KRESKOWY <BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
				  "; }

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

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
$kwerenda = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynik = mysql_query($kwerenda);
$rekordow = mysql_numrows($wynik);
mysql_close();

$id  					= mysql_result($wynik, $a, "id");                 
$linia					= mysql_result($wynik, $a, "linia");
$pojazd					= mysql_result($wynik, $a, "pojazd");
$part_no 				= mysql_result($wynik, $a, "part_no");
$part_name 				= mysql_result($wynik, $a, "part_name");
$data 	 				= mysql_result($wynik, $a, "data");
$klient	 				= mysql_result($wynik, $a, "klient");
$nr_etyk	 			= mysql_result($wynik, $a, "nr_etyk");
$pole_odkl	 			= mysql_result($wynik, $a, "pole_odkl");
$stan_pop	 			= mysql_result($wynik, $a, "stan_prod");

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 $kwerenda5 = "SELECT * FROM prod_got_mag WHERE barcode='$kod'";
 $wynik5 = mysql_query($kwerenda5);
 $rekordow5 = mysql_numrows($wynik5);
 mysql_close();
 $barcod	 			= mysql_result($wynik5, 0, "barcode");							


$dlug_part_no = strlen($part_no);



if ($dlug_part_no<3 or $kod1!== $kod) {  echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb2zbnew.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							WCZYTALES NIEPRAWIDŁOWY KOD KRESKOWY LUB ETYKIETY ROZNE<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
							else {
									if ($barcod<>$kod) 
						               {

                                        $dlug_nr_etyk = strlen($nr_etyk);

                                         if($dlug_nr_etyk>2){if ($nr_etyk<>$kodalc)

                                                              { echo include "../barcodem/aprcp_z_czytnikabb_alczbnew.php"; echo "<font size='0'>$komunikat1"; 
                                                             }
                                         
                                                             
        else  {   											mysql_connect('localhost',$uzytkownik,$haslo);
 															mysql_query('SET CHARSET latin2');
 															@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 															$kwerenda5hj1 = "SELECT * FROM prod_st WHERE barcode='$kod'";
 															$wynik5hj1 = mysql_query($kwerenda5hj1);
 															$rekordow5hj1 = mysql_numrows($wynik5hj1);
 															mysql_close();
 															$barcodst1	 			= mysql_result($wynik5hj1, 0, "barcode");	
        													$dlug_barcodst1 = strlen($barcodst1);
        
                                                    if($dlug_barcodst1<1){
        
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="auto_prz_prod";
                                                                $stan=$stan_b+$stan_pop;
                                                                echo"$stan";
                                                                
                                                               $kwerenda_max = "UPDATE prod_got SET stan_prod='$stan' WHERE shinchang_part_no='$shinchang_part_no'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_max);
                                                                mysql_close();
                                                               $kwerenda_zap_max = "INSERT INTO prod_got_prod(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode,wyk)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod','N')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_max);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MP";
                                                                 	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,shinchang_part_no)
                                                                 					VALUES ('$data_exp','$part_no','$part_name','$stan_b','$stan','$klient','$lok','$login','$powod','$kod','$kod','$shinchang_part_no')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                 
                                                                 echo include "../barcodem/aprcp_z_czytnikabb.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>ALC KOD OK $part_no  $part_name Z PUDEŁKA DODANE $stan_b SZT DO MAGAZYNU <BR>  
							               							OK $part_no  $part_name BOX ADD $stan_b QUANTITY TO STORAGE</center><hr>";
																	echo $komunikat;
																	}else{echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							$dlug_barcodst Rekord istnieje juz w bazie etykieta zarejestrowana<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
																	
						                                          }}
						                                          
 if($dlug_nr_etyk<3)
                                                  {   											mysql_connect('localhost',$uzytkownik,$haslo);
 															mysql_query('SET CHARSET latin2');
 															@mysql_select_db($baza) or die("Nie można znaleć bazy danych!");
 															$kwerenda5hj = "SELECT * FROM prod_st WHERE barcode='$kod'";
 															$wynik5hj = mysql_query($kwerenda5hj);
 															$rekordow5hj = mysql_numrows($wynik5hj);
 															mysql_close();
 															$barcodst	 			= mysql_result($wynik5hj, 0, "barcode");	
        													$dlug_barcodst = strlen($barcodst);
        
                                                    if($dlug_barcodst<1){
        
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="auto_prz_prod";
                                                                $stan=$stan_b+$stan_pop;
                                                                echo"$stan";
                                                                
                                                               $kwerenda_max = "UPDATE prod_got SET stan_prod='$stan' WHERE shinchang_part_no='$shinchang_part_no'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_max);
                                                                mysql_close();
                                                               $kwerenda_zap_max = "INSERT INTO prod_got_prod(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode,wyk)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$nr_etyk','$pole_odkl','$login','$powod','$kod','N')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_max);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MP";
                                                                 	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,shinchang_part_no)
                                                                 					VALUES ('$data_exp','$part_no','$part_name','$stan_b','$stan','$klient','$lok','$login','$powod','$kod','$kod','$shinchang_part_no')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                	@mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                 
                                                                 echo include "../barcodem/aprcp_z_czytnikabb.php";
                                                                 $komunikat = "<center><B><FONT COLOR='#00aa00'>ALC KOD OK $part_no  $part_name Z PUDEŁKA DODANE $stan_b SZT DO MAGAZYNU <BR>  
							               							OK $part_no  $part_name BOX ADD $stan_b QUANTITY TO STORAGE</center><hr>";
																	echo $komunikat;
																	}else{echo "<font size='0'>"; echo include "../barcodem/aprcp_z_czytnikabb.php"; 
							$komunikat = "<center><B><font size='1'><FONT COLOR='#FF0000'><EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
							$dlug_barcodst Rekord istnieje juz w bazie etykieta zarejestrowana<BR> ZAREJESTRUJ OPERACJE JESZCZE RAZ. 
							              ";
							echo "<font size='0'>$komunikat"; }
																	
						                                          }}	else

                                                    {	echo  include "../barcodem/aprcp_z_czytnikabb2.php";
						        	                     $komunikat = "<center><B>
						        	                     <EMBED src='tada.wav' autostart=true loop=false volume=250 hidden=true><NOEMBED><BGSOUND src='tada.wav'></NOEMBED>
								     <FONT COLOR='#FF0000'><font size='1'>ETYKIETA ZOSTAŁA JUŻ WCZYTANA - TOWAR ZOSTAŁ JUŻ WCZESNIEJ PRZYJETY ! powtórz operacje, brak skutku magazynowego
							          
																				  ";
						              	echo $komunikat; 
													 }
						               
                                        }

}
?>
</BODY>
</HTML>
