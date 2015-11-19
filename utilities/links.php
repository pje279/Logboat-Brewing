<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

<!-- JQuery -->
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JavaScript (required JQuery) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

<link rel="stylesheet" href="styles.css?version=0.0.1">

<script>
    function getBaseUrl() {
        return "https://cs3380-jam9rd.cloudapp.net/LogboatBrewing/";    //Jacob
        //Pearse
        //Devun
        //Seth
        //Peter
        //return "https://logboat.cloudapp.net/";                       //Master VM
    }
</script>

<?php
    //TODO: move this?

    if($_SERVER['HTTPS'] != 'on') {
        header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
    }
    
    session_start();
?>