<?php

namespace App\Http\Controllers\Api;

use App\Contracts\SendingProcess\ApiGetSendingProcessServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendingProcess\SendingProcessIndexRequest;
use App\Http\Resources\SendingProcessResource;
use App\Models\SendingProcess;

class SendingProcessController extends Controller
{
    public function index(SendingProcessIndexRequest $request, ApiGetSendingProcessServiceInterface $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }

    public function show(SendingProcess $sendingProcess)
    {
        return new SendingProcessResource($sendingProcess);
    }

    public function destroy(SendingProcess $sendingProcess)
    {
        $sendingProcess->delete();

        return $this->apiRes(status: 204);
    }
}
