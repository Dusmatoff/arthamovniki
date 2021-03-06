
// Set fixed elements that need padding-right when locking the scroll
window.paddingRightItems = '#page-header';

// Locking scroll plugin options
var bodyScrollOptions = {
    reserveScrollBarGap: true,
    allowTouchMove: true
};



// Form Validation
$.extend($.validator.messages, {
    required: "Это поле обязательное",
    email: "Введите правильный формат E-mail",
    url: "Введите правильный формат URL",
    date: "Введите правильный формат даты",
    number: "Введите цифры",
    digits: "Введите цифры",
    creditcard: "Введите правильную кредитную карточку",
    equalTo: "Поля должны соответствовать",
    maxlength: jQuery.validator.format("Максимальная длина - {0} знаков"),
    minlength: jQuery.validator.format("Минимальная длина - {0} знаков"),
    rangelength: jQuery.validator.format("Длина должна быть между {0} и {1} знаками"),
    range: jQuery.validator.format("Введите цифру между {0} и {1}"),
    max: jQuery.validator.format("Максимальное допустимое значение - {0}."),
    min: jQuery.validator.format("Минимально допустимое значение - {0}.")
});

$.validator.methods.email = function(value, element) {
	return this.optional( element ) || /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test( value );
};

$.validator.addMethod('lettersonly', function(value, element) {
	return this.optional(element) || /^[a-zа-яё\-\s]+$/i.test(value);
}, 'Вводить можно только буквы');

$.validator.methods.number = function (value, element) {
	return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value);
};

$.validator.methods.range = function (value, element, param) {
    var globalizedValue = value.replace(",", ".");
    return this.optional(element) || (globalizedValue >= param[0] && globalizedValue <= param[1]);
};

$.validator.methods.min = function(value, element, param) {
    value = value.replace(",", ".");
    return this.optional(element) || value >= param;
};

$.validator.methods.max = function(value, element, param) {
    value = value.replace(",", ".");
    return this.optional(element) || value <= param;
};

$(document).ready(function() {
	
    $(".form-validate").each(function() {
        $(this).validate({
			validateDelegate: function() { },
            onsubmit: true,
			errorElement: "div",
			errorPlacement: function (error, element) {
				error.addClass('invalid-feedback');

				var elementType = element.prop('type');
				
				switch(elementType) {
					case 'select-one':
						error.appendTo(element.parent());
						break;
						
					case 'checkbox':
						error.insertAfter(element.parent());
						break;
						
					case 'radio':
						error.insertAfter(element.parent());
						
						break;
						
					default:
						error.insertAfter(element);
						
						break;
					
				}

			},
			highlight: function (element, errorClass, validClass ) {
				$(element).addClass("is-invalid").parent().addClass("is-invalid");
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass("is-invalid").parent().removeClass("is-invalid");
			},
			focusInvalid: false,
			invalidHandler: function(form, validator) {

				if (!validator.numberOfInvalids())
					return;

				var scrollToElement = $(validator.errorList[0].element);

				if ($(scrollToElement).prop('type') === 'select-one' || $(scrollToElement).prop('type') === 'radio' || $(scrollToElement).prop('type') === 'checkbox') {
					scrollToElement = $(scrollToElement).parent();
				}

				if ($(scrollToElement).parents('.popup-block').length > 0) {
					var thisModal = $(this).parents('.popup-block');
					
					var scrollTopValue = $(thisModal).scrollTop() + $(scrollToElement).offset().top - 120;

					$(thisModal).animate({
						scrollTop: scrollTopValue
					}, 400);
					
				} else {
					var scrollTopValue = $(scrollToElement).offset().top - 120;
					
					$('html, body').animate({
						scrollTop: scrollTopValue
					}, 400);
				}
				
			},
			ignore: '.tab-pane:hidden *, :disabled, .no-validate'
		});
		
		setTimeout(function() {
		   $(this).find('.num-input').each(function() {
				$(this).rules('add', {
					required: true,
					number: true
				});
			});
			
			$(this).find('[type="email"]').each(function() {
				$(this).rules('add', {
					required: true,
					email: true
				});
			});
		}, 0);
	});
	
});

$('.gallery__images').slick({
	slidesToShow: 1,
	asNavFor: '.gallery__thumbs',
	nextArrow: '<div class="gallery__images-prev"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.768 7.21224L8.41554 13.7694L6.46348 12.5624L10.8714 6.98388L6.46348 1.40538L8.41554 0.230957L13.768 6.78814V7.21224ZM7.50248 7.21224L2.18155 13.7694L0.229492 12.5624L4.63736 6.98388L0.229492 1.40538L2.18155 0.230957L7.50248 6.78814V7.21224Z"/></svg></div>',
	prevArrow: '<div class="gallery__images-next"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.232045 7.21224L5.58446 13.7694L7.53652 12.5624L3.12865 6.98388L7.53652 1.40538L5.58446 0.230957L0.232045 6.78814V7.21224ZM6.49752 7.21224L11.8185 13.7694L13.7705 12.5624L9.36264 6.98388L13.7705 1.40538L11.8185 0.230957L6.49752 6.78814V7.21224Z"/></svg></div>'
});

