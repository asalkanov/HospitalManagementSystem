<html>
<title>Rezultati pregleda</title>
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
	mysqli_select_db($conn, 'id8379569_bolnica');
	if(isset($_POST['add_pre'])){	//insert pregleda
		if($_POST['nar_id']!='' and $_POST['p_rez']!=''){
			$sql="INSERT INTO pregled(idNarudzbe,rezultatPregleda) VALUES('".$_POST['nar_id']."','".$_POST['p_rez']."');";
			if (mysqli_query($conn, $sql)){
				echo "Pregled uspješno dodan!<br />";
				} else die('Failed: '.mysqli_error($conn));
			$foo=mysqli_insert_id($conn);
			if(isset($_POST['lik'])){
				foreach($_POST['lik'] as $lik){
					$sql1="INSERT INTO lijekpregled VALUES('".$lik."','".$foo."')";
					if (!mysqli_query($conn, $sql1)){
						die('Failed: '.mysqli_error($conn));
						}
					}
				}
			}
		}
	elseif(isset($_POST['del_pre'])){	//delete pregleda  i lijekpregled povezanih entrya
		$sql="DELETE FROM lijekpregled WHERE idPregled=".$_POST['pre_pid'].";";
		if (mysqli_query($conn, $sql)){
			} else die('Failed: '.mysqli_error($conn));
		$sql="DELETE FROM pregled WHERE idPregled='".$_POST['pre_pid']."';";
		if (mysqli_query($conn, $sql)){
			echo "DELETE pregleda uspješan!<br />";
			} else die('Failed: '.mysqli_error($conn));
		}
	elseif(isset($_POST['upd_pre'])){	// UPDATE pregleda
		$sql="UPDATE pregled SET idNarudzbe='".$_POST['nar_id']."', rezultatPregleda='".$_POST['p_rez']."' WHERE idPregled='".$_POST['pre_pid']."';";
		if (mysqli_query($conn, $sql)){
			echo "Update pregleda uspješan!<br />";
			} else die('Failed: '.mysqli_error($conn));
		if(isset($_POST['lik'])){
				foreach($_POST['lik'] as $lik){
					$sql1="INSERT INTO lijekpregled VALUES('".$lik."','".$_POST['pre_pid']."')";
					if (!mysqli_query($conn, $sql1)){
						die('Failed: '.mysqli_error($conn));
						}
					}
				}
		}
	elseif(isset($_POST['nad_pre'])){	//TRAZENJE pregleda
		$sql="SELECT pacijent.ime,pacijent.prezime,pregled.*,tippregleda.nazivPregleda,narudzba.datum,lijek.* FROM pregled NATURAL JOIN (lijekpregled NATURAL JOIN lijek) "
		."NATURAL JOIN narudzba JOIN pacijent JOIN tippregleda WHERE narudzba.idPacijenta=pacijent.idPacijenta and tippregleda.idTipPregleda=narudzba.idTipPregleda ";
		if($_POST['nar_id']!=''){ $sql=$sql."and idNarudzbe='".$_POST['nar_id']."' "; }
		if($_POST['p_rez']!=''){ $sql=$sql."and rezultatPregleda='".$_POST['p_rez']."' "; }
		$sql=$sql." order by idPregled desc";
		if($sql!=='SELECT pacijent.ime,pacijent.prezime,pregled.*,tippregleda.nazivPregleda,narudzba.datum,lijek.* FROM pregled NATURAL JOIN (lijekpregled NATURAL JOIN lijek) '
		.'NATURAL JOIN narudzba JOIN pacijent JOIN tippregleda WHERE narudzba.idPacijenta=pacijent.idPacijenta and tippregleda.idTipPregleda=narudzba.idTipPregleda  order by idPregled desc'){ 
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
			<table width="350" border="0" cellspacing="1" cellpadding="2" rules="none" frame="rhs" style='table-layout:fixed;width=100%'>
				<tr>
				<?php if(!isset($_POST['pre_id']) or ($_POST['pre_id']=='')){ ?> 
					<td width="150">Dodaj/izmjeni pregled</td>
				<?php }else{ ?>
					<td width="150">Izmjene za pregled sa ID-om: <b> <?php echo $_POST['pre_id']; ?></b>
						<input name="pre_pid" value="<?php echo $_POST['pre_id']; ?>" hidden>
						<?php
						$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
						if(! $conn ){
							die('Could not connect: ' . mysqli_error($conn));
							}
						mysqli_select_db($conn, 'id8379569_bolnica');
						$sql='SELECT * FROM pregled where idPregled='.$_POST['pre_id'].';';
						$x=mysqli_query($conn, $sql);
						$row = mysqli_fetch_assoc($x);
						mysqli_close($conn);
						?>
					</td>
				<?php } ?>
				</tr>
				<tr>
					<th>ID narudžbe:</th>
					<td><input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" 
					<?php if (isset($_POST['pre_id']) and ($_POST['pre_id']!='')){ 
						echo 'value="'.$row['idNarudzbe'].'"';
						}
					?>
					name="nar_id" pattern="[0-9]*"> </td>
				</tr>	
				<tr>
					<th>Rezultat pregleda:</th>
					<td><textarea name="p_rez" type="text"><?php 
						if (isset($_POST['pre_id']) and ($_POST['pre_id']!='')){ 
							echo $row['rezultatPregleda'];
							}
					?></textarea></td>
				</tr>
				<tr>
				<th>Označite lijekove:</th><br />
					<td width="100%">
					<?php
					$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
					if(! $conn ){
						die('Could not connect: ' . mysqli_error($conn));
						}
					mysqli_select_db($conn, 'id8379569_bolnica');
					if (isset($_POST['pre_id']) and ($_POST['pre_id']!='')){ 
						$sql='SELECT * FROM `lijek` where idLijeka NOT IN (SELECT idLijeka FROM lijekpregled WHERE idPregled='.$_POST['pre_id'].')';
						}else $sql='SELECT * FROM `lijek`';
					$x=mysqli_query($conn, $sql);
					while ($row = mysqli_fetch_assoc($x)){
						echo '<input type="checkbox" name="lik[]" value="'.$row['idLijeka'].'">'.$row['imeLijeka'].'<br />';
						}
					mysqli_close($conn);
					?>
					</td>
				</tr>
				<tr>
				<?php if(!isset($_POST['pre_id']) or ($_POST['pre_id']=='')){ ?>
					<td />
					<td>
						<input name="add_pre" type="Submit" value="Unesi">
						<input name="nad_pre" type="submit" value="Pronađi">
					</td>
					<?php }else{ ?>
					<td>
						<input name="del_pre" type="Submit" value="Izbriši">
					</td>
					<td>
						<input name="upd_pre" type="submit" value="Izmjeni">
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
				if (!isset($_POST['pre_id']) or ($_POST['pre_id']=='')){
					?><tr><td>Unesi ID pregleda za izmjene</td></tr>
					<tr>
						<th>ID:</th>
						<td> <input type="text"  pattern="[0-9]*" oninvalid="setCustomValidity('ID mora biti broj!')" onchange="try{setCustomValidity('')}catch(e){}" name="pre_id"></td>
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