import jsQR from 'jsqr';

let scannerActive = false;
let animationId = null;
let videoStream = null;

export function openScanner() {
    const modal = document.getElementById('qr-scanner-modal');
    if (!modal) return;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    startCamera();
}

export function closeScanner() {
    const modal = document.getElementById('qr-scanner-modal');
    if (modal) modal.classList.add('hidden');
    document.body.style.overflow = '';
    stopCamera();
    clearResult();
}

function startCamera() {
    const video = document.getElementById('qr-video');
    const statusEl = document.getElementById('scanner-status');

    scannerActive = true;
    statusEl.textContent = 'Memulai kamera...';

    navigator.mediaDevices.getUserMedia({
        video: { facingMode: 'environment', width: { ideal: 1280 }, height: { ideal: 720 } }
    }).then(stream => {
        videoStream = stream;
        video.srcObject = stream;
        video.setAttribute('playsinline', true);
        video.play();
        statusEl.textContent = 'Arahkan kamera ke QR Code...';
        requestAnimationFrame(scanFrame);
    }).catch(err => {
        if (location.protocol !== 'https:' && !['localhost','127.0.0.1'].includes(location.hostname)) {
            statusEl.innerHTML = '⚠️ Kamera memerlukan HTTPS.<br><span style="font-size:11px;color:#6b7280">Buka <b>chrome://flags/#unsafely-treat-insecure-origin-as-secure</b>, tambahkan URL ini, lalu Relaunch.</span>';
        } else {
            statusEl.textContent = '⚠️ Tidak bisa akses kamera: ' + err.message;
        }
    });
}

function stopCamera() {
    scannerActive = false;
    if (animationId) { cancelAnimationFrame(animationId); animationId = null; }
    if (videoStream) { videoStream.getTracks().forEach(t => t.stop()); videoStream = null; }
    const video = document.getElementById('qr-video');
    if (video) { video.srcObject = null; }
}

function scanFrame() {
    if (!scannerActive) return;
    const video = document.getElementById('qr-video');
    const canvas = document.getElementById('qr-canvas');
    if (!video || video.readyState !== video.HAVE_ENOUGH_DATA) {
        animationId = requestAnimationFrame(scanFrame);
        return;
    }

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const code = jsQR(imageData.data, imageData.width, imageData.height, {
        inversionAttempts: 'dontInvert'
    });

    if (code) {
        handleResult(code.data);
        return;
    }

    animationId = requestAnimationFrame(scanFrame);
}

function handleResult(url) {
    stopCamera();
    const resultEl = document.getElementById('scanner-result');
    const statusEl = document.getElementById('scanner-status');
    const linkEl = document.getElementById('scanner-link');

    statusEl.textContent = '✅ QR Code berhasil dibaca!';
    resultEl.classList.remove('hidden');

    // Cek apakah URL valid dan arahkan
    try {
        const parsed = new URL(url);
        linkEl.textContent = url;
        linkEl.href = url;

        // Auto-redirect ke URL hasil scan setelah 1.5 detik
        setTimeout(() => {
            window.location.href = url;
        }, 1500);
    } catch {
        linkEl.textContent = url;
        linkEl.removeAttribute('href');
        statusEl.textContent = '✅ Terbaca: ' + url;
    }
}

function clearResult() {
    const resultEl = document.getElementById('scanner-result');
    const statusEl = document.getElementById('scanner-status');
    if (resultEl) resultEl.classList.add('hidden');
    if (statusEl) statusEl.textContent = '';
}

// Init global
document.addEventListener('DOMContentLoaded', () => {
    window.openQrScanner = openScanner;
    window.closeQrScanner = closeScanner;

    document.getElementById('qr-scanner-modal')?.addEventListener('click', function(e) {
        if (e.target === this) closeScanner();
    });

    document.getElementById('scanner-retry')?.addEventListener('click', () => {
        clearResult();
        startCamera();
    });
});
