<?php
<?php
namespace src\Repository;
use src\Core\JsonStorage;
use src\Model\Barang;

class BarangRepository {
    private JsonStorage $storage;
    public function __construct(JsonStorage $storage)
    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }
    /** @return Barang[] */
    /** @return Barang[] */
    public function findAll(): array
    {
        return array_map(fn($r) => Barang::fromArray($r), $this->storage->readAll());
    }
    public function findById(int $id): ?Barang
    public function findById(int $id): ?Barang
    {
        foreach ($this->storage->readAll() as $row) {
            if ((int)$row['id'] === $id) {
                return Barang::fromArray($row);
            }
        }
        return null;
    }
    /** @return Barang[] */
    /** @return Barang[] */
    public function searchByNama(string $keyword): array
    {
        $kw = mb_strtolower($keyword);
        $result = [];
        foreach ($this->storage->readAll() as $row) {
            $name = mb_strtolower((string)$row['nama']);
            if (str_contains($name, $kw)) {
                $result[] = Barang::fromArray($row);
            }
        }
        return $result;
    }
    public function nextId(): int
    public function nextId(): int
    {
        $max = 0;
        foreach ($this->storage->readAll() as $row) {
            $max = max($max, (int)$row['id']);
        }
        return $max + 1;
    }
    public function save(Barang $barang): Barang
    public function save(Barang $barang): Barang
    {
        $rows = $this->storage->readAll();
        $rows[] = $barang->toArray();
        $this->storage->writeAll($rows);
        return $barang;
    }
    public function update(Barang $barang): bool
    public function update(Barang $barang): bool
    {
        $rows = $this->storage->readAll();
        $updated = false;
        foreach ($rows as $i => $row) {
            if ((int)$row['id'] === $barang->id) {
                $rows[$i] = $barang->toArray();
                $updated = true;
                break;
            }
        }
        if ($updated) $this->storage->writeAll($rows);
        return $updated;
    }
    public function delete(int $id): bool
    public function delete(int $id): bool
    {
        $rows = $this->storage->readAll();
        $newRows = array_filter($rows, fn($row) => (int)$row['id'] !== $id);
        $deleted = count($rows) !== count($newRows);
        if ($deleted) $this->storage->writeAll(array_values($newRows));
        return $deleted;
    }
    /** Bulk replace untuk import */
    /** Bulk replace untuk import */
    public function replaceAll(array $barangList): void
    {
        $rows = array_map(fn(Barang $b) => $b->toArray(), $barangList);
        $this->storage->writeAll($rows);
    }
}
?>