<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>barcodee</TITLE>
<META http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">


<script>
//script by Przemyslaw Cios 21:11:2010

function fullwin(targeturl){
window.open(targeturl,"","fullscreen,scrollbars")
}
//-->
</script>


</HEAD>

<BODY>
<?php


  if (isset($_SESSION['luzytkownik'])) {
	if (strpos($_SESSION['lprawa'],'b')!== false) {
	echo "<div align='left'><A HREF='wyloguj.php'><font size='2'>Wyloguj użytkownika / logout user&nbsp;:&nbsp;<b> ".$_SESSION['luzytkownik']."</A></b></div></font><BR>";

	?>
	<TABLE ALIGN='left' WIDTH='200' HEIGHT='120' BORDER='0' CELLSPACING='0' CELLPADDING='0' >
	        <TR>
	        <TD BGCOLOR='#ccFFaa' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('aprcp_z_czytnikabb.php')" value="Przyjecie z produkcji" >
            </form>
			</TD>
			</tr>
			<TR>
	        <TD BGCOLOR='#ccFFaa' ALIGN='center' ><form>
            <input type="button" onClick="fullwin('wyczyt_prz.php')" value="Przyjecie z SETREFA ZABLOKOWANA" >
            </form>
			</TD>
			</tr>
			<TR>
			<?php
			//echo"
	        //<TD BGCOLOR='#ccFFaa' ALIGN='center' ><form>
            //<input type='button' onClick='fullwin('aprcp_z_czytnikabbinw.php')' value='Przyjecie z inwentaryzacja' >
            //</form>
		//	</TD>";
			?>
			</tr>
					
		    
	</TABLE>

	<?php
	}
	else {
	
	echo "
	<br><BR><BR><BR><BR><BR><BR><BR>
		<TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ffbbbb'>
		<TR>
  
        	<TD ALIGN='left'>Nie masz uprawnień do obsługi systemu Barcode.<br>
	     	Aby powtórnie się zalogować naciśnij <A HREF='wyloguj.php'>TUTAJ</A><br>
  	        <hr>
			You do not have permission to operate the system Barcode.<br>
			To re-log in press <A HREF='wyloguj.php'>HERE</A></TD>
			<TD WIDTH='70'></TD>
        </TR> ";
	}
  }
  else {
  echo "<FORM ACTION='logowanie.php' METHOD='POST'>
  
  
  <br><BR><BR><BR><BR><BR><BR><BR>
  <TABLE BORDER='0' ALIGN='left' CELLPADDING='0' BGCOLOR='#ccccff'>
  <TR>
  	<TD COLSPAN='3' ALIGN='center' HEIGHT='70' VALIGN='center'><B>Proszę się zalogować do systemu BarcodeM:
	 <BR> Please log in to the system  BarcodeM:</B></TD>
  </TR>
  <TR>
  	<TD ALIGN='right' WIDTH='100'>Login:&nbsp;</TD>
  	<TD ALIGN='left'><INPUT TYPE='text' NAME='luzytkownik' SIZE='20'></TD>
  	<TD WIDTH='70'></TD>
  </TR>
  <TR>
  	<TD ALIGN='right'>Hasło/password:&nbsp;</TD>
  	<TD ALIGN='left'><INPUT TYPE='password' NAME='lhaslo' SIZE='20'></TD>
  	<TD></TD>
 </TR>
 	<TR>
 	<TD COLSPAN='2' ALIGN='right' HEIGHT='40' VALIGN='bottom'><INPUT TYPE='submit' NAME='submit' VALUE='Zaloguj&nbsp;/&nbsp;log in'></TD>
 	<TD></TD>
 </TR>
 </TABLE></FORM>";
 }
?>

</BODY>
</HTML>
