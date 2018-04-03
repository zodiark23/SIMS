<?php
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\NewsModel;

$newsModel = new NewsModel();

$news_id = $_POST['news_id'];

$modalview = $newsModel->modalView($news_id);

echo $modalview[0]['news_title'];
echo "<br><br>";
echo htmlspecialchars_decode($modalview[0]['news_content']);

