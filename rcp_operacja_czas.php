<?php
session_start();																// Skrypt wywo�ywany jest po wybraniu ROZPOCZNIJ lub ZAKO�CZ

function data_ok($d)
  {
  $flaga = !($d == '0000-00-00' || $d == NULL);									// Zwraca TRUE je�li $d (czyli data) jest wype�niona
  return $flaga;
  }

$id_przew		= $_SESSION['srcp_id_przewodnika'];
$id_operacji	= $_GET['id_operacji'];											// Numer id_operacji wybranej operacji
$wybor			= $_GET['wybor'];												// Wybrano 52 - rozpocz�cie lub 54 - zako�czenie
settype($id_operacji, integer);													// id_operacji chcemy bez zer wiod�cych

$data		= date("Y-m-d");													// Obecna data
$czas		= date("H:i:s");													// Obecny czas

$baza		= 'hartownia';
$uzytkownik	= 'mysql';
$haslo		= 'mysql9';

mysql_connect('localhost',$uzytkownik,$haslo);
mysql_query('SET CHARSET latin2');
@mysql_select_db($baza) or die("Nie mo�na znale�� bazy danych!");

switch ($wybor)
{
 case 52:																		// Rozpocz�cie
	$kwerenda	= "UPDATE t04_operacje SET data_rozpoczecia = '$data', godz_rozpoczecia = '$czas' ".
				  "WHERE ((data_rozpoczecia IS NULL) OR (data_rozpoczecia = '0000-00-00')) AND (id_operacji=$id_operacji)";
	mysql_query($kwerenda);
	break;
 case 54:																		// Zako�czenie
 	$kwerenda	= "UPDATE t04_operacje SET data_zakonczenia = '$data', godz_zakonczenia = '$czas' ".
				  "WHERE ((data_zakonczenia IS NULL) OR (data_zakonczenia = '0000-00-00')) AND (id_operacji=$id_operacji)";
	mysql_query($kwerenda);
	break;
 default:
 	$kwerenda = "";
}

// Ostatnia operacja b�dzie mia�a - w razie potrzeby - automatycznie uzupe�niane czasy

if (isset($_SESSION['srcp_zdarzenie']))
{   
   switch ($_SESSION['srcp_zdarzenie'])
   {
     case 'ostatnia':											// Czy to jest ostatnia operacja
       if ($wybor == 54)
	   {														// i czy wczytano ZAKO�CZENIE czyli $wybor = 54
  	      $kwerenda	= "SELECT data_rozpoczecia, godz_rozpoczecia, data_zakonczenia, godz_zakonczenia FROM t04_operacje WHERE id_operacji=$id_operacji";
  	      $wynik = mysql_query($kwerenda);
  	      $rekordow = mysql_numrows($wynik);
  	      if ($rekordow == 1)
		  {
  	         $data_rozpoczecia	= mysql_result($wynik, 0, "data_rozpoczecia");
	  	     $godz_rozpoczecia	= mysql_result($wynik, 0, "godz_rozpoczecia");
	  	     $data_zakonczenia	= mysql_result($wynik, 0, "data_zakonczenia");
	  	     $godz_zakonczenia	= mysql_result($wynik, 0, "godz_zakonczenia");
  	         $flaga_rozp 		= data_ok($data_rozpoczecia);					// TRUE je�li data jest prawid�owa (niezerowa i nie NULL)
	         $flaga_zak  		= data_ok($data_zakonczenia);					// j.w.
	         if (data_ok($data_zakonczenia) && !data_ok($data_rozpoczecia))
			 {																	// Uzupe�niamy dat� pocz�tkow� je�li ko�cowa istnieje, a pocz�tkowej brak
	    	    $kwerenda	= "UPDATE t04_operacje SET data_rozpoczecia = '$data_zakonczenia', godz_rozpoczecia = '$godz_zakonczenia' WHERE id_operacji=$id_operacji";
			    mysql_query($kwerenda);
	         }
	         // Powiadamiamy o zarejestrowaniu ostatniej operacji
		     $kwerenda = "INSERT INTO t03_zdarzenia (czas_zdarzenia, kod_zdarzenia, id_przewodnika, opis_zdarzenia) VALUES (now(), '2', $id_przew, '')";
		     mysql_query($kwerenda);
		     // W zam�wieniu odnotowujemy dat� zwolnienia przewodnika
		     mysql_query("UPDATE t08b_zamowienia SET data_zwolnienia = '$data_zakonczenia' WHERE id = (SELECT id_zamowienia FROM t01_przewodniki WHERE id_przewodnika = '$id_przew')");
  	      } 																	// dla ($rekordow == 1)
  	   }																		// dla ($wybor == 54)
  	   break;
     case 'pierwsza':
	   if ($wybor == 52)
	   {
		  $kwerenda = "INSERT INTO t03_zdarzenia (czas_zdarzenia, kod_zdarzenia, id_przewodnika, opis_zdarzenia) VALUES (now(), '1', $id_przew, '')";
		  mysql_query($kwerenda);
	   }
	   break;
   }																			// dla SWITCH-a
}																				// dla IF (isset($_SESSION['srcp_zdarzenie']))
mysql_close();


if ($_SESSION['srcp_zdarzenie'] == 'ostatnia')
{
	header("Location: rcp_lokalizacja.php?id_operacji=$id_operacji");
}
else
{
	header("Location: rcp_z_czytnika.php?kod=1");
}
?>
