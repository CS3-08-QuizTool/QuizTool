<?php

function h($s){//エスケープする関数 h()
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

?>