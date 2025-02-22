<?php

namespace Baleada\Edge;

use Illuminate\Database\Migrations\Migration as LaravelMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * [Docs](https://baleada.dev/docs/edge)
 */
class Migration extends LaravelMigration
{
    protected $table = 'edges';
    protected function columns()
    {
        return [];
    }

    private $defaultColumns = [
        'id' => 'id',
        'from_kind' => 'string',
        'from' => 'integer',
        'kind' => 'string',
        'to_kind' => 'string',
        'to' => 'integer',
    ];

    private function ensureCreateColumns(array $types): array
    {
        return collect($types)
            ->map(fn ($createColumn, $column) => (
                is_string($createColumn)
                    ? fn (Blueprint $table) => $table->$createColumn($column)
                    : $createColumn
            ))
            ->values()
            ->toArray();
    }

    public function up(): void
    {
        $createColumns = $this->ensureCreateColumns([
            ...$this->defaultColumns,
            ...$this->columns(),
        ]);

        Schema::create(
            $this->table,
            function (Blueprint $table) use ($createColumns) {
                foreach ($createColumns as $createColumn) {
                    $createColumn($table);
                }
                $table->json('profile');
                $table->timestamps();
            }
        );
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
