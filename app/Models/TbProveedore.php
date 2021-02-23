<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbProveedore
 * 
 * @property int $id_proveedor
 * @property string|null $Nombre
 * @property string|null $Direccion
 * @property string|null $Telefono
 * @property string|null $Correo
 * @property int|null $id_area
 * @property int|null $Estado
 * 
 * @property CtgArea|null $ctg_area
 * @property CtgEstado|null $ctg_estado
 * @property Collection|TbSolicitude[] $tb_solicitudes
 *
 * @package App\Models
 */
class TbProveedore extends Model
{
	protected $table = 'tb_proveedores';
	protected $primaryKey = 'id_proveedor';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_proveedor' => 'int',
		'id_area' => 'int',
		'Estado' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'Direccion',
		'Telefono',
		'Correo',
		'id_area',
		'Estado'
	];

	public function ctg_area()
	{
		return $this->belongsTo(CtgArea::class, 'id_area');
	}

	public function ctg_estado()
	{
		return $this->belongsTo(CtgEstado::class, 'Estado');
	}

	public function tb_solicitudes()
	{
		return $this->hasMany(TbSolicitude::class, 'id_proveedor');
	}
}
