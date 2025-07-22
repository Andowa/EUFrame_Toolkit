<?php
use library\EssentialUnifiedInc\EUInc;
$setup=EUInc::InstallDev() ? 1 : 0;
$app->Runin(array("setup","title"),array($setup,"Hello!EU"));
$app->Open("index.cms");