<?php

if (!isset($_SESSION['principle']) || $_SESSION['principle'] == null || !$_SESSION['principle'] ) {
    header("Location: login.html");
}