<?php

declare(strict_types=1);

namespace BluePsyduck\FactorioModPortalClient\Constant;

/**
 * The interface holding the types of the dependencies.
 *
 * @author BluePsyduck <bluepsyduck@gmx.com>
 * @license http://opensource.org/licenses/GPL-3.0 GPL v3
 */
interface DependencyType
{
    /**
     * The dependency is mandatory and must be available for the mod to work.
     */
    public const MANDATORY = '';

    /**
     * The dependency is optional.
     */
    public const OPTIONAL = '?';

    /**
     * The dependency is optional and is not listed.
     */
    public const OPTIONAL_HIDDEN = '(?)';

    /**
     * This dependency is a conflict with the mod.
     */
    public const CONFLICT = '!';
}
