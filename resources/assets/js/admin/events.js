(() => {
	'use strict';

	ESTORE.admin.changeEvent = function () {
		$('#product-category').on('change', function (e) {
			const category_id = e.currentTarget.value;
			const subcategorySelect = document.querySelector('#product-subcategory');

			if (category_id != '') {
				let initialHtml = `<option value="">Select Subcategory</option>`;
				$.ajax({
					type: 'GET',
					url: `/admin/category/${category_id}/selected`,
					data: { category_id },
					success: function (res) {
						const subcategories = JSON.parse(res);
						if (subcategories.length) {
							let html = subcategories
								.map(
									(subcategory) =>
										`<option value="${subcategory.id}">${subcategory.name}</option>`
								)
								.join('');
							subcategorySelect.innerHTML = initialHtml + html;
						} else {
							subcategorySelect.innerHTML = initialHtml;
						}
					},
				});
			}
		});
	};
})();
