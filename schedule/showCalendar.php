<?php
require '../utilities/init.php';
require '../utilities/tools.php';

if(!isLoggedIn()) {
    header("Location: " . getBaseUrl() . "user/login.php");
    exit();
}
?>
<html>
    <head>
        <title>Logboat Brewing</title>
        <?php require '../utilities/links.php'; ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.5.0/fullcalendar.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.6/jstz.js"></script>-->
        <!--<script src="https://cdn.jsdelivr.net/bootstrap.calendar/0.2.4/js/calendar.min.js"></script>-->
        <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.calendar/0.2.4/css/calendar.min.css">-->
        
        <script>
            $(document).ready(function() {
                $("#calendar").fullCalendar({
                    header: {
        				left: 'prev,next today',
        				center: 'title',
        				right: 'month,basicWeek,basicDay'
        			},
                    events: "../api/schedule/getAll.php"
                });
            });
        </script>
    </head>
    <body>
        <?php require '../navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-10">
                    <div id="calendar"></div>
                </div>
                <div class="col-sm-2">
                    <button type="button" id="calendarSave" class="btn btn-primary" disabled="disabled" data-toggle="tooltip" title="Disabled until feature created">Save Current <br>Calendar</button>
                </div>
            </div>
        </div>
    </body>
</html>