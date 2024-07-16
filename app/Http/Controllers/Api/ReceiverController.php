<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Receiver\ApiGetReceiverServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Receiver\ReceiverIndexRequest;
use App\Http\Requests\Api\Receiver\ReceiverStoreRequest;
use App\Http\Requests\Api\Receiver\ReceiverUpdateRequest;
use App\Http\Resources\ReceiverResource;
use App\Models\Receiver;

class ReceiverController extends Controller
{
    public function index(ReceiverIndexRequest $request, ApiGetReceiverServiceInterface $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }

    public function show(Receiver $receiver)
    {
        return new ReceiverResource($receiver);
    }

    public function store(ReceiverStoreRequest $request)
    {
        $receiver = Receiver::create($request->validated());

        return $this->show($receiver);
    }

    public function update(ReceiverUpdateRequest $request, Receiver $receiver)
    {
        $receiver->update($request->validated());

        return $this->show($receiver);
    }

    public function destroy(Receiver $receiver)
    {
        $receiver->delete();

        return $this->apiRes(status: 204);
    }
}
