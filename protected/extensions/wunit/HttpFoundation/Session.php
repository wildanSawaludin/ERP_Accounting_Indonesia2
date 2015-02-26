<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\SessionStorage\SessionStorageInterface;

/**
 * Session.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @api
 */
class Session implements \Serializable
{

    protected $storage;
    protected $started;
    protected $attributes;
    protected $flashes;
    protected $oldFlashes;
    protected $closed;

    /**
     * Constructor.
     *
     * @param SessionStorageInterface $storage A SessionStorageInterface instance
     */
    public function __construct(SessionStorageInterface $storage)
    {
        $this->storage = $storage;
        $this->flashes = [];
        $this->oldFlashes = [];
        $this->attributes = [];
        $this->started = false;
        $this->closed = false;
    }

    /**
     * Starts the session storage.
     *
     * @api
     */
    public function start()
    {
        if (true === $this->started) {
            return;
        }

        $this->storage->start();

        $attributes = $this->storage->read('_symfony2');

        if (isset($attributes['attributes'])) {
            $this->attributes = $attributes['attributes'];
            $this->flashes = $attributes['flashes'];

            // flag current flash messages to be removed at shutdown
            $this->oldFlashes = $this->flashes;
        }

        $this->started = true;
    }

    /**
     * Checks if an attribute is defined.
     *
     * @param string $name The attribute name
     *
     * @return Boolean true if the attribute is defined, false otherwise
     *
     * @api
     */
    public function has($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * Returns an attribute.
     *
     * @param string $name The attribute name
     * @param mixed $default The default value
     *
     * @return mixed
     *
     * @api
     */
    public function get($name, $default = null)
    {
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : $default;
    }

    /**
     * Sets an attribute.
     *
     * @param string $name
     * @param mixed $value
     *
     * @api
     */
    public function set($name, $value)
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->attributes[$name] = $value;
    }

    /**
     * Returns attributes.
     *
     * @return array Attributes
     *
     * @api
     */
    public function all()
    {
        return $this->attributes;
    }

    /**
     * Sets attributes.
     *
     * @param array $attributes Attributes
     *
     * @api
     */
    public function replace(array $attributes)
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->attributes = $attributes;
    }

    /**
     * Removes an attribute.
     *
     * @param string $name
     *
     * @api
     */
    public function remove($name)
    {
        if (false === $this->started) {
            $this->start();
        }

        if (array_key_exists($name, $this->attributes)) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * Clears all attributes.
     *
     * @api
     */
    public function clear()
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->attributes = [];
        $this->flashes = [];
    }

    /**
     * Invalidates the current session.
     *
     * @api
     */
    public function invalidate()
    {
        $this->clear();
        $this->storage->regenerate(true);
    }

    /**
     * Migrates the current session to a new session id while maintaining all
     * session attributes.
     *
     * @api
     */
    public function migrate()
    {
        $this->storage->regenerate();
    }

    /**
     * Returns the session ID
     *
     * @return mixed  The session ID
     *
     * @api
     */
    public function getId()
    {
        if (false === $this->started) {
            $this->start();
        }

        return $this->storage->getId();
    }

    /**
     * Gets the flash messages.
     *
     * @return array
     */
    public function getFlashes()
    {
        return $this->flashes;
    }

    /**
     * Sets the flash messages.
     *
     * @param array $values
     */
    public function setFlashes($values)
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->flashes = $values;
        $this->oldFlashes = [];
    }

    /**
     * Gets a flash message.
     *
     * @param string $name
     * @param string|null $default
     *
     * @return string
     */
    public function getFlash($name, $default = null)
    {
        return array_key_exists($name, $this->flashes) ? $this->flashes[$name] : $default;
    }

    /**
     * Sets a flash message.
     *
     * @param string $name
     * @param string $value
     */
    public function setFlash($name, $value)
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->flashes[$name] = $value;
        unset($this->oldFlashes[$name]);
    }

    /**
     * Checks whether a flash message exists.
     *
     * @param string $name
     *
     * @return Boolean
     */
    public function hasFlash($name)
    {
        if (false === $this->started) {
            $this->start();
        }

        return array_key_exists($name, $this->flashes);
    }

    /**
     * Removes a flash message.
     *
     * @param string $name
     */
    public function removeFlash($name)
    {
        if (false === $this->started) {
            $this->start();
        }

        unset($this->flashes[$name]);
    }

    /**
     * Removes the flash messages.
     */
    public function clearFlashes()
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->flashes = [];
        $this->oldFlashes = [];
    }

    public function save()
    {
        if (false === $this->started) {
            $this->start();
        }

        $this->flashes = array_diff_key($this->flashes, $this->oldFlashes);

        $this->storage->write('_symfony2', [
            'attributes' => $this->attributes,
            'flashes' => $this->flashes,
        ]);
    }

    /**
     * This method should be called when you don't want the session to be saved
     * when the Session object is garbaged collected (useful for instance when
     * you want to simulate the interaction of several users/sessions in a single
     * PHP process).
     */
    public function close()
    {
        $this->closed = true;
    }

    public function __destruct()
    {
        if (true === $this->started && !$this->closed) {
            $this->save();
        }
    }

    public function serialize()
    {
        return serialize($this->storage);
    }

    public function unserialize($serialized)
    {
        $this->storage = unserialize($serialized);
        $this->attributes = [];
        $this->started = false;
    }

}