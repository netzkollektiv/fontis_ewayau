<?php
/**
 * Fontis eWAY Australia Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you are unable to obtain it through the world-wide-web, please send
 * an email to license@magentocommerce.com so you can be sent a copy.
 *
 * @category   Fontis
 * @package    Fontis_EwayAu
 * @author     Chris Norton
 * @copyright  Copyright (c) 2010 Fontis Pty. Ltd. (http://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Fontis_EwayAu_Block_Secure_Redirect extends Mage_Core_Block_Abstract
{
    protected function _toHtml()
    {
        $secure = $this->getOrder()->getPayment()->getMethodInstance();

        $form = new Varien_Data_Form();
        $form->setAction($secure->getEwaySecureUrl())
            ->setId('ewayau_secure_checkout')
            ->setName('ewayau_secure_checkout')
            ->setMethod('POST')
            ->setUseContainer(true);
        foreach ($secure->getFormFields() as $field=>$value) {
            $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }
        $html = '<html><body>';
        $html.= $this->__('You will be redirected to eWAY 3D-Secure in a few seconds.');
        $html.= $form->toHtml();
        $html.= '<script type="text/javascript">document.getElementById("ewayau_secure_checkout").submit();</script>';
        $html.= '</body></html>';

        return $html;
    }
}
