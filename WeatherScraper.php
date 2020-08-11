<?php
    $weather ="";
    $error ="";
    if(isset($_GET['name'])){
        $url_contents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['name'])."&appid=8ccb8b1157a44e20df6dc9193f25fcee");
        $weather_array = json_decode($url_contents,true);
        //print_r($weather_array);
        if($weather_array['cod'] == 200){
            
            $weather = "The weather in ".$_GET['name']." is currently '".$weather_array['weather'][0]['description']."'. ";
            $tempInCelcius = intval($weather_array['main']['temp']- 273);
            $weather .= " The temperature is ".$tempInCelcius."&deg;c ";
            $windSpeed = $weather_array['wind']['speed'];
            $weather .= " and the wind speed is ".$windSpeed." meter/sec. ";
            
        }
        else{
            $error ="Could not find the city! please try again.";
        }
    }
  
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Waether Website!</title>
    <style type="text/css" >
        body{
            background-image: url("newone.jpg");
            position: relative;
            height :100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        html {
            height :100%; 

        }
        h1{
            text-align: center;
            color: white;
            margin-top:140px;
         }
         #nameofcity{
             text-align: center;
            color: white;
         }
       #submit{
           padding:30px;
       }
       input{
           margin-top :25px;
       }
         
    </style>
    
  </head>
    
  <body>
      
      <div class="container">
      <h1>What's The Weather?</h1>
      <p id="nameofcity">Enter the name of a city.</p>
      <form class="col-lg-6 offset-lg-3" method="get">
       <input class="form-control row justify-content-center" name="name" type="text" placeholder="Eg. London, Tokyo" value="<?php 
       if(array_key_exists('name',$_GET)){echo $_GET['name'];}?> ">
       <div class="col-auto text-center" id="submit">
             <button type="submit" class="btn btn-primary mb-2 btn-lg">Submit</button>
        </div>
       </form>
       <div id="weather"><?php 
       if($weather){
           echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
       }
       else if($error){
            echo '<div class="alert alert-danger " role="alert">'.$error.'</div>';
       }
       ?></div>
       </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>