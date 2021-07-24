<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseInterface
{
    protected $model;
    protected $primaryKey;

    public function __construct($model)
    {
        $this->model = $model;
        $this->primaryKey = (new $model)->getKeyName();
    }

    /**
     * Get All Data
     * @param array $column
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Get All Data Active (Status = 1)
     * @return Collection
     */
    public function allActive()
    {
        return $this->model->where('is_deleted', '0')->get();
    }

    /**
     * Get All Data Active (Status = 1)
     * @param array $with
     * @return Collection
     */
    public function allActiveWithRelation(array $with)
    {
        return $this->model->where('is_deleted', '0')->with($with)->get();
    }

    /**
     * Insert Data
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Check Duplicated Data
     * @param array $where
     */
    public function findDuplicate(array $where)
    {
        return $this->model->where($where)->where('is_deleted', '0')->count();
    }

    /**
     * Check Duplicated Data in Edit Process
     * @param array $where
     * @param int|string $id
     */
    public function findDuplicateEdit(array $where, $id)
    {
        return $this->model->where($where)->where('is_deleted', '0')->where($this->primaryKey, '!=', $id)->count();
    }

    /**
     * Update Data
     * @param string $id
     * @param array $data
     */
    public function update($id, array $data)
    {
        return $this->model->where($this->primaryKey, $id)->update($data);
    }

    /**
     * Update Data
     * @param array $id
     * @param array $data
     */
    public function massUpdate(array $id, array $data)
    {
        return $this->model->whereIn($this->primaryKey, $id)->update($data);
    }

    /**
     * Delete One Data
     * @param int $id
     */
    public function delete(int $id)
    {
        return $this->model->where($this->primaryKey, $id)->update(['is_deleted' => '1']);
    }

    /**
     * Delete Many Data
     * @param array $id
     */
    public function massDelete(array $id)
    {
        return $this->model->whereIn($this->primaryKey, $id)->update(['is_deleted' => '1']);
    }

    /**
     * Get Data By ID
     * @param $id
     */
    public function getById($id)
    {
        return $this->model->where($this->primaryKey, $id)->get()->first();
    }

    /**
     * Get Data By Array ID
     * @param $id
     */
    public function getByArrayId(array $id)
    {
        return $this->model->whereIn($this->primaryKey, $id)->get();
    }

    /**
     * Get Primary Key of the Model
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * Get by View
     */
    public function view(string $view)
    {
        return DB::table($view)->select('*')->where('is_deleted', '0')->get();
    }
}
