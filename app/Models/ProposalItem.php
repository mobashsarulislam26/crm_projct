<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\proposal;


class ProposalItem extends Model
{
    use HasFactory;
    protected $table='proposalitems';
    protected $primaryKey = 'id';
    protected $fillable = [
        'proposal_id',
        'item_id',
        'price',
        'qty'
        ];
  public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }
    public function Item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}