<?php

/**
 * @license GPLv3, http://www.gnu.org/copyleft/gpl.html
 * @copyright Metaways Infosystems GmbH, 2013
 * @copyright Aimeos (aimeos.org), 2014-2016
 * @package TYPO3
 */


namespace Aimeos\Aimeos\Controller;


use Aimeos\Aimeos\Base;


/**
 * Aimeos account controller.
 *
 * @package TYPO3
 */
class AccountController extends AbstractController
{
	/**
	 * Renders the account download
	 */
	public function downloadAction()
	{
		$paths = Base::getAimeos()->getCustomPaths( 'client/html' );
		$context = $this->getContext( $paths );
		$view = $context->getView();

		$client = \Aimeos\Client\Html\Account\Download\Factory::createClient( $context, array() );
		$client->setView( $view );
		$client->process();

		$response = $view->response();
		$this->response->setStatus( $response->getStatusCode() );

		foreach( $response->getHeaders() as $key => $value ) {
			$this->response->setHeader( $key, implode( ', ', $value ) );
		}

		return (string) $response->getBody();
	}


	/**
	 * Renders the account history.
	 */
	public function historyAction()
	{
		$paths = Base::getAimeos()->getCustomPaths( 'client/html' );
		$client = \Aimeos\Client\Html\Account\History\Factory::createClient( $this->getContext( $paths ), $paths );

		return $this->getClientOutput( $client );
	}


	/**
	 * Renders the account favorites.
	 */
	public function favoriteAction()
	{
		$paths = Base::getAimeos()->getCustomPaths( 'client/html' );
		$client = \Aimeos\Client\Html\Account\Favorite\Factory::createClient( $this->getContext( $paths ), $paths );

		return $this->getClientOutput( $client );
	}


	/**
	 * Renders the account profile.
	 */
	public function profileAction()
	{
		$paths = Base::getAimeos()->getCustomPaths( 'client/html' );
		$client = \Aimeos\Client\Html\Account\Profile\Factory::createClient( $this->getContext( $paths ), $paths );

		return $this->getClientOutput( $client );
	}


	/**
	 * Renders the account watch list.
	 */
	public function watchAction()
	{
		$paths = Base::getAimeos()->getCustomPaths( 'client/html' );
		$client = \Aimeos\Client\Html\Account\Watch\Factory::createClient( $this->getContext( $paths ), $paths );

		return $this->getClientOutput( $client );
	}
}
