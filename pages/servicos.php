<?php
// Serviços
$services = [
    [
        'title' => 'Gestão de Marketing',
        'desc' => 'Planejamento estratégico, mídia, conteúdo e análise para elevar performance.',
        'icon' => '<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l7.5 7.5L21 10.5"/></svg>'
    ],
    [
        'title' => 'Implantação de CRM',
        'desc' => 'Mapeamento de funil, integrações, automação de jornada e governança de dados.',
        'icon' => '<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h9m-9 4.5h9m-9 4.5h5.25"/><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 3.75h15a.75.75 0 01.75.75v15a.75.75 0 01-.75.75h-15a.75.75 0 01-.75-.75v-15a.75.75 0 01.75-.75z"/></svg>'
    ],
    [
        'title' => 'Sites e Sistemas',
        'desc' => 'Desenvolvimento de sites modernos, sistemas internos e plataformas digitais.',
        'icon' => '<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5M3.75 8.25h16.5M5.25 12h13.5m-13.5 3h7.5"/></svg>'
    ],
    [
        'title' => 'Processos e Automação',
        'desc' => 'Padronização de processos, indicadores e automações com foco em escala.',
        'icon' => '<svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25L20.25 9.75M4.5 19.5l6-6M14.25 4.5l5.25 5.25a2.121 2.121 0 010 3l-8.25 8.25a2.121 2.121 0 01-3 0l-5.25-5.25a2.121 2.121 0 010-3L11.25 4.5a2.121 2.121 0 013 0z"/></svg>'
    ],
];
?>
<section class="fade-in">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400">Serviços</p>
        <h1 class="mt-4 text-4xl font-semibold text-white">Soluções completas para marketing e tecnologia</h1>
        <p class="mt-4 text-lg text-slate-300">Abordagem consultiva, execução ágil e foco em resultados mensuráveis.</p>
        <div class="mt-10 grid gap-6 md:grid-cols-2">
            <?php foreach ($services as $service): ?>
                <div class="card-hover rounded-2xl border border-slate-800 bg-slate-950 p-6">
                    <div class="flex items-center gap-4">
                        <span class="rounded-xl bg-slate-900 p-3 text-white"><?= $service['icon'] ?></span>
                        <div>
                            <p class="text-lg font-semibold text-white"><?= e($service['title']) ?></p>
                            <p class="mt-2 text-sm text-slate-400"><?= e($service['desc']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
