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
    * Scans to the string for which to scan, and include that string.
    *
    * @param string $string The string for which to scan.
    * @access public
    */
    public function scanToString ($string) {
        $location = strpos($this->string, $string, $this->location);
        
        if ($location === false) {
            $this->location = $this->end;
        } else {
            $this->location = $location + strlen($string);
        }
    }

    /**
    * Scans to the string for which to scan, and do not include that string.
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
    * Check if the scanner is at end.
    *
    * @access public
    */
    public function isAtEnd () {
        return ($this->location >= $this->end);
    }

    /**
    * Set new location from where to start scanning.
    *
    * @param int $location New location form witch to start scanning.
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
    
    /**
    * Scans the string until a character from a given string is encountered.
    * 
    * @param string $charactersSet The characters up to which to scan.
    *
    */
    public function scanUpToCharacterFromString ($charactersString) {
        $location = strcspn($this->string, $charactersString, $this->location, $this->end - $this->location);
        $this->location += $location;
    }
    
}
