<!DOCTYPE html>
<html>
	<head>
		<style>
			body {
				background-color: lightgreen;
				margin: 0px;
				padding: 0px;
			}
			.maintable {
				margin: 20px;
			}
			.mytable {
				margin-left: auto;
				margin-right: auto;
			}
			table, th, td {
				border: 1px solid;
				background-color: yellow;
			}
			table {
				width: 50%;
			}
			.SubmitButton {
				margin: auto;
				height: 30px;
				width: 300px;
				text-align: center;
				padding: 20px;
			}
			.Button {
				height: 30px;
				width: 300px;
			}
			.display {
				margin: auto;
				text-align: center;
			}
			.heading {
				text-align: center;
				margin: auto;
				color: red;
			}
		</style>
	</head>
	<body>
		<?php
			$emp_name = "";
			$company = "";
			$job_desc = "";
			$heading = "";
			if (isset($_POST["ButtonSubmit"])) {
				$emp_name = $_POST["Name"];
				$company = $_POST["Company"];
				$job_desc = $_POST["JobDescription"];
				$heading = "YOUR ENTRY";
				$entry = new stdClass();
				$entry->EmployeeName = $emp_name;
				$entry->Company = $company;
				$entry->JobDescription = $job_desc;
				if (filesize("entry.json") == 0) {
					$temp = array();
					$temp[] = $entry;
					$input = new stdClass();
					$input->EmployeeDetails = $temp;
					$fp = fopen("entry.json", "w");
					fwrite($fp, json_encode($input));
					fclose($fp);
				}
				else {
					$contents = file_get_contents("entry.json");
					$contents = json_decode($contents, true);
					$employees = array();
					$employees = $contents["EmployeeDetails"];
					$employees[] = $entry;
					$input = new stdClass();
					$input->EmployeeDetails = $employees;
					$fp = fopen("entry.json", "w");
					fwrite($fp, json_encode($input));
					fclose($fp);
				}
				//$fp = fopen("entry.json", "a");
				//fwrite($fp, json_encode($entry));
				//fclose($fp);
			}
		?>
		<script>
			function display() {
				var x = document.getElementById("display");
				x.style.visibility = "visible";
			}
		</script>
		<div class = "maintable">
		<form action = "", method = "POST", enctype = "multipart/form-data">
			<table class = "mytable">
				<tr>
					<th>Name</th>
					<th>Company</th>
					<th>Job Description</th>
				</tr>
				<tr>
					<th><input type = "text", name = "Name", placeholder = "Enter Name"></input></th>
					<th><input type = "text", name = "Company", placeholder = "Enter Company"></input></th>
					<th><input type = "text", name = "JobDescription", placeholder = "Enter Job Description"></input></th> 
				</tr>
			</table>
			<div class = "SubmitButton">
				<input class = "Button", type = "Submit", value = "Submit", name = "ButtonSubmit", onclick = "display()", display = "none">
			</div>
		</form>
		</div>
		<div class = "display", id = "display">
			<h2 class = "heading">
				YOUR ENTRY
			</h2>
			<table class = "mytable">
				<tr>
					<th>Name</th>
					<th>Company</th>
					<th>Job Description</th>
				</tr>
				<tr>
					<th><?php echo $emp_name;  ?></th>
					<th><?php echo $company;  ?></th>
					<th><?php echo $job_desc;  ?></th>
				</tr>
			</table>
		</div>
	</body>
</html>
