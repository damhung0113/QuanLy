
<?php
if (isset($_COOKIE["error"])) {
    echo '<div class="alert alert-danger fixed-top">' . $_COOKIE["error"] . '</div>';
}

if (isset($_COOKIE["success"])) {
    echo '<div class="alert alert-success fixed-top">' . $_COOKIE["success"] . '</div>';
}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<script lang="js">$(".alert").delay(2000).fadeOut();</script>
