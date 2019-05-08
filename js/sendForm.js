$(document).ready(function() {

    /*
    let messageSuccess = '';

    if (action == 'register') {
        messageSuccess = '<p>Votre inscription a été prise en compte.</p>' +
            '<a href="login">Se connecter</a>';
    }

    if (action == 'update') {
        messageSuccess = '<p>L\'utilisateur a été mis à jour.</p>' +
            '<a href="?action=list">Retour à la liste des utilisateurs</a>';
    }
    */

    function logResults(request, status) {
        switch (status) {
            case 'success' :
                console.log('Done.');
                break;
            case 'error' :
                console.log('Failed.');
                break;
        }
    }

    //Evenement sur le formulaire

    $('.ajax-form').on('submit', function(event) {
        let form = $(event.target);

        //GO AJAX!
        $.ajax({
            url : form.attr('action'),
            method : form.attr('method') !== undefined ? form.attr('method') : 'post',
            data :  form.serialize(),
            complete : logResults
        });

        return false; //Pas de changement de page
    });
});