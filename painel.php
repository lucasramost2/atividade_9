<?php
session_start();

if (empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Dashboard - PetShop</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="card">
    <h2>Dashboard do PetShop 🐶🐱</h2>
    <p>Bem-vindo, <?= htmlspecialchars($_SESSION["username"]) ?>!</p>
    <p>Aqui você pode gerenciar clientes, pets e agendamentos.</p>
    <p><a href="login.php?logout=1">Sair</a></p>
  </div>
</body>
</html>
