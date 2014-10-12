<?php
namespace wcf\system\bbcode;

// imports
use wcf\system\jumpmark\JumpMarkMap;
use wcf\system\WCF;
use wcf\util\StringUtil;

/**
 * Parse heading and subheading tag.
 *
 * @author	Karsten (Teralios) Achterrath
 * @copyright	2014 Teralios.de
 * @license	Attribution-ShareAlike 4.0 International (CC BY-SA 4.0) <http://creativecommons.org/licenses/by-sa/4.0/legalcode>
 * @package	de.teralios.tjs.bbcodes
 */
class HeadingBBCode extends AbstractBBCode {
	/**
	 * Array with jump marks for checking jump marks.
	 * @var	array<string>
	 */
	protected static $jumpMarks = array();
	
	/**
	 * Prefix for jump marks.
	 * @var	string
	 */
	protected static $jumpMarkPrefix = 'a-%s';

	/**
	 * @see \wcf\system\bbcode\IBBCode::getParsedTag()
	 */
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) {
		$tag = mb_strtolower($openingTag['name']);
		
		// switch short tags to long tags.
		switch ($tag) {
			case 'h1':
				$tag = 'heading';
				break;
			case 'h2':
				$tag = 'subheading';
				break;
		}
		
		// heading and subheading tag html.
		if ($parser->getOutputType() == 'text/html') {
			if (!empty($openingTag['attributes'][0])) {
				$jumpMark = $openingTag['attributes'][0];
			}
			else if (BBCODES_HEADLINE_AUTOMARK == 1) {
				$jumpMark = substr(md5($content), 0, 10);
			}
			else {
				$jumpMark = '';
			}
			
			if (!empty($jumpMark)) {
				$jumpMark = sprintf(static::$jumpMarkPrefix, static::jumpMarkExists($jumpMark, $jumpMark));
				$jumpMark = JumpMarkMap::getInstance()->addJumpMark($jumpMark, StringUtil::decodeHTML($content), (($tag == 'heading') ? false : true));
				
			}
			
			WCF::getTPL()->assign(array(
				'hsTag' => $tag,
				'hsJumpMark' => $jumpMark,
				'hsHeading' => $content,
				'hsDataLink' => StringUtil::stripHTML($content)
			));
			
			return WCF::getTPL()->fetch('headingBBCode');
		}
		// heading and subheading in simpleified-html.
		else if ($parser->getOutputType('text/simplified-html')) {
			switch ($tag) {
				case 'heading':
					$return = '--- '.$content.' ---<br />';
					break;
				default:
					$return = '-- '.$content.' --<br />';
					break;
			}
			
			return $return;
		}
	}

	/**
	 * Check given jumpmark and create a new, if jumpmark exists.
	 * 
	 * @param	string		$jumpMark
	 * @param	string		$oldJumpMark
	 * @param	number		$counter
	 * @return	string
	 */
	protected static function jumpMarkExists($jumpMark, $oldJumpMark, $counter = 1) {
		if (isset(self::$jumpMarks[$jumpMark])) {
			$newJumpMark = (($oldJumpMark == $jumpMark) ? $jumpMark : $oldJumpMark).'_'.$counter;
			$counter++;
			return self::jumpMarkExists($newJumpMark, $oldJumpMark, $counter);
		}
		
		self::$jumpMarks[$jumpMark] = $jumpMark;
		return $jumpMark;	
	}
}