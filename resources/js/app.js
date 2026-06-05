import './bootstrap';
import QRCode from 'qrcode';
import './scanner';

// Generate QR pada elemen dengan data-qr-url
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-qr-url]').forEach(el => {
        const url = el.getAttribute('data-qr-url');
        QRCode.toCanvas(el, url, { width: 200, margin: 1 }, err => {
            if (err) console.error(err);
        });
    });

    // Tombol download QR
    document.querySelectorAll('[data-qr-download]').forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.getAttribute('data-qr-download');
            const name = btn.getAttribute('data-qr-name') || 'qrcode';
            QRCode.toDataURL(url, { width: 400, margin: 2 }, (err, dataUrl) => {
                if (err) return;
                const a = document.createElement('a');
                a.href = dataUrl;
                a.download = `qr-${name}.png`;
                a.click();
            });
        });
    });
});
