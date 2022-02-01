(function () {
	'use strict';

	$(document).foundation();

	$(document).ready(function () {
		// Switch pages
		switch ($('body').data('page-id')) {
			case 'home':
				break;

			case 'adminProduct':
				ESTORE.admin.changeEvent();
				break;

			case 'adminCategories':
				ESTORE.admin.update();
				ESTORE.admin.delete();
				ESTORE.admin.create();
				break;

			default:
				//do nothing
				break;
		}
	});
})();
