$(document).ready(function() {
    $('.draggable').on('dragstart', function(e){
        var player_id = $(this).attr('id');
        e.originalEvent.dataTransfer.setData("player_id", player_id);
     });
     $("#playingXI").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', '#BBD5B8');
	});

	$("#playingXI").on('dragover', function (e){
		e.preventDefault();
	});

	$("#playingXI").on('drop', function (e){
		e.preventDefault();
		$(this).css('background', '#FFFFFF');
		var player_code = e.originalEvent.dataTransfer.getData('player_id');
		cartAction('add',player_code);
	});

    function cartAction(action,player_code) {
        var queryString = "";
        if(action != "") {
            switch(action) {
                case "add":
                    queryString = 'action='+action+'&playerId='+ player_code;
                break;
                case "remove":
                    queryString = 'action='+action+'&code='+ product_code;
                break;
                case "empty":
                    queryString = 'action='+action;
                break;
            }	 
        }
        jQuery.ajax({
            url: "src/public/playerAction.php",
            data:queryString,
            type: "POST",
            success:function(data){
                $("#playingXI").html(data);
            },
            error:function (){}
        });
    }
})