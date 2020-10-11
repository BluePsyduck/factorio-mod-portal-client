<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Entity;

/**
 * The class representing a (parsed) dependency of a mod release.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
class Dependency
{
    public const TYPE_MANDATORY = '';
    public const TYPE_OPTIONAL  = '?';
    public const TYPE_OPTIONAL_HIDDEN = '(?)';
    public const TYPE_INCOMPATIBLE = '!';

    public const OPERATOR_ANY = '';
    public const OPERATOR_EQ = '=';
    public const OPERATOR_GT = '>';
    public const OPERATOR_GTE = '>=';
    public const OPERATOR_LT = '<';
    public const OPERATOR_LTE = '<=';

    private const REGEX_DEPENDENCY = '#^(\?|!|\(\?\))?[ ]*(.+?)[ ]*(?:(<|<=|=|>=|>)[ ]*([\d.]+))?$#';

    /**
     * The type of the dependency.
     * @var string
     */
    protected $type = self::TYPE_MANDATORY;

    /**
     * The mod to which the dependency exists.
     * @var string
     */
    protected $mod = '';

    /**
     * The operator used for the version.
     * @var string
     */
    protected $operator = self::OPERATOR_ANY;

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
            $this->type = $match[1] ?? self::TYPE_MANDATORY;
            $this->mod = $match[2] ?? '';
            $this->operator = $match[3] ?? self::OPERATOR_ANY;

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
            case self::OPERATOR_GT:
                return $version->compareTo($this->version) > 0;

            case self::OPERATOR_GTE:
                return $version->compareTo($this->version) >= 0;

            case self::OPERATOR_EQ:
                return $version->compareTo($this->version) === 0;

            case self::OPERATOR_LTE:
                return $version->compareTo($this->version) <= 0;

            case self::OPERATOR_LT:
                return $version->compareTo($this->version) < 0;

            default:
                return true;
        }
    }
}
