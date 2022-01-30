<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AsistenciaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'lastName' => $this->user->last_name,
            'id' => $this->id,
            'hora_salida' => $this->hora_salida,
            'hora_entrada' => $this->hora_entrada,
            'fecha' => $this->fecha,
            'asistio' => $this->asistio,
            'description' => $this->description,
            'description_salida' => $this->description_salida,
        ];
    }
}
