<?php

include "./Config.php";
include "./Functions.php";

# Copyright hannd17 2018

?>
<html>

<head>
    <title>Captcha - Example</title>
    <meta name="viewport" content="width=device-width, inital-scale=1, user-scalable=no" />
    
    <style>
    
        body{
            font-family: Helvetica;
        }

        #t-form{
            width: 300px;
            padding: 5px;
        }

        #t-form input, #t-form .message {
            width: 100%;
            background: white;
            outline: none;
            border: 2px solid black;
            padding: 5px;
            font-size: 17px;
            margin: 5px;
            
            transition: all .2s ease-out;
            
            border-radius: 0px;
            -webkit-appearance: none;
            -webkit-border-radius: 0;

        }
        
        #t-form .message{
            width: calc(100% - 10px - 4px);
            opacity: 0;
        }
        #t-form .message.active{
            opacity: 1;
        }
        
        #t-form .message.success{
            color: green;
            border-color: green;
        }
        #t-form .message.error{
            color: red;
            border-color: red;
        }

        #t-form input:hover, #t-form textarea:hover {
            border-color: darkorange;
        }

        #t-form input[type=submit]{
            cursor: pointer;
        }
        
        #captcha-box{
            height: 80px;
            border: 2px solid black;
            width: calc(300px - 4px);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 5px;
            padding: 5px;
        }
            
    </style>
</head>
<body>
    
    <div id="captcha-box"></div>
    
    <div id="t-form" class="form">
        <input id="captcha" type="text" name="captcha" placeholder="Enter Captcha" />
        <input id="send" type="submit" value="Post" />
        <div id="message" class="message"></div>
    </div>

    <script>

        var strCaptchaHash;

        c = document.querySelector("input#captcha");
        c_b = document.querySelector("div#captcha-box");
        m = document.querySelector("div#message");


        document.querySelector("input#send").onclick = function(){

            var url = "verify?captcha=" + c.value + "&uid=" + strCaptchaHash;
            r = new XMLHttpRequest();
            r.open("GET", url, true);

            r.onload = function(){
                console.log(r.response);
                data = JSON.parse(r.response);
                m.innerHTML = data.message;
                m.classList.add("active");
                m.classList.remove(data.status == "false" ? "success" : "error");
                m.classList.add(data.status == "true" ? "success" : "error");  
            }
            r.send();

        }
        
        function fnGetCaptcha(){
            // Get captcha from API;
            var url = "get";
                r = new XMLHttpRequest();
                r.open("GET", url, true);

                r.onload = function(){
                    data = r.response;
                    
                    data = JSON.parse(data);
                    
                    c_b.style.backgroundImage = "url(" + data.extra.image + ")";
                    
                    strCaptchaHash = data.extra.hash;
                }
                
                r.send();
        }
        
        fnGetCaptcha();

    </script>
    
</body>
</html>