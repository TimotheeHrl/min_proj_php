<?php

namespace App\Entity;

class Course
{
    public int $cid;
    public string $cfull;
    public string $cshort;
    public  $cstart;
    public  $update_date;


    public function __construct(int $cid, string $cfull, string $cshort, $cstart, $update_date)
    {
        $this->cid = $cid;
        $this->cfull = $cfull;
        $this->cshort = $cshort;
        $this->cstart = $cstart;
        $this->update_date = $update_date;
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
