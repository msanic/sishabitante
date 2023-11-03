@extends('template.admin')

@section('content')
<style>
    .beige-bg {
        background-color: #f5f5dc;
        color: #333;
    </style>
</style>

<div class="container mt-5 beige-bg">
    <div class="row">
        <!-- Menú de navegación -->
        <div class="col-md-3">
            <div class="list-group">
                
                <a href="#grafico-habitantes" class="list-group-item list-group-item-action">Gráfico de Habitantes por Paraje</a>
                
            </div>
        </div>

        <!-- Contenido del panel de control -->
        <div class="col-md-9">
            <h1>HABITANTES REGISTRADOS</h1>

            <!-- Sección de Resumen -->
            <section id="resumen">
                <h2>Resumen</h2>
                <p>Total de Habitantes Registrados: <span class="h4">{{ $totalHabitantes }}</span></p>
            </section>

            <!-- Gráfico de Habitantes por Paraje -->
            <section id="grafico-habitantes">
                <h2>Gráfica de Habitantes por Paraje</h2>
                <div id="legendaHabitantes"></div>
                <canvas id="graficoHabitantes"></canvas>
               
            </section>

            <!-- Script para crear el gráfico -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var habitantesPorParaje = @json($habitantesPorParaje); // Convierte los datos de PHP a JavaScript

                    var labels = habitantesPorParaje.map(function (informe) {
                        return informe.Paraje;
                    });

                    var cantidades = habitantesPorParaje.map(function (informe) {
                        return informe.cantidad;
                    });

                    var totalHabitantes = cantidades.reduce(function (total, cantidad) {
                        return total + cantidad;
                    }, 0);

                    var data = cantidades;

                    var ctx = document.getElementById('graficoHabitantes').getContext('2d');
                    var graficoHabitantes = new Chart(ctx, {
                        type: 'doughnut', // Gráfico de anillo
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(153, 102, 255, 0.7)',
                                    'rgba(255, 159, 64, 0.7)',
                                    // Puedes agregar más colores si tienes más datos
                                ],
                            }],
                        },
                    });

                    // Agregar leyenda
                    var legenda = document.getElementById('legendaHabitantes');
                    labels.forEach(function (paraje, index) {
                        var item = document.createElement('div');
                        item.innerHTML = paraje + ': ' + cantidades[index];
                        legenda.appendChild(item);
                    });
                });
            </script>

            <!-- Otras secciones de contenido -->
        </div>
    </div>
</div>
@endsection
