<?php

namespace App\Services;

interface SearchServiceInterface
{
    public function index(array $docment);

    public function search($query);

    public function delete($id);

    public function update($id, array $document);
}
