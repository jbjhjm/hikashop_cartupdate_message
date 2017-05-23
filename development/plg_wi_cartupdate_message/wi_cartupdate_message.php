<?php
<%= phpbanner %>


class plgHikashopWi_cartupdate_message extends JPlugin
{
	var $message = '';
	var $count = 0;

	function onAfterCartUpdate(  $cartClass, $cart, $product_id, $quantity, $add, $type, $resetCartWhenUpdate, $force, $return ) {

		// var_dump($cart, $product_id, $quantity, $add, $type, $resetCartWhenUpdate, $force, $return);
		// var_dump($cartClass->errors);
		// var_dump($cartClass);
		// var_dump(JFactory::GetApplication()->getUserState('com_hikashop.cart_new'));
		// var_dump(JFactory::GetApplication()->input);
		// die;

		$input = JFactory::GetApplication()->input;

		if($input->get('option') == 'com_hikashop' && $input->get('view') == 'product' & !@$cartClass->errors) {
			$msg = '<p>'.JText::_('PRODUCT_SUCCESSFULLY_ADDED_TO_CART').'</p>';

			$url_itemid='';
			$menuClass = hikashop_get('class.menus');
			$itemid_for_checkout = $menuClass->getCheckoutMenuIdForURL();
			if(!empty($itemid_for_checkout)){
				$url_checkout = hikashop_completeLink('checkout&Itemid='.$itemid_for_checkout);
			}else{
				$url_checkout = hikashop_completeLink('checkout'.$url_itemid);
			}
			$url_checkout = '/shop/checkout/';

			$msg.= '<a class="uk-button" href="'.$url_checkout.'">'.JText::_('PROCEED_TO_CHECKOUT').'</a>';
			JFactory::getApplication()->enqueueMessage($msg,'');
		}
		return true;
	}
}
