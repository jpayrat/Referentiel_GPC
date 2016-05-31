<?php
require("haut.php");
?>
    <section class="corps">
        <div class="container index aff" style="border: 0px solid #000; padding: 0 30px;text-align: center;">

            <h1><?php echo $titre; ?></h1>

            <p><?php echo $nbIlot; ?> îlots</p>

            <br /><br />

            <form action="Parties_pros_v0.1/PPros/rechercheGlobal" method="POST">
                <div class="formSearchGlobal">
                    <button class="rechercheGenPProsSubmit" type="submit" aria-label="Rechercher"></button>
                    <?php echo $input; ?>
                    <br /><br />
                    <button class="rechercheRecentSubmit" id="rechercheRecentSubmit" type="submit">Parties récentes</button> - <button class="rechercheHasardSubmit" type="submit">Partie au hasard</button>
                </div>
            </form>

            <br /><br /><br /><br />
            <hr />
            <br />
            <div id="results_ilot" style="display: none;"></div>
            <br /><br /><br />

        </div>
    </section>

<?php
require("bas.php");
?>