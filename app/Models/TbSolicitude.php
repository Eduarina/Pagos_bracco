<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSolicitude
 * 
 * @property int $id_solicitud
 * @property int|null $id_empleado
 * @property int|null $id_proveedor
 * @property Carbon|null $Fecha_solicitud
 * @property float|null $Monto
 * @property Carbon|null $Fecha_pago
 * @property string|null $Comprobante
 * @property int|null $Logistica
 * @property int|null $Envio
 * @property int|null $Estado
 * 
 * @property TbEmpleado|null $tb_empleado
 * @property TbProveedore|null $tb_proveedore
 *
 * @package App\Models
 */
class TbSolicitude extends Model
{
	protected $table = 'tb_solicitudes';
	protected $primaryKey = 'id_solicitud';
	public $incrementing = true;
	public $timestamps = false;

	protected $casts = [
		'id_solicitud' => 'int',
		'id_empleado' => 'int',
		'id_proveedor' => 'int',
		'Monto' => 'float',
		'Logistica' => 'int',
		'Envio' => 'int',
		'Estado' => 'int'
	];

	protected $dates = [
		'Fecha_solicitud',
		'Fecha_pago'
	];

	protected $fillable = [
		'id_empleado',
		'id_proveedor',
		'Fecha_solicitud',
		'Monto',
		'Fecha_pago',
		'Comprobante',
		'Logistica',
		'Envio',
		'Estado'
	];

	public function tb_empleado()
	{
		return $this->belongsTo(TbEmpleado::class, 'id_empleado');
	}

	public function tb_proveedore()
	{
		return $this->belongsTo(TbProveedore::class, 'id_proveedor');
	}
}