$('.gallery__thumbs').slick({
	asNavFor: '.gallery__images',
	vertical: true,
	focusOnSelect: true,
	arrows: false,
	slidesToShow: 6,
	responsive: [
		{
			breakpoint: 767,
			settings: {
				vertical: false,
				variableWidth: true
			}
		},
	]
});


window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("header-bot");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

$('.filter__group-header').click(function(){
	$(this).parent().toggleClass('active');
});

$('.filter-show-btn').click(function(){
	$('.filter-hide-btn').show()
	$('.filter').slideDown(300);
	$(this).hide();
});

$('.filter-hide-btn').click(function(){
	$('.filter-show-btn').show();
	$('.filter').slideUp(300);
	$(this).hide();
});

$('.add-author').click(function(e){
	e.preventDefault();
	$('.author-row').removeClass('d-none');
});

// $("#query-radio").click(function(){
// 	$('.query-price').show();
// 	$('.fix-price').hide();
// });

// $("#fixed-radio").click(function(){
// 	$('.query-price').hide();
// 	$('.fix-price').show();
// });

$('.header__search-btn').click(function(){
	$(this).toggleClass('active');
	$('.header__search-row').toggleClass('active');
})

$('.header__acc-btn').click(function(){
	if($(this).hasClass('active')){
		$(this).removeClass('active');
		$('#profile').removeClass('active');
		$('.overlay').removeClass('active');
	} else {
		$(this).addClass('active');
		$('#profile').addClass('active');
		$('.overlay').addClass('active');
	}
	
	if($('.header__menu-btn').hasClass('open')){
		$('.header__menu-btn').removeClass('open');
		$('#menu').removeClass('active');
	}
})

$('.header__menu-btn').click(function(){
	if($(this).hasClass('open')) {
		$(this).removeClass('open');
		$('#menu').removeClass('active');
		$('.overlay').removeClass('active');
	} else {
		$(this).addClass('open');
		$('#menu').addClass('active');
		$('.overlay').addClass('active');
	}

	if($('.header__acc-btn').hasClass('active')){
		$('.header__acc-btn').removeClass('active');
		$('#profile').removeClass('active');
	}
	
});

$('.overlay').click(function(){
	$('.header__search-btn').removeClass('active');
	$('.header__acc-btn').removeClass('active');
	$(this).removeClass('active');
	$('.mobile-menu').removeClass('active');
	$('.header__menu-btn').removeClass('open');
})

$('.dropdown').click(function(e){
	e.preventDefault();
	$(this).next().slideToggle();
})

$(document).ready(function(){
	// $('.input-images').imageUploader();	
})

$('.attention-line__btn').click(function(e){
	e.preventDefault();
	$('.attention-line').fadeOut();
});

$(document).ready(function() {
	if (window.File && window.FileList && window.FileReader) {
	  $("#files").on("change", function(e) {
		var files = e.target.files,
		  filesLength = files.length;
		for (var i = 0; i < filesLength; i++) {
		  var f = files[i]
		  var fileReader = new FileReader();
		  fileReader.onload = (function(e) {
			var file = e.target;
			$("<span class=\"pip\">" +
			  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
			  "<span class=\"remove\"></span>" +
			  "</span>").appendTo(".upload-field__results");
			$(".remove").click(function(){
			  $(this).parent(".pip").remove();
			});
		  });
		  fileReader.readAsDataURL(f);
		}
	  });
	} else {
	  alert("Your browser doesn't support to File API")
	}
  });

  $('#step-next-1').click(function(e){
	e.preventDefault();
	$('#step-1').removeClass('active');
	$('#step-2').addClass('active');
  });

  $('#step-next-2').click(function(e){
	e.preventDefault();
	$('#step-2').removeClass('active');
	$('#step-3').addClass('active');
  })

  $('#step-next-3').click(function(e){
	e.preventDefault();
	$('#step-3').removeClass('active');
	$('#step-4').addClass('active');
  })

  $('#step-back-2').click(function(e){
	e.preventDefault();
	$('#step-1').addClass('active');
	$('#step-2').removeClass('active');
  });

  $('#step-back-3').click(function(e){
	e.preventDefault();
	$('#step-2').addClass('active');
	$('#step-3').removeClass('active');
  });

  $('#step-back-4').click(function(e){
	e.preventDefault();
	$('#step-3').addClass('active');
	$('#step-4').removeClass('active');
  });