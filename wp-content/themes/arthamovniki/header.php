<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Art_Hamovniki
 */

$is_user_logged_in = is_user_logged_in();
$theme_uri         = get_stylesheet_directory_uri();
$logo              = get_field( 'logo', 'option' );
$phone             = get_field( 'phone', 'option' );
$email             = get_field( 'email', 'option' );
$country           = get_field( 'country', 'option' );
$address           = get_field( 'address', 'option' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- ADAPTIVITY -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#0099EF">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#0099EF">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-touch-fullscreen" content="yes">

    <!-- CONFIG -->
    <meta name="format-detection" content="telephone=no">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;500;600;700&display=swap" rel="stylesheet">
	<?php
	wp_head();

	global $is_partner;
	global $current_user;
	?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <div class="wrapper">
        <div class="overlay"></div>
        <header class="header">
            <div class="header__top">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
                            <a href="/" class="header__logo">
                                <img src="<?php echo $logo; ?>" alt="">
                            </a>
                            <form class="header__search d-none d-md-block">
								<?php echo do_shortcode( '[wpdreams_ajaxsearchlite]' ); ?>
                            </form>
                            <ul class="header__info d-none d-lg-block">
                                <li class="header__info-item">
                                    <a href="tel:<?php echo $phone; ?>" class="header__info-link">
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.00215554 0.763941C0.0526255 0.45271 0.347034 0.189144 0.667798 0.205407C1.4355 0.205968 2.20321 0.207089 2.97147 0.204846C3.32084 0.175686 3.6674 0.475141 3.66684 0.830673C3.67525 1.62249 3.77955 2.41879 4.02685 3.17304C4.12107 3.42707 4.09134 3.73774 3.89227 3.93458C3.40551 4.42918 2.91315 4.91874 2.42135 5.40886C3.04549 6.60556 3.89339 7.68954 4.93531 8.5509C5.5045 9.03709 6.14267 9.433 6.79653 9.79302C7.17225 9.42627 7.54125 9.05279 7.91136 8.68044C8.10146 8.49033 8.27026 8.25312 8.53102 8.15667C8.6886 8.12583 8.85851 8.12358 9.0116 8.17574C9.59762 8.3636 10.2066 8.47856 10.8201 8.52286C11.0865 8.55033 11.3714 8.4808 11.6215 8.60361C11.8542 8.71296 12.0134 8.96924 11.9938 9.22831C11.9944 9.99714 11.9944 10.766 11.9938 11.5354C12.0179 11.8685 11.7274 12.2111 11.3854 12.2004C8.59046 12.2616 5.80452 11.1742 3.73974 9.29953C1.34802 7.16522 -0.0628946 3.97103 0.00215554 0.763941Z"
                                                  fill="#BA884D"/>
                                        </svg>
										<?php echo $phone; ?>
                                    </a>
                                </li>
                                <li class="header__info-item">
                                    <a href="mailto:<?php echo $email; ?>" class="header__info-link">
                                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.0087032 0H12.0003V1.23883L11.9896 1.07717L11.912 1.21079C10.5792 2.13703 9.24385 3.05996 7.90935 3.98538C7.52912 4.23611 7.17281 4.52561 6.77361 4.74665C6.20533 4.96522 5.51664 4.96192 4.99125 4.63118C3.33012 3.47566 1.65828 2.3325 0.00292969 1.1679C0.0103528 0.7786 0.0021049 0.3893 0.0087032 0Z"
                                                  fill="#BA884D"/>
                                            <path d="M0 2.90576C1.31141 3.83117 2.63932 4.73267 3.95156 5.65643C5.04275 6.50019 6.66511 6.56205 7.81157 5.79499C9.16175 4.85144 10.5202 3.92025 11.8695 2.97669C11.9017 2.98247 11.9668 2.99319 11.999 2.99896V8.53659C11.9627 8.54731 11.8901 8.56876 11.8539 8.57948C7.90477 8.57865 3.95486 8.57783 0.00494873 8.57865C0.000824788 6.68742 0.011547 4.79618 0 2.90576Z"
                                                  fill="#BA884D"/>
                                        </svg>
										<?php echo $email; ?>
                                    </a>
                                </li>
                            </ul>
                            <div class="header__adress d-none d-xl-block">
                                <div class="header__adress-title">
                                    <svg width="10" height="13" viewBox="0 0 10 13" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.71219 0.996094C2.11434 0.996094 1.11399e-06 2.97098 0 5.39652C-1.62814e-06 9.66443 4.44692 12.909 4.44692 12.909C4.60314 13.0251 4.8246 13.0251 4.98082 12.909C4.98082 12.909 9.42858 9.66443 9.42857 5.39652C9.42857 2.97098 7.31005 0.996094 4.71219 0.996094ZM4.71219 3.39711C5.89027 3.39711 6.85699 4.29659 6.85699 5.39652C6.857 6.49647 5.89028 7.39828 4.71219 7.39828C3.53411 7.39828 2.57074 6.49647 2.57074 5.39652C2.57075 4.29659 3.53412 3.39711 4.71219 3.39711Z"
                                              fill="#BA884D"/>
                                    </svg>
									<?php echo $country; ?>
                                </div>
                                <div class="header__adress-text">
									<?php echo $address; ?>
                                </div>
                            </div>
                            <a href="#callback-popup" data-fancybox class="header__btn d-none d-md-block">
                                Напишите нам
                            </a>
                            <div class="header__group d-md-none">
                                <div class="header__search-btn">
                                    <svg class="header__search-icon-1" width="15" height="16" viewBox="0 0 15 16"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.51391 11.5278C9.28301 11.5278 11.5278 9.28301 11.5278 6.51391C11.5278 3.7448 9.28301 1.5 6.51391 1.5C3.7448 1.5 1.5 3.7448 1.5 6.51391C1.5 9.28301 3.7448 11.5278 6.51391 11.5278Z"
                                              stroke="white" stroke-width="1.2"/>
                                        <path d="M9.9126 10.1992L14.4999 15.1743" stroke="white" stroke-width="1.2"/>
                                    </svg>
                                    <svg class="header__search-icon-2" width="12" height="12" viewBox="0 0 12 12"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke="white" stroke-width="1.3"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
								<?php if ( $is_user_logged_in ): ?>
                                    <div class="header__acc-btn">
                                        <svg class="header__acc-icon-1" width="14" height="16" viewBox="0 0 14 16"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.99964 7.99928C7.74955 7.99928 8.48263 7.7769 9.10616 7.36027C9.72969 6.94364 10.2157 6.35147 10.5026 5.65864C10.7896 4.96581 10.8647 4.20344 10.7184 3.46794C10.5721 2.73243 10.211 2.05683 9.68073 1.52656C9.15046 0.996291 8.47485 0.635173 7.73935 0.488872C7.00384 0.342572 6.24147 0.417658 5.54864 0.704638C4.85581 0.991617 4.26364 1.4776 3.84701 2.10113C3.43038 2.72466 3.20801 3.45773 3.20801 4.20765C3.20801 5.21325 3.60748 6.17767 4.31855 6.88873C5.02962 7.5998 5.99404 7.99928 6.99964 7.99928ZM6.99964 1.49934C7.53529 1.49934 8.05891 1.65818 8.50429 1.95577C8.94967 2.25336 9.2968 2.67634 9.50179 3.17122C9.70677 3.6661 9.76041 4.21065 9.65591 4.73601C9.55141 5.26137 9.29346 5.74395 8.9147 6.12271C8.53594 6.50147 8.05336 6.75941 7.528 6.86392C7.00264 6.96842 6.45809 6.91478 5.96321 6.7098C5.46834 6.50481 5.04536 6.15768 4.74776 5.7123C4.45017 5.26692 4.29133 4.7433 4.29133 4.20765C4.29133 3.48936 4.57667 2.80049 5.08458 2.29259C5.59248 1.78468 6.28135 1.49934 6.99964 1.49934Z"
                                                  fill="white"/>
                                            <path d="M7.5416 9.08301H6.45828C4.87804 9.08301 3.36253 9.71075 2.24514 10.8281C1.12775 11.9455 0.5 13.4611 0.5 15.0413C0.5 15.1849 0.557068 15.3227 0.658649 15.4243C0.76023 15.5259 0.898004 15.5829 1.04166 15.5829H12.9582C13.1019 15.5829 13.2396 15.5259 13.3412 15.4243C13.4428 15.3227 13.4999 15.1849 13.4999 15.0413C13.4999 13.4611 12.8721 11.9455 11.7547 10.8281C10.6373 9.71075 9.12183 9.08301 7.5416 9.08301ZM1.61582 14.4996C1.74901 13.3083 2.31647 12.2078 3.20976 11.4085C4.10305 10.6091 5.25955 10.1669 6.45828 10.1663H7.5416C8.74033 10.1669 9.89682 10.6091 10.7901 11.4085C11.6834 12.2078 12.2509 13.3083 12.3841 14.4996H1.61582Z"
                                                  fill="white"/>
                                        </svg>
                                        <svg class="header__acc-icon-2" width="12" height="12" viewBox="0 0 12 12"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke="white"
                                                  stroke-width="1.3"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
								<?php endif; ?>
                                <div class="header__menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__bot" id="header-bot">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-flex align-items-center justify-content-between">
							<?php
							wp_nav_menu( [
								'theme_location' => 'menu-1',
								'menu_class'     => 'header__nav',
								'walker'         => new Hamovniki_Nav_Menu()
							] );
							?>
                            <!--<a href="tel:<?php //echo $phone; ?>" class="header__phone">
                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.00215554 0.763941C0.0526255 0.45271 0.347034 0.189144 0.667798 0.205407C1.4355 0.205968 2.20321 0.207089 2.97147 0.204846C3.32084 0.175686 3.6674 0.475141 3.66684 0.830673C3.67525 1.62249 3.77955 2.41879 4.02685 3.17304C4.12107 3.42707 4.09134 3.73774 3.89227 3.93458C3.40551 4.42918 2.91315 4.91874 2.42135 5.40886C3.04549 6.60556 3.89339 7.68954 4.93531 8.5509C5.5045 9.03709 6.14267 9.433 6.79653 9.79302C7.17225 9.42627 7.54125 9.05279 7.91136 8.68044C8.10146 8.49033 8.27026 8.25312 8.53102 8.15667C8.6886 8.12583 8.85851 8.12358 9.0116 8.17574C9.59762 8.3636 10.2066 8.47856 10.8201 8.52286C11.0865 8.55033 11.3714 8.4808 11.6215 8.60361C11.8542 8.71296 12.0134 8.96924 11.9938 9.22831C11.9944 9.99714 11.9944 10.766 11.9938 11.5354C12.0179 11.8685 11.7274 12.2111 11.3854 12.2004C8.59046 12.2616 5.80452 11.1742 3.73974 9.29953C1.34802 7.16522 -0.0628946 3.97103 0.00215554 0.763941Z"
                                          fill="#BA884D"/>
                                </svg>
								<?php //echo $phone; ?>
                            </a>-->

                            <ul class="header__menu">
                                <li class="header__menu-item">
                                    <a href="<?php echo $is_user_logged_in ? '/account/' : '/login/'; ?>"
                                       class="header__menu-link" style="text-transform: lowercase;">
                                    <span class="header__menu-link-icon">
                                        <svg width="12" height="14" viewBox="0 0 12 14" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5.99997 6.99993C6.69219 6.99993 7.36888 6.79466 7.94444 6.41008C8.52001 6.0255 8.96861 5.47888 9.23351 4.83935C9.49842 4.19981 9.56773 3.49609 9.43268 2.81716C9.29764 2.13823 8.9643 1.5146 8.47482 1.02512C7.98534 0.535639 7.3617 0.202299 6.68278 0.0672524C6.00385 -0.0677945 5.30012 0.00151648 4.66059 0.266421C4.02105 0.531325 3.47443 0.979924 3.08985 1.55549C2.70527 2.13106 2.5 2.80774 2.5 3.49997C2.5 4.42822 2.86875 5.31845 3.52512 5.97482C4.18149 6.63119 5.07172 6.99993 5.99997 6.99993ZM5.99997 0.999992C6.49442 0.999992 6.97776 1.14661 7.38888 1.42131C7.8 1.69601 8.12043 2.08646 8.30964 2.54327C8.49886 3.00008 8.54837 3.50274 8.45191 3.98769C8.35544 4.47264 8.11734 4.91809 7.76772 5.26772C7.41809 5.61735 6.97264 5.85545 6.48769 5.95191C6.00274 6.04837 5.50008 5.99886 5.04327 5.80964C4.58646 5.62043 4.19601 5.3 3.92131 4.88888C3.64661 4.47776 3.49999 3.99442 3.49999 3.49997C3.49999 2.83693 3.76338 2.20105 4.23222 1.73222C4.70105 1.26338 5.33693 0.999992 5.99997 0.999992Z"/>
                                            <path d="M6.49994 8H5.49995C4.04127 8 2.64234 8.57946 1.6109 9.6109C0.579457 10.6423 0 12.0413 0 13.4999C0 13.6326 0.052678 13.7597 0.146445 13.8535C0.240213 13.9473 0.367388 13.9999 0.499995 13.9999H11.4999C11.6325 13.9999 11.7597 13.9473 11.8534 13.8535C11.9472 13.7597 11.9999 13.6326 11.9999 13.4999C11.9999 12.0413 11.4204 10.6423 10.389 9.6109C9.35755 8.57946 7.95861 8 6.49994 8ZM1.02999 13C1.15294 11.9003 1.67674 10.8845 2.50132 10.1466C3.32589 9.40871 4.39343 9.00052 5.49995 8.99999H6.49994C7.60646 9.00052 8.67399 9.40871 9.49857 10.1466C10.3231 10.8845 10.8469 11.9003 10.9699 13H1.02999Z"/>
                                        </svg>
                                    </span>

                                        <span class="header__menu-link-text">
                                            <?php if ( $is_partner ): ?>
                                                <div>Партнёрская версия</div>
                                            <?php endif; ?>
                                        <p>
                                            <?php echo $is_user_logged_in ? $current_user->user_email : 'Вход и регистрация'; ?>
                                            <svg width="9" height="5" viewBox="0 0 9 5" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.999704 1L4.08721 3.93452C4.12581 3.97121 4.18639 3.97121 4.22499 3.93452L7.3125 1"
                                                      stroke="white" stroke-width="1.7" stroke-linecap="round"></path>
                                            </svg>
                                        </p>
                                        </span>
                                    </a>
									<?php if ( $is_user_logged_in ) {
										header_profile_navigation();
									} ?>
                                </li>
                                <li class="header__menu-item">
                                    <a href="/favorites/" class="header__menu-link">
                                    <span class="header__menu-link-icon">
                                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.88043 0.355992C2.29524 0.163219 2.74805 0.0658749 3.19813 0.0095468C3.51723 0.00489836 3.8377 -0.0120547 4.15571 0.0169296C4.6561 0.113453 5.14117 0.296109 5.5784 0.558062C5.66672 0.600445 5.74711 0.658414 5.81739 0.727047C6.07743 0.913804 6.34731 1.08853 6.58657 1.30236C6.71508 1.38466 6.80231 1.51482 6.91742 1.61353C7.00684 1.53314 7.08532 1.44209 7.17145 1.35814C7.30871 1.25916 7.43067 1.13966 7.57231 1.04587C7.74512 0.907789 7.942 0.801148 8.10442 0.650211C8.59907 0.335758 9.15223 0.103883 9.73246 0.0100937C10.1426 -0.00193756 10.5582 -0.0180704 10.961 0.0604062C11.3709 0.12357 11.7707 0.253727 12.1382 0.446226C12.4636 0.592516 12.7206 0.847086 12.9686 1.09646C13.2322 1.35513 13.4017 1.68818 13.5524 2.02095C13.6954 2.40103 13.8034 2.80107 13.8165 3.20767C13.8472 3.51802 13.8351 3.83002 13.8094 4.14009C13.772 4.46658 13.656 4.7783 13.5499 5.0881C13.4378 5.32791 13.3161 5.56306 13.1953 5.79849C13.0088 6.0156 12.8704 6.27017 12.6883 6.49029C12.5973 6.60841 12.4846 6.70849 12.393 6.82662C12.2464 6.97236 12.122 7.13861 11.967 7.27615C11.8092 7.40056 11.6799 7.55642 11.5254 7.68466C11.4026 7.81564 11.2812 7.94962 11.1404 8.06201C11.0335 8.16482 10.9304 8.27173 10.8169 8.36771C10.6829 8.50662 10.5539 8.65181 10.4029 8.77294C10.2148 8.95943 10.019 9.13826 9.8361 9.33021C9.56266 9.57494 9.30371 9.83552 9.04368 10.0947C8.69149 10.4065 8.37348 10.7543 8.02485 11.0698C7.93707 11.1374 7.88649 11.2418 7.79051 11.299C7.64887 11.4409 7.50367 11.5798 7.35547 11.7151C7.28465 11.7909 7.19907 11.8505 7.1091 11.9016C6.94149 11.918 6.74625 11.9486 6.60899 11.8286C6.37821 11.6405 6.17887 11.4141 5.95219 11.2227C5.89313 11.1316 5.80317 11.0682 5.72906 10.9905C5.48817 10.7838 5.28117 10.5415 5.04465 10.3302C4.86446 10.1464 4.66239 9.98537 4.49395 9.78986C4.24621 9.54595 3.97469 9.32611 3.74473 9.06416C3.6061 8.93865 3.46965 8.8104 3.33703 8.67834C3.16039 8.54544 3.03543 8.35841 2.86481 8.21896C2.76582 8.13556 2.67778 8.04095 2.58563 7.95072C2.40379 7.81564 2.27746 7.62287 2.10246 7.48013C1.96492 7.37103 1.85801 7.22857 1.71473 7.12685C1.60371 6.99095 1.46891 6.87666 1.36172 6.73748C1.34477 6.71834 1.32563 6.70138 1.30457 6.68689C1.22336 6.56877 1.11918 6.46787 1.03715 6.35029C0.870627 6.07548 0.641213 5.84005 0.50969 5.54447C0.306799 5.1622 0.161604 4.7515 0.0612521 4.33095C-0.0109354 3.95552 -0.0117557 3.56752 0.0199631 3.18662C0.0287131 2.79752 0.145744 2.42017 0.264963 2.05185C0.319104 1.95013 0.346721 1.83638 0.415901 1.74232C0.600197 1.34939 0.900432 1.02537 1.23457 0.754117C1.41477 0.571461 1.65348 0.467281 1.88043 0.355992ZM3.33485 1.16482C2.99278 1.19517 2.64797 1.26271 2.34117 1.42349C2.1618 1.49404 2.01387 1.62091 1.8561 1.73056C1.75903 1.82271 1.64555 1.90966 1.59332 2.03627C1.57199 2.05322 1.55231 2.07181 1.53399 2.0915C1.42871 2.27169 1.34313 2.46228 1.28516 2.66216C1.11289 3.26209 1.08555 3.92025 1.30403 4.51279C1.40656 4.78404 1.5184 5.05693 1.70133 5.2858C1.84953 5.50673 1.995 5.73205 2.18121 5.92345C2.27637 6.01916 2.34555 6.14466 2.4675 6.21084C2.5025 6.28193 2.5643 6.33224 2.61953 6.38693C2.75871 6.52173 2.89051 6.66474 3.04199 6.78615C3.25145 6.99587 3.4609 7.20533 3.67528 7.40986C3.79258 7.50064 3.89485 7.60865 3.99192 7.72021C4.14039 7.85392 4.27875 7.9983 4.42586 8.1331C4.52621 8.20501 4.60824 8.29744 4.68699 8.3915C4.88633 8.58482 5.08239 8.78279 5.29731 8.95861C5.41106 9.10873 5.55953 9.2263 5.68832 9.36275C5.80016 9.46037 5.9027 9.5681 6.02246 9.65642C6.12309 9.7997 6.26446 9.9058 6.38367 10.0327C6.44465 10.0994 6.51848 10.1519 6.58274 10.2153C6.63879 10.2695 6.68965 10.3315 6.76047 10.3671C6.79547 10.4401 6.8611 10.4893 6.91742 10.5451C6.97375 10.489 7.03938 10.4398 7.07438 10.3668C7.1627 10.3222 7.22067 10.2391 7.29422 10.176C7.42903 10.0652 7.54442 9.93314 7.67375 9.81666C7.72297 9.77455 7.76071 9.72259 7.79926 9.67146C8.06313 9.44533 8.32289 9.20798 8.55149 8.94521C8.73305 8.80083 8.89629 8.63459 9.06364 8.4738C9.18094 8.37099 9.26461 8.23427 9.3945 8.14486C9.54817 8.00896 9.68817 7.85802 9.84157 7.7213C9.93946 7.61001 10.0412 7.50091 10.1593 7.41068C10.3685 7.21025 10.5741 7.00572 10.7781 6.80009C10.972 6.6374 11.1483 6.45474 11.3255 6.27455C11.3663 6.18923 11.4565 6.15369 11.5158 6.08505C11.6744 5.88681 11.8664 5.71236 11.9891 5.48705C12.1155 5.33775 12.2188 5.17013 12.3186 5.00224C12.4748 4.6867 12.6115 4.35502 12.6577 4.00365C12.7006 3.80568 12.6782 3.60197 12.6815 3.40099C12.6427 2.9397 12.5357 2.47294 12.2905 2.07455C12.1335 1.84459 11.917 1.65728 11.675 1.5222C11.5869 1.43306 11.46 1.40791 11.3501 1.35705C11.0901 1.24384 10.8071 1.19873 10.5276 1.16619C10.4281 1.16209 10.328 1.16509 10.2298 1.14677C10.127 1.12681 10.0261 1.16236 9.9236 1.16263C9.62938 1.18287 9.35813 1.3081 9.08907 1.41912C8.95535 1.48009 8.84653 1.584 8.71172 1.64334C8.47438 1.80138 8.24414 1.97283 8.02868 2.16068C7.96907 2.22877 7.90453 2.29166 7.82934 2.34224C7.68387 2.49619 7.50969 2.62771 7.39102 2.80408C7.34371 2.83252 7.30434 2.87107 7.27754 2.91947C7.18047 2.96568 7.08723 3.03814 6.97293 3.02146C6.82664 3.03349 6.67461 3.01517 6.55813 2.9181C6.52969 2.8708 6.49086 2.83224 6.44356 2.8038C6.32543 2.62744 6.15071 2.49619 6.00551 2.34224C5.93059 2.29138 5.86524 2.22986 5.80754 2.16041C5.56227 1.95423 5.30824 1.75572 5.03071 1.59466C4.62137 1.31685 4.13164 1.14048 3.63426 1.14349C3.535 1.15908 3.4352 1.16509 3.33485 1.16482Z"/>
                                        </svg>
                                    </span>
                                        <span class="header__menu-link-text">Избранное</span>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="header__search-row d-md-none">
                <form class="header__search">
                    <div class="header__search-icon">
                        <img src="<?php echo $theme_uri; ?>/img/search-icon.svg" alt="">
                    </div>
                    <input type="search" placeholder="Поиск по художникам..." class="header__search-input">
                </form>
            </div>
        </header>

		<?php if ( $is_user_logged_in ) {
			mobile_profile_navigation();
		} ?>

        <div class="mobile-menu" id="menu">
            <div class="mobile-menu__group">
				<?php
				wp_nav_menu( [
					'theme_location' => 'menu-1',
					'menu_class'     => 'mobile-menu__nav',
					'walker'         => new Hamovniki_Mobile_Menu()
				] );
				?>
            </div>
            <div class="mobile-menu__group">
                <ul class="mobile-menu__list">
	                <?php if ( !$is_user_logged_in ): ?>
                        <li class="mobile-menu__list-item">
                            <a href="/login/" class="mobile-menu__list-link">
                                <div class="header__acc-btn">
                                    <svg class="header__acc-icon-1" width="14" height="16" viewBox="0 0 14 16"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.99964 7.99928C7.74955 7.99928 8.48263 7.7769 9.10616 7.36027C9.72969 6.94364 10.2157 6.35147 10.5026 5.65864C10.7896 4.96581 10.8647 4.20344 10.7184 3.46794C10.5721 2.73243 10.211 2.05683 9.68073 1.52656C9.15046 0.996291 8.47485 0.635173 7.73935 0.488872C7.00384 0.342572 6.24147 0.417658 5.54864 0.704638C4.85581 0.991617 4.26364 1.4776 3.84701 2.10113C3.43038 2.72466 3.20801 3.45773 3.20801 4.20765C3.20801 5.21325 3.60748 6.17767 4.31855 6.88873C5.02962 7.5998 5.99404 7.99928 6.99964 7.99928ZM6.99964 1.49934C7.53529 1.49934 8.05891 1.65818 8.50429 1.95577C8.94967 2.25336 9.2968 2.67634 9.50179 3.17122C9.70677 3.6661 9.76041 4.21065 9.65591 4.73601C9.55141 5.26137 9.29346 5.74395 8.9147 6.12271C8.53594 6.50147 8.05336 6.75941 7.528 6.86392C7.00264 6.96842 6.45809 6.91478 5.96321 6.7098C5.46834 6.50481 5.04536 6.15768 4.74776 5.7123C4.45017 5.26692 4.29133 4.7433 4.29133 4.20765C4.29133 3.48936 4.57667 2.80049 5.08458 2.29259C5.59248 1.78468 6.28135 1.49934 6.99964 1.49934Z"
                                              fill="white"/>
                                        <path d="M7.5416 9.08301H6.45828C4.87804 9.08301 3.36253 9.71075 2.24514 10.8281C1.12775 11.9455 0.5 13.4611 0.5 15.0413C0.5 15.1849 0.557068 15.3227 0.658649 15.4243C0.76023 15.5259 0.898004 15.5829 1.04166 15.5829H12.9582C13.1019 15.5829 13.2396 15.5259 13.3412 15.4243C13.4428 15.3227 13.4999 15.1849 13.4999 15.0413C13.4999 13.4611 12.8721 11.9455 11.7547 10.8281C10.6373 9.71075 9.12183 9.08301 7.5416 9.08301ZM1.61582 14.4996C1.74901 13.3083 2.31647 12.2078 3.20976 11.4085C4.10305 10.6091 5.25955 10.1669 6.45828 10.1663H7.5416C8.74033 10.1669 9.89682 10.6091 10.7901 11.4085C11.6834 12.2078 12.2509 13.3083 12.3841 14.4996H1.61582Z"
                                              fill="white"/>
                                    </svg>
                                    <svg class="header__acc-icon-2" width="12" height="12" viewBox="0 0 12 12"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke="white"
                                              stroke-width="1.3"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>Вход/Регистрация
                            </a>
                        </li>
	                <?php endif; ?>
                    <li class="mobile-menu__list-item">
                        <a href="/favorites/" class="mobile-menu__list-link">
                        <span class="mobile-menu__list-link-icon">
                            <svg width="14" height="12" viewBox="0 0 14 12" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.88043 0.355992C2.29524 0.163219 2.74805 0.0658749 3.19813 0.0095468C3.51723 0.00489836 3.8377 -0.0120547 4.15571 0.0169296C4.6561 0.113453 5.14117 0.296109 5.5784 0.558062C5.66672 0.600445 5.74711 0.658414 5.81739 0.727047C6.07743 0.913804 6.34731 1.08853 6.58657 1.30236C6.71508 1.38466 6.80231 1.51482 6.91742 1.61353C7.00684 1.53314 7.08532 1.44209 7.17145 1.35814C7.30871 1.25916 7.43067 1.13966 7.57231 1.04587C7.74512 0.907789 7.942 0.801148 8.10442 0.650211C8.59907 0.335758 9.15223 0.103883 9.73246 0.0100937C10.1426 -0.00193756 10.5582 -0.0180704 10.961 0.0604062C11.3709 0.12357 11.7707 0.253727 12.1382 0.446226C12.4636 0.592516 12.7206 0.847086 12.9686 1.09646C13.2322 1.35513 13.4017 1.68818 13.5524 2.02095C13.6954 2.40103 13.8034 2.80107 13.8165 3.20767C13.8472 3.51802 13.8351 3.83002 13.8094 4.14009C13.772 4.46658 13.656 4.7783 13.5499 5.0881C13.4378 5.32791 13.3161 5.56306 13.1953 5.79849C13.0088 6.0156 12.8704 6.27017 12.6883 6.49029C12.5973 6.60841 12.4846 6.70849 12.393 6.82662C12.2464 6.97236 12.122 7.13861 11.967 7.27615C11.8092 7.40056 11.6799 7.55642 11.5254 7.68466C11.4026 7.81564 11.2812 7.94962 11.1404 8.06201C11.0335 8.16482 10.9304 8.27173 10.8169 8.36771C10.6829 8.50662 10.5539 8.65181 10.4029 8.77294C10.2148 8.95943 10.019 9.13826 9.8361 9.33021C9.56266 9.57494 9.30371 9.83552 9.04368 10.0947C8.69149 10.4065 8.37348 10.7543 8.02485 11.0698C7.93707 11.1374 7.88649 11.2418 7.79051 11.299C7.64887 11.4409 7.50367 11.5798 7.35547 11.7151C7.28465 11.7909 7.19907 11.8505 7.1091 11.9016C6.94149 11.918 6.74625 11.9486 6.60899 11.8286C6.37821 11.6405 6.17887 11.4141 5.95219 11.2227C5.89313 11.1316 5.80317 11.0682 5.72906 10.9905C5.48817 10.7838 5.28117 10.5415 5.04465 10.3302C4.86446 10.1464 4.66239 9.98537 4.49395 9.78986C4.24621 9.54595 3.97469 9.32611 3.74473 9.06416C3.6061 8.93865 3.46965 8.8104 3.33703 8.67834C3.16039 8.54544 3.03543 8.35841 2.86481 8.21896C2.76582 8.13556 2.67778 8.04095 2.58563 7.95072C2.40379 7.81564 2.27746 7.62287 2.10246 7.48013C1.96492 7.37103 1.85801 7.22857 1.71473 7.12685C1.60371 6.99095 1.46891 6.87666 1.36172 6.73748C1.34477 6.71834 1.32563 6.70138 1.30457 6.68689C1.22336 6.56877 1.11918 6.46787 1.03715 6.35029C0.870627 6.07548 0.641213 5.84005 0.50969 5.54447C0.306799 5.1622 0.161604 4.7515 0.0612521 4.33095C-0.0109354 3.95552 -0.0117557 3.56752 0.0199631 3.18662C0.0287131 2.79752 0.145744 2.42017 0.264963 2.05185C0.319104 1.95013 0.346721 1.83638 0.415901 1.74232C0.600197 1.34939 0.900432 1.02537 1.23457 0.754117C1.41477 0.571461 1.65348 0.467281 1.88043 0.355992ZM3.33485 1.16482C2.99278 1.19517 2.64797 1.26271 2.34117 1.42349C2.1618 1.49404 2.01387 1.62091 1.8561 1.73056C1.75903 1.82271 1.64555 1.90966 1.59332 2.03627C1.57199 2.05322 1.55231 2.07181 1.53399 2.0915C1.42871 2.27169 1.34313 2.46228 1.28516 2.66216C1.11289 3.26209 1.08555 3.92025 1.30403 4.51279C1.40656 4.78404 1.5184 5.05693 1.70133 5.2858C1.84953 5.50673 1.995 5.73205 2.18121 5.92345C2.27637 6.01916 2.34555 6.14466 2.4675 6.21084C2.5025 6.28193 2.5643 6.33224 2.61953 6.38693C2.75871 6.52173 2.89051 6.66474 3.04199 6.78615C3.25145 6.99587 3.4609 7.20533 3.67528 7.40986C3.79258 7.50064 3.89485 7.60865 3.99192 7.72021C4.14039 7.85392 4.27875 7.9983 4.42586 8.1331C4.52621 8.20501 4.60824 8.29744 4.68699 8.3915C4.88633 8.58482 5.08239 8.78279 5.29731 8.95861C5.41106 9.10873 5.55953 9.2263 5.68832 9.36275C5.80016 9.46037 5.9027 9.5681 6.02246 9.65642C6.12309 9.7997 6.26446 9.9058 6.38367 10.0327C6.44465 10.0994 6.51848 10.1519 6.58274 10.2153C6.63879 10.2695 6.68965 10.3315 6.76047 10.3671C6.79547 10.4401 6.8611 10.4893 6.91742 10.5451C6.97375 10.489 7.03938 10.4398 7.07438 10.3668C7.1627 10.3222 7.22067 10.2391 7.29422 10.176C7.42903 10.0652 7.54442 9.93314 7.67375 9.81666C7.72297 9.77455 7.76071 9.72259 7.79926 9.67146C8.06313 9.44533 8.32289 9.20798 8.55149 8.94521C8.73305 8.80083 8.89629 8.63459 9.06364 8.4738C9.18094 8.37099 9.26461 8.23427 9.3945 8.14486C9.54817 8.00896 9.68817 7.85802 9.84157 7.7213C9.93946 7.61001 10.0412 7.50091 10.1593 7.41068C10.3685 7.21025 10.5741 7.00572 10.7781 6.80009C10.972 6.6374 11.1483 6.45474 11.3255 6.27455C11.3663 6.18923 11.4565 6.15369 11.5158 6.08505C11.6744 5.88681 11.8664 5.71236 11.9891 5.48705C12.1155 5.33775 12.2188 5.17013 12.3186 5.00224C12.4748 4.6867 12.6115 4.35502 12.6577 4.00365C12.7006 3.80568 12.6782 3.60197 12.6815 3.40099C12.6427 2.9397 12.5357 2.47294 12.2905 2.07455C12.1335 1.84459 11.917 1.65728 11.675 1.5222C11.5869 1.43306 11.46 1.40791 11.3501 1.35705C11.0901 1.24384 10.8071 1.19873 10.5276 1.16619C10.4281 1.16209 10.328 1.16509 10.2298 1.14677C10.127 1.12681 10.0261 1.16236 9.9236 1.16263C9.62938 1.18287 9.35813 1.3081 9.08907 1.41912C8.95535 1.48009 8.84653 1.584 8.71172 1.64334C8.47438 1.80138 8.24414 1.97283 8.02868 2.16068C7.96907 2.22877 7.90453 2.29166 7.82934 2.34224C7.68387 2.49619 7.50969 2.62771 7.39102 2.80408C7.34371 2.83252 7.30434 2.87107 7.27754 2.91947C7.18047 2.96568 7.08723 3.03814 6.97293 3.02146C6.82664 3.03349 6.67461 3.01517 6.55813 2.9181C6.52969 2.8708 6.49086 2.83224 6.44356 2.8038C6.32543 2.62744 6.15071 2.49619 6.00551 2.34224C5.93059 2.29138 5.86524 2.22986 5.80754 2.16041C5.56227 1.95423 5.30824 1.75572 5.03071 1.59466C4.62137 1.31685 4.13164 1.14048 3.63426 1.14349C3.535 1.15908 3.4352 1.16509 3.33485 1.16482Z"
                                      fill="white"/>
                            </svg>
                        </span>
                            Избранное
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <main class="main">