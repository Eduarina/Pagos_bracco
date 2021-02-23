<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbEmpleado
 * 
 * @property int $id_empleado
 * @property string|null $Nombre
 * @property string|null $Iniciales
 * @property string|null $Pass
 * @property string|null $Correo
 * @property int|null $Estado
 * 
 * @property CtgEstado|null $ctg_estado
 * @property Collection|TbSolicitude[] $tb_solicitudes
 *
 * @package App\Models
 */
class TbEmpleado extends Model
{
	protected $table = 'tb_empleados';
	protected $primaryKey = 'id_empleado';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_empleado' => 'int',
		'Estado' => 'int'
	];

	protected $fillable = [
		'Nombre',
		'Iniciales',
		'Pass',
		'Correo',
		'Estado'
	];

	public function ctg_estado()
	{
		return $this->belongsTo(CtgEstado::class, 'Estado');
	}

	public function tb_solicitudes()
	{
		return $this->hasMany(TbSolicitude::class, 'id_empleado');
	}
}
