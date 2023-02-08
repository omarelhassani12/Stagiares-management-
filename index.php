<?php

require_once('./pages/identifier.php');
require_once('./pages/connexiondb.php');

$query = "SELECT idStagiaire, idFiliere FROM stagiaire";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$chartData = [];

foreach ($result as $row) {
    $chartData[] = [
        'stagiaires' => $row["idStagiaire"],
        'filieres' => $row["idFiliere"],
    ];
}

?>

<head>
    <meta charset="utf-8">
    <title>Gestion des filières</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="./css/morris.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/raphael-min.js"></script>
    <script src="./js/morris.min.js"></script>
    <style>
        .container div {
            /* display: flex;
            align-items: center; */


        }

        #chart {
            height: 400px;
            width: 730px;
            border: 10px solid #0095ff;

        }
    </style>
</head>

<body>
    <?php //include('./pages/menu.php'); 
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">

        <div class="container-fluid">

            <div class="navbar-header">

                <a href="./index.php" class="navbar-brand">Gestion des stagiaires</a>

            </div>

            <ul class="nav navbar-nav">

                <li><a href="./pages/stagiaires.php">
                        <i class="fa fa-vcard"></i>
                        &nbsp Les Stagiaires
                    </a>
                </li>

                <li><a href="./pages/filieres.php">
                        <i class="fa fa-tags"></i>
                        &nbsp Les Filières
                    </a>
                </li>

                <?php if ($_SESSION['user']['role'] == 'ADMIN') { ?>

                    <li><a href="./pages/Utilisateurs.php">
                            <i class="fa fa-users"></i>
                            &nbsp Les utilisteurs
                        </a>
                    </li>

                <?php } ?>

            </ul>


            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="./pages/editerUtilisateur.php?iduser=<?php echo $_SESSION['user']['iduser'] ?>">
                        <i class="fa fa-user-circle-o"></i>&nbsp
                        <?php echo  ' ' . $_SESSION['user']['login'] ?>
                    </a>
                </li>

                <li>
                    <a href="./pages/seDeconnecter.php">
                        <i class="fa fa-sign-out"></i>
                        &nbsp Se déconnecter
                    </a>
                </li>

            </ul>

        </div>
    </nav>
    <div class="container">
        <br>
        <br>
        <h2 align="center">Les etudiants par les filieres</h2>
        <h3 align="center"></h3>
        <br>
        <br>
        <div id="chart"></div>
    </div>
</body>

<script>
    Morris.Bar({
        element: 'chart',
        data: <?php echo json_encode($chartData); ?>,
        xkey: 'stagiaires',
        ykeys: ['filieres'],
        labels: ['filieres'],
        hideHover: 'auto'
    });
</script>