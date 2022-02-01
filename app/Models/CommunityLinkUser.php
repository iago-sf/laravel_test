<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityLinkUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'community_link_id'
    ];

    public function toggle()
    {
        if ($this->id) { // Comprobamos que exista el id de ese voto (en caso de no haber un voto con la relación anterior no existirá)
            $this->delete(); // Si existe de elimina el voto
        
        } else {
            $this->save(); // Si no existe se guarda el voto
        }
    }
}
