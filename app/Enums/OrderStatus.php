<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PROCESSING = 1;
    case ACCEPTED = 2;
    case DECLINED = 3;
    case COMPLETED = 4;

    public function isProcessing(): bool
    {
        return  $this === self::PROCESSING;
    }

    public function isAccepted(): bool
    {
        return  $this === self::ACCEPTED;
    }

    public function isDeclined(): bool
    {
        return  $this === self::DECLINED;
    }

    public function isCompleted(): bool
    {
        return  $this === self::COMPLETED;
    }

    public static function toArray(): array
    {
        return [
            self::PROCESSING->value,
            self::ACCEPTED->value,
            self::DECLINED->value,
            self::COMPLETED->value,
        ];
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::PROCESSING => trans('text.In Processing'),
            self::ACCEPTED => trans('text.Accepted'),
            self::DECLINED => trans('text.Declined'),
            self::COMPLETED => trans('text.Completed'),
        };
    }
}
