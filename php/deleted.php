<?php
session_start();
include "dbconnect.php";

$delete = "DELETE FROM cgonzalezmvm_portalmvm.vacants WHERE id=". $_SESSION['linia'];
    mysqli_query($conn, $delete);
    header("Location: ../php/empresa.php");





