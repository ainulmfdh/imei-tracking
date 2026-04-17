<x-app-layout>

<!-- ✅ WAJIB: pastikan ini ada di <head> layout utama -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="min-h-screen bg-gray-100 flex items-start sm:items-center justify-center p-3 sm:p-4">

<div class="w-full max-w-md mx-auto bg-white rounded-2xl shadow-lg p-4 sm:p-5">

    <!-- HEADER -->
    <div class="text-center mb-4">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Scan IMEI</h2>
        <p class="text-xs sm:text-sm text-gray-500">Arahkan kamera ke barcode</p>
    </div>

    <!-- SCANNER -->
    <div class="relative">
        <!-- ✅ FIX: aspect ratio biar stabil -->
        <div id="reader" class="w-full rounded-xl overflow-hidden border aspect-video"></div>

        <!-- overlay scan (responsive) -->
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-3/4 h-20 sm:w-64 sm:h-28 border-2 border-green-500 rounded-lg animate-pulse"></div>
        </div>
    </div>

    <!-- RESULT -->
    <div class="mt-4 bg-gray-50 rounded-xl p-3 sm:p-4 shadow-sm border">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-sm">

            <div class="text-gray-500">IMEI</div>
            <div id="imei" class="font-semibold text-gray-800 text-left sm:text-right break-all">-</div>

            <div class="text-gray-500">Nama</div>
            <div id="user" class="font-semibold text-gray-800 text-left sm:text-right">-</div>

            <div class="text-gray-500">Lokasi</div>
            <div id="location" class="font-semibold text-gray-800 text-left sm:text-right">-</div>

            <div class="text-gray-500">Status</div>
            <div id="status" class="text-left sm:text-right">
                <span class="px-2 py-1 rounded-full text-xs bg-gray-300 text-gray-700">
                    -
                </span>
            </div>

        </div>
    </div>

    <!-- INPUT -->
    <div class="mt-4">
        <input 
            type="text" 
            id="imei_input" 
            placeholder="Masukkan IMEI..."
            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none mb-2"
        >

        <button 
            onclick="searchIMEI()" 
            class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold shadow">
            Cari Manual
        </button>
    </div>

</div>

</div>

<!-- FIX KHUSUS html5-qrcode -->
<style>
#reader video {
    width: 100% !important;
    height: auto !important;
    border-radius: 12px;
}

#reader {
    max-height: 260px;
}
</style>

<!-- SOUND -->
<audio id="beep" src="https://www.soundjay.com/buttons/beep-07.mp3" preload="auto"></audio>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

let lastScan = "";
let isProcessing = false;

const html5QrCode = new Html5Qrcode("reader");

function startScanner(){
html5QrCode.start(
{ facingMode: "environment" },
{
fps: 10,
qrbox: { width: 250, height: 120 },
aspectRatio: 1.777
},
onScanSuccess
);
}

function onScanSuccess(decodedText){

if(isProcessing) return;

let numbers = decodedText.replace(/\D/g,'');
let matches = numbers.match(/\d{15}/g);

if(!matches) return;

let imei = matches[0];
if(imei === lastScan) return;

lastScan = imei;
isProcessing = true;

html5QrCode.stop().then(()=>{

document.getElementById("beep").play();
document.getElementById("reader").classList.add("ring-4","ring-green-400");

processIMEI(imei);

setTimeout(()=>{
document.getElementById("reader").classList.remove("ring-4","ring-green-400");
isProcessing = false;
startScanner();
}, 2000);

});

}

function processIMEI(imei){

document.getElementById("imei").innerText = imei;

fetch('/find',{
method:'POST',
headers:{
'Content-Type':'application/json',
'X-CSRF-TOKEN':'{{ csrf_token() }}'
},
body: JSON.stringify({ imei })
})
.then(res => res.json())
.then(data => {

if(data && Object.keys(data).length > 0){

document.getElementById("user").innerText = data.user_name ?? '-';
document.getElementById("location").innerText = data.location ?? '-';

let status = data.status ?? '-';
let color = "bg-gray-300 text-gray-700";

if(status === "dipakai"){
color = "bg-green-100 text-green-700";
}else if(status === "tidak dipakai"){
color = "bg-red-100 text-red-700";
}

document.getElementById("status").innerHTML = `
<span class="px-2 py-1 rounded-full text-xs ${color}">
${status}
</span>
`;

}else{
document.getElementById("user").innerText = "Tidak ditemukan";
}

});

}

window.searchIMEI = function(){

let imei = document.getElementById("imei_input").value.trim();

if(!/^\d{15}$/.test(imei)){
alert("IMEI harus 15 digit");
return;
}

processIMEI(imei);

}

startScanner();

});
</script>

</x-app-layout>