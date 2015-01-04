/**
 * @tableofcontents
 *
 * 1. lazy load
 *
 * @since 2.0.1
 *
 * @package Redaxscript
 * @author Henry Ruhs
 */

/* @section 1. lazy load */

rs.modules.lazyLoad =
{
	init: true,
	selector: 'img.js_lazy_load:visible',
	options:
	{
		threshold: 200,
		interval: 200
	}
};