<?php

namespace App\Api\Tasks;

class Task
{
    private string      $id;
    private string      $text = '';
    private bool        $checked = false;
    private \DateTime   $createdAt;
    private \DateTime   $updatedAt;

    public function __construct(array $data = null)
    {
        if (isset($data)) {
            $this->setId($data['id']);
            $this->setText($data['text']);
            $this->setChecked($data['checked']);
            $this->setCreatedAtFromTimestamp($data['createdAt']);
            $this->setUpdatedAtFromTimestamp($data['updatedAt']);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getChecked(): bool
    {
        return $this->checked;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setCreatedAtFromTimestamp(int $timestamp): self
    {
        $this->createdAt = new \DateTime('@' . intval($timestamp / 1000));

        return $this;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setUpdatedAtFromTimestamp(int $timestamp): self
    {
        $this->updatedAt = new \DateTime('@' . intval($timestamp / 1000));

        return $this;
    }
}
