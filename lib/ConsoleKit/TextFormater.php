<?php
/**
 * ConsoleKit
 * Copyright (c) 2012 Maxime Bouroumeau-Fuseau
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Maxime Bouroumeau-Fuseau
 * @copyright 2012 (c) Maxime Bouroumeau-Fuseau
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://github.com/maximebf/ConsoleKit
 */

namespace ConsoleKit;

/**
 * Utility functions to format text
 */
class TextFormater
{
    /** @var int */
    public static $defaultIndentWidth = 1;

    /** @var int */
    protected $indentWidth = 1;

    /** @var int */
    protected $indent = 0;

    /** @var string */
    protected $quote = '';

    /** @var string */
    protected $fgColor;

    /** @var string */
    protected $bgColor;

    /**
     * Returns the text formated with the specified options
     * 
     * @param string $text
     * @param array $options
     * @return string
     */
    public static function apply($text, array $options = array())
    {
        $formater = new TextFormater($options);
        return $formater->format($text);
    }

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->indentWidth = self::$defaultIndentWidth;
        $this->setOptions($options);
    }

    /**
     * Available options:
     *  - indentWidth
     *  - indent
     *  - quote
     *  - fgcolor
     *  - bgcolor
     *
     * @param array $options
     * @return TextFormater
     */
    public function setOptions(array $options)
    {
        if (isset($options['indentWidth'])) {
            $this->setIndentWidth($options['indentWidth']);
        }
        if (isset($options['indent'])) {
            $this->setIndent($options['indent']);
        }
        if (isset($options['quote'])) {
            $this->setQuote($options['quote']);
        }
        if (isset($options['fgcolor'])) {
            $this->setFgColor($options['fgcolor']);
        }
        if (isset($options['bgcolor'])) {
            $this->setBgColor($options['bgcolor']);
        }
        return $this;
    }

    /**
     * @param int $indent
     * @return TextFormater
     */
    public function setIndentWidth($width)
    {
        $this->indentWidth = (int) $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndentWidth()
    {
        return $this->indentWidth;
    }

    /**
     * @param int $indent
     * @return TextFormater
     */
    public function setIndent($indent)
    {
        $this->indent = (int) $indent;
        return $this;
    }

    /**
     * @return int
     */
    public function getIndent()
    {
        return $this->indent;
    }

    /**
     * @param string $quote
     * @return TextFormater
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param string $color
     * @return TextFormater
     */
    public function setFgColor($color)
    {
        $this->fgColor = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getFgColor()
    {
        return $this->fgColor;
    }

    /**
     * @param string $color
     * @return TextFormater
     */
    public function setBgColor($color)
    {
        $this->bgColor = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getBgColor()
    {
        return $this->bgColor;
    }

    /**
     * Formats $text according to the formater's options
     * 
     * @param string $text
     */
    public function format($text)
    {
        $lines = explode("\n", $text);
        foreach ($lines as &$line) {
            $line = ((string) $this->quote)
                  . str_repeat(' ', $this->indent * $this->indentWidth) 
                  . $line;
        }
        return Colors::colorize(implode("\n", $lines), $this->fgColor, $this->bgColor);
    }
}
