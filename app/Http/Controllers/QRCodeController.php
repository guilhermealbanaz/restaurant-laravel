<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

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
            'active' => $request->has('active'),
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
            'active' => $request->has('active'),
        ]);

        return redirect()->route('admin.qrcodes.index')
            ->with('success', 'QR Code atualizado com sucesso.');
    }

    public function destroy(QrCode $qrCode)
    {
        try {
            if (!$qrCode || !$qrCode->exists) {
                return redirect()->route('admin.qrcodes.index')
                    ->with('error', 'QR Code não encontrado.');
            }
            
            $qrCode->delete();
            
            return redirect()->route('admin.qrcodes.index', ['_' => time()])
                ->with('success', 'QR Code excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.qrcodes.index')
                ->with('error', 'Erro ao excluir QR Code: ' . $e->getMessage());
        }
    }

    /**
     * vai gerar o qrcode como imagem
     */
    public function generate(QrCode $qrCode)
    {
        try {
            // gera a url absoluta para o menu da mesa
            $url = route('menu.table', ['code' => $qrCode->code]);
            
            $renderer = new ImageRenderer(
                new RendererStyle(300, 1),
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $svgQrCode = $writer->writeString($url);
            
            return response($svgQrCode)
                ->header('Content-Type', 'image/svg+xml')
                ->header('Cache-Control', 'public, max-age=86400'); // cache por 1 dia
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'error' => 'Não foi possível gerar o QR Code',
                    'message' => $e->getMessage()
                ], 500);
            }
            
            try {
                $textImage = $this->createTextImage(
                    'QR Code para Mesa ' . $qrCode->table_number,
                    route('menu.table', ['code' => $qrCode->code])
                );
                
                return response($textImage)
                    ->header('Content-Type', 'image/png');
            } catch (\Exception $innerEx) {
                return response('Erro ao gerar QR Code: ' . $e->getMessage(), 500)
                    ->header('Content-Type', 'text/plain');
            }
        }
    }
    
    /**
     * só cria uma imagem de texto simples pra fallback
     */
    private function createTextImage($title, $url)
    {
        $img = imagecreatetruecolor(300, 300);
        
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        $blue = imagecolorallocate($img, 0, 0, 255);
        
        imagefill($img, 0, 0, $white);
        
        imagestring($img, 5, 10, 120, "QR Code indisponivel", $black);
        imagestring($img, 3, 10, 140, "Por favor use o link:", $black);
        imagestring($img, 3, 10, 160, $url, $blue);
        
        ob_start();
        imagepng($img);
        $imageData = ob_get_clean();
        
        imagedestroy($img);
        
        return $imageData;
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
} 