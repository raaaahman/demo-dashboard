$(document).ready(function() {

    let action = $("#new-user-form").attr('action');
    let messageSuccess = '';

    if (action == 'register') {
        messageSuccess = '<p>Votre inscription a été prise en compte.</p>' +
            '<a href="login">Se connecter</a>';
    }

    if (action == 'update') {
        messageSuccess = '<p>L\'utilisateur a été mis à jour.</p>' +
            '<a href="?action=list">Retour à la liste des utilisateurs</a>';
    }


    //Evenement sur le formulaire

    $("#new-user-form").on('submit', function() {

        //GO AJAX!
        $.post(action, $('#new-user-form').serialize(), function(data) {
            $('#new-user-form').before(
                messageSuccess
            );
            console.log(data);
            //Toggle le formulaire
            $('#new-user-form').slideToggle();
        });

        return false; //Pas de changement de page
    });
});