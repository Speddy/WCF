<?php
namespace wcf\form;
use wcf\page\AbstractPage;
use wcf\system\WCF;
use wcf\system\event\EventHandler;
use wcf\system\exception\UserInputException;

/**
 * This class provides default implementations for the Form interface.
 * This includes the default event listener for a form: readFormParameters, validate, save.
 * 
 * @author	Marcel Werk
 * @copyright	2001-2009 WoltLab GmbH
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 * @package	com.woltlab.wcf
 * @subpackage	form
 * @category 	Community Framework
 */
abstract class AbstractForm extends AbstractPage implements IForm {
	/**
	 * Name of error field.
	 *
	 * @var string
	 */
	public $errorField = '';
	
	/**
	 * Name of error type.
	 *
	 * @var string
	 */
	public $errorType = '';
	
	/**
	 * @see wcf\form\IForm::submit()
	 */
	public function submit() {
		// call submit event
		EventHandler::getInstance()->fireAction($this, 'submit');
		
		$this->readFormParameters();
		
		try {
			$this->validate();
			// no errors
			$this->save();
		}
		catch (UserInputException $e) {
			$this->errorField = $e->getField();
			$this->errorType = $e->getType();
		}
	}
	
	/**
	 * @see wcf\form\IForm::readFormParameters()
	 */
	public function readFormParameters() {
		// call readFormParameters event
		EventHandler::getInstance()->fireAction($this, 'readFormParameters');
	}
	
	/**
	 * @see wcf\form\IForm::validate()
	 */
	public function validate() {
		// call validate event
		EventHandler::getInstance()->fireAction($this, 'validate');
	}
	
	/**
	 * @see wcf\form\IForm::save()
	 */
	public function save() {
		// call save event
		EventHandler::getInstance()->fireAction($this, 'save');
	}
	
	/**
	 * Calls the 'saved' event after the successful call of the save method.
	 * This functions won't called automatically. You must do this manually, if you inherit AbstractForm.
	 */
	protected function saved() {
		EventHandler::getInstance()->fireAction($this, 'saved');
	}
	
	/**
	 * @see wcf\page\IPage::readData()
	 */
	public function readData() {
		if (count($_POST) || count($_FILES)) {
			$this->submit();
		}
		
		parent::readData();
	}
	
	/**
	 * @see wcf\page\IPage::assignVariables()
	 */
	public function assignVariables() {
		parent::assignVariables();
		
		// assign default variables
		WCF::getTPL()->assign(array(
			'errorField' => $this->errorField,
			'errorType' => $this->errorType
		));
	}
}
