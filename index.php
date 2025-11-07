<?php
// login.php

// 1) Conexão
$mysqli = new mysqli("localhost", "root", "", "petshop_db");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

// 2) Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// 3) Login
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = trim($_POST["username"] ?? "");
    $pass = trim($_POST["password"] ?? "");

    // Consulta apenas o usuário
    $stmt = $mysqli->prepare("SELECT id, username, senha FROM usuarios WHERE username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados && password_verify($pass, $dados["senha"])) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["username"] = $dados["username"];
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Login PetShop</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (!empty($_SESSION["user_id"])): ?>
  <div class="card">
    <h3>Bem-vindo, <?= htmlspecialchars($_SESSION["username"]) ?>!</h3>
    <p><a href="dashboard.php">Ir para o Dashboard</a></p>
    <p><a href="?logout=1">Sair</a></p>
  </div>

<?php else: ?>
  <div class="card">
    <h3>Login - PetShop</h3>
    <?php if ($msg): ?><p class="msg"><?= $msg ?></p><?php endif; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Usuário" required>
      <input type="password" name="password" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
    <p><small>Dica: admin / 123456</small></p>
  </div>
<?php endif; ?>

</body>
</html>
