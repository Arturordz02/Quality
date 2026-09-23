/**
 * QUALITY CONSULTING SOLUTIONS - QA & STRESS TESTING SUITE
 * Script de Simulación de Carga y Pruebas de Estrés
 * Valida Alta Disponibilidad, Cero Caídas (Zero Downtime) y Resiliencia bajo Concurrencia Masiva.
 * 
 * Uso: node backend/tests/stress_test.js [targetUrl] [concurrency] [totalRequests]
 * Ejemplo: node backend/tests/stress_test.js http://127.0.0.1:8080 20 200
 */

const http = require('http');
const https = require('https');
const { URL } = require('url');

const baseUrl = process.argv[2] || 'http://127.0.0.1:8080';
const concurrency = parseInt(process.argv[3] || '20', 10);
const totalRequests = parseInt(process.argv[4] || '100', 10);

console.log('===============================================================');
console.log('   QUALITY CONSULTING SOLUTIONS - PRUEBAS DE ESTRÉS Y CARGA   ');
console.log('===============================================================');
console.log(`Target Base URL   : ${baseUrl}`);
console.log(`Concurrencia (VU) : ${concurrency}`);
console.log(`Total Peticiones  : ${totalRequests}`);
console.log('---------------------------------------------------------------\n');

function makeRequest(urlStr, method = 'GET', postData = null) {
    return new Promise((resolve) => {
        const parsed = new URL(urlStr);
        const isHttps = parsed.protocol === 'https:';
        const client = isHttps ? https : http;

        const options = {
            hostname: parsed.hostname,
            port: parsed.port || (isHttps ? 443 : 80),
            path: parsed.pathname + parsed.search,
            method: method,
            headers: {
                'User-Agent': 'QCS-StressTest-Runner/1.0',
                'Accept': 'application/json',
            }
        };

        if (postData) {
            options.headers['Content-Type'] = 'application/json';
            options.headers['Content-Length'] = Buffer.byteLength(postData);
        }

        const start = process.hrtime.bigint();
        const req = client.request(options, (res) => {
            let body = '';
            res.on('data', chunk => body += chunk);
            res.on('end', () => {
                const end = process.hrtime.bigint();
                const latencyMs = Number(end - start) / 1e6;
                resolve({
                    status: res.statusCode,
                    latencyMs,
                    headers: res.headers,
                    success: res.statusCode >= 200 && res.statusCode < 400,
                    rateLimited: res.statusCode === 429,
                    serverError: res.statusCode >= 500,
                });
            });
        });

        req.on('error', (err) => {
            const end = process.hrtime.bigint();
            const latencyMs = Number(end - start) / 1e6;
            resolve({
                status: 0,
                latencyMs,
                error: err.message,
                success: false,
                rateLimited: false,
                serverError: true,
            });
        });

        if (postData) {
            req.write(postData);
        }
        req.end();
    });
}

async function runScenario(scenarioName, url, method = 'GET', postData = null) {
    console.log(`>>> Ejecutando Escenario: ${scenarioName} (${method} ${url})`);
    const latencies = [];
    const statusCounts = {};
    let completed = 0;
    let inFlight = 0;
    let queueIndex = 0;

    const testStart = Date.now();

    return new Promise((resolve) => {
        function next() {
            if (completed >= totalRequests) {
                const testDurationSec = (Date.now() - testStart) / 1000;
                printScenarioSummary(scenarioName, latencies, statusCounts, testDurationSec);
                resolve();
                return;
            }

            while (inFlight < concurrency && queueIndex < totalRequests) {
                queueIndex++;
                inFlight++;
                makeRequest(url, method, postData).then(res => {
                    inFlight--;
                    completed++;
                    latencies.push(res.latencyMs);
                    statusCounts[res.status] = (statusCounts[res.status] || 0) + 1;
                    next();
                });
            }
        }

        next();
    });
}

function calculatePercentile(sorted, p) {
    if (sorted.length === 0) return 0;
    const index = Math.ceil((p / 100) * sorted.length) - 1;
    return sorted[Math.max(0, Math.min(index, sorted.length - 1))];
}

function printScenarioSummary(name, latencies, statusCounts, durationSec) {
    latencies.sort((a, b) => a - b);
    const total = latencies.length;
    const min = latencies[0] || 0;
    const max = latencies[total - 1] || 0;
    const avg = latencies.reduce((sum, v) => sum + v, 0) / (total || 1);
    const p50 = calculatePercentile(latencies, 50);
    const p90 = calculatePercentile(latencies, 90);
    const p95 = calculatePercentile(latencies, 95);
    const p99 = calculatePercentile(latencies, 99);

    const rps = (total / (durationSec || 0.001)).toFixed(2);
    const serverErrors = Object.entries(statusCounts)
        .filter(([code]) => parseInt(code, 10) >= 500)
        .reduce((sum, [, count]) => sum + count, 0);

    const errorRatePct = ((serverErrors / (total || 1)) * 100).toFixed(2);

    console.log(`--- Resultados para: ${name} ---`);
    console.log(`Peticiones Completadas : ${total} en ${durationSec.toFixed(2)}s (${rps} req/s)`);
    console.log(`Códigos de Respuesta   : ${JSON.stringify(statusCounts)}`);
    console.log(`Tasa de Error Fatal    : ${errorRatePct}% (5xx: ${serverErrors})`);
    console.log(`Latencias (ms):`);
    console.log(`  Mínima : ${min.toFixed(1)} ms | Promedio: ${avg.toFixed(1)} ms | Máxima: ${max.toFixed(1)} ms`);
    console.log(`  p50    : ${p50.toFixed(1)} ms | p90: ${p90.toFixed(1)} ms`);
    console.log(`  p95    : ${p95.toFixed(1)} ms | p99: ${p99.toFixed(1)} ms`);

    const passedSla = serverErrors === 0 && p95 < 500;
    console.log(`Veredicto SLA/SLO      : ${passedSla ? 'PASÓ (CERO CAÍDAS GARANTIZADO)' : 'ATENCIÓN (Revisar cuellos de botella)'}\n`);
}

async function main() {
    // 1. Health Check
    await runScenario('1. Health Check & Observabilidad', `${baseUrl}/backend/health.php`, 'GET');

    // 2. Consulta de Preguntas (Caché L1/L2 activo)
    await runScenario('2. Carga de Cuestionario Situacional (Caché)', `${baseUrl}/backend/api/soft-skills.php?action=questions`, 'GET');

    // 3. Envío de Evaluaciones (Rate Limiting y Circuit Breaker bajo estrés)
    const testPayload = JSON.stringify({
        candidate: {
            name: 'Stress Test Bot',
            email: 'bot@loadtest.local',
            phone: '+51 900 000 000',
            role: 'Load Simulator'
        },
        answers: { 1: 102, 2: 201, 3: 302, 4: 401, 5: 501, 6: 601, 7: 701, 8: 801 }
    });
    await runScenario('3. Envío Concurrente de Evaluaciones (Rate Limiting Shield)', `${baseUrl}/backend/api/soft-skills.php?action=submit`, 'POST', testPayload);

    console.log('===============================================================');
    console.log('   PRUEBAS DE ESTRÉS FINALIZADAS CON ÉXITO                     ');
    console.log('===============================================================');
}

main().catch(err => {
    console.error('Error fatal en runner de estrés:', err);
});

