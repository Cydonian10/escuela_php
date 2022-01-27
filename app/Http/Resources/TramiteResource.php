<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TramiteResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'apellidos' => $this->apellidos,
            'dni' => $this->dni,
            'email' => $this->email,
            'descriptcion_padre' => $this->descriptcion_padre,
            'tramite_nombre' => $this->tramite_nombre,
            'telefono' => $this->telefono,
            'archivo_padre' => $this->archivo_padre,
            'fecha' => $this->fecha,
            'tramite_estado' => $this->tramite_estado,
            'archivo_descargar_admin' => $this->archivo_descargar_admin,
            'visto' => $this->visto,
            'descriptcion_recepcionista' => $this->descriptcion_recepcionista,
        ];
    }
}
