    <div id="wrapper">        
        <div id="chatbox">
            
        </div>

        <input name="usermsg" id="usermsg" type="text"/>

        <button id="submitmsg" type="button" onclick="onSubmit()">Send</button>

    </div>


    <script type="text/javascript" src="src/assets/js/jquery.js"></script>

    <script>
        function onSubmit(){
            console.log($("#usermsg").val());
            if($("#usermsg").val()) {
                //alert($("#usermsg").val());
                var clientmsg = $("#usermsg").val();
                $.ajax({
                    type: "POST",
                    url: "src/php/src_chat/add_reply.php", 
                    data: {text: clientmsg},
                });

                $("#usermsg").val("");
                loadLog();
                return false;
            }
        }

        function scrollDown(){
            window.location.href = "#usermsg";
        }

        function loadLog(){   
            
            console.log("Refreshed chat");
            $.ajax({
                url: "src/php/src_chat/chatlog.php",
                cache: false,
                success: function(data){        
                    $("#chatbox").html($.parseJSON(data)); 
                    /*if(first){
                        scrollDown();
                    }*/
                },
            })/*.done(function(msg) {
              alert(msg);
            })*/;

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
