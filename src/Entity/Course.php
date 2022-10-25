<?php

namespace App\Entity;

class Course
{
    public int $cid;
    public string $cfull;
    public string $cshort;
    public $cstart;
    public $updateDate;


    public function __construct(int $cid, string $cfull, string $cshort, $cstart, $updateDate)
    {
        $this->cid = $cid;
        $this->cfull = $cfull;
        $this->cshort = $cshort;
        $this->cstart = $cstart;
        $this->updateDate = $updateDate;
    }

    public function getCid(): int
    {
        return $this->cid;
    }

    public function setCid(int $cid): void
    {
        $this->cid = $cid;
    }
}
