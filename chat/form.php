<?php

if(empty($_SESSION['admin']))
	require '../config/config.php';

	if(isset($_POST['adddetails'])) {
		$errMsg = '';
		// Get username from FORM
		$queries = $_POST['queries'];
        $answer = $_POST['answer'];

		if($queries == '')
			$errMsg = 'Enter Query/Answer to add';

		if($errMsg == '') {
			try{
				$stmt = $connect->prepare('INSERT INTO chatbot (queries, replies) VALUES (:queries, :answer)');
				$stmt->execute(array(
					':queries' => $queries,
                    ':answer' => $answer,
					));

				$errMsg = 'User ' . $queries .  'and'  . $answer . ' successfully added.';

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html>
<head><title>Admin - query and answer</title></head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div align="center">
		<div style=" border: solid 1px #006D9C; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Admin insert query and answer</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
				Enter Query <br>
					<input type="text" name="queries" autocomplete="off" class="box"/><br /><br />
                    Enter Answer of Query<br>
                    <input type="text" name="answer" autocomplete="off" class="box"/><br /><br />
					<input type="submit" name='adddetails' value="Submit" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
