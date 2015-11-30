<?php

require '../tools.php';

//End the session
session_start();
session_unset();
session_destroy();

header("Location: " . getBaseUrl());