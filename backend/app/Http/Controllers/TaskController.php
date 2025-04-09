<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $filePath = app()->basePath('app/data/tasks.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $jsonData = file_get_contents($filePath);

        $data = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON'], 400);
        }

        return response()->json($data);
    }

    public function update(Request $request, int $taskId): JsonResponse
    {
        $done = $request->input('done');

        if (is_null($done) || !in_array($done, [true, false], true)) {
            return response()->json(['error' => 'Invalid value for done. It must be true or false.'], 400);
        }

        $tasksFilePath = app()->basePath('app/data/tasks.json');
        if (!file_exists($tasksFilePath)) {
            return response()->json(['error' => 'Tasks file not found.'], 404);
        }

        $tasksJson = file_get_contents($tasksFilePath);
        $tasks = json_decode($tasksJson, true);

        $taskKey = array_search($taskId, array_column($tasks, 'id'));

        if ($taskKey === false) {
            return response()->json(['error' => 'Task not found.'], 404);
        }

        $tasks[$taskKey]['done'] = $done;

        file_put_contents($tasksFilePath, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json([
            'message' => 'Task status updated successfully.',
            'task' => $tasks[$taskKey]
        ]);
    }
}
