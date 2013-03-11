<?php
namespace pelish8\scanner;

class Scanner {

    /**
     * The string to scan.
     *
     * @var string
     * @access private
     */
    private $string;

    /**
     * Current position in string.
     *
     * @var int
     * @access private
     */
    private $location = 0;

    /**
     * Total length of the scanned string.
     *
     * @var int
     * @access private
     */
    private $end = 0;

    /**
     * Constructor.
     *
     * @param string $string The string to scan.
     * @access public
     */
    public function __construct ($string) {
        $this->string = $string;
        $this->end = strlen($string);
    }

    /**
     * Scan to the string for which to scan, and iclude that string.
     *
     * @param string $string The string for which to scan.
     * @access public
     */
    public function scanToString ($string) {
        $this->location = strpos($this->string, $string, $this->location) + strlen($string);
    }

    /**
     * Scan to the string for which to scan, and iclude that string.
     *
     * @param string $string The string for which to scan.
     * @access public
     */
    public function scanUpToString ($string) {
        $location = strpos($this->string, $string, $this->location);

        if ($location === false) {
            $this->location = $this->end;
        } else {
            $this->location = $location;
        }
    }

    /**
     * Return scanner location in string.
     *
     * @access public
     */
    public function location () {
        return $this->location;
    }

    /**
     * Check if the scaner is at end.
     *
     * @access public
     */
    public function isAtEnd () {
        return $this->location >= $this->end;
    }

    /**
     * Set new location from where to start scanning.
     *
     * @access public
     */
    public function setLocation ($location) {
        $this->location = $location;
    }

    /**
     * Returns the string with which the receiver was created.
     *
     * @access public
     */
    public function string () {
        return $this->string;
    }
}
