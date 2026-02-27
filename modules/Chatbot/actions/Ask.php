<?php
// $display_errors = true;
// error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// ini_set('display_errors', 1);



// ✅ Try extending Vtiger_BasicAjax instead
class Chatbot_Ask_Action extends Vtiger_Action_Controller{

    public function process(Vtiger_Request $request) {
        
        $response = new Vtiger_Response();
        
        try {
            $question = trim($request->get('question'));

            if (empty($question)) {
                $response->setResult([
                    'success' => false,
                    'reply' => 'Please enter a question'
                ]);
                $response->emit();
                return;
            }

            $apiUrl = "http://139.84.130.207:8000/ask";
            $payload = json_encode(["question" => $question]);

            $ch = curl_init($apiUrl);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false
            ]);

            $apiResponseText = curl_exec($ch);
            $error = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($error || $httpCode !== 200) {
                $response->setResult([
                    'success' => false,
                    'reply' => 'Chatbot service unavailable'
                ]);
                $response->emit();
                return;
            }

            $apiResponse = json_decode($apiResponseText, true);
            
            
            
            // $response->setResult([
            //     'success' => true,
            //     'reply' =>  $apiResponse['text'] ??  'No response from API'
            // ]);
            $response->setResult([
                'success' => true,
                'text'    => $apiResponse['answer_text'] ?? '',
                'leads'   => $apiResponse['leads'] ?? [],
                'audio'   => $apiResponse['answer_voice_base64'] ?? '',
                'count'   => $apiResponse['count'] ?? 0
            ]);

            $response->emit();
            
        } catch (Exception $e) {
            $response->setResult([
                'success' => false,
                'reply' => 'An error occurred: ' . $e->getMessage()
            ]);
            $response->emit();
        }
    }
}


// class Chatbot_Ask_Action extends Vtiger_Action_Controller {
    

//     public function checkPermission(Vtiger_Request $request) {
//         return true;
//     }

//     public function process(Vtiger_Request $request) {
//         file_put_contents('logs/chatbot_debug.log', print_r($_REQUEST, true), FILE_APPEND);
//         $question = trim($request->get('question'));

//         if (empty($question)) {
//             echo json_encode([
//                 'success' => false,
//                 'reply' => 'Please enter a question'
//             ]);
//             return;
//         }

//         $apiUrl = "http://139.84.130.207:8000/ask";

//         $payload = json_encode([
//             "question" => $question
//         ]);

//         $ch = curl_init($apiUrl);
//         curl_setopt_array($ch, [
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_POST => true,
//             CURLOPT_HTTPHEADER => [
//                 "Content-Type: application/json"
//             ],
//             CURLOPT_POSTFIELDS => $payload,
//             CURLOPT_TIMEOUT => 30
//         ]);

//         $response = curl_exec($ch);
//         $error    = curl_error($ch);
//         curl_close($ch);

//         if ($error) {
//             echo json_encode([
//                 'success' => false,
//                 'reply' => 'Chatbot service unavailable'
//             ]);
//             return;
//         }

//         $apiResponse = json_decode($response, true);

//         echo json_encode([
//             'success' => true,
//             'reply' => $apiResponse['answer'] ?? $apiResponse['reply'] ?? $response
//         ]);

//         $response = curl_exec($ch);
//         curl_close($ch);

//         $decoded = json_decode($response, true);

//         $textReply = 'Sorry, I could not understand.';

//         // CASE 1: API returns text directly
//         if (isset($decoded['reply'])) {
//             $textReply = $decoded['reply'];
//         }

//         //CASE 2: API returns audio_base64 only
//         elseif (isset($decoded['audio_base64'])) {
//             $textReply = '🔊 Audio response received. Text output not enabled.';
//         }

//         echo json_encode([
//             'success' => true,
//             'reply' => $textReply
//         ]);
//         exit;

//     }
// }
?>

