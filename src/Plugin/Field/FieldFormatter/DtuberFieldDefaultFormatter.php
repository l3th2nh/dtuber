<?php
/**
 * @file
 * Definition of Drupal\dtuber\Plugin\field\formatter\DtuberFieldDefaultFormatter.
 */

namespace Drupal\dtuber\Plugin\Field\FieldFormatter;

use \Drupal\Core\Field\FieldItemListInterface;
use \Drupal\Core\Field\FormatterBase;
use \Drupal;
use Symfony\Component\EventDispatcher\Event;

/**
 * Plugin implementation of the 'dtuber_field_default_formatter' formatter
 * 
 * @FieldFormatter(
 *   id = "dtuber_field_default_formatter",
 *   module = "dtuber",
 *   label = @Translation("DTuber Field"),
 *   field_types = {
 *     "dtuber_field"
 *   }
 * )
*/
class DtuberFieldDefaultFormatter extends FormatterBase {
	/**
	 * {@inheritdocs}
	 */
	public function viewElements(FieldItemListInterface $items, $langcode) {
		# -----------------------------------------------
		# Need to allow X-Frame-Options, D8 by default disallows any other origin to embed in <iframes>
		# https://www.drupal.org/node/2514152
		// $dispatcher = \Drupal::service('event_dispatcher');
		// $e = new Event($items);
		// $event = $dispatcher->dispatch('remove_x_frame_options_subscriber', $e);
		# -----------------------------------------------
		$html = '';
		$elements = [];
		// kint($items);
		foreach ($items as $delta => $item) {
			if($item) {

				$options = array(
					'src' =>  'https://www.youtube.com/v/' . $item->yt_videoid . '?version=3&autoplay=1',
					'value' => $item->fid,
					'vid' => $item->yt_videoid,
				);
				$elements[$delta] = array(
					'#theme' => 'dtuber_field_formatter',
					'#options' => $options,
				);
				// kint($item);
				// $html .= '<pre>FileID: '.$item->fid.'</pre>';
			}
		}
		return $elements;
	// 	return [
	// 		'#markup' => $html,
	// 	];
	}
}