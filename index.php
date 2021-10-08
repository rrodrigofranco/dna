<?php
     include_once ('./upload.php');
     
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Interseção de Matchs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="docs/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/file-upload.css" />
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
        <script src="docs/js/jquery.js"></script>
        <script src="dist/js/file-upload.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.file-upload').file_upload();
            });
        </script>
    </head>
    <body>
        <div class="container">
			<h1>Correspondências de DNA</h1>
			<p>Aqui você pode verificar a interseção das correspondências de DNA entre duas pessoas.<br>
            Nós trabalhamos com arquivos provenientes das plataformas MyHeritage e FTDA.</p>
            

            <form method = "post" action = "." enctype="multipart/form-data">
            <div class="row form-group">
                    <div class="col-sm-2">
                        Plataforma
                    </div>
                    <div class="col-sm-10">
                    <label>
                    <select name="plataforma" id="plataforma" class="form-control" aria-label="Default select example">
                        <option value="MyHeritage">MyHeritage</option>
                        <option value="FTDNA">FTDNA</option>
                    </select>
                    </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        DNA1
                    </div>
                    <div class="col-sm-10">
                        <label>
                            <input type="file" id = "dna1" name = "csv1" />
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        DNA2
                    </div>
                    <div class="col-sm-10">
                        <label>
                            <input type="file" id = "dna2" name = "csv2"/>
                        </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-2">
                        Matchs
                    </div>
                    <div class="col-sm-10">
                        <button class="file-submit btn btn-primary" type="submit">Salvar</button>
                    </div>
                </div>
            </form>

            <pre class="prettyprint">
                <?php
                $dna = getMatchs();
                //echo $dna;
                if($dna != "nada"){
                    //echo '<div align = "center"';
                    
                    foreach ($dna as $key => $value) {
                        if ($key > 0)
                            echo ''.$value.'';
                            echo '<br>';
                    }
                    // echo '</div>';
                }
                ?>
            </pre>
            <div align = "center">
                <p>Copyright (c) 2021 Rodrigo Franco</p>
            </div>
            <script type="text/javascript">
                document.getElementById('plataforma').value = "<?php echo $_POST['plataforma'];?>";
            </script>
        </div>
    </body>
</html>
