<?php
declare(strict_types=1);
namespace ParagonIE\Ionizer\Filter;

use ParagonIE\ConstantTime\Binary;
use ParagonIE\Ionizer\InputFilter;

/**
 * Class StringFilter
 * @package ParagonIE\Ionizer\Filter
 */
class StringFilter extends InputFilter
{
    /**
     * @var mixed
     */
    protected $default = '';

    /**
     * @var string
     */
    protected $pattern = '';

    /**
     * @var string
     */
    protected $type = 'string';

    /**
     * @param string $input
     * @return string
     * @throws \TypeError
     */
    public static function nonEmpty(string $input): string
    {
        if (Binary::safeStrlen($input) < 1) {
            throw new \TypeError();
        }
        return $input;
    }

    /**
     * Set a regular expression pattern that the input string
     * must match.
     *
     * @param string $pattern
     * @return self
     */
    public function setPattern(string $pattern = ''): self
    {
        if (empty($pattern)) {
            $this->pattern = '';
        } else {
            $this->pattern = '#' . \preg_quote($pattern, '#') . '#';
        }
        return $this;
    }

    /**
     * Apply all of the callbacks for this filter.
     *
     * @param mixed $data
     * @param int $offset
     * @return mixed
     * @throws \TypeError
     */
    public function applyCallbacks($data = null, int $offset = 0)
    {
        if ($offset === 0) {
            if (!empty($this->pattern)) {
                if (!\preg_match($this->pattern, $data)) {
                    throw new \TypeError(
                        \sprintf('Pattern match failed (%s).', $this->index)
                    );
                }
            }
            return parent::applyCallbacks($data, 0);
        }
        return parent::applyCallbacks($data, $offset);
    }
}
