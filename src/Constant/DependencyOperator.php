<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Constant;

/**
 * The interface holding the operators for the dependency version comparison.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface DependencyOperator
{
    /**
     * The dependency does not specify any version.
     */
    public const ANY = '';

    /**
     * The dependency specifies an exact version.
     */
    public const EQUAL = '=';

    /**
     * The dependency specifies a minimum version (exclusive).
     */
    public const GREATER_THAN = '>';

    /**
     * The dependency specifies a minimum version (inclusive).
     */
    public const GREATER_THAN_EQUAL = '>=';

    /**
     * The dependency specifies a maximum version (exclusive).
     */
    public const LESS_THAN = '<';

    /**
     * The dependency specifies a maximum version (inclusive).
     */
    public const LESS_THAN_EQUAL = '<=';
}
