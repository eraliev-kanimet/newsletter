<?php

namespace App\Http\Controllers\Api;

use App\Contracts\SendingProcess\ApiGetSendingProcessServiceInterface;
use App\Contracts\SendingProcess\CreateSendingProcessServiceInterface;
use App\Contracts\SendingProcess\UpdateSendingProcessServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SendingProcess\SendingProcessIndexRequest;
use App\Http\Requests\Api\SendingProcess\SendingProcessStoreRequest;
use App\Http\Requests\Api\SendingProcess\SendingProcessUpdateRequest;
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

    public function store(SendingProcessStoreRequest $request, CreateSendingProcessServiceInterface $service)
    {
        $service = $service->execute(
            $request->validated(),
            $request->boolean('run_now')
        );

        return $this->show($service->get());
    }

    public function update(SendingProcessUpdateRequest $request, SendingProcess $sendingProcess, UpdateSendingProcessServiceInterface $service)
    {
        $service->set($sendingProcess);

        $service->execute($request->validated());

        return $this->show($service->get());
    }

    public function destroy(SendingProcess $sendingProcess)
    {
        $sendingProcess->delete();

        return $this->apiRes(status: 204);
    }
}
