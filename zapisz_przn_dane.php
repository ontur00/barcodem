
<?php
$tekst_1="Ostatnie zdarzenie / Last Event:";


$baza 		= 'barcod';
$uzytkownik = 'robak';
$haslo 		= 'robak1';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");
$kwerendarrr = "SELECT * FROM prod_got WHERE shinchang_part_no='$shinchang_part_no'";
$wynikrrr = mysql_query($kwerendarrr);
$rekordowrrr = mysql_numrows($wynikrrr);
mysql_close();

$id  					= mysql_result($wynikrrr, $ar, "id");                 
$linia					= mysql_result($wynikrrr, $ar, "linia");
$pojazd					= mysql_result($wynikrrr, $ar, "pojazd");
$part_no 				= mysql_result($wynikrrr, $ar, "part_no");
$part_name 				= mysql_result($wynikrrr, $ar, "part_name");
$data 	 				= mysql_result($wynikrrr, $ar, "data");
$klient	 				= mysql_result($wynikrrr, $ar, "klient");
$nr_etyk	 			= mysql_result($wynikrrr, $ar, "nr_etyk");

$stan_pop	 			= mysql_result($wynikrrr, $ar, "stan_blok");
$stan_wgot		 		= mysql_result($wynikrrr, $ar, "stan");
 
                                   

									
		                                                      session_start();
                                                               $login=$_SESSION['luzytkownik'];
                                                                $stan_b=(int)$qty_box;
                                                                $powod="M_prz_ZB";
                                                                $stan=$stan_pop-$stan_b;
                                                                 $stan_wgotb=$stan_wgot+$stan_b;
                                                            
                                                               $kwerenda_maxpoi = "UPDATE prod_got SET stan='$stan_wgotb',stan_blok='$stan' WHERE id='$id'";	
                                                                mysql_connect('localhost',$uzytkownik,$haslo);
                                                                mysql_query("SET NAMES 'latin2'");
                                                                mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                mysql_query($kwerenda_maxpoi);
                                                                mysql_close();
                                                               
												
                                                                
                                                               $kwerenda_zap_maxm = "INSERT INTO prod_got_mag(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_etyk,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_wgot','$stan_wgotb','$klient','$nr_etyk','S-51-ZB','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                $kwerenda_zap_maxm = "INSERT INTO prod_got_zb(pojazd,shinchang_part_no,part_no,part_name,stan_pop,stan,klient,nr_lok,pole_odkl,login,powod,barcode)
                                                                 VALUES ('$pojazd','$shinchang_part_no','$part_no','$part_name','$stan_pop','$stan','$klient','$lok','S-51-ZB','$login','$powod','$kod')";
                                                                  mysql_connect('localhost',$uzytkownik,$haslo);
                                                                 mysql_query("SET NAMES 'latin2'");
                                                                 mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                 mysql_query($kwerenda_zap_maxm);
                                                                 mysql_close();
                                                                 
                                                                 	$lok="MG";
                                                                 	$kwerenda_zap_max_st = "INSERT INTO prod_st(lot_no,part_no,part_name,qty_box,stan,klient,lok,login,powod,barcode,barcode_we_prod,barcode_we_gl,lok_sc,lok_pal,shinchang_part_no)
                                                                 VALUES ('$data_exp','$part_no','$part_name','$stan_b','$stan','$klient','$lok','$login','$powod','$kod','$kod','$kod','','','$shinchang_part_no')";
                                                                	mysql_connect('localhost',$uzytkownik,$haslo);
                                                                	mysql_query("SET NAMES 'latin2'");
                                                                	mysql_query("SET CHARACTER SET 'latin2_general_ci'");
                                                                   @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
                                                                	mysql_query($kwerenda_zap_max_st);
                                                                	mysql_close();
                                                                 
                                                                  	 
 																	
														
                                                                 
 echo include "../barcodem/wyczyt_prz.php"; 

?>
