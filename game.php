<?php

session_start();
if(!isset($_SESSION['name']))
{
	header("location:login.php");
}

echo "<h1>Player name: ";
echo $_SESSION['name'];
echo "</h1>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <div class="carGame">
    <div class="score">Score: 0</div>
    <div class="startScreen">
        <p id="now">Start</p>
        <p id="go">Log out</p>
        Move using arrow keys<br>
        Do not collide
    </div>
    <div class="gameArea"></div>
    </div>
    <script>

        var name= "<?php echo $_SESSION['name'] ?>";
        const score=document.querySelector('.score');
        const startScreen=document.querySelector('.startScreen');
        const gameArea=document.querySelector('.gameArea');
        const carGame=document.querySelector('.carGame');
        const now = document.getElementById('now');
        const go=document.getElementById('go');


        var audio=new Audio('sound/gamemusic.mp3');
        var audio2=new Audio('sound/gameover.mp3');
        let keys = { ArrowUp:false, ArrowDown:false, ArrowLeft:false, ArrowRight:false  };
        let player={speed:5};

        now.addEventListener('click',start);
        go.addEventListener('click',logout);
        document.addEventListener('keydown',keyDown);
        document.addEventListener('keyup',keyUp);

        function logout(){
            window.location.replace("logout.php");
        }

        let notice=document.createElement('div');
        notice.setAttribute('class','notice');
        carGame.appendChild(notice);
        notice.innerHTML="Level: 1";

        function collide(a,b){
            aRect= a.getBoundingClientRect();
            bRect= b.getBoundingClientRect();

            if((aRect.top>bRect.bottom)||(aRect.bottom<bRect.top)||(aRect.right<bRect.left+8)||(aRect.left>bRect.right-8)){
                return 0;
            }
            else{
                /*console.log(aRect.bottom,bRect.top);
                console.log(aRect.top,bRect.bottom);
                console.log(aRect.left,bRect.right);
                console.log(aRect.right,bRect.left);*/
                return 1;
            }
        }

        function keyDown(k){
            k.preventDefault();
            keys[k.key]=true;
        }

        function keyUp(k){
            k.preventDefault();
            keys[k.key]=false;
        }


        function movelines(){
            let lines=document.querySelectorAll('.lines');
            lines.forEach(move);

            function move(item){
                item.y+=player.speed-1;
                if(item.y>700)
                {
                    item.y-=750;
                }
                item.style.top=item.y+"px";
            }

        }

        function moveEnemy(car){
            let enemy=document.querySelectorAll('.enemy');
            enemy.forEach(movecheck);


            function movecheck(item){
                if(collide(car,item)){
                    player.start=false;
                    car.style.backgroundImage="url('img/explosion.png')";
                    car.style.backgroundSize="100% 100%";
                    startScreen.classList.remove('hide');
                    startScreen.innerHTML= 'Game over<br>' + name + ' got score ' + (player.score+1) + '<br><p id="now">Restart</p><p id="go">Log out</p>';
                    const now = document.getElementById('now');
                    const go=document.getElementById('go');
                    now.addEventListener('click',start);
                    go.addEventListener('click',logout);
                    audio.pause();
                    audio2.play();
                }
                item.y+=player.speed-1;
                if(item.y>750)
                {
                    item.y=-300;
                    item.style.left=Math.floor(Math.random()*350)+"px";
                }
                item.style.top=item.y+"px";
            }
        }


        function gameplay(){
            let car=document.querySelector('.car');
            let road=gameArea.getBoundingClientRect();
            //console.log(road);
            if(player.start){
                movelines();
                moveEnemy(car);
                if(keys.ArrowUp&&player.y>50) { player.y -= player.speed }
                if(keys.ArrowDown&& player.y<(road.bottom-95)) { player.y += player.speed }
                if(keys.ArrowLeft&& player.x>0) { player.x -= player.speed }
                if(keys.ArrowRight&& player.x<(road.width-70)) { player.x += player.speed }
                car.style.top= player.y + "px";
                car.style.left= player.x + "px";
                player.score++;
                if(player.score%400==0)
                player.speed++;
                if(player.score%500==0)
                {
                    notice.innerHTML= "Level: " + (player.score/500+1);
                }
                score.innerText="Score: "+player.score;
                window.requestAnimationFrame(gameplay);
            }
        }


        function start(){
            audio.play();
            notice.innerHTML="Level: 1";
            startScreen.classList.add('hide');
            gameArea.innerHTML="";
            player.start=true;
            player.speed=5;
            player.score=0;
            window.requestAnimationFrame(gameplay);

            for(let i=0;i<5;i++)
            {
                let roadLine=document.createElement('div');
                roadLine.setAttribute('class','lines');
                roadLine.y=i*150;
                roadLine.style.top= roadLine.y + "px";
                gameArea.appendChild(roadLine);
            }
            let car=document.createElement('div');
            car.setAttribute('class','car');
            gameArea.appendChild(car);

            player.x = car.offsetLeft;
            player.y = car.offsetTop;

            
            for(let i=0;i<3;i++)
            {
                let enemyCar=document.createElement('div');
                enemyCar.setAttribute('class','enemy');
                enemyCar.style.backgroundImage= "url('img/enemycar.png')";
                enemyCar.y=((i+1)*400)*-1;
                enemyCar.style.top= enemyCar.y + "px";
                enemyCar.style.left=Math.floor(Math.random()*350)+"px";
                gameArea.appendChild(enemyCar);
            }
        } 
    </script>
</body>
</html>