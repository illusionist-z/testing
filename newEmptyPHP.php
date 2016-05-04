<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            canvas{
                display: block;
                    margin: 0 auto;
                background: #dddddd;
            }
        </style>
       
    </head>
    <body>
     
        <canvas id="can" width="400" height="300"></canvas>
         <script type="text/javascript">
            var canvas = document.getElementById("can");
            var ctx = canvas.getContext("2d");
            var x = canvas.width/2;
            var y = canvas.height - 10;
            var dx = 3;
            var dy = -3;
            function drawCirCle(){
                
                ctx.clearRect(0,0,canvas.width,canvas.height);
            ctx.beginPath();
            ctx.arc(x,y,10,0,Math.PI*2);
            ctx.fillStyle = 'red';
            ctx.fill();
            ctx.closePath();
            rect();
            if(x >canvas.width || x < 10){
                dx = -dx;
            }
            
            if(y >canvas.height || y < 10){
                dy = -dy;
            }
            x += dx;
            y += dy;
            requestAnimationFrame(drawCirCle);
        }
        drawCirCle();
//        setInterval(drawCirCle(),1000);
        function rect(){
                   ctx.beginPath();
            var x = canvas.width/2;
            var y = canvas.height/2;
            ctx.rect(x,y,40,49);
            ctx.fillStyle = "blue";
            ctx.fill();            
            ctx.closePath();
    }
     
        </script>
    </body>
</html>

