<?php
// Sobre
?>
<section class="fade-in">
    <div class="mx-auto grid max-w-6xl gap-10 px-6 py-16 lg:grid-cols-2">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Sobre</p>
            <h1 class="mt-4 text-4xl font-semibold text-white">Profissional de marketing, CRM e tecnologia.</h1>
            <p class="mt-6 text-lg text-slate-300">
                Atuo na construção de operações de marketing que conectam estratégia, dados e tecnologia. Minha atuação inclui implantação de CRM, criação de sites e sistemas e melhoria contínua de processos.
            </p>
            <p class="mt-4 text-slate-300">
                O objetivo é entregar clareza e eficiência para times comerciais e de marketing, com foco em crescimento sustentável.
            </p>
        </div>
        <div class="rounded-3xl border border-slate-800 bg-slate-950 p-8">
            <h2 class="text-xl font-semibold text-white">Especialidades</h2>
            <ul class="mt-4 space-y-3 text-slate-300">
                <li>• Gestão de marketing e performance</li>
                <li>• CRM, automações e integrações</li>
                <li>• Desenvolvimento de sites e sistemas</li>
                <li>• Processos e analytics</li>
            </ul>
        </div>
    </div>
</section>

<section class="bg-slate-900/40">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <h2 class="text-3xl font-semibold text-white">Linha do tempo</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-2">
            <?php
            $timeline = [
                ['title' => 'Estratégia & Growth', 'desc' => 'Definição de metas, funil e indicadores de performance.'],
                ['title' => 'CRM & Automação', 'desc' => 'Implantação de CRM, integrações e jornadas personalizadas.'],
                ['title' => 'Tecnologia', 'desc' => 'Sites e sistemas voltados para conversão e eficiência.'],
                ['title' => 'Processos', 'desc' => 'Mapeamento e otimização para escala.'],
            ];
            foreach ($timeline as $item):
            ?>
                <div class="card-hover rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <p class="text-lg font-semibold text-white"><?= e($item['title']) ?></p>
                    <p class="mt-3 text-sm text-slate-400"><?= e($item['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
