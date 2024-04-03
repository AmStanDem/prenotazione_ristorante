<?php
global $connect;
require_once '../config/connect.php';
require_once '../src/functions.php';
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visualizzazione prenotazioni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sistema di prenotazione ristorante</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Visualizza prenotazioni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inserisci prenotazione</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
    $res = getPrenotazioni($connect);
    if (mysqli_num_rows($res) > 0)
    {
        echo "<table class='table'>";
        echo "
            <thead>
                <tr>
                    <th scope='col'>Nome</th>
                    <th scope='col'>Data</th>
                    <th scope='col'>Numero di persone</th>
                </tr>
            </thead>";
        $i = 1;
        echo "<tbody>";
        while ($row = $res->fetch_assoc())
        {
            ?>
            <td><?php echo $row['nome']; ?></td>;
            <td><?php echo $row['dt_prenotazione']; ?></td>;
            <td><?php echo $row['num_persone']; ?></td>;
            <?php
        }
        echo "</tbody>";
        echo "</table>";
    }
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>