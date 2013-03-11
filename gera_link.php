<html>
	<head>
		<title>GeraLink - Upload</title>
	</head>
	</head>
	<body>
		<script src="css/js/bootstrap.min.js"></script>
		<h1>Gerador de links apartir de um arquivo texto</h1>
		<form enctype="multipart/form-data" action="upload.php" method="post">
			<?php
			#listando arquivos de um diretorio
			$diretorio="upload";
			$dir=opendir($diretorio);
			$i=0;
			$nome=readdir($dir);
			while($nome!=false)
			{
				if(!is_dir($nome)and ($nome!='Thumbs.db'))
				{
					$arquivo[$i]=$nome;
					$i++;
				}
				$nome=readdir($dir);
			}
			sort($arquivo);
			foreach($arquivo as $arq){
				echo '<a href='.$diretorio.'/'.$arq.'>'.$arq.'</a><br>';
			}
			?>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="btn btn-primary"/>
			Selecione o arquivo: <input name="arquivo" type="file" size="50"/>
			<button type="submit" class="btn btn-primary">Converter Links</button>
		</form>
	</body>
</html>