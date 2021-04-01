<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

use BluePsyduck\FactorioModPortalClient\Constant\DependencyOperator;
use BluePsyduck\FactorioModPortalClient\Constant\DependencyType;

/**
 * The class representing a (parsed) dependency of a mod release.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Dependency
{
    /**
     * The regular expression to parse the dependency string.
     */
    private const REGEX_DEPENDENCY = '#^(~|\?|!|\(\?\))?[ ]*(.+?)[ ]*(?:(<|<=|=|>=|>)[ ]*([\d.]+))?$#';

    /**
     * The type of the dependency.
     * @var string
     */
    protected $type = DependencyType::MANDATORY;

    /**
     * The mod to which the dependency exists.
     * @var string
     */
    protected $mod = '';

    /**
     * The operator used for the version.
     * @var string
     */
    protected $operator = DependencyOperator::ANY;

    /**
     * The version to which the dependency exists.
     * @var Version|null
     */
    protected $version;

    /**
     * Initializes the dependency, parsing the given string.
     * @param string $dependencyString
     */
    public function __construct(string $dependencyString)
    {
        if (preg_match(self::REGEX_DEPENDENCY, $dependencyString, $match) === 1) {
            $this->type = $match[1] ?? DependencyType::MANDATORY;
            $this->mod = $match[2] ?? '';
            $this->operator = $match[3] ?? DependencyOperator::ANY;

            if (isset($match[4]) && $match[4] !== '') {
                $this->version = new Version($match[4]);
            }
        }
    }

    /**
     * Returns the type of the dependency.
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Returns the mod to which the dependency exists.
     * @return string
     */
    public function getMod(): string
    {
        return $this->mod;
    }

    /**
     * Returns the operator used for the version.
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * Returns the version to which the dependency exists.
     * @return Version|null
     */
    public function getVersion(): ?Version
    {
        return $this->version;
    }

    /**
     * Checks whether the specified version is matched by the dependency.
     * Note that this method does not pay attention to the dependency type at all.
     * @param Version $version
     * @return bool
     */
    public function isMatchedByVersion(Version $version): bool
    {
        if ($this->version === null) {
            return true;
        }

        switch ($this->operator) {
            case DependencyOperator::GREATER_THAN:
                return $version->compareTo($this->version) > 0;

            case DependencyOperator::GREATER_THAN_EQUAL:
                return $version->compareTo($this->version) >= 0;

            case DependencyOperator::EQUAL:
                return $version->compareTo($this->version) === 0;

            case DependencyOperator::LESS_THAN_EQUAL:
                return $version->compareTo($this->version) <= 0;

            case DependencyOperator::LESS_THAN:
                return $version->compareTo($this->version) < 0;

            default:
                return true;
        }
    }


    /**
     * Returns the string representation of the dependency.
     * @return string
     */
    public function __toString(): string
    {
        $result = trim("{$this->type} {$this->mod}");
        if ($this->operator !== DependencyOperator::ANY && $this->version !== null) {
            $result .= " {$this->operator} {$this->version}";
        }
        return $result;
    }
}
