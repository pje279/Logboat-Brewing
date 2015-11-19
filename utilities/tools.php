<?php

function say($text) {
    echo "$text<br>";
}

function printReadOnly($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='text' class='form-control' id='$key' value='$value' readonly>";
    echo "</div>";
}

function printTextInput($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='text' class='form-control' id='$key' name='$key' value='$value' required>";
    echo "</div>";
}

function printNumberInput($key, $value = '') {
    echo "<div class='form-group'>";
    echo "<label for='$key'>$key</label>";
    echo "<input type='number' class='form-control' id='$key' name='$key' value='$value' required>";
    echo "</div>";
}