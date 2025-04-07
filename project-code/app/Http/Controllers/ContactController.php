<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{

    public function clientSubmit(Request $request)
    {
        try {
            $contact = new Contact();
            $formData = $request->all();
            $formData['ip'] = request()->ip();
            $contact->fill($formData);
            $contact->save();

            return response()->json([
                'success' => true,
                'message' => 'Contact submitted successfully!'
            ]);
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
