<?php
 include "log.php";
 $luzytkownik	= $_POST['luzytkownik'];
 $lhaslo		="";

 $baza			= 'shinchang';
 $uzytkownik	= 'root';
 $haslo			= 'przemocp123';

 mysql_connect('localhost',$uzytkownik,$haslo);
 mysql_query('SET CHARSET latin2');
 @mysql_select_db($baza) or die("Nie odnaleziono bazy danych!");
 $kwerenda = "SELECT * FROM uzytkownic WHERE login='$luzytkownik' AND haslo='$lhaslo'";
 $wynik = mysql_query($kwerenda);
 $rekordow = mysql_numrows($wynik);
 mysql_close();

 if ($rekordow == 1) {
		session_start();
		$_SESSION['lnumer_kontrolny']	= mysql_result($wynik, 0, "numer_kontrolny");
		$_SESSION['luzytkownik']		= mysql_result($wynik, 0, "login");
		$_SESSION['lhaslo']				= mysql_result($wynik, 0, "haslo");
		$_SESSION['lprawa']				= mysql_result($wynik, 0, "prawa");
		ZapisLog("L", "B", $_SESSION['lnumer_kontrolny']);
		header("Location: index.php");
 }
 else {
 		echo "<HTML><HEAD>
 		<META http-equiv='Content-Type' content='text/html; charset=ISO-8859-2'>
	
		</HEAD><BODY>
		
		
		<TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ccccff'>
		<TR>
  
        	<TD ALIGN='left'><font size='2'>Nie ma takiego u�ytkownika lub wprowadzone has�o jest nieprawid�owe.<br>
	     	<A HREF='indexz.php'><B>PONOWNE LOGOWANE  TUTAJ</B></A><br>
  	        <hr>
			There is no such username or password entered is incorrect.<br>
			<A HREF='indexz.php'><B>RELOGIN HERE</B></A></TD>
			<TD WIDTH='70'><font></TD>
        </TR>
		
		</BODY></HTML>";
 } 
?>
