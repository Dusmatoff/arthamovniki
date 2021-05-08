<?php
/*
	Template Name: Избранное
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
	<section class="section-first product">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ul class="breadcrumbs">
						<li class="breadcrumbs__item">
							<a href="" class="breadcrumbs__link">Главная</a>
						</li>
						<li class="breadcrumbs__item">
							<span class="breadcrumbs__link">Избранное</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="lk">
						<div class="lk__header">
							<div class="lk__title">
								Избранное – 1
							</div>
							<a href="#action-popup" data-fancybox class="btn btn--dynamic btn--full">
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
								Очистить избранное
							</a>
						</div>
					</div>

					<div class="catalog-cards catalog-cards--middle">

						<div class="catalog-card">
							<div class="catalog-card__img">
								<img src="/wp-content/uploads/2021/05/yabloki-doma-1-13.jpg" alt="">
							</div>
							<div class="catalog-card__content">
								<div class="catalog-card__title">
									Иллюстрация для журнала «Крокодил»
								</div>
								<ul class="catalog-card__info">
									<li class="catalog-card__info-item">
										<div class="catalog-card__info-item-title">
											Автор
										</div>
										<a href="" class="catalog-card__info-item-value">
											Елисеев К.С.
										</a>
									</li>
									<li class="catalog-card__info-item">
										<div class="catalog-card__info-item-title">
											Год
										</div>
										<div class="catalog-card__info-item-value">
											1947
										</div>
									</li>
									<li class="catalog-card__info-item">
										<div class="catalog-card__info-item-title">
											Размер
										</div>
										<div class="catalog-card__info-item-value">
											37,5×28,4
										</div>
									</li>
									<li class="catalog-card__info-item">
										<div class="catalog-card__info-item-title">
											Техника
										</div>
										<div class="catalog-card__info-item-value">
											Бумага, графитный карандаш, акварель, белила
										</div>
									</li>
									<li class="catalog-card__info-item">
										<div class="catalog-card__info-item-title">
											Владелец
										</div>
										<a href="#author-popup" data-fancybox class="catalog-card__info-item-value">
											Константинов В.
										</a>
									</li>
								</ul>
								<div class="catalog-card__footer">
									<a href="#action-popup" data-fancybox class="btn btn--dynamic btn--border">
										<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M11 1L1.11069 11M1 1L10.8893 11L1 1Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										Удалить из избранное
									</a>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</section>
<?php
get_footer();
