<?php
/**
 * Base
 */

declare (strict_types = 1);

namespace J7\ShalomartsShortcode\Utils;

if (class_exists('J7\ShalomartsShortcode\Utils\Base')) {
	return;
}
/**
 * Class Base
 */
abstract class Base {
	const BASE_URL      = '/';
	const APP1_SELECTOR = '#shalomarts_shortcode';
	const APP2_SELECTOR = '#shalomarts_shortcode_metabox';
	const API_TIMEOUT   = '30000';
	const DEFAULT_IMAGE = 'http://1.gravatar.com/avatar/1c39955b5fe5ae1bf51a77642f052848?s=96&d=mm&r=g';
}
