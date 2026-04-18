<?php

namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/*
 * Allows a model item (post, product...) to be ordered by category.
 */
class Ordering extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orderings';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
    ];

    public $sortable = [
        'order_column_name' => 'item_order',
        'sort_when_creating' => true,
    ];

    /**
     * Get the parent orderable model (post, product, ...).
     */
    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the category that owns the order.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Synchronizes the item orders according to the linked categories.
     */
    public static function sync($item, $categories)
    {
        // Get the previous categories linked to the item.
        $olds = $item->orderings->pluck('category_id')->toArray();

        foreach ($categories as $category) {
            if (!in_array($category, $olds)) {
                // Use the name or title attribute as the item name.
                $name = (isset($item->name)) ? $item->name : $item->title;
                $ordering = Ordering::create(['category_id' => $category, 'name' => $name]);
                $item->orderings()->save($ordering);
            }
        }

	// Delete the previous categories that are no longer linked to the item.
        $olds = array_diff($olds, $categories);

        foreach ($olds as $old) {
            foreach ($item->orderings as $ordering) {
                if ($ordering->category_id == $old) {
                    $ordering->delete();
                }
            }

            $category = Category::find($old);

            // Reorder the other items in the category.
            foreach ($category->orderings as $i => $ordering) {
                $ordering->item_order = $i + 1;
                $ordering->save();
            }
        }
    }

    /**
     * Filters by the category_id field so that Spatie methods take it into account.
     */
    public function buildSortQuery()
    {
        return static::query()->where('category_id', $this->category_id);
    }
}
