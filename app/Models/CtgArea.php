<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgArea
 * 
 * @property int $id_area
 * @property string|null $Nombre
 * @property int|null $Estado
 * 
 * @property CtgEstado|null $ctg_estado
 * @property Collection|TbProveedore[] $tb_proveedores
 *
 * @package App\Models
 */
class CtgArea extends Model
{
	protected $table = 'ctg_area';
	protected $primaryKey = 'id_area';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_area' => 'int',
		'Estado' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'Estado'
	];

	public function ctg_estado()
	{
		return $this->belongsTo(CtgEstado::class, 'Estado');
	}

	public function tb_proveedores()
	{
		return $this->hasMany(TbProveedore::class, 'id_area');
	}
}
