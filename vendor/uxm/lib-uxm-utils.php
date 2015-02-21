<?php
// Utils Library
// author: Radu Ilies
// 2015-02-21

namespace UXM;

class Utils {

	public static function escape_js($data) {
		//--
		return json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		//--
	} //END FUNCTION

	public static function escape_html($y_string) {
		//--
		return htmlspecialchars($y_string,  ENT_HTML5 | ENT_COMPAT | ENT_SUBSTITUTE, 'UTF-8');
		//--
	} //END FUNCTION

} //END CLASS

?>