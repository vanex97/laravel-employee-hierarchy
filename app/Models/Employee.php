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

    protected $fillable = [
        'name',
        'email',
        'position_id',
        'image_id',
        'phone_number',
        'salary',
        'employment_date'
    ];

    public const UNKNOWN_USER_ID = 0;

    public const MAXIMUM_SUBORDINATION_LEVEL = 5;

    /**
     * Supported countries in ISO 3166-1 alpha-2 compliant format.
     */
    public const PHONE_COUNTRIES = ['UA'];
    
    public const PHONE_FORMAT = 'international';

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
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

    /**
     * @param string|null $headName
     */
    public function updateHeadOrMakeRoot(string $headName = null)
    {
        if ($headName) {
            $this->appendToNode(Employee::where('name', $headName)->first());
        } else {
            $this->makeRoot();
        }
    }

}
