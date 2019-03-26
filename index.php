<?php require 'header.php'; ?>
    <style>
        .button{
            font-size: 26px;
            text-decoration: none;
        }
        .container{
            display: block;
            align-content: center;
        }
        .home{
            text-align: center;
        }
        @media screen and (max-width: 800px){
            .container{
                font-size: 20px;
            }
        }
    </style>


<div class="container">
    <div class="home">
        <img src="hond.png" alt="" height="100" width="75">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/yC3kTjV7GzE" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <button class="button"><a href="download.php">Download</a></button>
    </div>
</div>


<?php require 'footer.php'; ?>