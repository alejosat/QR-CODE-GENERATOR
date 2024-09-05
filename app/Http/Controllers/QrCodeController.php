<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class QrCodeController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function index()
    {
        $qrCodes = QrCode::where('user_id', Auth::id())->get();
        return view('qr-codes.index', compact('qrCodes'));
    }

    public function show($id)
    {
        $qrCode = QrCode::findOrFail($id);

        return view('qr-codes.show', compact('qrCode'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $qrCodeImage = $this->qrCodeService->generateQrCode($request->url);

        $fileName = 'qr_' . time() . '.png';
        Storage::disk('public')->put($fileName, $qrCodeImage);

        QrCode::create([
            'url' => $request->url,
            'qr_code_path' => $fileName,
            'user_id' => Auth::id(),
        ]);

        // Guardar la URL del QR Code generado en la sesión
        $qrCodeImageUrl = Storage::url($fileName);

        return redirect()->route('qr-codes.index')->with([
            'success' => 'QR Code generado exitosamente',
            'qr_code_image' => $qrCodeImageUrl
        ]);
    }

    public function destroy($id)
    {
        $qrCode = QrCode::findOrFail($id);
        Storage::disk('public')->delete($qrCode->qr_code_path);
        $qrCode->delete();

        return redirect()->route('qr-codes.index')->with('success', 'QR Code deleted successfully');
    }
}
