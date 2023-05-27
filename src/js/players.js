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
        $("#"+player_code).remove();
	});

    $(".removePlayer").on('click', function(e){
        var result = confirm("Are you sure want to remove this player from playing XI ?");
        if (result) {
            var playerId = $(this).attr('id');
            jQuery.ajax({
                url: "src/public/playerActionAjax.php",
                data:{removePlayerFromPlayingXi:1, playerId:playerId},
                type: "POST",
                success:function(data){
                    $("#playingXI").html(data);
                },
                error:function (){}
            });
            location.reload();
            location.reload();
        }
    })
    $(".deletePlayer").on('click', function(e){
        var result = confirm("Are you sure want to remove this player from this Squad ?");
        if (result) {
            var playerId = $(this).attr('id');
            jQuery.ajax({
                url: "src/public/playerActionAjax.php",
                data:{removePlayerFromSquad:1, playerId:playerId},
                type: "POST",
                success:function(data){
                    $("#squadList").html(data);
                },
                error:function (){}
            });
            alert("Player removed from your Squad.")
            location.reload();
            location.reload();
        }
    })

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
            url: "src/public/playerActionAjax.php",
            data:queryString,
            type: "POST",
            success:function(data){
                if (data == false) {
                    alert("Team already full, please remove some player to add new player from squad");
                }
                $("#playingXI").html(data);
            },
            error:function (){}
        });
            location.reload();
    }

    $("#addNewPlayerButton").on('click', function(){
        if ($("#addNewPlayerForm").valid()) {
            var playerName = $("#playerName").val();
            var jerseyNo = $("#jerseyNo").val();
            var playerType = $("#playerType").val();
            jQuery.ajax({
                url: "src/public/playerActionAjax.php",
                data:{addNewPlayer:1, playerName:playerName, jerseyNo:jerseyNo, playerType:playerType},
                type: "POST",
                success:function(data){
                    $("#addedMessage").show();
                },
                error:function (){}
            });
            alert("New player Inducted to the team.")
        }
    })

    $("#addPlayerScore").on("click", function() {
        const items = document.querySelectorAll('.playerScore');
        var playerIdAndScore = {}
        for (let i = 0; i < items.length; i++) {
            var playerScore = items[i].value;
            var playerId = items[i].id;
            playerIdAndScore[playerId] = playerScore;
        } 
        jQuery.ajax({
            url: "src/public/playerActionAjax.php",
            data:{addPlayerScore:1, idAndScore:playerIdAndScore},
            type: "POST",
            success:function(data){
                // $("#addedMessage").show();
            },
            error:function (){}
        });
        alert("All player's score saved successfully.")
        location.reload();
    })

    $("#viewChart").on('click', function(){
        jQuery.ajax({
            url: "src/public/playerActionAjax.php",
            data:{showChart:1},
            type: "POST",
            success:function(data){
                $("#chartBody").html(data);
            },
            error:function (){}
        });
        $('#viewChartModal').modal('show');
    })

})