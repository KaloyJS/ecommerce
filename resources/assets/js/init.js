(function () {
	'use strict';

	$(document).foundation();

	$(document).ready(function () {
		// Switch pages
		switch ($('body').data('page-id')) {
			case 'home':
				break;

			case 'adminCategories':
				ESTORE.admin.update();
				break;

			default:
				//do nothing
				break;
		}
	});
})();
