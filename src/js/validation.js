$(document).ready(function () {

    $('#addNewPlayerForm').validate({ // initialize the plugin
        rules: {
            playerName: {
                required: true
            },
            jerseyNo: {
                required: true,
                number:true
            },
            playerType: {
                required: true
            }
        },
        messages : {
            playerName: "Please enter player name.",
            jerseyNo: {
                required: "Please enter jerseyNo.",
                number: "String is not acceptable."
            },
            playerType: "Please enter player type."
        }
    });

});