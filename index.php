<?php
session_start();

if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit();
}

// Check the user's role
$role = $_SESSION["user"]["role"];

// Redirect based on the role
if ($role === "admin") {
    header("Location: admin.php");
    exit();
} elseif ($role === "teacher") {
    header("Location: teachers.php");
    exit();
} elseif ($role === "student") {
    header("Location: students.php");
    exit();
} elseif ($role === "ICTteacher") {
    header("Location: ictteacher.php");
    exit();
} elseif ($role === "STEMteacher") {
    header("Location: stemteacher.php");
    exit();
} elseif ($role === "GASteacher") {
    header("Location: gasteacher.php");
    exit();
} elseif ($role === "ABMteacher") {
    header("Location: abmteacher.php");
    exit();
} elseif ($role === "HUMMSteacher") {
    header("Location: hummsteacher.php");
    exit();
} elseif ($role === "ICT") {
    header("Location: ICT11home.php");
    exit();
} elseif ($role === "STEM") {
    header("Location: stem11home.php");
    exit();
} elseif ($role === "GAS") {
    header("Location: GAS11home.php");
    exit();
} elseif ($role === "ABM") {
    header("Location: ABM11home.php");
    exit();
} elseif ($role === "Humms") {
    header("Location: HUMMS11home.php");
    exit();
} elseif ($role === "ICTteacher12") {
    header("Location: ictteacher12.php");
    exit();
} elseif ($role === "STEMteacher12") {
    header("Location: stemteacher12.php");
    exit();
} elseif ($role === "GASteacher12") {
    header("Location: gasteacher12.php");
    exit();
} elseif ($role === "ABMteacher12") {
    header("Location: abmteacher12.php");
    exit();
} elseif ($role === "HUMMSteacher12") {
    header("Location: hummsteacher12.php");
    exit();
} elseif ($role === "ICT12") {
    header("Location: ict12home.php");
    exit();
} elseif ($role === "STEM12") {
    header("Location: stem12home.php");
    exit();
} elseif ($role === "GAS12") {
    header("Location: GAS12home.php");
    exit();
} elseif ($role === "ABM12") {
    header("Location: ABM12home.php");
    exit();
} elseif ($role === "Humms12") {
    header("Location: HUMMS12home.php");
    exit();
}

// Default redirect if the role is not recognized
header("Location: index.php");
exit();
?>
