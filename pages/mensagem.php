<?php
if (isset($_SESSION['msg'])) { ?>
    <script>
        window.onload = () => {
            function alerta() {
                Swal.fire({
                    icon: '<?php echo $_SESSION['msg_control']; ?>',
                    title: '<?php echo $_SESSION['msg']; ?>',
                    showConfirmButton: true,
                    timer: <?php if (!isset($_SESSION['msg_timer'])) {
                                echo "5000";
                            } else {
                                echo $_SESSION['msg_timer'];
                            } ?>
                })
            }
            alerta()
        }
    </script>
<?php
    unset($_SESSION['msg']);
    unset($_SESSION['msg_control']);
} ?>