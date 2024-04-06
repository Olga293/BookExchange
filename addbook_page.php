<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();//открыть сессию
?>

<?php
require "header1.php";
require "modules/get_book_component.php";
?>

<div class="center col-sm-10 col-md-8 col-lg-6 d-flex mx-3 mx-md-auto d-flex flex-column py-3 mt-5">
    <h1>Добавление книги</h1>
    <form action="modules/add_book1.php" method="post" enctype="multipart/form-data">
        <div class="txt_field">
            <input type="text" name="title" required>
            <label>Название</label>
            <span></span>
        </div>
        <div class="txt_field">
            <input type="text" name="author" required>
            <label>Автор</label>
            <span></span>
        </div>

        <div class="txt_field">
            <select multiple size="1" name="genre[]" data-placeholder="Выберите жанры">
                <?php
                for($i=0; $i < count($genres_list); $i++){
                    echo "<option value=".$genres_id_list[$i].">";
                    echo $genres_list[$i];
                    echo "</option>";
                }
                ?>
            </select>
            <span></span>
        </div>
        <div class="txt_field">
            <input type="text" name="year" required>
            <label>Год издания</label>
            <span></span>
        </div>
        <div class="txt_field">
            <input type="text" name="annotation" required>
            <label>Аннонация</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input class="chose-file-btn" id="chose_image_btn" type="text" required>
            <input type="file" id="chose_image_btn_true" style="display: none;" name="cover" accept=".png, .jpg, .jpeg" required>
            <label>Обложка книги</label>
            <span></span>
        </div>
        <input type="submit" value="Добавить">
<!--    <div class="signup_link">Not a member? <a href="">Signup</a></div>-->
    </form>
</div>


<script>
    $('#chose_image_btn').on('click', function (){
        $('#chose_image_btn_true').trigger('click');
    });
    $('#chose_image_btn_true').on('change', function (){
        let file = this.files[0].name;
        $(this).next().text('Обложка книги');
        $('#chose_image_btn').val(file);
        console.log(file);
    });


    // multiple
    $(document).ready(function() {

        var select = $('select[multiple]');
        var options = select.find('option');

        var div = $('<div />').addClass('selectMultiple');
        var active = $('<div />');
        var list = $('<ul />');
        var placeholder = select.data('placeholder');

        var span = $('<span />').text(placeholder).appendTo(active);

        options.each(function() {
            var text = $(this).text();
            if($(this).is(':selected')) {
                active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                span.addClass('hide');
            } else {
                list.append($('<li />').html(text));
            }
        });

        active.append($('<div />').addClass('arrow'));
        div.append(active).append(list);

        select.wrap(div);

        $(document).on('click', '.selectMultiple ul li', function(e) {
            var select = $(this).parent().parent();
            var li = $(this);
            if(!select.hasClass('clicked')) {
                select.addClass('clicked');
                li.prev().addClass('beforeRemove');
                li.next().addClass('afterRemove');
                li.addClass('remove');
                var a = $('<a />').addClass('notShown').html('<em>' + li.text() + '</em><i></i>').hide().appendTo(select.children('div'));
                a.slideDown(400, function() {
                    setTimeout(function() {
                        a.addClass('shown');
                        select.children('div').children('span').addClass('hide');
                        select.find('option:contains(' + li.text() + ')').prop('selected', true);
                    }, 500);
                });
                setTimeout(function() {
                    if(li.prev().is(':last-child')) {
                        li.prev().removeClass('beforeRemove');
                    }
                    if(li.next().is(':first-child')) {
                        li.next().removeClass('afterRemove');
                    }
                    setTimeout(function() {
                        li.prev().removeClass('beforeRemove');
                        li.next().removeClass('afterRemove');
                    }, 200);

                    li.slideUp(400, function() {
                        li.remove();
                        select.removeClass('clicked');
                    });
                }, 600);
            }
        });



        $(document).on('click', '.selectMultiple > div a', function(e) {


            //multiselect
            var select = $(this).parent().parent();
            var self = $(this);
            self.removeClass().addClass('remove');
            select.addClass('open');
            setTimeout(function() {
                self.addClass('disappear');
                setTimeout(function() {
                    self.animate({
                        width: 0,
                        height: 0,
                        padding: 0,
                        margin: 0
                    }, 300, function() {
                        var li = $('<li />').text(self.children('em').text()).addClass('notShown').appendTo(select.find('ul'));
                        li.slideDown(400, function() {
                            li.addClass('show');
                            setTimeout(function() {
                                select.find('option:contains(' + self.children('em').text() + ')').prop('selected', false);
                                if(!select.find('option:selected').length) {
                                    select.children('div').children('span').removeClass('hide');
                                }
                                li.removeClass();
                            }, 400);
                        });
                        self.remove();
                    })
                }, 300);
            }, 400);
        });

        $(document).on('click', '.selectMultiple > div .arrow, .selectMultiple > div span', function(e) {
            $(this).parent().parent().toggleClass('open');
        });

    });
</script>



<footer style="background: #D9B582;" class="mt-5">
    <div class="d-flex flex-row justify-content-between container p-3">
        <div class="ml-0 ">
            <span style="color: black">© BookExchange 2023</span>
        </div>
        <div class="mr-0 ">
            <img src="img/VK.svg" class="ml-2">
            <img src="img/inst.svg" class="ml-2">
            <img src="img/tvit.svg" class="ml-2">
        </div>
    </div>

</footer>


<?php
require "footer.php";
?>
