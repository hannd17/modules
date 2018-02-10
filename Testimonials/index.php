<?php

include "./Config.php";
include "./Functions.php";

# Testimonials index.
# fn404()

?>
<html>

<head>
    <title>Testimonials - Example</title>
    <meta name="viewport" content="width=device-width, inital-scale=1, user-scalable=no" />
    
    <style>
    
        body{
            font-family: Helvetica;
        }

        #t-form{
            width: 300px;
            padding: 5px;
        }

        #t-form input, #t-form textarea, #t-form .message {
            width: 100%;
            background: white;
            outline: none;
            border: 2px solid black;
            padding: 5px;
            font-size: 17px;
            margin: 5px;
            
            transition: all .2s ease-out;
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

        .testimonial{
            border-bottom: 2px solid black;
            width: 300px;
            margin: 5px;
            background: white;
            padding: 5px;
            font-size: 17px;
        }
        .testimonial:nth-of-type(even){
            background: #f7f7f7;
        }

        .testimonial .text{
            font-weight: 600;
            margin-bottom: 2px;
        }

        .testimonial .name{
            text-align: right;
            font-size: 15px;
        }
    
    </style>
</head>
<body>
    
    <div id="testimonials">
        
    </div>

    <div id="t-form" class="form">
        <input id="name" type="text" name="name" placeholder="Name" />
        <textarea id="testimonial" name="testimonial" placeholder="Your testimonial..."></textarea>
        <input id="send" type="submit" value="Post" />
        <div id="message" class="message"></div>
    </div>

    <script>

        var hasTypedTheMessage = false;

        t = document.querySelector("textarea#testimonial");
        n = document.querySelector("input#name");
        m = document.querySelector("div#message");

        t.onkeydown = function(e){
            hasTypedTheMessage = true;
        }

        document.querySelector("input#send").onclick = function(){

            var url = "submit?testimonial=" + t.value + "&name=" + n.value;
            r = new XMLHttpRequest();
            r.open("GET", url, true);

            r.onload = function(){
                //console.log(r.response);
                data = JSON.parse(r.response);
                m.innerHTML = data.message;
                m.classList.add("active");
                m.classList.remove(data.status == "false" ? "success" : "error");
                m.classList.add(data.status == "true" ? "success" : "error");
                
                fnGetTestimonials();
            }
            r.send();

        }
        
        function fnGetTestimonials(){
            // Get testimonials from API;
            var url = "get";
                r = new XMLHttpRequest();
                r.open("GET", url, true);

                r.onload = function(){
                    data = r.response;
                    
                    data = JSON.parse(data);
                    console.log(data);
                    
                    document.getElementById("testimonials").innerHTML = "";
                    for(x of data){
                        testimonial = JSON.parse(x);
                        //console.log(testimonial);
                        
                        t_el = document.createElement("div");
                        t_el.classList.add("testimonial");
                        
                        text_el = document.createElement("div");
                        text_el.classList.add("text");
                        text_el.innerHTML = testimonial.testimonial;
                        
                        name_el = document.createElement("div");
                        name_el.classList.add("name");
                        name_el.innerHTML = testimonial.name;
                        
                        t_el.appendChild(text_el);
                        t_el.appendChild(name_el);
                        
                        document.getElementById("testimonials").appendChild(t_el);
                    }
                    
                }
                
                r.send();
        }
        
        fnGetTestimonials();

    </script>
    
</body>
</html>