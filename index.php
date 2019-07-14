<?php

@session_start();

require_once ("Class/User.Class.php");

$users = null;

if (isset($_GET["clearList"]) && $_GET["clearList"] == "oui")
{
	$_SESSION["userList"] = null;
	unset($_SESSION["userList"]);
	header("Location: index.php");
}

if (isset($_SESSION["userList"]))
{
	$userList = json_decode($_SESSION["userList"], true);
	foreach ($userList as $tmp)
	{
		$u = new User();
		$u->setAge($tmp["age"]);
		$u->setName($tmp["name"]);
		$users[] = $u;
	}
}

$alertAge = false;
$alertName = false;

if (isset($_POST["validator"]))
{
	$age = intval($_POST["age"]);
	$name = $_POST["name"];
	if ($age > 0 && $name != "")
	{
		$user = new User();
		$user->setName($name);
		$user->setAge($age);
		$users[] = $user;
	}
	else
	{
		if ($age <= 0)
			$alertAge = true;
		if ($name == "")
			$alertName = true;
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>BirchBox Test</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

	<?php
		if ($alertName)
		{
			?>
			<div class="alert alert-danger" role="alert">
				Votre nom es incorrect
			</div>
			<?php
		}
		if ($alertAge)
		{
			?>
			<div class="alert alert-danger" role="alert">
				Votre age es incorrect
			</div>
			<?php
		}
	?>
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link active" href="?clearList=oui">Clear les entrees</a>
		</li>
	</ul>
	<div class="container">
		<div class="col-sm-12 col-md-6">
			<form method="POST" action="">
				<div class="form-group">
					<label for="pseudo">Votre pseudo</label>
					<input type="text" class="form-control" id="pseudo" name="name" placeholder="Entrer votre pseudo">
				</div>
				<div class="form-group">
					<label for="age">Votre Age</label>
					<input type="number" class="form-control" id="age" name="age" placeholder="Votre Age">
				</div>
				<input type="text" class="form-control hidden" name="validator" value="ok" hidden>
				<button type="submit" class="btn btn-primary">Send</button>
			</form>
		</div>
		<div class="col-sm-12 col-md-6">
			<?php
			if ($users != null)
			{
				?>
				<h3>Listes des utilisateurs</h3>
				<ul>
					<?php
						foreach ($users as $u)	
						{
							$ret[] = $u->toArray();
							echo "<li>".$u->getName() . " (".$u->getAge().")</li>";
						}
						$_SESSION["userList"] = json_encode($ret);
					?>
				</ul>
				<?php
			}
			else
			{
				?>
				<h3>Aucune entree trouve</h3>
				<?php
			}
			?>

		</div>
	</div>
</body>

<footer>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</footer>
</html>