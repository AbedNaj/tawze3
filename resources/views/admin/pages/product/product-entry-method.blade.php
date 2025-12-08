@extends('admin.layout.default')

@section('content')
    <div x-data="{ withQR: false, QrScan: false }">

        <div>
            <div x-show="!withQR && !QrScan">
                <x-admin.form.template :title="__('product.select_enter_type')">
                    <section class="space-y-6 justify-center items-center flex flex-col">
                        <x-button href="{{ route('admin.products.create') }}" :label="__('product.without_qr')" />

                        <x-button @click="withQR = true" :label="__('product.with_qr')" />
                    </section>
                </x-admin.form.template>
            </div>

            <div x-show="withQR" x-cloak>
                <x-admin.form.template :title="__('product.choose_qr_method')">
                    <section class="space-y-6 justify-center items-center flex flex-col">

                        <x-button @click="startBarcodeScanner()" :label="__('product.scan_with_camera')" />

                        <x-button @click="QrScan = true; withQR = false" :label="__('product.scan_with_external')" />

                        <div id="barcode-scanner" class="w-full max-w-md mx-auto relative" style="display: none;">
                            <div id="interactive" class="viewport w-full bg-black rounded-lg overflow-hidden"></div>
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">وجّه الكاميرا نحو الباركود أو QR Code</p>
                                <p id="scan-result" class="mt-2 text-lg font-bold text-green-600"></p>
                            </div>
                        </div>

                        <x-button @click="withQR = false; stopBarcodeScanner()" :label="__('product.go_back')" />
                    </section>
                </x-admin.form.template>
            </div>

            <div x-show="QrScan" x-cloak>
                <x-admin.form.template :title="__('product.scan_with_external')">
                    <section class="space-y-6 justify-center items-center flex flex-col">
                        <form method="get" action="{{ route('admin.products.create') }}"
                            class="space-y-6 w-full max-w-md">
                            <x-input name="qr_code" :label="__('product.scan_please')" autofocus />

                            <x-button primary type="submit" :label="__('product.submit')" />
                        </form>

                        <x-button @click="QrScan = false; withQR = true" :label="__('product.go_back')" />
                    </section>
                </x-admin.form.template>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

        <style>
            #interactive.viewport {
                position: relative;
                width: 100%;
                height: 400px;
            }

            #interactive.viewport canvas,
            #interactive.viewport video {
                width: 100%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
            }

            #interactive.viewport canvas.drawingBuffer {
                position: absolute;
                top: 0;
                left: 0;
            }

            .scanning-line {
                position: absolute;
                width: 100%;
                height: 2px;
                background: #00ff00;
                animation: scan 2s linear infinite;
                z-index: 10;
            }

            @keyframes scan {
                0% {
                    top: 0;
                }

                100% {
                    top: 100%;
                }
            }
        </style>

        <script>
            let isScanning = false;
            let detectedCodes = new Set();
            let lastDetectionTime = 0;

            function stopBarcodeScanner() {
                if (isScanning) {
                    Quagga.stop();
                    isScanning = false;
                    document.getElementById('barcode-scanner').style.display = 'none';
                    detectedCodes.clear();
                }
            }

            window.startBarcodeScanner = async function() {
                const scannerElement = document.getElementById('barcode-scanner');
                const resultElement = document.getElementById('scan-result');


                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    alert('المتصفح لا يدعم الوصول للكاميرا. يرجى استخدام متصفح حديث.');
                    return;
                }

                try {

                    const stream = await navigator.mediaDevices.getUserMedia({
                        video: true
                    });
                    stream.getTracks().forEach(track => track.stop());

                    scannerElement.style.display = 'block';
                    resultElement.textContent = '';
                    detectedCodes.clear();

                    Quagga.init({
                        inputStream: {
                            name: "Live",
                            type: "LiveStream",
                            target: document.querySelector('#interactive'),
                            constraints: {
                                width: 640,
                                height: 480,
                                facingMode: "environment" // الكاميرا الخلفية
                            }
                        },
                        decoder: {
                            readers: [
                                "ean_reader", // EAN-13, EAN-8 (الأكثر شيوعاً)
                                "ean_8_reader",
                                "code_128_reader", // Code 128
                                "code_39_reader", // Code 39
                                "code_39_vin_reader",
                                "codabar_reader",
                                "upc_reader", // UPC-A
                                "upc_e_reader", // UPC-E
                                "i2of5_reader",
                                "2of5_reader",
                                "code_93_reader"
                            ],
                            debug: {
                                drawBoundingBox: true,
                                showFrequency: true,
                                drawScanline: true,
                                showPattern: true
                            },
                            multiple: false
                        },
                        locate: true,
                        locator: {
                            patchSize: "medium",
                            halfSample: true
                        },
                        numOfWorkers: 4,
                        frequency: 10,
                        area: {
                            top: "20%",
                            right: "10%",
                            left: "10%",
                            bottom: "20%"
                        }
                    }, function(err) {
                        if (err) {
                            console.error("Error initializing Quagga:", err);
                            alert('فشل تشغيل الماسح: ' + err.message);
                            scannerElement.style.display = 'none';
                            return;
                        }

                        console.log("Quagga initialized successfully");
                        Quagga.start();
                        isScanning = true;

                        // إضافة خط المسح
                        const scanLine = document.createElement('div');
                        scanLine.className = 'scanning-line';
                        document.querySelector('#interactive').appendChild(scanLine);
                    });

                    // معالجة النتائج
                    Quagga.onDetected(function(result) {
                        const code = result.codeResult.code;
                        const format = result.codeResult.format;
                        const currentTime = Date.now();

                        // تجنب القراءات المتكررة (خلال ثانية واحدة)
                        if (currentTime - lastDetectionTime < 1000) {
                            return;
                        }

                        // التحقق من جودة القراءة
                        const errors = result.codeResult.decodedCodes
                            .filter(x => x.error !== undefined)
                            .map(x => x.error);

                        const avgError = errors.reduce((a, b) => a + b, 0) / errors.length;

                        // قبول فقط القراءات عالية الجودة
                        if (avgError > 0.15) {
                            console.log("Low quality read, skipping...");
                            return;
                        }

                        console.log("Detected:", code, "Format:", format, "Error:", avgError);

                        // تأكيد القراءة
                        if (!detectedCodes.has(code)) {
                            detectedCodes.add(code);
                            resultElement.textContent = `تم المسح: ${code} (${format})`;
                            lastDetectionTime = currentTime;

                            // الانتظار قليلاً ثم التوجيه
                            setTimeout(() => {
                                Quagga.stop();
                                isScanning = false;
                                window.location.href =
                                    "{{ route('admin.products.create') }}?qr_code=" +
                                    encodeURIComponent(code);
                            }, 500);
                        }
                    });

                    // معالجة الأخطاء أثناء العمل
                    Quagga.onProcessed(function(result) {
                        const drawingCtx = Quagga.canvas.ctx.overlay;
                        const drawingCanvas = Quagga.canvas.dom.overlay;

                        if (result) {
                            if (result.boxes) {
                                drawingCtx.clearRect(0, 0, drawingCanvas.width, drawingCanvas.height);

                                // رسم المناطق المكتشفة
                                result.boxes.filter(box => box !== result.box).forEach(box => {
                                    Quagga.ImageDebug.drawPath(box, {
                                        x: 0,
                                        y: 1
                                    }, drawingCtx, {
                                        color: "green",
                                        lineWidth: 2
                                    });
                                });
                            }

                            if (result.box) {
                                Quagga.ImageDebug.drawPath(result.box, {
                                    x: 0,
                                    y: 1
                                }, drawingCtx, {
                                    color: "#00F",
                                    lineWidth: 2
                                });
                            }

                            if (result.codeResult && result.codeResult.code) {
                                Quagga.ImageDebug.drawPath(result.line, {
                                    x: 'x',
                                    y: 'y'
                                }, drawingCtx, {
                                    color: 'red',
                                    lineWidth: 3
                                });
                            }
                        }
                    });

                } catch (err) {
                    console.error("Error:", err);
                    scannerElement.style.display = 'none';

                    let errorMsg = 'حدث خطأ في تشغيل الكاميرا:\n\n';

                    if (err.name === 'NotAllowedError') {
                        errorMsg += '✗ تم رفض الإذن للوصول للكاميرا';
                    } else if (err.name === 'NotFoundError') {
                        errorMsg += '✗ لم يتم العثور على كاميرا';
                    } else if (err.name === 'NotReadableError') {
                        errorMsg += '✗ الكاميرا قيد الاستخدام من تطبيق آخر';
                    } else {
                        errorMsg += err.message;
                    }

                    alert(errorMsg);
                }
            };

            window.addEventListener('beforeunload', stopBarcodeScanner);
        </script>
    @endsection
