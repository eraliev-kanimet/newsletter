<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Message\ApiGetMessageServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Message\MessageIndexRequest;
use App\Http\Requests\Api\Message\MessageStoreRequest;
use App\Http\Requests\Api\Message\MessageUpdateRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(MessageIndexRequest $request, ApiGetMessageServiceInterface $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }

    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    public function store(MessageStoreRequest $request)
    {
        $message = Message::create($request->validated());

        return $this->show($message);
    }

    public function update(MessageUpdateRequest $request, Message $message)
    {
        $message->update($request->validated());

        return $this->show($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return $this->apiRes(status: 204);
    }
}
