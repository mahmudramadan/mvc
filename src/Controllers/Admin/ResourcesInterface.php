<?php
declare(strict_types=1);

namespace App\Controllers\Admin;

/**
 * ResourcesInterface
 *
 * @package App\Controllers\Admin
 * @author Mahmoud Ramadan <engmahmmoudramadan@gmail.com>
 */
interface ResourcesInterface
{
    /**
     * insert new item
     */
    public function add();

    /**
     * get item data
     * @param int $id
     */
    public function edit(int $id);

    /**
     * update item data
     * @param int $id
     */
    public function update(int $id);

    /**
     * delete item data
     * @param int $id
     */
    public function delete(int $id);
}
