<?php

namespace App\Interfaces;

interface ResourcesInterface
{
    public function add();

    public function edit($id);

    public function update($id);

    public function delete($id);
}
