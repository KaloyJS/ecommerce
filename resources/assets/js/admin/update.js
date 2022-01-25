(function () {
	'use strict';

	ESTORE.admin.update = function () {
		//update product category
		$('.update-category').on('click', function (e) {
			e.preventDefault();
			let formData = new FormData(
				$(this).parent().siblings().parent().parent()[0]
			);
			formData.append('id', $(this).attr('id'));
			const id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url: `/admin/product/categories/${id}/edit`,
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					let response = JSON.parse(data);
					$('.notification')
						.css('display', 'block')
						.removeClass('alert')
						.addClass('primary')
						.delay(4000)
						.slideUp(300)
						.html(response.success);
				},
				error: function (request, error) {
					let errors = JSON.parse(request.responseText);
					// create ul element with li's that have the error on it
					let ul = document.createElement('ul');

					errors.name.forEach((error) => {
						let li = document.createElement('li');
						li.appendChild(document.createTextNode(error));
						ul.appendChild(li);
					});
					// display ul in the notification
					$('.notification')
						.css('display', 'block')
						.removeClass('primary')
						.addClass('alert')
						.delay(6000)
						.slideUp(300)
						.html(ul);
				},
			});
		});

		//update subcategory
		$('.update-subcategory').on('click', function (e) {
			e.preventDefault();
			let formData = new FormData(
				$(this).parent().siblings().parent().parent()[0]
			);
			formData.append('id', $(this).attr('id'));
			const id = $(this).attr('id');
			$.ajax({
				type: 'POST',
				url: `/admin/product/subcategories/${id}/edit`,
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					let response = JSON.parse(data);
					$('.notification')
						.css('display', 'block')
						.removeClass('alert')
						.addClass('primary')
						.delay(4000)
						.slideUp(300)
						.html(response.success);
				},
				error: function (request, error) {
					let errors = JSON.parse(request.responseText);
					// create ul element with li's that have the error on it
					let ul = document.createElement('ul');

					errors.name.forEach((error) => {
						let li = document.createElement('li');
						li.appendChild(document.createTextNode(error));
						ul.appendChild(li);
					});
					// display ul in the notification
					$('.notification')
						.css('display', 'block')
						.removeClass('primary')
						.addClass('alert')
						.delay(6000)
						.slideUp(300)
						.html(ul);
				},
			});
		});
	};
})();
