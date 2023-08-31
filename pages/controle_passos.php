<?php
if (isset($_SESSION['controle_click2'])) { ?>
    <script>
        $(document).ready(function() {

            $("#2").trigger("click");

        });
    </script>
<?php
    unset($_SESSION['controle_click2']);
}
if (isset($_SESSION['controle_click3'])) { ?>
    <script>
        $(document).ready(function() {

            $("#3").trigger("click");

        });
    </script>
<?php
    unset($_SESSION['controle_click3']);
}
if (isset($_SESSION['controle_click4'])) { ?>
    <script>
        $(document).ready(function() {

            $("#4").trigger("click");

        });
    </script>
<?php
    unset($_SESSION['controle_click4']);
}
if (isset($_SESSION['controle_click5'])) { ?>
    <script>
        $(document).ready(function() {

            $("#5").trigger("click");

        });
    </script>
<?php
    unset($_SESSION['controle_click5']);
}
?>