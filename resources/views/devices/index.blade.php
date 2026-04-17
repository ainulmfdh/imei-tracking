<x-app-layout>

<div class="p-6">

<h2 class="text-xl font-bold mb-4">Data Handphone</h2>

<table class="table-auto w-full border">

<tr>
<th class="border px-4 py-2">IMEI</th>
<th class="border px-4 py-2">User</th>
<th class="border px-4 py-2">Lokasi</th>
<th class="border px-4 py-2">Status</th>
</tr>

@foreach($devices as $d)

<tr>
<td class="border px-4 py-2">{{$d->imei}}</td>
<td class="border px-4 py-2">{{$d->user_name}}</td>
<td class="border px-4 py-2">{{$d->location}}</td>
<td class="border px-4 py-2">{{$d->status}}</td>
</tr>

@endforeach

</table>

</div>

</x-app-layout>