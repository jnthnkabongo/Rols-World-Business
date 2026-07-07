<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport des Ventes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0 0;
        }
        .stats {
            margin-bottom: 10px;
            width: 100%;
        }
        .stats table {
            width: 100%;
            border-collapse: collapse;
        }
        .stats td {
            width: 33.33%;
            padding: 10px;
        }
        .stat-box {
            background: #f3f4f6;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-box h3 {
            margin: 0;
            color: #666;
            font-size: 10px;
        }
        .stat-box p {
            margin: 5px 0 0 0;
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #1e40af;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9fafb;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rol's World Business</h1>
        <p>Rapport des Ventes</p>
        <p>Généré le {{ date('d/m/Y H:i') }}</p>
    </div>

    <div class="stats">
        <table>
            <tr>
                <td>
                    <div class="stat-box">
                        <h3>Total Ventes</h3>
                        <p>{{ $total_ventes }}</p>
                    </div>
                </td>
                <td>
                    <div class="stat-box">
                        <h3>Somme ($)</h3>
                        <p>{{ number_format($somme_ventes, 2, ',', ' ') }} $</p>
                    </div>
                </td>
                <td>
                    <div class="stat-box">
                        <h3>Somme (FC)</h3>
                        <p>{{ number_format($somme_ventes_fc, 2, ',', ' ') }} FC</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                {{-- <th>ID Vente</th> --}}
                <th>Date</th>
                <th>Client</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Devise</th>
                <th>Vendeur</th>
            </tr>
        </thead>
        <tbody>
            @php
                $numero = 1;
            @endphp
            @foreach($liste_ventes as $vente)
                @foreach($vente->ventedetails as $detail)
                    <tr>
                        <td>{{ $numero++ }}</td>
                        {{-- <td>{{ $vente->id }}</td> --}}
                        <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</td>
                        <td>{{ $vente->client->nom_client ?? 'N/A' }}</td>
                        <td>{{ $detail->produitUnite->produit->nom ?? 'N/A' }}</td>
                        <td>{{ $detail->quantite }}</td>
                        <td>{{ number_format($vente->total, 2, ',', ' ') }}</td>
                        <td>{{ $vente->venteDevise->logo ?? '$' }}</td>
                        <td>{{ $vente->user->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Rol's World Business - Document généré automatiquement</p>
    </div>
</body>
</html>
