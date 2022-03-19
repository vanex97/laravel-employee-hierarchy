<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

class Employee extends Model
{
    use HasFactory, NodeTrait;

    protected $guarded = ['left', 'right'];

    public const MAXIMUM_SUBORDINATION_LEVEL = 5;

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function getLftName(): string
    {
        return 'left';
    }

    public function getRgtName(): string
    {
        return 'right';
    }

    public function getParentIdName(): string
    {
        return 'head_id';
    }

    /**
     * Specify parent id attribute mutator.
     * @throws Exception
     */
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

}
