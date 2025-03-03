@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Cake Days</h1>
        <table class="table-auto w-full border">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Small Cakes</th>
                    <th>Large Cakes</th>
                    <th>Names</th>
                </tr>
            </thead>
            <tbody id="cake-table"></tbody>
        </table>
    </div>

    <script>
        fetch('cake-days')
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById('cake-table');
                Object.values(data).forEach(day => {
                    table.innerHTML += `<tr>
                                     <td>${day.date}</td>
                                     <td>${day.small_cakes}</td>
                                     <td>${day.large_cakes}</td>
                                     <td>${day.people}</td>
                                    </tr>`;
                });
            });
    </script>
@endsection