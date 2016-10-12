<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PT_CV_Social_Share_Count {

	public $shareUrl;
	public $socialCounts		 = array();
	public $facebookShareCount	 = 0;
	public $facebookLikeCount	 = 0;
	public $twitterShareCount	 = 0;
	public $bufferShareCount	 = 0;
	public $pinterestShareCount	 = 0;
	public $linkedInShareCount	 = 0;
	public $googlePlusOnesCount	 = 0;

	public function __construct( $options ) {

		if ( is_array( $options ) ) {
			if ( array_key_exists( 'url', $options ) && $options[ 'url' ] != '' ) {
				$this->shareUrl = $options[ 'url' ];
			} else {
				die( 'URL must be set in constructor parameter array!' );
			}

			if ( array_key_exists( 'facebook', $options ) ) {
				$this->getFacebookShares();
//				$this->getFacebookLikes();
			}

			if ( array_key_exists( 'twitter', $options ) ) {
				$this->getTwitterShares();
			}

			if ( array_key_exists( 'pinterest', $options ) ) {
				$this->getPinterestShares();
			}

			if ( array_key_exists( 'linkedin', $options ) ) {
				$this->getLinkedInShares();
			}

			if ( array_key_exists( 'googleplus', $options ) ) {
				$this->getGooglePlusOnes();
			}

			if ( array_key_exists( 'buffer', $options ) ) {
				$this->getBufferShares();
			}
		} elseif ( is_string( $options ) && $options != '' ) {
			$this->shareUrl = $options;

			// Get all Social Network share counts
			$this->getFacebookShares();
			$this->getFacebookLikes();
			$this->getTwitterShares();
			$this->getPinterestShares();
			$this->getLinkedInShares();
			$this->getGooglePlusOnes();
			$this->getBufferShares();
		} else {
			die( 'URL must be set in constructor parameter!' );
		}
	}

	public function getFacebookShares() {
		$api	 = @file_get_contents( 'http://graph.facebook.com/?id=' . $this->shareUrl );
		$count	 = json_decode( $api );
		if ( isset( $count->shares ) && $count->shares != '0' ) {
			$this->facebookShareCount = $count->shares;
		}
		$this->socialCounts[ 'facebook' ] = $this->facebookShareCount;
		return $this->facebookShareCount;
	}

	public function getFacebookLikes() {
		$api	 = @file_get_contents( 'http://graph.facebook.com/?id=' . $this->shareUrl );
		$count	 = json_decode( $api );
		if ( isset( $count->likes ) && $count->likes != '0' ) {
			$this->facebookLikeCount = $count->likes;
		}
		$this->socialCounts[ 'facebooklikes' ] = $this->facebookLikeCount;
		return $this->facebookLikeCount;
	}

	public function getTwitterShares() {
		/**
		 * @since 3.6
		 */
		$from	 = 'Twitter share count provided by NewShareCounts.com';
		$api	 = @file_get_contents( 'http://public.newsharecounts.com/count.json?from=' . $from . '&url=' . $this->shareUrl );
		$count	 = json_decode( $api );
		if ( isset( $count->count ) && $count->count != '0' ) {
			$this->twitterShareCount = $count->count;
		}
		$this->socialCounts[ 'twitter' ] = $this->twitterShareCount;
		return $this->twitterShareCount;

		/**
		 * Twitter removed Count API since 2015 Oct.
		 * https://blog.twitter.com/2015/hard-decisions-for-a-sustainable-platform
		 */
		/*
		  $api	 = @file_get_contents( 'https://cdn.api.twitter.com/1/urls/count.json?url=' . $this->shareUrl );
		  $count	 = json_decode( $api );
		  if ( isset( $count->count ) && $count->count != '0' ) {
		  $this->twitterShareCount = $count->count;
		  }
		  $this->socialCounts[ 'twitter' ] = $this->twitterShareCount;
		  return $this->twitterShareCount;
		 */
	}

	public function getBufferShares() {
		$api	 = @file_get_contents( 'https://api.bufferapp.com/1/links/shares.json?url=' . $this->shareUrl );
		$count	 = json_decode( $api );
		if ( isset( $count->shares ) && $count->shares != '0' ) {
			$this->bufferShareCount = $count->shares;
		}
		$this->socialCounts[ 'buffer' ] = $this->bufferShareCount;
		return $this->bufferShareCount;
	}

	public function getPinterestShares() {
		$api	 = @file_get_contents( 'http://api.pinterest.com/v1/urls/count.json?callback%20&url=' . $this->shareUrl );
		$body	 = preg_replace( '/^receiveCount\((.*)\)$/', '\\1', $api );
		$count	 = json_decode( $body );
		if ( isset( $count->count ) && $count->count != '0' ) {
			$this->pinterestShareCount = $count->count;
		}
		$this->socialCounts[ 'pinterest' ] = $this->pinterestShareCount;
		return $this->pinterestShareCount;
	}

	public function getLinkedInShares() {
		$api	 = @file_get_contents( 'https://www.linkedin.com/countserv/count/share?url=' . $this->shareUrl . '&format=json' );
		$count	 = json_decode( $api );
		if ( isset( $count->count ) && $count->count != '0' ) {
			$this->linkedInShareCount = $count->count;
		}
		$this->socialCounts[ 'linkedin' ] = $this->linkedInShareCount;
		return $this->linkedInShareCount;
	}

	public function getGooglePlusOnes() {

		if ( function_exists( 'curl_version' ) ) {
			$curl						 = curl_init();
			curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
			curl_setopt( $curl, CURLOPT_POST, 1 );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $this->shareUrl . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
			$curl_results				 = curl_exec( $curl );
			curl_close( $curl );
			$json						 = json_decode( $curl_results, true );
			$this->googlePlusOnesCount	 = intval( $json[ 0 ][ 'result' ][ 'metadata' ][ 'globalCounts' ][ 'count' ] );
		} else {
			$content = @file_get_contents( "https://plusone.google.com/u/0/_/+1/fastbutton?url=" . urlencode( $_GET[ 'url' ] ) . "&count=true" );
			$doc	 = new DOMdocument();
			libxml_use_internal_errors( true );
			$doc->loadHTML( $content );
			$doc->saveHTML();
			$num	 = $doc->getElementById( 'aggregateCount' )->textContent;

			if ( $num ) {
				$this->googlePlusOnesCount = intval( $num );
			}
		}

		$this->socialCounts[ 'googleplus' ] = $this->googlePlusOnesCount;
		return $this->googlePlusOnesCount;
	}

}
