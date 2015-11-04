<?php

//End the session
session_start();
session_unset();
session_destroy();

header("Location: http://cs3380-jam9rd.cloudapp.net/LogboatBrewing/home.php");