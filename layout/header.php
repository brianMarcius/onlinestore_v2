<?php
session_start();
if (empty($_SESSION)) {
    header("Location:../index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Perwira Steel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/custom_bootstrap.css">
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="img/logo/logo1.png">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    .select2-selection{
    height:48px !important;
    border: 1px solid #ced4da !important;
  }

  .select2-selection__rendered{
    height:48px !important;
    padding: 8px 16px;
    color: #495057 !important;
  }
  body{
    background-color:#eee;
  }
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  .content-wrapper{
    padding:50px 20px 50px 20px;
  }

  .row{
    padding:10px 0px 10px 0px;
  }

  .load-more{
    text-align:center;
    width:100%;
    padding-top:10px;
  }

  #loadMore {
    padding: 10px;
    text-align: center;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
  }
  
  #loadMore:hover {
      background-color: #fff;
      color: #33739E;
  }

  .totop {
    position: fixed;
    bottom: 10px;
    right: 20px;
    z-index:10;
  }

  .totop a {
      display: none;
  }

  .container-fluid {
    padding: 60px 50px;
  }

  .slideanim {visibility:hidden;}

  .slide {
    animation-name: slide;
    -webkit-animation-name: slide;
    animation-duration: 1s;
    -webkit-animation-duration: 1s;
    visibility: visible;
  }

  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }

  @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0 !important;
    top: 0 !important;
  }
}

  </style>
  <script>

    $(function(){
      $(window).scroll(function() {
            $(".slideanim").each(function(){
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                $(this).addClass("slide");
                }
            });
        });
    })
  </script>
</head>
<body>