<?php

namespace App\Trait\Entity;

use Doctrine\ORM\Mapping as ORM;

trait HasSoftDelete
{
    #[ORM\Column]
    private ?\DateTimeImmutable $deletedAt = null;

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}