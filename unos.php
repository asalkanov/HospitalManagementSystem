<html>
<title>Unos/Izmjene podataka</title>
<body>
<?php require("menu.php"); ?>
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
	mysqli_select_db($conn, 'id8379569_bolnica');
	// caseovi za buttone
	if (isset($_POST['add_doc'])){  //INSERT doktora i njegovih specijalizacija
		if(($_POST['doc_ime']!='') and ($_POST['doc_pre']!='') and ($_POST['doc_grad']!='') and ($_POST['doc_placa']!='')){
		$sql="INSERT INTO doktor(imeDoktora,prezimeDoktora,grad,placa) VALUES('".$_POST['doc_ime']."','".$_POST['doc_pre']."','".$_POST['doc_grad']."','".$_POST['doc_placa']."')";
		if (mysqli_query($conn, $sql)){
			echo "Doktor uspješno dodan!<br />";
			} else die('Failed: '.mysqli_error($conn));
		$foo=mysqli_insert_id($conn);
		if(isset($_POST['spec'])){
			foreach($_POST['spec'] as $spec){
				$sql1="INSERT INTO doktorspecijalizacija VALUES('".$foo."','".$spec."')";
				if (!mysqli_query($conn, $sql1)){
					die('Failed: '.mysqli_error($conn));
					}
				}
			}
		}
		}
	elseif (isset($_POST['add_pac'])){ //INSERT pacijenta
		if(($_POST['pac_ime']!='') and ($_POST['pac_pre']!='') and ($_POST['pac_grad']!='')){
		$sql="INSERT INTO pacijent(ime,prezime,grad) VALUES('".$_POST['pac_ime']."','".$_POST['pac_pre']."','".$_POST['pac_grad']."')";
		if (mysqli_query($conn, $sql)){
			echo "Pacijent uspješno dodan!";
			} else die('Failed: '.mysqli_error($conn));
		}
		}
	elseif (isset($_POST['add_lik'])){ //INSERT lijek
		if(($_POST['lik_ime']!='')){
		$sql="INSERT INTO lijek(imeLijeka) VALUES('".$_POST['lik_ime']."')";
		if (mysqli_query($conn, $sql)){
			echo "Lijek uspješno dodan!";
			} else die('Failed: '.mysqli_error($conn));
		}
		}
	elseif (isset($_POST['add_spec'])){ //INSERT specijalizacija
		if(($_POST['spec_ime']!='')){
		$sql="INSERT INTO specijalizacija(nazivSpecijalizacije) VALUES('".$_POST['spec_ime']."')";
		if (mysqli_query($conn, $sql)){
			echo "Specijalizacija uspješno dodana!";
			} else die('Failed: '.mysqli_error($conn));
		}
		}
	elseif (isset($_POST['add_tpre'])){ //INSERT tip pregelda
		if(($_POST['tpre_naz']!='') and ($_POST['tpre_spec']!='') and ($_POST['tpre_t']!='')){
		if($_POST['tpre_spec']==0){
			echo "Odaberite specijalizaciju!";
		}else{
			$sql="INSERT INTO tippregleda(nazivPregleda,idSpecijalizacija,trajanje) VALUES('".$_POST['tpre_naz']."','".$_POST['tpre_spec']."','".$_POST['tpre_t']."')";
			if (mysqli_query($conn, $sql)){
				echo "Tip pregleda uspješno dodan!";
				} else die('Failed: '.mysqli_error($conn));
			}
		}
		}
	elseif (isset($_POST['doc_upd'])){ 	// UPDATE doktora nakon sto se odabere ID
		$sql='UPDATE doktor SET imeDoktora=\''.$_POST['doc_ime'].'\',prezimeDoktora=\''.$_POST['doc_pre'].'\', grad=\''.$_POST['doc_grad'].'\', placa=\''.$_POST['doc_placa'].'\' WHERE idDoktora='.$_POST['doc_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "Update doktora uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		if (isset($_POST['spec'])){
			foreach($_POST['spec'] as $spec){
				$sql1="INSERT INTO doktorspecijalizacija VALUES('".$_POST['doc_pid']."','".$spec."')";
				if (mysqli_query($conn, $sql1)){
				} else die('Failed: '.mysqli_error($conn));
				}
			}
		}
	elseif (isset($_POST['doc_del'])){  // DELETE doktora nakon odabranog ID-a i njegove specijalizacije - samo ako nema postojecih narudzbi!
		$sql="DELETE FROM doktorspecijalizacija WHERE idDoktora=".$_POST['doc_pid'].";";
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));
		$sql="DELETE FROM doktor WHERE idDoktora=".$_POST['doc_pid'].";";
		if (mysqli_query($conn, $sql)){
			echo "DELETE doktora uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['del_pac'])){  // DELETE pacijenta nakon odabranog ID-a
		/*$sql="DELETE FROM narudzba WHERE idPacijenta=".$_POST['pac_pid'].";";
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));*/
		$sql="DELETE FROM pacijent WHERE idPacijenta=".$_POST['pac_pid'].";";
		if (mysqli_query($conn, $sql)){
			echo "DELETE pacijenta uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['upd_pac'])){  // UPDATE pacijenta nakon odabranog ID-a
		$sql='UPDATE pacijent SET ime=\''.$_POST['pac_ime'].'\',prezime=\''.$_POST['pac_pre'].'\',grad=\''.$_POST['pac_grad'].'\' WHERE idPacijenta='.$_POST['pac_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "Update pacijenta uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}	
	elseif (isset($_POST['lik_upd'])){  // UPDATE lijeka
		$sql='UPDATE lijek SET imeLijeka=\''.$_POST['lik_ime'].'\' WHERE idLijeka='.$_POST['lik_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "Update lijeka uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['lik_del'])){  // DELETE lijeka i povezanog lijekpregled-a
		$sql='DELETE FROM lijekpregled WHERE idLijeka='.$_POST['lik_pid'].';';
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));
		$sql='DELETE FROM lijek WHERE idLijeka='.$_POST['lik_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "DELETE lijeka uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['spec_upd'])){  // UPDATE specijalizacije
		$sql='UPDATE specijalizacija SET nazivSpecijalizacije=\''.$_POST['spec_ime'].'\' WHERE idSpecijalizacije='.$_POST['spec_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "Update specijalizacije uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['spec_del'])){  // DELETE specijalizacije
		/*$sql="DELETE FROM narudzba WHERE idTipPregleda IN (SELECT idTipPregleda FROM tippregleda WHERE idSpecijalizacija='".$_POST['spec_pid']."'";
		f (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));
		$sql='DELETE FROM tippregleda  WHERE idSpecijalizacija='.$_POST['spec_pid'].';';
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));*/
		$sql='DELETE FROM doktorspecijalizacija  WHERE idSpecijalizacije='.$_POST['spec_pid'].';';
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));
		$sql='DELETE FROM specijalizacija  WHERE idSpecijalizacije='.$_POST['spec_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "DELETE specijalizacije uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['tpre_upd'])){  // UPDATE tipa pregleda
		if($_POST['tpre_spec']==0){
			echo "Odaberite specijalizaciju!";
		}else{
			$sql='UPDATE tippregleda SET idSpecijalizacija='.$_POST['tpre_spec'].', nazivPregleda=\''.$_POST['tpre_naz'].'\', trajanje=\''.$_POST['tpre_t'].'\' WHERE idTipPregleda='.$_POST['tpre_pid'].';';
			if (mysqli_query($conn, $sql)){
				echo "Update tipa pregleda uspješan!";
				} else die('Failed: '.mysqli_error($conn));
			}	
		}
	elseif (isset($_POST['tpre_del'])){  // DELETE tipa pregleda
		$sql='DELETE FROM tippregleda WHERE idTipPregleda='.$_POST['tpre_pid'].';';
		if (mysqli_query($conn, $sql)){
			echo "DELETE tipa pregleda uspješan!";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif (isset($_POST['nad_pac'])){  //NADJI ID za pacijenta
		$sql='select * from pacijent where ';
		if(isset($_POST['pac_ime']) and $_POST['pac_ime']!=''){ $sql=$sql.'ime=\''.$_POST['pac_ime'].'\' '; }
		if(isset($_POST['pac_pre']) and $_POST['pac_pre']!=''){ 
			if($_POST['pac_ime']!=''){
				$sql=$sql.'and prezime=\''.$_POST['pac_pre'].'\' ';
				}else{
				$sql=$sql.'prezime=\''.$_POST['pac_pre'].'\' '; 
				}
			}
		if(isset($_POST['pac_grad']) and $_POST['pac_grad']!=''){ 
			if(($_POST['pac_ime']!='') or ($_POST['pac_pre']!='')){
				$sql=$sql.'and grad=\''.$_POST['pac_grad'].'\' ';
				}else{
				$sql=$sql.'grad=\''.$_POST['pac_grad'].'\' ';
				}
			}
		if($sql!=='select * from pacijent where '){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	elseif (isset($_POST['nad_doc'])){  //NADJI ID za doktora
		$sql='select * from doktor where ';
		if(isset($_POST['doc_ime']) and $_POST['doc_ime']!=''){ $sql=$sql.'imeDoktora=\''.$_POST['doc_ime'].'\' '; }
		if(isset($_POST['doc_pre']) and $_POST['doc_pre']!=''){ 
			if($_POST['doc_ime']!=''){
				$sql=$sql.'and prezimeDoktora=\''.$_POST['doc_pre'].'\' '; 
				}else{
				$sql=$sql.'prezimeDoktora=\''.$_POST['doc_pre'].'\' '; 
				}
			}
		if(isset($_POST['doc_grad']) and $_POST['doc_grad']!=''){ 
			if(($_POST['doc_ime']!='') or ($_POST['doc_pre']!='')){
				$sql=$sql.'and grad=\''.$_POST['doc_grad'].'\' ';
				}else{
				$sql=$sql.'grad=\''.$_POST['doc_grad'].'\' '; }
			}
		if(isset($_POST['doc_placa']) and $_POST['doc_placa']!=0){ 
			if (($_POST['doc_ime']!='') or ($_POST['doc_pre']!='') or ($_POST['doc_grad']!='')){ 
				$sql=$sql.'and placa='.$_POST['doc_placa'].' '; 
				}else{
				$sql=$sql.'placa='.$_POST['doc_placa'].' '; 
				}
			}
		if($sql!=='select * from doktor where '){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	elseif (isset($_POST['nad_lik'])){  //NADJI ID za lijek
		$sql='select * from lijek where ';
		if(isset($_POST['lik_ime']) and $_POST['lik_ime']!=''){ $sql=$sql.'imeLijeka=\''.$_POST['lik_ime'].'\' '; }
		if($sql!=='select * from lijek where '){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	elseif (isset($_POST['nad_spec'])){   //NADJI ID za specijalizaciju
		$sql='select * from specijalizacija where ';
		if(isset($_POST['spec_ime']) and $_POST['spec_ime']!=''){ $sql=$sql.'nazivSpecijalizacije=\''.$_POST['spec_ime'].'\' '; }
		if($sql!=='select * from specijalizacija where '){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	elseif (isset($_POST['nad_tpre'])){  //NADJI ID za tip pregleda
		$sql='select * from tippregleda where ';
		if(isset($_POST['tpre_naz']) and $_POST['tpre_naz']!=''){ $sql=$sql.'nazivPregleda=\''.$_POST['tpre_naz'].'\' '; }
		if(isset($_POST['tpre_t']) and $_POST['tpre_t']!=''){ 
			if($_POST['tpre_naz']!=''){
				$sql=$sql.'and trajanje='.$_POST['tpre_t'].' '; 
				}else{
				$sql=$sql.'trajanje='.$_POST['tpre_t'].' ';
				}
			}
		if(isset($_POST['tpre_spec']) and $_POST['tpre_spec']!=0){
			if(($_POST['tpre_naz']!='') or ($_POST['tpre_t']!='')){
				$sql=$sql.'and idSpecijalizacija='.$_POST['tpre_spec'].' ';
				}else{
				$sql=$sql.'idSpecijalizacija='.$_POST['tpre_spec'].' ';
				}
			}
		if($sql!=='select * from tippregleda where '){
			if ($x1=mysqli_query($conn, $sql)){
				} else die('Failed: '.mysqli_error($conn));
			$nadjiid=true;
			}
		}
	mysqli_close($conn);
?>
<div>
<table>
	<tr>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="330" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%' >
			<?php if (!isset($_POST['doc_id']) or ($_POST['doc_id']=='')){ ?>
			<tr>
					<td width="140">Dodaj/traži doktora</td>
			</tr>
			<?php }else{ ?>
			<tr>
				<td>Izmjene za doktora sa ID-om:<b> <input name="doc_pid" value="<?php echo $_POST['doc_id']; ?>" hidden>
				<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM doktor where idDoktora='.$_POST['doc_id'].';';
				$x=mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($x);
				mysqli_close($conn);
				?></b></td>
			</tr>
			<?php } ?>
			<tr>
				<th>Ime:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['doc_id'])and ($_POST['doc_id']!='')){ 
					echo 'value="'.$row['imeDoktora'].'"';
					}
				?>
				name="doc_ime"></td>
			</tr>
			<tr>
				<th>Prezime:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['doc_id']) and ($_POST['doc_id']!='')){ 
					echo 'value="'.$row['prezimeDoktora'].'"';
					}
				?>name="doc_pre"></td>
			</tr>
			<tr>
				<th>Grad:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['doc_id'])and ($_POST['doc_id']!='')){ 
					echo 'value="'.$row['grad'].'"';
					}
				?>name="doc_grad"></td>
			</tr>
				<tr>
				<th>Plaća:</th>
				<td> <input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('Plaća mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
				<?php if (isset($_POST['doc_id'])and ($_POST['doc_id']!='')){ 
					echo 'value="'.$row['placa'].'"';
					}
				?>name="doc_placa"></td>
			</tr>
			<tr>
				<th>Označite područja specijalizacije:</th><br />
				<td width="100%">
				<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				if (isset($_POST['doc_id']) and ($_POST['doc_id']!='')){ 
					$sql='SELECT * FROM `specijalizacija` where idSpecijalizacije NOT IN (SELECT idSpecijalizacije FROM doktorspecijalizacija WHERE idDoktora='.$_POST['doc_id'].')';
				}else $sql='SELECT * FROM `specijalizacija`';
				$x=mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($x)){
					echo '<input type="checkbox" name="spec[]" value="'.$row['idSpecijalizacije'].'">'.$row['nazivSpecijalizacije'].'<br />';
					}
				mysqli_close($conn);
				?>
					</td>
				</tr>
			<?php if (!isset($_POST['doc_id']) or ($_POST['doc_id']=='')){ ?>
			<tr>
				<td width="100"></td>
				
				<td>
					<input name="add_doc" type="Submit" value="Unesi">
					<input name="nad_doc" type="submit" value="Pronađi">
				</td>
			</tr> <?php }else{ ?>
			<tr>
					<td><input type="submit" value="Izbriši" name="doc_del"></td>
					<td><input type="submit" value="Izmjeni" name="doc_upd"></td>
			</tr> <?php } ?>
		</table>
		</form>
		</td>
		<td width="5"></td>
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="320" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs"><br />
			<?php if (!isset($_POST['pac_id']) or ($_POST['pac_id']=='')){ ?>
			<tr>
				<td width="150">Dodaj/traži pacijenta</td>
			</tr>
			<?php }else { ?>
			<tr>
				<td width="150">Izmjene za pacijenta sa ID-om:<b> <input name="pac_pid" value="<?php echo $_POST['pac_id'] ?>" hidden>
				<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM pacijent where idPacijenta='.$_POST['pac_id'].';';
				$x=mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($x);
				mysqli_close($conn);
				?></b></td>
			</tr>
			<?php } ?>
			<tr>
				<th>Ime:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['pac_id']) and ($_POST['pac_id']!='')){ 
					echo 'value="'.$row['ime'].'"';
					}
				?>
				name="pac_ime"></td>
			</tr>
			<tr>
				<th>Prezime:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['pac_id']) and ($_POST['pac_id']!='')){ 
					echo 'value="'.$row['prezime'].'"';
					}
				?>
				name="pac_pre"></td>
			</tr>
			<tr>
				<th>Grad:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['pac_id']) and ($_POST['pac_id']!='')){ 
					echo 'value="'.$row['grad'].'"';
					}
				?>
				name="pac_grad"></td>
			</tr>
			<tr>
			<?php if(!isset($_POST['pac_id']) or ($_POST['pac_id']=='')){ ?>
				<td></td>
				<td>
					<input name="add_pac" type="Submit" value="Unesi">
					<input name="nad_pac" type="submit" value="Pronađi">
				</td>
			<?php }else{ ?>
				<td><input name="del_pac" type="submit" value="Izbriši"></td>
				<td><input name="upd_pac" type="submit" value="Izmjeni"></td>
			<?php } ?>
			</tr>
		</table>
		</form>
		</td>
		
		<td width="0"></td>
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="320" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs"><br />
			<?php if (!isset($_POST['lik_id']) or ($_POST['lik_id']=='')){ ?>
			<tr>
				<td width="150">Dodaj/traži lijeka</td>
			</tr>
			<?php }else{ ?>
			<tr>
				<td>Izmjena lijeka sa ID-om:<b> <input name="lik_pid" value="<?php echo $_POST['lik_id'] ?>" hidden></td>
			</tr>
			<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM lijek where idLijeka='.$_POST['lik_id'].';';
				$x=mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($x);
				mysqli_close($conn);
				?>
			<?php } ?>
			<tr>
				<th>Naziv:</th>
				<td> <input type="text"
				<?php if (isset($_POST['lik_id']) and ($_POST['lik_id']!='')){ 
					echo 'value="'.$row['imeLijeka'].'"';
					}
				?>			
				name="lik_ime"></td>
			</tr>
			<tr>
			<?php if(!isset($_POST['lik_id']) or ($_POST['lik_id']=='')){ ?>
				<td width="100"></td>
				<td>
					<input name="add_lik" type="Submit" value="Unesi">
					<input name="nad_lik" type="submit" value="Pronađi">
				</td>
			<?php }else{ ?>
				<td><input type="submit" name="lik_del" value="Izbriši"></td>
				<td><input type="submit" name="lik_upd" value="Izmjeni"></td>
			<?php } ?>
			</tr>
		</table>
		</form>
		</td>
		<td width="0"></td>
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="350" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs"><br />
			<?php if (!isset($_POST['spec_id']) or ($_POST['spec_id']=='')){ ?>
			<tr>
				<td width="180">Dodaj/traži specijalizacije</td>
			</tr>
			<?php }else{ ?>
			<tr>
				<td>Izmjena specijalizacije sa ID-om:<b> <input name="spec_pid" value="<?php echo $_POST['spec_id'] ?>" hidden></td>
			</tr>
			<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM specijalizacija where idSpecijalizacije='.$_POST['spec_id'].';';
				$x=mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($x);
				mysqli_close($conn);
				?>
			<?php } ?>
			<tr>
				<th>Naziv:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['spec_id']) and ($_POST['spec_id']!='')){ 
					echo 'value="'.$row['nazivSpecijalizacije'].'"';
					}
				?>		
				name="spec_ime"></td>
			</tr>
			<tr>
			<?php if(!isset($_POST['spec_id']) or ($_POST['spec_id']=='')){ ?>
				<td width="100"></td>
				<td>
					<input name="add_spec" type="Submit" value="Unesi">
					<input name="nad_spec" type="submit" value="Pronađi">
				</td>
			<?php }else{ ?>
				<td><input type="submit" name="spec_del" value="Izbriši"></td>
				<td><input type="submit" name="spec_upd" value="Izmjeni"></td>
			<?php } ?>
			</tr>
			
		</table>
		</form>
		</td>
		<td width="0"></td>
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="330" border="0" cellspacing="1" cellpadding="2" rules="none"><br />
			<?php if (!isset($_POST['tpre_id']) or ($_POST['tpre_id']=='')){ ?>
			<tr>
				<td width="160">Dodaj/traži tipa pregleda</td>
			</tr>
			<?php }else{ ?>
			<tr>
				<td>Izmjeni pregled sa ID-om:<b> <input name="tpre_pid" value="<?php echo $_POST['tpre_id'] ?>" hidden></td>
			</tr>
			<tr>
			<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM tippregleda where idTipPregleda='.$_POST['tpre_id'].';';
				$x=mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($x);
				$tp_s=$row['idSpecijalizacija'];
				mysqli_close($conn);
				?>
			<?php } ?>
				<th>Naziv:</th>
				<td> <input type="text" 
				<?php if (isset($_POST['tpre_id']) and ($_POST['tpre_id']!='')){ 
					echo 'value="'.$row['nazivPregleda'].'"';
					}
				?>	
				name="tpre_naz"></td>
			</tr>
			<tr>
				<th>Trajanje (min):</th>
				<td><input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('Trajanje mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
				<?php if (isset($_POST['tpre_id']) and ($_POST['tpre_id']!='')){ 
					echo 'value="'.$row['trajanje'].'"';
					}
				?>	
				name="tpre_t"></td>
			</tr>
			<tr>
				<th width="120">U specijalizaciji:</th>
				<td><select name="tpre_spec">
				<?php
				$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
				if(! $conn ){
					die('Could not connect: ' . mysqli_error($conn));
					}
				mysqli_select_db($conn, 'id8379569_bolnica');
				$sql='SELECT * FROM `specijalizacija`';
				echo "<option value=\"0\">-Odaberite-</option>";
				$x=mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($x)){    //tp_s usporedjuje s nicim ako nije u tpre_id dijelu, legit? moze se lako rijesit, ali nije potrebno?
					echo '<option '.(($row['idSpecijalizacije']==$tp_s)?('selected'):'').' value="'.$row['idSpecijalizacije'].'">'.$row['nazivSpecijalizacije'].'</option>';
					}
				mysqli_close($conn);
				?>
				</select></td>
			</tr>
			<tr>
			<?php if(!isset($_POST['tpre_id']) or ($_POST['tpre_id']=='')){ ?>
				<td width="100"></td>
				<td>
					<input name="add_tpre" type="Submit" value="Unesi">
					<input name="nad_tpre" type="submit" value="Pronađi">
				</td>
			<?php }else{ ?>
				<td><input type="submit" name="tpre_del" value="Izbriši"></td>
				<td><input type="submit" name="tpre_upd" value="Izmjeni"></td>
			<?php } ?>
			</tr>
		</table>
		</form>
		</td>
		<td width="0"></td>
		<td>
	</tr>
	<tr><td><br /><br /><br /><br /></td></tr>
	<!--
	---------------------
	-- KRAJ PRVOG REDA --
	--------------------- -->
	<tr>
		<td>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="330" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%' >
			<?php
			if (!isset($_POST['doc_id']) or ($_POST['doc_id']=='')){
				?><tr><td>Unesi ID doktora za izmjene</td></tr>
				<tr>
					<th>ID:</th>
					<td> <input type="text" name="doc_id" pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}"></td>
				</tr>
				<tr>
					<td /><td><input type="submit" value="Unesi"></td>
				</tr>
				<?php } ?>
		</table>
		</form>
		</td>
		<td width="5"></td>
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="320" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%' >
			<?php
			if (!isset($_POST['pac_id']) or ($_POST['pac_id']=='')){
				?><tr><td>Unesi ID pacijenta za izmjene</td></tr>
				<tr>
					<th>ID:</th>
					<td> <input type="text" name="pac_id" pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}"></td>
				</tr>
				<tr>
					<td /><td><input type="submit" value="Unesi"></td>
				</tr>
				<?php } ?>
		</table>
		</form>
		</td>
		<td width="0" />
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="320" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%' >
			<?php
			if (!isset($_POST['lik_id']) or ($_POST['lik_id']=='')){
				?><tr><td>Unesi ID lijeka za izmjene</td></tr>
				<tr>
					<th>ID:</th>
					<td> <input type="text" name="lik_id" pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}"></td>
				</tr>
				<tr>
					<td /><td><input type="submit" value="Unesi"></td>
				</tr>
				<?php } ?>
		</table>
		</form>
		</td>
		<td width="0" />
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="350" border="1" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%' >
			<?php
			if (!isset($_POST['spec_id']) or ($_POST['spec_id']=='')){
				?><tr><td>Unesi ID specijalizacije za izmjene</td></tr>
				<tr>
					<th>ID:</th>
					<td> <input type="text" name="spec_id" pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}"></td>
				</tr>
				<tr>
					<td /><td><input type="submit" value="Unesi"></td>
				</tr>
				<?php } ?>
		</table>
		</form>
		</td>
		<td width="0" />
		<td valign="top">
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<table width="330" border="0" cellspacing="1" cellpadding="2" rules="none" style='table-layout:fixed;width=100%' >
			<?php
			if (!isset($_POST['tpre_id']) or ($_POST['tpre_id']=='')){
				?><tr><td>Unesi ID tipa pregleda za izmjene</td></tr>
				<tr>
					<th>ID:</th>
					<td> <input type="text" pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" name="tpre_id"></td>
				</tr>
				<tr>
					<td /><td><input type="submit" value="Unesi"></td>
				</tr>
				<?php } ?>
		</table>
		</form>
		</td>
	</tr>
	<tr>
	
	</tr>
</table>
</div>
<br /><br />
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