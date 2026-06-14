@push('scripts')
<script>
    const initLat = document.getElementById('latitude').value || -7.2575;
    const initLng = document.getElementById('longitude').value || 112.7521;
    const initZoom = document.getElementById('latitude').value ? 17 : 14;

    const map = L.map('map-picker').setView([parseFloat(initLat), parseFloat(initLng)], initZoom);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    // Pasang/pindahkan marker + sinkron ke input lat/lng.
    function setMarker(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(8);
        document.getElementById('longitude').value = lng.toFixed(8);
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on('dragend', ev => {
                const pos = ev.target.getLatLng();
                document.getElementById('latitude').value = pos.lat.toFixed(8);
                document.getElementById('longitude').value = pos.lng.toFixed(8);
            });
        }
        return marker;
    }

    if (document.getElementById('latitude').value) {
        marker = L.marker([parseFloat(initLat), parseFloat(initLng)], { draggable: true }).addTo(map);
        marker.on('dragend', e => {
            const pos = e.target.getLatLng();
            document.getElementById('latitude').value = pos.lat.toFixed(8);
            document.getElementById('longitude').value = pos.lng.toFixed(8);
        });
    }

    map.on('click', e => {
        document.getElementById('latitude').value = e.latlng.lat.toFixed(8);
        document.getElementById('longitude').value = e.latlng.lng.toFixed(8);
        if (marker) { marker.setLatLng(e.latlng); } else {
            marker = L.marker(e.latlng, { draggable: true }).addTo(map);
            marker.on('dragend', ev => {
                const pos = ev.target.getLatLng();
                document.getElementById('latitude').value = pos.lat.toFixed(8);
                document.getElementById('longitude').value = pos.lng.toFixed(8);
            });
        }
    });

    // Sync manual input ke peta
    ['latitude', 'longitude'].forEach(id => {
        document.getElementById(id).addEventListener('change', () => {
            const lat = parseFloat(document.getElementById('latitude').value);
            const lng = parseFloat(document.getElementById('longitude').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                if (marker) { marker.setLatLng([lat, lng]); } else {
                    marker = L.marker([lat, lng], { draggable: true }).addTo(map);
                }
                map.setView([lat, lng], 17);
            }
        });
    });

    async function cariAlamat() {
        const input = document.getElementById('alamat-search');
        const query = input.value.trim();
        if (!query) return;

        const btn = input.nextElementSibling;
        const origText = btn.textContent;
        btn.textContent = 'Mencari...';
        btn.disabled = true;

        try {
            const res = await fetch(
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1&countrycodes=id`,
                { headers: { 'Accept-Language': 'id' } }
            );
            const data = await res.json();

            if (!data.length) {
                alert('Alamat tidak ditemukan. Coba lebih spesifik, contoh: "Jl. Mojo Surabaya".');
                return;
            }

            const lat = parseFloat(data[0].lat);
            const lng = parseFloat(data[0].lon);

            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], { draggable: true }).addTo(map);
                marker.on('dragend', ev => {
                    const pos = ev.target.getLatLng();
                    document.getElementById('latitude').value = pos.lat.toFixed(8);
                    document.getElementById('longitude').value = pos.lng.toFixed(8);
                });
            }
            map.setView([lat, lng], 17);
            marker.bindPopup(data[0].display_name).openPopup();
        } catch (e) {
            alert('Gagal mencari alamat. Periksa koneksi internet.');
        } finally {
            btn.textContent = origText;
            btn.disabled = false;
        }
    }

    // Ambil lokasi perangkat saat ini (butuh izin lokasi + HTTPS/localhost).
    function gunakanLokasiSaatIni(btn) {
        if (!('geolocation' in navigator)) {
            alert('Perangkat/browser ini tidak mendukung deteksi lokasi.');
            return;
        }
        const origHtml = btn ? btn.innerHTML : null;
        if (btn) { btn.disabled = true; btn.textContent = 'Mendeteksi lokasi...'; }

        navigator.geolocation.getCurrentPosition(
            pos => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                setMarker(lat, lng);
                map.setView([lat, lng], 17);
                marker.bindPopup('📍 Lokasi Anda saat ini').openPopup();
                if (btn) { btn.disabled = false; btn.innerHTML = origHtml; }
            },
            err => {
                let msg = 'Gagal mendeteksi lokasi.';
                if (err.code === 1) msg = 'Akses lokasi ditolak. Izinkan akses lokasi di pengaturan browser, lalu coba lagi.';
                else if (err.code === 2) msg = 'Lokasi tidak tersedia saat ini. Coba lagi atau gunakan pencarian alamat.';
                else if (err.code === 3) msg = 'Deteksi lokasi terlalu lama. Coba lagi.';
                alert(msg);
                if (btn) { btn.disabled = false; btn.innerHTML = origHtml; }
            },
            { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
        );
    }
</script>
@endpush
