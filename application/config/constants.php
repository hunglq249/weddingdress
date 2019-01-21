<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);
/**
 * Message Photos are too large code
 */
defined('MESSAGE_PHOTOS_ERROR') OR define('MESSAGE_PHOTOS_ERROR', 'Hình ảnh vượt quá %u Kb hoặc định dạng file không đúng. Vui lòng kiểm tra lại và thực hiện lại thao tác!');

/**
 * Message Pfile extension
 */
defined('MESSAGE_FILE_EXTENSION_ERROR') OR define('MESSAGE_FILE_EXTENSION_ERROR', 'Đuôi file image phải là jpg | jpeg | png | gif!');
/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * HTTP Success code
 */
defined('HTTP_SUCCESS') OR define('HTTP_SUCCESS', 200);


/**
 * HTTP Error code
 */
defined('HTTP_BAD_REQUEST') OR define('HTTP_BAD_REQUEST', 400);
defined('HTTP_NOT_FOUND') OR define('HTTP_NOT_FOUND', 404);


/**
 * Message Success code
 */
defined('MESSAGE_CREATE_SUCCESS') OR define('MESSAGE_CREATE_SUCCESS', 'Thêm mới thành công!');

/**
 * Message Success code
 */
defined('MESSAGE_CREATE_ERROR') OR define('MESSAGE_CREATE_ERROR', 'Thêm mới thất bại!');

defined('MESSAGE_CREATE_ERROR_VALIDATE') OR define('MESSAGE_CREATE_ERROR_VALIDATE', 'Lỗi thêm mới cấu hình vui lòng thao tác lại.');


/**
 * Message Success code
 */
defined('MESSAGE_UPDATE_SUCCESS') OR define('MESSAGE_UPDATE_SUCCESS', 'Sửa thành công!');

/**
 * Message Success code
 */
defined('MESSAGE_UPDATE_ERROR') OR define('MESSAGE_UPDATE_ERROR', 'Sửa thất bại!');

defined('MESSAGE_UPDATE_ERROR_VALIDATE') OR define('MESSAGE_UPDATE_ERROR_VALIDATE', 'Lỗi sửa cấu hình vui lòng thao tác lại.');


/**
 * Message Success code
 */
defined('MESSAGE_REMOVE_SUCCESS') OR define('MESSAGE_REMOVE_SUCCESS', 'Xóa thành công!');

/**
 * Message error code
 */
defined('MESSAGE_REMOVE_ERROR') OR define('MESSAGE_REMOVE_ERROR', 'Xóa thất bại!');

/**
 * Message Success code
 */
defined('MESSAGE_ISSET_ERROR') OR define('MESSAGE_ISSET_ERROR', 'ID không tồn tại!');
/**
 * Message Success code
 */
defined('MESSAGE_ISSET_CONFIG_ERROR') OR define('MESSAGE_ISSET_CONFIG_ERROR', 'Cấu hình không tồn tại!');

/**
 * Message check id product category 
 */
defined('MESSAGE_ID_ERROR') OR define('MESSAGE_ID_ERROR', 'ID phải là số và lớn hơn 0');

/**
 * Message Success code
 */
defined('MESSAGE_EDIT_SUCCESS') OR define('MESSAGE_EDIT_SUCCESS', 'Sửa thành công!');

/**
 * Message Success code
 */
defined('MESSAGE_EDIT_ERROR') OR define('MESSAGE_EDIT_ERROR', 'Sửa thất bại!');
/**
 * Message Success code
 */
defined('MESSAGE_TURN_OFF_POST_MENU') OR define('MESSAGE_TURN_OFF_POST_MENU', 'Bạn vẫn còn menu đang bật và trỏ trực tiếp đến bài viết click để tới menu!');
/**
 * Message Success code
 */
defined('MESSAGE_TURN_OFF_PRODUCT_MENU') OR define('MESSAGE_TURN_OFF_PRODUCT_MENU', 'Bạn vẫn còn menu đang bật và trỏ trực tiếp đến sản phẩm. Click để tới menu!');
/**
 * Message Success code
 */
defined('MESSAGE_TURN_OFF_CATEGORY_MENU') OR define('MESSAGE_TURN_OFF_CATEGORY_MENU', 'Bạn vẫn còn menu đang bật và chọn danh mục hiện tại là danh mục chính cho menu. Click để tới menu!');
/**
 * Message Success code
 */
defined('MESSAGE_SUCCESS_TURN_ON_ALL') OR define('MESSAGE_SUCCESS_TURN_ON_ALL', 'Bật thành công');
defined('MESSAGE_SUCCESS_TURN_OFF_ALL') OR define('MESSAGE_SUCCESS_TURN_OFF_ALL', 'Tắt thành công');
/**
 * Message menu
 */

