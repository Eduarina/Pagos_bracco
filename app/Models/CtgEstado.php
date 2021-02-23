<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CtgEstado
 * 
 * @property int $id_estado
 * @property string|null $Nombre
 * 
 * @property Collection|CtgArea[] $ctg_areas
 * @property Collection|TbEmpleado[] $tb_empleados
 * @property Collection|TbProveedore[] $tb_proveedores
 *
 * @package App\Models
 */
class CtgEstado extends Model
{
	protected $table = 'ctg_estados';
	protected $primaryKey = 'id_estado';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_estado' => 'int'
	];

	protected $fillable = [
		'Nombre'
	];

	public function ctg_areas()
	{
		return $this->hasMany(CtgArea::class, 'Estado');
	}

	public function tb_empleados()
	{
		return $this->hasMany(TbEmpleado::class, 'Estado');
	}

	public function tb_proveedores()
	{
		return $this->hasMany(TbProveedore::class, 'Estado');
	}
}
