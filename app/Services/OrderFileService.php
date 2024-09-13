<?php

namespace App\Services;

use App\Http\Resources\CableResource;
use App\Models\OrderFile;
use App\Models\CableChange;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Traits\FileTrait;

class OrderFileService
{
    use FileTrait;
    public function __construct(
        protected OrderFile $model
    ) {}

    public function getFiles(int $orderId): JsonResponse
    {
        try {
            $orders = $this->model::select(
                    'users.name',
                    'users.position',
                    'order_files.file',
                    'order_files.created_at'
                )
                ->leftJoin('users', 'users.id', '=', 'order_files.userId')
                ->orderBy('id', 'DESC')
                ->get();

            return response()->success($orders);
        } catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

    public function one(int $id): JsonResponse
    {
        try {
            $order = $this->model::findOrfail($id);
            return response()->success($order);
        }
        catch (\Exception $e) {
            return response()->fail($e->getMessage());
        }
    }

    public function store(array $data): JsonResponse
    {
        try {
            $fileName = $this->uploadFile($data['file']);
            $this->model::create([
                'orderId' => $data['userId'],
                'userId' => $data['instanceId'],
                'file' => $fileName,
            ]);
            return response()->success('ok');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function destroy(int $id): JsonResponse
    {
        try {
            $file = $this->model::findOrfail($id);
            $this->fileDelete($file->file);
            $file->delete();
            return response()->success($id);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
