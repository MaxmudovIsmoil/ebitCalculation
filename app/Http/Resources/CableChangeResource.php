<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CableChangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'cable_id' => $this->cable_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if (isset($this->old_name))
            $data['old_name'] = $this->old_name;
        if (isset($this->new_name))
            $data['new_name'] = $this->new_name;

        if (isset($this->old_remain_stock))
            $data['old_remain_stock'] = $this->old_remain_stock;
        if (isset($this->new_remain_stock))
            $data['new_remain_stock'] = $this->new_remain_stock;

        if (isset($this->old_purpose))
            $data['old_purpose'] = $this->old_purpose;
        if (isset($this->new_purpose))
            $data['new_purpose'] = $this->new_purpose;

        if (isset($this->old_expected_delivery))
            $data['old_expected_delivery'] = $this->old_expected_delivery;
        if (isset($this->new_expected_delivery))
            $data['new_expected_delivery'] = $this->new_expected_delivery;

        if (isset($this->old_applicant))
            $data['old_applicant'] = $this->old_applicant;
        if (isset($this->new_applicant))
            $data['new_applicant'] = $this->new_applicant;

        return $data;
    }
}
