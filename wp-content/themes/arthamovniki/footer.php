<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Art_Hamovniki
 */

$text_cookie = get_field( 'text_cookie', 'option' );
$copyright   = get_field( 'copyright', 'option' );
?>
</main>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center flex-wrap justify-content-between">
				<?php
				wp_nav_menu( [
					'theme_location' => 'menu-footer',
					'menu_class'     => 'footer__nav',
				] );
				?>
                <div class="footer__copyright">
					<?php echo $copyright; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</div><!-- #page -->

<!--<div class="attention-line">
    <div class="container">
        <div class="row">
            <div class="col-12 d-md-flex align-items-center">
                <p><?php //echo $text_cookie; ?></p>
                <div class="btn btn btn--border btn--lg attention-line__btn">Согласен</div>
            </div>
        </div>
    </div>
</div>-->

<div class="d-none">
    <form class="callback-popup" id="callback-popup">
        <div class="callback-popup__title">
            Написать нам
        </div>
        <div class="form__body">
            <div class="form__field">
                <input type="email" name="Email" placeholder="Email" class="form__field-input">
            </div>
            <div class="form__field">
                <textarea name="Message" class="form__field-textarea" placeholder="Сообщение"></textarea>
            </div>
        </div>
        <div class="form__footer">
            <label for="form-checkbox" class="form__checkbox">
                <input type="checkbox" checked id="form-checkbox" class="form__checkbox-input">
                <div class="form__checkbox-marker"></div>
                <div class="form__checkbox-text">
                    Я соглашаюсь на обработку персональных данных
                </div>
            </label>
            <button class="btn btn--full btn--lg">
                Отправить
            </button>
        </div>
    </form>

    <div class="thanks-popup" id="thanks-popup">
        <div class="thanks-popup__title">
            Спасибо! <br>
            Ваше сообщение отправлено успешно
        </div>
        <div class="thanks-popup__text">
            Мы свяжемся с Вами в ближайшее время
        </div>
        <button class="btn btn--full btn--lg close-modal" data-fancybox-close>Всё понятно</button>
    </div>

    <!--
    <div class="action-popup" id="action-popup">
        <div class="action-popup__title">
            Вы уверены, что хотите
            удалить картину?
        </div>
        <div class="action-popup__footer">
            <a href="" class="btn btn--border">Нет</a>
            <a href="" class="btn btn--full">Да, удалить</a>
        </div>
    </div>
    -->

</div>

<?php wp_footer(); ?>

</body>
</html>