defined('MESSAGE_ERROR_TURN_ON_MENU_PRESENT') OR define('MESSAGE_ERROR_TURN_ON_MENU_PRESENT', 'Bạn phải bật Menu cha của Menu hiện tại');
defined('MESSAGE_ERROR_TURN_ON_POST_PERSENT') OR define('MESSAGE_ERROR_TURN_ON_POST_PERSENT', '---(Bài viết hiện đang tắt để sử dụng vui lòng bật bài viết lên)');
defined('MESSAGE_SUCCESS_TURN_ON') OR define('MESSAGE_SUCCESS_TURN_ON', 'Bật Menu thành công');
defined('MESSAGE_SUCCESS_TURN_OFF') OR define('MESSAGE_SUCCESS_TURN_OFF', 'Tắt Menu thành công');
defined('MESSAGE_ERROR_SELECT_ORIGINAL_CATEGORY') OR define('MESSAGE_ERROR_SELECT_ORIGINAL_CATEGORY', 'Bạn phải chọn danh mục cho menu chính');
defined('MESSAGE_ERROR_TURN_ON_POST_CATEGORY_FOR_SELECTED') OR define('MESSAGE_ERROR_TURN_ON_POST_CATEGORY_FOR_SELECTED', 'Bạn phải bật danh mục bài viết mà menu đã chọn (tên danh mục là: %s)');
defined('MESSAGE_ERROR_TURN_ON_ARTICEL_FOR_SELECTED') OR define('MESSAGE_ERROR_TURN_ON_ARTICEL_FOR_SELECTED', 'Bạn phải bật bài viết hoặc sản phẩm mà menu đã chọn.');
defined('MESSAGE_ERROR_TURN_ON_POST_FOR_SELECTED') OR define('MESSAGE_ERROR_TURN_ON_POST_FOR_SELECTED', 'Bạn phải bật bài viết hoặc sản phẩm mà bạn đã chọn làm đường dẫn cho menu');
defined('MESSAGE_ERROR_TURN_ON_CATEGORY_FOR_SELECTED_CREATE') OR define('MESSAGE_ERROR_TURN_ON_CATEGORY_FOR_SELECTED_CREATE', '---(Danh mục hiện đang tắt bạn phải bật danh mục mà menu đã chọn là menu chính)');
defined('MESSAGE_ERROR_UPDATE_TURN_ON') OR define('MESSAGE_ERROR_UPDATE_TURN_ON', 'Bạn phải bật Menu cha của Menu hiện tại');
defined('MESSAGE_ERROR_ACTIVE_PRODUCT') OR define('MESSAGE_ERROR_ACTIVE_PRODUCT', 'Bạn phải bật Danh mục sản phẩm và bộ sưu tập của sản phẩm hiện tại');
defined('MESSAGE_ERROR_ACTIVE_BANNER') OR define('MESSAGE_ERROR_ACTIVE_BANNER', 'Bạn phải bật %s mà banner đã chọn hiện tại');
defined('MESSAGE_ERROR_MAIN_SELECTED') OR define('MESSAGE_ERROR_MAIN_SELECTED', 'Bạn phải chọn menu chính');



defined('MESSAGE_ERROR_REMOVE') OR define('MESSAGE_ERROR_REMOVE', 'Bạn có %u menu là dạng menu trỏ trực tiếp đến bài viết hiện tại nên bạn không thể xóa.');
defined('MESSAGE_ERROR_REMOVE_CATEGORY') OR define('MESSAGE_ERROR_REMOVE_CATEGORY', 'Bạn có %u menu chọn danh mục hiện tại là menu chính nên bạn không thể xóa.');
defined('MESSAGE_FOREIGN_KEY_LINK_ERROR') OR define('MESSAGE_FOREIGN_KEY_LINK_ERROR', 'Danh mục vẫn còn %s bài viết và có %s danh mục là con nên không thể xóa!');
defined('MESSAGE_FOREIGN_KEY_LINK_COLLECTION_ERROR') OR define('MESSAGE_FOREIGN_KEY_LINK_COLLECTION_ERROR', 'Bộ sưu tập hiện có %s sản phẩm chọn bộ sưu tập này nên bạn k thể xóa!');
defined('MESSAGE_FOREIGN_KEY_LINK_PRODUCT_ERROR') OR define('MESSAGE_FOREIGN_KEY_LINK_PRODUCT_ERROR', 'Danh mục vẫn còn %s sản phẩm và có %s danh mục là con nên không thể xóa!');
defined('MESSAGE_ERROR_REMOVE_CONFIG') OR define('MESSAGE_ERROR_REMOVE_CONFIG', 'Bạn không thể xóa cấu hình vì có %s sử dụng cấu hình!');

/**
 * Message 
 */
defined('MESSAGE_ERROR_ACTIVE_POST') OR define('MESSAGE_ERROR_ACTIVE_POST', 'Bạn phải bật Danh mục bài viết của bài viết hiện tại');
defined('MESSAGE_ERROR_ACTIVE_CATEGORY') OR define('MESSAGE_ERROR_ACTIVE_CATEGORY', 'Bạn phải bật danh mục cha của danh mục hiện tại');
/**
 * Message Success code
 */
defined('MESSAGE_CREATE_CONFIG_ERROR') OR define('MESSAGE_CREATE_CONFIG_ERROR', 'Danh sách lựa chọn của các ngôn ngữ phải bằng nhau!');


defined('MESSAGE_ERROR_REMOVE_COLOR') OR define('MESSAGE_ERROR_REMOVE_COLOR', 'Bạn không thể xóa màu này vì có sản phâm %u sử dụng màu này');
defined('MESSAGE_ERROR_REMOVE_FEATURES') OR define('MESSAGE_ERROR_REMOVE_FEATURES', 'Bạn không thể xóa tính năng này vì có sản phâm %u sử dụng tính năng này');
defined('MESSAGE_ERROR_REMOVE_TRADEMARK') OR define('MESSAGE_ERROR_REMOVE_TRADEMARK', 'Bạn không thể xóa thương hiệu này vì có sản phâm %u sử dụng thương hiệu này');

/*=====  End of Message for Create  ======*/

/**
 * Change Language
 */
defined('MESSAGE_CHANGE_LANGUAGE_SUCCESS') OR define('MESSAGE_CHANGE_LANGUAGE_SUCCESS', 'changed');
defined('MESSAGE_CHANGE_LANGUAGE_FAIL') OR define('MESSAGE_CHANGE_LANGUAGE_FAIL', 'keep');