<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 * @ORM\Entity(repositoryClass="App\Repository\MyClassRepository")
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utl", type="integer", nullable=false)
     */
    private $idUtl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obj", type="string", length=50, nullable=true)
     */
    private $obj;

    /**
     * @var string
     *
     * @ORM\Column(name="rec", type="string", length=200, nullable=false)
     */
    private $rec;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    public function getIdRec(): ?int
    {
        return $this->idRec;
    }

    public function getIdUtl(): ?int
    {
        return $this->idUtl;
    }

    public function setIdUtl(int $idUtl): self
    {
        $this->idUtl = $idUtl;

        return $this;
    }

    public function getObj(): ?string
    {
        return $this->obj;
    }

    public function setObj(?string $obj): self
    {
        $this->obj = $obj;

        return $this;
    }

    public function getRec(): ?string
    {
        return $this->rec;
    }

    public function setRec(string $rec): self
    {
        $this->rec = $rec;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}
