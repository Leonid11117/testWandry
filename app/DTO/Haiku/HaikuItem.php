<?php

namespace App\DTO\Haiku;

class HaikuItem
{
    private ?int $id = null;

    public function __construct(
        private string $name,
        private string $subject,
        private string $published,
        private string $publication_date,
        private ?int $user_id = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
    ) { }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getPublicationDate(): string
    {
        return $this->publication_date;
    }

    /**
     * @return string
     */
    public function getPublished(): string
    {
        return $this->published;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
