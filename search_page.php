<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>
<?php
require "header1.php";
require_once 'modules/functions.php';
?>

<div class="container">
    <div class="mt-5 mb-3 search-block">
            <div class="input-group px-3">
                <div class="d-flex search-icon">
                    <i class="fa fa-search align-self-center"></i>
                </div>
                <input id="search-field" type="text" class="form-control input-text p-4" placeholder="Найти...">
            </div>
    </div>

    <div id="search-results">
    </div>
    
</div>





<script>
    $(document).ready(function(){
        console.log('before_here');
        $('#search-field').keyup(function () {
            let link = $(this);
            let search = link.val();
            console.log(search);
            console.log('here');
            $.ajax({
                    url: "modules/search.php",
                    type: "POST",
                    data: {'search': search},
                    dataType:"html",
                    success: function(response) {
                        $('#search-results').html(response);
                    }
                }
            );
        });

    });
</script>



<?php
require "footer.php";
?>
