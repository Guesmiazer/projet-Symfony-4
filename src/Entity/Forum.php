<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Forum
 * @ORM\Entity(repositoryClass="App\Repository\ForumRepository")
 * @ORM\Table(name="forum")
 * @ORM\Entity
 */
class Forum
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_frm", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFrm;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utl", type="integer", nullable=false)
     */
    private $idUtl;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_frm", type="string", length=220, nullable=false)
     * @Assert\NotBlank(message=" Votre continue ne doit etre vide !!!")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un titre au mini de 5 caracteres"
     *
     *     )
     */
    private $contenuFrm;

    /**
     * @var int
     *
     * @ORM\Column(name="report", type="integer", nullable=false)
     */
    private $report;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=false)
     */
    private $likes;

    public function getIdFrm(): ?int
    {
        return $this->idFrm;
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

    public function getContenuFrm(): ?string
    {
        return $this->contenuFrm;
    }

    public function setContenuFrm(string $contenuFrm): self
    {
        $this->contenuFrm = $contenuFrm;

        return $this;
    }

    public function getReport(): ?int
    {
        return $this->report;
    }

    public function setReport(int $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }


}
