<script type="text/javascript" src="src/assets/js/jquery.js"></script>

    <script>
        function onSubmit(){
            console.log($("#usermsg").val());
            if($("#usermsg").val()) {
                //alert($("#usermsg").val());
                var clientmsg = $("#usermsg").val();
                var target = $("#profile_username").attr('data-username');
                $.ajax({
                    type: "POST",
                    url: "src/php/src_chat/private_add_reply.php", 
                    data: {text: clientmsg, target: target},
                });

                $("#usermsg").val("");
                loadLog();
                return false;
            }
        }

        function scrollDown(){
            //window.location.href = "#usermsg";
        }

        function loadLog(){   
            var target = $("#profile_username").attr('data-username');
            console.log("Refreshed chat");
            $.ajax({
                url: "src/php/src_chat/private_chatlog.php",
                cache: false,
                type: "POST",
                data: {target: target},
                success: function(data){
                    $("#chatbox").html($.parseJSON(data)); 
                    /*if(first){
                        scrollDown();
                    }*/
                },
            });

            //scrollDown();
        }

        $( document ).ready(function() {
            loadLog();
            //scrollDown();
            setInterval (function(){loadLog();}, 3000);
            //scrollDown();
            $("#usermsg").keydown(function(event){ 
                if(event.which == 13) {
                    onSubmit();
                };
            });
        });
    </script>