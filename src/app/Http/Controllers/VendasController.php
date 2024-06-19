<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Venda;
use Carbon\Carbon;

class VendasController extends Controller
{
    public function index(Request $request)
    {
        $query = Venda::query();

        // Filtrar por cidade
        if ($request->filled('cidade')) {
            $query->whereRaw('LOWER(cidade) LIKE ?', ['%' . Str::lower($request->cidade) . '%']);
        }

        // Filtrar por rastreio
        if ($request->filled('rastreio')) {
            $query->where('rastreio', $request->rastreio);
        }

        // Filtrar por nome do cliente
        if ($request->filled('nome_cliente')) {
            $query->whereRaw('LOWER(nome_cliente) LIKE ?', ['%' . Str::lower($request->nome_cliente) . '%']);
        }

        // Filtrar por id da venda
        if ($request->filled('id_venda')) {
            $query->where('id', $request->id_venda);
        }

        $vendas = $query->get();
        
        return response()->json($vendas);
    }
    public function findChart(Request $request)
    {
        $query = Venda::query();

        // Filtrar por cidade
        if ($request->filled('cidade')) {
            $query->whereRaw('LOWER(cidade) LIKE ?', ['%' . Str::lower($request->cidade) . '%']);
        }

        // Filtrar por rastreio
        if ($request->filled('rastreio')) {
            $query->where('rastreio', $request->rastreio);
        }

        // Filtrar por nome do cliente
        if ($request->filled('nome_cliente')) {
            $query->whereRaw('LOWER(nome_cliente) LIKE ?', ['%' . Str::lower($request->nome_cliente) . '%']);
        }

        // Filtrar por id da venda
        if ($request->filled('id_venda')) {
            $query->where('id', $request->id_venda);
        }

        $vendas = $query->get();

        $chartVendaSituacaoData = $vendas->groupBy('status')->map(function ($vendas) {
            return ['status' => $vendas[0]->status, 'count' => $vendas->count()];
        })->values();

        $chartCountClienteData = $vendas->groupBy('nome_cliente')->map(function ($vendas) {
            return ['nome_cliente' => $vendas[0]->nome_cliente, 'count' => $vendas->count()];
        })->values();

        $chartVendaClienteData = $vendas->groupBy('nome_cliente')->map(function ($vendas) {
            return ['nome_cliente' => $vendas[0]->nome_cliente, 'total_vendas' => round($vendas->sum('valor'),2)];
        })->values();

        $chartVendaCidadeData = $vendas->groupBy('cidade')->map(function ($vendas) {
            return ['cidade' => $vendas[0]->cidade, 'total_vendas' => round($vendas->sum('valor'),2)];
        })->values();

        $chartVendaPorDiaData = $vendas->groupBy(function($date) {
            return Carbon::parse($date->data_venda)->format('d');
        })->map(function ($vendas) {
            $dados = Carbon::parse($vendas[0]->data_venda)->format('d');
            return ['data' => $dados, 'total_vendas' => round($vendas->sum('valor'),2)];
        })->sortKeys()->values();

        $chartVendaHeatmapData = $vendas->map(function ($venda) {
            $dataVenda = Carbon::parse($venda->data_venda);
            return [
                'day' => $dataVenda->format('l'), 
                'value' => $venda->valor
            ];
        })->groupBy('day')->map(function ($vendas, $day) {
            return [
                'dayOfMonth' => $day,
                'totalSales' => $vendas->sum('value')
            ];
        })->values();

        return response()->json([
            "vendasituacao" => $chartVendaSituacaoData,
            "countcliente" => $chartCountClienteData,
            "vendacliente" => $chartVendaClienteData,
            "vendacidade" => $chartVendaCidadeData,
            "vendapordia" => $chartVendaPorDiaData,
            "vendaheatmap" => $chartVendaHeatmapData
        ]);
    }
}
