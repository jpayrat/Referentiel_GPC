$(document).ready(function() {

    $('#rechercheListerTout').on('click', function () {
        alert('plop'); // fonction ajax
    });

});


function requeteAjax(critere)
{

        //alert(data_get);
        // on envoie la valeur recherché en GET au fichier de traitement
        $.ajax({
            type : 'GET', // envoi des données en GET ou POST
            url : '_php/'+iloReqAjax_C , // url du fichier de traitement
            data : data_get,
            beforeSend : function() { // traitements JS à faire AVANT l'envoi
                $('#results_ilot').empty();
                $('#results_ilot').html('</br /><center><img src="_img/_design/ajax-loader.gif" alt="loader" id="ajax-loader" /></center>'); // ajout d'un loader pour signifier l'action
            },
            success : function(data){
                // traitements JS à faire APRES le retour du fichier .php

                $('#results_ilot').fadeIn().html(data); // affichage des résultats dans le bloc #results
            }
        });

}
