<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
  <link href="assets/img/fav.png" rel="icon">
  <link href="assets/img/f2.png" rel="apple-touch-icon">

 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/mainStylesheet.css">
    <title><?php
        include_once('./loginVerification/loginHandler.php');
        $mem = createMemSession();
        if($mem->get('user') === null){
            echo $mem->get('user').'\'s page';
        }else{
            echo 'Prince Kevin Hospital';
        }
    ?></title>
</head>