<?php
$arch = fopen("json.txt", "a+");
fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] guarda algo esto?  \n");
fclose($arch);
