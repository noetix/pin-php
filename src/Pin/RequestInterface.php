<?php

namespace Pin;

interface RequestInterface
{
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_GET     = 'GET';
    const METHOD_HEAD    = 'HEAD';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_PATCH   = 'PATCH';
	
	/**
	 * Get our end-point's expected method.
	 * 
	 * @return string
	 */
	public function getMethod();
	
	/**
	 * Get our end-point path.
	 * 
	 * @return string
	 */
	public function getPath();

	/**
	 * Get our sendable data.
	 * 
	 * @return array
	 */
	public function getData();
}