<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected bool $showSensitiveFields = false;

    public function toArray($request): array
    {
        if (!$this->showSensitiveFields) {
            $this->resource->makeHidden(['phone', 'email']);
        }

        $data = parent::toArray($request);

        $data['bound_phone']  = (bool)$this->resource->phone;
        $data['bound_wechat'] = $this->resource->weixin_unionid || $this->resource->weixin_openid;
        $data['roles'] = RoleResource::collection($this->whenloaded('roles'));

        return $data;
    }

    public function showSensitiveFields(): static
    {
        $this->showSensitiveFields = true;

        return $this;
    }
}
