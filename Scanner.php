<?php
namespace pelish8\scanner;

class Scanner {
    
    /**
    * Specifying search options.
    *
    * @var string
    */
    const BACKWARD_SEARCH = 'backwardSearch';
    
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
    private $length = 0;

    /**
    * Active search options.
    *
    * @var string
    * @access private
    */
    private $mask = '';

    /**
    * Active search options.
    *
    * @var string
    * @access private
    */
    private $origin = '';
    
    /**
    * Constructor.
    *
    * @param string $string The string to scan.
    * @param string $mask Specifying search options.
    * @access public
    */
    public function __construct (&$string, $mask = '') {
        if ($mask === self::BACKWARD_SEARCH) {
            // revert string
            $this->string = strrev($string);
        } else {
            $this->string = $string;
        }
        
        // save reference
        $this->origin = &$string;
        $this->length = strlen($string);
        
        // set mask for later
        $this->mask = $mask;
    }

    /**
    * Scans to the string for which to scan and include that string.
    *
    * @param string $string The string for which to scan.
    * @access public
    */
    public function scanToString ($string) {
        $location = strpos($this->string, $string, $this->location);
        
        if ($location === false) {
            $this->location = $this->length;
        } else {
            $this->location = $location + strlen($string);
        }
    }

    /**
    * Scans to the string for which to scan and do not include that string.
    *
    * @param string $string The string for which to scan.
    * @access public
    */
    public function scanUpToString ($string) {
        $location = strpos($this->string, $string, $this->location);

        if ($location === false) {
            $this->location = $this->length;
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
        if ($this->mask === self::BACKWARD_SEARCH) {
            return $this->length - $this->location - 1;
        } else {
            return $this->location;
        }
        
    }

    /**
    * Check if the scanner is at end.
    *
    * @access public
    */
    public function isAtEnd () {
        return ($this->location >= $this->length);
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
        return $this->origin;
    } 
    
    /**
    * Returns the length of scand string.
    *
    * @access public
    */
    public function length () {
        return $this->length;
    }                      
    
    /**
    * Scans the string until a character from a given string is encountered and include character.
    * 
    * @param string $charactersSet The characters up to which to scan.
    * @access public
    */
    public function scanToCharacterFromString ($charactersString) {
        $location = strcspn($this->string, $charactersString, $this->location, $this->length - $this->location);
        $this->location += $location - 1;
    }
    
    /**
    * Scans the string until a character from a given string is encountered and do not include character.
    * 
    * @param string $charactersSet The characters up to which to scan.
    * @access public
    */
    public function scanUpToCharacterFromString ($charactersString) {
        $location = strcspn($this->string, $charactersString, $this->location, $this->length - $this->location);
        $this->location += $location;
    }    
}
