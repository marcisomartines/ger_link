<html>
<head>
	<title>Uploading...</title>
</head>
<body>
	<script src="css/js/bootstrap.min.js"></script>
<?php
	echo $_FILES['arquivo']['name'];
	if($_FILES['arquivo']['error']>0)
	{
		echo 'Problema: ';
		switch($_FILES['arquivo']['error'])
		{
			case 1:
				echo 'Arquivo excede o tamanho maximo de upload.';
				break;
			case 2:
				echo 'Arquivo excede tamanho maximo.';
				break;
			case 3:
				echo 'Arquivo parcialmente carregado.';
				break;
			case 4:
				echo 'Arquivo não encontrado.';
				break;
		}
		exit;
	}

	//o arquivo possui o tipo MIME correto?
	if($_FILES['arquivo']['type'] != 'text/plain')
	{
		echo 'Problema: Arquivo não é um arquivo de texto.<br />';
		exit;
	}

	//insere arquivo onde gostariamos
	$upfile='upload/'.$_FILES['arquivo']['name'];
	#$upfile='/'.$_FILES['arquivo']['name'];
	if(is_uploaded_file($_FILES['arquivo']['tmp_name']))
	{
		if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$upfile))
		{
			echo 'Problema: Não pode mover arquivo para o diretorio pretendido';
			exit;
		}
	}else{
		echo 'Problema: Arquivo';
		echo $_FILES['arquivo']['name'];
		exit;
	}

	echo 'Links gerados com sucesso.';

	//reformata o conteudo do arquivo.
	$fp=fopen($upfile,'r');
	$contents=fread($fp,filesize($upfile));
	$content2=file($upfile);
	fclose($fp);

	$contents=strip_tags($contents);
	$fp=fopen($upfile,'w');
	fwrite($fp,$contents);
	fclose($fp);
	$teste=gettype($content2);
	//mostra o arquivo que foi carregado
	//echo 'Previa do arquivo que foi uploaded.<br>';
	//echo $teste;
	//echo '<pre>';
	$linha=1;
	echo '<table class="table table-hover" size="50">';
	foreach ($content2 as $key => $value) {
		echo '<tr>';
		echo "<td>".$linha." <a href=".$value.">".$value."</a></td>";
		echo '</tr>';
		$linha++;
	}
	//echo '</pre>';
	echo '</table>';
?>
</body>
</html>