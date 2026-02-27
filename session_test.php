<?php
session_start();
$_SESSION['test'] = 'ok';
echo 'Session ID: ' . session_id();
