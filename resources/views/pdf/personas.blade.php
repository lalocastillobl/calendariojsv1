<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body{
            font-family: sans-serif;
            font-size: 12px;
        }
        table{
            width:100%;
            border-collapse: collapse;
        }
        th,td{
            border:1px solid #000;
            padding:5px;
            text-align:center;
        }
        th{
            background:#eee;
        }
    </style>
</head>
<body>

<h2>Reporte de Personas</h2>

<table>
    <thead>
        <tr>
            <th>Num</th>
            <th>Año</th>
            <th>Periodo</th>

            <th>Lunes In</th>
            <th>Lunes Out</th>

            <th>Martes In</th>
            <th>Martes Out</th>

            <th>Miércoles In</th>
            <th>Miércoles Out</th>

            <th>Jueves In</th>
            <th>Jueves Out</th>

            <th>Viernes In</th>
            <th>Viernes Out</th>
        </tr>
    </thead>

    <tbody>
        @foreach($personas as $p)
        <tr>
            <td>{{ $p->num_trabajador }}</td>
            <td>{{ $p->anio }}</td>
            <td>{{ $p->periodo }}</td>

            <td>{{ $p->lunes_in }}</td>
            <td>{{ $p->lunes_out }}</td>

            <td>{{ $p->martes_in }}</td>
            <td>{{ $p->martes_out }}</td>

            <td>{{ $p->miercoles_in }}</td>
            <td>{{ $p->miercoles_out }}</td>

            <td>{{ $p->jueves_in }}</td>
            <td>{{ $p->jueves_out }}</td>

            <td>{{ $p->viernes_in }}</td>
            <td>{{ $p->viernes_out }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
