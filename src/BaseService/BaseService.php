<?php

namespace Denmarty\BaseServiceRepository\BaseService;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
abstract class BaseService
{
    /**
     * @var BaseRepository
     */
    public BaseRepositoryInterface $baseRepository;

    /**
     * @param array|null $attr
     * @return Model|Builder
     */
    public function index(array $attr = null): Model|Builder
    {
        return $this->baseRepository->index($attr);
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function getById($id): Model|Collection|Builder|array|null
    {
        return $this->baseRepository->getById($id);
    }

    /**
     * @param array $data
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder
    {
        return $this->baseRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        return $this->baseRepository->update($id, $data);
    }

    /**
     * @param string $uuid
     * @param array $data
     * @return Model|null
     */
    public function updateByUUID(string $uuid, array $data): Model|null
    {
        return $this->baseRepository->updateByUUID($uuid, $data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function updateById(int $id, array $data): Model|null
    {
        return $this->baseRepository->updateById($id, $data);
    }

    /**
     * @param array $attr
     * @param array $data
     * @return Model|Builder
     */
    public function updateOrCreate(array $attr, array $data): Model|Builder
    {
        return $this->baseRepository->updateOrCreate($attr, $data);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $data
     * @return int
     */
    public function insert(array $data): int
    {
        return $this->baseRepository->insert($data);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param array $data
     * @param array $uniqueFields
     * @param $updatedFields
     * @return int
     */
    public function upsert(array $data, array $uniqueFields, $updatedFields): int
    {
        return $this->baseRepository->upsert($data, $uniqueFields, $updatedFields);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id): bool
    {
        return $this->baseRepository->deleteById($id);
    }


    /**
     * @param string $uuid
     * @return Model|Collection|Builder|array|null
     */
    public function getByUuid(string $uuid): Model|Collection|Builder|array|null
    {
        return $this->baseRepository->getByUuid($uuid);
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public function deleteByUuid(string $uuid): bool
    {
        return $this->baseRepository->deleteByUuid($uuid);
    }

    /**
     * Получаем строку из бд по названию колонки и значению
     * @param mixed $value
     * @param string $columnName
     * @param array|null $relations
     * @param string $operator
     * @return Model|null
     */
    public function getRowByColumn(
        mixed $value,
        string $columnName = 'id',
        ?array $relations = null,
        string $operator = '='
    ): ?Model {
        return $this->index()
            ->where($columnName, $operator, $value)
            ->when($relations, function ($query) use ($relations) {
                return $query->with($relations);
            })
            ->first();
    }

    /**
     * @param int $id
     * @return string|null
     */
    public function getUuidById(int $id): string|null
    {
        return $this->baseRepository->getUuidById($id);
    }

    /**
     * @param string $uuid
     * @return int|null
     */
    public function getIdByUuid(string $uuid): int|null
    {
        return $this->baseRepository->getIdByUuid($uuid);
    }
}
