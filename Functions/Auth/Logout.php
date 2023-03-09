<?php
    // Session leeghalen.
    session_destroy();

    // Redirect naar home.
    header("Location: index.php?page=Auth/Login");
?>
