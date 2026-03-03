<?php
require_once 'session_setup.php';
session_unset();
session_destroy();

header("Location: index.php");
exit;
