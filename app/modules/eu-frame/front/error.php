<?php
use library\EssentialUnifiedDebug\EUDebug;
EUDebug::Error("module",str_replace(APP_ROOT."/modules","",$modfile));