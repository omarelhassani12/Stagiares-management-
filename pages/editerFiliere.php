<?php
require_once('identifier.php');
require_once('connexiondb.php');
$idf = isset($_GET['idF']) ? $_GET['idF'] : 0;
$requete = "select * from filiere where idFiliere=$idf";
$resultat = $pdo->query($requete);
$filiere = $resultat->fetch();
$nomf = $filiere['nomFiliere'];
$niveau = strtolower($filiere['niveau']);
?>
<! DOCTYPE HTML>
    <HTML>

    <head>
        <meta charset="utf-8">
        <title>Edition d'une filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>

    <body>
        <?php include("menu.php"); ?>

        <div class="container">

            <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition de la filière :</div>
                <div class="panel-body">
                    <form method="post" action="updateFiliere.php" class="form">
                        <div class="form-group">
                            <label for="niveau">id de la filière: <?php echo $idf ?></label>
                            <input type="hidden" name="idF" class="form-control" value="<?php echo $idf ?>" />
                        </div>

                        <div class="form-group">
                            <label for="niveau">Nom de la filière:</label>
                            <input type="text" name="nomF" placeholder="Nom de la filière" class="form-control" value="<?php echo $nomf ?>" />
                        </div>

                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
                            <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                                <option value="all" <?php if ($niveau === "all") echo "selected" ?>>Tous les niveaux
                                </option>
                                <option value="1er" <?php if ($niveau === "1er")   echo "selected" ?>>1er annee</option>
                                <option value="2eme" <?php if ($niveau === "2eme")  echo "selected" ?>>2eme annee
                                </option>
                                <option value="l" <?php if ($niveau === "l")   echo "selected" ?>>Licence</option>
                                <option value="m" <?php if ($niveau === "m")   echo "selected" ?>>Master</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-save"></span>
                            Enregistrer
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </body>

    </HTML>