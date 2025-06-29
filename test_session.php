<?php
session_start();
if (!isset($_SESSION['test'])) {
    $_SESSION['test'] = rand();
    echo "Session set: " . $_SESSION['test'];
} else {
    echo "Session value: " . $_SESSION['test'];
}
?> 