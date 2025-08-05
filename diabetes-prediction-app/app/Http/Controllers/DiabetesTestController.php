<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Inertia\Inertia;

class DiabetesTestController extends Controller
{
    public function getQuestions()
    {
        $filePath = public_path('test-questions.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Questions file not found'], 404);
        }

        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function getAnswersFormat() {
        $filePath = public_path('test-answers-format.json');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Questions file not found'], 404);
        }

        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        return response()->json($data);
    }

    public function writeResultsToSession(Request $request)
    {
        $data = $request->all();

        // Yes, No -> 1 or 0
        $binaryFields = [
            'CholCheck', 'DiffWalk', 'Fruits', 'HeartDiseaseorAttack', 'HighBP',
            'HighChol', 'HvyAlcoholConsump', 'NoDocbcCost', 'PhysActivity',
            'Smoker', 'Stroke'
        ];

        foreach ($binaryFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = $data[$field] === "Так" ? 1 : 0;
            }
        }

        // Age categories
        $age = (int) $data['Age'];
        if ($age >= 18 && $age <= 24) $data['Age'] = 1;
        elseif ($age >= 25 && $age <= 29) $data['Age'] = 2;
        elseif ($age >= 30 && $age <= 34) $data['Age'] = 3;
        elseif ($age >= 35 && $age <= 39) $data['Age'] = 4;
        elseif ($age >= 40 && $age <= 44) $data['Age'] = 5;
        elseif ($age >= 45 && $age <= 49) $data['Age'] = 6;
        elseif ($age >= 50 && $age <= 54) $data['Age'] = 7;
        elseif ($age >= 55 && $age <= 59) $data['Age'] = 8;
        elseif ($age >= 60 && $age <= 64) $data['Age'] = 9;
        elseif ($age >= 65 && $age <= 69) $data['Age'] = 10;
        elseif ($age >= 70 && $age <= 74) $data['Age'] = 11;
        elseif ($age >= 75 && $age <= 79) $data['Age'] = 12;
        elseif ($age >= 80) $data['Age'] = 13;
        else $data['Age'] = 1;

        session(['test_answers' => $data]);

        return response()->json(['status' => 'success']);
    } 

    public function showResults() {
        $data = session('test_answers');

        try {
            $client = new Client();
            $response = $client->post('http://127.0.0.1:3000/predict', [
                'json' => $data,
            ]);

            $result = json_decode($response->getBody(), true);

            // return response()->json($result);

            if ($result["probability"] < 0.35) {
                return Inertia::render('DiabetesTestResultPage', [
                    'header' => "Ризик: низький"
                ]);
            } elseif ($result["probability"] >= 0.35 && $result["probability"] <= 0.7) {
                return Inertia::render('DiabetesTestResultPage', [
                    'header' => "Ризик: середній"
                ]);
            } else {
                return Inertia::render('DiabetesTestResultPage', [
                    'header' => "Ризик: високий"
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to connect to prediction API', 'details' => $e->getMessage()], 500);
        }
    }
}
