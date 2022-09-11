<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

		$root = "http://".$_SERVER['HTTP_HOST'];
		$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

			$settings_xml_file_path = $root."application/config/settings.xml";
			
			$xml_instance = simplexml_load_file($settings_xml_file_path);
			
			if(isset($xml_instance) && $xml_instance != '') {
			
			$xml = get_object_vars($xml_instance);
			
			define('source_base_path',$xml['source_base_path']);
			define('destination_base_path',$xml['destination_base_path']);
			
			define('gallery_temp_image_path',$xml['gallery_temp_image_path']);
			define('article_temp_image_path',$xml['article_temp_image_path']);
			define('astrology_temp_image_path',$xml['astrology_temp_image_path']);
			define('video_temp_image_path',$xml['video_temp_image_path']);
			define('audio_temp_image_path',$xml['audio_temp_image_path']);
			define('audio_temp_file_path',$xml['audio_temp_file_path']);
			define('resource_temp_image_path',$xml['resource_temp_image_path']);
			define('author_temp_image_path',$xml['author_temp_image_path']);
			define('imagelibrary_temp_image_path',$xml['imagelibrary_temp_image_path']);
			define('section_article_image_path',$xml['section_article_image_path']);
			define('poll_temp_image_path',$xml['poll_temp_image_path']);
			
			define('resource_worddocument_path',$xml['resource_worddocument_path']);
			define('resource_pdf_path',$xml['resource_pdf_path']);
			define('resource_excel_path',$xml['resource_excel_path']);
			define('resource_ppt_path',$xml['resource_ppt_path']);
			
			define('image_resolution',$xml['image_resolution']);
			
			define('audio_source_path',$xml['audio_source_path']);
			
			define('columinst_image_path',$xml['columinst_image_path']);


			define('resource_path',$xml['resource_path']);
			define('imagelibrary_image_path',$xml['imagelibrary_image_path']);
			define('ckeditor_image_path',$xml['ckeditor_image_path']);
			define('ckeditor_astroimage_path',$xml['ckeditor_astroimage_path']);
			define('folder_name',$xml['folder_name']);
		
			define('image_url', $xml['image_url']); //"http://images.dinamani.com/"
                        define('static_url',$xml['image_url']);

			define('no_articles',$xml['no_articles']);	
			define('BASEURL', $xml['home_url']);
                        define('HOMEURL', 'http://cms.dinamani.com/'); //$xml['home_html_access_url']

			$xml_instance = NULL;

			}
/* End of file constants.php */
/* Location: ./application/config/constants.php */