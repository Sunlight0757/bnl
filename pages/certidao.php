<?php
if (isset($_POST['certidao'])) {
    $_SESSION['msg'] = 'teste';
    $_SESSION['msg_control'] = 'success';
    die("<script>location.href=\"painel.php?p=montar_acaowizard\";</script>");
}
