<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id', 'pages','category_id', 'publisher_id', 'published_year', 'cover'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function users()
    {
    return $this->belongsToMany(User::class, 'borrowings')
                ->withPivot('id', 'borrowed_at', 'returned_at')
                ->withTimestamps();
    }

    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return Storage::url($this->cover);
        }
        
        // Imagem padrão quando não há capa
        return asset('images/default-book-cover.jpg');
    }

    // Método para deletar a imagem
    public function deleteCover()
    {
        if ($this->cover && Storage::exists($this->cover)) {
            Storage::delete($this->cover);
        }
    }

    // Evento para deletar imagem quando o livro for deletado
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            $book->deleteCover();
        });

        static::updating(function ($book) {
            // Se está atualizando e tem uma nova imagem, deleta a antiga
            if ($book->isDirty('cover') && $book->getOriginal('cover')) {
                Storage::delete($book->getOriginal('cover'));
            }
        });
    }

}
