<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $payment->order_id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        @media print {
            body { 
                margin: 0; 
                padding: 0; 
                font-size: 11px;
            }
            .no-print { 
                display: none !important; 
            }
            .receipt-container { 
                border: none !important; 
                box-shadow: none !important;
                max-width: 80mm !important;
                margin: 0 !important;
                padding: 8px !important;
            }
            .qrcode-section { 
                page-break-inside: avoid;
            }
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .receipt-container {
            max-width: 80mm;
            margin: 20px auto;
            padding: 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-family: 'Courier New', monospace;
        }
        
        .store-header {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ccc;
            margin-bottom: 10px;
        }
        
        .store-name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 2px;
        }
        
        .store-info {
            font-size: 10px;
            color: #666;
            margin-bottom: 2px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 11px;
        }
        
        .info-label {
            font-weight: bold;
        }
        
        .divider {
            border-top: 1px dashed #ccc;
            margin: 8px 0;
        }
        
        .section-title {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            margin: 8px 0;
            background-color: #f8f9fa;
            padding: 3px;
        }
        
        .total-section {
            background-color: #f8f9fa;
            padding: 8px;
            margin: 10px 0;
            border-radius: 3px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 13px;
        }
        
        .qrcode-section {
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            border: 1px dashed #ddd;
            border-radius: 5px;
        }
        
        .qrcode {
            max-width: 150px;
            height: auto;
        }
        
        .footer-note {
            text-align: center;
            font-size: 9px;
            color: #666;
            margin-top: 10px;
            padding-top: 8px;
            border-top: 1px dashed #ccc;
        }
        
        .badge {
            font-size: 9px;
            padding: 2px 6px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        
        @media (max-width: 576px) {
            .receipt-container {
                margin: 10px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Sedang membuat PDF, harap tunggu...</p>
            <small class="text-muted">Proses mungkin memakan waktu beberapa detik</small>
        </div>
    </div>
    
    <div class="container my-4">
        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mb-3 no-print">
            <a href="{{ route('payment.history') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <div class="action-buttons">
                <button onclick="printReceipt()" class="btn btn-primary btn-sm">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <button onclick="downloadAsPDF()" class="btn btn-success btn-sm">
                    <i class="bi bi-download"></i> Unduh PDF
                </button>
            </div>
        </div>
        
        <!-- Receipt -->
        <div class="receipt-container" id="receiptContent">
            <!-- Store Header -->
            <div class="store-header">
                <div class="store-name">FANESYA PHOTO STUDIO</div>
                <div class="store-info">Studio Fotografi Profesional</div>
                <div class="store-info">Indramayu | Telp: 0812-3456-7890</div>
            </div>
            
            <!-- Transaction Info -->
            <div class="section-title">INFORMASI TRANSAKSI</div>
            <div class="info-row">
                <span class="info-label">Order ID:</span>
                <span>{{ $payment->order_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal:</span>
                <span>{{ $payment->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span>
                    @if($payment->status === 'paid')
                        <span class="badge bg-success">LUNAS</span>
                    @else
                        <span class="badge bg-warning text-dark">PENDING</span>
                    @endif
                </span>
            </div>
            
            <div class="divider"></div>
            
            <!-- Order Details -->
            <div class="section-title">DETAIL PESANAN</div>
            
            <div class="info-row">
                <span class="info-label">Paket Foto:</span>
                <span>{{ ucfirst($payment->booking->package_name) }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Booking ID:</span>
                <span>#{{ $payment->booking->id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Bayar:</span>
                <span>{{ $payment->metode }}</span>
            </div>
            @if($payment->transaction_id)
            <div class="info-row">
                <span class="info-label">ID Transaksi:</span>
                <span>{{ $payment->transaction_id }}</span>
            </div>
            @endif
            
            <div class="divider"></div>
            
            <!-- Total Amount -->
            <div class="total-section">
                <div class="total-row">
                    <span>TOTAL PEMBAYARAN:</span>
                    <span>Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <!-- QR Code -->
            @php
                // Data untuk QR Code
                $qrData = json_encode([
                    'order_id' => $payment->order_id,
                    'amount' => $payment->gross_amount,
                    'date' => $payment->created_at->format('Y-m-d H:i:s'),
                    'package' => $payment->booking->package_name,
                    'status' => $payment->status
                ]);
                
                // Generate QR Code URL
                $qrCodeUrl = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=" . urlencode($qrData) . "&choe=UTF-8";
            @endphp
            
            <div class="qrcode-section">
                <div class="section-title">KODE QR (QR Code)</div>
                <img src="{{ $qrCodeUrl }}" 
                     alt="QR Code" 
                     class="qrcode img-fluid mb-2"
                     id="qrCodeImage"
                     onerror="this.onerror=null; this.src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($payment->order_id) }}';">
                <div class="small text-muted mb-1">Scan untuk verifikasi</div>
                <div class="small font-monospace bg-light p-1 rounded">{{ $payment->order_id }}</div>
            </div>
            
            <!-- Footer Notes -->
            <div class="footer-note">
                <p class="mb-1">** STRUK INI SAH SEBAGAI BUKTI TRANSAKSI **</p>
                <p class="mb-0">Simpan untuk keperluan verifikasi</p>
                <p class="mb-0">Terima kasih atas kepercayaan Anda</p>
                <p class="mb-0">www.fanesyaphoto.com</p>
            </div>
            
            <!-- Print timestamp -->
            <div class="text-center mt-2 small text-muted">
                Dicetak: {{ now()->format('d/m/Y H:i:s') }}
            </div>
        </div>
        
        <!-- Mobile Action Buttons -->
        <div class="d-grid gap-2 d-md-none mt-3 no-print">
            <button onclick="printReceipt()" class="btn btn-primary">
                <i class="bi bi-printer"></i> Cetak Struk
            </button>
            <button onclick="downloadAsPDF()" class="btn btn-success">
                <i class="bi bi-download"></i> Unduh PDF
            </button>
            <a href="{{ route('payment.history') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    
    <!-- Load html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <script>
        // Function untuk print
        function printReceipt() {
            window.print();
        }
        
        // Function untuk download sebagai PDF
        function downloadAsPDF() {
            showLoading(true);
            
            const element = document.getElementById('receiptContent');
            const fileName = `Struk-{{ $payment->order_id }}-{{ date('YmdHis') }}.pdf`;
            
            // Options untuk PDF
            const opt = {
                margin:        [5, 5, 5, 5], // [top, left, bottom, right] in mm
                filename:      fileName,
                image:         { 
                    type: 'jpeg', 
                    quality: 0.95 
                },
                html2canvas:   { 
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff',
                    letterRendering: true,
                    allowTaint: true,
                    onclone: function(clonedDoc) {
                        // Pastikan QR Code terload di clone
                        const qrImg = clonedDoc.getElementById('qrCodeImage');
                        if (qrImg && !qrImg.complete) {
                            return new Promise(resolve => {
                                qrImg.onload = resolve;
                                qrImg.onerror = resolve;
                            });
                        }
                    }
                },
                jsPDF:         { 
                    unit: 'mm', 
                    format: 'a6', // Ukuran struk (105mm x 148mm)
                    orientation: 'portrait',
                    compress: true,
                    hotfixes: ["px_scaling"]
                },
                pagebreak:     { 
                    mode: ['avoid-all', 'css', 'legacy'] 
                },
                enableLinks:   false
            };
            
            // Generate PDF
            html2pdf().set(opt).from(element).save().then(() => {
                showLoading(false);
                showAlert('✅ PDF berhasil diunduh!', 'success');
            }).catch((error) => {
                console.error('PDF generation error:', error);
                showLoading(false);
                showAlert('❌ Gagal membuat PDF. Coba cetak dan save as PDF.', 'danger');
                
                // Fallback to print
                setTimeout(() => {
                    if (confirm('Gagal membuat PDF. Ingin mencetak sebagai alternatif?')) {
                        window.print();
                    }
                }, 1000);
            });
        }
        
        // Show/hide loading overlay
        function showLoading(show) {
            const overlay = document.getElementById('loadingOverlay');
            if (show) {
                overlay.style.display = 'flex';
            } else {
                overlay.style.display = 'none';
            }
        }
        
        // Show alert message
        function showAlert(message, type) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.custom-alert');
            existingAlerts.forEach(alert => alert.remove());
            
            const alertDiv = document.createElement('div');
            alertDiv.className = `custom-alert alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = `
                top: 20px; 
                right: 20px; 
                z-index: 9999; 
                max-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi ${type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle'} me-2"></i>
                    <div class="flex-grow-1">${message}</div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            `;
            document.body.appendChild(alertDiv);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
        
        // Auto print jika parameter print=true
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('print') === 'true') {
            setTimeout(() => {
                window.print();
            }, 500);
        }
        
        // Alternative QR Code jika Google API gagal
        function generateQRCodeFallback() {
            const qrCodeElement = document.getElementById('qrCodeImage');
            if (qrCodeElement && qrCodeElement.naturalWidth === 0) {
                qrCodeElement.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($payment->order_id) }}`;
            }
        }
        
        // Check QR Code setelah page load
        window.addEventListener('load', function() {
            setTimeout(generateQRCodeFallback, 1000);
            
            // Preload QR Code untuk PDF
            const qrImg = new Image();
            qrImg.src = document.getElementById('qrCodeImage').src;
        });
        
        // Add custom style untuk alerts
        const style = document.createElement('style');
        style.innerHTML = `
            .custom-alert {
                animation: slideInRight 0.3s ease-out;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @media print {
                @page { 
                    margin: 5mm;
                    size: 80mm auto;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>