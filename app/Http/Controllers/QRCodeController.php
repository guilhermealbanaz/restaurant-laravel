<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;
use Illuminate\Support\Str;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qrCodes = QrCode::orderBy('table_number')->get();
        return view('admin.qrcodes.index', compact('qrCodes'));
    }

    public function create()
    {
        return view('admin.qrcodes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $code = Str::random(10);
        
        QrCode::create([
            'table_number' => $validated['table_number'],
            'code' => $code,
            'active' => $validated['active'] ?? true,
        ]);

        return redirect()->route('admin.qrcodes.index')
            ->with('success', 'QR Code criado com sucesso.');
    }

    public function show(QrCode $qrCode)
    {
        return view('admin.qrcodes.show', compact('qrCode'));
    }

    public function edit(QrCode $qrCode)
    {
        return view('admin.qrcodes.edit', compact('qrCode'));
    }

    public function update(Request $request, QrCode $qrCode)
    {
        $validated = $request->validate([
            'table_number' => 'required|string|max:255',
            'active' => 'boolean',
        ]);

        $qrCode->update([
            'table_number' => $validated['table_number'],
            'active' => $validated['active'] ?? true,
        ]);

        return redirect()->route('admin.qrcodes.index')
            ->with('success', 'QR Code atualizado com sucesso.');
    }

    public function destroy(QrCode $qrCode)
    {
        $qrCode->delete();

        return redirect()->route('admin.qrcodes.index')
            ->with('success', 'QR Code excluído com sucesso.');
    }

    /**
     * vai gerar o qrcode como imagem
     */
    public function generate(QrCode $qrCode)
    {
        try {
            // gera a url absoluta para o menu da mesa
            $url = route('menu.table', ['code' => $qrCode->code]);
            
            $qrCodeImage = QrCodeGenerator::format('png')
                ->size(300)
                ->margin(1)
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->errorCorrection('H')
                ->generate($url);
            
            // retorna a imagem com cabeçalhos apropriados para exibição e cache
            return response($qrCodeImage)
                ->header('Content-Type', 'image/png')
                ->header('Cache-Control', 'public, max-age=604800'); // cache por 1 semana
        } catch (\Exception $e) {
            \Log::error('Erro ao gerar QR code: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Não foi possível gerar o QR Code',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function print(QrCode $qrCode)
    {
        return view('admin.qrcodes.print', compact('qrCode'));
    }

    public function validateCode($code)
    {
        $qrCode = QrCode::where('code', $code)
            ->where('active', true)
            ->first();
            
        if (!$qrCode) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code inválido',
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'table_number' => $qrCode->table_number,
        ]);
    }

    public function generateBase64(QrCode $qrCode)
    {
        try {
            $url = route('menu.table', ['code' => $qrCode->code]);
            
            $qrCodeImage = QrCodeGenerator::format('png')
                ->size(300)
                ->margin(1)
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->errorCorrection('H')
                ->generate($url);
            
            $base64 = 'data:image/png;base64,' . base64_encode($qrCodeImage);
            
            return response()->json([
                'success' => true,
                'base64' => $base64,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro ao gerar QR code base64: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Não foi possível gerar o QR Code',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 