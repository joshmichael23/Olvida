<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Image Editor</title>
            <style type="text/css">
                [ng-cloak]#splash{
                display:block!important
                }
                [ng-cloak]{
                display:none
                }
                #splash{
                display:none;
                position:absolute;
                top:45%;
                left:50%;
                width:6em;
                height:6em;
                overflow:hidden;
                border-radius:100%;
                z-index:0
                }
                @-webkit-keyframes fade{
                from{
                opacity:1
                }
                to{
                opacity:.2
                }
                }
                @keyframes fade{
                from{
                opacity:1
                }
                to{
                opacity:.2
                }
                }
                @-webkit-keyframes rotate{
                from{
                -webkit-transform:rotate(0deg)
                }
                to{
                -webkit-transform:rotate(360deg)
                }
                }
                @keyframes rotate{
                from{
                transform:rotate(0deg)
                }
                to{
                transform:rotate(360deg)
                }
                }
                #splash::after,#splash::before{
                content:'';
                position:absolute;
                top:0;
                left:0;
                width:100%;
                height:100%
                }
                #splash::before{
                background:linear-gradient(to right,green,#ff0);
                -webkit-animation:rotate 2.5s linear infinite;
                animation:rotate 2.5s linear infinite
                }
                #splash::after{
                background:linear-gradient(to bottom,red,#00f);
                -webkit-animation:fade 2s infinite alternate,rotate 2.5s linear reverse infinite;
                animation:fade 2s infinite alternate,rotate 2.5s linear reverse infinite
                }
                #splash-spinner{
                position:absolute;
                width:100%;
                height:100%;
                z-index:1;
                border-radius:100%;
                box-sizing:border-box;
                border-left:.5em solid transparent;
                border-right:.5em solid transparent;
                border-bottom:.5em solid rgba(255,255,255,.3);
                border-top:.5em solid rgba(255,255,255,.3);
                -webkit-animation:rotate .8s linear infinite;
                animation:rotate .8s linear infinite
                }

            </style>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/editor/assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/editor/assets/css/integrate.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>




    </head>
