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

    <div class="author-popup" id="author-popup">
        <div class="author-popup__title">
            Константинов К.
        </div>
        <div class="author-popup__text">
            Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum
            используют потому, что тот обеспечивает.
        </div>
        <div class="data">
            <a href="" class="data__item">
                <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.00215554 0.763941C0.0526255 0.45271 0.347034 0.189144 0.667798 0.205407C1.4355 0.205968 2.20321 0.207089 2.97147 0.204846C3.32084 0.175686 3.6674 0.475141 3.66684 0.830673C3.67525 1.62249 3.77955 2.41879 4.02685 3.17304C4.12107 3.42707 4.09134 3.73774 3.89227 3.93458C3.40551 4.42918 2.91315 4.91874 2.42135 5.40886C3.04549 6.60556 3.89339 7.68954 4.93531 8.5509C5.5045 9.03709 6.14267 9.433 6.79653 9.79302C7.17225 9.42627 7.54125 9.05279 7.91136 8.68044C8.10146 8.49033 8.27026 8.25312 8.53102 8.15667C8.6886 8.12583 8.85851 8.12358 9.0116 8.17574C9.59762 8.3636 10.2066 8.47856 10.8201 8.52286C11.0865 8.55033 11.3714 8.4808 11.6215 8.60361C11.8542 8.71296 12.0134 8.96924 11.9938 9.22831C11.9944 9.99714 11.9944 10.766 11.9938 11.5354C12.0179 11.8685 11.7274 12.2111 11.3854 12.2004C8.59046 12.2616 5.80452 11.1742 3.73974 9.29953C1.34802 7.16522 -0.0628946 3.97103 0.00215554 0.763941Z"
                          fill="#BA884D"/>
                </svg>
                +7 (499) 241-40-33
            </a>
            <a href="" class="data__item">
                <svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.00967976 0H12.0013V1.23883L11.9905 1.07717L11.913 1.21079C10.5802 2.13703 9.24483 3.05996 7.91032 3.98538C7.5301 4.23611 7.17379 4.52561 6.77459 4.74665C6.20631 4.96522 5.51761 4.96192 4.99222 4.63118C3.3311 3.47566 1.65926 2.3325 0.00390625 1.1679C0.0113293 0.7786 0.00308146 0.3893 0.00967976 0Z"
                          fill="#BA884D"/>
                    <path d="M0 2.90576C1.31141 3.83117 2.63932 4.73267 3.95156 5.65643C5.04275 6.50019 6.66511 6.56205 7.81157 5.79499C9.16175 4.85144 10.5202 3.92025 11.8695 2.97669C11.9017 2.98247 11.9668 2.99319 11.999 2.99896V8.53659C11.9627 8.54731 11.8901 8.56876 11.8539 8.57948C7.90477 8.57865 3.95486 8.57783 0.00494873 8.57865C0.000824788 6.68742 0.011547 4.79618 0 2.90576Z"
                          fill="#BA884D"/>
                </svg>
                aesss1234@gmail.com
            </a>
        </div>
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
