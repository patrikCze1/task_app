<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@if(isset($title))
    <title>App | {{$title}}</title>
@else
    <title>App |</title>
@endif
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<style>
    body{
        background-color: white;
        background-image: url("/storage/img/background.jpg");
        background-size: 100%;
        background-repeat: no-repeat;
        background-attachment: fixed;

    }
    .container{
        background-color: rgba(255,255,255,0.9);
        border-radius: 1px;
        width: 75%;
        padding-left: 20px;
        padding-right: 20px;
    }
    a{
        color: black;
    }
    .container-height{
        padding-bottom: 30px;
    }
    .contact-right{
        width: 45%;
        float: right;
        margin-bottom: 10px;
    }
    .contact-left{
        float: left;
        margin: 0 20px;
    }
    .text-info{
        font-size: +17px;
    }
    .text-info h3{
        color: #0E2231;
    }
    .post-left{
        width: 65%;
        padding: 5px;
    }
    .post-right{
        background-color: white;
        float: right;
        width: 35%;
        padding: 20px;
        height: 100%;
        position: relative;
        left: 15px;
    }
    .post{
        background-color: white;
        border-radius: 1px;
        padding: 15px;
        margin: 10px;
        border-bottom: grey solid 2px;
    }
    .post h3{
        display: inline;
    }
    .p{
        width: 50%;
        float: left;
        margin-top: 5px;
    }
    .post-left h1{
        display: inline;
    }
    .post-order{
        width: 50%;
        text-align: right;
    }
    .pulka{
        width: 50%;
        text-align: left;
    }
    .tutorial{
        float: left;
        width: 31%;
        height: 15%;
        padding: 5px 20px;
        margin: 1%;
        border: 1px solid #3F3F3F;
        background-color: white;
    }
    .tutorial h3{
        text-align: center;
    }
    .tutorial-img{
        width: 60%;
        height: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .tut-top h1{
        display: inline;
    }
    .tut-top{
        width: 100%;
        height: auto;
        margin: 15px;
    }
    .tut-order{
        width: 50%;
        text-align: right;
        margin: 0px 4%;
    }
    .tut-input{
        width: 70% !important;
        margin: 0px !important;
        display: inline;
    }
    .form-inline{
        display: inline;
    }
    .job-left{
        margin: 5px 15px;
        width: 50%;
    }
    .job-right{
        width: 50%;
        float: right;
    }
    td{
        padding: 5px;
    }
    .btn-tutorial{
        width: 100%;
        float: left;
    }
    .user-left{
        width: 40%;
    }
    .user-right{
        width: 58%;
        float: right;
    }
    .job{
        width: 47%;
        float: left;
        margin: 1%;
        padding: 1%;
        background-color: white;
        border-bottom: grey solid 3px;
    }
    .col-md-6{
        padding: 0px;
    }
    .table-chat td{
        padding: 10px 0px;
    }
    .input-chat{
        width: 90%;
        height: 36px;
        padding: 6px 12px;
        background-color: #fff;
        border: 1px solid #ccd0d2;
        border-radius: 4px;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    }
    .post_comment{
        width: auto;
        background-color: white;
        border-radius: 10px;
        padding: 5px;
    }
    hr{
        border-top: 1px solid #ccc;
    }
    .left-border{
        border-left: solid grey 2px;
    }
    select{
        padding: 6px;
        border-radius: 2px;
    }
</style>