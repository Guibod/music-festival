<?php

 function javascript() {

  $javascript = "
    <script src=\"js/jquery-1.7.min.js\" type=\"text/javascript\"></script>
    <script type='text/javascript'>

        //SAMPLE
        function openWindow(url, x, y) {
            window.open( url, '',
                'resizable=1,location=0,directories=0,status=0,menubar=0,scrollbars=0,toolbar=0,width=' + x + ',height=' + y);
        }

    </script>";

  return $javascript;
}

?>
