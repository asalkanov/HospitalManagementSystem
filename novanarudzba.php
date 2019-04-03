<html>
<title>Narudžbe</title>
<body>
<?php require("menu.php"); ?>
<br />
</body>
</html>
<?php
	$dbhost = 'localhost';
	$dbuser = 'DB_USER';
	$dbpass = 'DB_PASSWORD';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
		{
		die('Could not connect: ' . mysqli_error($conn));
		}
	$nadjid=false;
	$t=false;
	mysqli_select_db($conn, 'id8379569_bolnica');
	// caseovi za buttone
	if(isset($_POST['add_nar'])){	//INSERT narudzbe sa provjerom dostupnosti termina
		if($_POST['doc_id']!='' and $_POST['pac_id']!='' and $_POST['tpre_id']!='' and $_POST['n_opis']!=''){
			$sql="select * from narudzba where idDoktora=".$_POST['doc_id']." and date(datum)='".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."' order by datum,vrijeme";
			if ($x2=mysqli_query($conn, $sql)){
				$sus=0;
				$m[]=array();  //izrada matrice
				$i=0;
				}else die('Failed: '.mysqli_error($conn));
			while($row = mysqli_fetch_assoc($x2)){   //punjenje matrice sa svim pocetnim i krajnjim vremenima postojecih narudzbi na taj dan za tog doktora
				$sql="select trajanje from tippregleda where idTipPregleda='".$row['idTipPregleda']."'";
				$rez=mysqli_fetch_assoc(mysqli_query($conn, $sql));
				$m[$i++]=$row['vrijeme'];
				$m[$i++] = date("H:i:s", strtotime($row['vrijeme'])+($rez['trajanje']*60));
				$sus+=$rez['trajanje'];    // brojanje ukupnog vremena rada za kasniju provjeru (8h = 480min)
				}
			$sql="select trajanje from tippregleda where idTipPregleda='".$_POST['tpre_id']."'";
			$tra=mysqli_fetch_array(mysqli_query($conn, $sql)); 	//trajanje nove narudzbe
			$i=0;
			$vr=$_POST['dat_h'].":".$_POST['dat_min'].":00";   //pocetno vrijeme nove narudzbe
			$vrk=date("H:i:s", strtotime($vr)+($tra[0]*60));   //krajnje vrijeme nova narudzbe
			$pr=true;
			while(!empty($m[$i]) and $pr){   //provjera vremena nove narudzbe sa vremenima postojecih narudzbi
				if(!($i & 1)){
					if((strtotime($m[$i])<=strtotime($vr)) and (strtotime($m[$i+1])>=strtotime($vrk))){ $pr=false; }
					}
				if((strtotime($vr)<strtotime($m[$i])) and (strtotime($vrk)>strtotime($m[$i]))){ $pr=false; }
				$i++;
				}
			if($sus+$tra[0]>480){ 
				echo "Dostignut broj mogucih radnih sati za datum: ".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d'].".<br />"; 
				$t=true;
				}elseif(!$pr){ 
					echo "Nedostupan termin. Trenutno rezervirani termini prikazani su u tablici na dnu stranice.<br />";
					//ako je termin nedostupan, querya tablicu sa trenutnim terminima i trajanjima
					$sql="select datum AS Datum,vrijeme AS Pocetak,trajanje AS `Trajanje (minuta)` from narudzba NATURAL JOIN tippregleda where "
						."idDoktora=".$_POST['doc_id']." and date(datum)='".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."' order by datum,vrijeme";
					$x1=mysqli_query($conn, $sql);
					$nadjiid=true;
					$t=true;
				}else{  //default insert ako je sve uredu
					if((isset($_POST['dat_min'])) and ($_POST['dat_min']<10) and ($_POST['dat_min'][0]!=0)){ $_POST['dat_min']="0".$_POST['dat_min']; }
					$sql="INSERT INTO narudzba(idDoktora,idPacijenta,idTipPregleda,opisNarudzbe,datum,vrijeme) VALUES('".$_POST['doc_id']."','".$_POST['pac_id']."','".$_POST['tpre_id']."','".$_POST['n_opis']."',"
						."'".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."','".$_POST['dat_h'].":".$_POST['dat_min'].":00')";
					if (mysqli_query($conn, $sql)){
						echo "Narudžba uspješno dodana!<br />";
						} else die('Failed: '.mysqli_error($conn));
				}
			}
		}
	elseif(isset($_POST['del_nar'])){	//DELETE narudzbe - SAMO ona koja nikad nije povezana sa pregledom
		$sql="DELETE FROM narudzba WHERE idNarudzbe='".$_POST['nar_pid']."';";
		if (mysqli_query($conn, $sql)){
			echo "DELETE narudžbe uspješan!<br />";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif(isset($_POST['upd_nar'])){	// UPDATE narudzbe, ukljucuje provjeru vremena termina (ignorira trentutni termin)
		if($_POST['doc_id']!='' and $_POST['pac_id']!='' and $_POST['tpre_id']!='' and $_POST['n_opis']!=''){
			$sql="select * from narudzba where idDoktora=".$_POST['doc_id']." and idNarudzbe<>".$_POST['nar_pid']." and date(datum)='".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."' order by datum,vrijeme";
			if ($x2=mysqli_query($conn, $sql)){
				$sus=0;
				$m[]=array();  //izrada matrice
				$i=0;
				}else die('Failed: '.mysqli_error($conn));
			while($row = mysqli_fetch_assoc($x2)){   //punjenje matrice sa svim pocetnim i krajnjim vremenima postojecih narudzbi na taj dan za tog doktora
				$sql="select trajanje from tippregleda where idTipPregleda='".$row['idTipPregleda']."'";
				$rez=mysqli_fetch_assoc(mysqli_query($conn, $sql));
				$m[$i++]=$row['vrijeme'];
				$m[$i++] = date("H:i:s", strtotime($row['vrijeme'])+($rez['trajanje']*60));
				$sus+=$rez['trajanje'];    // brojanje ukupnog vremena rada za kasniju provjeru (8h = 480min)
				}
			$sql="select trajanje from tippregleda where idTipPregleda='".$_POST['tpre_id']."'";
			$tra=mysqli_fetch_array(mysqli_query($conn, $sql)); 	//trajanje nove narudzbe
			$i=0;
			$vr=$_POST['dat_h'].":".$_POST['dat_min'].":00";   //pocetno vrijeme nove narudzbe
			$vrk=date("H:i:s", strtotime($vr)+($tra[0]*60));   //krajnje vrijeme nova narudzbe
			$pr=true;
			while(!empty($m[$i]) and $pr){   //provjera vremena nove narudzbe sa vremenima postojecih narudzbi
				if(!($i & 1)){
					if((strtotime($m[$i])<=strtotime($vr)) and (strtotime($m[$i+1])>=strtotime($vrk))){ $pr=false; }
					}
				if((strtotime($vr)<strtotime($m[$i])) and (strtotime($vrk)>strtotime($m[$i]))){ $pr=false; }
				$i++;
				}
			if($sus+$tra[0]>480){ 
				echo "Dostignut broj mogucih radnih sati za datum: ".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d'].".<br />"; 
				$_POST['nar_id']=$_POST['nar_pid'];
				}elseif(!$pr){ 
					echo "Nedostupan termin. Trenutno rezervirani termini prikazani su u tablici na dnu stranice.<br />";
					//ako je termin nedostupan, querya tablicu sa trenutnim terminima i trajanjima
					$sql="select datum AS Datum,vrijeme AS Pocetak,trajanje AS `Trajanje (minuta)` from narudzba NATURAL JOIN tippregleda where "
						."idDoktora=".$_POST['doc_id']." and idNarudzbe<>".$_POST['nar_pid']." and date(datum)='".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."' order by datum,vrijeme";
					$x1=mysqli_query($conn, $sql);
					$nadjiid=true;
					$_POST['nar_id']=$_POST['nar_pid'];
			}else{
				$sql="UPDATE narudzba SET idDoktora='".$_POST['doc_id']."', idPacijenta='".$_POST['pac_id']."', idTipPregleda='".$_POST['tpre_id']."', opisNarudzbe='".$_POST['n_opis']."',"
					." datum='".$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d']."', vrijeme='".$_POST['dat_h'].":".$_POST['dat_min']."' WHERE idNarudzbe='".$_POST['nar_pid']."';";
				if (mysqli_query($conn, $sql)){
					echo "Update narudžbe uspješan!<br />";
					} else die('Failed: '.mysqli_error($conn));
				}
			}
		}
	elseif(isset($_POST['nad_nar'])){	// TRAZENJE narudzbe 
		$sql="SELECT narudzba.idNarudzbe,narudzba.opisNarudzbe,narudzba.idDoktora,doktor.imeDoktora,doktor.prezimeDoktora,narudzba.idTipPregleda,tippregleda.nazivPregleda,narudzba.idPacijenta"
				.",pacijent.ime,pacijent.prezime,narudzba.datum,narudzba.vrijeme FROM narudzba JOIN pacijent  JOIN doktor  JOIN tippregleda WHERE narudzba.idDoktora=doktor.idDoktora "
					."and narudzba.idTipPregleda=tippregleda.idTipPregleda and narudzba.idPacijenta=pacijent.idPacijenta ";
		if($_POST['doc_id']!=''){ $sql=$sql."and narudzba.idDoktora='".$_POST['doc_id']."' "; }
		if($_POST['pac_id']!=''){ $sql=$sql."and narudzba.idPacijenta='".$_POST['pac_id']."' "; }
		if($_POST['tpre_id']!=''){ $sql=$sql."and narudzba.idTipPregleda='".$_POST['tpre_id']."' "; }
		if($_POST['n_opis']!=''){ $sql=$sql."and narudzba.opisNarudzbe='".$_POST['n_opis']."' ";  }
		if($sql!="SELECT narudzba.idNarudzbe,narudzba.opisNarudzbe,narudzba.idDoktora,doktor.imeDoktora,doktor.prezimeDoktora,narudzba.idTipPregleda,tippregleda.nazivPregleda,"
					."narudzba.idPacijenta,pacijent.ime,pacijent.prezime,narudzba.datum,narudzba.vrijeme FROM narudzba JOIN pacijent  JOIN doktor  JOIN tippregleda WHERE "
						."narudzba.idDoktora=doktor.idDoktora and narudzba.idTipPregleda=tippregleda.idTipPregleda and narudzba.idPacijenta=pacijent.idPacijenta "){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	mysqli_close($conn);
?>
<br />	
<div>
<table>
	<tr>
		<td>
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<table width="360" border="0" cellspacing="1" cellpadding="2" rules="none" frame="rhs">
				<tr>
				<?php if((!isset($_POST['nar_id']) or ($_POST['nar_id']=='')) and (!$t)){ 
					$ts=time(); ?> <!-- postavlja trenutni timestamp za prikazat -->
					<td>Dodaj/izmjeni narudžbu</td>
				<?php }else{ 
					if(!$t){ ?>
					<td width="150">Izmjene za narudžbu sa ID-om: <b> <?php echo $_POST['nar_id']; ?></b>
						<input name="nar_pid" value="<?php echo $_POST['nar_id']; ?>" hidden>
					<?php }else{ ?>
					<td>Ponavljanje narudžbe</td>
					<?php } ?>
						<?php
						$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
						if(! $conn ){
							die('Could not connect: ' . mysqli_error($conn));
							}
						mysqli_select_db($conn, 'id8379569_bolnica');
						if(!$t){   // radi ako je stavljen ID za search
							$sql='SELECT * FROM narudzba where idNarudzbe='.$_POST['nar_id'].';';
							$x=mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($x);
						}else{  	//izvodi ako je INSERT failao zbog datuma/vremena narudzbe -- da ispuni iste podatke opet
							$row['idPacijenta']=$_POST['pac_id'];
							$row['idDoktora']=$_POST['doc_id'];
							$row['idTipPregleda']=$_POST['tpre_id'];
							$row['opisNarudzbe']=$_POST['n_opis'];
							$row['datum']=$_POST['dat_y']."-".$_POST['dat_m']."-".$_POST['dat_d'];
							$row['vrijeme']=$_POST['dat_h'].":".$_POST['dat_min'].":00";
							}
						$ts=strtotime($row['datum'].$row['vrijeme']);    /* postavlja timestamp na zadani u tom ID-u narudzbe */
						mysqli_close($conn);
						?>
					</td>
				<?php } ?>
				</tr>
				<tr>
					<th>Pacijent ID:</th>
					<td><input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
					<?php if (isset($_POST['nar_id']) and ($_POST['nar_id']!='') or ($t)){ 
						echo 'value="'.$row['idPacijenta'].'"';
						}
					?>
					name="pac_id" pattern="[0-9]*"> </td>
				</tr>
				<tr>
					<th>Doktor ID:</th>
					<td><input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
					<?php if (isset($_POST['nar_id']) and ($_POST['nar_id']!='') or ($t)){ 
						echo 'value="'.$row['idDoktora'].'"';
						}
					?>
					name="doc_id" pattern="[0-9]*"></td>
				</tr>
				<tr>
					<th>Tip Pregleda ID:</th>
					<td><input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
					<?php if (isset($_POST['nar_id']) and ($_POST['nar_id']!='') or ($t)){ 
						echo 'value="'.$row['idTipPregleda'].'"';
						}
					?>
					name="tpre_id" pattern="[0-9]*"></td>
				</tr>	
				<tr>
					<th>Opis narudžbe:</th>
					<td><textarea name="n_opis" type="text"><?php 
						if (isset($_POST['nar_id']) and ($_POST['nar_id']!='') or ($t)){ 
							echo $row['opisNarudzbe'];
							}
					?></textarea></td>
				</tr>
				<tr>
					<th>Datum:</th>
					<td>
						D:<input type="number" name="dat_d" style="width:40px" min="1" max="31" <?php echo "value=\"".date('d',$ts)."\""; ?>>
						M:<input type="number" name="dat_m" style="width:40px" min="1" max="12"  <?php echo "value=\"".date('m',$ts)."\""; ?>>
						G:<input type="number" name="dat_y" style="width:50px" min="1970" max="2038" <?php echo "value=\"".date('Y',$ts)."\""; ?>>
					</td>
				</tr>
				<tr>
					<th>Vrijeme:</th>
					<td>
						Sati:<input type="number" name="dat_h" style="width:40px" min="8" max="16" <?php echo "value=\"".date('G',$ts)."\""; ?>>
						Minute:<input type="number" name="dat_min" style="width:40px" min="0" max="50" step="10" <?php echo "value=\"".date('i',$ts)."\""; ?>>
					</td> 
				</tr>
				<tr>
				<?php if(!isset($_POST['nar_id']) or ($_POST['nar_id']=='')){ ?>
					<td />
					<td>
						<input name="add_nar" type="Submit" value="Unesi">
						<input name="nad_nar" type="submit" value="Pronađi">
					</td>
					<?php }else{ ?>
					<td>
						<input name="del_nar" type="Submit" value="Izbriši">
					</td>
					<td>
						<input name="upd_nar" type="submit" value="Izmjeni">
					</td>
					<?php } ?>
				</tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td><br /><br /><br /><br /></td>
	</tr>
	<tr>
		<td>
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			<table width="330" border="0" cellspacing="1" cellpadding="2" rules="none" frame="rhs" >
				<?php
				if (!isset($_POST['nar_id']) or ($_POST['nar_id']=='')){
					?><tr><td>Unesi ID narudžbe za izmjene</td></tr>
					<tr>
						<th>ID:</th>
						<td> <input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" name="nar_id"></td>
					</tr>
					<tr>
						<td /><td><input type="submit" value="Unesi"></td>
					</tr>
					<?php } ?>
			</table>
			</form>
		</td>
	</tr>
</table>
</div>
<?php
if (isset($nadjiid)){    //izvrsi ako postoji trazenje ID-a
	echo "Prikaz ".mysqli_num_rows($x1)." rezultata:";
	$fw=mysqli_num_fields($x1);     //broj header fieldova
	?>
	<table width="<?php if ($fw<7) echo $fw*200; else echo $fw*100;?>" 
		border="1" cellspacing="0" cellpadding="2">
	<tr>
	<?php
	$s=NULL;
	while ($row = mysqli_fetch_field($x1)){
	?>	<td><?php echo $row->name; ?></td>
	<?php
	}
	?></tr><?php
	//ispis podataka
	while($row = mysqli_fetch_row($x1)){
		?><tr><?php
		for($i=0;$i<count($row);$i++){
			?><td><?php echo $row[$i]?></td><?php
			}
		?></tr><?php
		}
	?></table><?php
	}		
?>	