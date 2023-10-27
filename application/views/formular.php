<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>

		<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding:0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}

		table {
			border-collapse: collapse;
		}

		td, th {
			padding: 10px;
			border-bottom: solid 1px #ddd;
		}

		</style>
		
	</head>
	<body>

		<div id="container">
			<h1>Formular!</h1>

			<div id="body">
				<form id="form" name ="form" action="Formular/adauga" method="post">
					<input type="hidden" id="id" name="id"><br>
					<label for="denumire">Denumire:</label><br>
					<input type="text" id="denumire" name="denumire"><br>
					<br>
					<label for="descriere">Descriere:</label><br>
					<textarea id="descriere" name="descriere"></textarea><br>
					<br>
					<label for="data">Data:</label><br>
					<input type="text" id="data" name="data"><br>
					<br>
					<label for="poza">Poza:</label><br>
					<input type="file" id="poza" name="poza"><br>
					<br>
					<label for="parinte">Parinte:</label><br>
					<select id="parinte" name="parinte">
					<option value ='Fara_Parinte'>Fara Parinte</option>
						<?php
							foreach($tichete as $tichet){
								echo "<option value=" . $tichet["ID"] . ">" . $tichet["Denumire"] . "</option>";
							}
						?>
					</select><br>
					<br>
					<br>
					<button type="submit">Submit</button>
				</form>
			</div>
			<br>
			<br>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Denumire</th>
						<th>Descriere</th>
						<th>Data</th>
						<th>Parinte</th>
						<th>Editeaza</th>
						<th>Sterge</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($tichete as $tichet){
							echo "<tr>" ;
								echo "<td>";
								echo $tichet["ID"] ;
								echo "</td>";
								echo "<td>";
								echo $tichet["Denumire"] ;
								echo "</td>";
								echo "<td>";
								echo $tichet["Descriere"] ;
								echo "</td>";
								echo "<td>";
								echo $tichet["Data"] ;
								echo "</td>";
								echo "<td>";
								echo $tichet["Parinte"] ;
								echo "</td>";
								echo "<td>";
								echo "<button type = 'button' value = '" . $tichet["ID"] . "' onclick = 'incarcaTichet(" . $tichet["ID"] . ")'>Editeaza</button>" ;
								echo "</td>";
								echo "<td>";
								echo "<button type = 'button' value = '" . $tichet["ID"] . "' onclick='window.location.href=`/formular/sterge/" . $tichet["ID"] . "`'>Sterge</button>" ;
								echo "</td>";
							echo "</tr>" ;
							
						}
					?>
				</tbody>
			</table>
		</div>
		
	</body>
</html>
<script>

	function incarcaTichet(id){
		let xhr = new XMLHttpRequest(); 
		let url = '/formular/edit/'+id;
	
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				var result = JSON.parse(this.responseText)
				//console.log(result);
				document.getElementById("id").value = result['ID'];
				document.getElementById("denumire").value = result['Denumire'];
				document.getElementById("descriere").value = result['Descriere'];
				document.getElementById("data").value = result['Data'];
				document.getElementById("parinte").value = result['Parinte'] === null ? 'Fara_Parinte' : result['ID_Parinte'];
			}
		}
	
		xhr.open("GET", url, true);
		xhr.send();
	}

	/*let form = document.getElementById("form");
	form.addEventListener('submit', (e) => {
		e.preventDefault();

		let id = document.getElementById("id").value;
		let denumire = document.getElementById("denumire").value;
		let descriere = document.getElementById("descriere").value;
		let data = document.getElementById("data").value;
		let parinte = document.getElementById("parinte").value;

		let deAdaugat = {'denumire':denumire, 'descriere':descriere, 'data':data, 'parinte':parinte};
		let deModificat = {'id':id, 'denumire':denumire, 'descriere':descriere, 'data':data, 'parinte':parinte};

		console.log(JSON. stringify(deModificat));

		let xhr = new XMLHttpRequest();
		let url = id === '' ? '/formular/adauga' + deAdaugat : '/formular/modifica/' + JSON. stringify(deModificat);
	
		xhr.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				var result = this.responseText;
				console.log(result);
			}
		}
	
		xhr.open("GET", url, true);
		xhr.send();
	});*/
	
</script>
