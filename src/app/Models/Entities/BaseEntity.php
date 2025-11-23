<?php

namespace App\Models\Entities;

/**
 * BaseEntity
 *
 * A lightweight base class for database-backed entity objects. Provides
 * attribute storage, mass-assignment, array/JSON conversion and simple
 * dirty-tracking. Other entity classes should extend this.
 */
class BaseEntity
{
	/**
	 * Internal attribute storage.
	 *
	 * @var array<string,mixed>
	 */
	protected array $attributes = [];

	/**
	 * Snapshot of original attributes used for dirty checking.
	 *
	 * @var array<string,mixed>
	 */
	protected array $original = [];

	/**
	 * Optional primary id. Type flexible because different tables use int|string.
	 *
	 * @var int|string|null
	 */
	protected int|string|null $id = null;

	public function __construct(array $attributes = [])
	{
		$this->fill($attributes);
		$this->original = $this->attributes;
	}

	/**
	 * Create a new entity from an array.
	 */
	public static function fromArray(array $data): static
	{
		return new static($data);
	}

	/**
	 * Mass assign attributes.
	 *
	 * @param array<string,mixed> $attributes
	 */
	public function fill(array $attributes): static
	{
		foreach ($attributes as $key => $value) {
			if ($key === 'id') {
				$this->setId($value);
				continue;
			}
			$this->attributes[$key] = $value;
		}

		return $this;
	}

	/**
	 * Merge attributes into the existing set (keeps existing keys not present in given array).
	 *
	 * @param array<string,mixed> $attributes
	 */
	public function mergeAttributes(array $attributes): static
	{
		$this->attributes = array_merge($this->attributes, $attributes);

		return $this;
	}

	/**
	 * Set a single attribute.
	 *
	 * @param string $key
	 * @param mixed $value
	 */
	public function setAttribute(string $key, mixed $value): static
	{
		if ($key === 'id') {
			$this->setId($value);
			return $this;
		}

		$this->attributes[$key] = $value;

		return $this;
	}

	/**
	 * Get a single attribute, or default if not present.
	 *
	 * @param mixed $default
	 * @return mixed
	 */
	public function getAttribute(string $key, mixed $default = null): mixed
	{
		if ($key === 'id') {
			return $this->getId() ?? $default;
		}

		return array_key_exists($key, $this->attributes) ? $this->attributes[$key] : $default;
	}

	/**
	 * Remove an attribute.
	 */
	public function removeAttribute(string $key): static
	{
		if ($key === 'id') {
			$this->id = null;
			return $this;
		}

		unset($this->attributes[$key]);

		return $this;
	}

	/**
	 * Check if an attribute exists.
	 */
	public function hasAttribute(string $key): bool
	{
		if ($key === 'id') {
			return $this->id !== null;
		}

		return array_key_exists($key, $this->attributes);
	}

	/**
	 * Get all attributes as an array. Includes `id` when set.
	 *
	 * @return array<string,mixed>
	 */
	public function toArray(): array
	{
		$data = $this->attributes;

		if ($this->id !== null) {
			$data['id'] = $this->id;
		}

		return $data;
	}

	/**
	 * Return JSON representation.
	 */
	public function toJson(int $options = 0): string
	{
		return json_encode($this->toArray(), $options) ?: '{}';
	}

	/**
	 * Get the primary id.
	 *
	 * @return int|string|null
	 */
	public function getId(): int|string|null
	{
		return $this->id;
	}

	/**
	 * Set the primary id.
	 *
	 * @param int|string|null $id
	 */
	public function setId(int|string|null $id): static
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get all attributes (without id).
	 *
	 * @return array<string,mixed>
	 */
	public function getAttributes(): array
	{
		return $this->attributes;
	}

	/**
	 * Replace all attributes (except id).
	 *
	 * @param array<string,mixed> $attributes
	 */
	public function setAttributes(array $attributes): static
	{
		$this->attributes = $attributes;

		return $this;
	}

	/**
	 * Determine if the entity has changed since construction/freeze.
	 */
	public function isDirty(): bool
	{
		return $this->getDirty() !== [];
	}

	/**
	 * Get attributes that have changed compared to the original snapshot.
	 *
	 * @return array<string,mixed>
	 */
	public function getDirty(): array
	{
		$dirty = [];

		foreach ($this->attributes as $key => $value) {
			if (!array_key_exists($key, $this->original) || $this->original[$key] !== $value) {
				$dirty[$key] = $value;
			}
		}

		if ($this->id !== null && (!array_key_exists('id', $this->original) || $this->original['id'] !== $this->id)) {
			$dirty['id'] = $this->id;
		}

		return $dirty;
	}

	/**
	 * Reset the original snapshot to the current attributes (mark as clean).
	 */
	public function syncOriginal(): static
	{
		$this->original = $this->toArray();

		return $this;
	}

	/**
	 * Magic accessors to make the entity feel like an object.
	 */
	public function __get(string $name)
	{
		return $this->getAttribute($name);
	}

	public function __set(string $name, $value): void
	{
		$this->setAttribute($name, $value);
	}

	public function __isset(string $name): bool
	{
		return $this->hasAttribute($name);
	}

	public function __unset(string $name): void
	{
		$this->removeAttribute($name);
	}
}

