<?php

if (! function_exists('alert')) {
    /**
     * Set an alert.
     *
     * @param string          $key     Session key to set (see Alerts Config)
     * @param string|string[] $content
     *
     * @throws RuntimeException         For Session key collisions
     * @throws UnexpectedValueException For $key values without a corresponding Config class
     */
    function alert(string $key, $content): void
    {
        if (! isset(config('Alerts')->classes[$key])) {
            throw new UnexpectedValueException($key . ' is not a configured alert key.');
        }

        $session = service('session');
        $content = is_string($content) ? [$content] : $content;

        // If no key exists the set and quit
        if (! $session->has($key)) {
            $session->setFlashdata($key, $content);

            return;
        }

        // Need to check for a possible collision
        $value = $session->get($key);

        if (is_array($value)) {
            $session->push($key, $content);
            $session->markAsFlashdata($key);

            return;
        }

        if (is_string($value)) {
            $session->setFlashdata($key, array_merge([$value], $content));

            return;
        }

        throw new RuntimeException('Alerts has collided with a non-alert Session key: ' . $key);
    }
}
