<?php
/**
* script by Przemyslaw Cios version 1.0 beta 1 
 */
abstract class BCGDraw {
	protected $im;
	protected $filename;

	/**
	 * Constructor
	 *
	 * @param resource $im
	 */
	protected function __construct($im) {
		$this->im = $im;
	}

	/**
	 * Sets the filename
	 *
	 * @param string $filename
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * Method needed to draw the image based on its specification (JPG, GIF, etc.)
	 */
	abstract public function draw();
}
?>